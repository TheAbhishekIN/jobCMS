<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_posts', function (Blueprint $table) {
              $table->bigIncrements('id');
            $table->integer('posted_by_id');
            $table->integer('job_category_id');
            $table->integer('job_type_id');
            $table->integer('company_id');
            $table->integer('job_location_id');
            $table->string('job_title');
            $table ->string('tags')->nullable();
            $table->integer('is_company_name_hidden');
            $table->biginteger('publish_date')->nullable();
            $table->string('min_salary')->nullable();
            $table->string('max_salary')->nullable();
            $table->longtext('job_description');
            $table->integer('is_active');
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
        Schema::dropIfExists('job_posts');
    }
}
