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
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id')->nullable();
            $table->BigInteger('customer_id')->nullable();
            $table->BigInteger('product_id')->nullable();
            $table->string('host_domain_name')->nullable();
            $table->BigInteger('quantity')->nullable();
            $table->BigInteger('vender_id')->nullable();
            $table->integer('service_type')->nullable();
            $table->BigInteger('first_payment')->nullable();
            $table->string('billing_cycle')->nullable();
            $table->BigInteger('currency_id')->nullable();
            $table->BigInteger('payment_method_id')->nullable();
            $table->date('signup_date')->nullable();
            $table->date('next_due_date')->nullable();
            $table->date('terminate_date')->nullable();
            $table->integer('status')->nullable();
            $table->BigInteger('employee_id')->nullable();
            $table->string('portal_url')->nullable();
            $table->string('username')->nullable();
            $table->longText('license_management')->nullable();
            $table->string('password')->nullable();
            $table->string('tenant_id')->nullable();
            $table->string('customer_id2')->nullable();
            $table->string('subscription_id')->nullable();
            $table->longText('Licenses_note')->nullable();
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
        Schema::dropIfExists('licenses');
    }
};
