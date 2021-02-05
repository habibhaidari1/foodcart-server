<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityPostcodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_postcode', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('city_id');
            $table->unsignedBiginteger('postcode_id');
            $table->foreign('postcode_id')->references('id')->on('postcodes');
            $table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('city_postcode');
    }
}
