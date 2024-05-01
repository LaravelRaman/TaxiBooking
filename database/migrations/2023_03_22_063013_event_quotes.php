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
        Schema::create('event_quotes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('event_id')->default('event');
            $table->string('date')->nullable();
            $table->string('event_name')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('starting_point')->nullable();
            $table->bigInteger('vehicle_type')->nullable();
            $table->bigInteger('service_type')->nullable();
            $table->string('destination')->nullable();
            $table->text('message')->nullable();
            $table->integer('quote_price')->nullable();
            $table->text('customer_remarks')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('event_quotes');
    }
};
