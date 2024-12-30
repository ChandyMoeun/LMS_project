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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');  // Reference to Employee
            $table->text('message');
            $table->enum('notification_type', ['telegram', 'email']);  // Enum for type (Telegram, Email)
            $table->foreignId('leave_request_id')->nullable()->constrained('leave_requests')->onDelete('cascade');  // Notification relates to leave request
            $table->timestamp('sent_at')->nullable();  // Timestamp for when the notification was sent
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
