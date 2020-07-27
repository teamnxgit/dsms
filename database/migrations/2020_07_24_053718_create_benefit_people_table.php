<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBenefitPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benefit_people', function (Blueprint $table) {
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('benefit_id');
            $table->longText('note')->nullable();
            $table->date('date')->nullable();
            $table->string('current_status')->nullable();
            $table->timestamps();
        });

        Schema::table('benefit_people', function (Blueprint $table) {
            $table->primary(['person_id','benefit_id']);
            $table->foreign('person_id')->references('id')->on('people');
            $table->foreign('benefit_id')->references('id')->on('benefits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('benefit_people');
    }
}
