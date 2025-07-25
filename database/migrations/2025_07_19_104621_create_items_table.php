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
        Schema::create('items', function (Blueprint $table) {
        $table->id();
        $table->string('old')->nullable();
        $table->string('new')->nullable();
        $table->string('description');
        $table->date('date');
        $table->decimal('cost', 10, 2);
        $table->string('location');
        $table->string('person');
        $table->string('stock_quantity');
        $table->string('type');
        $table->string('remarks')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};