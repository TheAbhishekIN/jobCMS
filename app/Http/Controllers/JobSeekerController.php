<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\EducationDetail;
use App\ExperianceDetails;
use App\JobLocation;
use Auth;
use Session;

class JobSeekerController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }


public function resume()
{
    return view('admin.pages.resume');
}

    #Education Actions 

        public function education_details()
        {   
          $user_id = Auth::id();
            $education_details = DB::table('education_details')->where('user_account_id',$user_id)->get();

            return view('admin.JobSeeker.education_details', ['education_details' => $education_details]);
        }

        public function add_education_details()
        {
          // $education_details = DB::table('education_details')->get();
         return view('admin.JobSeeker.add_edu_details');
        }

        public function save_education(Request $request)
        {

           $validatedData = $request->validate([
            'institute_name' => 'required|string|alpha|max:255',
            'degree' => 'required|string|max:255',
            'major_stream' => 'required|string|max:255',
            'starting_date' => 'required|date',
            'completion_date' =>'nullable|date|after:starting_date',
            'percentage' => 'nullable|numeric|max:99'
            ]);


           $form_data = array(
             'certificate_name'=> $request['degree'] ,
             'major_stream'=>   $request['major_stream'],
             'institute_name'=> $request['institute_name'],
             'starting_date'=> $request['starting_date'],
             'completion_date'=> $request['completion_date'],
             'percentage'=> $request['percentage'],
             'description'=> $request['description'],
             'user_account_id'=> Auth::user()->id
         );

           EducationDetail::create($form_data);

           Session::flash('message', 'Education details added successfully!');
            return redirect('education-details');
        }

        public function edit_education($id)
        {
         $education_details = DB::table('education_details')->where('id', $id)->first();
                  // var_dump($education_details);
         return view('admin.JobSeeker.edit_edu_details', ['education_details' => $education_details]);
        }

        public function update_edu(Request $request, $id)
        {
           $validatedData = $request->validate([
            'institute_name' => 'required|string|alpha|max:255',
            'certificate_name' => 'required|string|max:255',
            'major_stream' => 'required|string|max:255',
            'starting_date' => 'required|date',
            'completion_date' =>'nullable|date|after:starting_date',
            'percentage' => 'nullable|numeric|max:99'
            ]);

           $_edu_data = EducationDetail::find($id);

           $_edu_data->certificate_name= $request['certificate_name'];
           $_edu_data->major_stream=   $request['major_stream'];
           $_edu_data->institute_name= $request['institute_name'];
           $_edu_data->starting_date= $request['starting_date'];
           $_edu_data->completion_date= $request['completion_date'];
           $_edu_data->percentage= $request['percentage'];
           $_edu_data->description= $request['description'];
           $_edu_data->user_account_id= Auth::user()->id;

           $_edu_data->save();

          Session::flash('message', 'Education details updated successfully!');

          return redirect('education-details');
        }

        public function delete_edu($id)
        {

            EducationDetail::find($id)->delete();
                    // redirect
            Session::flash ('messsage','Education detail deleted successfully!');
            return redirect('education-details');
            
        }

    #End Education Actions

    #Experiance Actions Starts    

        public function experience_details()
        {
            $user_id = Auth::user()->id;
            $experience_details = DB::table('experiance_details')
                                    ->select('experiance_details.*','experiance_details.id as exp_id','job_locations.*')
                                    ->where('user_account_id',$user_id)
                                    ->join('job_locations', 'experiance_details.location_id', '=', 'job_locations.id')
                                    ->get();
            return view('admin.JobSeeker.experience_details', ['experience_details' => $experience_details]);
        }

        public function add_experience()
        {
         return view('admin.JobSeeker.add_experience');
        }

        public function save_experience(Request $request)
        {

            // dd($request);
          
           $validatedData = $request->validate([
            'job_title' => ['required', 'string'],
            'company_name' => ['required', 'string', 'max:255'],
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'location.country' => 'required',

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

            if($location_save){
                if ($request['description'] == null) {
                    $desc = '';
                }else{
                    $desc = $request['description'];

                }

                $form_data = array(
                'job_title'=> $request['job_title'] ,
                'company_name'=>   $request['company_name'],
                'start_date'=> $request['start_date'],
                'end_date'=> $request['end_date'],
                'location_id'=> $location_save->id,
                'description'=> $desc,
                'user_account_id'=> Auth::user()->id
                );

                ExperianceDetails::create($form_data);
            }
            // Session::flesh('message','Experience details added successfully!');
           return redirect('experience-details');
        }

        public function edit_experience($id)
        {
            $_user_id = Auth::user()->id;
            $_where = array(
                'experiance_details.id'=>$id,
                'experiance_details.user_account_id'=>$_user_id,
            );
            $experience_details = DB::table('experiance_details')
                                    ->select('experiance_details.*','experiance_details.id as exp_id','job_locations.*')
                                    ->where($_where)
                                    ->join('job_locations', 'experiance_details.location_id', '=', 'job_locations.id')
                                    ->first();

                            //    pr($experience_details);exit;     

         return view('admin.JobSeeker.edit_experience', ['experience_details' => $experience_details]);
        }

        public function update_experience(Request $request, $id)
        {
        //    dd($request);
            $validatedData = $request->validate([
                'job_title' => ['required', 'string'],
                'company_name' => ['required', 'string', 'max:255'],
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after:start_date',
                'location.country' => 'required',
    
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
    
                $location_save = JobLocation::whereId($request['location']['location_id'])->update($_location);
    
                if($location_save){
                    if ($request['description'] == null) {
                        $desc = '';
                    }else{
                        $desc = $request['description'];
    
                    }
    
                    $form_data = array(
                    'job_title'=> $request['job_title'] ,
                    'company_name'=>   $request['company_name'],
                    'start_date'=> $request['start_date'],
                    'end_date'=> $request['end_date'],
                    'location_id'=> $request['location']['location_id'],
                    'description'=> $desc,
                    'user_account_id'=> Auth::user()->id
                    );
    
                    ExperianceDetails::whereId($id)->update($form_data);
                }

                Session::flash ('messsage','Experience details updated successfully!');
                return redirect('experience-details');

        }

        public function delete_experience($id)
        {

            $_location_id = ExperianceDetails::find($id)->first();

            JobLocation::find($_location_id['location_id'])->delete();

            ExperianceDetails::find($id)->delete();

            Session::flash ('messsage','Experience details deleted successfully!');
            return redirect('experience-details');
        }

    #Experiance Actions End    


}
