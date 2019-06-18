<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessCategory;
use App\Business;
use App\UserBusiness;
use App\Models\CustomerModel;

class user extends Controller
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

    public function custBusinessId () {

    	$custBusinessId = CustomerModel::where('id',Auth::id())->first();
    	return $custBusinessId->business_id;
    }
    
}
