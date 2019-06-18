<?php

namespace App\Http\Controllers;

use DateTimeZone;
use DateTime;
use Auth;
use DB;
use App;
use Illuminate\Http\Request;
use App\BusinessOtherDetails;
use App\UserBusiness;
use Illuminate\Support\Facades\Hash;
/*use Illuminate\Support\Facades\Storage;*/



class BusinessDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  
    }

    public function index(){

        $user = auth()->user();
        $tzlists = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
        $zones_array = array();
        $timestamp = time();
        foreach(timezone_identifiers_list() as $key => $zone) {
            date_default_timezone_set($zone);
            $zones_array[$key]['zone'] = $zone;
            $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
        }

        $country = DB::table('country')->get();
        $state = DB::table('state')->get();
        $city = DB::table('city')->get();

        $profession = DB::table('main_category')->get();

        $getBusinessId = UserBusiness::where('user_id',Auth::id())->first();
        if(isset($getBusinessId)){
            $user_profession = DB::table('business_other_details')->where('business_id', $getBusinessId->business_id)->first();
        }

        if(isset($user->mybusiness->business)){
            $state_name = DB::table('state')->where('id', $user->mybusiness->business->state)->first();
            $city_name = DB::table('city')->where('id', $user->mybusiness->business->city)->first();
        }

        if(isset($state_name) || isset($city_name)){
            return view('business_details.index', compact('user', 'zones_array', 'country', 'state', 'city', 'profession', 'user_profession', 'state_name', 'city_name'));
        }else{
            return view('business_details.index', compact('user', 'zones_array', 'country', 'state', 'city', 'profession', 'user_profession'));
        }

    }

/* store business details */
    public function store(Request $request){
        $rules = [
            'business_name' => 'required|min:3|regex:/^[a-zA-Z ]+$/|max:255',
            'business_location' => 'required',
            'business_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:5|max:10',
            'bus_pincode' => 'nullable|min:6|max:6',
        ];
        $messages = array(
            'bus_pincode.min'=>'Business pincode at least 6 chars.',          
            // 'bus_pincode.regex:/^[a-zA-Z ]+$/'=>'Business name must be string.',          
            'business_name.min'=>'Business name at least 3 chars long.', 
        );
        // validate
        $this->validate($request, $rules,$messages);
        DB::beginTransaction();
            try{
                if($request->all()){
                    $user = auth()->user();
                    try{

                        if($request->hasfile('upload_file')){
                            $destinationPath = 'business_logo';
                            $business_logo = time().'_'.$request->file('upload_file')->getClientOriginalName();
                            $request->file('upload_file')->move($destinationPath, $business_logo);
                            $business = array(
                                'business_id' => $request->business_id,
                                'user_id' => $user->id,
                                'profession_name' => $request->prof_name,
                                'business_phone' => $request->business_phone,
                                'time_formate' => $request->time_formate,
                                'date_formate' => $request->date_formate,
                                'currency' => $request->currency,
                                'currency_formate' => $request->currency_formate,
                                'language_pref' => $request->language_preference,
                                'select_language' => $request->select_language,
                                'home_phone' => $request->home_phone,
                                'work_phone' => $request->work_phone,
                                'business_logo'=> $business_logo,
                                'business_description'=> $request->business_description
                            );
                        }else{
                            $business = array(
                                'business_id' => $request->business_id,
                                'user_id' => $user->id,
                                'profession_name' => $request->prof_name,
                                'business_phone' => $request->business_phone,
                                'time_formate' => $request->time_formate,
                                'date_formate' => $request->date_formate,
                                'currency' => $request->currency,
                                'currency_formate' => $request->currency_formate,
                                'language_pref' => $request->language_preference,
                                'select_language' => $request->select_language,
                                'home_phone' => $request->home_phone,
                                'work_phone' => $request->work_phone,
                                'business_description' => $request->business_description,
                            );
                        }
                        DB::table('business_other_details')
                            ->updateOrInsert([ 'business_id' => $request->business_id,
                                            'user_id' => $user->id],$business);

                    }catch(\Exception $e){
                        $request->session()->flash('error', 'Something Error in Business Other Details Data Save.');
                    }
                    try{
                        $business_data = array(
                            'name' => $request->business_name,
                            'address' => $request->business_location,
                            'city' => $request->bus_city,
                            'country' => $request->bus_country,
                            'state' => $request->bus_state,
                            'zip' => $request->bus_pincode,
                            'timezone' => $request->timezone_currency,
                        );
                        DB::table('business')->where('id', $request->business_id)->update($business_data);
                    }catch(\Exception $e){
                         $request->session()->flash('error', 'Something Went wrong in Business Data Save.');
                    }
                    $user_data = array(
                                        'mobile'=>$request->mobile_phone,
                                        'email' => $request->personal_email,
                                        'name' => $request->personal_fname ,
                                        'last_name' => $request->personal_lname 
                                     ); 
                    if($request->change_pass){
                        $pass = Hash::make($request->change_pass);
                        $user_data += array('password' => $pass);
                    }
                    DB::table('users')->where('id', $user->id)->update($user_data);
                    $request->session()->flash('success', 'Business Details Updated Successfully.');
                }
            DB::commit();
            return back();
        }catch(\Exception $e){
            DB::rollback();
            return  $request->session()->flash('error', 'Something Went wrong.');
        }
    }

/* return state data*/
    public function Country(Request $request){

        $state = DB::table('state')->where('country_id', $request->country_id)->get();
        
        return response()->json($state);
    }

/* return city data */
    public function State(Request $request) {

        $city = DB::table('city')->where('state_id', $request->state_id)->get();

        return response()->json($city);
    }
}