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
            $table->string('sku', 155);
            $table->integer('main_category')->nullable()->index('main_category');
            $table->integer('sub_category')->nullable()->index('sub_category');
            $table->integer('L3_category')->nullable()->index('L3_category');
            $table->string('description', 455)->nullable();
            $table->string('product_image')->nullable();
            $table->string('product_alt_image1')->nullable();
            $table->string('product_alt_image2')->nullable();
            $table->string('product_alt_image3')->nullable();
            $table->string('product_type', 125)->nullable();
            $table->string('weight', 125)->comment('in Kg');
            $table->string('height', 125)->comment('in cm');
            $table->string('length', 125)->comment('in cm');
            $table->string('breadth', 125)->comment('in cm
');
            $table->string('product_height', 125);
            $table->string('product_length', 125);
            $table->string('product_breadth', 125);
            $table->integer('price');
            $table->string('gst')->nullable();
            $table->string('discount', 100)->nullable();
            $table->integer('sale')->default(0);
            $table->integer('status')->default(1)->comment('2:Deactive
1:Active
');
            $table->timestamps();
            $table->string('slug');
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
