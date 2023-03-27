<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string("info_name_ar")->nullable();
            $table->string("info_name_en")->nullable();
            $table->integer("info_count")->nullable();
            $table->string("sorting")->nullable();
            $table->integer('active')->nullable();
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
        Schema::dropIfExists('about_info');
    }
}
