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
         Schema::table('questions', function (Blueprint $table) {
            $table->text('question')
                ->charset('utf8mb4')
                ->collation('utf8mb4_unicode_ci')
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            // Optional: revert back to previous charset if needed
            $table->text('question')->change();
        });
    }
};
