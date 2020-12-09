<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordBundlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('record_bundles', function (Blueprint $table) {
            $table->id();
            $table->string('serial_no')->unique();
            $table->string('name');
            $table->string('number');
            $table->string('year');
            $table->string('branch');
            $table->string('color');
            $table->longText('note')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('record_bundles');
    }
}
