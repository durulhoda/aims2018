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
            $table->integer('user_id')->length(11);
            $table->integer('institutetypeid')->length(20)->nullable($value = true);
            $table->integer('institutecategoryid')->length(20)->nullable($value = true);
            $table->integer('institutesubcategoryid')->length(20)->nullable($value = true);
            $table->integer('divisionid')->length(20)->length(20)->nullable($value = true);
            $table->integer('districtid')->length(20)->length(20)->nullable($value = true);
            $table->integer('thanaid')->length(20)->length(20)->nullable($value = true);
            $table->integer('postofficeid')->length(20)->length(20)->nullable($value = true);
            $table->integer('localgovid')->length(20)->length(20)->nullable($value = true);
            $table->string('wordno',50)->length(20)->nullable($value = true);
            $table->string('cluster',50)->length(20)->nullable($value = true);
            $table->bigInteger('ein')->length(20)->length(20)->nullable($value = true);
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
