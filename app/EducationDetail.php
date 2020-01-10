<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducationDetail extends Model
{
	protected $fillable = [
		'certificate_name',
		'major_stream',
		'institute_name',
		'starting_date',
		'completion_date',
		'percentage',
		'user_account_id',
		'description'
	];

}
