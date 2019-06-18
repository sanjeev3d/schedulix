<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CustomerModel;
use App\UserBusiness;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Notifications\CustomerVerificationEmail;
use DataTables;
use Auth;
use App\User;
class CustomerController extends Controller
{
    public function index() {

    }

    /* Customer List shows */
    public function customerList(Request $request) {
        $getBusiness = UserBusiness::where('user_id',Auth::id())->first(); 
        $input = $request->all();
        if(isset($input['open'])){
            $url = base64_decode($input['open']);
        }
        if(!empty( $url)){
            $openPopup = $url;
        }else{
            $openPopup = '';
        }
        $data['customers'] = $customers = CustomerModel::where('business_id',$getBusiness->business_id)
                                                        ->where('status','active')->get();
        $data['allactiveCustomerCount'] = $customers->count();
        $customersInactive = CustomerModel::where('business_id',$getBusiness->business_id)
                                            ->where('status','inactive')->get();
        $data['allinactiveCustomerCount'] = $customersInactive->count();
        $data['popup'] = $openPopup;
       // dd($data);
        return view('customers.index')->with($data);
    }

    /* Store customer Data */
    public function addCustomer(Request $request) {
        
        $validator = \Validator::make($request->all(),[
            'first_name' =>'required|regex:/^[a-zA-Z ]+$/|min:3|max:25',
            'last_name' =>'required|regex:/^[a-zA-Z ]+$/|min:3|max:25',
            'email' =>'required|email',
            //'address' =>'required|max:100',
            //'country' =>'required',
            //'city' =>'required',
            //'region' =>'required',
            //'zip_code' =>'required|digits:6',
            //'home_phone' =>'required|digits:10',
            'mobile_phone' =>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:5|max:10',
            //'work_phone' =>'required|digits:10',

        ],[
            'first_name.required'=>'name field required.',
            'first_name.max'=>'name must be 25 characters field required.',
            'last_name.required'=>'last name field required.',
            'last_name.size'=>'last name must be 25 characters field required.',
            'email.required'=>'email field required.',
            'email.unique'=>'email field must be unique.',
            'address.required'=>'address field required.',
            'address.size'=>'address must be 100 characters field required.',
            'country.required'=>'city field required.',
            'city.required'=>'region field required.',
            'region.required'=>'address field required.',
            'zip_code.required'=>'zip code field required.',
            'zip_code.digits'=>'zip code must  be 6 digits required.',
            'home_phone.required'=>'home phone field required.',
            'home_phone.digits'=>'home phone must be 10 digits .',
            'work_phone.required'=>'work phone field required.',
            'mobile_phone.required'=>'Mobile Phone field required.',
            //'mobile_phone.numeric'=>'Mobile Phone digits required.',
        ]);
        $validator->after(function($validator) use($request) {
            $getbusiness = UserBusiness::where('user_id',Auth::id())->first();
            $checkExistsCustomer = CustomerModel::where('business_id',$getbusiness->business_id)
                                            ->where('email',$request->email)
                                            ->get();
            $checkBusCustomer = User::where('email',$request->email)->get();

            if((count($checkExistsCustomer) > 0)) {
                $validator->errors()->add('email', 'This Customer is already assigned to this business.');
            }

            // if((count($checkBusCustomer)>0)) {
            //     $validator->errors()->add('email', 'This email is already Registered.');
            // }

        });
        if($validator->fails()) {
            return response()->json(['error'=>$validator->errors(),'status'=>false]);
        }
        $getBusinessId = UserBusiness::where('user_id',Auth::id())->first();

        if(empty($getBusinessId->business_id)){
            return response()->json(['error'=>'Please fill all Business Details First. ','status'=>'business_check']);
        }

        $customer = new CustomerModel;
        $customer->name = $request->input('first_name');
        $customer->last_name = $request->input('last_name');
        $customer->email = $request->input('email');
        $customer->user_business_id = Auth::id();
        $customer->business_id = isset($getBusinessId->business_id) ? $getBusinessId->business_id : '' ;
        $customer->password = Hash::make('12345678');//for now
        $customer->address = $request->input('address');
        $customer->country = $request->input('country');
        $customer->city = $request->input('city');
        $customer->region = $request->input('region');
        $customer->zip_code = $request->input('zip_code');
        $customer->home_phone = $request->input('home_phone');
        $customer->mobile_phone = $request->input('mobile_phone');
        $customer->work_phone = $request->input('work_phone');
        $customer->remember_token = str_random(25);
        $customer->save();
        if($customer->save()) {
            $customers = CustomerModel::where('id',$customer->id)->first();
            $customerSendMail = User::where('email',$request->email)->get();

            if(count($customerSendMail) == 0) {
                $customer->notify(new CustomerVerificationEmail($customers));
                $request->session()->flash('success', 'Verification link send to the Customer.');
            }else{
                $request->session()->flash('success', 'Customer Registered Successfully !!.');
            }
        return response()->json($customers);
        }
        else {
            return 0;
        }
    }

