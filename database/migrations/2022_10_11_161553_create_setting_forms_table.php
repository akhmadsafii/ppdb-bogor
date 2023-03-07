<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->integer('id_type');
            $table->string('initial');
            $table->string('name');
            $table->enum('type', ['text', 'textarea', 'date', 'option'])->default('text');
            $table->integer('order_form')->nullable();
            $table->integer('order_card')->nullable();
            $table->tinyInteger('status_card')->default(0);
            $table->tinyInteger('status_form')->default(0);
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
        Schema::dropIfExists('setting_forms');
    }
}
