<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentRegisterDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_register_data', function (Blueprint $table) {
            $table->id();
            $table->integer('agent_id')->nullable();
            $table->string('mobile')->nullable();
            $table->string('nid_no')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('rl_no')->nullable();
            $table->string('passport_no')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('company_name')->nullable();
            $table->string('tin_number')->nullable();
            $table->string('company_address')->nullable();
            $table->string('trade_license_no')->nullable();
            $table->string('bin_number')->nullable();
            $table->string('bussiness_year')->nullable();
            $table->string('personal_image')->nullable();
            $table->string('rld_image')->nullable();
            $table->string('tin_image')->nullable();
            $table->string('trade_image')->nullable();
            $table->string('nid_front')->nullable();
            $table->string('nid_back')->nullable();
            $table->string('passport_image')->nullable();
            $table->string('bin_image')->nullable();
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
        Schema::dropIfExists('agent_register_data');
    }
}
