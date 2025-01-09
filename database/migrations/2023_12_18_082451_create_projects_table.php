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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('project_name')->nullable();
            $table->date('date')->nullable();
            $table->integer('any_one')->nullable();
            $table->integer('without_deadline')->nullable();
            $table->integer('is_public')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('deadline')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('project_manager_id')->nullable();
            $table->string('team_id')->nullable();
            $table->integer('priority_id')->nullable();
            $table->integer('Type_id')->nullable();
            $table->integer('status_id')->nullable();
            $table->string('project_value')->nullable();
            $table->string('Document')->nullable();
            $table->longText('Task')->nullable();
            $table->longText('project_summary')->nullable();
            $table->longText('notes')->nullable();
            $table->bigInteger('status_pro')->nullable();
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
        Schema::dropIfExists('projects');
    }
};
