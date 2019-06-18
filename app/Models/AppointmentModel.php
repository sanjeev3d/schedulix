<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Auth;

class AppointmentModel extends Model
{
	use Notifiable; 
    protected $fillable = ['title','appointment_date','appointment_time','service_id','description','status','customer_id','email','business_id','scheduled_by'];

    public function customerAppointment()
    {
       return $this->hasOne('App\Models\CustomerModel','id','customer_id');
    }

    public function serviceAppointment()
    {
       return $this->hasMany('App\Models\ServiceAppointmentModel','appointment_id','id');
    }

    public function businessDetails()
    {
       return $this->hasOne('App\Business','id','business_id');
    }

    public function userBusinessDetails()
    {
       return $this->hasOne('App\UserBusiness','business_id','business_id');
    }

}
