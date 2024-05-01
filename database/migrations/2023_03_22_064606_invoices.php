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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('booking_id')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('invoice_date')->nullable();
            $table->string('bill_to_name')->nullable();
            $table->text('billing_addr')->nullable();
            $table->string('abn_number')->nullable();
            $table->longText('international_airport_pickup_detail')->nullable();
            $table->longText('domestic_airport_pickup_detail')->nullable();
            $table->float('total_amount')->nullable();
            $table->float('gst')->nullable();
            $table->float('discount')->nullable();
            $table->float('net_amount')->nullable();
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
        Schema::dropIfExists('invoices');
    }
};
