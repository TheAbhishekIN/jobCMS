<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\Job;
use Auth;

class AdminController extends Controller
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
    public function index()
    {
        $_active_jobs = DB::table('job_posts')
                            ->where('job_posts.is_active',1)
                            ->count();

        $_new_jobs = DB::table('job_posts')
                            ->where('job_posts.is_active',2)
                            ->count();

                            
        $_total_user = DB::table('users')
                            ->where('users.user_type_id','!=',1)
                            ->count();

        $_compact = array(
            'active_jobs'=>$_active_jobs,
            'new_jobs'=>$_new_jobs,
            'total_users'=>$_total_user
        );
                            // pr($_new_jobs);
                            // pr($_active_jobs);
                            // pr($_total_user);
                            // exit;
        return view('admin.admin_home',$_compact);
    }



    public function companies(){
        if (Auth::user()->user_type_id==1) {
            $_companies = DB::table('companies')
                            ->select('companies.*','companies.id as company_id','job_locations.city','job_locations.country','users.name')
                            ->join('job_locations', 'companies.location_id','=','job_locations.id')
                            ->join('users', 'companies.user_account_id','=','users.id')
                            ->get();

            return view('admin.SuperAdmin.companies',['companies'=>$_companies]);
        }

    }
      
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function messages(){
        return view('admin.pages.messages');
    }

    public function manage_jobs(){

        $jobs = DB::table('jobs')->where('user_id',Auth::user()->id)->get();

        return view('admin.pages.manage_jobs')->with('jobs', $jobs);
    }

    public function bookmarks(){
        return view('admin.pages.bookmarks');
    }

    public function review(){
        return view('admin.pages.review');
    }


    public function mail()
    {
        $name = 'Abhishek';
     Mail::to('abhishek@softprogrammers.com')->send(new SendMailable($name));

     return 'Email was sent';
 }
}
