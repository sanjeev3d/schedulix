<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AppointmentModel;
use Calendar;
use App\ServiceMenu;
use App\Models\CustomerModel;
use App\Models\ServiceAppointmentModel;
use App\User;
use App\UserBusiness;
use App\BusinessTiming;
use Auth;
use Carbon\Carbon;
use App\Notifications\CustomerAppointmentEmail;
use App\Notifications\CustomerVerificationEmail;
use MaddHatter\LaravelFullcalendar\Event;
use Illuminate\Validation\Rule;
use DB;
use App\BusinessOtherDetails;
use DataTables;

class AppointmentController extends Controller
{

    public function index($id ='',Request $request )
    {

        $input = $request->all();
        if(isset($input['microsite'])){
            $url = base64_decode($input['microsite']);
            return view('appointment.microsite');
        }
        if(isset($input['open'])){
            $url = base64_decode($input['open']);
        }
        if(!empty( $url)){
            $openPopup = $url;
        }else{
            $openPopup = '';
        }

        $businessId = '';
        $bus_id = '';
        $busIId = '';
        $events = array();
        if(!empty(Auth::user()->role_id) && Auth::user()->role_id == 5) {
            $appointmentData = CustomerModel::with('customerMultApp')->where('email',Auth::user()->email)->get();
           
            // $getBusinessId = UserBusiness::where('user_id',Auth::id())->first();
            // $businessId = $getBusinessId->business_id;
            $businessId = $appointmentData[0]->business_id;
            $getCurrency = BusinessOtherDetails::where('business_id',$businessId)->first();
            if($appointmentData->count() > 0) {
                foreach ($appointmentData as $key => $item) {
                    # code...
                    if($item->customerMultApp->count() > 0){
                        array_push($events,$this->getCalenderdata($item->customerMultApp));
                    }
                }
            }

        }else{
            if(!empty(Auth::user()->role_id) && Auth::user()->role_id == 2) {

                $getBusinessId = UserBusiness::where('user_id',Auth::id())->first();
                $businessId = $getBusinessId->business_id;
                $appointmentData = AppointmentModel::where('business_id', $getBusinessId->business_id)->get();
                if($appointmentData->count() > 0) {
                    $events = $this->getCalenderdata($appointmentData);
                }
            }
        }
        if(isset($events[0]->id)){
            $oneDimensionalArray = $events;
        } else if(isset($events[0][0]->id)) {
            $oneDimensionalArray = call_user_func_array('array_merge', $events);
        } else {
            $oneDimensionalArray = [];
        }

        $calendar = Calendar::addEvents($oneDimensionalArray);
        $editAppointment = '';
        if($id && !empty(Auth::id())){
            $id = base64_decode($id);
            $editAppointment = AppointmentModel::with('customerAppointment','serviceAppointment')->where('id',$id)->where('status','active')->first();
          
        }
        $servicesData =  array();
        if(!empty(Auth::id())) {

            if(!empty(Auth::user()->role_id) && (Auth::user()->role_id == 2 )) {
                if($getBusinessId) {
                    $customerData = CustomerModel::select("*")->where("status","active")
                                                 ->where('business_id', $businessId)
                                                 ->where('user_business_id',Auth::id())
                                                 ->first();
                    $servicesData = ServiceMenu::where('business_id',$getBusinessId->business_id)->get();
                    $getCurrency = BusinessOtherDetails::where('business_id',$getBusinessId->business_id)->first();
                }
            }else if(!empty(Auth::user()->role_id) && (Auth::user()->role_id == 5 )) {
                
                    $servicesData = ServiceMenu::where('business_id',$businessId)->get();
                    $user = user::where('id',Auth::id())->first();
                   // dd($businessId);

                    $customerData = CustomerModel::where('email',$user->email)
                                                ->where('business_id',$businessId)
                                                ->first();
            }
            $allMemberData = UserBusiness::with('getMember')->where('business_id',$businessId)->get();
            $allMember = array();
            foreach ($allMemberData as $key => $value) {
                if(!empty($value->getMember)){
                    array_push($allMember, $value->getMember);
                }
            }
        }else {   //api user business details
            $events = array();
            if(empty(Auth::user()->role_id)){
                $calendar = Calendar::addEvents($events);
            }else if(!empty(Auth::id())){
                return redirect('/home');
            }
            $bus_id = $id;
            $userInfo = User::where('role_id',2)->where('unique_id',$bus_id)->first();
            $servicesData = array();
            if(!empty($userInfo)) {
                $BusId = UserBusiness::where('user_id',$userInfo->id)->first();
                $getCurrency = BusinessOtherDetails::where('business_id',$BusId->business_id)->first();
                $businessId = $BusId->business_id;  
                $busIId = $BusId->business_id; //business Id
                $customerData = CustomerModel::select("id","name")->where("status","active")->get();
                $servicesData = ServiceMenu::where('business_id',$BusId->business_id)->get();
                $allMemberData = UserBusiness::with('getMember')->where('business_id',$BusId->business_id)->get();
                $allMember = array();
                foreach ($allMemberData as $key => $value) {
                    if(!empty($value->getMember)){
                        array_push($allMember, $value->getMember);
                    }
                }
                return view('appointment.index',compact('servicesData','getCurrency','customerData','businessId','id','bus_id','calendar','allMemberData','allMember','busIId'));
            }
            else {   
                $calendar = Calendar::addEvents($events);  /* this check for business unique Id existence */
                $request->session()->flash('success-error','Business Id does not exist.');
                return view('appointment.index',compact('servicesData','getCurrency','customerData','businessId','id','calendar','allMemberData','busIId'));
            }

        }
        $customerbusiness = CustomerModel::with('getBusiness')
                                        ->where('email',Auth::user()->email)
                                        ->select('id','user_business_id','business_id')
                                        ->groupBy('user_business_id')
                                        ->get();
        return view('appointment.index',compact('servicesData','getCurrency','calendar','customerData','editAppointment','id','customerbusiness','allMember','businessId','busIId','openPopup'));
    }

