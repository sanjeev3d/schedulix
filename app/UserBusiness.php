<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBusiness extends Model
{
    //
    protected $table = 'user_business'; 


    public function business()
    {
        return $this->hasOne('App\Business', 'id', 'business_id');
    }

    public function getCurrency () {
        return $this->hasOne('App\BusinessOtherDetails','id','business_id');
    }
    
    public function getMember()
    {
        $role_id = array('3','4');
        return $this->hasOne('App\User', 'id', 'user_id')->whereIn('role_id',$role_id);
    }

    public function getUser()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    /*public function servicemenu()
    {
        return $this->hasMany('App\Business', 'id', 'business_id');
    }*/


}

