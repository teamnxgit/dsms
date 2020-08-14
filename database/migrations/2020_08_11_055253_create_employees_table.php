<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('emp_id');
            $table->string('enroll_id')->unique();
            $table->string('full_name_e');
            $table->string('full_name_s')->nullable();
            $table->string('full_name_t')->nullable();
            $table->string('short_name')->nullable();
            $table->string('gender');
            $table->date('dob');
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            
            $table->string('appoinment')->nullable();
            $table->date('first_apppointment_date')->nullable();
            $table->date('joint')->nullable();
            $table->string('designation')->nullable();
            $table->string('appointed_by')->nullable();
            $table->string('appoinment_letter_no')->nullable();


            $table->time('expected_arrival');
            $table->time('expected_work_time');
            $table->boolean('is_attendance_required')->default(1);
            $table->string('status')->default('In Service');
            $table->unsignedBigInteger('system_user_id')->nullable();

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->primary('emp_id');
            $table->foreign('system_user_id')->references('id')->on('users');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
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
