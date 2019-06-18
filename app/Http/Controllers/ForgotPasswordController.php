<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\User;
use App\Notifications\MailResetPasswordNotification;
use Redirect;
use Validator;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        return view('userslogin.passwords.email');
    }

    /**
    * Method name: requestForgotPassword
    * @description :  Api to show forget passowrd page
    * @param:  Request data
    * @return:  
    */

    // public function requestForgotPassword(Request $request){
    //     $data['title'] = 'Forgot Password';
    //     return view('users.forgot-password')->with($data);
    // }

    /**
    * Method name: forgotPassword
    * @description :  Api for user to request forget password
    * @param:  Request data
    * @return:  success message
    */

    public function forgotPassword(Request $request)
    { 
        $validator = \Validator::make($request->all(), [
           'email' => 'required|email',
        ],[
           'email.required' => 'Please enter email address.',
           'email.email' => 'Please enter valid email address.',
        ]);
        $validator->after(function($v) use($request){
           if(!empty($request->email) && filter_var($request->email, FILTER_VALIDATE_EMAIL)){
               $user = User::where('email', $request->email)->first();
               if(!empty($user)){
                   $user = $user->toArray();
                   if($user['status'] == 'inactive'){
                       $v->errors()->add('email', "The account is inactive, please contact administrative.");
                   }
               }
               else{
                   $v->errors()->add('email', "The account is not registered with this email.");
               }
           }
        });

        if ($validator->passes()) {
           $user = User::where('email', $request->email)->first();
           $token = __random_string(16);
           User::where('id', $user['id'])->update([
               'remember_token' => $token
           ]);
           $emailData['LINK'] = url('create-password?token=' . $token);
           $user->notify(new MailResetPasswordNotification($token,$emailData));
           $request->session()->flash('status', 'Reset Password Link sent to your email.');
           return Redirect::back();
        }

        $request->session()->flash('error', 'Invalid Enail. Please try again');
        return Redirect::back();
    }


    /**
    * Method name: createPassword
    * @description :  Api for user to create password
    * @param:  Request data
    * @return:  
    */

    public function createPassword(Request $request)
    {
        $data['title'] = 'Create Password';
        $data['token'] = $request->token;
        $user = User::where('remember_token', $request->token)->first();
        $data['link'] = 'active';
        if(empty($user)){
            $data['link'] = 'expired';
        }
        return view('userslogin.passwords.reset')->with($data);
    }

    /**
    * Method name: makePassword
    * @description :  Api for user to create password
    * @param:  Request data
    * @return:  success message
    */

    public function makePassword(Request $request)
    {
        $rules = array(
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $user = User::where('remember_token', $request->token)->first();
            if(!empty($user)){
               $user = $user->toArray();
               $token = __random_string(16);
               $user = User::where('remember_token', $request->token)->update([
                   'password' => bcrypt($request->password),
                   'remember_token' => $token
               ]);
               $request->session()->flash('success', 'Your password has been successfully updated.Login Now.');
               // return Redirect::back();
               return redirect()->route('userlogin');
            }else{
                $request->session()->flash('error', 'This link has been expired.');
                return Redirect::back()->withErrors($validator);
            }
        }
        $request->session()->flash('error', 'Invalid Credential. Please try again');
        return Redirect::back()->withErrors($validator);
    }

}