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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('type')->default('event');
            $table->integer('title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();
            $table->time('event_name')->nullable();
            $table->string('slug')->nullable();
            $table->integer('event_slug')->nullable();
            $table->integer('event_text')->default('Distance Wise Rate');
            $table->integer('status')->nullable();
            $table->float('from_date')->nullable();
            $table->float('to_date')->nullable();
            $table->float('location')->nullable();
            $table->double('price_multiplier')->nullable();
            $table->float('banner_image')->nullable();
            $table->float('thumbnail')->nullable();
            $table->text('description')->nullable();
            $table->text('long_description')->nullable();
            $table->float('tags')->nullable();
            $table->integer('sno')->nullable();
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
        Schema::dropIfExists('events');
    }
};
