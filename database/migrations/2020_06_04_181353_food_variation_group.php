<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FoodVariationGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_variation_group', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('variation_group_id');
            $table->unsignedBiginteger('food_id');
            $table->foreign('variation_group_id')->references('id')->on('variation_groups');
            $table->foreign('food_id')->references('id')->on('food');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_variation_group');
    }
}
