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
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');// ID of the approver (nullable)
            $table->unsignedBigInteger('leaveType_id'); 
            $table->enum('half_day_type', ['full_day', 'morning', 'afternoon', 'time'])->nullable(); // Enum for Half Day Type
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('attachment')->nullable(); // Path to the attachment file
            $table->float('total_requested_days'); // Total number of days requested
            $table->date('from_date'); // Start date of the leave
            $table->date('to_date'); // End date of the leave
            $table->enum('status', ['rejected', 'approved', 'pending']); // Status of the leave request
            $table->boolean('pending_hr_approval')->default(false); // Whether HR approval is pending
            $table->string('reason', 255)->nullable(); // Reason for the leave request
            $table->string('duration_leave')->nullable(); // Duration of the leave (e.g., 2.5 days)
            $table->date('requested_at')->nullable(); // Timestamp for when the request was made
            $table->date('approved_at')->nullable(); // Timestamp for when the request was approved

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
