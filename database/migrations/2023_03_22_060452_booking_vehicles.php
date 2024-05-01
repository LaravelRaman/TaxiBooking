<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_vehicles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('booking_id');
            $table->integer('vehicle_type_id');
            $table->string('vehicle_type');
            $table->text('vehicle_type_description');
            $table->time('vehicle_type_image')->nullable();
            $table->string('status')->nullable();
            $table->integer('no_of_child')->nullable();
            $table->integer('no_of_passengers')->default('Distance Wise Rate');
            $table->integer('no_of_suitcases')->nullable();
            $table->float('base_price')->nullable();
            $table->float('price_per_min')->nullable();
            $table->float('price_per_hour')->nullable();
            $table->float('price_per_km')->nullable();
            $table->float('extra_waiting_time')->nullable();
            $table->float('minimum_charge')->nullable();
            $table->float('minimum_hour')->nullable();
            $table->float('international_airport_pickup_charges')->nullable();
            $table->float('domestic_airport_pickup_charges')->default(0);
            $table->float('child_seat_charges')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_vehicles');
    }
};
