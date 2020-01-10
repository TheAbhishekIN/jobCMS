<?php

use Illuminate\Database\Seeder;

class JobPostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<100;$i++){
            DB::table('job_posts')->insert([
                'job_title' => 'Software Developer',
                'posted_by_id' => 2,
                'company_id' =>  rand(1,12),
                'job_type_id' => rand(1,5),
                'job_category_id' => rand(1,8),
                'is_company_name_hidden' => 1,
                'publish_date' => date('Y-'.rand(10,11).'-'.rand(1,30)),
                'min_salary' => rand(1000,9999),
                'max_salary' => rand(10000,99999),
                'job_description' => 'Job Description
                Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.
                
                Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation X is on the runway heading towards a streamlined cloud solution. User generated content in real-time will have multiple touchpoints for offshoring.
                
                Capitalize on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.',
                'job_location_id' => rand(1,13),
                'is_active' => 1,
            ]);
        }
    }
}
