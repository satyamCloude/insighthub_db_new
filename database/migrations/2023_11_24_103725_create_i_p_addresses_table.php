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
        Schema::create('i_p_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('ip_address')->nullable(); 
            $table->string('subnet_mask')->nullable(); 
            $table->string('gateway')->nullable(); 
            $table->string('vlan')->nullable(); 
            $table->string('primary_name_server')->nullable(); 
            $table->string('secondary_name_server')->nullable(); 
            $table->Integer('dc_location_id')->nullable();
            $table->Integer('isManual')->nullable();
            $table->Integer('ip_type')->nullable();
            $table->string('description')->nullable();
            $table->string('private_ip')->nullable();
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
        Schema::dropIfExists('i_p_addresses');
    }
};
