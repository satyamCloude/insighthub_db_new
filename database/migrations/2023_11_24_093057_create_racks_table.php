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
        Schema::create('racks', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->integer('vendor_id')->nullable();
            $table->integer('rack_id')->nullable();
            $table->bigInteger('rack_power_unit')->nullable();
            $table->text('rack_bandwidth')->nullable();
            $table->bigInteger('rack_capacity')->nullable();
            $table->text('dc_floor')->nullable();
            $table->text('dc_area_zone')->nullable();
            $table->text('rack_note')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('racks');
    }
};
