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
        Schema::create('calendars', function (Blueprint $table) {
            $table->bigInteger('cid')->unsigned()->autoIncrement();
            $table->bigInteger('id')->unsigned()->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->date('startStr')->nullable();
            $table->date('endStr')->nullable();
            $table->string('display')->nullable();
            $table->string('location')->nullable();
            $table->string('guests')->nullable();
            $table->string('calendar')->nullable();
            $table->longText('description')->nullable();
            $table->string('allDay')->nullable();
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
        Schema::dropIfExists('calendars');
    }
};
