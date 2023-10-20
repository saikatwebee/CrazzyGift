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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 125);
            $table->string('code');
            $table->integer('main_category')->nullable()->index('main_category');
            $table->integer('sub_category')->nullable()->index('sub_category');
            $table->integer('L3_category')->nullable()->index('L3_category');
            $table->string('description')->nullable();
            $table->string('product_image')->nullable();
            $table->string('product_alt_image1')->nullable();
            $table->string('product_alt_image2')->nullable();
            $table->string('product_alt_image3')->nullable();
            $table->string('product_type', 125)->nullable();
            $table->string('weight', 125);
            $table->string('height', 125);
            $table->string('length', 125);
            $table->string('breadth', 125);
            $table->integer('price');
            $table->string('gst')->nullable();
            $table->string('discount', 100)->nullable();
            $table->integer('sale')->default(0);
            $table->integer('status')->default(1)->comment('0:Deactive
1:Active
2:Best Selling');
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
        Schema::dropIfExists('products');
    }
};
