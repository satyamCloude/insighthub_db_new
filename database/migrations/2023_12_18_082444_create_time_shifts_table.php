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
        Schema::create('time_shifts', function (Blueprint $table) {
            $table->id();
            $table->string('shift_name')->nullable();
            $table->string('Colorname')->nullable();
            $table->string('working_hours')->nullable();
            $table->time('StartTime')->nullable();
            $table->time('EndTime')->nullable();
            $table->integer('HalfdayMarkTime')->nullable();
            $table->integer('EarlyClockIn')->nullable();
            $table->integer('Latemarkafter')->nullable();
            $table->integer('Maximumcheckinallowedinaday')->nullable();
            $table->integer('monday')->nullable();
            $table->integer('tuesday')->nullable();
            $table->integer('wednesday')->nullable();
            $table->integer('thursday')->nullable();
            $table->integer('friday')->nullable();
            $table->integer('saturday')->nullable();
            $table->integer('sunday')->nullable();
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
        Schema::dropIfExists('time_shifts');
    }
};
