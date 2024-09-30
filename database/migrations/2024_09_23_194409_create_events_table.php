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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->foreignId('created_by')->index();
            $table->string('title');
            $table->text('description');
            $table->text('tags')->nullable();
            $table->foreignId('status_id')->nullable()->index();
            $table->dateTime('started_at');
            $table->dateTime('ended_at');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::create('event_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
        Schema::dropIfExists('event_statuses');
    }
};
