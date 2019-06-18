@extends('layouts.app-inner')

@section('content')

<div class="dashboard-wrapper dashboard-wrapper-new-div ">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
             <div class="ecommerce-widget">
                <div class="row">

                    {{-- @if(isset($success))
                    <div class="alert alert-success">{{ $success }}</div>
                    @endif
                    @if(isset($error))
                    <div class="alert alert-success">{{ $error }}</div>
                    @endif --}}
                 
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        @if(session()->has('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @if(session()->has('error'))
                        <div class="alert alert-success">{{ session()->has('error') }}</div>
                        @endif

                        {{-- @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{ $error }}
                            </div>
                        @endforeach --}}

                        <div class="admin-penal-right-side-contain-common-main-div">
                            <form method="post" action="{{ route('business_details.store') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="business_id" value="{{ $user->id }}">
                             <div class="card common-card-div business-logo-main">
                                
                                <div class="">
                                    <div class="business-button pt-2">
                                        <h2 class="pb-2">Business Information</h2>
                                        <button class="btn" style="margin-top: 0px;">Update</button>
                                    </div>
                                    
                                    <input type="hidden" name="business_id" value="<?php if(isset($user->mybusiness)) { echo $user->mybusiness->business_id; } ?>" />
                                    <div class="business-logo common_business">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="information-school">
                                                    <div class="pb-2">
                                                       <p>Name of your business: <span style="color: red">*</span>
                                                        <span>(This will be display everywere including receipts )</span> </p>
                                                    </div>
                                                    <div class="form-group ">
                                                        <input type="text" name="business_name" class="form-control shadow form-information" placeholder="Enter Name Of Your Business" value="@if(isset($user->mybusiness->business->name)){{$user->mybusiness->business->name}}@else{{ old('business_name') }}@endif">
                                                        @if ($errors->has('business_name'))
                                                        <span  style="color:red"><strong>{{ $errors->first('business_name') }}</strong></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="information-school pt-3">
                                                    <div class="pb-2">
                                                        <p>Business Description: 
                                                    </div>
                                                    <div class="form-group ">
                                                       <textarea class="form-control shadow form-information" name="business_description" placeholder="Enter Description" rows="4" style="resize: none;">@if(isset($user->businessOtherDetail->business_description)){{ $user->businessOtherDetail->business_description }}@else{{ old('business_description') }}@endif</textarea>
                                                        @if ($errors->has('business_description'))
                                                        <span class="help-block" style="color: red"><strong>{{ $errors->first('business_description') }}</strong></span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="information-school">
                                                    <div class="pb-2">
                                                       <p>Business Address :<span style="color: red">*</span></p>
                                                    </div>
                                                    <div class="form-group ">

                                                        <input type="text" class="form-control shadow form-information business-location"  name="business_location" placeholder="Enter Business Location" value="@if(isset($user->mybusiness->business->address)){{ $user->mybusiness->business->address }}@else{{ old('business_location') }}@endif">
                                                        @if ($errors->has('business_location'))
                                                        <span class="help-block" style="color:red;"><strong>{{ $errors->first('business_location') }}</strong></span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="information-school">
                                                            <div class="form-group pt-4">
                                                                 <select class="form-control shadow select-information" name="bus_country" id="country">
                                                                    <option selected disabled>Country</option>
                                                                    @if(isset($country))
                                                                    @foreach($country as $c)
                                                                    <option value="{{ $c->id }}" @if(isset($user->mybusiness->business->country)){{ ($user->mybusiness->business->country == $c->id) ? 'selected' : '' }}@else{{ old('bus_country') == $c->id ? 'selected' : '' }}@endif>{{ $c->country_name }}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                                @if ($errors->has('bus_country'))
                                                                <span class="help-block"><strong>{{ $errors->first('bus_country') }}</strong></span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                         <div class="information-school">
                                                            <div class="form-group pt-4">
                                                                 <select class="form-control shadow select-information" name="bus_state" id="state" @if(!isset($user->mybusiness->business->state)) disabled @endif>
                                                                    <option selected disabled>
                                                                        @if(!empty(old('bus_state'))) @foreach($state as $s) {{ (old('bus_state') == $s->id) ? $s->state_name : '' }} @endforeach @else State @endif 
                                                                    </option>
                                                                    @if(isset($state_name))
                                                                    <option selected value="{{ $state_name->id }}">{{ $state_name->state_name }}</option>
                                                                    @endif
                                                                </select>
                                                                @if ($errors->has('bus_state'))
                                                                <span class="help-block"><strong>{{ $errors->first('bus_state') }}</strong></span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="information-school">
                                                            <div class="form-group pt-4">
                                                                 <select class="form-control  shadow select-information" name="bus_city" id="city" @if(!isset($user->mybusiness->business->city)) disabled @endif>
                                                                    <option selected disabled>
                                                                        @if(!empty(old('bus_city'))) @foreach($city as $c) {{ (old('bus_city') == $c->id) ? $c->city_name : '' }} @endforeach @else City @endif 
                                                                    </option>
                                                                    @if(isset($city_name))
                                                                    <option selected value="{{ $city_name->id }}">{{ $city_name->city_name }}</option>
                                                                    @endif
                                                                </select>
                                                                @if ($errors->has('bus_city'))
                                                                <span class="help-block"><strong>{{ $errors->first('bus_city') }}</strong></span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                         <div class="information-school">
                                                            <div class="form-group pt-4">
                                                                <input type="number" name="bus_pincode" class="shadow select-information form-control pin_code" placeholder="Pin Code" value="@if(isset($user->mybusiness->business->zip)){{ $user->mybusiness->business->zip }}@else{{ old('bus_pincode') }}@endif">
                                                                <div class="col-md-12 form-group information-school text-left" style="margin-top: 12px;">
                                                                    <span id="pincode_err_msg" style="display:none;color:red;">Pin code may not be greater than 6 digits.</span>
                                                                </div>
                                                                @if ($errors->has('bus_pincode'))
                                                                <span class="help-block" style="color:red;"><strong>{{ $errors->first('bus_pincode') }}</strong></span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php //print_r(); die; ?>
                                <div class="pt-4">
                                    <div class="business-button pt-2">
                                        <h2 class="pb-2 pt-5 ">Profession:</h2>
                                    </div>
                                    <div class="business-information common_business">
                                        <div class="row">
                                            <div class="col-sm-6">
                                               <div class="information-school">
                                                    <div class="pb-2">
                                                       <p>Please select the profession that best subscribes your business.</p>
                                                    </div> 

                                                    <div class="form-group ">
                                                        <select class="shadow select-information form-control" name="prof_name">
                                                            @if(isset($profession))
                                                            @foreach($profession as $p)
                                                            <option value="{{$p->id}}" @if(isset($user_profession->profession_name)) {{ ($user_profession->profession_name == $p->id) ? 'selected' : ''}} @else{{ (old('prof_name') == $p->id) ? 'selected' : '' }}@endif>{{$p->name}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                        @if ($errors->has('prof_name'))
                                                        <span class="help-block"><strong>{{ $errors->first('prof_name') }}</strong></span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="information-school">
                                                    <div class="pb-2">
                                                       <p>Business Phone:<span style="color: red">*</span></p></p>
                                                    </div>
                                                    <div class="form-group ">
                                                        <input type="number" name="business_phone" class="form-control shadow form-information business-location business_phone"  placeholder="XXXXX-XXXXX" value="@if(isset($user_profession->business_phone)){{ $user_profession->business_phone }}@else{{ old('business_phone') }}@endif" />
                                                        <div class="col-md-12 form-group information-school text-left" style="margin-top: 12px;">
                                                            <span id="business_phone_err_msg" style="display:none;color:red;">Bussines phone number may not be greater than 10 digits.</span>
                                                        </div>

                                                        @if ($errors->has('business_phone'))
                                                        <span  style="color:red;"><strong>{{ $errors->first('business_phone') }}</strong></span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-4">
                                    <div class="business-button pt-2">
                                        <h2 class="pb-2 pt-5">Timezone and Currency:</h2>
                                    </div>
                                    <div class="timezone-and-currency common_business">
                                        <div class="row">
                                            <div class="col-sm-6">
                                               <div class="information-school">
                                                    <div class="form-group ">
                                                        <div class="pb-2">
                                                             <p>Timezone:</p>
                                                        </div>
                                                        <select class="shadow select-information form-control" name="timezone_currency">
                                                            @foreach($zones_array as $zone)
                                                                <option value="{{ $zone['zone'] }}" @if(isset($user->mybusiness->business->timezone)) {{ $user->mybusiness->business->timezone == $zone['zone'] ? 'selected' : '' }}@else{{ old('timezone_currency') == $zone['zone'] ? 'selected' : '' }}@endif >{{ $zone['diff_from_GMT'] }} - {{ $zone['zone'] }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('timezone_currency'))
                                                        <span class="help-block"><strong>{{ $errors->first('timezone_currency') }}</strong></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mt-4 mb-2">
                                                    <div class="col-sm-6">
                                                        <div class="information-school">
                                                            <div class="pb-2">
                                                               <p>Currency:</p>
                                                            </div>
                                                            <select class="shadow select-information form-control" name="currency">
                                                                <option @if(isset($user_profession->currency)) {{ $user_profession->currency == 'Denar' ? 'selected' : '' }} @else{{ old('currency') == 'Denar' ? 'selected' : '' }}@endif value="Denar">Bahraini Dinar</option>
                                                                <option @if(isset($user_profession->currency)) {{ $user_profession->currency == 'Dollar' ? 'selected' : '' }} @else{{ old('currency') == 'Dollar' ? 'selected' : '' }}@endif value="Dollar">Dollar</option>
                                                                <option @if(isset($user_profession->currency)) {{ $user_profession->currency == 'Rupees' ? 'selected' : '' }} @else{{ old('currency') == 'Rupees' ? 'selected' : '' }}@endif value="Rupees">Rupees</option>
                                                                <option @if(isset($user_profession->currency)) {{ $user_profession->currency == 'Yen' ? 'selected' : '' }} @else{{ old('currency') == 'Yen' ? 'selected' : '' }}@endif value="Yen">Yen</option>
                                                                <option @if(isset($user_profession->currency)) {{ $user_profession->currency == 'Euro' ? 'selected' : '' }} @else{{ old('currency') == 'Euro' ? 'selected' : '' }}@endif value="Euro">Euro</option>
                                                                <option @if(isset($user_profession->currency)) {{ $user_profession->currency == 'Pound' ? 'selected' : '' }} @else{{ old('currency') == 'Pound' ? 'selected' : '' }}@endif value="Pound">Pound</option>
                                                            </select>
                                                            @if ($errors->has('currency'))
                                                            <span class="help-block"><strong>{{ $errors->first('currency') }}</strong></span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                     <div class="col-sm-6">
                                                        <div class="information-school">
                                                            <div class="pb-2">
                                                               <p>Currency Format:</p>
                                                            </div>

                                                            <select class="shadow select-information form-control" name="currency_formate">
                                                                <option @if(isset($user_profession->currency_formate)) {{ $user_profession->currency_formate == 'XX,XX,XX' ? 'selected' : '' }} @else{{ old('currency_formate') == 'XX,XX,XX' ? 'selected' : '' }}@endif  value="XX,XX,XX">XX,XX,XX</option>
                                                                <option @if(isset($user_profession->currency_formate)) {{ $user_profession->currency_formate == 'X,XX,XXX' ? 'selected' : '' }} @else{{ old('currency_formate') == 'X,XX,XXX' ? 'selected' : '' }}@endif  value="X,XX,XXX">X,XX,XXX</option>
                                                                <option @if(isset($user_profession->currency_formate)) {{ $user_profession->currency_formate == 'X,XXX,XXX' ? 'selected' : '' }} @else{{ old('currency_formate') == 'X,XXX,XXX' ? 'selected' : '' }}@endif  value="X,XXX,XXX">X,XXX,XXX</option>
                                                                <option @if(isset($user_profession->currency_formate)) {{ $user_profession->currency_formate == 'XXX,XX,XXX' ? 'selected' : '' }} @else{{ old('currency_formate') == 'XXX,XX,XXX' ? 'selected' : '' }}@endif value="XXX,XX,XXX">XXX,XX,XXX</option>
                                                            </select>
                                                            @if ($errors->has('currency_formate'))
                                                            <span class="help-block"><strong>{{ $errors->first('currency_formate') }}</strong></span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="information-school">
                                                            <div class="pb-2">
                                                               <p>Time Format:</p>
                                                            </div>
                                                            <select class="shadow select-information form-control " name="time_formate">
                                                                <option @if(isset($user_profession->time_formate)) {{ $user_profession->time_formate == '12:00' ? 'selected' : '' }} @else{{ old('time_formate') == '12:00' ? 'selected' : '' }}@endif value="12:00">12:00</option>
                                                                <option @if(isset($user_profession->time_formate)) {{ $user_profession->time_formate == '24:00' ? 'selected' : '' }} @else{{ old('time_formate') == '24:00' ? 'selected' : '' }}@endif value="24:00">24:00</option>
                                                            </select>
                                                            @if ($errors->has('time_formate'))
                                                            <span class="help-block"><strong>{{ $errors->first('time_formate') }}</strong></span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                     <div class="col-sm-6">
                                                        <div class="information-school">
                                                            <div class="pb-2">
                                                               <p>Date Format:</p>
                                                            </div>
                                                            <select class="shadow select-information form-control " name="date_formate">
                                                                <option  @if(isset($user_profession->date_formate)) {{ $user_profession->date_formate == 'DD/MM/YY' ? 'selected' : '' }} @else{{ old('date_formate') == 'DD/MM/YY' ? 'selected' : ''  }}@endif value="DD/MM/YY">DD/MM/YY</option>
                                                                <option @if(isset($user_profession->date_formate)) {{ $user_profession->date_formate == 'DD-MM-YY' ? 'selected' : '' }} @else{{ old('date_formate') == 'DD-MM-YY' ? 'selected' : ''  }}@endif value="DD-MM-YY">DD-MM-YY</option>
                                                                <option @if(isset($user_profession->date_formate)) {{ $user_profession->date_formate == 'MM-DD-YY' ? 'selected' : '' }} @else{{ old('date_formate') == 'MM-DD-YY' ? 'selected' : ''  }}@endif value="MM-DD-YY">MM-DD-YY</option>
                                                                <option @if(isset($user_profession->date_formate)) {{ $user_profession->date_formate == 'MM/DD/YY' ? 'selected' : '' }} @else{{ old('date_formate') == 'MM/DD/YY' ? 'selected' : ''  }}@endif value="MM/DD/YY">MM/DD/YY</option>
                                                            </select>
                                                            @if ($errors->has('date_formate'))
                                                            <span class="help-block"><strong>{{ $errors->first('date_formate') }}</strong></span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-4">
                                    <div class="business-button pt-2">
                                        <h2 class="pb-2 pt-5">Language Preference:</h2>
                                    </div>
                                    <div class="language-preference common_business">
                                        <div class="row">
                                            <div class="col-sm-6">
                                               <div class="information-school">
                                                    <div class="pb-2">
                                                       <p>Language preference:</p>
                                                    </div>
                                                    <div class="form-group ">
                                                        <select class="shadow select-information form-control " name="language_preference">
                                                                <option @if(isset($user_profession->language_pref)) {{ $user_profession->language_pref == 'Arabic' ? 'selected' : '' }}@else{{ old('language_preference') == 'Arabic' ? 'selected' : '' }}@endif value="Arabic">Arabic</option>
                                                                <option @if(isset($user_profession->language_pref)) {{ $user_profession->language_pref == 'English' ? 'selected' : '' }}@else{{ old('language_preference') == 'English' ? 'selected' : '' }}@endif value="English">English</option>
                                                                <option @if(isset($user_profession->language_pref)) {{ $user_profession->language_pref == 'Hindi' ? 'selected' : '' }} @else{{ old('language_preference') == 'Hindi' ? 'selected' : '' }}@endif value="Hindi">Hindi</option>
                                                                <option @if(isset($user_profession->language_pref)) {{ $user_profession->language_pref == 'French' ? 'selected' : '' }} @else{{ old('language_preference') == 'French' ? 'selected' : '' }}@endif value="French">French</option>
                                                                <option @if(isset($user_profession->language_pref)) {{ $user_profession->language_pref == 'Gujarati' ? 'selected' : '' }} @else{{ old('language_preference') == 'Gujarati' ? 'selected' : '' }}@endif value="Gujarati">Gujarati</option>
                                                        </select>
                                                        @if ($errors->has('language_preference'))
                                                        <span class="help-block"><strong>{{ $errors->first('language_preference') }}</strong></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- <a href="#">
                                                     <div class="business-language mt-4">
                                                        <p>Click here to one language editor.</p>
                                                    </div>
                                                </a> -->
                                            </div>
                                           
                                            <div class="col-sm-6">
                                                <!-- <div class="information-school">
                                                    <div class="pb-2">
                                                       <p> Selected Language </p>
                                                    </div>
                                                    <div class="form-group ">
                                                        <select class="shadow select-information form-control" name="select_language">
                                                                <option value="">Select one Language</option>
                                                                <option @if(isset($user_profession->select_language)) {{ $user_profession->select_language == 'English' ? 'selected' : '' }} @else{{ old('select_language') == 'English' ? 'selected' : '' }}@endif value="English">English</option>
                                                                <option @if(isset($user_profession->select_language)) {{ $user_profession->select_language == 'Hindi' ? 'selected' : '' }} @else{{ old('select_language') == 'Hindi' ? 'selected' : '' }}@endif  value="Hindi">Hindi</option>
                                                                <option @if(isset($user_profession->select_language)) {{ $user_profession->select_language == 'French' ? 'selected' : '' }} @else{{ old('select_language') == 'French' ? 'selected' : '' }}@endif  value="French">French</option>
                                                                <option @if(isset($user_profession->select_language)) {{ $user_profession->select_language == 'Gujarati' ? 'selected' : '' }} @else{{ old('select_language') == 'Gujarati' ? 'selected' : '' }}@endif  value="Gujarati">Gujarati</option>
                                                        </select>
                                                        @if ($errors->has('select_language'))
                                                        <span class="help-block"><strong>{{ $errors->first('select_language') }}</strong></span>
                                                        @endif
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-4">
                                    <div class="business-button pt-2">
                                        <h2 class="pb-2 pt-5">Personal Information</h2>
                                    </div>
                                    <div class="personal-information common_business">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                       <div class="information-school">
                                                            <div class="pb-2">
                                                               <p>Name:<span style="color: red">*</span></p>
                                                            </div>
                                                            <div class="form-group ">
                                                                <input type="text" name="personal_fname" class="form-control shadow form-information"  placeholder="First Name" value="@if(isset($user->name)){{ $user->name }}@else{{ old('personal_fname') }}@endif">
                                                                @if ($errors->has('personal_fname'))
                                                                <span class="help-block"><strong>{{ $errors->first('personal_fname') }}</strong></span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="col-sm-6">   
                                                       <div class="information-school">
                                                            <div class="form-group">
                                                                <input type="text" name="personal_lname" class="form-control shadow form-information business-name"  placeholder="Last Name" value="@if(isset($user->last_name)){{ $user->last_name }}@else{{ old('personal_lname') }}@endif">
                                                            </div>
                                                        </div>
                                                    </div>    
                                                </div>
                                                <div class="information-school pt-3">
                                                    <div class="pb-2">
                                                       <p>Email:<span style="color: red">*</span></p>
                                                    </div>
                                                    <div class="form-group ">
                                                        <input type="text" name="personal_email" class="form-control shadow form-information" placeholder="admin@gmail.com" value="@if(isset($user->email)){{ $user->email }}@else{{ old('personal_email') }}@endif">
                                                        @if ($errors->has('personal_email'))
                                                        <span class="help-block"><strong>{{ $errors->first('personal_email') }}</strong></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- <a href="#">
                                                    <div class="business-language mt-4">
                                                        <p>Change Email</p>
                                                    </div>
                                                </a> -->
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="information-school">
                                                            <div class="pb-2">
                                                               <p> Password:<span style="color: red">*</span></p> </p>
                                                            </div>
                                                            <div class="form-group">
                                                                <span id="hidden_pass">********</span>
                                                                <input type="text" name="change_pass" class="form-control shadow form-information change_pass"  placeholder="Password">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                        <div class="business-language business-password">
                                                            <p><a href="javascript:;" id="change_pass_label">Change Password</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="pt-4">
                                    <div class="business-button pt-2">
                                        <h2 class="pb-2 pt-5 ">Contact Information</h2>
                                    </div>
                                    <div class="contact-information common_business">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="information-school">
                                                    <div class="pb-2">
                                                       <p>Home Phone</p>
                                                    </div>
                                                    <div class="form-group ">
                                                        <input type="text" class="form-control shadow form-information business-phone"  placeholder="+91">

                                                        <input type="text" name="home_phone" class="form-control shadow form-information business-home"  placeholder="Home Phone" maxlength="10" value="@if(isset($user->businessOtherDetail)) {{ $user->businessOtherDetail->home_phone }} @else{{ old('home_phone') }}@endif">
                                                        @if ($errors->has('home_phone'))
                                                        <span class="help-block"><strong>{{ $errors->first('home_phone') }}</strong></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="information-school">
                                                    <div class="pb-2">
                                                       <p>Mobile Phone</p>
                                                    </div>
                                                    <div class="form-group ">
                                                        <input type="text" class="form-control shadow form-information business-phone"  placeholder="+91">
                                                        <input type="text" name="mobile_phone" class="form-control shadow form-information business-home" placeholder="Mobile Phone" maxlength="10" value="@if(isset($user->mobile)) {{ $user->mobile }} @else{{old('mobile_phone')}}@endif">
                                                        @if ($errors->has('mobile_phone'))
                                                        <span class="help-block"><strong>{{ $errors->first('mobile_phone') }}</strong></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <a href="#">
                                                     <div class="business-language mt-4">
                                                        <p>Click Verify</p>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="information-school">
                                                    <div class="pb-2">
                                                       <p>Work Phone</p>
                                                    </div>
                                                    <div class="form-group ">
                                                        <input type="text" class="form-control shadow form-information business-phone"  placeholder="+91">
                                                        <input type="text" name="work_phone" class="form-control shadow form-information business-home" placeholder="Work Phone" maxlength="10" value="@if(isset($user->businessOtherDetail)) {{ $user->businessOtherDetail->work_phone }} @else{{ old('work_phone') }}@endif">
                                                        @if ($errors->has('work_phone'))
                                                        <span class="help-block"><strong>{{ $errors->first('work_phone') }}</strong></span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="pt-4">

                                    <h2 class="pb-2">Business Logo</h2>

                                    <div class="common_business text-center pd-10">
                                        <span class="heading pb-2">Business logo</span>
                                        <p>Logo will be shown on customer booking page and all notification emails.</p>

                                        <a href="#" class="upload-icon"><i class="fa fa-cloud-upload-alt"></i></a>
                                        <input type="file" name="upload_file" id="upload_business_logo" />
                                        <p>Best size 150px by 100px PNG or JPG only</p>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
/*.service-menu-div .fade:not(.show) {
    opacity: 1;
}*/
</style>

@endsection