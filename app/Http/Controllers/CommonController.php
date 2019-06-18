<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Models\CustomerModel;
use App\Models\AppointmentModel;

class CommonController extends Controller
{

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        if($request->extra_param == 'proceed') {
            $type='deleted';
            $data['userData']=CustomerModel::where('id',$request->id)->select('*')->get()->first();
            CustomerModel::where('id',$request->id)->update(['status'=>'inactive']);  
            $msg = [
                'status' => 'Your selected item has been deleted.',
                'type' =>  $request->extra_param,
                ];
            return $msg;
        } elseif($request->extra_param == 'deleteappointment') {
            $type='deleted';
            $data['userData']=AppointmentModel::where('id',$request->id)->delete();
            $msg = [
                'status' => 'Your Appointment has been deleted Successfully.',
                'type' =>  $request->extra_param,
                ];
            return $msg;
        } elseif($request->extra_param == 'deletestaff') {
            $type='deleted';
            $data['userData']=User::where('id',$request->id)->delete();
            $msg = [
                'status' => 'Staff Deleted Successfully.',
                'type' =>  $request->extra_param,
                ];
            return $msg;
        }  
    }
}


