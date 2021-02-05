<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('price');
            $table->integer('tax_rate');
            $table->boolean('default');
            $table->softDeletes();
            $table->unsignedBigInteger('extra_group_id')->nullable();
            $table->foreign('extra_group_id')->references('id')->on('extra_groups');
            $table->unsignedBigInteger('food_id');
            $table->foreign('food_id')->references('id')->on('food');
            // ALTER TABLE `variants` ADD `tax_rate` INT NOT NULL AFTER `price`;
            // UPDATE `variants` SET `tax_rate`=7
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variants');
    }
}
