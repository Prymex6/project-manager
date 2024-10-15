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
        Schema::create('discussions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->index();
            $table->foreignId('created_by')->index();
            $table->string('subject');
            $table->text('description');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::create('discussion_user', function (Blueprint $table) {
            $table->foreignId('discussion_id')->index();
            $table->foreignId('user_id')->index();
            $table->timestamp('created_at');
        });

        Schema::create('discussion_group', function (Blueprint $table) {
            $table->foreignId('discussion_id')->index();
            $table->foreignId('group_id')->index();
            $table->timestamp('created_at');
        });

        Schema::create('discussion_comment', function (Blueprint $table) {
            $table->foreignId('discussion_id')->index();
            $table->foreignId('comment_id')->index();
            // $table->json('permission')->nullable();;
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discussions');
        Schema::dropIfExists('discussion_user');
        Schema::dropIfExists('discussion_group');
        Schema::dropIfExists('discussion_comment');
    }
};