    /* Store Calendar Data */

    public function getCalenderdata($data) {
        foreach ($data as $key => $value) {
            if($key % 2 == 0){
                $color = '#3399ff';
            } else {
                $color = '#f05050';
            }
            $events[] = Calendar::event(
               '',
                false,
                new \DateTime($value->appointment_date.' '.$value->appointment_time),
                new \DateTime(($value->appointment_date.' '.$value->appointment_time )),
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

    /* add appointment */
    public function addAppointment(Request $request)
    { 
        //dd($request->all());
        $startDate = Carbon::now()->format('Y-m-d');

        $validator = \Validator::make($request->all(),[
            //'title' =>'required',
            'appointment_date' =>'required|after_or_equal:'.$startDate,
            'appointment' =>Rule::requiredIf(function() use ($request){
                                foreach ($request->appointment as $key => $value) {
                                    if (!isset($value['service_id'])) {
                                      return true;
                                    }
                                }
                            }),
            'business_time'=>'required',
            'customers_name' =>'required|min:3|max:100|regex:/^[a-zA-Z ]+$/',
            'customer_email' =>'required|email',
            'mobile_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:5|max:10',
            //'description' =>'required',
        ],[
            'customers_name.required'=>'Customer name field required.',
            'business_time.required'=>'Business Time required.',
            'staff_id.required'=>'Staff name field required.',
            'appointment_date.required'=>'Appointment date field required.',
            'description.required'=>'Description field required.',
            'service_id.required'=>'Services field required.',
            'customer_email.required'=>'Customer Email field required.',
            'mobile_phone.required'=>'Mobile Phone field required.',
            'appointment.service_id'=>'Service field required ',

            //'mobile_phone.required'=>'Mobile Phone field required.',
            //'mobile_phone.numeric'=>'Mobile Phone digits required.',
            //'mobile_phone.regex'=>'Mobile Phone digits required.',

        ]);
        $validator->after(function($validator) use($request) {
            if ($request->appointment == '') {
                $validator->errors()->add('appointment_service', 'Please select atleast One Service.');
            }
        });

        if($validator->fails()) {
            return response()->json(['error'=>$validator->errors(),'status'=>false]);
        } 
        DB::beginTransaction();
            try {
                $input =  $request->all();
                $appointment_id = '';
                $bussInfo = '';
                if (isset($input['busUnique_id'])) {
                    $unique_key = $input['busUnique_id'];
                    $bussInfo = User::where('role_id',2)->where('unique_id',$input['busUnique_id'])->first();
                    if(empty($bussInfo)) {   /* this check for business unique Id existence */
                        return response()->json(['msg'=>'Business Id does not exist.','status'=>'bus_check']);
                    }
                }
                if(!empty( $request->appointment_id)){
                    $appointment_id = $request->appointment_id;
                }
                if(!empty(Auth::user()->role_id )  && (Auth::user()->role_id == 5)) { //this is condition for customer
                    $sheduledBy = Auth::id();
                    $business_id = $input['businessId'];
                    $customerData = CustomerModel::where('business_id',$business_id)->where('email',Auth::user()->email)->first();
                    $customer_id = $customerData->id;
                }else if(!empty(Auth::user()->role_id) && (Auth::user()->role_id == 2)) {  //this is condition for business
                    $sheduledBy = Auth::id();
                    $user_business_id = Auth::id();
                    $getbusiness = UserBusiness::where('user_id',Auth::id())->first();
                    $business_id =  $getbusiness->business_id;

                    if(!empty($request->input('customer_id'))){
                        $customer_id = $request->input('customer_id');
                    }else{       // this condition when customer not register in business during appointment 

                        $checkExistsCustomer = CustomerModel::where('business_id', $getbusiness->business_id)->where('email',$input['customer_email'])->first();
                        if(empty($checkExistsCustomer)) {
                            $customerInfo = new CustomerModel();
                            $customerInfo->name = $input['customers_name'];
                            $customerInfo->email = $input['customer_email'];
                            $customerInfo->mobile_phone = $input['mobile_phone'];
                            $customerInfo->user_business_id = $user_business_id;
                            $customerInfo->business_id =  $business_id ;
                            $customerInfo->remember_token = str_random(25);
                            $customerInfo->save();
                       
                            if($customerInfo->save()){
                                $customer_id = $customerInfo->id;
                            }
                        }
                        else{
                            $customer_id = $checkExistsCustomer->id;
                        }
                   }
                }else { //this condition for api user
                    $sheduledBy = 0;
                    $business_id = $input['businessId'];
                    $checkExistsCustomer = CustomerModel::where('business_id',$business_id)
                                                        ->where('email',$input['customer_email'])
                                                        ->first();
                    $checkBusCustomer = User::where('email',$input['customer_email'])->get();
                    $user_business_id = $bussInfo->id; 
                    if(empty($checkExistsCustomer)){
                        $customerInfo = new CustomerModel();
                        $customerInfo->name = $input['customers_name'];
                        $customerInfo->email = $input['customer_email'];
                        $customerInfo->mobile_phone = $input['mobile_phone'];
                        $customerInfo->user_business_id = $bussInfo->id ;
                        $customerInfo->business_id = $business_id;
                        $customerInfo->remember_token = str_random(25);
                        $customerInfo->save();
                    }
                    if(!empty($customerInfo)) {
                        $customer_id = $customerInfo->id;
                    }else{
                        $customer_id = $checkExistsCustomer->id;
                    }
                }       
                $appointment = AppointmentModel::updateOrCreate(['id'=>$appointment_id],[
                    'appointment_date' =>Carbon::parse($request->input('appointment_date')),
                    'appointment_time' => Carbon::parse($request->input('business_time')),
                    'business_id' => $business_id,
                    'scheduled_by' => $sheduledBy,
                    'customer_id' => $customer_id,
                    'description' => $request->input('description'),
                ]);
                if(!empty($appointment)) {
                    $deleteServices = ServiceAppointmentModel::where('appointment_id',$appointment->id)->delete();

                    if($request->appointment) {
                        foreach ($request->appointment as $key => $value) {
                            if(!empty($value['service_id'])){
                                $serviceData = new ServiceAppointmentModel();
                                $serviceData->appointment_id = $appointment->id;
                                $serviceData->services_id = $value['service_id'];
                                $serviceData->staff_id = $value['staff_id'];
                                $serviceData->save();
                            }
                        }
                    }
                    if($serviceData->save()) {
                        $token = str_random(25);
                        $updateToken = CustomerModel::where('id',$customer_id)
                        ->update(['remember_token'=>$token]);
                        //dd( $updateToken );
                        $customers = CustomerModel::where('id',$customer_id)->first();
                        if(!empty(Auth::user()->role_id)  && (Auth::user()->role_id == 2)){
                            $customerSendMail = User::where('email',$request->customer_email)->get();
                        }else if(!empty(Auth::user()->role_id) && (Auth::user()->role_id == 5)){
                            $customerSendMail = User::where('email',Auth::user()->email)->get();
                        }else{
                            $customerSendMail = User::where('email',$input['customer_email'])->get();
                        }
                        if(count($customerSendMail) == 0) {
                             try{
                                $customers->notify(new CustomerVerificationEmail($customers));
                                $customers->notify(new CustomerAppointmentEmail($customers,$appointment,$bussInfo));

                             }catch(\Exception $e){
                                  return response()->json(['status'=>'exception','msg'=>'Something Went Wrong.']); 
                             }
                        }
                        if(!empty(Auth::id())){
                            $request->session()->flash('success', 'Appointment Added Successfully.');
                            try{
                                $customers->notify(new CustomerAppointmentEmail($customers,$appointment,$bussInfo));
                                DB::commit();
                                return response()->json($customers);
                            }catch(\Exception $e){
                                return response()->json(['status'=>'exception','msg'=>'Your Sending Email limit exceed.']); 
                            }
                        }else{
                            try{
                                $customers->notify(new CustomerAppointmentEmail($customers,$appointment,$bussInfo));
                                // if(count($customerSendMail) == 0) {
                                //     $customers->notify(new CustomerVerificationEmail($customers));
                                // }
                                 DB::commit();
                                return response()->json(['status'=>true,'msg'=>'Appointment Added Successfully.']);
                            }catch(\Exception $e){
                                throw $e;
                            }
                        }
                        
                    }
                }
                DB::commit();
            }catch(\Exception $e) {
                DB::rollback();
                return response()->json(['status'=>'exception','msg'=>'Something Went Wrong !!']);
            }
        }

    /* get Appoitment customer List */

    public function getCustomerList(Request $request) {
       
        $getBusinessId = UserBusiness::where('user_id',Auth::id())->first();
        $customerData = CustomerModel::select("id","name")
                                    ->where("name","LIKE","%{$request->input('customer_name')}%")
                                    ->where('business_id',$getBusinessId->business_id)
                                    ->where('status','=','active')
                                    ->get();
        $alldata = array();
        if(!empty($customerData)){
            foreach ($customerData as $key => $value) {
                $alldata[$key]['value'] =  $value->name;
                $alldata[$key]['label'] =  $value->name;
                $alldata[$key]['url'] =  $value->id;
            }
        }
        echo json_encode($alldata);
    }

    /* get Appoitment customer List */

    public function getCustomerDetail(Request $request) {
        $id = $request->customer_id;
        $customerData = CustomerModel::select("id","name","last_name","mobile_phone","email")
                                    ->where("id",$id)
                                    ->first();
        if(!empty($customerData)){
            return response()->json(['customerData'=>$customerData,'status'=>true]);
        } else{
            return response()->json(['customerData'=>'','status'=>false]);
        }
    }

    public function autocomplete(Request $request)
    {
        $getBusinessId = UserBusiness::where('user_id',Auth::id())->first();
        $query = $request->input('query');
        $customerName = CustomerModel::select("name","last_name",'id')
                                    ->where('name','LIKE','%'. $query.'%')
                                    ->where('business_id',$getBusinessId->business_id)
                                    ->get();
        if(count($customerName)>0) {
            return response()->json($customerName);
        }else{
            return response()->json(['status'=>false]);
        }
    }

   

    /* return services on behalf of business */

    public function getServices(Request $request) {
        $business_id = $request->business_id;
        $appointment_id = $request->appointment_id;
        if( !is_null($appointment_id)) {
            $appointmentServices = ServiceAppointmentModel::where('appointment_id',$appointment_id)->get();
            $allServices = ServiceMenu::where('business_id',$business_id)->select('id','name','business_id')->get();;
            return response()->json(['services'=>$allServices,'status'=>true,'appointmentServices'=>$appointmentServices,'checked'=>true]);
        }else {
            $allServices = ServiceMenu::where('business_id',$business_id)->select('id','name','business_id')->get();
            return response()->json(['services'=>$allServices,'status'=>true]);
        }
    }

    /* return services on behalf of business */
    public function getTimeSlots(Request $request) {
        //dd($request->all());
        $date = $request->date;
        $day = $request->day;
        $businessId = $request->businessId;
        $appointment_id = $request->appointment_id;
        $appointmentData = AppointmentModel::where('id',$appointment_id)->first();
        $busTime = '';
        if(!empty($appointmentData)){
            $busTime  =  Carbon::parse($appointmentData->appointment_time)->format('g:i A');
        }
        if( !is_null($businessId)) {
            $businessTime = BusinessTiming::where('business_id',$businessId)->where('day',$day)->first();
            if(!empty($businessTime)) {
                $start = Carbon::parse($businessTime->start_time);
                $end = Carbon::parse($businessTime->end_time);
                $minutes = $end->diffInMinutes($start); 
                //$hours = ($minutes / 60);
                $html ='';
                $newtime = ($start->format('g:i A'));
                for ($i=0; $i < $minutes/30 ; $i++) {
                    if($i > 0){
                        $newtime = ($start->addMinutes(30))->format('g:i A'); 
                    }
                    if($busTime ==  $newtime){
                        $html .='<p align="center" style="display: inline-block;width: 90px;"  class="SubmitButton timingColor timeSlot allSlot">'. $newtime.'</p>'; 
                    }else{
                        $html .='<p align="center" style="display: inline-block;width: 90px;" class="SubmitButton timeSlot allSlot">'. $newtime.'</p>'; 
                    }
                }
                return response()->json(['status'=>true,'html'=>$html,'date'=>$date,'bus_time'=>$busTime]);
            }else {
                return response()->json(['status'=>false,'html'=>'Business Off Day.']);
            }
        }
    }

    public function appointmentData(Request $request)
    {
        if(!empty(Auth::user()->role_id) && Auth::user()->role_id == 2) {
            $getBusinessId = UserBusiness::where('user_id',Auth::id())->first();
            $businessId = $getBusinessId->business_id;
            $appointmentData = AppointmentModel::with('businessDetails','userBusinessDetails','customerAppointment','serviceAppointment')
            ->where('status','active')
            ->where('business_id', $getBusinessId->business_id)
            ->orderBy('id', 'DESC')
            ->get();
        }else if(!empty(Auth::user()->role_id) && Auth::user()->role_id == 5){
            $customerData = CustomerModel::select('id')
            ->where('email',Auth::user()->email)
            ->get()->toArray();
            $customerIds = array_column($customerData,'id');
            if (!empty($customerData)) {
                $appointmentData = AppointmentModel::with('businessDetails','userBusinessDetails','customerAppointment','serviceAppointment')
                ->whereIn('customer_id', $customerIds)
                ->where('status','active')
                ->orderBy('id', 'DESC')
                ->get();
            }
        }
        return DataTables::of($appointmentData)
        ->addColumn('action', function($data) {
            if($data->status =='active') {
                return sprintf('<a href="%s" data-toggle="modal" id="%s" class="action_btn edit-appointment" style="padding:10px;"><i class="fas fa-pencil-alt" style="margin-top:10px;margin-bottom:10px;"></i></a>
                    <a href="javascript:delete_account(\''.$data['id'].'\',\'deletecategory\',\'deleteappointment\')" data-toggle="tooltip" id="%s" class="action_btn" style="padding:10px;"><i style="margin-top:10px;margin-bottom:10px;" class="fas fa-times" ></i></a>',
                    url("appointment/".base64_encode($data->id)),$data['id'],'edit-appointment','<i class="fas fa-2x  fa-edit"style ="color:red;margin-top: -15px;"> </i>',
                    $data['id'],'appointment-delete','<i class="fas fa-times-circle fa-2x" style ="color:red; margin-left:-15px;"></i>');
            }
        })->addColumn('id',function($data) {
            static $i=1;
            return $i++;
        })->editColumn('name', function ($appointmentData) {
            if (!empty(Auth::user()->role_id) && Auth::user()->role_id == 2) {
                $customerName='';
                $customerName=$appointmentData->customerAppointment->name;
                if (empty($appointmentData->customerAppointment->name)) {
                    $customerName = 'N.A';
                }
                return $customerName;
            }else if(!empty(Auth::user()->role_id) && Auth::user()->role_id == 5){
                $businessName='';
                $businessName = $appointmentData->businessDetails->name;
                if (empty($appointmentData->businessDetails->name)) {
                    $businessName='N.A';
                }
                return $businessName;
            }else{

            }
        })->editColumn('email', function ($appointmentData) {
            return $appointmentData->customerAppointment->email;
        })->editColumn('appointment_time', function ($appointmentData) {
               return  Carbon::parse($appointmentData->appointment_time)->format('g:i A');
        })->editColumn('phone', function ($appointmentData) {
            return $appointmentData->customerAppointment->mobile_phone;
        })->editColumn('service', function ($appointmentData) {
            $serviceName = '';
            foreach ($appointmentData->serviceAppointment as $key => $services) {
                if(isset($services->serviceMenu->name)){
                    $serviceName .= $services->serviceMenu->name;
                }
                if((count($appointmentData->serviceAppointment) > 1) && count($appointmentData->serviceAppointment) - 1 > $key){
                    $serviceName .= ',';
                }
            }
            if(empty($serviceName)) {
                $serviceName = 'N.A';
            }
            return $serviceName;
        })->editColumn('staffname', function ($appointmentData) {
            $staffName = array();
            foreach ($appointmentData->serviceAppointment as $key => $staff) {
                if(isset($staff->getStaff->name)){
                    // $staffName .= $staff->getStaff->name;
                    array_push($staffName,$staff->getStaff->name);
                }
            }
            if((count($staffName ) > 1) && count($staffName) - 1 > $key){
                    $staffName .= ',';
            }
            if(empty($staffName)) {
                $staffName = 'N.A';
            }
            return $staffName;
        })
        ->make(true);
    }
}


