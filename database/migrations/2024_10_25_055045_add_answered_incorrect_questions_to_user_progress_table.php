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
        Schema::table('user_progress', function (Blueprint $table) {
            $table->json('incorrect_questions')->nullable()->before('created_at');
            $table->json('answered_questions')->nullable()->after('incorrect_questions'); // Assuming incorrect_questions is added first
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_progress', function (Blueprint $table) {
            $table->dropColumn(['answered_questions', 'incorrect_questions']);
        });
    }
};
