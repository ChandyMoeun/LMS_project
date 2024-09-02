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
        Schema::create('leave_types', function (Blueprint $table) {
            $table->id();
            $table->string('leave_name', 255);
            $table->boolean('requires_attachment');
            $table->boolean('auto_increase_entitlement');
            $table->integer('increase_rate')->nullable(); // Rate at which entitlement increases (e.g., days/year)
            $table->boolean('required_hr_approval')->default(false);
            $table->string('hr_approver_ids')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_types');
    }
};
