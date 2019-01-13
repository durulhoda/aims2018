<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('programofferid')->length(20);
            $table->integer('applicantid')->length(20);
            $table->string('name',50);
            $table->string('fatherName',50);
            $table->string('motherName',50);
            $table->integer('divisionid')->length(20);
            $table->integer('districtid')->length(20);
            $table->integer('thanaid')->length(20);
            $table->integer('postofficeid')->length(20);
            $table->integer('localgovid')->length(20);
            $table->integer('presentaddress')->length(20);
            $table->integer('permanentaddress')->length(20);
            $table->string('pictureurl',50);
            $table->string('signatueurl',50);
            $table->integer('userid')->length(11);
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
        Schema::dropIfExists('applicants');
    }
}
