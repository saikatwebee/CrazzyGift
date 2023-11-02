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
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('content')->nullable();
            $table->integer('main_category')->nullable()->index('main_category');
            $table->integer('sub_category')->nullable()->index('sub_category');
            $table->integer('status')->default(0)->comment('0 : Static
1 : Dynamic
2: Show all Products
3: Show Product with Price range
4:Home
');
            $table->string('product_price_range')->nullable()->comment('Fetch all products');
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
        Schema::dropIfExists('pages');
    }
};
