<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ticket;
use Validator;

class TicketController extends Controller
{
    public $successStatus = 200;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ticket = Ticket::all();
        $success['ticket'] =  $ticket;
        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
          
        $validator = Validator::make($request->all(), [ 
            'image' => 'required', 
            'lat' => 'required', 
            'lang' => 'required', 
            'status' => 'required', 
            'license_plate' => 'required', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        //
        $ticket = new Ticket;

        $ticket->image = $request->image;
        $ticket->Lat = $request->lat;
        $ticket->Lang = $request->lang;
        $ticket->Status = $request->status;
        $ticket->License_plate = $request->license_plate;
        $ticket->save();

        $success['ticket'] =  $ticket->id;
        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        echo "show";exit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [ 
            'image' => 'required', 
            'lat' => 'required', 
            'lang' => 'required', 
            'status' => 'required', 
            'license_plate' => 'required', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        //
        $ticket = Ticket::find($id);

        $ticket->image = $request->image;
        $ticket->Lat = $request->lat;
        $ticket->Lang = $request->lang;
        $ticket->Status = $request->status;
        $ticket->License_plate = $request->license_plate;
        $ticket->save();
        $success['ticket'] =  $ticket->id;
        $success['status'] =  "updated";
        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        echo "delete";exit;
    }
    public function Imageupload(Request $request){
        $validator = Validator::make($request->all(), [ 
            'avatar' => 'required', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $path = $request->file('avatar')->store('tickets');
        return response()->json(['success' => $path], $this->successStatus); 

    }
}
