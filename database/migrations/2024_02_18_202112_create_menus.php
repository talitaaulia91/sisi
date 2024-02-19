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
        Schema::create('menus', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('level_id');
            $table->string('menu_name')->nullable();
            $table->string('menu_link')->nullable();
            $table->string('menu_icon')->nullable();
            $table->string('parent_Id')->nullable();
            $table->timestamps();

            $table->foreign('level_id')->on('menu_levels')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
