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
        Schema::create('attendence_details', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('emp_Id')->nullable();
            $table->datetime('production_hours')->nullable();
            $table->datetime('break_time')->nullable();
            $table->datetime('over_time')->nullable();
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
        Schema::dropIfExists('attendence_details');
    }
};
