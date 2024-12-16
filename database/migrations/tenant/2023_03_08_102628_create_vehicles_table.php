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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('img')->nullable();
            $table->unsignedInteger('price_km');
            $table->unsignedInteger('price_min');
            $table->unsignedInteger('price_start');
            $table->unsignedInteger('price_waypoint')->comment('for every waypoint, extra costs');
            $table->unsignedInteger('price_minimum')->comment('Minimumprice for a ride with this vehicle');
            $table->unsignedInteger('max_people');
            $table->unsignedInteger('max_luggage');

            $table->string('label_1')->nullable();
            $table->string('label_2')->nullable();
            $table->string('label_3')->nullable();
            $table->string('label_4')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
