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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_code')->nullable();
            $table->string('brand_name')->nullable();
            $table->BigInteger('phone_number')->nullable();
            $table->date('purchase_date')->nullable();
            $table->date('warranty_expiry')->nullable();
            $table->BigInteger('base_amount')->nullable();
            $table->string('gst_vat')->nullable();
            $table->BigInteger('tax_amount')->nullable();
            $table->BigInteger('total_amount')->nullable();
            $table->BigInteger('assigned_to_id')->nullable();
            $table->BigInteger('Vendor_id')->nullable();
            $table->string('bill_attachment')->nullable();
            $table->longText('product_description')->nullable();
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
        Schema::dropIfExists('inventories');
    }
};
