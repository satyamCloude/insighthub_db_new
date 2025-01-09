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
        Schema::create('cloud_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('os_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('switch_id')->nullable();
            $table->unsignedBigInteger('vender_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('bare_metal_id')->nullable();
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->unsignedBigInteger('firewall_serial_id')->nullable();
            $table->unsignedBigInteger('dc_location')->nullable();
            $table->unsignedBigInteger('first_payment')->nullable();
            $table->string('host_domain_name')->nullable();
            $table->Integer('service_type')->nullable();
            $table->string('billing_cycle')->nullable();
            $table->date('signup_date')->nullable();
            $table->date('next_due_date')->nullable();
            $table->date('terminate_date')->nullable();
            $table->string('swith_port')->nullable();
            $table->string('firewall_port')->nullable();
            $table->Integer('status')->nullable();
            $table->longText('vps_notes')->nullable();
            $table->string('primary_public_ip')->nullable();
            $table->string('additional_public_ip')->nullable();
            $table->string('primary_private_ip')->nullable();
            $table->string('additional_private_ip')->nullable();
            $table->string('ip_kvm_console')->nullable();
            $table->string('ip_kvm_username')->nullable();
            $table->string('ip_kvm_password')->nullable();
            $table->string('hosting_control_panel')->nullable();
            $table->string('control_panel_user_name')->nullable();
            $table->string('control_panel_password')->nullable();
            $table->string('rdp_ssh_username')->nullable();
            $table->string('rdp_ssh_port')->nullable();
            $table->string('rdp_ssh_password')->nullable();
            $table->string('pemkey')->nullable();
            $table->string('Privatekey')->nullable();
            $table->string('publickey')->nullable();
            $table->longText('addon')->nullable();
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
        Schema::dropIfExists('cloud_services');
    }
};
