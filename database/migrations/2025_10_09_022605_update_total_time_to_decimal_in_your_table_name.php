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
         DB::table('users')->whereNull('total_time')->update(['total_time' => 0]);

        Schema::table('users', function (Blueprint $table) {
            // Change total_time from int to decimal, make it nullable for safety
            $table->decimal('total_time', 8, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
             $table->integer('total_time')->nullable()->change();
        });
    }
};
