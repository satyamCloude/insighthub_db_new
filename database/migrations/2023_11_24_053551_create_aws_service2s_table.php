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
        Schema::create('aws_service2s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aws_id')->nullable();
            $table->string('server_ip')->nullable();
            $table->string('hostname')->nullable();
            $table->string('rdp_ssh_username')->nullable();
            $table->string('rdp_ssh_port')->nullable();
            $table->string('rdp_ssh_password')->nullable();
            $table->string('pemkey')->nullable();
            $table->string('Privatekey')->nullable();
            $table->string('publickey')->nullable();
            $table->longText('region')->nullable();
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
        Schema::dropIfExists('aws_service2s');
    }
};
