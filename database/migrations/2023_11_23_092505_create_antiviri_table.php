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
        Schema::create('antiviri', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('vender_id')->nullable();
            $table->unsignedBigInteger('first_payment')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->string('billing_cycle')->nullable(); 
            $table->string('host_domain_name')->nullable();
            $table->string('protal_url')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('license_key')->nullable();
            $table->Integer('quantity')->nullable();
            $table->Integer('status')->nullable();
            $table->string('service_type')->nullable(); 
            $table->date('signup_date')->nullable();
            $table->date('next_due_date')->nullable();
            $table->date('terminate_date')->nullable();
            $table->date('valid_domain_upto')->nullable();
            $table->longText('antivirus_note')->nullable();
            $table->longText('license_management')->nullable();
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
        Schema::dropIfExists('antiviri');
    }
};
