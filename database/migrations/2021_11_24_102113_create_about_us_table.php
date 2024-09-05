<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->string('icon', 255)->nullable();
            $table->string('tagline', 255)->nullable();
            $table->longText('description')->nullable();
            $table->string('m_title', 255)->nullable()->comment('mission title');
            $table->string('m_image', 255)->nullable()->comment('mission title icon');
            $table->longText('mission')->nullable();
            $table->string('v_title', 255)->nullable()->comment('vission title');
            $table->string('v_image', 255)->nullable()->comment('vission title icon');
            $table->string('video', 255)->nullable()->comment('intro video');
            $table->longText('vision')->nullable();
            $table->longText('meta')->nullable();
            $table->enum('status', ['Active', 'Inactive', 'Pending', 'Cancel'])->default('Active')->comment('default status set active , penidng status waiting for approbal');
            $table->integer('updated_by')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('about_us');
    }
}
