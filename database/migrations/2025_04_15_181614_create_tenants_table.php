<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nombre_residencial');
            $table->uuid('plan_id')->nullable();
            $table->foreign('plan_id')->references('id')->on('plans');
            $table->string('stripe_customer_id')->nullable();
            $table->boolean('activo')->default(true);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
