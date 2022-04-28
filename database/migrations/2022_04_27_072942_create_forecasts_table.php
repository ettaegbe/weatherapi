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
        Schema::create('forecasts', function (Blueprint $table) {
            $table->id();
            $table->integer('city_id');
            $table->double('temp')->nullable();
            $table->double('temp_min')->nullable();
            $table->double('temp_max')->nullable();
            $table->double('pressure')->nullable();
            $table->double('humidity')->nullable();
            $table->double('wind_speed')->nullable();
            $table->double('wind_deg')->nullable();
            $table->string('wind_direction')->nullable();
            $table->string("condition_name")->nullable();
            $table->string("condition_description")->nullable();
            $table->string("condition_icon")->nullable();
            $table->string("timestamp")->nullable();
            $table->string("timestamp_sunrise")->nullable();
            $table->string("timestamp_sunset")->nullable();
            $table->string("formatted_date")->nullable();
            $table->string("formatted_day")->nullable();
            $table->string("formatted_time")->nullable();
            $table->string("formatted_sunrise")->nullable();
            $table->string("formatted_sunset")->nullable();
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
        Schema::dropIfExists('forecasts');
    }
};
