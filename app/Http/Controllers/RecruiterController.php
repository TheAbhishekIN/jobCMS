<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Company;
use App\JobLocation;
use App\JobPost;
use Auth;
use Session;


class RecruiterController extends Controller
{


  public function __construct()
  {
    $this->middleware('auth');
  }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function company_details()
    {
        $user_id = Auth::id();
        $_company_details = DB::table('companies')
                            ->select('companies.*','business_streams.business_stream_name','job_locations.street_address','job_locations.city','job_locations.state','job_locations.country','job_locations.zip')
                            ->where('companies.user_account_id',$user_id)
                            ->join('business_streams', 'companies.business_stream_id', '=', 'business_streams.id')
                            ->join('job_locations', 'companies.location_id', '=', 'job_locations.id')
                            ->get();
// pr($_company_details);exit;
       return view('admin.recruiter.company_detail',['company_detail'=>$_company_details]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_company()
    {
        $business_streams = DB::table('business_streams')->pluck('id', 'business_stream_name');

        return view('admin.recruiter.add_company',['biz_streams'=>$business_streams]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_company(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'company_name' => 'required|string|unique:companies|max:255',
            'business_stream' => 'required|integer|max:26',
            'contact_email_id' => 'required|email',
            'contact_mobile' => 'required|numeric|max:999999999999',
            'est_date' =>'nullable|date',
            'location.country' =>'required|string',
            'website_url' => 'required',
            'company_profile' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company_description' => 'nullable|string'
        ]);

        $_location = array(
            'street_address'=>$request['location']['street_addr1'].', '.$request['location']['street_addr2'],
            'city'=>$request['location']['city'],
            'state'=>$request['location']['state'],
            'country'=>$request['location']['country'],
            'zip'=>$request['location']['postal_code'],
        );

        $location_save = JobLocation::create($_location);

        if ($location_save) {
         
            if ($request->file('company_profile')) {

                $_profile_path = public_path('images/company_profiles/'.Auth::user()->id.'/');
                $imageName = time().'.'.request()->company_profile->getClientOriginalExtension();
                request()->company_profile->move($_profile_path, $imageName);

                $_profile_url = 'images/company_profiles/'.Auth::user()->id.'/'.$imageName;

            }else{
                $_profile_url = 'images/company_profiles/company-logo-placeholder.png';
            }


            $form_data = array(
               'company_name'=> $request['company_name'] ,
               'business_stream_id'=>   $request['business_stream'],
               'contact_mail_id'=> $request['contact_email_id'],
               'contact_number'=> $request['contact_mobile'],
               'establishment_date'=> $request['est_date'],
               'location_id'=> $location_save->id,
               'website_url'=> $request['website_url'],
               'company_profile'=> $_profile_url,
               'company_description'=> $request['company_description'],
               'user_account_id'=> Auth::user()->id
            );
            Company::create($form_data);
        }

            // return \Response::json(['success' => 'success']);
        Session::flash('message', 'Company details added successfully!');
        return redirect('company-details');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_company($id)
    {
        $user_id =Auth::id();

        $company_detail = DB::table('companies')
                            ->select('companies.*','job_locations.street_address','job_locations.city','job_locations.state','job_locations.country','job_locations.zip')
                            ->where('companies.id',$id)
                            ->where('companies.user_account_id',$user_id)
                            ->join('job_locations', 'companies.location_id', '=', 'job_locations.id')
                            ->first();

        $business_streams = DB::table('business_streams')->pluck('id', 'business_stream_name');

        return view('admin.recruiter.edit_company',['biz_streams'=>$business_streams,'company_detail'=>$company_detail]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_company(Request $request, $id)
    {

        $validatedData = $request->validate([
            'company_name' => 'sometimes|required|string|max:255',
            'business_stream' => 'required|integer|max:26',
            'contact_email_id' => 'required|email',
            'contact_mobile' => 'required|numeric|max:999999999999',
            'est_date' =>'nullable|date',
            'location.country' =>'required|string',
            'company_profile' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website_url' => 'required',
            'company_description' => 'nullable|string'
        ]);

        $_location = array(
            'street_address'=>$request['location']['street_addr1'].', '.$request['location']['street_addr2'],
            'city'=>$request['location']['city'],
            'state'=>$request['location']['state'],
            'country'=>$request['location']['country'],
            'zip'=>$request['location']['postal_code'],
        );

        $location_update = JobLocation::whereId($request['location']['location_id'])->update($_location);


        if ($location_update) {
           
        if ($request->file('company_profile')) {
            $_profile_path = public_path('images/company_profiles/'.Auth::user()->id.'/');
            $imageName = time().'.'.request()->company_profile->getClientOriginalExtension();
            request()->company_profile->move($_profile_path, $imageName);

            if ($request['old_file']!=null) {

                unlink($request['old_file']);
            }

            $_profile_url = 'images/company_profiles/'.Auth::user()->id.'/'.$imageName;

        }else{
            if ($request['old_file']!=null) {

                $_profile_url =$request['old_file'];
            }else{

                $_profile_url = 'images/company_profiles/company-logo-placeholder.png';
            }
        }

        $form_data = array(
            'id'=>$id,
            'company_name'=> $request['company_name'] ,
            'business_stream_id'=>   $request['business_stream'],
            'contact_mail_id'=> $request['contact_email_id'],
            'contact_number'=> $request['contact_mobile'],
            'establishment_date'=>$request['est_date'],
            'location_id'=>$request['location']['location_id'],
            'website_url'=> $request['website_url'],
            'company_profile'=> $_profile_url,
            'company_description'=> $request['company_description'],
            'user_account_id'=> Auth::user()->id
        );
           // pr($form_data);

        Company::whereId($id)->update($form_data);


        }

        Session::flash('message', 'Company details updated successfully!');
        return redirect('company-details');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_company($id)
    {   
        $_location_id = Company::find($id)->first();

        JobLocation::find($_location_id['location_id'])->delete();

        Company::find($id)->delete();
        Session::flash('message', 'Company Deleted successfully!');
        return redirect('company-details');
    }


    public function manage_jobs(){
          $user_id = Auth::id();
        $_jobs = DB::table('job_posts')
                            ->select('job_posts.*','job_posts.id as job_id','companies.company_name','users.name','job_locations.*','job_categories.job_category')
                            ->where('posted_by_id',$user_id)
                            ->join('companies', 'job_posts.company_id', '=', 'companies.id')
                            ->join('users', 'job_posts.posted_by_id', '=', 'users.id')
                            ->join('job_locations', 'job_posts.job_location_id', '=', 'job_locations.id')
                            ->join('job_categories', 'job_posts.job_category_id', '=', 'job_categories.id')
                            ->get();


        return view('admin.recruiter.manage_jobs',['total_jobs'=>$_jobs]);
    }
    public function job_post(){
        $_user_id = Auth::id();
        $job_category = DB::table('job_categories')->pluck('id', 'job_category');

        $companies_reg = DB::select('select id,company_name from companies where user_account_id = ? and status =?',[$_user_id,1]);

        return view('admin.recruiter.job_post',['job_category'=>$job_category,'company'=>$companies_reg]);
    }

    public function store_job(Request $request) {

        $validatedData = $request->validate([
            'company' => 'required',
            'job_title' => 'required|string',
            'job_type' => 'required|string',
            'job_category' => 'required|integer',
            'location.country' =>'required',
            'min_salary' =>'nullable|integer|max:9999',
            'max_salary' =>'nullable|integer|max:9999999',
            'job_desc' => 'nullable|string'
            ]);


            $_street_address = '';
            if($request['location']['street_addr1']!=''){
                $_street_address .= $request['location']['street_addr1'];
            }
            
            if($request['location']['street_addr2']!=''){
                $_street_address .= $request['location']['street_addr2'];
            }
        $_location = array(
            'street_address'=>$_street_address,
            'city'=>$request['location']['city'],
            'state'=>$request['location']['state'],
            'country'=>$request['location']['country'],
            'zip'=>$request['location']['postal_code'],
        );

       $location_save = JobLocation::create($_location);

       if ($location_save) {
            $_tags = '';
            if ($request['tags']!=null) {
            if (count($request['tags'])>0) {
               $_tags = implode(',', $request['tags']);
            }   
            }

       
            $form_data = array(

            'posted_by_id'=>Auth::id(),
            'job_category_id'=>$request['job_category'],
            'job_type_id'=>$request['job_type'],
            'company_id'=>$request['company'],
            'job_location_id'=>$location_save->id,
            'job_title'=>$request['job_title'],
            'tags'=>$_tags,
            'is_company_name_hidden'=>$request['is_company_name_hidden'],
            'publish_date'=>$request['publish_date'],
            'min_salary'=>$request['min_salary'],
            'max_salary'=>$request['max_salary'],
            'job_description'=>$request['job_desc'],
            'is_active'=>1,
            );

        JobPost::create($form_data);

       }

        Session::flash('message', 'Job Posting successfully!');
        return redirect('manage-jobs');


    }

    public function edit_job_post($id){
        $user_id =Auth::id();

        // pr($id);
        // pr($user_id);
        
        $job_category = DB::table('job_categories')->pluck('id', 'job_category');

        $companies_reg = DB::select('select id,company_name from companies where user_account_id = ? and status =?',[$user_id,1]);
        // pr($companies_reg);
        // exit;
        $job_detail = DB::table('job_posts')
                            ->select('job_posts.*','job_posts.id as job_id','job_locations.street_address','job_locations.city','job_locations.state','job_locations.country','job_locations.zip')
                            ->where('job_posts.id',$id)
                            ->where('job_posts.posted_by_id',$user_id)
                            ->join('job_locations', 'job_posts.job_location_id', '=', 'job_locations.id')
                            ->first();

                            // pr($job_detail);exit;

        $business_streams = DB::table('business_streams')->pluck('id', 'business_stream_name');

        return view('admin.recruiter.edit_job_post',['job_category'=>$job_category,'company'=>$companies_reg,'job_detail'=>$job_detail]);

    }

    public function update_job_post(Request $request, $id){

        // dd($request);

        $validatedData = $request->validate([
            'company' => 'required',
            'job_title' => 'required|string',
            'job_type' => 'required|string',
            'job_category' => 'required|integer',
            'location.country' =>'required',
            'min_salary' =>'nullable|integer|max:9999',
            'max_salary' =>'nullable|integer|max:9999999',
            'job_desc' => 'nullable|string'
            ]);


            $_street_address = '';
            if($request['location']['street_addr1']!=''){
                $_street_address .= $request['location']['street_addr1'];
            }
            
            if($request['location']['street_addr2']!=''){
                $_street_address .= $request['location']['street_addr2'];
            }
        $_location = array(
            'street_address'=>$_street_address,
            'city'=>$request['location']['city'],
            'state'=>$request['location']['state'],
            'country'=>$request['location']['country'],
            'zip'=>$request['location']['postal_code'],
        ); 
        // Company::whereId($id)->update($form_data);

       $location_save = JobLocation::whereId($request['location']['location_id'])->update($_location);

       if ($location_save) {

            $_tags = '';
            if ($request['tags']!=null) {
            if (count($request['tags'])>0) {
               $_tags = implode(',', $request['tags']);
            }   
            }

            $is_active = 2;
            if ($request['publish_date']!=null) {
                $is_active = 1;
            }

            $form_data = array(

            'posted_by_id'=>Auth::id(),
            'job_category_id'=>$request['job_category'],
            'job_type_id'=>$request['job_type'],
            'company_id'=>$request['company'],
            'job_location_id'=>$request['location']['location_id'],
            'job_title'=>$request['job_title'],
            'tags'=>$_tags,
            'is_company_name_hidden'=>$request['is_company_name_hidden'],
            'publish_date'=>$request['publish_date'],
            'min_salary'=>$request['min_salary'],
            'max_salary'=>$request['max_salary'],
            'job_description'=>$request['job_desc'],
            'is_active'=>1,
            );

        JobPost::whereId($id)->update($form_data);

       }

        Session::flash('message', 'Job Updated successfully!');
        return redirect('manage-jobs');
    }

    public function delete_job($id)
    {

        $_location_id = JobPost::find($id)->first();

        JobLocation::find($_location_id['job_location_id'])->delete();
        JobPost::find($id)->delete();
        Session::flash('message', 'Job listing Deleted successfully!');
        return redirect('manage-jobs');
    }

    public function manage_condidates(){
        // return view('admin.recruiter.job_post');
    }
}
