<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserBusiness;
use App\BusinessTiming;
use Auth;
use DB;

class BussinessTimingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  
    }

    public function index() {
    	$getBusinessId = UserBusiness::where('user_id',Auth::id())->first();
    	$business_time = DB::table('business_timing')->where('business_id', $getBusinessId->business_id)->get();

    	return view('bussiness_timing.index', compact('getBusinessId', 'business_time'));
    }

/* business timing store */
    public function store(Request $request){
        DB::table('business_timing')->where('business_id',$request->business_id)->delete();
    	if(isset($request['week'])){
            foreach ($request['week'] as $key => $value) {
                $user_bus_time = array(
                	'day' => $key,
                	'start_time' => $value['from'],
                	'end_time' => $value['to'],
                	'business_id' => $request['business_id'],
                );
                DB::table('business_timing')->updateOrInsert(
                	['day' => $key, 'business_id' => $request['business_id']],
                	$user_bus_time
                );
            }
        }
        $request->session()->flash('success','Business Timing Added Successfully.');
        return redirect()->back();
    }
}
