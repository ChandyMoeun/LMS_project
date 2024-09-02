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
        Schema::create('calendar_holidays', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('holiday_name'); // Name of the holiday
            $table->date('from_date'); // Start date of the holiday
            $table->date('to_date'); // End date of the holiday
            $table->enum('holiday', ['national', 'observance']); // Type of holiday
            $table->text('description'); // Description of the holiday
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendar_holidays');
    }
};
