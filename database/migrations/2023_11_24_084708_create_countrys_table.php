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
        Schema::create('countrys', function (Blueprint $table) {
            $table->id('country_id');
            $table->string('country_name');
            $table->char('country_iso_code_2', 2)->nullable();
            $table->char('country_iso_code_3', 3)->nullable();
            $table->integer('address_format_id')->nullable();
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
        Schema::dropIfExists('countrys');
    }
};
