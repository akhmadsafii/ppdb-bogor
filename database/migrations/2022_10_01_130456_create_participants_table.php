<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->string('name');
            $table->string('nisn');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->string('religion')->nullable();
            $table->string('file')->nullable()->default('user.png');
            $table->text('address')->nullable();
            $table->string('password');
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('social');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->tinyInteger('register2')->default(0);
            $table->tinyInteger('decision')->default(2);
            $table->text('decision_statement')->nullable();
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
        Schema::dropIfExists('participants');
    }
}
