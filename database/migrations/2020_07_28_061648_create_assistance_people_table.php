<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssistancePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistance_people', function (Blueprint $table) {
            $table->unsignedBigInteger('assistance_id');
            $table->unsignedBigInteger('person_id');
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->mediumText('note')->nullable();
            $table->timestamps();
        });

        Schema::table('assistance_people', function (Blueprint $table) {
            $table->primary(['assistance_id','person_id']);
            $table->foreign('assistance_id')->references('id')->on('assistances');
            $table->foreign('person_id')->references('id')->on('people');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assistance_people');
    }
}
