<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VariantVariation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variant_variation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('variation_id');
            $table->unsignedBiginteger('variant_id');
            $table->foreign('variation_id')->references('id')->on('variations');
            $table->foreign('variant_id')->references('id')->on('variants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variant_variation');
    }
}
