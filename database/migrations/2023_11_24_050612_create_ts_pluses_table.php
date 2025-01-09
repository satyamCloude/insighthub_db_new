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
        Schema::create('ts_pluses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->string('host_domain_name')->nullable();
            $table->integer('vender_id')->nullable();
            $table->integer('service_type')->nullable();
            $table->integer('status')->nullable();
            $table->bigInteger('first_payment')->nullable();
            $table->string('billing_cycle')->nullable();
            $table->integer('currency_id')->nullable();
            $table->integer('payment_method_id')->nullable();
            $table->date('signup_date')->nullable();
            $table->date('next_due_date')->nullable();
            $table->date('terminate_date')->nullable();
            $table->string('computer_id')->nullable();
            $table->string('license_key')->nullable();
            $table->string('no_of_license')->nullable();
            $table->integer('employee_id')->nullable();
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
        Schema::dropIfExists('ts_pluses');
    }
};
