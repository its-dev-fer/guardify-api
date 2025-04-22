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
        Schema::create('plans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nombre');
            $table->unsignedSmallInteger('limite_residentes');
            $table->boolean('residentes_ilimitados')->default(false);
            $table->unsignedSmallInteger('limite_vigilantes');
            $table->boolean('vigilantes_ilimitados')->default(false);
            $table->unsignedDecimal('precio_mensual', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
