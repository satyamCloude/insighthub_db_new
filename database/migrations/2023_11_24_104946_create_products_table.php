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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_type_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('product_name')->nullable();
            $table->string('url')->nullable();
            $table->string('product_tag_line')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('payment_method')->nullable();
            $table->integer('display_on_frontend')->nullable();
            $table->text('product_description')->nullable();
            $table->integer('payment_type')->nullable();
            $table->bigInteger('onetime_inr')->nullable();
            $table->bigInteger('onetime_usd')->nullable();
            $table->bigInteger('recurr_inr_hourly')->nullable();
            $table->bigInteger('recurr_inr_monthly')->nullable();
            $table->bigInteger('recurr_inr_quartely')->nullable();
            $table->bigInteger('recurr_inr_semiannually')->nullable();
            $table->bigInteger('recurr_inr_annually')->nullable();
            $table->bigInteger('recurr_inr_biennially')->nullable(); 
            $table->bigInteger('recurr_inr_triennially')->nullable(); 
            $table->bigInteger('recurr_usd_hourly')->nullable(); 
            $table->bigInteger('recurr_usd_monthly')->nullable(); 
            $table->bigInteger('recurr_usd_quartely')->nullable();
            $table->bigInteger('recurr_usd_semiannually')->nullable();
            $table->bigInteger('recurr_usd_annually')->nullable();
            $table->bigInteger('recurr_usd_biennially')->nullable();
            $table->bigInteger('recurr_usd_triennially')->nullable();
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
        Schema::dropIfExists('products');
    }
};
