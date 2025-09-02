<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\CapabilityController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ChatbotController;

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search.index');

// About Pages
Route::prefix('about')->name('about.')->group(function () {
    Route::get('/', [AboutController::class, 'index'])->name('index');
    Route::get('/history', [AboutController::class, 'history'])->name('history');
    Route::get('/struktur-organisasi', [AboutController::class, 'strukturOrganisasi'])->name('struktur-organisasi');
    Route::get('/kepemilikan-saham', [AboutController::class, 'kepemilikanSaham'])->name('kepemilikan-saham');
});

// Sertifikasi Page
Route::get('/sertifikasi', [AboutController::class, 'sertifikasi'])->name('sertifikasi');

// Kebijakan Page
Route::get('/kebijakan', [AboutController::class, 'kebijakan'])->name('kebijakan');

// Services Pages  
Route::prefix('services')->name('services.')->group(function () {
    Route::get('/', [ServicesController::class, 'index'])->name('index');
    Route::get('/{id}', [ServicesController::class, 'show'])->name('show');
});

// Capability Pages
Route::prefix('capability')->name('capability.')->group(function () {
    Route::get('/', [CapabilityController::class, 'index'])->name('index');
    Route::get('/disiplin', [CapabilityController::class, 'disiplin'])->name('disiplin');
    Route::get('/software-equipment', [CapabilityController::class, 'softwareEquipment'])->name('software-equipment');
    Route::get('/all-software-equipment', [CapabilityController::class, 'allSoftwareEquipment'])->name('all-software-equipment');
});

// Project Pages
Route::prefix('projects')->name('projects.')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('index');
    Route::get('/map', [ProjectController::class, 'map'])->name('map');
    Route::get('/{id}', [ProjectController::class, 'show'])->name('show');
});

// Contact Pages
Route::prefix('contact')->name('contact.')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::post('/', [ContactController::class, 'store'])->name('store');
});

// Annual Report Page
Route::get('/annualreport', [AboutController::class, 'annualReport'])->name('annualreport');

// News Pages
Route::prefix('news')->name('news.')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/{slug}', [NewsController::class, 'show'])->name('show');
});

// Authentication Routes
Route::get('/admin/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('admin.logout');

// Omnichannel Chat Routes
Route::prefix('chat')->name('chat.')->group(function () {
    Route::post('/init', [App\Http\Controllers\OmnichannelController::class, 'initSession'])->name('init');
    Route::post('/send', [App\Http\Controllers\OmnichannelController::class, 'sendMessage'])->name('send');
    Route::get('/messages', [App\Http\Controllers\OmnichannelController::class, 'getMessages'])->name('messages');
});

// Admin Chat Routes
Route::prefix('admin/chat')->name('admin.chat.')->middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminChatController::class, 'dashboard'])->name('dashboard');
    Route::post('/take/{chatSession}', [App\Http\Controllers\AdminChatController::class, 'takeChat'])->name('take');
    Route::post('/send/{chatSession}', [App\Http\Controllers\AdminChatController::class, 'sendMessage'])->name('send');
    Route::get('/session/{chatSession}', [App\Http\Controllers\AdminChatController::class, 'getChatSession'])->name('session');
    Route::post('/close/{chatSession}', [App\Http\Controllers\AdminChatController::class, 'closeChat'])->name('close');
    Route::get('/all', [App\Http\Controllers\AdminChatController::class, 'getAllChats'])->name('all');
    Route::post('/read/{chatSession}', [App\Http\Controllers\AdminChatController::class, 'markAsRead'])->name('read');
});

// API Routes for AJAX calls
Route::prefix('api')->group(function () {
    Route::get('/stats', [HomeController::class, 'getStats'])->name('api.stats');
    Route::post('/chatbot', [ChatbotController::class, 'chat'])->name('api.chatbot')->middleware('throttle:30,1');
    Route::get('/chatbot/info', [ChatbotController::class, 'getCompanyInfo'])->name('api.chatbot.info');
});
