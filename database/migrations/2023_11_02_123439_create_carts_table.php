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
        Schema::create('carts', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedBigInteger('user_id')->index('user_id');
            $table->unsignedBigInteger('product_id')->index('carts_ibfk_2');
            $table->integer('quantity');
            $table->string('pincode')->nullable();
            $table->string('custom_text', 455)->nullable();
            $table->string('custom_image', 455)->nullable();
            $table->integer('status')->default(1)->comment('0:Active
1:Deactive');
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
        Schema::dropIfExists('carts');
    }
};
