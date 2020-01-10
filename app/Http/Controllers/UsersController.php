<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\User;
use Auth;
use Session;


class UsersController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function account_setting()
    {
        $id = Auth::user()->id;
        $user_details = DB::table('users')->where('id', $id)->first();
        
        $_business_streams = DB::table('business_streams')->pluck('id','business_stream_name');
        // dd($_business_streams);
        return view('admin.User.account_setting', ['user_details' => $user_details,'biz_streams'=>$_business_streams]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $_user_id = Auth::user()->id;
        $old_profile = Auth::user()->user_image;

        $validatedData = $request->validate([
            'name' => ['required']
        ]);

        if ($request->file('user_profile')) {

            $_profile_path = public_path('images/user_profiles/'.$_user_id.'/');
             $imageName = time().'.'.request()->user_profile->getClientOriginalExtension();
             request()->user_profile->move($_profile_path, $imageName);
            if ($old_profile!='') {
                
            unlink('images/user_profiles/'.$_user_id.'/'.$old_profile);
            }
        }else{
            $imageName = null;
        }

        $user_data = User::find($_user_id);
        $user_data->name= $request['name'];
        $user_data->user_image=   $imageName;
        $user_data->save();

        Session::flash('message', 'Data updated successfully!');
        return redirect(route('account_setting'));
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
}
