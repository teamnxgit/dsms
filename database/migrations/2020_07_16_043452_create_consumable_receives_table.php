<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumableReceivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumable_receives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consumable_id');
            $table->date('date');
            $table->string('from');
            $table->string('bill_no');
            $table->integer('qty_received');
            $table->integer('balance');
            $table->timestamps();
        });

        Schema::table('consumable_receives', function (Blueprint $table) {
            $table->foreign('consumable_id')->references('id')->on('consumables');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('consumable_receives');
    }
}
