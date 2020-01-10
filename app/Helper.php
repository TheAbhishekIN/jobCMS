<?php
use Illuminate\Support\Facades\DB;

/**
* change plain number to formatted currency
*
* @param $number
* @param $currency
*/

function pr($data)
{
	echo '<pre>';
	return print_r($data);
}

function _field_val($tbl,$field,$field_id,$return_field)
{
	$queries = DB::select("SELECT ".$return_field." from ".$tbl." where ".$field."=".$field_id." ");
	return $queries[0]->business_stream_name;
}

function job_exp_date($job_id){
	$_data = DB::table('job_posts')->where('id', $job_id)->first();

	if ($_data->publish_date!=null) {
		$_due_date = date('d F, Y',strtotime($_data->publish_date. ' + 30 days'));

	}else{
		$_due_date = date('d F, Y',strtotime($_data->created_at. ' + 30 days'));
	}

	return $_due_date;
}

function _get_days($date1,$date2){

	$your_date = strtotime("2010-01-31");
	$datediff = $date1 - $date2;

	return round($datediff / (60 * 60 * 24));
}
