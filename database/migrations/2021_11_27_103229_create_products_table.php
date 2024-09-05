<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->nullable();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('image')->nullable();
            $table->string('module_title')->nullable();
            $table->string('gallary_title')->nullable();
            $table->string('video_title')->nullable();
            $table->string('video_link')->nullable();
            $table->longText('description')->nullable();
            $table->longText('tecnology')->nullable();
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
        Schema::dropIfExists('products');
    }
}
