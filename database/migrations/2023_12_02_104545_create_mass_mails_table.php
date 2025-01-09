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
        Schema::create('mass_mails', function (Blueprint $table) {
            $table->id();
            $table->string('to_id')->nullable();
            $table->integer('headfoot_id')->nullable();
            $table->longText('subject')->nullable();
            $table->datetime('schedule_date')->nullable();
            $table->longText('description')->nullable();
            $table->string('status')->default('1')->nullable();
            $table->string('star')->default('0')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mass_mails');
    }
};
