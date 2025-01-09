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
        Schema::create('time_sheets', function (Blueprint $table) {
            $table->id();
            $table->string('shift_name')->nullable();
            $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();
            $table->string('working_hours')->nullable();
            $table->string('weekly_off')->nullable();
            $table->string('addi_week_off_first')->nullable();
            $table->string('addi_week_off_second')->nullable();
            $table->string('addi_week_off_third')->nullable();
            $table->string('addi_week_off_fourth')->nullable();
            $table->string('shift_assign_id')->nullable();
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
        Schema::dropIfExists('time_sheets');
    }
};
