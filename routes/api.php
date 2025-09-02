<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\OmnichannelController;
use App\Models\Message;
use App\Models\ChatSession;
use App\Events\MessageSent;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

// Test route for real-time debugging
Route::post('/test-message', function (Request $request) {
  try {
    // Find or create a test chat session
    $chatSession = ChatSession::firstOrCreate([
      'session_id' => 'test-session-' . ($request->chat_id ?? '1')
    ], [
      'visitor_name' => 'Test Visitor',
      'visitor_email' => 'test@example.com',
      'visitor_ip' => $request->ip(),
      'status' => 'active',
      'is_ai_handled' => true,
      'last_activity_at' => now(),
    ]);

    // Create test message
    $message = Message::create([
      'chat_session_id' => $chatSession->id,
      'content' => $request->message ?? 'Test message from API',
      'sender_type' => $request->sender_type ?? 'visitor',
      'sender_id' => null,
    ]);

    // Load sender relationship
    $message->load('sender');

    // Broadcast the message
    broadcast(new MessageSent($message))->toOthers();

    return response()->json([
      'success' => true,
      'message' => $message,
      'chat_session' => $chatSession,
      'channel' => 'chat-session.' . $chatSession->id
    ]);
  } catch (\Exception $e) {
    return response()->json([
      'success' => false,
      'error' => $e->getMessage()
    ], 500);
  }
});

// Enhanced Web Scraping Analytics API Routes
Route::prefix('scraping')->group(function () {
  Route::get('/analytics', [App\Http\Controllers\WebScrapingAnalyticsController::class, 'getAnalytics']);
  Route::get('/content-structure', [App\Http\Controllers\WebScrapingAnalyticsController::class, 'getContentStructure']);
  Route::post('/force-refresh', [App\Http\Controllers\WebScrapingAnalyticsController::class, 'forceRefresh']);
  Route::get('/chatbot-readiness', [App\Http\Controllers\WebScrapingAnalyticsController::class, 'getChatbotReadiness']);
});

// Enhanced Chatbot API with Real-time Data
Route::middleware('throttle:30,1')->group(function () {
  Route::post('/chatbot', [ChatbotController::class, 'chat']);
  Route::get('/chatbot/info', [ChatbotController::class, 'getCompanyInfo']);
  Route::get('/chatbot/experiences', [ChatbotController::class, 'getExperiences']);
  Route::get('/chatbot/investor', [ChatbotController::class, 'getInvestorInfo']);
  Route::get('/chatbot/debug', [ChatbotController::class, 'debug']);
});

Route::post('/chatbot/refresh', [ChatbotController::class, 'refreshData'])->middleware('throttle:5,1');

// Test route for WebSocket message broadcasting
Route::post('/test-message', function (Request $request) {
  try {
    $request->validate([
      'chat_session_id' => 'required|integer',
      'message' => 'required|string',
      'sender_type' => 'required|in:visitor,admin,ai'
    ]);

    // Find or create chat session
    $chatSession = ChatSession::find($request->chat_session_id);
    if (!$chatSession) {
      // Create a test chat session
      $chatSession = ChatSession::create([
        'session_id' => 'test-' . uniqid(),
        'visitor_name' => 'Test User',
        'visitor_email' => 'test@example.com',
        'visitor_ip' => $request->ip(),
        'status' => 'active',
        'is_ai_handled' => true,
        'last_activity_at' => now(),
      ]);
    }

    // Create message
    $message = Message::create([
      'chat_session_id' => $chatSession->id,
      'content' => $request->message,
      'sender_type' => $request->sender_type,
      'sender_id' => null,
    ]);

    // Load sender relationship
    $message->load('sender');

    // Broadcast the message
    broadcast(new MessageSent($message))->toOthers();

    return response()->json([
      'success' => true,
      'message' => 'Message broadcasted successfully',
      'data' => [
        'message_id' => $message->id,
        'chat_session_id' => $chatSession->id,
        'channel' => "chat-session.{$chatSession->id}",
        'content' => $message->content,
        'sender_type' => $message->sender_type
      ]
    ]);
  } catch (\Exception $e) {
    return response()->json([
      'success' => false,
      'error' => $e->getMessage()
    ], 500);
  }
});

// Test admin message API
Route::post('/test-admin-message', function (Request $request) {
  try {
    $request->validate([
      'chat_session_id' => 'required|integer',
    ]);

    // Find or create chat session
    $chatSession = ChatSession::find($request->chat_session_id);
    if (!$chatSession) {
      return response()->json([
        'success' => false,
        'error' => 'Chat session not found'
      ], 404);
    }

    // Get or create admin user
    $admin = User::where('email', 'admin@sena.com')->first();
    if (!$admin) {
      $admin = User::create([
        'name' => 'Admin SENA',
        'email' => 'admin@sena.com',
        'password' => bcrypt('password'),
        'email_verified_at' => now(),
      ]);
    }

    // Update chat session if needed
    if ($chatSession->status === 'waiting_for_admin') {
      $chatSession->admin_id = $admin->id;
      $chatSession->status = 'with_admin';
      $chatSession->save();
    }

    // Create admin message
    $message = Message::create([
      'chat_session_id' => $chatSession->id,
      'content' => 'Halo! Saya ' . $admin->name . ' dari tim customer service PT SENA. Ada yang bisa saya bantu? (Test from API)',
      'sender_type' => 'admin',
      'sender_id' => $admin->id,
    ]);

    // Load sender relationship
    $message->load('sender');

    // Broadcast the message
    broadcast(new MessageSent($message))->toOthers();

    return response()->json([
      'success' => true,
      'message' => 'Admin message sent successfully',
      'data' => [
        'message_id' => $message->id,
        'chat_session_id' => $chatSession->id,
        'channel' => "chat-session.{$chatSession->id}",
        'content' => $message->content,
        'sender_type' => $message->sender_type,
        'sender_name' => $admin->name,
        'chat_status' => $chatSession->status
      ]
    ]);
  } catch (\Exception $e) {
    return response()->json([
      'success' => false,
      'error' => $e->getMessage()
    ], 500);
  }
});
