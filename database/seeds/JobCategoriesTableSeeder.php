<?php

use Illuminate\Database\Seeder;

class JobCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
               $_job_types = array(
        	1=>'Web & Softare Dev',
        	2=>'Data Science & Analytics',
        	3=>'Accounting & Consulting',
        	4=>'Writing & Translations',
        	5=>'Sales & Marketing',
        	6=>'Graphics & Design',
        	7=>'Digital Marketing',
        	8=>'Education and Training'
        );
        $_job_type_desc = array(
        	1=>'Software Engineer, Web / Mobile Developer & More',
        	2=>'Data Specilist / Scientist, Data Analyst & More',
        	3=>'Auditor, Accountent, Finencial Analyst & More',
        	4=>'Copywriter, Creative Writer, Translater & More',
        	5=>'Brand Manager, Markiting Coordinator & More',
        	6=>'Creative Director, Web / App Designer & More',
        	7=>'Marketing Analyst, Social Profile Admin & More',
        	8=>'Advisor, Mentor, Education Coordinator & More'
        );

        for ($i = 1; $i <= 8 ; $i++) {
        	 DB::table('job_categories')->insert([
            'job_category' => $_job_types[$i],
            'description' => $_job_type_desc[$i],
        ]);
        }
    }
}
