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
        Schema::create('level_accesses', function (Blueprint $table) {
            $table->id();
             
        $table->unsignedBigInteger('user_id'); // Foreign key referencing users
        $table->unsignedBigInteger('level_id'); // Foreign key referencing levels
        $table->boolean('accessibility')->default(0); // 1 or 0 to indicate accessibility
      

        // Define foreign key constraints
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('level_accesses');
    }
};
