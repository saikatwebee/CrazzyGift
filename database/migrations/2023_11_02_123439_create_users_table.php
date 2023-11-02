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
            $table->string('phone', 125)->nullable()->unique('phone');
            $table->integer('otp')->nullable();
            $table->string('password');
            $table->string('google_id', 455)->nullable();
            $table->integer('status')->default(1)->comment('1 : Active
2 : Deactive');
            $table->integer('is_verified')->default(0)->comment('1:Verified 
0: Not Verified');
            $table->timestamps();
            $table->string('profile_image')->nullable();
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
