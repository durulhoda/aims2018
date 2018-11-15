<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->string('employeeid',255);
            $table->integer('employeetypeid')->length(20);
            $table->timestamps();
        });
        // Schema::create('employees', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->bigInteger('employeeId')->length(16);
        //     $table->string('firstName',255);
        //     $table->string('middleName',255);
        //     $table->string('lastName',255);
        //     $table->integer('gender')->length(4);
        //     $table->string('photo',13);
        //     $table->string('phone',20);
        //     $table->string('email',20);
        //     $table->string('fatherName',50);
        //     $table->string('motherName',50);
        //     $table->integer('maritialStatus')->length(11);
        //     $table->string('nationalIdentity',50);
        //     $table->string('nationality',50);
        //     $table->date('dateOfBirth');
        //     $table->integer('bloodGroupid')->length(11);
        //     $table->string('address',255);
        //     $table->integer('employmentStatus')->length(11);
        //     $table->integer('employeeStatus')->length(11);
        //     $table->integer('employeeType')->length(11);
        //     $table->string('embreg',50);
        //     $table->date('joiningdate');
        //     $table->date('retirementDate');
        //     $table->integer('departmentId')->length(11);
        //     $table->bigInteger('designationid')->length(11);
        //     $table->integer('positionNumber')->length(11);
        //     $table->integer('indexno')->length(11);
        //      $table->integer('status')->length(5)->default(0);
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
