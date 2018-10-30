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
            $table->integer('sessionid')->length(11);
            $table->integer('programid')->length(11);
            $table->integer('mediumid')->length(11);
            $table->integer('shiftid')->length(11);
            $table->integer('applicantSeat')->length(11);
            $table->integer('quota')->length(11);
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
