<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilityHouseholdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_household', function (Blueprint $table) {
            $table->unsignedBigInteger('facility_id');
            $table->unsignedBigInteger('household_id');
            $table->longText('description')->nullable();
            $table->timestamps();
        });

        Schema::table('facility_household', function($table){
            $table->primary(['facility_id','household_id']);
            $table->foreign('facility_id')->references('id')->on('facilities');
            $table->foreign('household_id')->references('id')->on('households');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facility_household');
    }
}
