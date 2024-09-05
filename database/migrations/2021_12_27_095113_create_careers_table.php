<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('vacancy')->nullable();
            $table->string('email')->nullable();
            $table->string('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('published_at')->nullable();
            $table->string('employment_status')->nullable()->comment('Job type: Full time, Per time');
            $table->string('experience')->nullable();
            $table->string('gender')->nullable();
            $table->string('job_location')->nullable();
            $table->string('salary')->nullable();
            $table->string('meta');
            $table->string('application_deadline')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active')->comment('default status set active , Inactive');
            $table->enum('type', ['intern', 'job']);
            $table->string('alt');
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->foreignId('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('careers');
    }
}
