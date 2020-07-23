<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumableTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumable_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consumable_id');
            $table->string('type');
            $table->date('date');
            $table->string('from_or_to');
            $table->string('ref_no');
            $table->integer('qty');
            $table->integer('balance');
            $table->timestamps();
        });

        Schema::table('consumable_transactions', function (Blueprint $table) {
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
