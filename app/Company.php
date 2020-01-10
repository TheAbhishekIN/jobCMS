<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected  $table  = 'companies';
       protected $fillable = [
        'company_name', 'business_stream_id', 'contact_mail_id','contact_number','establishment_date','location_id','website_url','company_profile','company_description','user_account_id'
    ];



    public function job_posts()
	{
		return $this->hasMany('App\JobPost','company_id');
	}
}
