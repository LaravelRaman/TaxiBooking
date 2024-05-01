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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_slug')->nullable();
            $table->string('service_type')->nullable();
            $table->integer('booking_event')->nullable();
            $table->date('booking_date')->nullable();
            $table->time('booking_time')->nullable();
            $table->date('return_date')->nullable();
            $table->time('return_time')->nullable();
            $table->string('booking_transfer_type')->default('Distance Wise Rate');
            $table->string('booking_booking_type')->nullable();
            $table->float('booking_extra_hours')->nullable();
            $table->float('distance')->nullable();
            $table->float('duration')->nullable();
            $table->string('s_latitude')->nullable();
            $table->string('s_longitude')->nullable();
            $table->string('d_latitude')->nullable();
            $table->string('d_longitude')->nullable();
            $table->integer('vehicle_type')->nullable();
            $table->tinyInteger('is_international_airport_pickup_charges')->default(0);
            $table->integer('international_airport_pickup_nos')->nullable();
            $table->longText('international_airport_pickup_detail')->nullable();
            $table->tinyInteger('is_domestic_airport_pickup_charges')->default(0);
            $table->integer('domestic_airport_pickup_nos')->nullable();
            $table->longText('domestic_airport_pickup_detail')->nullable();
            $table->tinyInteger('is_child_seat_charges')->default(0);
            $table->integer('child_seat_nos')->nullable();
            $table->tinyInteger('is_extra_hours_charges')->default(0);
            $table->integer('extra_hours_nos')->default(0);
            $table->string('booking_for')->nullable();
            $table->string('company_person')->nullable();
            $table->bigInteger('booking_by')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('booking_from')->nullable();
            $table->string('booking_to')->nullable();
            $table->string('total_price')->nullable();
            $table->string('booking_discount')->nullable();
            $table->string('status')->nullable();
            $table->string('payment_status')->default('pending');
            $table->bigInteger('payment_id')->nullable();
            $table->text('remarks')->nullable();
            $table->text('waypoint')->nullable();
            $table->string('bill_to_name')->nullable();
            $table->text('billing_addr')->nullable();
            $table->string('abn_number')->nullable();
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
        Schema::dropIfExists('bookings');
    }
};
