<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->ipAddress('ip');
            $table->integer('delivery');
            $table->unsignedBigInteger('method_id');
            $table->string('notes')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('street')->nullable();
            $table->enum('state', ['NEW', 'PENDING_PAYMENT', 'PROCESSING', 'DELIVERING', 'CANCELED', 'CLOSED']);
            $table->string('paypal_payment_id')->nullable();
            $table->string('paypal_payer_id')->nullable();
            $table->string('paypal_capture_id')->nullable();
            $table->string('floor')->nullable();
            $table->unsignedBigInteger('reference_order_id')->nullable();
            $table->foreign('reference_order_id')->references('id')->on('orders');
            $table->unsignedBigInteger('rate_id')->nullable();
            $table->foreign('rate_id')->references('id')->on('rates');
            $table->unsignedBigInteger('refund_rate_id')->nullable();
            $table->foreign('refund_rate_id')->references('id')->on('rates');

            $table->unsignedBigInteger('postcode_id')->nullable();
            $table->foreign('postcode_id')->references('id')->on('postcodes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
