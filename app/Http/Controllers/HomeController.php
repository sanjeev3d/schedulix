<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AppointmentModel;
use App\Models\CustomerModel;
use App\Models\ServiceAppointmentModel;
use Calendar;
use App\reg_step;
use DB;
use Auth;
use Carbon\Carbon;
use App\Notifications\CustomerAppointmentEmail;
use App\Notifications\CustomerVerificationEmail;
use MaddHatter\LaravelFullcalendar\Event;
use Illuminate\Validation\Rule;
use App\BusinessCategory;
use App\MainCategoryService;
use App\Business;
use App\UserBusiness;
use App\BusinessOtherDetails;
use App\Service;
use App\BusinessService;
use App\ServiceMenu;
use App\User;
use Crypt;
use App\BusinessTiming;
use Illuminate\Support\Facades\Hash;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   public function index($id ='')
    {
        
        if(Auth::check()){
            $getBusinessId = UserBusiness::where('user_id',Auth::id())->first();
            $business_category  = \App\BusinessCategory::all();
            $regStep  = \App\reg_step::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first(); 
            // dd($regStep);
            $events = array();
            if(Auth::user()->role_id == 5) {
                $appointmentData = CustomerModel::with('customerMultApp')->where('email',Auth::user()->email)->get();

                if($appointmentData->count() > 0) {
                    foreach ($appointmentData as $key => $item) {
                        # code...
                        if($item->customerMultApp->count() > 0){
                            array_push($events,$this->getCalenderdata($item->customerMultApp));
                        }
                    }
                }
            } else {
                $appointmentData = AppointmentModel::where('business_id',$getBusinessId['business_id'])->get();
                if($appointmentData->count() > 0) {
                   $events = $this->getCalenderdata($appointmentData);
                }
            }

            if(isset($events[0]->id)){
                $oneDimensionalArray = $events;
            } elseif(isset($events[0][0]->id)) {
                $oneDimensionalArray = call_user_func_array('array_merge', $events);
            } else {
                $oneDimensionalArray = [];
            }
            $weekdate = \Carbon\Carbon::today()->subDays(7);
            $calendar = Calendar::addEvents($oneDimensionalArray);
            $editAppointment = '';
            if($id){
                $id = base64_decode($id);
                $editAppointment = AppointmentModel::with('customerAppointment','serviceAppointment')
                                                    ->where('id',$id)
                                                    ->where('status','active')
                                                    ->first();
            }
            $customerData = CustomerModel::select("id","name")
                                        ->where("status","active")
                                        ->where('business_id',$getBusinessId['business_id'])
                                        ->where('created_at','>=',$weekdate)
                                        ->get();
            // dd($customerData);
            $servicesData = ServiceMenu::all();

            $customerbusiness = CustomerModel::with('customerBusinessName')
                            ->where('email',Auth::user()->email)
                            ->select('id','business_id')
                            ->groupBy('business_id')
                            ->get();
            // Weekly
            $appointments_cnt = AppointmentModel::where("status","active")
                                            ->where('created_at', '>=', $weekdate)
                                            ->where('business_id',$getBusinessId['business_id'])
                                            ->get();

            $total_sales_cnt = ServiceAppointmentModel::join('service_menu', 'service_menu.id','service_appointment_models.services_id')->where('business_id',$getBusinessId['business_id'])
                    ->where('service_appointment_models.created_at','>=',$weekdate)->get();
            
            //$totalSale = '';
            if(!empty($total_sales_cnt)){
                foreach($total_sales_cnt as $total_sale){
                    $totalSale[] = $total_sale->price;
                }
            }
            $total_sales = array();
            if(!empty($totalSale)){
                $total_sales = array_sum($totalSale);
            }
            $total_sales = $total_sales_cnt->sum('price');
            // dd($total_sales);

            // $total_customers_cnt = AppointmentModel::with('customerAppointment')
            //                                     ->where('status','active')
            //                                     ->where('business_id', auth()->user()->id)
            //                                     ->where('appointment_date', '>=', $weekdate)->get();
            $total_customers_cnt = DB::table("customer")
                                     ->select(DB::raw("WEEK(created_at) as month") ,DB::raw("(COUNT(*)) as count_new_user"))
                                     ->where('business_id',$getBusinessId['business_id'])
                                     ->orderBy('created_at', 'ASC')
                                     ->groupBy(DB::raw("WEEK(created_at)"))
                                     ->get();

            $total_customers_cnt = count($total_customers_cnt);

            // Monthly Customer Count
            $monthly_customer_count = DB::table("customer")
                                     ->select(DB::raw("MONTHNAME(created_at) as month") ,DB::raw("(COUNT(*)) as count_new_user"))
                                     ->where('business_id',$getBusinessId['business_id'])
                                     ->orderBy('created_at', 'ASC')
                                     ->groupBy(DB::raw("MONTHNAME(created_at)"))
                                     ->get();
                                     // dd($monthly_customer_count);
            if(!empty($monthly_customer_count)){
                foreach ($monthly_customer_count as $monthly_customer) {
                    $month_cust_arr[] = $monthly_customer;
                }
            }

            $total_month_cust_report = array();
            if(!empty($month_cust_arr)){
                foreach ($month_cust_arr as $key => $value) {
                    $total_month_cust_report[$key]['label'] = $value->month; 
                    $total_month_cust_report[$key]['y'] = $value->count_new_user;
                }
            }

            // Sales Monthly Price Total 
            $sales_monthly_price_total = DB::table("service_appointment_models")
                                        ->join('service_menu', 'service_menu.id', 'service_appointment_models.services_id')
                                        ->orderBy('service_appointment_models.created_at', 'ASC')
                                        ->select(DB::raw("MONTHNAME(service_appointment_models.created_at) as month") ,DB::raw("(SUM(service_menu.price)) as price_sum"))
                                        ->where('service_menu.business_id',$getBusinessId['business_id'])
                                        ->groupBy(DB::raw("MONTHNAME(service_appointment_models.created_at)"))
                                        ->get();
                                        // dd($sales_monthly_price_total);
            if(!empty($sales_monthly_price_total)){
                foreach ($sales_monthly_price_total as $sales_monthly_price) {
                    $month_revenue_arr[] = $sales_monthly_price;
                }
            }
            

            $total_month_revunue_report = array();
            if(!empty($month_revenue_arr)){
                foreach ($month_revenue_arr as $key => $value) {
                    $total_month_revunue_report[$key]['label'] = $value->month; 
                    $total_month_revunue_report[$key]['y'] = $value->price_sum;
                }
            }


            // Yearly Customer Count
            $yearly_customer_count = DB::table("customer")
                                    ->where('business_id',$getBusinessId['business_id'])
                                     ->select(DB::raw("YEAR(created_at) as year") ,DB::raw("(COUNT(*)) as count_new_user"))
                                     ->orderBy('created_at')
                                     ->groupBy(DB::raw("YEAR(created_at)"))
                                     ->get();
            if(!empty($yearly_customer_count)){
                foreach ($yearly_customer_count as $yearly_customer) {
                    $year_cust_arr[] = $yearly_customer;
                }
            }

            $total_year_cust_report = array();
            if(!empty($year_cust_arr)){
                foreach ($year_cust_arr as $key => $value) {
                    $total_year_cust_report[$key]['label'] = $value->year; 
                    $total_year_cust_report[$key]['y'] = $value->count_new_user;
                }
            }

            // Sales Yearly Price Total 
            $sales_yearly_price_total = DB::table("service_appointment_models")
                                        ->join('service_menu', 'service_menu.id', 'service_appointment_models.services_id')
                                        ->orderBy('service_appointment_models.created_at')
                                        ->where('service_menu.business_id',$getBusinessId['business_id'])
                                        ->select(DB::raw("YEAR(service_appointment_models.created_at) as year") ,DB::raw("(SUM(service_menu.price)) as price_sum"))
                                        ->groupBy(DB::raw("YEAR(service_appointment_models.created_at)"))
                                        ->get();

            if(!empty($sales_yearly_price_total)){
                foreach ($sales_yearly_price_total as $sales_yearly_price) {
                    $year_revenue_arr[] = $sales_yearly_price;
                }
            }

            $total_year_revenue_report = array();
            if(!empty($year_revenue_arr)){
                foreach ($year_revenue_arr as $key => $value) {
                    $total_year_revenue_report[$key]['label'] = $value->year; 
                    $total_year_revenue_report[$key]['y'] = $value->price_sum;
                }
            }

            $total_customers_monthly_cnt = CustomerModel::where('business_id', $getBusinessId['business_id'])->select(DB::raw('MONTH(created_at) month'))->groupby('month')->get();

            $total_customers_monthly_cnt = count($total_customers_monthly_cnt);

            $total_sales_datas = ServiceMenu::join("service_appointment_models", 'service_menu.id', 'service_appointment_models.services_id')
                                            ->join("appointment_models", 'appointment_models.id', 'service_appointment_models.appointment_id')
                                            ->where('appointment_models.appointment_date', '>=', $weekdate)
                                            ->get();

            $main_category = DB::table('main_category')->get();
            $main_services_category = DB::table('main_category_service')->get();
            // return response()->json(array('success' => true, 'data'=>$main_services_category));
            // return json_encode($Response);
            // dd($total_customers_cnt);
           
            // dd($getBusinessId);
            $servicebutton = ServiceMenu::where('business_id', '=', $getBusinessId['business_id'])->whereNull('deleted_at')->first();
            //$servicebutton = ServiceMenu::where('business_id', Auth()->user()->id)->first();
            $staffbutton = DB::table('user_services')->join('users', 'users.id', 'user_services.user_id')->where('user_services.current_user_id', Auth()->user()->id)->whereNull('users.deleted_at')->first();
            $businessinfobutton = DB::table('business_other_details')->where('user_id', Auth()->user()->id)->first();
            $businesstiminigsmodal = DB::table('business_timing')->where('business_id', $getBusinessId['business_id'])->first();
            $privacyandpolicy = DB::table('privacy')->where('user_id', Auth()->user()->id)->first();
            $total_customers = DB::table('customer')->where('business_id', $getBusinessId['business_id'])->first();
            //$BusId = UserBusiness::where('user_id',Auth::id())->first();
            $getCurrency = BusinessOtherDetails::where('business_id',$getBusinessId['business_id'])->first();
            // dd($total_customers);
            $payment_setup = '';
            $maxpoints = 100;
            $point = 0;
            if($servicebutton != '')
                $point+=15;
            if($staffbutton != '')
                $point+=15;
            if($businessinfobutton != '')
                $point+=15;
            if($businesstiminigsmodal != '')
                $point+=15;
            if($privacyandpolicy != '')
                $point+=10;
            if($total_customers != '')
                $point+=15;
            if($payment_setup != '')
                $point+=15;
            $percentage = ($point*$maxpoints)/100;
            session(['percentage' => $percentage]);

            if($regStep){
                return view('home', compact('regStep','getCurrency','business_category','servicesData','calendar','customerData','editAppointment','id','customerbusiness', 'total_customers_cnt', 'total_sales_cnt', 'appointments_cnt', 'total_sales_datas', 'total_month_cust_report', 'total_month_revunue_report', 'total_year_cust_report', 'total_year_revenue_report', 'total_sales', 'servicebutton', 'staffbutton', 'businesstiminigsmodal', 'main_category', 'main_services_category', 'businessinfobutton', 'privacyandpolicy', 'total_customers', 'getBusinessId'));
            }else{
                return view('home', compact('business_category','getCurrency','servicesData','calendar','customerData','editAppointment','id','customerbusiness', 'total_customers_cnt', 'total_sales_cnt', 'appointments_cnt', 'total_sales_datas', 'total_month_cust_report', 'total_month_revunue_report', 'total_year_cust_report', 'total_year_revenue_report', 'total_sales', 'servicebutton', 'staffbutton', 'businesstiminigsmodal', 'main_category', 'main_services_category', 'businessinfobutton', 'privacyandpolicy', 'total_customers', 'getBusinessId'));
            }
        }
    }

    public function getCalenderdata($data){
        foreach ($data as $key => $value) {
            if($key % 2 == 0){
                $color = '#3399ff';
            } else {
                $color = '#f05050';
            }
            $events[] = Calendar::event(
               '',
                false,
                new \DateTime($value->appointment_date.' '.$value->time_from),
                new \DateTime(($value->appointment_date.' '.$value->time_to)),
               'stringEventId',
                // Add color and link on event
                [
                    'color' => $color,
                    'url' => asset('appointment/'.base64_encode($value->id)),
                ]
            );
        }
        return $events;
    }

    public function step_one(Request $request){
      
        if($request->all()){
            $business = new Business;
            $business->business_cat_id = $request->business_type;
            $business->save();
            $business_id = $business->id;
            if($business){
                $user_business = new UserBusiness; 
                $user_business->user_id = Auth::user()->id;
                $user_business->business_id = $business->id;
                $user_business->save();
                if($user_business){
                    \App\reg_step::updateOrCreate(
                        ['user_id' => Auth::user()->id],
                        ['step' => 1, 'status' => 1]
                    );

                    // $service = \App\Service::all();
                    // $returnHTML = view('reg_step.step_2',compact("business_id","service"))
                    // // ->with("business_id", "1")
                    // ->render();
                    // return response()->json(array('success' => true, 'html'=>$returnHTML));
                }
            }
            // $Response = array(
            //     'code'=> "200",
            //     'status'=>"error",
            // );
            // return json_encode($Response);
             return redirect()->route('home');
        }
    }
    public function step_two(Request $request){
        
        if($request->all()){

            $business_service = new  BusinessService;
            $business_service->business_id = $request['business_id'];
            $business_service->service_id = $request['service_id'];
            $business_service->save();
            $business_id = $request['business_id'];
            if($business_service){
                \App\reg_step::updateOrCreate(
                    ['user_id' => Auth::user()->id],
                    ['step' => 2, 'status' => 1]
                );
                $selectedService = \App\BusinessService::where('business_id',$request['business_id'])->get();
                $returnHTML = view('reg_step.step_3',compact('selectedService','business_id' ))->render();
                return response()->json(array('success' => true, 'html'=>$returnHTML));
            }

            $Response = array(
                'code'=> "200",
                'status'=>"error",
            );
            return json_encode($Response);
        }
        
    }
    public function step_three(Request $request){
       //dd($request->all());
        foreach ($request->get('select_service') as $key => $value) {
            $rules['select_service.'.$key] = 'required';
        }
         foreach ($request->get('duration') as $key => $value) {
            $rules['duration.'.$key] = 'required';
        }
        foreach($request->get('price') as $key => $val)
        {
            $rules['price.'.$key] = 'nullable|numeric|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/';
        }
        $messages = [
            'duration.*.required' =>'Time field required.',
            'price.*.numeric' =>'price field must be numeric and upto two decimal palce.',
            'price.*.regex' =>'price format in valid.',
            'select_service.*.required' =>'Service name field required.',
        ];
        $validator = \Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = auth()->user();
        // dd($request->all());
        if($request->all()){
            $user = auth()->user();

            if(is_null($request->business_id)){
                DB::table('business')->insert(
                                            ['business_cat_id' => 1]
                                        );
                $business_id = DB::getPdo()->lastInsertId();
            }
            else{
                $business_id = $request->business_id;
            }
            if(is_null($business_id)){
                return back()->with('create_error', 'Business Serives Not Added.');
            }else{
                if(isset($request->service_name)){
                    // dd($request->service_name);
                    foreach ($request['service_name'] as $key => $value) {
                        $main_category = new MainCategoryService;
                        $main_category->main_category_id = $request->category_id;
                        $main_category->service_name = $value;
                        $main_category->save();
                    }
                    foreach ($request['service_name'] as $key => $value) {
                        # code...
                        // $rules = array([
                        //     'price' => 'max:2'
                        // ]);
                        // $this->validate($request, $rules);
                        // dd('valid');
                        $service_menu = new ServiceMenu;
                        $service_menu->business_id = $request['business_id'];
                        $service_menu->name = $value;
                        $service_menu->duration = $request['duration'][$key];
                        $service_menu->price = $request['price'][$key];
                        $service_menu->save();

                        $user_service = array(
                            'user_id' => $user->id,
                            'service_id' => $service_menu->id,
                            'current_user_id' => 0
                        );
                        DB::table('user_services')->updateOrInsert(
                                                            ['user_id' => $user->id, 'service_id' => $service_menu->id],
                                                            $user_service
                                                            );
                        $user_business = array(
                            'user_id' => $user->id,
                            'business_id' => $business_id
                        );

                        DB::table('user_business')->updateOrInsert(
                                                            ['user_id' => $user->id, 'business_id' => $business_id],
                                                            $user_business
                                                        );
                    }

                    $service_id = DB::getPdo()->lastInsertId();

                    $user_service = array(
                        'user_id' => $user->id,
                        'service_id' => $service_id,
                        'current_user_id' => 0
                    );
                    DB::table('user_services')->updateOrInsert(
                                                            ['user_id' => $user->id, 'service_id' => $service_id],
                                                            $user_service
                                                        );
                }
                if(isset($request->select_service)){
                    foreach ($request['select_service'] as $key => $value) {
                        # code...
                        // $rules = array([
                        //     'price' => 'max:2'
                        // ]);
                        // $this->validate($request, $rules);
                        // dd('valid');
                        $service_menu = new ServiceMenu;
                        $service_menu->business_id = $request['business_id'];
                        $service_menu->main_category_id = $request['category_id'];
                        $service_menu->name = $value;
                        $service_menu->duration = $request['duration'][$key];
                        $service_menu->price = $request['price'][$key];
                        $service_menu->save();

                        $user_service = array(
                            'user_id' => $user->id,
                            'service_id' => $service_menu->id,
                            'current_user_id' => 0
                        );
                        DB::table('user_services')->updateOrInsert(
                                                            ['user_id' => $user->id, 'service_id' => $service_menu->id],
                                                            $user_service
                                                            );
                        $user_business = array(
                            'user_id' => $user->id,
                            'business_id' => $business_id
                        );

                        DB::table('user_business')->updateOrInsert(
                                                            ['user_id' => $user->id, 'business_id' => $business_id],
                                                            $user_business
                                                        );
                    }

                    $service_id = DB::getPdo()->lastInsertId();

                    $user_service = array(
                        'user_id' => $user->id,
                        'service_id' => $service_id,
                        'current_user_id' => 0
                    );
                    DB::table('user_services')->updateOrInsert(
                                                            ['user_id' => $user->id, 'service_id' => $service_id],
                                                            $user_service
                                                        );
                        // dd($user_service);
                }
                // return back()->with('create_success', 'Business Services Added Successfully.');
            } 
            return redirect()->route('home'); 
        }
        
    }
    public function step_four_ajax(Request $request){

        $alluser = DB::table('users')->get();

        if(!empty($alluser)){
            foreach($alluser as $user){
                    $user_email[] = $user->email;
            }
        }

        if(!empty($request->staff)){
            foreach ($request->staff as $key => $email) {
                $new_email[] = $email['email'];
                
            }
        }

        $same_email = array_intersect($new_email, $user_email);
        $same_email = array_unique($same_email);
        $final_output = "";
        if(!empty($same_email)){
            $final_output = array('status'=>'success', 'data'=>$same_email);
        }
        else{
            $final_output = array('status'=>'error');
        }
        return response()->json($final_output);
        /*echo "<pre>";
        print_r($same_email);
        die;*/

    }
    public function step_four(Request $request){
        //print_r($request->all());exit;
        $user = auth()->user();
        // $alluser = DB::table('users')->get();
        $business_id = $request['business_id'];
         if($request->all()){
            // dd($request->all());
            foreach ($request['staff'] as $key => $value) {
                # code...
                // foreach($alluser as $user){
                //     if($value['email'] == $user->email){
                //         return redirect()->route('home')->with('emailexisist', 'Staff email already exist.');
                //     }
                // }
                
                $staff = new User;
                $staff->name = $value['name'];
                $staff->email = $value['email'];
                $staff->mobile = $value['phone'];
                $staff->role_id = $value['role'];
                $staff->password = Hash::make('12345678');

               // dd($request->all());
                $staff->save();
                if(!empty($staff)){
                    $staff_service = array(
                        'user_id' => $staff->id,
                        'service_id' => 0,
                        'current_user_id' => $user->id
                    );
                    DB::table('user_services')->updateOrInsert(
                                                        ['user_id' => $staff->id, 'service_id' => 0],
                                                        $staff_service
                                                        );
                    $user_business = new UserBusiness; 
                    $user_business->user_id = $staff->id;
                    $user_business->business_id = $business_id;
                    $user_business->save();
                }
            }
            return redirect()->route('home');
        }
    }

    public function step_five(Request $request){
        //print_r($request->all());exit;
        if($request->all()){

            foreach ($request['week'] as $key => $value) {
                if(@$value['check']){
                    $business_hour = new BusinessTiming;
                    $business_hour->day = $key;
                    $business_hour->start_time = $value['from'];
                    $business_hour->end_time = $value['to'];
                    $business_hour->business_id = $request['business_id'];
                    $business_hour->save();
                }
            }
            // if($business_hour){
            //     $business_id = $request['business_id'];
            //     \App\reg_step::updateOrCreate(
            //         ['user_id' => Auth::user()->id],
            //         ['step' => 5, 'status' => 1]
            //     );
            //     $returnHTML = view('reg_step.step_6')->with("business_id", $business_id)->render();
            //     return response()->json(array('success' => true, 'html'=>$returnHTML));
            // }

            // $Response = array(
            //     'code'=> "200",
            //     'status'=>"error",
            // );
            // return json_encode($Response);
            return redirect()->route('home');
        }
    }
    public function step_six(Request $request){
        
        if($request->all()){

            $business = Business::find($request->business_id);
            $business->business_cat_id = $business->business_cat_id;
            $business->name = $request->business_name;
            $business->address = $request->business_address;
            $business->country = $request->business_country;
            $business->region = $request->business_region;
            $business->city = $request->business_city;
            $business->zip = $request->business_zip;
            $business->timezone = $request->business_timezone;
            $business->save();

            if($business){
                \App\reg_step::updateOrCreate(
                    ['user_id' => Auth::user()->id],
                    ['step' => 6, 'status' => 1]
                );
                return response()->json(array('codee' => 100));
            }
            $Response = array(
                'codee'=> "200",
                'status'=>"error",
            );
            return json_encode($Response);
        }
    }

    public function findstep(Request $request){
        //dd($request->all());
        if($request->all()){
            if($request->id == 1){
                $business_id = \App\UserBusiness::where('user_id',Auth::user()->id)->first();
                $business_id = $business_id->business_id;
                $service = \App\Service::all();
                $returnHTML = view('reg_step.step_2',compact("business_id","service"))
                // ->with("business_id", "1")
                ->render();
                return response()->json(array('success' => true, 'html'=>$returnHTML));
            }
            if($request->id == 2){
                $business_id = \App\UserBusiness::where('user_id',Auth::user()->id)->first();
                $business_id = $business_id->business_id;
                $selectedService = \App\BusinessService::where('business_id',$business_id)->get();
                $returnHTML = view('reg_step.step_3',compact('selectedService','business_id' ))->render();
                return response()->json(array('success' => true, 'html'=>$returnHTML));
            }elseif($request->id == 3){
                $business_id = \App\UserBusiness::where('user_id',Auth::user()->id)->first();
                $business_id = $business_id->business_id;
                $returnHTML = view('reg_step.step_4')->with('business_id', $business_id)->render();
                return response()->json(array('success' => true, 'html'=>$returnHTML));
            }elseif($request->id == 4){
                $business_id = \App\UserBusiness::where('user_id',Auth::user()->id)->first();
                $business_id = $business_id->business_id;
                $returnHTML = view('reg_step.step_5')->with('business_id', $business_id)->render();
                return response()->json(array('success' => true, 'html'=>$returnHTML));
            }elseif($request->id == 5){
                $business_id = \App\UserBusiness::where('user_id',Auth::user()->id)->first();
                $business_id = $business_id->business_id;
                $returnHTML = view('reg_step.step_6')->with('business_id', $business_id)->render();
                return response()->json(array('success' => true, 'html'=>$returnHTML));
            }else{
                $Response = array(
                    'codee'=> "100",
                    'status'=>"success"
                );
                return json_encode($Response);
            }
        }
    }

    /*Customers filtered record  show*/
    public function searchRecord(Request $request) { 
        
        $filter = $request->filter;
        $arrange = $request->sort;
        $searchterm = $request->term;

        if($arrange=='alphabet'){
            $customerData = User::select('id','image','name','last_name')
            ->where('status',$filter);
            if(!empty($searchterm)){
                $customerData = $customerData->where('name','LIKE','%'.$searchterm.'%'); 
            }
            $data['customerData'] = $customerData->orderBy('name', 'ASC')->get();
        }else if($arrange=='oldest'){
            $customerData = User::select('id','image','name','last_name')
            ->where('status',$filter);
            if(!empty($searchterm)){
                $customerData = $customerData->where('name','LIKE','%'.$searchterm.'%'); 
            }
            $data['customerData'] = $customerData->orderBy('created_at', 'ASC')->get();
        } else {
            $customerData = User::select('id','image','name','last_name','status')
            ->where('status',$filter);
            if(!empty($searchterm)){
                $customerData = $customerData->where('name','LIKE','%'.$searchterm.'%'); 
            }
            $data['customerData'] = $customerData->orderBy('created_at', 'DESC')->get();
        }

        $returnHTML = view('customers.customer-filter')->with($data)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));

    }

    public function step_three_modal() { 

        $view = view("reg_step.step_3")->render();

        return response()->json(['html'=>$view]);
    }

    public function main_category_service(Request $request){
        $main_services_category = DB::table('main_category_service')->where('main_category_id', $request->id)->get();
        // dd($main_services_category);
            return response()->json(array('success' => true, 'data'=>$main_services_category));
            return json_encode($Response);
    }
    
}