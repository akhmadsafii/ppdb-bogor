<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_participants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->integer('id_participant');
            $table->string('payment_method');
            $table->biginteger('nominal');
            $table->string('on_behalf')->nullable();
            $table->string('destination_bank')->nullable();
            $table->string('home_bank')->nullable();
            $table->string('account_number')->nullable();
            $table->text('description')->nullable();
            $table->string('proof')->nullable();
            $table->date('pay_date');
            $table->tinyInteger('payment_status')->default(0);
            $table->string('school_year');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('payment_participants');
    }
}
