<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->date('date');
            $table->string('emp_id');
            $table->time('in');
            $table->time('out')->nullable();
            $table->string('note')->nullable();
        });

        Schema::table('attendances', function (Blueprint $table) {
            $table->primary(['date','emp_id']);
            $table->foreign('date')->references('date')->on('calendars');
            $table->foreign('emp_id')->references('emp_id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
