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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->index();
            $table->foreignId('company_id')->index();
            $table->foreignId('user_id')->index();
            $table->string('subject');
            $table->text('description')->nullable();
            $table->string('type');
            $table->integer('total');
            $table->foreignId('status_id')->index();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::create('sale_statuses', function (Blueprint $table) {
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
        Schema::dropIfExists('sales');
        Schema::dropIfExists('sale_statuses');
    }
};
