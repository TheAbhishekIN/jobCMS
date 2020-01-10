<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
	protected  $table  = 'job_posts';

	protected $fillable = [
		'posted_by_id',
		'job_category_id',
		'job_type_id',
		'company_id',
		'job_location_id',
		'job_title',
		'is_company_name_hidden',
		'publish_date',
		'min_salary',
		'max_salary',
		'job_description',
		'is_active',
		'tags'
	];


	public function company()
	{
		return $this->belongsTo('App\Company','company_id');
	}
}
