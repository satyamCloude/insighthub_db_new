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
        Schema::create('employee_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('dob');
            $table->date('marriage_anniversary')->nullable();
            $table->date('date_of_joining');
            $table->decimal('net_salary', 10, 2);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('job_role_id');
            $table->unsignedBigInteger('admin_type_id');
            $table->unsignedBigInteger('permission_role_id');
            $table->boolean('team_lead')->default(false);
            $table->unsignedBigInteger('weekly_off_id');
            $table->unsignedBigInteger('additional_week_off_first')->nullable();
            $table->unsignedBigInteger('additional_week_off_second')->nullable();
            $table->unsignedBigInteger('additional_week_off_third')->nullable();
            $table->unsignedBigInteger('additional_week_off_fourth')->nullable();
            $table->unsignedBigInteger('team_lead_id')->nullable();
            $table->date('date_of_relieving')->nullable();
            $table->unsignedBigInteger('working_type_id');
            $table->longText('signature')->nullable();
            $table->unsignedBigInteger('shift_id');
            $table->longText('kra');
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
        Schema::dropIfExists('employee_details');
    }
};
