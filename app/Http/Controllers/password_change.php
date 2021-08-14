<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use App\Models\reguser;
use App\Models\forgot_password;
use Validator;

class password_change extends Controller
{
    public function index(Request $request, $token)
    {
        $reset_check = DB::select('select * from forgot_passwords where token = :token', ['token' => $token]);
        if ($reset_check) {
        $email = $reset_check[0]->email;
        $created_at = $reset_check[0]->created_at;
        $created_at_string = strtotime($created_at);
        $expiry = $created_at_string + (1 * 60 * 60) ;
        $token_new = $reset_check[0]->token;
                
       
        $request->session()->put('temp_token', $token_new);
        $request->session()->put('temp_email', $email);
        
            return redirect("password_change");

        }else{
            return redirect('/');
        }

     
    }

    public function index2(Request $request)
    {
        $token = $request->session()->get('temp_token');
        // echo $request->session()->get('temp_token');
        // echo $request->session()->get('temp_email');
        $reset_check = DB::select('select * from forgot_passwords where token = :token', ['token' => $token]);
        if ($reset_check) {
            $email = $reset_check[0]->email;
            $created_at = $reset_check[0]->created_at;
            $created_at_string = strtotime($created_at);
            $expiry = $created_at_string + (1 * 60 * 60) ;
            $token_new = $reset_check[0]->token;
                    
          
                if($expiry >= time() ){

                    return view("password_change")
                    ->with('expired', '');
                    
                }else{
                    return view("password_change")
                    ->with('expired', 'Link expired.');
                }
                // return redirect("password_change");
    
            }else{
                return redirect('/');
            }
       
    }


    public function password_change(Request $request)
    {
            
            $request->validate([
                    
                'new_password'  =>'required|alphaNum|min:5',
                'confirm_password'  =>'required|alphaNum|min:5'
            ]);

        // declaring and get the value in variables
            $email =  $request->session()->get('temp_email');;
            $new_password = $request->new_password;
            $confirm_password = $request->confirm_password;
        
        //seller check

                    if ( $new_password ==  $confirm_password) {

                        $password =  Hash::make($request->new_password);

                        $update = DB::table('regusers')
                        ->where('email', $email)
                        ->update([
                            'password' => $password,
                        ]);
                            return back()->with('success','Password updated successfully');
                    }else {
                        return back()->with('fail','New passwords do not match.');
                    }
                    
                    
              


            
    }
}
