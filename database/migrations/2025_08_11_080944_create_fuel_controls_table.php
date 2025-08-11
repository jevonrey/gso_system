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
       Schema::create('fuel_controls', function (Blueprint $table) {
    $table->id();
    $table->date('date');
    $table->string('ticket_number')->nullable();
    $table->string('plate_no');
    $table->decimal('distance', 8, 2)->nullable();
    $table->decimal('gas_consumed', 8, 2)->nullable();
    $table->string('office')->nullable();
    $table->string('driver')->nullable();
    $table->text('remarks')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuel_controls');
    }
};
