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
        Schema::table('tickets', function (Blueprint $table) {
            $table->timestamp('closed_at')->nullable();  // Add closed_at column
            $table->unsignedBigInteger('closer_id')->nullable(); // Add closer_id column (refers to the user who closed the ticket)

            // Add foreign key constraint if 'users' table exists
            $table->foreign('closer_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['closer_id']);  // Drop foreign key constraint
            $table->dropColumn('closed_at');
            $table->dropColumn('closer_id');
        });
    }
};
