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
        Schema::create('company_logins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->string('company_name')->nullable();
            $table->string('portal_login_url')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('password2')->nullable();
            $table->string('authorised_person_name')->nullable();
            $table->unsignedBigInteger('contact_no')->nullable();
            $table->string('email_address')->nullable();
            $table->longText('aditional_informaiton')->nullable();
            $table->Integer('status')->nullable();
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
        Schema::dropIfExists('company_logins');
    }
};
