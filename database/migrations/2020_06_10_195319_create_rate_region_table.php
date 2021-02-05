<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRateRegionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rate_region', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('rate_id');
            $table->unsignedBiginteger('region_id');
            $table->foreign('rate_id')->references('id')->on('rates');
            $table->foreign('region_id')->references('id')->on('regions');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rate_region');
    }
}
