<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Validator;
class PrivacyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {	
    	$user = auth()->user();
    	$users_privacy = DB::table('privacy')
    						->where('user_id', '=', $user->id)
    						->get();
        return view('privacy.index', compact('users_privacy'));
    }

    public function store(request $request){
       $this->validate($request,[
                'chk_reviews' =>'nullable',
                'chk_social_prom' =>'nullabe',
                'term_conditions' =>'required|max:2500',
       ],[
        //'chk_reviews.required' =>'Review field required.',
        //'chk_social_prom.required' =>'Social Promotion field required.',
        'term_conditions.required' =>'Term and condition field required.',
       ]);

        if($request->term_conditions){
    		$user = auth()->user();
    		$chk_review = '';
    		$chk_social_prom = '';
    		if(is_null($request->chk_reviews)){
    			$chk_review = false;
    		}else{
    			$chk_review = $request->chk_reviews;
    		}
    		if(is_null($request->chk_social_prom)){
    			$chk_social_prom = false;
    		}else{
    			$chk_social_prom = $request->chk_social_prom;
    		}
	        $privacy = array(
				'user_id' => $user->id,
				'customer_review' => $chk_review,
				'social_promotion' => $chk_social_prom,
				'terms_condition' => $request->term_conditions
	        );
	        DB::table('privacy')->updateOrInsert(['user_id' => $user->id],$privacy);
	        $request->session()->flash('success', 'Privacy Updated Successfully.');
            return back();
    	}
    }
}
