<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\ServiceMenu;
use App\Business;
use App\UserBusiness;
use DB;
use Auth;

class StaffController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $user = auth()->user();
        $all_staff = DB::table('user_services')
                       ->join('users', 'users.id', 'user_services.user_id')
                       ->where('user_services.current_user_id', '=', $user->id)
                       ->groupBy('user_services.user_id')
                       ->whereNull('users.deleted_at')
                       ->get();

        $all_services = DB::table('user_services')
                            ->join('service_menu', 'service_menu.id', 'user_services.service_id')
                            ->where('user_services.user_id', '=', $user->id)
                            ->where('user_services.current_user_id', '=', 0)
                            ->whereNull('service_menu.deleted_at')
                            ->get();

        $select_services = DB::table('user_services')
                             ->join('service_menu', 'service_menu.id', 'user_services.service_id')
                             ->where('user_services.current_user_id', '=', $user->id)
                             ->whereNull('service_menu.deleted_at')
                             ->get();

        $business_id = DB::table('user_business')
                         ->join('users', 'users.id', 'user_business.user_id')
                         ->where('user_id', '=', $user->id)
                         ->whereNull('users.deleted_at')
                         ->first();
        
        return view('staff.index', compact('all_staff', 'all_services', 'business_id', 'select_services'));
    }


     public function store(request $request){
        
        $validator = \Validator::make($request->all(),[
            'staff_name' => 'required|regex:/^[a-zA-Z ]+$/|min:3|max:50',
            'email' => 'required|email|unique:users,email,'.$request->staff_user_id,
            'staff_mobile' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:5|max:10',    
            'staff_role' => 'required',
            'staff_service' => 'required'
        ],[
            'staff_name.required' => 'Staff name field required.',
            //'staff_name.regex:/^[a-zA-Z ]+$/' => 'Staff name must be string.',
            'staff_name.min' => 'Staff name must be 3 chars.',
            'staff_mobile.required' => 'Mobile field required.',    
            'staff_mobile.regex' => 'Mobile format invalid.',    
            'staff_mobile.min' => 'Mobile field required at least 5 digits.',    
            'staff_mobile.max' => 'Mobile field not be greater 10 digits.',    
            'staff_role.required' => 'Role filed required.',
            'staff_service.required' => 'Service field required.'
        ]);

        if($validator->fails()) {
            return response()->json(['error'=>$validator->errors(),'status'=>false]);
        }
        if($request->all()){
            $user = auth()->user();
            //$service = $request->staff_service;
            $business_id = $request->business_id;
            $service_id = $request->staff_service;
            $user_id = $request->staff_user_id;
            $staff = array(
                'name' => $request->staff_name,
                'email' => $request->email,
                'mobile' => $request->staff_mobile,
                'role_id' => $request->staff_role,
                'password' => Hash::make('123456789'),
            );
            $staff = DB::table('users')->updateOrInsert( ['id' => $user_id], $staff );
            if(!empty($user_id)){
                $user_id = $user_id;
            }else{
                $staff_id = DB::getPdo()->lastInsertId();
                $user_id = $staff_id;
            }
            $all_services = DB::table('user_services')->where('user_id', $user_id)->get();
            $all_services_arr = array();
            foreach($all_services as $all_services_arr_val){
                array_push($all_services_arr, $all_services_arr_val->service_id);
            }
            $main_arr = array_diff($all_services_arr, $service_id);
            foreach($main_arr as $arr){
                $delete_service[] = DB::table('user_services')->where('user_id', $user_id)->where('service_id', $arr)->delete();
            }
            foreach($service_id as $service_id_val) {
                $staff_service = array(
                    'user_id' => $user_id,
                    'service_id' => $service_id_val,
                    'current_user_id' => $user->id
                );
                DB::table('user_services')->updateOrInsert(
                                    ['user_id' => $user_id, 'service_id' => $service_id_val],
                                    $staff_service
                                    );
            }
            $user_id = DB::table('users')->orderBy('id', 'DESC')->first();
            $user_business = array(
                'user_id' => $user_id->id,
                'business_id' => $business_id
            );
            DB::table('user_business')->updateOrInsert( ['user_id'=>$user_id->id,'business_id'=>$business_id],$user_business);
            $request->session()->flash('success', 'Business Staff Updated Successfully.');
            return response()->json($staff);
        }
    }


    // public function destroy(Request $request)
    // {
    //     $id = $request->id;
    //     $data = User::find($id)->delete();      
    //     if($data){
    //         return back()->with('success_delete', 'Staff Deleted Successfully.');
    //     }   
    // }


}