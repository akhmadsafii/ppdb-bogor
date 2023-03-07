<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('username')->unique();
            $table->string('name');
            $table->enum('gender', ['male', 'female']);
            $table->string('religion')->nullable();
            $table->string('file')->nullable()->default('user.png');
            $table->string('phone')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->text('address')->nullable();
            // $table->string('first_password');
            $table->string('password');
            $table->string('social');
            $table->string('last_ip')->nullable();
            $table->dateTimeTz('before_last_login')->nullable();
            $table->dateTimeTz('last_login')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