    /*Edit customer details*/
    public function editCustomer(Request $request,$customer_id) {
        
        $customers = CustomerModel::where('id',$customer_id)->first();
        return response()->json($customers);
    }

    /* Update customer details*/
    public function updateCustomer(Request $request, CustomerModel $customer) {
        
        $validator = \Validator::make($request->all(),[
            'first_name' =>'required|regex:/^[a-zA-Z ]+$/|min:3|max:25',
            'last_name' =>'required|regex:/^[a-zA-Z ]+$/|min:3|max:25',
            'email' =>'required|email',

            //'address' =>'required|max:100',
            //'country' =>'required',
            //'city' =>'required',
            //'region' =>'required',
            //'zip_code' =>'required|digits:6',
            //'home_phone' =>'required|digits:10',
            'mobile_phone' =>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:5|max:10',
            //'work_phone' =>'required|digits:10',

        ],[
            'first_name.required'=>'name field required.',
            'first_name.max'=>'name must be 25 characters field required.',
            'last_name.required'=>'last name field required.',
            'last_name.size'=>'last name must be 25 characters field required.',
            'email.required'=>'email field required.',
            'email.unique'=>'email field must be unique.',
            'address.required'=>'address field required.',
            'address.size'=>'address must be 100 characters field required.',
            'country.required'=>'city field required.',
            'city.required'=>'region field required.',
            'region.required'=>'address field required.',
            'zip_code.required'=>'zip code field required.',
            'zip_code.digits'=>'zip code must  be 6 digits required.',
            'home_phone.required'=>'home phone field required.',
            'home_phone.digits'=>'home phone must be 10 digits .',
            'mobile_phone.required'=>'mobile phone field required.',
            //'mobile_phone.digits'=>'mobile phone must be 10 digits required.',
            'work_phone.required'=>'work phone field required.',
            'work_phone.digits'=>'work phone must be 10 digits required .',
        ]);

        $getbusiness = UserBusiness::where('user_id',Auth::id())->first();
        $checkExistsCustomer = CustomerModel::where('business_id',$getbusiness->business_id)
                                            ->where('email',$request->email)
                                            ->get();

        if(count($checkExistsCustomer) > 1) {
            return response()->json(['error'=>'Customer already exists in this Business.','status'=>'unique_check']);
        }

        if($validator->fails()) {
            return response()->json(['error'=>$validator->errors(),'status'=>false]);
        }
        if(empty( $getbusiness->business_id)){
            return response()->json(['error'=>'Please fill all Business Details First. ','status'=>'business_check']);
        }
        $customer = CustomerModel::where('id',$request->customer_id)->first();
        $customer->exists = true;
        $customer->name = $request->input('first_name');
        $customer->last_name = $request->input('last_name');
        $customer->email = $request->input('email');
        $customer->user_business_id = Auth::id();
        $customer->business_id = isset($getbusiness->business_id) ? $getbusiness->business_id : '' ;
        $customer->address = $request->input('address');
        $customer->country = $request->input('country');
        $customer->city = $request->input('city');
        $customer->region = $request->input('region');
        $customer->zip_code = $request->input('zip_code');
        $customer->home_phone = $request->input('home_phone');
        $customer->mobile_phone = $request->input('mobile_phone');
        $customer->work_phone = $request->input('work_phone');
        $customer->remember_token = str_random(25);

        $customer->save();
        if($customer->save()) {
            $customers = CustomerModel::where('id',$customer->id)->first();
            $customerSendMail = User::where('email',$request->email)->get();
            if(count($customerSendMail) == 0) {
                $customer->notify(new CustomerVerificationEmail($customers));
                $request->session()->flash('success', 'Verification link send to the Customer.');
            }else{
                $request->session()->flash('success', 'Customer Details Updated Successfully !!.');
            }
            return response()->json($customers);
        }else {
            return 0;
        }
    }

