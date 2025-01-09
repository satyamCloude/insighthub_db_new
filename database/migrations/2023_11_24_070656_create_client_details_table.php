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
        Schema::create('client_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('payment_method')->nullable();
            $table->longText('address_1')->nullable();
            $table->longText('address_2')->nullable();
            $table->Integer('country')->nullable();
            $table->Integer('state')->nullable();
            $table->Integer('city')->nullable();
            $table->Integer('pincode')->nullable();
            $table->string('gstin')->nullable(); 
            $table->string('hsn_sac')->nullable(); 
            $table->string('tds')->nullable(); 
            $table->string('currency')->nullable(); 
            $table->Integer('all_emails')->nullable();
            $table->Integer('invoices')->nullable();
            $table->Integer('support')->nullable();
            $table->Integer('services')->nullable();
            $table->Integer('over_due_invoice')->nullable();
            $table->Integer('tax_exampt')->nullable();
            $table->Integer('projects')->nullable();
            $table->string('doc_verify')->nullable(); 
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
        Schema::dropIfExists('client_details');
    }
};
