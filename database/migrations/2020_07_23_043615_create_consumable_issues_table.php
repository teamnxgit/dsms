<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumableIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumable_issues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consumable_id');
            $table->date('date');
            $table->unsignedBigInteger('to');
            $table->string('req_no');
            $table->integer('qty_issued');
            $table->integer('balance');
            $table->timestamps();
        });

        Schema::table('consumable_issues', function (Blueprint $table) {
            $table->foreign('consumable_id')->references('id')->on('consumables');
            $table->foreign('to')->references('id')->on('branches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consumable_issues');
    }
}
