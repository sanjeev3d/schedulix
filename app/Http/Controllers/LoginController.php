<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\CustomerModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Notifications\ CustomerRegVerification;
use Illuminate\Support\Str;
use DB;

class LoginController extends Controller
{
    use RegistersUsers;
     protected $redirectTo = '/home';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registerform(Request $request)
    {
        if(isset($_GET['detail'])) {
            $customerDetails =  base64_decode($_GET['detail']);

            $data['customerRegisterData'] = explode("#", $customerDetails);
           
            $customerToken = CustomerModel::where('email',$data['customerRegisterData'][1])->first();
            //dd($customerToken, $customerDetails, $data['customerRegisterData'][3] );
              
            if(!empty($customerToken->remember_token) && ($customerToken->remember_token == $data['customerRegisterData'][2] )) {
                $customerToken->remember_token = ''; 
                $customerToken->save();
                return view('userslogin.register')->with($data);
            }else {
                $request->session()->flash('error','Your Token has been Expired.');
                return view('userslogin.register');
            }
        } else {
            $data['customerRegisterData'] ='';
            return view('userslogin.register')->with($data);
        }
        
    }

    public function register(Request $request)
    {
        $this->validate($request,[

            'name' => 'required|regex:/^[a-zA-Z ]+$/|min:3|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password'=>'required|confirmed|max:255'

        ],[
            'name.required'=>'Name field required.',
            // 'name.regex:/^[a-zA-Z ]+$/' => 'Service name must be string.',
            'name.min' => 'Service name must be 3 chars long.',
            'name.required'=>'Name field required.',
            'email.required'=>'Email field required.',
            'email.email'=>'This is not a valid email.',
            'email.unique'=>'This Email has been taken already.',
        ]);
        
        DB::beginTransaction();
        try {
            $role_id = 2;
            if(!empty($request->role_id)){
                $role_id = $request->role_id;
            }

            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'role_id' => $role_id,
                'unique_id' => Str::random(10),
                'password' => Hash::make($request['password']),
            ]);

            if($user){
                
                try{
                    $user->notify(new  CustomerRegVerification( $user));
                    DB::commit();
                }catch(\Exception $e){
                    return $request->session()->flash('success','Email Not Sent');
                }
            }

            $this->guard()->login($user);

            $route = '/home';
            if($role_id == 5){
                $route = '/appointment';
            }
            DB::commit();

            return $this->registered($request, $user) ?: redirect($route);
        }catch(\Exception $e) {
            DB::rollback();
            $request->session()->flash('success','Something Went Wrong');
            return back();
        }
    }

    public function loginform()
    {
        return view('userslogin.login');
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email|max:255',
            'password'=>'required|max:255'
        ]);
         $remember_me = $request->has('remember') ? true : false; 
         if(Auth::attempt(['email'=>$request->email,'password'=>$request->password],$remember_me))
         {
            $user = User::where('email',$request->email)->first();
            $route = '/home';
            if($user->role_id == 5){
                $route = '/appointment';
            }   
            return redirect($route);
        }
        
        return redirect('/')->with('message','Invalid Credentials.');
    }

    public function verify() {
        return view('userslogin.verify');
    }

    public function userLogout() {
        Auth::logout();
        return redirect('/');
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

    protected function registered(Request $request, $user)
    {
        //
    }

    public function verifyaccount(Request $request)
    {
        if(isset($_GET['detail'])){
           $UserId =  base64_decode($_GET['detail']);
           $UserStatus = User::where('id',$UserId)
                            ->update([
                                'verify_email'=>'Yes'
                            ]);
       
        return redirect('/')->with('success','Your Account is verified, Please Proceed');
    }
    else
        return redirect('/register')->with('success','Your Accont is not verified Register again');


        
    }
}
