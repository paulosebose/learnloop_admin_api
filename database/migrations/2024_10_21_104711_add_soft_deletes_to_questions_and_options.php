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
                $table->softDeletes(); // Adds a deleted_at column to the questions table
            });
    
            Schema::table('options', function (Blueprint $table) {
                $table->softDeletes(); // Adds a deleted_at column to the options table
            });
      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropSoftDeletes(); 
        });
        Schema::table('options', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Removes the deleted_at column from the options table
        });
    }
};
