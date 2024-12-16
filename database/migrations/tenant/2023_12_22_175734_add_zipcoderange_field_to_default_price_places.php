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
        Schema::table('default_price_places', function (Blueprint $table) {
            $table->string('zipcoderange_to')->nullable()->comment('eg: name=1361, zipcoderange_to=1366 all zipcodes between 1361-1366 INCLUSIVE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('default_price_places', function (Blueprint $table) {
            //
        });
    }
};
