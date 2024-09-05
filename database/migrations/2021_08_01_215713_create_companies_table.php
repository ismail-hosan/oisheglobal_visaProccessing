<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('invoice_logo')->nullable();
            $table->string('company_name', 100)->nullable();
            $table->string('website')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 55)->nullable();
            $table->text('address')->nullable();
            $table->text('branch_address_1')->nullable();
            $table->text('branch_address_2')->nullable();
            $table->longText('terms_and_conditions')->nullable();
            $table->longText('privacy_policy')->nullable();
            #socila media link
            $table->string('linkedin')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            #youtube added
            $table->string('youtube')->nullable();
            #

            $table->string('sale_phone', 20)->nullable();
            $table->string('sale_email', 20)->nullable();

            $table->string('hr_phone', 20)->nullable();
            $table->string('hr_email', 20)->nullable();

            $table->string('support_phone', 20)->nullable();
            $table->string('support_email', 20)->nullable();

            $table->longText('meta')->nullable();
            $table->longText('team_meta')->nullable();
            $table->longText('testimunials_meta')->nullable();
            $table->longText('client_meta')->nullable();
            $table->longText('career_meta')->nullable();
            $table->longText('contact_meta')->nullable();

            $table->integer('success_rate')->nullable();
            $table->integer('running_project')->nullable();
            $table->integer('project_done')->nullable();
            $table->integer('total_clients')->nullable();


            $table->float('task_identification_number', 12, 2)->nullable();
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
        Schema::dropIfExists('companies');
    }
}
