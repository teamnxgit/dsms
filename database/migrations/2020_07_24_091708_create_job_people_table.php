<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_people', function (Blueprint $table) {
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('job_id');
            $table->decimal('income',10,2);
            $table->string('note');
            $table->timestamps();
        });

        Schema::table('job_people', function (Blueprint $table) {
            $table->primary(['person_id','job_id']);
            $table->foreign('person_id')->references('id')->on('people');
            $table->foreign('job_id')->references('id')->on('jobs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_people');
    }
}
