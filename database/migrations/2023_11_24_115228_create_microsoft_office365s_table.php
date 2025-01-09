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
        Schema::create('microsoft_office365s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('customer_id2')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('domain_name_tenant_id')->nullable();
            $table->unsignedBigInteger('vender_id')->nullable();
            $table->bigInteger('quantity')->nullable();
            $table->integer('service_type')->nullable(); 
            $table->string('subscription_id')->nullable();
            $table->integer('status')->nullable();
            $table->longText('google_notes')->nullable();
            $table->string('first_payment')->nullable();
            $table->string('billing_cycle')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->date('signup_date')->nullable();
            $table->date('next_due_date')->nullable();
            $table->date('terminate_date')->nullable();
            $table->string('login_url')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable(); // Fix typo
            $table->longText('email')->nullable();
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
        Schema::dropIfExists('microsoft_office365s');
    }
};
