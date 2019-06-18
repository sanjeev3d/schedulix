<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{

   protected $table = 'business'; 

   public function appointmentDetails()
   {
   		return $this->belongsTo('App\Models\AppointmentModel','id','business_id');
   }

   public function getUserBusiness()
   {
   		return $this->belongsTo('App\UserBusiness','business_id','id');
   }

   // public function 

}
