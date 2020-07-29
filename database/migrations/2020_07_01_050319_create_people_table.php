<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();

            $table->string('full_name');
            $table->string('gender',6);
            $table->unsignedBigInteger('gn_division_id');
            $table->unsignedBigInteger('town_id');
            $table->string('nic')->unique()->nullable();
            $table->unsignedBigInteger('household_id')->nullable();
            $table->string('status')->default('Alive')->nullable();
            $table->timestamps();
        });

        Schema::table('people', function ($table) {
            $table->foreign('gn_division_id')->references('id')->on('gn_divisions');
            $table->foreign('town_id')->references('id')->on('towns');
            $table->foreign('household_id')->references('id')->on('households');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('people');
    }
}
