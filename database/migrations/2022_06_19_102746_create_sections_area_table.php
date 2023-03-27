<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections_area', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('first_box_ar_title')->nullable();
            $table->longText('first_box_ar_para')->nullable();
            $table->longText('first_box_en_title')->nullable();
            $table->longText('first_box_en_para')->nullable();
            $table->longText('second_box_ar_title')->nullable();
            $table->longText('second_box_ar_para')->nullable();
            $table->longText('second_box_en_title')->nullable();
            $table->longText('second_box_en_para')->nullable();
            $table->string('image');
            $table->integer('section_id');
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
        Schema::dropIfExists('sections_area');
    }
}
