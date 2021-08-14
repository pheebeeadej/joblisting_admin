<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use App\Models\reguser;
use App\Models\forgot_password;
use Illuminate\Support\Facades\Mail;
use App\Mail\mailer;

class password_reset_controller extends Controller
{
   
    //
    // public function change_pass_index(Request $request)
    // {
    //     if (session()->has('logged_id')) {
    //         $user_id = $request->session()->get('logged_id');
    //         // $user_email = $request->session()->get('logged_email');
    //         // $username =  $request->session()->get('logged_username');
    //         // $wallets = DB::select('select * from regusers where id = :user_id', ['user_id' => $user_id]);
    //     //    $notecount = admin_notification::where('status', '=', 'pending')->count();
           
    //         // $wallet = $wallets[0]->wallet;
    //         return view("reset_password");
    //         //  ->with('notecount', $notecount)
    //         // ->with('wallet', $wallet);
    //     }else{
    //         return redirect("login?r=change_pass");
    //     }
    // }
    public function change_pass(Request $request)
    {
            
            $request->validate([
                    
            
                'old_password' =>'required|alphaNum|min:5',
                'new_password'  =>'required|alphaNum|min:5',
                'confirm_password'  =>'required|alphaNum|min:5'

            ]);
        // declaring and get the value in variables
            $user_id = $request->session()->get('logged_id');
            $username =  $request->session()->get('logged_username');
            $password = $request->old_password;
            $new_password = $request->new_password;
            $confirm_password = $request->confirm_password;
        
        //seller check

            $user = DB::select('select * from regusers where username = :username', ['username' => $username]);

            
            if ($user) {
                // check if password matches
            
                if (Hash::check($password, $user[0]->password)) {

                    if ( $new_password ==  $confirm_password) {

                        $password =  Hash::make($request->new_password);

                        $update = DB::table('regusers')
                        ->where('id', $user_id)
                        ->update([
                            'password' => $password,
                        ]);
                            return back()->with('success','Password updated successfully');
                    }else {
                        return back()->with('fail','New passwords do not match.');
                    }
                    
                    
                }else {

                    return back()->with('fail','Incorrect password. Please check password and retry');
                }

            }else{
                return back()->with('fail','User details does not match our record. please check login details and retry');
            }


            
    }


    //////////////////////////////////////////////////////////////////
    ////////////    side for forgot password     ///////////////////////
    public function forgot_pass_index(Request $request)
    {
            return view("pages.forgot_password");
    }
    public function forgot_pass(Request $request)
    {
        $request->validate([
         'email' =>'required|email',
        ]);
        $email = $request->email; 
        // echo $email; 
        $user = DB::select('select * from regusers where email = :email', ['email' => $email]);
            
        if ($user) {
            $token = uniqid().time();
            $password_reset = new forgot_password;
            $password_reset->email = $request->email;
            $password_reset->token = $token;
            $query = $password_reset->save();
            if ($query) {
               
                $date =  date("h:ia l d/M/Y");
              
                $details=[
                         'title' =>"Password reset request",
                         'message' =>"Hi ".$user[0]->username." Use the link below to create a new password for your account on job.com . The link will expire in 1 hours.",
                         'message2' =>"https://job.com/password_change/".$token,
                         'message3' =>"Kindly ignore this message if you did not make this request.",
                         'email' => $email, 
                         'date' =>$date
                 ];
                  //    $send = 
                 
                Mail::to($email)->send(new mailer($details));

                return back()->with('success','Check your mail for link to reset your password.');
            }else{
                return back()->with('fail','Something went wrong. Please try again');
            }
        }else{
            return back()->with('fail','Email does not match our record. please check email and retry');
        }
    }
}
