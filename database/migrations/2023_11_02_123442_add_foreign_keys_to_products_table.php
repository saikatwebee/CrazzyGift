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
        Schema::table('products', function (Blueprint $table) {
            $table->foreign(['main_category'], 'products_ibfk_1')->references(['id'])->on('main_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['L3_category'], 'products_ibfk_3')->references(['id'])->on('l3_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['sub_category'], 'products_ibfk_2')->references(['id'])->on('sub_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_ibfk_1');
            $table->dropForeign('products_ibfk_3');
            $table->dropForeign('products_ibfk_2');
        });
    }
};
