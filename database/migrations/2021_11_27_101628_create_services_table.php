<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title', 120)->nullable();
            $table->string('slug')->nullable();
            $table->string('url')->nullable();
            $table->longText('details')->nullable();
            $table->string('image', 120)->nullable();
            $table->boolean('show_in_nav')->default(0)->comment('0=not show in nav, 1=show in nav.');
            $table->enum('status', ['Active', 'Inactive'])->default('Active')->comment('default status set active , Inactive');
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
        Schema::dropIfExists('services');
    }
}
