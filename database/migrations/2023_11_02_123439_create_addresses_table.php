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
        Schema::create('addresses', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedBigInteger('user_id')->index('user_id');
            $table->string('name', 150)->nullable();
            $table->string('company_name', 125)->nullable();
            $table->string('gst', 125)->nullable();
            $table->string('phone', 125)->nullable();
            $table->string('street_address1')->nullable();
            $table->string('street_address2', 455)->nullable();
            $table->string('street_address3')->nullable();
            $table->string('address_type', 125)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->string('landmark', 455)->nullable();
            $table->string('alternate_phone', 100)->nullable();
            $table->boolean('is_shipping_address')->nullable();
            $table->boolean('is_billing_address')->nullable();
            $table->integer('status')->default(1)->comment('0:Inactive
1:Active
2:Selected');
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
        Schema::dropIfExists('addresses');
    }
};
