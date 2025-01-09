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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('generated_by')->nullable();
            $table->string('gender');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->BigInteger('phone_number');
            $table->BigInteger('company_id');
            $table->BigInteger('lead_source');
            $table->string('action_schedule');
            $table->date('date');
            $table->time('time');
            $table->BigInteger('assignedto');
            $table->text('requirement');
            $table->longText('note');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('leads');
    }
};
