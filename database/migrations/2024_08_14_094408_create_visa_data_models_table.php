<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisaDataModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visa_data_models', function (Blueprint $table) {
            $table->id();
            $table->integer('code');
            $table->string('user_id');
            $table->string('country_id')->nullable();
            $table->string('branch_id')->nullable();
            $table->string('nationality')->nullable();
            $table->string('Email')->nullable();
            $table->string('journeydate')->nullable();
            $table->string('birthday')->nullable();
            $table->string('visa_type')->nullable();
            $table->string('surname')->nullable();
            $table->string('given_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('b_city')->nullable();
            $table->string('b_country')->nullable();
            $table->string('National_id')->nullable();
            $table->string('religion')->nullable();
            $table->string('visible_identification')->nullable();
            $table->string('educational_qualification')->nullable();
            $table->string('naturalization')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('place_of_issue')->nullable();
            $table->string('date_of_issue')->nullable();
            $table->string('date_of_expiry')->nullable();
            $table->string('another_passport_country')->nullable();
            $table->string('another_passport_no')->nullable();
            $table->string('another_passport_issu_date')->nullable();
            $table->string('another_passport_issu_place')->nullable();
            $table->string('another_passport_nationality')->nullable();
            $table->string('present_address_street')->nullable();
            $table->string('present_address_city')->nullable();
            $table->string('present_address_district')->nullable();
            $table->string('present_address_zipcode')->nullable();
            $table->string('present_address_phone')->nullable();
            $table->string('present_address_mobile')->nullable();
            $table->string('permanent_address_street')->nullable();
            $table->string('permanent_address_city')->nullable();
            $table->string('present_address_country')->nullable();
            $table->string('permanent_address_distric')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_phone')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_phone')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('present_occupation')->nullable();
            $table->string('present_busibess_name')->nullable();
            $table->string('present_busibess_designation')->nullable();
            $table->string('present_busibess_address')->nullable();
            $table->string('present_busibess_phone')->nullable();
            $table->string('past_occupation')->nullable();
            $table->string('privius_visa_country')->nullable();
            $table->string('privius_visa_address')->nullable();
            $table->string('privius_visa_no')->nullable();
            $table->string('privius_visa_type')->nullable();
            $table->string('privius_visa_date_issu')->nullable();
            $table->string('privius_visa_place_issu')->nullable();
            $table->string('privius_saac_country_visit')->nullable();
            // $table->string('refarence_name')->nullable();
            $table->string('refarence_address')->nullable();
            $table->string('refarence_code')->nullable();
            $table->string('refarence_phone')->nullable();
            $table->string('refarence_name')->nullable();
            $table->string('photo')->nullable();
            $table->string('passport_photo')->nullable();
            $table->enum('status', ['Active', 'Inactive', 'Pending']);
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
        Schema::dropIfExists('visa_data_models');
    }
}
