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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('rand_id');
            $table->foreignId('user_id')->nullable()->constraint();
            $table->foreignId('vehicle_id')->constraint();
            $table->string('origin_id')->comment('id to address table');
            $table->string('destination_id')->comment('id to address table');
            $table->datetime('datetime');
            $table->string('flightnr', 10)->nullable();
            $table->tinyInteger('people');
            $table->string('payment_method')->comment('cash/pin');
            $table->tinyInteger('luggage');
            $table->tinyInteger('handluggage');
            $table->string('comments')->nullable();
            $table->unsignedMediumInteger('price');
            $table->unsignedSmallInteger('distance')->comment('in km');
            $table->unsignedSmallInteger('duration')->comment('in min');
            $table->string('status', 12)->default('new');
            $table->string('google_calendar_event_id')->nullable(); // initially set to null, later updated when event is created
            $table->foreignId('retour_id')->nullable()->comment('the reservation_id of its retour.');
            $table->tinyInteger('is_retour')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
