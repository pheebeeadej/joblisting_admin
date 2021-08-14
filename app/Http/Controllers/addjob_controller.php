<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use App\Models\listjob;
use Validator;
use File;

class addjob_controller extends Controller
{
    public function index(Request $request)
    {
        $user_type = $request->session()->get('logged_user_type');
        if (session()->has('logged_id')) {
            // $user =$request->session()->get('loggedid');
            //         $notecount = notification::where('user_id','=',$user)->where('status', '=', '')->count();

            $user_id = $request->session()->get('logged_id');
            $user_email = $request->session()->get('logged_email');
          
            return view("addjob");
           
            // ->with('wallet', $wallet);

        }else{
            return redirect("/?r=addjob");
        }
    }
    public function addjob(Request $request){
      
       // return $request->input();
      $request->validate([
             'jobname'            => 'required',
             'company_email'	  => 'required|email',
             'location'           => 'required', //'file|mimes:jpg,jpeg,png,svg,gif|max:4000',
             'job_description'    => 'required',//'file|mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:10040',
      ]);
           
                $user = new listjob;

                  $user->jobname              = $request->jobname;
                  $user->company_email        = $request->company_email;
                  $user->location             = $request->location;
                  $user->job_description      = $request->job_description;
                 
                $query = $user->save();
      
               if ($query) {
                  return back()->with('success','Job has been added successfuly');
               }else {
                  return back()->with('fail','Something went wrong. Please try again');
               } 
    }  

}
