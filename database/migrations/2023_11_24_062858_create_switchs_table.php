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
        Schema::create('switchs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->string('host_name')->nullable();
            $table->bigInteger('switch_id')->nullable();
            $table->bigInteger('vender_id')->nullable();
            $table->integer('service_type')->nullable();
            $table->text('first_payment')->nullable();
            $table->bigInteger('recurring_amount')->nullable();
            $table->text('billing_cycle')->nullable();
            $table->integer('payment_method_id')->nullable();
            $table->date('signup_date')->nullable();
            $table->date('next_due_date')->nullable();
            $table->date('terminate_date')->nullable();
            $table->bigInteger('modal_no')->nullable();
            $table->text('hardware_tag')->nullable();
            $table->bigInteger('no_of_ports')->nullable();
            $table->bigInteger('rack_id')->nullable();
            $table->bigInteger('unit_no')->nullable();
            $table->string('floor_name')->nullable();
            $table->bigInteger('primary_public_ip')->nullable();
            $table->bigInteger('additional_public_ip')->nullable();
            $table->bigInteger('primary_private_ip')->nullable();
            $table->bigInteger('additional_private_ip')->nullable();
            $table->string('login_url')->nullable();
            $table->string('user_name')->nullable();
            $table->string('password')->nullable();
            $table->longText('console')->nullable();
            $table->bigInteger('employee_id')->nullable();
            $table->integer('status')->nullable();
            $table->longText('firewall_note')->nullable();
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
        Schema::dropIfExists('switchs');
    }
};
