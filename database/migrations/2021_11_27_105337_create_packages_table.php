<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable();
            $table->foreignId('service_id')->nullable();
            $table->string('name');
            $table->string('onetime_amount')->nullable();
            $table->string('monthly_amount')->nullable();
            $table->string('description')->nullable();
            $table->string('order_by')->nullable();
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
        Schema::dropIfExists('packages');
    }
}
