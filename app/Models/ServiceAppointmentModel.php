<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class ServiceAppointmentModel extends Model {
   
	use Notifiable; 
    protected $table = 'service_appointment_models';
    protected $fillable = ['appointment_id','services_id','staff_id'];

    public function appointService()
    {
    	return $this->hasOne('App\Models\ServiceAppointmentModel','appointment_id','id');
    }

    public function serviceMenu()
    {
       return $this->hasOne('App\ServiceMenu','id','services_id');
    }

    public function getStaff()
    {
       return $this->hasOne('App\User','id','staff_id');
    }
    
}
