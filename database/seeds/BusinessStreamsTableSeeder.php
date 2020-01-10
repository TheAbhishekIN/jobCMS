<?php

use Illuminate\Database\Seeder;

class BusinessStreamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $business_streams = array(
        	1=>'Accounting & Tax Services',
        	2=>'Arts, Culture & Entertainment',
        	3=>'Auto Sales & Service',
        	4=>'Banking & Finance',
        	5=>'Business Services',
        	6=>'Community Organizations',
        	7=>'Dentists & Orthodontists',
        	8=>'Education',
        	9=>'Health & Wellness',
        	10=>'Health Care',
        	11=>'Home Improvement',
        	12=>'Insurance',
        	13=>'Internet & Web Services',
        	14=>'Legal Services',
        	15=>'Lodging & Travel',
        	16=>'Marketing & Advertising',
        	17=>'News & Media',
        	18=>'Pet Services',
        	19=>'Real Estate',
        	20=>'Restaurants & Nightlife',
        	21=>'Shopping & Retail',
        	22=>'Sports & Recreation',
            23=>'Software & Technology',
        	24=>'Transportation',
        	25=>'Utilities',
        	26=>'Wedding, Events & Meetings',
        );
        for ($i = 1; $i <= 25; $i++) {
        	  DB::table('business_streams')->insert([
            'business_stream_name' => $business_streams[$i],
        ]);
        }
    }
}
