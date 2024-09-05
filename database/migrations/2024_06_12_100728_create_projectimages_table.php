<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectimagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectimages', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->longText('short_desc')->nullable();
            $table->longText('desc')->nullable();
            $table->string('image');
            $table->string('created_by')->nullable();
            $table->integer('order_by')->nullable();
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
        Schema::dropIfExists('projectimages');
    }
}
