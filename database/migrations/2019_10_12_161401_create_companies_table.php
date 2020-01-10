<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->bigIncrements('user_account_id');
            $table->string('company_name');
            $table->string('contact_mail_id');
            $table->string('contact_number')->nullable();
            $table->longtext('company_description');
            $table->integer('business_stream_id');
            $table->string('company_profile')->nullable();
            $table->biginteger('establishment_date')->nullable();
            $table->int('status');
            $table->string('website_url');
            $table->integer('location_id');
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
