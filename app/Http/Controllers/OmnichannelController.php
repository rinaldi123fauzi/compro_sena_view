<?php

namespace App\Http\Controllers;

use App\Models\ChatSession;
use App\Models\Message;
use App\Events\MessageSent;
use App\Events\ChatTransferredToAdmin;
use App\Services\WebScraperService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OmnichannelController extends Controller
{
    private $openaiApiKey;
    private $webScraperService;

    public function __construct(WebScraperService $webScraperService)
    {
        $this->openaiApiKey = env('OPENAI_API_KEY');
        $this->webScraperService = $webScraperService;

        // Debug: Log API key status
        Log::info('OpenAI API Key loaded', [
            'key_exists' => !empty($this->openaiApiKey),
            'key_length' => $this->openaiApiKey ? strlen($this->openaiApiKey) : 0,
            'key_prefix' => $this->openaiApiKey ? substr($this->openaiApiKey, 0, 10) . '...' : 'null'
        ]);
    }

    /**
     * Initialize a new chat session
     */
    public function initSession(Request $request)
    {
        $sessionId = Str::uuid();

        $chatSession = ChatSession::create([
            'session_id' => $sessionId,
            'visitor_name' => $request->name,
            'visitor_email' => $request->email,
            'visitor_ip' => $request->ip(),
            'status' => 'active',
            'is_ai_handled' => true,
            'last_activity_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'session_id' => $sessionId,
            'chat_session_id' => $chatSession->id,
        ]);
    }

    /**
     * Send a message in the chat
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'session_id' => 'required|string',
            'message' => 'required|string|max:1000',
            'sender_type' => 'required|in:visitor,admin',
        ]);

        $chatSession = ChatSession::where('session_id', $request->session_id)->first();

        if (!$chatSession) {
            return response()->json(['error' => 'Chat session not found'], 404);
        }

        // Create visitor message
        $message = Message::create([
            'chat_session_id' => $chatSession->id,
            'content' => $request->message,
            'sender_type' => $request->sender_type,
            'sender_id' => $request->sender_type === 'admin' ? Auth::id() : null,
        ]);

        // Load sender relationship before broadcasting
        $message->load('sender');

        // Update session activity
        $chatSession->update(['last_activity_at' => now()]);

        // Broadcast the message
        broadcast(new MessageSent($message))->toOthers();

        // Debug: Log session status
        Log::info('Checking AI handling status', [
            'sender_type' => $request->sender_type,
            'is_ai_handled' => $chatSession->is_ai_handled,
            'should_process_ai' => ($request->sender_type === 'visitor' && $chatSession->is_ai_handled)
        ]);

        // If message is from visitor and session is AI-handled, get AI response
        if ($request->sender_type === 'visitor' && $chatSession->is_ai_handled) {
            $this->processAIResponse($chatSession, $request->message);
        }

        return response()->json([
            'success' => true,
            'message' => $message->load('sender'),
        ]);
    }

    /**
     * Process AI response
     */
    private function processAIResponse(ChatSession $chatSession, string $userMessage)
    {
        try {
            // Check if visitor message directly requests admin transfer
            if ($this->shouldTransferVisitorMessage($userMessage)) {
                $this->transferToAdmin($chatSession, 'Anda telah meminta bantuan admin.');
                return;
            }

            // Preprocess message to add context for quick actions
            $processedMessage = $this->preprocessMessage($userMessage);

            // Get conversation history
            $messages = $this->buildConversationHistory($chatSession, $processedMessage);

            // Debug: Log request details
            Log::info('Sending request to OpenAI', [
                'api_key_exists' => !empty($this->openaiApiKey),
                'api_key_length' => strlen($this->openaiApiKey),
                'messages_count' => count($messages),
                'user_message' => $userMessage,
                'processed_message' => $processedMessage
            ]);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->openaiApiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30)->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => $messages,
                'max_tokens' => 500,
                'temperature' => 0.7,
            ]);

            // Debug: Log response
            Log::info('OpenAI response received', [
                'status' => $response->status(),
                'successful' => $response->successful(),
                'response_body' => $response->body()
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $aiResponse = $data['choices'][0]['message']['content'] ?? 'Maaf, saya tidak dapat memahami pertanyaan Anda.';

                // Check if AI response indicates it cannot help
                if ($this->shouldTransferToAdmin($aiResponse)) {
                    $this->transferToAdmin($chatSession, $aiResponse);
                } else {
                    // Create AI response message
                    $aiMessage = Message::create([
                        'chat_session_id' => $chatSession->id,
                        'content' => $aiResponse,
                        'sender_type' => 'ai',
                        'metadata' => [
                            'model' => 'gpt-3.5-turbo',
                            'tokens_used' => $data['usage']['total_tokens'] ?? 0,
                            'original_message' => $userMessage,
                            'processed_message' => $processedMessage,
                        ],
                    ]);

                    // Load sender relationship (though AI doesn't have sender)
                    $aiMessage->load('sender');

                    // Broadcast AI response
                    broadcast(new MessageSent($aiMessage))->toOthers();
                }
            } else {
                // If AI fails, transfer to admin
                $this->transferToAdmin($chatSession, 'Maaf, sistem AI sedang mengalami gangguan. Anda akan diarahkan ke admin kami.');
            }
        } catch (\Exception $e) {
            Log::error('AI Response Error: ' . $e->getMessage());
            $this->transferToAdmin($chatSession, 'Terjadi kesalahan sistem. Anda akan diarahkan ke admin kami.');
        }
    }

    /**
     * Preprocess message to add context for quick actions
     */
    private function preprocessMessage(string $message): string
    {
        $lowerMessage = strtolower(trim($message));

        // Detect quick action types and add specific context
        if (
            strpos($lowerMessage, 'pelaporan pengaduan') !== false ||
            strpos($lowerMessage, 'pengaduan') !== false ||
            strpos($lowerMessage, 'keluhan') !== false ||
            strpos($lowerMessage, 'komplain') !== false
        ) {
            return "TOPIK: PELAPORAN PENGADUAN - " . $message . "\n\nSaya ingin mengetahui prosedur pelaporan pengaduan di PT SENA. Tolong berikan informasi lengkap tentang cara melaporkan pengaduan, kontak yang tepat, dan prosesnya.";
        }

        if (
            strpos($lowerMessage, 'tentang sena') !== false ||
            strpos($lowerMessage, 'tentang pt sena') !== false ||
            strpos($lowerMessage, 'profil perusahaan') !== false
        ) {
            return "TOPIK: TENTANG SENA - " . $message . "\n\nSaya ingin mengetahui informasi lengkap tentang PT SENA, sejarah, visi, misi, dan pencapaian perusahaan.";
        }

        if (
            strpos($lowerMessage, 'portfolio proyek') !== false ||
            strpos($lowerMessage, 'portfolio') !== false ||
            strpos($lowerMessage, 'proyek') !== false
        ) {
            return "TOPIK: PORTFOLIO PROYEK - " . $message . "\n\nSaya ingin mengetahui portfolio proyek PT SENA, klien-klien utama, dan jenis-jenis proyek yang telah dikerjakan.";
        }

        if (
            strpos($lowerMessage, 'annual report') !== false ||
            strpos($lowerMessage, 'laporan tahunan') !== false
        ) {
            return "TOPIK: ANNUAL REPORT - " . $message . "\n\nSaya ingin mendapatkan annual report PT SENA. Tolong berikan informasi cara memperolehnya.";
        }

        if (
            strpos($lowerMessage, 'hubungi marketing') !== false ||
            strpos($lowerMessage, 'marketing') !== false ||
            strpos($lowerMessage, 'sales') !== false
        ) {
            return "TOPIK: HUBUNGI MARKETING - " . $message . "\n\nSaya ingin menghubungi tim marketing PT SENA untuk keperluan bisnis dan penjualan.";
        }

        // For general first-time greetings, add welcome context
        if (
            strpos($lowerMessage, 'halo') !== false ||
            strpos($lowerMessage, 'hai') !== false ||
            strpos($lowerMessage, 'hello') !== false ||
            $lowerMessage === 'hi' ||
            strlen($lowerMessage) < 10
        ) {
            return "TOPIK: SALAM PEMBUKA - " . $message . "\n\nSaya baru pertama kali menggunakan chatbot PT SENA. Tolong berikan sambutan yang ramah dan informasi singkat tentang bagaimana chatbot ini bisa membantu saya.";
        }

        return $message;
    }

    /**
     * Build conversation history for AI
     */
    private function buildConversationHistory(ChatSession $chatSession, string $currentMessage)
    {
        $systemPrompt = $this->getSystemPrompt();

        $messages = [
            ['role' => 'system', 'content' => $systemPrompt]
        ];

        // Get recent conversation history
        $recentMessages = $chatSession->messages()
            ->where('sender_type', '!=', 'admin')
            ->orderBy('created_at')
            ->limit(10)
            ->get();

        foreach ($recentMessages as $msg) {
            $role = $msg->sender_type === 'visitor' ? 'user' : 'assistant';
            $messages[] = ['role' => $role, 'content' => $msg->content];
        }

        // Add current message
        $messages[] = ['role' => 'user', 'content' => $currentMessage];

        return $messages;
    }

    /**
     * Check if AI response indicates transfer to admin is needed
     */
    private function shouldTransferToAdmin(string $aiResponse): bool
    {
        $transferKeywords = [
            'tidak tahu',
            'tidak dapat membantu',
            'tidak memiliki informasi',
            'hubungi admin',
            'maaf saya tidak',
            'tidak bisa membantu',
            'di luar kemampuan',
            'bantuan lebih lanjut',
            'perlu bantuan manusia',
            'bicara dengan admin',
        ];

        $lowerResponse = strtolower($aiResponse);

        foreach ($transferKeywords as $keyword) {
            if (strpos($lowerResponse, $keyword) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if visitor message should trigger admin transfer
     */
    private function shouldTransferVisitorMessage(string $visitorMessage): bool
    {
        $transferKeywords = [
            'bicara dengan admin',
            'minta admin',
            'hubungkan dengan admin',
            'admin',
            'customer service',
            'bantuan manusia',
            'operator',
            'petugas',
            'komplain',
            'keluhan',
            'tidak puas',
            'sulit',
            'rumit',
            'urgent',
            'penting',
            'tolong bantu',
        ];

        $lowerMessage = strtolower($visitorMessage);

        foreach ($transferKeywords as $keyword) {
            if (strpos($lowerMessage, $keyword) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Transfer chat to admin
     */
    private function transferToAdmin(ChatSession $chatSession, string $reason)
    {
        $chatSession->transferToAdmin();

        // Send transfer message
        $transferMessage = Message::create([
            'chat_session_id' => $chatSession->id,
            'content' => $reason . ' Mohon tunggu sebentar, admin kami akan segera membantu Anda.',
            'sender_type' => 'ai',
            'metadata' => ['transfer_reason' => $reason],
        ]);

        // Load sender relationship
        $transferMessage->load('sender');

        // Debug: Log broadcasting events
        Log::info('Broadcasting transfer events', [
            'chat_session_id' => $chatSession->id,
            'session_status' => $chatSession->status,
            'transferred_at' => $chatSession->transferred_to_admin_at
        ]);

        broadcast(new MessageSent($transferMessage))->toOthers();
        broadcast(new ChatTransferredToAdmin($chatSession->load('latestMessage')));

        Log::info('Transfer events broadcasted successfully');
    }

    /**
     * Get chat session messages
     */
    public function getMessages(Request $request)
    {
        $chatSession = ChatSession::where('session_id', $request->session_id)->first();

        if (!$chatSession) {
            return response()->json(['error' => 'Chat session not found'], 404);
        }

        $messages = $chatSession->messages()->with('sender')->get();

        return response()->json([
            'success' => true,
            'messages' => $messages,
            'session' => $chatSession,
        ]);
    }

    /**
     * Get enhanced system prompt for AI with real-time data
     */
    private function getSystemPrompt()
    {
        // Get real-time data from website
        $websiteData = $this->webScraperService->getAllData();

        $companyInfo = $websiteData['company'];
        $capabilities = $websiteData['capabilities'];
        $contact = $websiteData['contact'];
        $latestNews = $websiteData['news'];
        $experiences = $websiteData['experiences'] ?? [];
        $investorInfo = $websiteData['investor_info'] ?? [];
        $deepContent = $websiteData['deep_content'] ?? [];
        $annualReports = $websiteData['annual_reports'] ?? [];

        // Build comprehensive knowledge base
        $experiencesText = '';
        if (!empty($experiences)) {
            $experiencesText = "\n\nPENGALAMAN PROYEK TERBARU:\n";
            foreach (array_slice($experiences, 0, 10) as $exp) {
                $experiencesText .= "- {$exp['client']}: {$exp['project']} ({$exp['duration']})\n";
            }
        }

        $newsText = '';
        if (!empty($latestNews)) {
            $newsText = "\n\nBERITA TERBARU:\n";
            foreach (array_slice($latestNews, 0, 5) as $news) {
                $newsText .= "- {$news['date']}: {$news['title']}\n";
            }
        }

        $investorText = '';
        if (!empty($investorInfo['company_profile'])) {
            $profile = $investorInfo['company_profile'];
            $investorText = "\n\nINFORMASI INVESTOR:\n";
            $investorText .= "- Perusahaan Induk: {$profile['parent_company']}\n";
            $investorText .= "- Jenis Bisnis: {$profile['business_type']}\n";
            $investorText .= "- Sektor: " . implode(', ', $profile['sectors'] ?? []) . "\n";
        }

        $deepContentText = '';
        if (!empty($deepContent)) {
            $deepContentText = "\n\nINFORMASI MENDALAM DARI WEBSITE:\n";

            // Add structured information from deep crawling
            foreach ($deepContent as $page => $content) {
                if (is_array($content) && isset($content['headings'])) {
                    $deepContentText .= "Halaman {$page}:\n";
                    if (!empty($content['headings']['h1'])) {
                        $deepContentText .= "- " . implode("\n- ", $content['headings']['h1']) . "\n";
                    }
                    if (!empty($content['paragraphs'])) {
                        $relevantParagraphs = array_slice($content['paragraphs'], 0, 3);
                        $deepContentText .= "Konten: " . implode(" ", $relevantParagraphs) . "\n\n";
                    }
                }
            }
        }

        $employees = $companyInfo['stats']['employees'] ?? '800+';
        $projects = $companyInfo['stats']['projects'] ?? '400+';


        return "Anda adalah asisten virtual untuk PT SENA (Solusi Energy Nusantara), sebuah perusahaan engineering terkemuka yang bergerak di bidang energi. dalam merespon 

INFORMASI PERUSAHAAN (DATA REAL-TIME DARI WEBSITE):
- Nama: {$companyInfo['name']}
- Didirikan: {$companyInfo['established']}
- Deskripsi: {$companyInfo['description']}
- Visi: {$companyInfo['vision']}
- Misi: {$companyInfo['mission']}
- Karyawan: {$employees}
- Proyek Selesai: {$projects}

LAYANAN UTAMA (REAL-TIME):
" . $this->formatCapabilities($capabilities) . "

KONTAK INFORMASI (REAL-TIME):
- Alamat: {$contact['address']}
- Telepon: {$contact['phone']}
- Email: {$contact['email']}
- Website: {$contact['website']}

{$experiencesText}
{$newsText}
{$investorText}
{$deepContentText}

RESPONS KHUSUS BERDASARKAN TOPIK:

1. JIKA ditanya 'Tentang SENA':
   - Jelaskan sejarah, visi, misi perusahaan
   - Gunakan data company info di atas
   - Sebutkan pencapaian dan statistik

2. JIKA ditanya 'Portfolio Proyek':
   - Gunakan data experiences yang tersedia
   - Sebutkan klien-klien utama
   - Jelaskan jenis proyek yang dikerjakan

3. JIKA ditanya 'Request Annual Report':
   - Jelaskan cara mendapatkan annual report
   - Berikan kontak yang tepat untuk permintaan dokumen
   - Sebutkan informasi yang bisa ditemukan dalam report

4. JIKA ditanya 'Pelaporan Pengaduan':
   - Fokus pada prosedur pengaduan dan keluhan
   - Berikan kontak khusus untuk pengaduan
   - Jelaskan komitmen perusahaan terhadap kualitas layanan
   - JANGAN sebutkan layanan engineering atau informasi umum perusahaan

5. JIKA ditanya 'Hubungi Marketing':
   - Fokus pada layanan marketing 
   - Berikan kontak marketing yang spesifik
   - Jelaskan bagaimana tim marketing bisa membantu

PANDUAN RESPONS:
1. Gunakan informasi real-time di atas sebagai basis pengetahuan utama
2. SELALU sesuaikan respons dengan topik yang ditanyakan
3. Jika ditanya tentang hal spesifik yang tidak ada dalam data, katakan: 'Mohon maaf, saya tidak dapat memberikan informasi tersebut. Anda bisa menghubungi tim kami untuk bantuan lebih lanjut.'
4. Untuk pertanyaan teknis yang kompleks, tawarkan untuk menghubungkan dengan ahli kami
5. JANGAN berikan respons generik yang tidak sesuai dengan pertanyaan

ATURAN FORMATTING WAJIB:
- SETIAP respons WAJIB menggunakan paragraf terpisah
- Gunakan double line break (\\n\\n) untuk memisahkan antar topik
- Maksimal 2 kalimat per paragraf
- SELALU pisahkan salam, konten utama, dan penutup
- Untuk daftar, gunakan bullet points dengan line break
- Informasi kontak HARUS dalam blok terpisah

TEMPLATE RESPONS UNTUK PELAPORAN PENGADUAN:
Halo! 👋 Terima kasih telah menghubungi PT SENA untuk pelaporan pengaduan.


PT SENA berkomitmen untuk memberikan layanan terbaik kepada seluruh klien. 🛡️
Kami sangat menghargai masukan dan pengaduan untuk perbaikan berkelanjutan.


CARA MELAPORKAN PENGADUAN:
• Email: complaint@pt-sena.co.id
• Telepon: +62-21-8317717 (ext. 100)
• Form online di website resmi kami
• Datang langsung ke kantor pusat


JENIS PENGADUAN YANG DAPAT DILAPORKAN:
• Kualitas layanan engineering
• Keterlambatan proyek
• Masalah komunikasi
• Keluhan teknis lainnya


KOMITMEN KAMI:
📋 Respon dalam 24 jam
🔍 Investigasi menyeluruh
✅ Tindak lanjut yang tepat
📞 Update berkala kepada pelapor


Apakah ada pengaduan spesifik yang ingin Anda laporkan? 🤔

KATA KUNCI TRANSFER KE ADMIN:
Jika visitor menggunakan kata-kata berikut, segera katakan perlu menghubungkan dengan tim yang lebih kompeten:
- 'tidak dapat membantu dengan hal tersebut'
- 'memerlukan bantuan tim ahli kami'
- 'perlu konsultasi lebih mendalam'

INGAT: 
- SELALU sesuaikan respons dengan topik yang ditanyakan
- JANGAN berikan informasi umum jika pertanyaan spesifik
- Gunakan format dengan paragraf terpisah dan baris kosong ganda antar topik!
- Bayangkan diri Anda sebagai sahabat profesional yang siap membantu dengan informasi akurat dan relevan.";
    }

    /**
     * Format capabilities for system prompt
     */
    private function formatCapabilities($capabilities)
    {
        $formatted = "";
        foreach ($capabilities as $key => $capability) {
            if (is_array($capability) && isset($capability['title'])) {
                $formatted .= "- {$capability['title']}: {$capability['description']}\n";
            }
        }
        return $formatted;
    }
}
