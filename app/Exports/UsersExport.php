<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\CustomerModel;
use App\UserBusiness;
use Auth;
class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $getBusinessId = UserBusiness::where('user_id',Auth::id())->first();
    	if(isset($_GET['inactive']) && !isset($_GET['active']) ){

    		return CustomerModel::where('status','inactive')->select('id','name','last_name','email','address','city','country','region','zip_code','home_phone','mobile_phone','work_phone','status')->where('business_id',$getBusinessId->business_id)->get();
    	}elseif(isset($_GET['active']) && !isset($_GET['inactive'])){
    		return CustomerModel::where('status','active')->select('id','name','last_name','email','address','city','country','region','zip_code','home_phone','mobile_phone','work_phone','status')->where('business_id',$getBusinessId->business_id)->get();
    	}else{
    		return CustomerModel::select('id','name','last_name','email','address','city','country','region','zip_code','home_phone','mobile_phone','work_phone','status')->where('business_id',$getBusinessId->business_id)->get();

    	}
    }

    public function headings(): array
    {
        return [

            'Id','First Name','Last Name','Email','Address','City','Country','Region','Zip Code','Home Phone','Mobile Phone','Work Phone','Status'
        ];
    }
}
