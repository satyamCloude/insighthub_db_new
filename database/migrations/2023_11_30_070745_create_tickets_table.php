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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->nullable();
            $table->bigInteger('ccid')->nullable();
            $table->bigInteger('department_id')->nullable();
            $table->bigInteger('priority_id')->nullable();
            $table->bigInteger('product_service_id')->nullable();
            $table->bigInteger('status')->default(1)->nullable();
            $table->date('date')->nullable();
            $table->longtext('subject')->nullable();
            $table->longtext('task')->nullable();
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
        Schema::dropIfExists('tickets');
    }
};
