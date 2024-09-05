<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisaProcesingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visa_procesings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('continent')->nullable();
            $table->string('image')->nullable();
            $table->string('ditails')->nullable();
            $table->integer('created_by')->nullable();
            $table->string('meta')->nullable();
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
        Schema::dropIfExists('visa_procesings');
    }
}
