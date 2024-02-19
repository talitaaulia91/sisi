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
        Schema::create('application_errors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->dateTime('error_date')->nullable();
            $table->string('modules')->nullable();
            $table->string('controller')->nullable();
            $table->string('function')->nullable();
            $table->string('error_line')->nullable();
            $table->string('error_message')->nullable();
            $table->string('status')->nullable();
            $table->string('param')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_errors');
    }
};
