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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('username', 455)->unique('username');
            $table->string('email')->nullable();
            $table->string('phone', 125)->nullable();
            $table->integer('otp')->nullable();
            $table->string('password');
            $table->string('google_id', 455)->nullable();
            $table->integer('address_id')->nullable()->index('address_id');
            $table->integer('status')->default(1)->comment('1 : Active
2 : Deactive');
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
        Schema::dropIfExists('users');
    }
};
