<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $fillable = ['type','name'];
    public function up()
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type');
            $table->string('name');
            $table->timestamps();

            $table->foreign('type')->references('id')->on('facility_types');
            $table->unique(['type','name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facilities');
    }
}
