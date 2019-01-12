<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramofferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programoffer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('instituteid')->length(20);
            $table->integer('sessionid')->length(20);
            $table->integer('programid')->length(20);
            $table->integer('groupid')->length(20);
            $table->integer('mediumid')->length(20);
            $table->integer('shiftid')->length(20);
            $table->integer('status')->length(5)->default(0);
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
        Schema::dropIfExists('programoffer');
    }
}
