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
        Schema::table('leave_requests', function (Blueprint $table) {
            Schema::table('leave_requests', function (Blueprint $table) {
                $table->unsignedBigInteger('approved_by')->nullable()->after('status');
                $table->unsignedBigInteger('rejected_by')->nullable()->after('approved_by');
    
                $table->foreign('approved_by')->references('id')->on('employees')->onDelete('set null');
                $table->foreign('rejected_by')->references('id')->on('employees')->onDelete('set null');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leave_requests', function (Blueprint $table) {
            $table->dropForeign(['approved_by']);
            $table->dropColumn('approved_by');

            $table->dropForeign(['rejected_by']);
            $table->dropColumn('rejected_by');
        });
    }
};
