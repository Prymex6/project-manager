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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('tags')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::create('chat_user', function (Blueprint $table) {
            $table->foreignId('chat_id')->index();
            $table->foreignId('user_id')->index();
            $table->timestamp('created_at');
        });

        Schema::create('chat_message', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_id')->index();
            $table->foreignId('user_id')->index();
            $table->text('content');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
        Schema::dropIfExists('chat_user');
        Schema::dropIfExists('chat_message');
    }
};
