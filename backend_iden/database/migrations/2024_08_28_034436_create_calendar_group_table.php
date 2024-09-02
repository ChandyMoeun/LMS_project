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
        Schema::create('calendar_group', function (Blueprint $table) {
            $table->id();
            $table->string('calendar_name'); // Calendar name
            $table->integer('for_year'); // Year for which the calendar is applicable
            $table->boolean('active')->default(true); // Boolean field for active/inactive status
            $table->unsignedBigInteger('calendar_holiday_id')->nullable();
            $table->unsignedBigInteger('calendar_work_day_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendar_group');
    }
};
