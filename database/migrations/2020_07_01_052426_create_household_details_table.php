<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseholdDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('household_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('household_id');
            $table->unsignedBigInteger('house_detail_type_id');
            $table->string('detail');
            $table->timestamps();
        });

        Schema::table('household_details',function ($table){
            $table->foreign('household_id')->references('id')->on('households');
            $table->foreign('house_detail_type_id')->references('id')->on('house_detail_types');
            $table->unique(['household_id','house_detail_type_id'],'household');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('household_details');
    }
}
