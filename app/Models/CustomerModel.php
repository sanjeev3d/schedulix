<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Auth;

class CustomerModel extends Model {

use Notifiable;
	protected $table ='customer';

    protected $fillable = ['name','last_name','email','business_id','address','city','country','region','zip_code','home_phone','mobile_phone','work_phone','status','user_business_id'];

    public function customerBusinessName()
    {
        return $this->hasOne('App\user','id','user_business_id');
    }

    public function customerMultApp()
    {
       return $this->hasMany('App\Models\AppointmentModel','customer_id','id');
    }

    public function serviceMenu()
    {
       return $this->hasMany('App\ServiceMenu','business_id','business_id');
    }
    
    public function getBusiness() {

        return $this->hasOne('App\Business','id','business_id');
    }
}
