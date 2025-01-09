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
        Schema::create('rack_units', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('rack_id')->nullable();
            $table->bigInteger('unit_no')->nullable();
            $table->bigInteger('serial_no')->nullable();
            $table->text('serial_tag')->nullable();
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
        Schema::dropIfExists('rack_units');
    }
};
