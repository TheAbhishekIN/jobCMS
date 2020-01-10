<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExperianceDetails extends Model
{
    	protected $fillable = [
		'job_title',
		'company_name',
		'start_date',
		'end_date',
		'location_id',
		'description',
		'user_account_id'
	];
}
