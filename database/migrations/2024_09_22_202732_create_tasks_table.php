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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->index();
            $table->string('name');
            $table->foreignId('created_by')->index();
            $table->text('description');
            $table->text('tags')->nullable();
            $table->boolean('is_private')->default(false);
            $table->foreignId('status_id')->nullable()->index();
            $table->foreignId('priority_id')->nullable()->index();
            $table->decimal('planned_hours', 5, 2);
            $table->date('started_at')->nullable();
            $table->date('deadline_at')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::create('task_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color')->nullable();
            $table->timestamps();
        });

        Schema::create('task_status_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->index();
            $table->foreignId('status_id')->index();
            $table->foreignId('user_id')->index();
            $table->timestamp('changed_at');
        });

        Schema::create('task_priorities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color')->nullable();
            $table->timestamps();
        });

        Schema::create('task_user', function (Blueprint $table) {
            $table->foreignId('task_id')->index();
            $table->foreignId('user_id')->index();
            $table->timestamp('created_at');
        });

        Schema::create('task_group', function (Blueprint $table) {
            $table->foreignId('task_id')->index();
            $table->foreignId('group_id')->index();
            $table->timestamp('created_at');
        });

        Schema::create('task_comment', function (Blueprint $table) {
            $table->foreignId('task_id')->index();
            $table->foreignId('comment_id')->index();
            // $table->json('permission')->nullable();;
            $table->timestamp('created_at');
        });

        Schema::create('task_milestone', function (Blueprint $table) {
            $table->foreignId('task_id')->index();
            $table->foreignId('milestone_id')->index();
            $table->foreignId('added_by')->index();
            $table->foreignId('updated_by')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('task_statuses');
        Schema::dropIfExists('task_status_history');
        Schema::dropIfExists('task_priorities');
        Schema::dropIfExists('task_user');
        Schema::dropIfExists('task_group');
        Schema::dropIfExists('task_comment');
        Schema::dropIfExists('task_milestone');
    }
};
