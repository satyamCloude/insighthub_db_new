<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('emp_Id')->nullable();
            $table->BigInteger('apply_for')->nullable()->comment('1=leave, 2=work from home');
            $table->integer('full_half_day')->nullable()->comment('1:half, 2:full');
            $table->integer('pre_post_lunch')->nullable()->comment('1:pre, 2:post');
            $table->integer('leavetype_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('description')->nullable();
            $table->date('date')->nullable();
            $table->integer('status')->default(3)->comment('1:approved, 2:unapproved, 3:progress');
            $table->BigInteger('approved_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
}
