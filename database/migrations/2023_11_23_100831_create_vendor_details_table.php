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
        Schema::create('vendor_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->longText('address_1')->nullable();
            $table->longText('address_2')->nullable();
            $table->Integer('country')->nullable();
            $table->Integer('state')->nullable();
            $table->Integer('city')->nullable();
            $table->Integer('pincode')->nullable();
            $table->string('gstin')->nullable(); 
            $table->string('pen_ten_no')->nullable(); 
            $table->string('cin')->nullable(); 
            $table->string('tds')->nullable(); 
            $table->string('portal_login_url')->nullable();
            $table->longText('access_security')->nullable();
            $table->longText('services_offered')->nullable();
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
        Schema::dropIfExists('vendor_details');
    }
};
