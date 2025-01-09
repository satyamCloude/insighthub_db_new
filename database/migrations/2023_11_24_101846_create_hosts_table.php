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
        Schema::create('hosts', function (Blueprint $table) {
            $table->id();  
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('host_name')->nullable(); 
            $table->string('url')->nullable(); 
            $table->string('billing_cycle')->nullable(); 
            $table->string('singup')->nullable(); 
            $table->string('servicestype')->nullable(); 
            $table->Integer('status')->nullable();
            $table->Integer('type')->nullable();
            $table->string('method')->nullable(); 
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hosts');
    }
};
