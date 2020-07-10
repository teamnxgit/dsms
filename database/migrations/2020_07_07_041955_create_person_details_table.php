<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_details', function (Blueprint $table) {
            $table->unsignedBigInteger('person_id');

            $table->string('driving_license',15)->unique()->nullable();
            $table->string('passport',15)->unique()->nullable();

            $table->string('name_with_initials')->nullable();
            $table->string('maritial_status', 10)->nullable();
            $table->date('dob')->nullable();

            $table->string('ethnicity')->nullable();
            $table->string('religion')->nullable();

            $table->string('education_level')->nullable();
            $table->string('computer_literacy')->nullable();

            $table->string('mobile_no',10)->nullable();
            $table->string('land_phone_no',10)->nullable();
            $table->string('email',10)->nullable();

            $table->boolean('is_head_of_family')->nullable()->default(false);
            $table->integer('vote_list_serial')->nullable();
            $table->string('residence_status')->nullable();

            $table->timestamps();
        });

        Schema::table('person_details', function ($table) {
            $table->primary('person_id');
            $table->foreign('person_id')->references('id')->on('people');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person_details');
    }
}
