<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVulnerabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vulnerabilities', function (Blueprint $table) {
            $table->id();
            $table->longText('note');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('vulnerablity_type_id'); // Type of Vulnerability ()
            $table->unsignedBigInteger('vulnerable_id');        // Model instance ID (Household ID / Person ID)
            $table->string('vulnerable_type');                  // Moddel Name
            $table->timestamps();
        });
        
        Schema::table('vulnerabilities', function ($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('vulnerablity_type_id')->references('id')->on('vulnerability_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vulnerabilities');
    }
}
