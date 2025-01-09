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
        Schema::create('quotes_cals', function (Blueprint $table) {
            $table->id();
            $table->integer('quotes_id')->nullable();
            $table->decimal('qty')->nullable();
            $table->text('description')->nullable();
            $table->decimal('unit_price')->nullable();
            $table->decimal('discount')->nullable();
            $table->decimal('total')->nullable();
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
        Schema::dropIfExists('quotes_cals');
    }
};
