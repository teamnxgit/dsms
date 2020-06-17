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
        Schema::create('households', function (Blueprint $table) {
            $table->id();
            $table->string('house_no');
            $table->unsignedBigInteger('town_id');
            $table->unsignedBigInteger('street_id');
            $table->unsignedBigInteger('gn_division_id');
            $table->string('owner')->nullable();
            $table->string('gps')->nullable();
            $table->timestamps();
        });

        Schema::table('households', function($table){
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
        Schema::dropIfExists('households');
    }
}
