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
        Schema::create('fuel_allocations', function (Blueprint $table) {
            $table->id();
            $table->string('po_number');
            $table->date('date'); // Date of allocation
            $table->string('terms');
            $table->string('fuel_type'); // Diesel, Premium, Unleaded
            $table->string('office');
            $table->string('allocated_liters');
            $table->string('remarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuel_allocations');
    }
};
