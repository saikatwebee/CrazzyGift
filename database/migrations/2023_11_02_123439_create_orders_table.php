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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_id')->unique();
            $table->unsignedBigInteger('user_id')->index('user_id');
            $table->json('product_details');
            $table->decimal('amount', 10);
            $table->string('payment_status');
            $table->tinyInteger('order_status')->nullable()->comment('0 :order Cancelled,
1: Order Placed
2: Order Shipped
3: Reached Hub
4: Out for Delivery
5: Order Delivered');
            $table->text('billing_address');
            $table->text('shipping_address');
            $table->timestamps();
            $table->string('awb')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('invoice')->nullable();
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
};
