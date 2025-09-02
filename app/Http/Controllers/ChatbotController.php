<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Services\WebScraperService;

class ChatbotController extends Controller
{
  private $openaiApiKey;
  private $systemPrompt;
  private $webScraperService;

  public function __construct(WebScraperService $webScraperService)
  {
    $this->openaiApiKey = env('OPENAI_API_KEY');
    $this->webScraperService = $webScraperService;
    $this->systemPrompt = $this->getSystemPrompt();
  }

  public function chat(Request $request)
  {
    $request->validate([
      'message' => 'required|string|max:1000',
      'conversation_history' => 'nullable|array'
    ]);

    try {
      $messages = $this->buildMessageHistory($request->conversation_history ?? [], $request->message);

      $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $this->openaiApiKey,
        'Content-Type' => 'application/json',
      ])->timeout(30)->post('https://api.openai.com/v1/chat/completions', [
        'model' => 'gpt-3.5-turbo',
        'messages' => $messages,
        'max_tokens' => 500,
        'temperature' => 0.7,
        'presence_penalty' => 0.1,
        'frequency_penalty' => 0.1,
      ]);

      if ($response->successful()) {
        $data = $response->json();
        $botMessage = $data['choices'][0]['message']['content'] ?? 'Maaf, saya tidak dapat memahami pertanyaan Anda.';

        return response()->json([
          'success' => true,
          'message' => trim($botMessage),
          'usage' => $data['usage'] ?? null
        ]);
      } else {
        Log::error('OpenAI API Error', [
          'status' => $response->status(),
          'response' => $response->body()
        ]);

        return response()->json([
          'success' => false,
          'message' => 'Maaf, layanan sedang tidak tersedia. Silakan coba lagi nanti.',
          'error' => 'API_ERROR'
        ], 500);
      }
    } catch (\Exception $e) {
      Log::error('Chatbot Error', [
        'message' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
      ]);

      return response()->json([
        'success' => false,
        'message' => 'Terjadi kesalahan sistem. Silakan coba lagi nanti.',
        'error' => 'SYSTEM_ERROR'
      ], 500);
    }
  }

  private function buildMessageHistory($history, $newMessage)
  {
    $messages = [
      [
        'role' => 'system',
        'content' => $this->systemPrompt
      ]
    ];

    // Add conversation history (max 10 messages to avoid token limit)
    if (!empty($history)) {
      $recentHistory = array_slice($history, -10);
      foreach ($recentHistory as $msg) {
        if (isset($msg['role']) && isset($msg['content'])) {
          $messages[] = [
            'role' => $msg['role'],
            'content' => $msg['content']
          ];
        }
      }
    }

    // Add current user message
    $messages[] = [
      'role' => 'user',
      'content' => $newMessage
    ];

    return $messages;
  }
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

    $newsText = '';
    if (!empty($latestNews)) {
      $newsText = "\n\nBERITA TERBARU PT SENA:\n";
      foreach ($latestNews as $news) {
        $newsText .= "- {$news['date']}: {$news['title']}\n";
      }
    }

    $experienceText = '';
    if (!empty($experiences)) {
      $experienceText = "\n\nPENGALAMAN PROYEK TERBARU:\n";
      $count = 0;
      foreach ($experiences as $exp) {
        if ($count >= 5) break; // Limit to 5 recent projects
        $experienceText .= "- {$exp['client']} ({$exp['duration']}): {$exp['project']}\n";
        $count++;
      }
    }

    $investorText = '';
    if (!empty($investorInfo) && isset($investorInfo['company_profile'])) {
      $profile = $investorInfo['company_profile'];
      $investorText = "\n\nINFORMASI INVESTOR:\n";
      $investorText .= "- Perusahaan Induk: {$profile['parent_company']}\n";
      $investorText .= "- Jenis Bisnis: {$profile['business_type']}\n";
      if (isset($profile['sectors'])) {
        $investorText .= "- Sektor: " . implode(', ', $profile['sectors']) . "\n";
      }
    }

    return "Anda adalah asisten virtual PT Solusi Energy Nusantara (PT SENA), sebuah perusahaan engineering terkemuka di Indonesia yang didirikan pada tahun {$companyInfo['established']}.

INFORMASI PERUSAHAAN (Data Real-time dari Website):
- Nama: {$companyInfo['name']}
- Didirikan: {$companyInfo['established']}
- Deskripsi: {$companyInfo['description']}
- Visi: {$companyInfo['vision']}
- Misi: {$companyInfo['mission']}

