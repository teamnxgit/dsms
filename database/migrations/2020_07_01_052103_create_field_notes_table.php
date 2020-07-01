<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_notes', function (Blueprint $table) {
            $table->id();
            $table->string('heading');
            $table->longText('note');
            $table->date('field_date');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('notable_id');
            $table->string('notable_type');
            $table->timestamps();
        });

        Schema::table('field_notes', function($table){
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('field_notes');
    }
}
