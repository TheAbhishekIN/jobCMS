<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\JobCategory;
class PortalController extends Controller
{
    public function index(){

        $_categories = DB::table('job_categories')
                                ->get();


        $_category_icon = array(
            1=>'icon-line-awesome-file-code-o',
            2=>'icon-line-awesome-cloud-upload',
            3=>'icon-line-awesome-suitcase',
            4=>'icon-line-awesome-pencil',
            5=>'icon-line-awesome-pie-chart',
            6=>'icon-line-awesome-image',
            7=>'icon-line-awesome-bullhorn',
            8=>'icon-line-awesome-graduation-cap',
        );
        $_job_categories = array();

        foreach($_categories as $category){
            $_total_jobs = DB::table('job_posts')
                                    ->where('job_category_id',$category->id)
                                    ->count();

                $_job_categories[$category->id]['category_id'] = $category->id; 
                $_job_categories[$category->id]['total_jobs'] = $_total_jobs; 
                $_job_categories[$category->id]['title'] = $category->job_category; 
                $_job_categories[$category->id]['desc'] = $category->description; 
                $_job_categories[$category->id]['icon'] = $_category_icon[$category->id]; 

        }

        $_jobs = DB::table('job_posts')
                            ->select('job_posts.*','job_posts.id as job_id','job_locations.city','job_locations.country','companies.company_name','companies.company_profile')
                            ->where('is_active',1)
                            ->join('companies', 'job_posts.company_id','=','companies.id')
                            ->join('job_locations', 'job_posts.job_location_id','=','job_locations.id')
                            ->inRandomOrder()
                            ->limit(5)
                            ->get();

            // pr($_jobs );exit;
        
            $_featured_cities = DB::table('job_locations')->pluck('city');

            $_cities = array();
            foreach($_featured_cities as $city){$_cities[] = $city;}
           
            $_cities1 = implode(',', $_cities);
            $_featured_city = array_count_values(explode(',', $_cities1));
            arsort($_featured_city);
            $_arr = array();
            $a = 1;
            foreach($_featured_city as $city => $count){
                $_city_job = DB::table('job_posts')
                ->select('job_posts.*','job_locations.city')
                ->where('job_locations.city',$city)
                ->join('job_locations', 'job_posts.job_location_id','=','job_locations.id')
                ->count();

                if ($_city_job>0) {
                   $_arr[$a]['city'] = $city;
                   $_arr[$a]['jobs'] = $_city_job;
                   $a++;
               }
               
            }
            $_arr = array_slice($_arr, 0, 4);



            $_companies = DB::table('companies')
                        ->select('companies.company_name','companies.id as company_id','companies.company_profile','job_locations.city','job_locations.country')
                        ->where('status',1)
                         ->join('job_locations','companies.location_id','=','job_locations.id')
                        ->limit(3)
                        ->get();

            $_numbers = array();
            $_numbers['total_jobs'] = DB::table('job_posts')->count();
            $_numbers['total_companies'] = DB::table('companies')->count();
            $_numbers['total_seeker'] = DB::table('users')->where('user_type_id',1)->count();

            $_compact = array(
                'job_categories'=>$_job_categories,
                'jobs'=>$_jobs,
                'featured_city'=>$_arr,
                'companies'=>$_companies,
                'numbers'=>$_numbers
            );

        return view('welcome',$_compact);
    }