STATISTIK PERUSAHAAN:
- Karyawan: 800+ orang
- Proyek: 400+ proyek completed
- Safe Man Hours: 6+ juta jam kerja aman

LAYANAN UTAMA (Data dari Website):
1. {$capabilities['engineering']['title']} - {$capabilities['engineering']['description']}
2. {$capabilities['inspection']['title']} - {$capabilities['inspection']['description']}
3. {$capabilities['consultancy']['title']} - {$capabilities['consultancy']['description']}
4. {$capabilities['survey']['title']} - {$capabilities['survey']['description']}

SEKTOR YANG DILAYANI:
- Oil & Gas (Upstream & Downstream)
- Refinery & Petrochemical
- Power & Energy
- Infrastructure & Utilities{$experienceText}{$investorText}{$newsText}

KONTAK:
- Alamat: {$contact['address']}
- Telepon: {$contact['phone']}
- Email: {$contact['email']}
- Website: {$contact['website']}

PANDUAN KOMUNIKASI:
1. Jawab dengan bahasa Indonesia yang profesional dan ramah
2. Berikan informasi yang akurat berdasarkan data real-time di atas
3. Jika ditanya tentang hal di luar informasi PT SENA, arahkan kembali ke topik perusahaan
4. Tawarkan bantuan lebih lanjut untuk pertanyaan spesifik
5. Gunakan data proyek dan pengalaman untuk memberikan contoh konkret
6. Jika ditanya tentang karir, arahkan ke halaman contact atau HR

RESPONS KHUSUS:
- Untuk pertanyaan tentang proyek: Sebutkan pengalaman spesifik dengan klien besar
- Untuk pertanyaan tentang layanan: Jelaskan dengan detail dan berikan contoh aplikasi
- Untuk pertanyaan tentang perusahaan: Gunakan data visi, misi, dan statistik terbaru
- Untuk pertanyaan investor: Gunakan informasi struktur perusahaan dan posisi pasar

KELEBIHAN PT SENA:
- Berpengalaman lebih dari 9 tahun di industri Oil & Gas
- Terafiliasi dengan PT Perusahaan Gas Negara Tbk (PGN)
- Track record proyek dengan perusahaan BUMN dan multinasional
- Komitmen tinggi terhadap keselamatan kerja (K3)
- Teknologi dan software terdepan untuk engineering solutions";
  }

  public function getCompanyInfo()
  {
    $websiteData = $this->webScraperService->getAllData();

    return response()->json([
      'company' => $websiteData['company'],
      'capabilities' => $websiteData['capabilities'],
      'contact' => $websiteData['contact'],
      'news' => $websiteData['news'],
      'last_updated' => $websiteData['last_updated'],
      'data_source' => 'Real-time from https://new.pt-sena.co.id'
    ]);
  }

  public function refreshData()
  {
    $this->webScraperService->clearCache();
    return response()->json([
      'success' => true,
      'message' => 'Data cache cleared. Fresh data will be fetched on next request.',
      'timestamp' => now()->format('Y-m-d H:i:s')
    ]);
  }

  public function getExperiences()
  {
    $websiteData = $this->webScraperService->getAllData();

    return response()->json([
      'experiences' => $websiteData['experiences'],
      'total_projects' => count($websiteData['experiences']),
      'last_updated' => $websiteData['last_updated'],
      'data_source' => 'Real-time from https://new.pt-sena.co.id/experience'
    ]);
  }

  public function getInvestorInfo()
  {
    $websiteData = $this->webScraperService->getAllData();

    return response()->json([
      'investor_info' => $websiteData['investor_info'],
      'last_updated' => $websiteData['last_updated'],
      'data_source' => 'Real-time from https://new.pt-sena.co.id/investor'
    ]);
  }

  public function debug()
  {
    try {
      $websiteData = $this->webScraperService->getAllData();

      return response()->json([
        'success' => true,
        'data' => $websiteData,
        'statistics' => [
          'company_info' => !empty($websiteData['company']['vision']) ? 'OK' : 'MISSING_VISION',
          'capabilities_count' => count($websiteData['capabilities']),
          'news_count' => count($websiteData['news']),
          'experiences_count' => count($websiteData['experiences']),
          'investor_info' => !empty($websiteData['investor_info']) ? 'Available' : 'Missing',
          'last_updated' => $websiteData['last_updated']
        ]
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'error' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
      ], 500);
    }
  }
}
