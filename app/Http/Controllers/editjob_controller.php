<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;

class editjob_controller extends Controller
{
    public function index(Request $request)
    {
        $user_type = $request->session()->get('logged_user_type');
        if (session()->has('logged_id')) {
           
            $id = $request->k;
            if ($id != "") {
                $user_id = $request->session()->get('logged_id');
                $user_email = $request->session()->get('logged_email');
                $username =  $request->session()->get('logged_username');
               
                $jobss =  DB::select('select * from listjobs where id = :id', ['id' => $id]);
                $jobs = $jobss[0];
                
                return view("editjob",compact('jobs'));
            }else{
                return redirect("listjob");
            }
            
        }else{
            return redirect("login?r=listjob");
        }
    }

    public function editjob (Request $request){
      
        // return $request->input();
       // return $request->input();
       $request->validate([
        'jobname'            => 'required',
        'company_email'	     => 'required|email',
        'location'           => 'required', //'file|mimes:jpg,jpeg,png,svg,gif|max:4000',
        'job_description'    => 'required',//'file|mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:10040',
       ]);
            $id = $request->id;

                //////////////////////////////////////////video side
               
                   $update = DB::table('listjobs')
                   ->where('id', $id)
                   ->update([
                         'jobname'          =>$request->jobname,
                         'company_email'    => $request->company_email,
                         'location'         =>$request->location,
                         'job_description'  => $request->job_description,
                   ]);

                // if ($update) {
                   return back()->with('success','Changes has been saved successfuly');
                // }else {
                //    return back()->with('fail','Something went wrong. Please try again');
                // }
             
  
    }
}
