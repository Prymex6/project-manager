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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->index();
            $table->foreignId('created_by')->nullable()->index();
            $table->string('subject');
            $table->text('description');
            $table->string('url');
            $table->foreignId('status_id')->index();
            $table->foreignId('priority_id')->index();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        // Schema::create('ticket_priorities', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->string('color')->nullable();
        //     $table->timestamps();
        // });

        Schema::create('ticket_user', function (Blueprint $table) {
            $table->foreignId('ticket_id')->index();
            $table->foreignId('user_id')->index();
            $table->json('permission')->nullable();;
            $table->timestamp('created_at');
        });

        Schema::create('ticket_group', function (Blueprint $table) {
            $table->foreignId('ticket_id')->index();
            $table->foreignId('group_id')->index();
            $table->json('permission')->nullable();;
            $table->timestamp('created_at');
        });

        Schema::create('ticket_comment', function (Blueprint $table) {
            $table->foreignId('ticket_id')->index();
            $table->foreignId('comment_id')->index();
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
        // Schema::dropIfExists('ticket_priorities');
        Schema::dropIfExists('ticket_user');
        Schema::dropIfExists('ticket_group');
        Schema::dropIfExists('ticket_comment');
    }
};
