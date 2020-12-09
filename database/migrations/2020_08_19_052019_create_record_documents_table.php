<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('record_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bundle_id'); //foreign Key
            $table->string('name');
            $table->string('number');
            $table->string('year');
            $table->string('color');
            $table->longText('decription');
            $table->timestamps();
        });

        Schema::table('record_documents', function (Blueprint $table) {
            $table->foreign('bundle_id')->references('id')->on('record_bundles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('record_documents');
    }
}
