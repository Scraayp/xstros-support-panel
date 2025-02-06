<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained()->onDelete('cascade');  // Foreign key to tickets table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');    // Foreign key to users table (for both users and staff)
            $table->text('message');
            $table->enum('role', ['user', 'staff']);  // Role to distinguish between user and staff replies
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};
