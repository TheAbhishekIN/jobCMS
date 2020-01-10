<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperianceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiance_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_account_id');
            $table->string('job_title');
            $table->string('company_name');
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('location_id');
            $table->string('description');
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
        Schema::dropIfExists('experiance_details');
    }
}
