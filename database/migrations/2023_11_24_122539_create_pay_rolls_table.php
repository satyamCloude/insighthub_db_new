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
        Schema::create('pay_rolls', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('emp_Id')->nullable();
            $table->bigInteger('net_salary')->nullable();
            $table->decimal('basic')->nullable();
            $table->decimal('hra')->nullable();
            $table->decimal('conveyance')->nullable();
            $table->integer('leaves')->nullable();
            $table->integer('workingdays')->nullable();
            $table->decimal('deduction')->nullable();
            $table->decimal('allowance')->nullable();
            $table->decimal('tds')->nullable();
            $table->decimal('net_paid')->nullable();
            $table->decimal('medical_allowance')->nullable();
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
        Schema::dropIfExists('pay_rolls');
    }
};