    /*Customers Details Exports*/
    public function export(Request $request)
    {  
        $inputData = $request->all();
        if(!empty($inputData)){
            return  Excel::download(new UsersExport(),'customers.csv');
        }else{
            $request->session()->flash('error','Please select any one checkbox value.');

        }
    }

    /*Customers List  show*/
    public function customerData(Request $request) { 
        $getbusiness = UserBusiness::where('user_id',Auth::id())->first();
        $filter = $request->filter;
        $arrange = $request->arrange;
        if($arrange=='alphabet') {
            $customerData = CustomerModel::select(['id','image','name','last_name','email','mobile_phone','status',\DB::raw("CONCAT(customer.name,' ',customer.last_name) as fullname")])
                                        ->selectRaw("Concat(`name`,`last_name`) as fullname")
                                        ->where('status',$filter)
                                        ->where('business_id',$getbusiness->business_id)
                                        ->orderBy('name', 'ASC')
                                        ->get();
                                       // dd( $customerData );
        }else if($arrange=='oldest') {
            $customerData = CustomerModel::select(['id','image','name','last_name','email','mobile_phone','status',\DB::raw("CONCAT(customer.name,' ',customer.last_name) as fullname")])
                                        ->where('status',$filter)
                                        ->where('business_id',$getbusiness->business_id)
                                        ->orderBy('created_at', 'ASC')
                                        ->get();
        }else {
            $customerData = CustomerModel::select(['id','image','name','last_name','email','mobile_phone','status','business_id',\DB::raw("CONCAT(customer.name,' ',customer.last_name) as fullname")])
                                         ->where('status',$filter)
                                         ->where('business_id',$getbusiness->business_id)
                                         ->orderBy('created_at', 'DESC')
                                         ->get();
        }
        //dd($customerData);
        return DataTables::of($customerData)
            ->addColumn('action', function($data) {

                if($data->status =='active') {
                    return sprintf('<a data-toggle="modal" id="%s" class="action_btn edit-customer"><i class="fas fa-pencil-alt" style="margin-top:10px;margin-bottom:10px;"></i></a>
                    <a href="javascript:delete_account(\''.$data['id'].'\',\'deletecategory\',\'proceed\')" data-toggle="tooltip" id="%s" class="action_btn " ><i style="margin-top:10px;margin-bottom:10px;" class="fas fa-times" ></i></a>',
                    $data['id'],'customer','<i class="fas fa-2x  fa-edit"style ="color:red;margin-top: -15px;"> </i>',
                    $data['id'],'customer-delete','<i class="fas fa-times-circle fa-2x" style ="color:red; margin-left:-15px;"></i>');
                }else if($data->status =='inactive') {
                    return sprintf('<a data-toggle="modal" id="%s" class="btn-sm %s edit-customer btn">%s</a>',
                    $data['id'],'customer','<i class="fas fa-2x  fa-edit"style ="color:red;"> </i>');
                }

            })->addColumn('id',function($data) {
                static $i=1;
                return $i++;
            })
            ->addColumn('image', function ($data) { 
                if($data->image == '') {
                    $url= asset($data->image );
                    return '<img src="'.$url.'assets/images/user_images/user-img.png" border="0" width="40" class="img-rounded" align="center" />';
                }else{
                    return '<img src="'.asset("assets/images/user_images/$data->image").'" border="0" width="40" class="img-rounded" align="center" />';
                }
            })
            ->rawColumns(['image','action']) 
            ->make(true);
    }
}
