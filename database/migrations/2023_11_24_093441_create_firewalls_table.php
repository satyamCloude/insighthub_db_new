<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirewallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firewalls', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('customer_id')->nullable();
            $table->BigInteger('product_id')->nullable();
            $table->string('host_name')->nullable();
            $table->BigInteger('vender_id')->nullable();
            $table->integer('service_type')->nullable();
            $table->text('first_payment')->nullable();
            $table->text('billing_cycle')->nullable();
            $table->BigInteger('payment_method_id')->nullable();
            $table->date('signup_date')->nullable();
            $table->date('next_due_date')->nullable();
            $table->date('terminate_date')->nullable();
            $table->BigInteger('modal_no')->nullable();
            $table->text('hardware_tag')->nullable();
            $table->BigInteger('no_of_ports')->nullable();
            $table->BigInteger('rack_id')->nullable();
            $table->BigInteger('unit_no')->nullable();
            $table->string('floor_name')->nullable();
            $table->BigInteger('primary_public_ip')->nullable();
            $table->BigInteger('additional_public_ip')->nullable();
            $table->BigInteger('primary_private_ip')->nullable();
            $table->BigInteger('additional_private_ip')->nullable();
            $table->string('login_url')->nullable();
            $table->string('user_name')->nullable();
            $table->string('password')->nullable();
            $table->longText('console')->nullable();
            $table->BigInteger('employee_id')->nullable();
            $table->integer('status')->nullable();
            $table->longText('firewall_note')->nullable();
            $table->BigInteger('firewall_serial_no')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('firewalls');
    }
}

