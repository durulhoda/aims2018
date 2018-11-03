<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstituteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institute', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->integer('institutetypeid')->length(20);
            $table->integer('institutecategoryid')->length(20);
            $table->integer('institutesubcategoryid')->length(20)->nallable();
            $table->integer('divisionid')->length(20);
            $table->integer('districtid')->length(20);
            $table->integer('thanaid')->length(20);
            $table->integer('postofficeid')->length(20);
            $table->integer('localgovid')->length(20);
            $table->string('wordno',50);
            $table->string('cluster',50);
            $table->bigInteger('ein')->length(20);
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
        Schema::dropIfExists('institute');
    }
}
