<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceMenu extends Model
{
    //
    protected $table = 'service_menu';

    protected $fillable = ['name','price','duration','business_id'];

    use SoftDeletes;
    
    public function service_menu()
    {
        return $this->hasMany('App\UserBusiness');
    }

}
