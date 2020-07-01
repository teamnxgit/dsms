<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStreetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('gn_division_id');
            $table->unsignedBigInteger('town_id');
            
            $table->timestamps();
        });

        Schema::table('streets', function($table) {
            $table->unique(['gn_division_id','town_id','name']);
            $table->foreign('gn_division_id')->references('id')->on('gn_divisions');
            $table->foreign('town_id')->references('id')->on('towns');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('streets');
    }
}
