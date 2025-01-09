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
        Schema::create('monthely_setups', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id')->nullable();
            $table->BigInteger('customer_id')->nullable();
            $table->BigInteger('product_id')->nullable();
            $table->string('host_domain_name')->nullable();
            $table->BigInteger('os_id')->nullable();
            $table->BigInteger('vendor_id')->nullable();
            $table->string('service_type')->nullable();
            $table->decimal('first_payment', 10, 2)->nullable();
            $table->string('billing_cycle')->nullable();
            $table->BigInteger('currency_id')->nullable();
            $table->BigInteger('payment_method_id')->nullable();
            $table->date('signup_date')->nullable();
            $table->date('next_due_date')->nullable();
            $table->date('terminate_date')->nullable();
            $table->string('status')->nullable();
            $table->text('onetimesetup_notes')->nullable();
            $table->text('todo_notes')->nullable();
            $table->string('control_panel_login_url')->nullable();
            $table->string('control_panel_user_name')->nullable();
            $table->string('control_panel_password')->nullable();
            $table->string('rdp_ssh_username')->nullable();
            $table->integer('rdp_ssh_port')->nullable();
            $table->string('rdp_ssh_password')->nullable();
            $table->ipAddress('server_ip')->nullable();
            $table->string('control_panel_url')->nullable();
            $table->text('pemkey')->nullable();
            $table->text('privatekey')->nullable();
            $table->text('publickey')->nullable();
            $table->text('addon')->nullable();
            $table->text('license_management')->nullable();
            $table->BigInteger('employee_id')->nullable();
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
        Schema::dropIfExists('monthely_setups');
    }
};
