<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->date('date');
            $table->string('emp_id');
            $table->string('type_of_leave');
            $table->string('acting')->nullable();
            $table->decimal('no_of_leave',1,1);
            $table->string('note')->nullable();

            $table->boolean('leave_note')->nullable();
            $table->boolean('leave_register')->nullable();
            $table->integer('leave_note_serial')->nullable();
        });

        Schema::table('leaves', function (Blueprint $table) {
            $table->primary(['date','emp_id']);
            $table->foreign('date')->references('date')->on('calendars');
            $table->foreign('emp_id')->references('emp_id')->on('employees');
            $table->foreign('acting')->references('emp_id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leaves');
    }
}
