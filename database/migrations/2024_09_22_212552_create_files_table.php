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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->index();
            $table->foreignId('uploaded_by')->index();
            $table->string('name');
            $table->string('type');
            $table->string('subject');
            $table->text('description');
            $table->integer('download');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::create('file_user', function (Blueprint $table) {
            $table->foreignId('file_id')->index();
            $table->foreignId('user_id')->index();
            $table->timestamp('created_at');
        });

        Schema::create('file_group', function (Blueprint $table) {
            $table->foreignId('file_id')->index();
            $table->foreignId('group_id')->index();
            $table->timestamp('created_at');
        });

        Schema::create('file_comment', function (Blueprint $table) {
            $table->foreignId('file_id')->index();
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
        Schema::dropIfExists('files');
        Schema::dropIfExists('file_user');
        Schema::dropIfExists('file_group');
        Schema::dropIfExists('file_comment');
    }
};
