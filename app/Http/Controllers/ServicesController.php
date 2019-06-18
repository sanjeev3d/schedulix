<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceMenu;
use App\Business;
use App\UserBusiness;
use DB;
use Auth;
use Validator;


class ServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        $user = auth()->user();
        $getBusinessId = UserBusiness::where('user_id',Auth::id())->first();
        $businessinfo = DB::table('business_other_details')->where('user_id', Auth()->user()->id)->first();
        $users_services_data = DB::table('service_menu')
                                  ->where('business_id','=',$getBusinessId['business_id'])
                                  ->whereNull('deleted_at')
                                  ->get();

        return view('services.index', compact('users_services_data', 'getBusinessId', 'businessinfo'));
    }

/* Edit services Details*/
    public function create(request $request){
        $rules = [
            'service_name' => 'required',
            'service_price' => 'required|numeric|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'service_duration' => 'required'
        ];
        $messages = [
             'service_name.required' => 'Service name field required.',
             'service_duration.required' => 'Service duration field required.',
             'service_price.required' => 'Price field required.',
             'service_price.numeric' => 'Price field must be numeric.',
        ];
        $this->validate($request, $rules);
        if($request->all()){
            $user = auth()->user();
            if(is_null($request->business_id)){
                DB::table('business')->insert(['business_cat_id' => 1]);
                $business_id = DB::getPdo()->lastInsertId();
            }else{
                $business_id = $request->business_id;
            }
            if(is_null($business_id)){
                return back()->with('create_error', 'Business Serives Not Added.');
            }else{
                $service_menu = new ServiceMenu;
                $service_menu->business_id = $request->business_id;
                $service_menu->name = $request->service_name;
                $service_menu->duration = $request->service_duration;
                $service_menu->price = $request->service_price;
                $service_menu->save();

                $service_id = DB::getPdo()->lastInsertId();
                $user_service = array(
                    'user_id' => $user->id,
                    'service_id' => $service_id,
                    'current_user_id' => 0
                );
                DB::table('user_services')->updateOrInsert(['user_id' =>$user->id,'service_id'=>$service_id],$user_service );
                $user_business = array('user_id' => $user->id,'business_id' => $business_id);
                DB::table('user_business')->updateOrInsert(['user_id' =>$user->id,'business_id'=>$business_id],$user_business);
                $request->session()->flash('success', 'Business Services updated Successfully.');
                return back();
            }  
        }else{
            return redirect()->route('services.index')->with('create_error', 'Business Services Not Added.');
        }
    }

/* service details store */
    public function store(request $request){
        $rules = [
            'modal_service_name' => 'required|min:3|regex:/^[a-zA-Z ]+$/|max:100',
            'modal_service_duration' => 'required',
            'modal_service_price' => 'required|numeric|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
        ];
        $messages = [
            'modal_service_name.required' => 'Service name field required.',
            'modal_service_name.min' => 'Service name field must be 3 chars long.',
            // 'modal_service_name.regex:/^[a-zA-Z ]+$/' => 'Service name must be string.',
            'modal_service_duration.required' => 'Service duration field required.',
            'modal_service_price.required' => 'Price field required.',
            'modal_service_price.numeric' => 'Price field must be numeric.',
        ];
        // validator
        $validator = Validator::make($request->all(), $rules,$messages);
        if($validator->fails()) {
            return response()->json(['error'=>$validator->errors(),'status'=>false]);
        }
        if($request->all()){
            $user = auth()->user();
            if(is_null($request->business_id)){
                $business_id = DB::table('business')->insert(['business_cat_id' => 1]);
            }else{
                $business_id = $request->business_id;
            }
            $business_service = array(
                'name' => $request->modal_service_name,
                'price' => $request->modal_service_price,
                'duration' => $request->modal_service_duration,
                'business_id' => $business_id
            );
            DB::table('service_menu')->updateOrInsert([
                    'business_id' => $business_id, 
                    'id' => $request->service_menu_id
                    ],$business_service);

            $user_business = array('user_id' => $user->id,'business_id' => $business_id);
            DB::table('user_business')->updateOrInsert([
                    'user_id' => $user->id, 
                    'business_id' => $business_id
                ],$user_business);
            $request->session()->flash('success', 'Business Services Added Successfully.');
            return response()->json(['status'=>true]);
        }
    }

    public function destroy($id){
        $data = ServiceMenu::find($id)->delete();   
        if($data){
            return back()->with('success', 'Business Services Deleted Successfully.');
        }   
    }
}