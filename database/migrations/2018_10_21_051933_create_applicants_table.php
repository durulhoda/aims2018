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
            $table->integer('applicantid')->length(11);
            $table->string('name',50);
            $table->integer('genderid')->length(11);
            $table->string('fatherName',50);
            $table->string('motherName',50);
            $table->string('fPhone',50);
            $table->string('mPhone',50);
            $table->string('dob',50);
            $table->string('age',50);
            $table->integer('quotaid')->length(11);
            $table->integer('nationalityid')->length(11);
            $table->integer('religionid')->length(11);
            $table->integer('birthregno')->length(11);
            $table->integer('bloodgroupid')->length(11);
            $table->integer('bloodgroupid')->length(11);
            $table->string('pictureurl',50);
            $table->string('signatueurl',50);
            // $table->integer('userid')->length(11);
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
