<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('fuel_controls', function (Blueprint $table) {
            $table->string('gas_type')->nullable()->after('gas_consumed');
        });
    }

    public function down()
    {
        Schema::table('fuel_controls', function (Blueprint $table) {
            $table->dropColumn('gas_type');
        });
    }
};

