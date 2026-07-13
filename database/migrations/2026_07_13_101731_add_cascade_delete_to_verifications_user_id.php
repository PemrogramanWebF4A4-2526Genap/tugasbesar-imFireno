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
        Schema::table('verifications', function (Blueprint $table) {
            // Drop existing foreign key
            $table->dropForeign(['user_id']);
            
            // Re-add foreign key with cascade delete
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('verifications', function (Blueprint $table) {
            // Drop foreign key with cascade delete
            $table->dropForeign(['user_id']);
            
            // Re-add foreign key without cascade delete
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
        });
    }
};
