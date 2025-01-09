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
        Schema::create('performances', function (Blueprint $table) {
            $table->id();
               $table->string('totalrating')->nullable();
               $table->integer('employee_id')->nullable();
               $table->string('evaluation_period')->nullable();
               $table->year('year')->nullable();
               $table->longtext('comments')->nullable();
               $table->integer('user_id')->nullable();
               $table->date('date')->nullable();
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
        Schema::dropIfExists('performances');
    }
};
