<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('name_school');
            $table->string('name_program');
            $table->string('logo_school')->nullable();
            $table->string('head1');
            $table->string('head2');
            $table->string('head3');
            $table->text('address');
            $table->text('prologue');
            $table->text('closing');
            $table->string('logo1')->nullable();
            $table->string('logo2')->nullable();
            $table->string('stamp')->nullable();
            $table->string('signature_headmaster')->nullable();
            $table->string('name_headmaster');
            $table->string('degree')->nullable();
            $table->string('nip_headmaster')->nullable();
            $table->string('decision_place');
            $table->date('decision_date');
            $table->string('school_year');
            $table->date('closing_date');
            $table->string('closing_hour')->nullable();
            $table->dateTimeTz('open_date')->nullable();
            $table->tinyInteger('status_open')->default(0);
            $table->string('quota')->nullable();
            $table->text('major')->nullable();
            $table->text('track_ppdb')->nullable();
            $table->string('login_requirement')->nullable();
            $table->string('copyright');
            $table->string('phone')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('whatsapp')->nullable();
            $table->integer('max_distance')->nullable();
            $table->string('semester')->nullable();
            $table->tinyInteger('auto_number')->default(1);
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
        Schema::dropIfExists('settings');
    }
}
