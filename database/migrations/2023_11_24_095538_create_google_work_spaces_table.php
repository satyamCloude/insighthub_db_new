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
        Schema::create('google_work_spaces', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id')->nullable();
            $table->BigInteger('employee_id')->nullable();
            $table->BigInteger('customer_id')->nullable();
            $table->BigInteger('customer_id2')->nullable();
            $table->BigInteger('product_id')->nullable();
            $table->BigInteger('domain_name_tenant_id')->nullable();
            $table->BigInteger('vender_id')->nullable();
            $table->BigInteger('quantity')->default(1)->nullable();
            $table->integer('service_type')->nullable();
            $table->BigInteger('subscription_id')->nullable();
            $table->integer('status')->nullable();
            $table->longText('google_notes')->nullable();
            $table->BigInteger('first_payment')->nullable();
            $table->string('billing_cycle')->nullable();
            $table->BigInteger('currency_id')->nullable();
            $table->BigInteger('payment_method_id')->nullable();
            $table->date('signup_date')->nullable();
            $table->date('next_due_date')->nullable();
            $table->date('terminate_date')->nullable();
            $table->string('login_url')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
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
        Schema::dropIfExists('google_work_spaces');
    }
};
