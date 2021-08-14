<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class listjob_controller extends Controller
{
    public function index(Request $request)
    {
        $user_type = $request->session()->get('logged_user_type');
        if (session()->has('logged_id') ) {
            // $user =$request->session()->get('loggedid');
            //         $notecount = notification::where('user_id','=',$user)->where('status', '=', '')->count();
            // $k = $request->id;
            $user_id = $request->session()->get('logged_id');
            $user_email = $request->session()->get('logged_email');
            $username =  $request->session()->get('logged_firstname');
            
                $jobs = DB::table('listjobs')->orderBy('id', 'desc')->where('id', '>', '0')->paginate(15);
           
                return view("listjob",compact('jobs'));

        }else{
            return redirect("login?r=listjob");
        }
    }

    
}
