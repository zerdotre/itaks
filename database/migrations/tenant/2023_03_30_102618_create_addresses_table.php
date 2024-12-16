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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('user_id')->nullable();
            $table->string('place_id');
            $table->string('type');
            $table->string('lat');
            $table->string('lng');
            $table->string('country');
            $table->string('postal_code');
            $table->string('locality');
            $table->string('administrative_area_level_2')->nullable();
            $table->string('route')->nullable();
            $table->string('airport')->nullable();
            $table->string('street_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
