<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseHoldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_holds', function (Blueprint $table) {
            $table->id();
            $table->string('house_no');
            $table->unsignedBigInteger('town_id');
            $table->unsignedBigInteger('street_id');
            $table->unsignedBigInteger('gn_division_id');
            $table->string('owner')->nullable();
            $table->string('gps')->nullable();

            $table->string('water_source')->nullable();
            $table->string('electricity_source')->nullable();
            $table->string('cooking_stove')->nullable();

            $table->string('solid_waste')->nullable();
            $table->string('toilet')->nullable();
            $table->string('dengue_prevention')->nullable();

            $table->string('disaster')->nullable();
            $table->longtext('note')->nullable();
            $table->timestamps();
        });

        Schema::table('house_holds', function($table){
            $table->foreign('town_id')->references('id')->on('towns');
            $table->foreign('street_id')->references('id')->on('streets');
            $table->foreign('gn_division_id')->references('id')->on('gn_divisions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('house_holds');
    }
}
