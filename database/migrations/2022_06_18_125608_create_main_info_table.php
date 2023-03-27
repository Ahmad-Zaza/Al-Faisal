<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tel_number')->nullable();
            $table->string('mob_number')->nullable();
            $table->string('website_url')->nullable();
            $table->longText('ar_main_address')->nullable();
            $table->longText('en_main_address')->nullable();
            $table->longText('ar_sub_address')->nullable();
            $table->longText('en_sub_address')->nullable();
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
        Schema::dropIfExists('main_info');
    }
}
