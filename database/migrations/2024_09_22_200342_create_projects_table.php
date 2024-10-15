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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('company_id')->nullable()->index();
            $table->text('description');
            $table->text('tags')->nullable();
            $table->foreignId('status_id')->nullable()->index();
            $table->date('started_at')->nullable();
            $table->date('deadline_at')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::create('project_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color')->nullable();
            $table->timestamps();
        });

        Schema::create('project_user', function (Blueprint $table) {
            $table->foreignId('project_id')->index();
            $table->foreignId('user_id')->index();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('project_group', function (Blueprint $table) {
            $table->foreignId('project_id')->index();
            $table->foreignId('group_id')->index();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('project_settings', function (Blueprint $table) {
            $table->foreignId('project_id')->index();
            $table->integer('min_hours');
            $table->integer('max_hours');
            $table->json('visible_tabs');
            $table->boolean('hide_tasks_on_main_table');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
        Schema::dropIfExists('project_statuses');
        Schema::dropIfExists('project_user');
        Schema::dropIfExists('project_group');
        Schema::dropIfExists('project_settings');
    }
};
