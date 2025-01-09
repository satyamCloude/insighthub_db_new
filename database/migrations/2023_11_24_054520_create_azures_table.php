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
        Schema::create('azures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('vender_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('azure_account_Id')->nullable();
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->string('host_domain_name')->nullable();
            $table->string('services_name')->nullable();
            $table->Integer('service_type')->nullable();
            $table->unsignedBigInteger('first_payment')->nullable();
            $table->string('billing_cycle')->nullable();
            $table->date('signup_date')->nullable();
            $table->date('next_due_date')->nullable();
            $table->date('terminate_date')->nullable();
            $table->Integer('status')->nullable();
            $table->longText('azure_notes')->nullable();
            $table->string('azure_login_url')->nullable();
            $table->string('azure_username')->nullable();
            $table->string('azure_password')->nullable();
            $table->string('hosting_control_panel')->nullable();
            $table->string('control_panel_user_name')->nullable();
            $table->string('control_panel_password')->nullable();
            $table->longText('addon')->nullable();
            $table->longText('specification')->nullable();
            $table->longText('backup_security')->nullable();
            $table->longText('architecture')->nullable();
            $table->string('license_management')->nullable();
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
        Schema::dropIfExists('azures');
    }
};
