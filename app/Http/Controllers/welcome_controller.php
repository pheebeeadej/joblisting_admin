<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;

class welcome_controller extends Controller
{
    
    //
    public function index(Request $request)
    {
      $r =$request->r;
      // echo $r;
          if (session()->has('logged_id')) {
          
           return redirect('listjob');

          }else {

            return view("pages.login")
            ->with('r', $r);
            
          }
    	
    }
    public function logout()
    {
      if (session()->has('logged_id')) {

          
        session()->pull('logged_id');
        session()->pull('logged_email');
        session()->pull('logged_username');
        session()->pull('logged_user_type');

        return redirect('/');
      }else{
        return redirect('/');
      }
     
    }

    public function login(Request $request)
    {
      
      $request->validate([
    		
    		'email' =>'required',
    		'password' =>'required|alphaNum|min:5'

      ]);
      // declaring and get the value in variables

        $email = $request->email;
        $password = $request->password;
     
          $user = DB::select('select * from regusers where email = :email ', ['email' => $email]);

          if ($user) {
           
           
             if (Hash::check($password, $user[0]->password)) {
    
                    $request->session()->put('logged_id', $user[0]->id);
                    $request->session()->put('logged_username', $user[0]->username);
                    $request->session()->put('logged_email', $user[0]->email);
                    $request->session()->put('logged_user_type', $user[0]->user_type);
                    
                    $r =$request->r;
                  if ($r != '') {
                    
                    return redirect($r);

                  }else{

                      return redirect('listjob');
                    
                  }
                 
              }else {
    
                return back()->with('fail','Incorrect password. Please check password and retry');
              }
    
          }else{
            return back()->with('fail','User details does not match our record. please check login details and retry');
          }

    
    	
    }


}
