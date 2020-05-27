<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('gender',6);
            $table->string('gn_division_id',10);
            $table->string('town',10);
            $table->string('nic',15)->unique()->nullable();

            $table->string('name_with_initials')->nullable();
            $table->string('maritial_status', 10)->nullable();
            $table->date('dob')->nullable();
            $table->string('dl',15)->unique()->nullable();
            $table->string('passport',15)->unique()->nullable();
            $table->string('ethnicity')->nullable();
            $table->string('religion')->nullable();
            $table->string('education_level')->nullable();
            $table->string('current_education')->nullable();
            $table->string('computer_literacy')->nullable();
            $table->string('mobile_no',10)->nullable();
            $table->string('land_phone_no',10)->nullable();
            $table->string('email',10)->nullable();

            $table->boolean('is_head_of_family')->nullable()->default(false);
            $table->integer('vote_list_serial')->nullable();
            $table->string('house_id',10)->nullable();
            $table->string('residence_status')->nullable();
            
            $table->string('occupation_id')->nullable();
            $table->double('monthly_income', 10, 2)->nullable();
            $table->longText('occupation_note')->nullable();
           
            

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
        Schema::dropIfExists('people');
    }
}