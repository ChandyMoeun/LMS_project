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
        Schema::create('leave_balances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('leave_type_id'); // FK to leave_types table
            $table->integer('used')->default(0);
            $table->integer('available')->default(0);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('leave_type_id')->references('id')->on('leave_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leave_balances', function (Blueprint $table) {
            // Drop foreign key constraints first before dropping the table
            $table->dropForeign(['employee_id']);
            $table->dropForeign(['leave_type_id']);
        });
        
        Schema::dropIfExists('leave_balances');
    }
};