    public function job_listing(){

        // pr($_GET);exit;
       
        #Get All job categories for job listing page
        $_job_categories = DB::table('job_categories')->select('job_categories.job_category','job_categories.id')->get();
         #END Get All job categories for job listing page

        #Simple Job posts showing on lending page
            $_jobs = DB::table('job_posts')
                   ->select('job_posts.*','job_locations.city','job_locations.country','companies.company_profile','companies.company_name')
                   ->where('is_active',1)
                   ->join('job_locations','job_posts.job_location_id','=','job_locations.id')
                   ->join('companies','job_posts.company_id','=','companies.id')
                   ->paginate(15);
        #END Simple Job posts showing on lending page         

        #Search from landing page header
        if (isset($_GET['location']) && $_GET['location']!='' || isset($_GET['job_title']) && $_GET['job_title']!='') {

                    $_location_ids = DB::table('job_locations')
                    ->select('id')
                    ->where('city',trim($_GET['location']))
                    ->get();
                    $_loc_id =  array();
                    foreach ($_location_ids as $_location_id) {
                        $_loc_id[] = $_location_id->id;
                    }
                    $_job_title = '';
                    if (isset($_GET['job_title']) && $_GET['job_title']!='') {
                        $_job_title = $_GET['job_title'];
                        
                    } 
                    if (!empty($_loc_id)) {
                        $_jobs = DB::table('job_posts') 
                        ->select('job_posts.*','job_locations.city','job_locations.country','companies.company_profile','companies.company_name') 
                        ->where('job_location_id',$_loc_id) 
                        ->orWhere('job_title','LIKE','%'.$_job_title.'%') 
                        ->join('job_locations','job_posts.job_location_id','=','job_locations.id') 
                        ->join('companies','job_posts.company_id','=','companies.id') 
                        ->paginate(15); 
                    }else{
                              $_jobs = DB::table('job_posts') 
                        ->select('job_posts.*','job_locations.city','job_locations.country','companies.company_profile','companies.company_name') 
                        ->where('job_title','LIKE','%'.$_job_title.'%') 
                        ->join('job_locations','job_posts.job_location_id','=','job_locations.id') 
                        ->join('companies','job_posts.company_id','=','companies.id') 
                        ->paginate(15); 

                    }

                }
        #END Search from landing page header


        #Search from landing page featured cities
            if (isset($_GET['city']) && $_GET['city']!='') {
                $_location_ids = DB::table('job_locations')
                                    ->select('id')
                                    ->where('city',trim($_GET['city']))
                                    ->get();
                $_loc_id =  array();
                foreach ($_location_ids as $_location_id) {
                    $_loc_id[] = $_location_id->id;
                }

                 $_jobs = DB::table('job_posts')
                           ->select('job_posts.*','job_locations.city','job_locations.country','companies.company_profile','companies.company_name')
                           ->where('job_location_id',$_loc_id)
                           ->join('job_locations','job_posts.job_location_id','=','job_locations.id')
                           ->join('companies','job_posts.company_id','=','companies.id')
                           ->paginate(15);

            }
        #END Search from landing page featured cities

        #Search from landing page Popular Job Categories
            if (isset($_GET['cat']) && $_GET['cat']!='') {
              
               $_cond = array(
                'is_active'=>1,
                'job_category_id'=>$_GET['cat'],
               );
               $_jobs = DB::table('job_posts')
                           ->select('job_posts.*','job_locations.city','job_locations.country','companies.company_profile','companies.company_name')
                           ->where($_cond)
                           ->join('job_locations','job_posts.job_location_id','=','job_locations.id')
                           ->join('companies','job_posts.company_id','=','companies.id')
                           ->simplePaginate(15);
            }
       #END Search from landing page Popular Job Categories

        #Create Array for display job categories and jobs listing   
        $_compact = array(
            'job_categories'=>$_job_categories,
            'jobs'=>$_jobs
        );
        #END Create Array for display job categories and jobs listing   

        return view('job_listing',$_compact);
    }

    public function single_job($id){

        $_jobs = DB::table('job_posts')
                ->select('job_posts.*','job_locations.city','job_locations.country','companies.company_profile','companies.company_name')
                ->where('job_posts.id',$id)
                ->join('job_locations','job_posts.job_location_id','=','job_locations.id')
                ->join('companies','job_posts.company_id','=','companies.id')
                ->first();
                // pr($_jobs);exit;

        
        $_similar_jobs = DB::table('job_posts')
                ->select('job_posts.id as job_id','job_posts.min_salary','job_posts.job_title','job_posts.max_salary','job_posts.publish_date','job_posts.job_type_id','job_locations.city','job_locations.country','companies.company_profile','companies.company_name')
                ->where('job_posts.is_active',1)
                ->join('job_locations','job_posts.job_location_id','=','job_locations.id')
                ->join('companies','job_posts.company_id','=','companies.id')
                ->inRandomOrder()
                ->limit(2)
                ->get();

        // pr($_similar_jobs);exit;
        $_compact = array(
            'job_desc'=>$_jobs,
            'similar_jobs'=>$_similar_jobs
        );
        return view('single_job',$_compact);
    }

    public function companies_listing(){

        $_companies = DB::table('companies')
                            ->select('companies.id as company_id','companies.company_name','companies.location_id','companies.company_profile','job_locations.city','job_locations.country')
                            ->where('status',1)
                            ->join('job_locations','companies.location_id','=','job_locations.id')
                            ->get();


                            // pr($_companies);exit;

        return view('companies_listing',['companies'=>$_companies]);
    }

    public function company_profile($id){

        $_company = DB::table('companies')
                            ->select('companies.id as company_id','companies.*','job_locations.*')
                            ->where('companies.id',$id)
                            ->join('job_locations','companies.location_id','=','job_locations.id')
                            ->first();


        $_job_cond = array(
            'job_posts.company_id'=>$id,
            'job_posts.is_active'=>1,
        );
        $_jobs = DB::table('job_posts')
                        ->select('job_posts.id as job_id','job_posts.*','job_locations.*')
                        ->where($_job_cond)
                        ->join('job_locations','job_posts.job_location_id','=','job_locations.id')
                        ->get();
                    // pr($_company);exit;

        $_compact = array(
            'company'=>$_company,
            'jobs'=>$_jobs,
        );


        return view('company_profile',$_compact);
    }

}
