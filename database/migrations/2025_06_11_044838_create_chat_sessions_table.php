<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chat_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->unique();
            $table->string('visitor_name')->nullable();
            $table->string('visitor_email')->nullable();
            $table->string('visitor_ip')->nullable();
            $table->enum('status', ['active', 'waiting_for_admin', 'with_admin', 'closed'])->default('active');
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('set null');
            $table->boolean('is_ai_handled')->default(true);
            $table->timestamp('transferred_to_admin_at')->nullable();
            $table->timestamp('last_activity_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_sessions');
    }
};
