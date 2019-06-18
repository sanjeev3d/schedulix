@extends('layouts.app-inner')

@section('content')

<style type="text/css">
  .error {
    color:red;
  }
  .dynamic-services{
    margin: 5px;
    border-radius: 3px;
  }
  .panel-primary>.panel-heading {
    color: #fff;
    background-color: #337ab7;
    border-color: #337ab7;
  }
  .panel {
    margin-bottom: 20px;
    background-color: #fff;
    border: 1px solid transparent;
    border-radius: 4px;
    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
  }
  .panel-primary {
    border-color: #337ab7;
  }
  .panel-heading {
    padding: 10px 15px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
  }
  .panel-body {
    padding: 15px;
  }
</style>

<head>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>  
  <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">   -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css" />
</head>

<!-- ============================================================== -->
<div class="dashboard-wrapper dashboard-wrapper-new-div ">

  @if( (!isset($servicebutton)) || (!isset($staffbutton)) || (!isset($privacyandpolicy)) || (!isset($businesstiminigsmodal)) || (!isset($total_customers)) || (!isset($businessinfobutton)) )

  <div class="complete-profilebox-main" id="complete">
    <div class="complete-profile text-center">
      <p>Complete Your Profile</p>
    </div>
    <div class="complete-profilebox-inner">
      <a href="javascript:void(0)" class="btn" @if(!isset($servicebutton)) data-toggle="modal" data-target="#services-modal" @endif>
        @if(isset($servicebutton))<i class="fas fa-check"></i>@endif Services
      </a>

      <a href="javascript:void(0)" class="btn" @if(!isset($staffbutton)) data-toggle="modal" data-target="#StaffModal" @endif>@if(isset($staffbutton))<i class="fas fa-check"></i>@endif Staff</a>

      <!-- <a href="#" class="btn">Payment setup</a> -->

      <a href="@if(!isset($privacyandpolicy)) {{ action('PrivacyController@index') }} @else # @endif" class="btn">@if(isset($privacyandpolicy))<i class="fas fa-check"></i>@endif Privacy And Policy</a>

      <a href="javascript:void(0)" class="btn" @if(!isset($businesstiminigsmodal)) data-toggle="modal" data-target="#BusinessTiminigsModal" @endif>@if(isset($businesstiminigsmodal))<i class="fas fa-check"></i>@endif Business Timing
      </a>

      <a href="@if(!isset($total_customers)) {{ route('customerList') }} @else # @endif" class="btn">@if(isset($total_customers))<i class="fas fa-check"></i>@endif Customer
      </a>

      <a href="@if(!isset($businessinfobutton)) {{route('business_details.index')}} @else # @endif"class="btn" @if(isset($businessinfobutton)) style="max-width: 205px;" @endif>@if(isset($businessinfobutton))<i class="fas fa-check"></i>@endif Business Information
      </a>
    </div>
    <a href="#" id="toggle"> <i class="fas fa-times"></i> </a>
  </div>
  @endif


  <div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content ">
      <div class="ecommerce-widget">
        <div class="row">
          <!-- recent orders  -->
          <!-- ============================================================== -->
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            @if(Session::has('emailexisist'))
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              {{ Session::get('emailexisist') }}
            </div>
            @endif
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              {{ $error }}
            </div>
            @endforeach
            <div class="admin-penal-right-side-contain-common-main-div">

              <div class="card common-card-div">
                <div class="dashboard-contain-div">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="user-rasio-info-div">
                        <div class="img-div">
                          <img src="{{('assets/images/dashboard-img1.png')}}" class="img-fluid">
                        </div>
                        <div class="text-divs">
                          <p class="numbers">{{ $appointments_cnt->count() }}</p>
                          <p class="texts">Appointments</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="user-rasio-info-div">
                        <div class="img-div">
                          <img src="{{('assets/images/dashboard-img2.png')}}" class="img-fluid">
                        </div>
                        <div class="text-divs">
                          <p class="numbers">{{ $total_sales }}</p>
                          <p class="texts">Estimate Sales</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="user-rasio-info-div">
                        <div class="img-div">
                          <img src="{{('assets/images/dashboard-img3.png')}}" class="img-fluid">
                        </div>
                        <div class="text-divs">
                          <p class="numbers">{{ $customerData->count() }}</p>
                          <p class="texts">New Customers</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> 
                <div class="business-button pt-2">
                  <h2 class="pb-2 pt-5">Average Stats</h2>
                </div>   
                <div class="business-logo"> 
                  <div class="row"> 
                    <div class="col-md-6">
                      <div class="average-stats ml-3 mb-5">
                        <i class="fa fa-circle"></i>
                        <span>Customers</span>
                      </div>
                      <div class="average-stats-revenue ml-3 mb-5">
                        <i class="fa fa-circle"></i>
                        <span>Revenue</span>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="monthly-btn ">
                        <span class="mr-3">Monthly</span>
                        <label class="switch">
                          <input type="checkbox">
                          <span class="slider round" val="1"></span>
                        </label>
                        <span class="ml-3">Yearly</span>
                      </div>
                    </div>
                  </div>  
                  <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                </div>
              </div>

              <div class="card common-card-div">
                <div class="row">
                  <div class="col-md-8">
                    <h4 class="main-common-heading">Calendar</h4>
                  </div>
                  <div class="col-md-4">
                    <h4 class="main-common-heading">Activity Timeline</h4>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-8">
                    <div class="cstomer-page-contain-main-div">
                      @if(Session::has('success'))
                      <div class="alert alert-success alert-dismissible">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       {{ Session::get('success') }}
                     </div>
                     @endif
                     <div class="search-customer-main-div" style="margin: 0;">
                      <div class="left-side-contain-div">
                        <div class="row">
                        </div>
                      </div>
                      <div class="right-side-contain-div">
                        <p class="linkss-div" id="modal-open"><a href="{{url('/appointment?open= '.base64_encode('appointment')) }}" class="add-customer"><img src="{{asset('assets/images/link-circle-img.png')}}"> Add Appointment</a></p>
                      </div>
                    </div>

                    <!-- start full calendar -->
                    <div class="panel panel-primary">  
                      <div class="panel-heading">Scheduled Appointments</div>  
                      <div class="panel-body"> {!! $calendar->calendar() !!} {!! $calendar->script() !!} </div>  
                    </div>        
                  </div>        
                </div> <!-- End common-modal-main-div -->
                <div class="col-md-4">
                  <div class="business-logo">
                    <ul class="timeline">
                      <li>
                        <a target="_blank" class="" href="#">Bussiness Meeting</a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing sed eget faucibus leo. Sed bibendum luctus diam ut consect.</p>
                        <p>20 Minutes Ago</p>
                      </li>
                      <li>
                        <a href="#">Mohammed Birthday</a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing ut consectetus. </p>
                        <p>20 Minutes Ago</p>
                      </li>
                      <li>
                        <a href="#">Gym Session</a>
                        <p>Fusce ullamcorper ligula sit amet centectetur adipiscing sed eget faucibus leo.sed bibendum luctus diam ut consectetur. </p>
                        <p>20 Minutes Ago</p>
                      </li>
                      <li>
                        <a href="#">Business Meeting</a>
                        <p>Fusce ullamcorper ligula sit amet ,centectetur adipiscing ut consectetur.</p>
                        <p>20 Minutes Ago</p>
                      </li>
                    </ul>
                  </div>
                </div>
              </div> <!-- End cstomer-page-contain-main-div -->        
            </div>
          </div> <!-- End common-card-div -->
        </div> <!-- End admin-penal-right-side-contain-common-main-div -->
      </div> 
    </div>

    @if(Auth::user()->role_id == 2)
    <div class="ecommerce-widget">
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="modal main-modal-div" id="myModal">
            <div class="modal-dialog custom-dialog-div">
              <div class="modal-content custom-modal-contain-div">

                <!-- step verifivation section -->
                <div class="step-varification-section-main-div">
                  <ul>
                    <li class="round1 active">
                      <span class="border-line-div"></span>
                    </li>
                    <li class="round2">
                      <span class="border-line-div"></span>
                    </li>
                    <li class="round3">
                      <span class="border-line-div"></span>
                    </li>
                    <li class="round4">
                      <span class="border-line-div"></span>
                    </li>
                    <li class="round5">
                      <span class="border-line-div"></span>
                    </li>
                    <li class="round6">
                      <span class="border-line-div"></span>
                    </li>
                  </ul>
                </div>

                <!-- signup screen section  -->
                <div class="signup-screen-section-main-div">
                  <div class="signup-section-sub-div" style="max-width: 1200px;">
                    <div class="signup-screen-contain-div" >
                      <div id="reg_step_all">
                        <div id="screen-one" class="common-secreen-div selected">
                          <form id="step1" name="step1" class="reg_step" action="{{ action('HomeController@step_one') }}" method="post">
                            @csrf
                            <div class="signup-header-div">
                              <h3 class="common-header-text">What best describes your business?</h3>
                            </div>
                            <div class="multiple-radio-btn-main-div">
                              @foreach($business_category as $category)
                              <label class="radio-container active">{{$category->name}} <br>
                                <span class="small-text-div">{{$category->commnet}}</span>
                                <input type="radio" name="business_type" value="{{isset($category->id) ? $category->id : ''}}">
                                <span class="checkmark"></span>
                              </label>
                              @endforeach
                            </div>
                            <span id="business_type_error" style="display: none;color: #f00;    width: 100%;float: left;text-align: center;">Please select business type.</span>   
                          </form>
                        </div> <!-- screen-one -->
                      </div>
                      <div class="signup-footer-div">
                        <div class="footer-btn-div">
                          <div class="backbtn-div">
                            <button type="button" style="display: none;" class="btn" id="back-btn"><i class="fas fa-chevron-left"></i> Back</button>
                          </div>
                          <div class="next-btn-div">
                            <button type="button" class="btn" id="next-btn">Next <i class="fas fa-long-arrow-alt-right"></i></button>
                          </div>
                        </div>
                      </div>
                    </div> <!-- signup-screen-contain-div -->
                  </div> <!-- signup-section-sub-div -->
                </div>
              </div> <!-- End modal-content -->
            </div> <!-- End modal-dialog -->
          </div> <!-- End Modal -->
        </div>
      </div>
    </div>
    @endif
  </div> <!-- End ecommerce-widget -->
</div> <!-- End container-fluid dashboard-content -->
</div> <!-- End dashboard-ecommerce -->
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<div class="modal main-modal-div services-modal" id="services-modal" style=" padding-right: 17px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal body -->
      <div class="modal-body p-0">
        <div class="modal-header header-color">
          <h4 class="modal-main-heading">Select Catagory</h4>

          <a href="javascript:void(0)" class="select-catagory" id="close-modalselect"> <i class="fas fa-times"></i> </a>
          {{-- <button type="button" class="close select-catagory" id="close-modalselect" data-dismiss="modal" aria-label="Close"> --}}
            {{-- <button style="color: white;" type="button" class="close" data-dismiss="modal">&times;</button> --}}

            {{-- <span aria-hidden="true">&times;</span> --}}
          </button>
        </div>
        <div class="select-catagory-main">
          @if(count($main_category) > 0)
          @forelse($main_category->chunk(3) as $chunk)
          <div class="choose-catagory">
            @foreach($chunk as $category)
            <div class=" catagory-btn col-xs-3" data-toggle="modal" data-target="#services-selection-{{$category->id}}" category_id="{{$category->id}}">
              <p>{{ $category->name }}</p>
            </div>
            @endforeach
          </div>
          @empty
          <div class="choose-catagory">
            <div class="btn catagory-btn" data-toggle="modal" data-target="#services-selection"><p>Category Empty.</p></div>
          </div>
          @endforelse
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

<div class="ecommerce-widget">
  <div class="row"> 
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <!-- Services Section Modal -->
      <div class="modal main-modal-div services-selection ServiceModalMainDiv" id="services-selection">
        <div class="modal-dialog">
          <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body p-0">
              <div class="modal-header header-color">
                <h4 class="modal-main-heading">Select Service</h4>

                <a href="javascript:void(0)" class="select-catagory" id="close-modalselect"> <i class="fas fa-times"></i></a>
              </div>
              <form id="step3" action="{{ action('HomeController@step_three') }}" method="post">
                @csrf
                <input type="hidden" name="business_id" value="@if(isset($getBusinessId)){{ $getBusinessId->business_id }} @endif">
                <input type="hidden" name="category_id" value="{{ isset($category->id) ? $category->id : '' }}">
                <div class="responsive-table">
                  <div class="add-data text-right">
                    <a href="#" class="btn add-data-btn add_service_btn" category_id="{{ isset($category->id) ? $category->id : ''}}"><i class="fas fa-plus" ></i> </a>
                  </div>
                  <div class="col-md-12">
                    <div class="alert alert-danger text-center" id="service_err">
                      Please select atleast one service otherwise if you not need then remove it.
                    </div>
                    <div class="alert alert-danger text-center" id="service_cost_err" style="display: none;">

                      Service price may not be greater than 1 digits.

                    </div>
                  </div>
                  <div class="row ServiceModalHeading">
                    <div class="col-md-3 padding-remove-div" style="margin-left: 35px;">
                      <h4 class="service-menu-heading-div">Service Name</h4>
                    </div>
                    <div class="col-md-3 padding-remove-div"style="margin-left: 35px;" >
                      <h4 class="service-menu-heading-div">Time(Minutes)</h4>
                    </div>
                    <div class="col-md-4 padding-remove-div">
                      <h4 class="service-menu-heading-div" >Cost [@if(!empty($getCurrency))  {{ ucfirst($getCurrency->currency) }} @else Bahraini Dinar @endif]  </h4>
                    </div>


                    <div class="col-md-2 padding-remove-div" style="text-align: left; margin: 10px auto;">
                    </div>
                  </div>
                  <div class="row ServiceModalData" style="text-align: center;">

                  </div>
                </div>

                <div class="signup-footer-div">
                  <div class="footer-btn-div">
                    <div class="" style="padding-left: 78%;">
                      <button type="submit" name="submit" class="SubmitButton" id="ServiceSubmit">Submit</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Staff Modal -->
      <div class="modal main-modal-div" id="StaffModal">
        <div class="custom-dialog-div">
          <div class="modal-content custom-modal-contain-div">
            <div class="signup-screen-section-main-div" style="margin: 25px auto 0px auto;">
              <div class="signup-section-sub-div" style="max-width: 1200px;">
                <div class="signup-screen-contain-div" style="min-height: 500px;">
                  <div class="modal-header header-color">
                    <h4 class="modal-main-heading" style="font-size: 20px;margin:0px;">Who works at your business?</h4>
                    <button style="color: white;" type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <form id="step4" name="step4" class="reg_step" action="{{ action('HomeController@step_four') }}" method="post" style="padding-top: 3%;">
                    @csrf
                    <input type="hidden" name="business_id" value="@if(isset($getBusinessId)){{ $getBusinessId->business_id }} @endif">
                    <div class="alert alert-danger alert-dismissible" id="error_msg">

                    </div>
                    <div class="service-menu-div">
                      <div class="add-row-link-div text-right">
                        <div class="btns-div">
                          <button class="btn add-staff-btn-div"><i style="padding: 1px;" class="fas fa-plus">Add Staff</i></button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3 padding-remove-div information-school">
                          <h4 class="service-menu-heading-div">Staff Name</h4>
                        </div>
                        <div class="col-md-3 padding-remove-div information-school">
                          <h4 class="service-menu-heading-div">Email</h4>
                        </div>
                        <div class="col-md-3 padding-remove-div information-school">
                          <h4 class="service-menu-heading-div">Mobile (Optional)</h4>
                        </div>
                        <div class="col-md-2 padding-remove-div information-school">
                          <h4 class="service-menu-heading-div">Role</h4>
                        </div>
                        <div class="col-md-1 padding-remove-div information-school">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3 padding-remove-div information-school">
                          <input type="text" class="form-control form-information shadow" placeholder="Enter Name" name="staff[1][name]">
                        </div>
                        <div class="col-md-3 padding-remove-div information-school">
                          <input type="text" class="form-control form-information shadow email" placeholder="Ente Email" name="staff[1][email]">
                        </div>
                        <div class="col-md-3 padding-remove-div information-school">
                          <input type="number" class="form-control form-information shadow" placeholder="Enter Mobile Number" name="staff[1][phone]" maxlength="10">
                        </div>
                        <div class="col-md-2 padding-remove-div information-school">
                          <div class="form-group add-staff-select-box">

                            {{-- <i class="fas fa-caret-down"></i> --}}
                            <select class="form-control changeColor form-information shadow" name="staff[1][role]">
                              <option value="">Select Role</option>
                              <option value="3">Manager</option>
                              <option value="4">Staff</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-1 padding-remove-div information-school">
                          <div class="close-btns">
                            <i class="fas fa-times" style="color: #ed145b"></i>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3 padding-remove-div information-school">
                          <input type="text" class="form-control form-information shadow" placeholder="Enter Name" name="staff[2][name]">
                        </div>
                        <div class="col-md-3 padding-remove-div information-school">
                          <input type="text" class="form-control form-information shadow email" placeholder="Enter Email" name="staff[2][email]">
                        </div>
                        <div class="col-md-3 padding-remove-div information-school">
                          <input type="number" class="form-control form-information shadow" placeholder="Enter Mobile Number" name="staff[2][phone]" minlength="10" maxlength="10">
                        </div>
                        <div class="col-md-2 padding-remove-div information-school">
                          <div class="form-group add-staff-select-box">

                            {{-- <i class="fas fa-caret-down"></i> --}}

                            <select class="form-control changeColor form-information shadow" name="staff[2][role]">
                              <option value="">Select Role</option>
                              <option value="3">Manager</option>
                              <option value="4">Staff</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-1 padding-remove-div information-school">
                          <div class="close-btns">
                            <i class="fas fa-times" style="color: #ed145b"></i>
                          </div>
                        </div>
                      </div>
                      <div class="add-staff-rows">
                        <div class="row">
                        <!-- <div class="col padding-remove-div information-school dot-symbol-parent"> 
                          <div class="light-dots-div dot-symbol">
                          </div>
                        </div> -->
                        <div class="col-md-3 padding-remove-div information-school">
                          <input type="text" class="form-control form-information shadow" placeholder="Enter Name" name="staff[3][name]">
                        </div>
                        <div class="col-md-3 padding-remove-div information-school">
                          <input type="text" class="form-control form-information shadow email" placeholder="Enter Email" name="staff[3][email]">
                        </div>
                        <div class="col-md-3 padding-remove-div information-school">
                          <input type="number" class="form-control form-information shadow" placeholder="Enter Mobile Number" name="staff[3][phone]" minlength="10" maxlength="10">
                        </div>
                        <div class="col-md-2 padding-remove-div information-school">
                          <div class="form-group add-staff-select-box">

                            {{-- <i class="fas fa-caret-down"></i> --}}
                            <select class="form-control changeColor form-information shadow" name="staff[3][role]">
                              <option value="">Select Role</option>
                              <option value="3">Manager</option>
                              <option value="4">Staff</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-1 padding-remove-div information-school ">
                          <div class="close-btns" >
                            <i class="fas fa-times" style="color: #ed145b"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="signup-footer-div">
                    <div class="text-right" style="position: relative;left: -2%;">
                      <div class="next-btn-div">
                        <input type="button" class="SubmitButton" value="Submit" />
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

    <!-- Business Timinigs Modal -->
    <div class="modal main-modal-div" id="BusinessTiminigsModal">
      <div class="custom-dialog-div" style="max-width: 900px;">
        <div class="modal-content custom-modal-contain-div">
          <div class="signup-screen-section-main-div" style="margin:0">
            <div class="signup-section-sub-div">
              <div class="signup-screen-contain-div" style="min-height: 0">
                <div class="modal-header header-color">
                  <h4 class="modal-main-heading" style="font-size: 20px;margin:0px;">Add business hours to let customers know when you are open</h4>
                  <button style="color: white;" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="customer-hours-main-div">
                  <form id="step5" name="step5" class="reg_step" action="{{ action('HomeController@step_five') }}" method="post" style="padding-top: 3%;">
                    @csrf
                    <input type="hidden" name="business_id" value="@if(isset($getBusinessId)){{ $getBusinessId->business_id }} @endif">
                    <div class="row">
                     <div class="col-md-12 padding-remove-div information-school">
                      <div class="customer-date-divs" style="float: right;">
                       <label class="containerdsd">Apply All Days
                        <input type="checkbox" class="common-checkbox-div" id="id-checkall" name="">
                        <span class="checkmark checkall"></span>
                      </label>
                    </div>
                  </div>
                  <div class="col-md-12" style="margin-top: 20px;">
                    <div class="row custom-margin-div">
                      <div class="col-md-2 padding-remove-div information-school">
                        <div class="customer-date-divs">
                          <label class="containerdsd">Monday
                            <input type="checkbox" class="common-checkbox-div" id="monday" name="week[monday][check]" >

                            <span class="checkmark" day_name="monday"></span>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-4 padding-remove-div information-school">
                        <div class="date-time-div">
                          <input type="text" name="week[monday][from]" class="form-control class-fromm  form-information shadow" id="monday-from" placeholder="Start Time">
                        </div>
                      </div>
                      <div class="col-md-1 padding-remove-div information-school">
                        <div class="date-to-text">
                          <p>To</p>
                        </div>
                      </div>
                      <div class="col-md-4 padding-remove-div information-school">
                        <div class="date-time-div">
                          <input type="text" name="week[monday][to]" placeholder="End Time" class="form-control form-information shadow class-too" id="monday-to">
                        </div>
                      </div>
                    </div>

                    <div class="row custom-margin-div">
                      <div class="col-md-2 padding-remove-div information-school">
                        <div class="customer-date-divs">
                          <label class="containerdsd">Tuesday
                            <input type="checkbox" id="tuesday" class="common-checkbox-div div-checkbox  form-information shadow" name="week[tuesday][check]"  >

                            <span class="checkmark class-chemark " day_name="tuesday"  value="0" ></span>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-4 padding-remove-div information-school">
                        <div class="date-time-div">
                          <input type="text" name="week[tuesday][from]" placeholder="Start Time" class="form-control form-information  class-from shadow" id="tuesday-from" value="" disabled>
                        </div>
                      </div>
                      <div class="col-md-1 padding-remove-div information-school">
                        <div class="date-to-text">
                          <p>To</p>
                        </div>
                      </div>
                      <div class="col-md-4 padding-remove-div information-school">
                        <div class="date-time-div">
                          <input type="text" name="week[tuesday][to]" placeholder="End Time" class="form-control form-information shadow class-to" id="tuesday-to" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row custom-margin-div">
                      <div class="col-md-2 padding-remove-div information-school">
                        <div class="customer-date-divs">
                          <label class="containerdsd">Wednesday
                            <input type="checkbox" id="wednesday" class="common-checkbox-div div-checkbox " name="week[wednesday][check]">
                            <span class="checkmark class-chemark" day_name="wednesday"  value="0"></span>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-4 padding-remove-div information-school">
                        <div class="date-time-div">
                          <input type="text" name="week[wednesday][from]" placeholder="Start Time" class="form-control class-from form-information shadow" id="wednesday-from" disabled>
                        </div>
                      </div>
                      <div class="col-md-1 padding-remove-div information-school">
                        <div class="date-to-text">
                          <p>To</p>
                        </div>
                      </div>
                      <div class="col-md-4 padding-remove-div information-school">
                        <div class="date-time-div">
                          <input type="text" name="week[wednesday][to]" placeholder="End Time" class="form-control form-information shadow class-to" id="wednesday-to" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row custom-margin-div">
                      <div class="col-md-2 padding-remove-div information-school">
                        <div class="customer-date-divs">
                          <label class="containerdsd">Thursday
                            <input type="checkbox" id="thursday" class="common-checkbox-div div-checkbox " name="week[thursday][check]" >

                            <span class="checkmark class-chemark" day_name="thursday"   value="0" ></span>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-4 padding-remove-div information-school">
                        <div class="date-time-div">
                          <input type="text" name="week[thursday][from]" placeholder="Start Time" class="form-control form-information class-from shadow" id="thursday-from" disabled> 
                        </div>
                      </div>
                      <div class="col-md-1 padding-remove-div information-school">
                        <div class="date-to-text">
                          <p>To</p>
                        </div>
                      </div>
                      <div class="col-md-4 padding-remove-div information-school">
                        <div class="date-time-div">
                          <input type="text" name="week[thursday][to]" placeholder="End Time" class="form-control form-information shadow class-to" id="thursday-to" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row custom-margin-div">
                      <div class="col-md-2 padding-remove-div information-school">
                        <div class="customer-date-divs">
                          <label class="containerdsd">Friday
                            <input type="checkbox" id="friday" class="common-checkbox-div div-checkbox " name="week[friday][check]" >

                            <span class="checkmark class-chemark" day_name="friday"   value="0" ></span>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-4 padding-remove-div information-school">
                        <div class="date-time-div">
                          <input type="text" name="week[friday][from]" placeholder="Start Time" class="form-control form-information class-from shadow" id="friday-from" value="" disabled>
                        </div>
                      </div>
                      <div class="col-md-1 padding-remove-div information-school">
                        <div class="date-to-text">
                          <p>To</p>
                        </div>
                      </div>
                      <div class="col-md-4 padding-remove-div information-school">
                        <div class="date-time-div">
                          <input type="text" name="week[friday][to]" placeholder="End Time" class="form-control form-information shadow class-to" id="friday-to" value="" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row custom-margin-div">
                      <div class="col-md-2 padding-remove-div information-school">
                        <div class="customer-date-divs">
                          <label class="containerdsd">Saturday
                            <input type="checkbox" id="saturday" class="common-checkbox-div div-checkbox " name="week[saturday][check]">


                            <span class="checkmark class-chemark" day_name="saturday"></span>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-4 padding-remove-div information-school">
                        <div class="date-time-div">
                          <input type="text" name="week[saturday][from]" class="form-control class-from form-information shadow" placeholder="Start Time" id="saturday-from" disabled>
                        </div>
                      </div>
                      <div class="col-md-1 padding-remove-div information-school">
                        <div class="date-to-text">
                          <p>To</p>
                        </div>
                      </div>
                      <div class="col-md-4 padding-remove-div information-school">
                        <div class="date-time-div">
                          <input type="text" name="week[saturday][to]" class="form-control class-to form-information shadow" placeholder="End Time" id="saturday-to" value="" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row custom-margin-div">
                      <div class="col-md-2 padding-remove-div information-school">
                        <div class="customer-date-divs">
                          <label class="containerdsd">Sunday
                            <input type="checkbox" id="sunday" class="common-checkbox-div div-checkbox " name="week[sunday][check]" >


                            <span class="checkmark class-chemark" day_name="sunday"></span>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-4 padding-remove-div information-school">
                        <div class="date-time-div">
                          <input type="text" name="week[sunday][from]" class="form-control class-from form-information shadow " placeholder="Start Time" id="sunday-from" disabled>
                        </div>
                      </div>
                      <div class="col-md-1 padding-remove-div information-school">
                        <div class="date-to-text">
                          <p>To</p>
                        </div>
                      </div>
                      <div class="col-md-4 padding-remove-div information-school">
                        <div class="date-time-div">
                          <input type="text" id="sunday-to" name="week[sunday][to]" class="form-control form-information shadow class-to" placeholder="End Time" disabled>
                        </div>
                      </div>
                    </div>  
                  </div>
                  <span id="step_5_error" style="display: none;color: #f00; width: 100%; float: left; text-align: center;">Please select business type.</span>
                </div>
                <div class="signup-footer-div">
                  <div class="text-right" style="position: relative;left: -3%;">
                    <div class="next-btn-div">
                      <input type="submit" class="SubmitButton" id="businessTiming" value="Submit"/>
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

<!-- Select Business Type Modal -->
<div class="modal main-modal-div" id="SelectBusinessTypeModal">
  <div class="custom-dialog-div" style="max-width: 550px;">
    <div class="modal-content custom-modal-contain-div">
      <div class="signup-screen-section-main-div" style="max-width: 550px; margin: 0">
        <div class="signup-section-sub-div" >
          <div class="signup-screen-contain-div" style="min-height: 330px;">
            <div class="modal-header header-color">
              <h4 class="modal-main-heading" style="font-size: 20px;margin:0px;">What best describes your business?</h4>
              <button style="color: white;" type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div id="screen-one" class="common-secreen-div selected">
              <form id="step1" name="step1" class="reg_step" action="{{ action('HomeController@step_one') }}" method="post" style="padding-top: 3%;">
                @csrf
                <div class="multiple-radio-btn-main-div">
                  @foreach($business_category as $category)
                  <label class="radio-container">{{$category->name}} <br>
                    <span class="small-text-div">{{$category->commnet}}</span>
                    <input type="radio" name="business_type" value="{{isset($category->id) ? $category->id : ''}}">
                    <span class="checkmark"></span>
                  </label>
                  @endforeach
                </div>
                <span id="business_type_error" style="display: none;color: #f00;    width: 100%;float: left;text-align: center;">Please select business type.</span> 
                <div class="signup-footer-div">
                  <div class="text-right">
                    <div class="next-btn-div">
                      <input type="submit" class="SubmitButton" value="Submit" />
                    </div>
                  </div>
                </div>  
              </form>
            </div> <!-- screen-one -->
          </div> <!-- signup-screen-contain-div -->
        </div> <!-- signup-section-sub-div -->
      </div>

    </div> <!-- End modal-content -->
  </div> <!-- End modal-dialog -->
</div> <!-- End Modal -->
</div>
</div>
</div>
@endsection


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
@push('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','#close-modalselect',function(){
      $('#services-modal').modal().hide();
        location.reload();
      $('.modal-backdrop').remove();
    });
    $(document).on('click', '#step4 .SubmitButton', function(){
    //alert($("#step4 .email").val());
    $.ajax({
      url: "{{ action('HomeController@step_four_ajax') }}",
      type: "post",
      data: $("#step4").serialize(),
      success: function(data){
            ///console.log(data);
            if(data.status == "success"){
              $.each(data.data, function( index, value ) {

                $("#step4 #error_msg").append('"'+value+'" is Already Exist ..!');
              });
              $("#step4 #error_msg").slideDown();
            }
            else{
              $("#step4").submit();
            }
              /*if(data.success){
                  cnt = cnt + 1; 
                  $(".round"+cnt).addClass("active");
                  if (cnt > 1) {
                    //$("#back-btn").show();
                  }
                  if(cnt == 6){
                   // $("#next-btn").hide();
                  }
                  $("#reg_step_all").hide();
                  $("#reg_step_all").html(data.html);$("#reg_step_all").slideDown(1000);;
                  //$(".common-secreen-div").slideDown(1000);
              }
              else if(data.codee == 100){

                  location.reload();
                }*/
      }
    });
  });

  $(document).on('click',".catagory-btn",function(){
    var category_id = $(this).attr('category_id');
    $('input[name="category_id"]').val(category_id);
    $('#services-modal').modal('hide');
    $.ajax({
      url: "{{ action('HomeController@main_category_service') }}",
      type: "post",
      data: {"id":category_id},
      success: function(data){
       var html = '';
       $.each(data.data, function( index, value ) {
        var html = '\
        <div class="add_service_last" style="text-align: center;">\
        <div class="row" style="padding-bottom: 3%;">\
        <div class="col-md-4 information-school" style="margin-left: 35px;">\
        <input type="text" id="service_name" name="select_service[]" class="form-control form-information shadow" value="'+value.service_name+'" />\
        </div>\
        <div class="col-md-3 information-school">\
        <input type="text" id="time" name="duration[]" class="form-control form-information shadow" />\
        </div>\
        <div class="col-md-2 information-school">\
        <input type="text" id="cost"  name="price[]" class="form-control form-information shadow"  />\
        </div>\
        <div class="col-md-2 mobile-padding-remove information-school" style="text-align: left; color:red;margin: 10px auto; cursor:pointer;">\
        <div class="close-btns">\
        <i class="fas fa-times"></i>\
        </div>\
        </div>\
        </div>\
        </div>\
        ';

        $('.ServiceModalData').before(html);
      });

       if(data.data.length === 0){
        var html = '';
        var html = '\
        <div class="add_service_last" style="text-align: center;">\
        <div class="row" style="padding-bottom: 3%;">\
        <div class="col-md-10 information-school" style="margin-left: 35px;">\
        No Service Found.\
        </div>\
        </div>\
        </div>\
        ';
        $('.ServiceModalData').before(html);
      }


      $('#services-selection').modal('show');
    }
  });
    // console.log(category_id);
  });
});

</script>
<!-- Step3 Form -->
<script>
$(document).ready(function(){
  $(document).on('click',".add_service_btn",function(){
    var category_id = $(this).attr('category_id');
    var serviceRow = '\
    <div class="add_service_last">\
    <div class="row" style="padding-bottom: 3%;">\
    <div class="col-md-4 padding-remove-div information-school " style="margin-left: 35px;">\
    <input type="text" id="service_name" name="service_name[]" class="form-control form-information shadow"/>\
    </div>\
    <div class="col-md-3 padding-remove-div information-school">\
    <input type="text" id="time" name="duration[]" class="form-control form-information shadow" />\
    </div>\
    <div class="col-md-2 padding-remove-div information-school">\
    <input type="text" id="cost" name="price[]" class="form-control form-information shadow" />\
    </div>\
    <div class="col-md-2 mobile-padding-remove padding-remove-div information-school" style="text-align: left; margin: 10px auto; cursor:pointer; color:red;">\
    <div class="close-btns">\
    <i class="fas fa-times"></i>\
    </div>\
    </div>\
    </div>\
    </div>\
    ';

    $('#step3').find(".add_service_last:last").append(serviceRow);
  });

  $(document).on('click','.close-btns', function(){
    $(this).closest('.row').remove();
  });

});
</script>
<!-- Step3 Form Validation --> 
<script type="text/javascript">
$(document).ready(function(){
  $('#ServiceSubmit').click(validate);
  function validate(){
    console.log('enter');
    var AnswerInput = document.getElementsByName('duration[]');
    for (i=0; i<AnswerInput.length; i++)
    {
     if (AnswerInput[i].value == "")
     {
       $("#service_err").slideDown();
       $(this).focus();
       return false;
     }
   }
 }
});
</script>
{{-- <script type="text/javascript">

$(document).ready(function(){
  pricevalidate();
});
function pricevalidate(){
  console.log('enter');
  var AnswerInputPrice = document.getElementsByName('price[]');
  console.log(AnswerInputPrice);
  for (i=0; i<AnswerInputPrice.length; i++)
  {
   if (AnswerInputPrice[i].value == "")
   {
     $("#service_cost_err").slideDown();
     $(this).focus();
     return false;
   }
 }
}
</script> --}}
<!-- Step4 Form -->
<script>
$(document).ready(function(){
  $("#step4").validate({
    rules: {
      "staff[1][name]": {required:true},
      "staff[1][email]": {required:true,email:true},
      "staff[1][role]": "required",
      "staff[2][name]": "required",
      "staff[2][email]": {required:true,email:true},
      "staff[2][role]": "required",
      "staff[3][name]": "required",
      "staff[3][email]": {required:true,email:true},
      "staff[3][role]": "required",

    },
    errorPlacement: function(error, element) {
      return false;
    }
  });

  $(document).on('change','.changeColor',function(){
    var getType = $(this).val();
    if(getType == '3'){
      $(this).parent().parent().siblings('.dot-symbol-parent').children('.dot-symbol').removeClass('light-dots-div');
      $(this).parent().parent().siblings('.dot-symbol-parent').children('.dot-symbol').addClass('dark-dots-div');
    } else{
      $(this).parent().parent().siblings('.dot-symbol-parent').children('.dot-symbol').removeClass('dark-dots-div');
      $(this).parent().parent().siblings('.dot-symbol-parent').children('.dot-symbol').addClass('light-dots-div');
    }
  });
});
</script>

<!-- Step5 -->
<script type="text/javascript">
$(document).ready(function(){
  $(function () {
    $('#monday-from,#monday-to,#tuesday-from,#tuesday-to,#wednesday-from,#wednesday-to,#thursday-from,#thursday-to,#friday-from,#friday-to,#saturday-from,#saturday-to,#sunday-from,#sunday-to').datetimepicker({
      format: 'LT'
    });

    $("#step5").validate({
      rules: {
        "week[monday][from]": {required:true},
        "week[monday][to]": {required:true},
        
        "week[tuesday][from]": {required:true},
        "week[tuesday][to]": {required:true}, 

        "week[wednesday][from]": {required:true},
        "week[wednesday][to]": {required:true},

        "week[tuesday][from]": {required:true},
        "week[tuesday][to]": {required:true},

        "week[thursday][from]": {required:true},
        "week[thursday][to]": {required:true},

        "week[friday][from]": {required:true},
        "week[friday][to]": {required:true},

        "week[saturday][from]": {required:true},
        "week[saturday][to]": {required:true},

        "week[sunday][from]": {required:true},
        "week[sunday][to]": {required:true},

      },
      errorPlacement: function(error, element) {
        return false;
      }
    });
  });


});
</script>

@if(@$regStep)
<script type="text/javascript">
$(document).ready(function(){
  var cntstep = "{{$regStep->step}}";
  $.ajax({
    url: "{{action('HomeController@findstep') }}",
    type: "post",
    data: {"id":"{{$regStep->step}}"},
    success: function(data){
      if(data.success){

        $("#myModal").modal('show');
        if(cntstep == 3){
          $(".round2").addClass("active");    
        }
        if(cntstep == 4){
          $(".round2").addClass("active");    
          $(".round3").addClass("active");    
        }
        if(cntstep == 5){
          $(".round2").addClass("active");    
          $(".round3").addClass("active");    
          $(".round4").addClass("active");    
        }
        $(".round"+cntstep).addClass("active");
        if (cntstep > 1) {
                      //$("#back-btn").show();
                    }
                    if(cntstep == 6){
                      $("#next-btn").html("Save");
                    }
                    $("#reg_step_all").hide();
                    $("#reg_step_all").html(data.html);$("#reg_step_all").slideDown(1000);
                    //$(".common-secreen-div").slideDown(1000);
                  }
                  if(data.codee == 100){
                    return false;
                  }
                }

              });
});
</script>
@else
<script type="text/javascript">
$(document).ready(function(){
  $("#SelectBusinessTypeModal").modal('show');
});
</script>
@endif
<script type="text/javascript" src="{{ asset('js/jquery.validate.js') }}"></script>
<script type="text/javascript">
  // Hit ajx and call the last saved step 
  var cnt = 1;
  if (cnt == 1) {
    $("#back-btn").hide();
  }
  $(document).on("click","#next-btn,.servicecat",function () {

    if($(".reg_step").valid()){

      var postdata = $(".reg_step").serialize();
      var url = $(".reg_step").attr("action");
      if($(".reg_step").attr("id")=='step1'){
        if ($('input[name="business_type"]:checked').length == 0) {
          $("#business_type_error").show();
          return false; 
        } 
        else {
          $("#business_type_error").hide();
          postData(postdata,url);
          return false;
        }
      }
      if($(".reg_step").attr("id")=='step5'){

        if ($('#step5 input[type=checkbox]:checked').length == 0) {

          $("#step_5_error").show();
          return false; 
        } 
        else {

          $("#step5 input[type=checkbox]").each(function(){
            $("#step_5_error").hide();
            var $this = $(this);
            if($this.is(":checked")){
              $("#"+$this.attr("id")+"-from").rules("add", {
               required:true,
             });
              $("#"+$this.attr("id")+"-to").rules("add", {
               required:true,
             });
            }else{
              $("#"+$this.attr("id")+"-to").css("border","unset");
            }
          });
          if($(".reg_step").valid()){
           postData(postdata,url);
           return false;
         }
         return false;
       }
     }
     postData(postdata,url);

   }else{
    return false;
  }

});
  $("#back-btn").click(function () {
    if (cnt > 1) {
      $(".round"+cnt).removeClass("active");
      cnt = cnt - 1;
      if (cnt == 1) {
          //$("#back-btn").hide();
        }
        if(cnt < 6){
          $("#next-btn").html("Save");
        }

        var $next,
        $selected = $(".selected");
        $next = $selected.next('.common-secreen-div').length ? $selected.prev('.common-secreen-div') : $first;
        $selected.removeClass("selected").hide();
        $next.addClass('selected').slideDown(1000);
        
      }
    });
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  function postData(postdata,url){


    // alert('enter');
    $.ajax({
      url: url,
      type: "post",
      data: postdata,
      success: function(data){
        if(data.success){
          cnt = cnt + 1; 
          $(".round"+cnt).addClass("active");
          if (cnt > 1) {
                    //$("#back-btn").show();
                  }
                  if(cnt == 6){
                   // $("#next-btn").hide();
                 }
                 $("#reg_step_all").hide();
                 $("#reg_step_all").html(data.html);$("#reg_step_all").slideDown(1000);;
                  //$(".common-secreen-div").slideDown(1000);
                }
                else if(data.codee == 100){

                  location.reload();
                }
              }
            });     
  }
</script>

<script>
  $(document).ready(function(){
    $(".multiple-radio-btn-main-div .radio-container").click(function(){
      $('.multiple-radio-btn-main-div .radio-container').removeClass('active');
      $(this).addClass('active');
    });
  });
</script>


<script>
  $(document).on("change",".common-checkbox-div",function(){


    if($(this).prop("checked") == true){

      var days = $(this).next(".checkmark").attr('day_name');

      if(days == "monday"){
        $('#monday-from').prop("disabled", false);
        $('#monday-to').prop("disabled", false);
      }
      if(days == "tuesday"){
        $('#tuesday-from').prop("disabled", false);
        $('#tuesday-to').prop("disabled", false);
      }
      if(days == "wednesday"){
        $('#wednesday-from').prop("disabled", false);
        $('#wednesday-to').prop("disabled", false);
      }
      if(days == "thursday"){
        $('#thursday-from').prop("disabled", false);
        $('#thursday-to').prop("disabled", false);
      }
      if(days == "friday"){
        $('#friday-from').prop("disabled", false);
        $('#friday-to').prop("disabled", false);
      }
      if(days == "saturday"){
        $('#saturday-from').prop("disabled", false);
        $('#saturday-to').prop("disabled", false);
      }
      if(days == "sunday"){
        $('#sunday-from').prop("disabled", false);
        $('#sunday-to').prop("disabled", false);
      }


      $(this).next(".checkmark").css("border","unset");
    }
    else if($(this).prop("checked") == false){

      var days = $(this).next(".checkmark").attr('day_name');

      if(days == "monday"){
        $('#monday-from').prop("disabled", true);
        $('#monday-to').prop("disabled", true);
      }
      if(days == "tuesday"){
        $('#tuesday-from').prop("disabled", true);
        $('#tuesday-to').prop("disabled", true);
      }
      if(days == "wednesday"){
        $('#wednesday-from').prop("disabled", true);
        $('#wednesday-to').prop("disabled", true);
      }
      if(days == "thursday"){
        $('#thursday-from').prop("disabled", true);
        $('#thursday-to').prop("disabled", true);
      }
      if(days == "friday"){
        $('#friday-from').prop("disabled", true);
        $('#friday-to').prop("disabled", true);
      }
      if(days == "saturday"){
        $('#saturday-from').prop("disabled", true);
        $('#saturday-to').prop("disabled", true);
      }
      if(days == "sunday"){
        $('#sunday-from').prop("disabled", true);
        $('#sunday-to').prop("disabled", true);
      }
      $(this).next(".checkmark").css("border","2px solid #ed145b");
    }

  });
  $('.common-checkbox-div:checked').each(function(index, elem) {
    $(this).next(".checkmark").css("border","unset");
  });
</script>



<script>
  $(document).ready(function(e){
   $(document).on("click",".add-service-btn-div",function(e){
    var cur_block = $(".countInputs").length+3;

    var htm = ' <div class="service-menu-new-add-div countInputs">\
    <div class="row">\
    <div class="col-md-7 padding-remove-div">\
    <input type="text" name="service['+cur_block+'][name]" id="service_name'+cur_block+'" class="form-control" >\
    </div>\
    <div class="col-md-2 padding-remove-div">\
    <input type="text" name="service['+cur_block+'][duration]" id="service_duration'+cur_block+'" class="form-control" >\
    </div>\
    <div class="col-md-2 padding-remove-div">\
    <input type="text" name="service['+cur_block+'][price]" id="service_price'+cur_block+'" class="form-control" >\
    </div>\
    <div class="col padding-remove-div">\
    <div class="close-btns">\
    <i class="fas fa-times"></i>\
    </div>\
    </div>\
    </div>\
    </div>';

    $(".rows:last").append(htm);

    $("#service_name"+cur_block).rules("add", {
     required:true,
   });
    $("#service_duration"+cur_block).rules("add", {
     required:true,
   });
    $("#service_price"+cur_block).rules("add", {
     required:true,
   });

    return false;
  });
   $(document).on('click','.close-btns', function(){
    $(this).closest('.row').remove();
  })
 });
</script>

<!-- Append div Add service btn End --> 



<!-- Append div Add Staff btn -->


<script>
  $(document).ready(function(e){
    $(document).on('click',".add-staff-btn-div",function(e){
      var cur_blocks = $(".countstaff").length+4;
      var staffRow = '<div class="add-staff-rows countstaff">\
      <div class="row">\
      <div class="col-md-3 padding-remove-div information-school">\
      <input type="text" class="form-control form-information shadow" placeholder="Enter Name" name="staff['+cur_blocks+'][name]" id="staff_name'+cur_blocks+'" >\
      </div>\
      <div class="col-md-3 padding-remove-div information-school">\
      <input type="text" class="form-control form-information shadow email" placeholder="Enter Email" name="staff['+cur_blocks+'][email]" id="staff_email'+cur_blocks+'">\
      </div>\
      <div class="col-md-3 padding-remove-div information-school">\
      <input type="text" class="form-control form-information shadow" placeholder="Enter Mobile Number" name="staff['+cur_blocks+'][phone]" id="staff_phone'+cur_blocks+'" minlength="10" maxlength="10">\
      </div>\
      <div class="col-md-2 padding-remove-div information-school">\
      <div class="form-group add-staff-select-box">\
      <i></i>\
      <select class="form-control changeColor form-information shadow" name="staff['+cur_blocks+'][role]" id="staff_role'+cur_blocks+'">\
      <option value="">Select Role</option>\
      <option value="3">Manager</option>\
      <option value="4">Staff</option>\
      </select>\
      </div>\
      </div>\
      <div class="col-md-1 padding-remove-div information-school">\
      <div class="close-btns">\
      <i class="fas fa-times" style="color: #ed145b"></i>\
      </div>\
      </div>\
      </div>\
      </div>';
      $(".add-staff-rows:last").append(staffRow);
      $("#staff_name"+cur_blocks).rules("add", {
       required:true,
      });
      $("#staff_email"+cur_blocks).rules("add", {
       required:true,
       email:true,
      });
      $("#staff_role"+cur_blocks).rules("add", {
       required:true,
      });
      return false;
    });
    $(document).on('click','.close-btns', function(){
      $(this).closest('.row').remove();
    })
  });

  function submitForm() {
    var appointment_id =  $('#appointment_id').val();
    if(appointment_id)
    {
      var url = "{{url('/addAppointment/')}}"+"/"+appointment_id;
    }
    else
    {
      var url = "{{url('/addAppointment')}}";
    }
    var formData = new FormData($('#add_appointment')[0]);
    $.ajax({
      type: 'post',
      url: url,
      data:formData,
      cache:false,
      contentType: false,
      processData: false,
      success: function (res) { 
        if(res.status==false) {
          $('.error').text("");
          jQuery.each(res.error, function(index, val) {
            if ($('div').find('.'+index )) {
              $('.'+index).text(val[0]);
            }
          });
        }else{
          window.open(base_url + '/home', "_self");
      }
    }
    });
        //return false;
  }

  $(document).ready(function(){
    var getEditAppoint = "{{$id ? true :false}}";
    if(getEditAppoint == true){
      $('#New-customer-modal').modal('show');
    }
    $(document).on('click','.add-customer',function(){
      $('#New-customer-modal').modal('show');
      $( ".form-control" ).next("label").remove();
      $( ".form-control" ).removeClass('error-red');
      $('.modal-body').find('select').val('');
    })
    /******************Edit****************************************************/
    $(document).on('click','.edit-customer',function(){
      var customer_id = $(this).attr('id');
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type: "post",
        url: "{{url('/editCustomer/')}}"+"/"+customer_id,
        data: { id:customer_id},
        success: function (response) {
          $('#New-customer-modal').modal('show');
          $( ".form-control" ).next("label").remove();
          $( ".form-control" ).removeClass('error-red');
          $('#customer_id').val(response.id);
          $('#address').val(response.email);
          $('#first_name').val(response.name);
          $('#last_name').val(response.last_name);
          $('#email').val(response.email);
          $('#address').val(response.address);
          $('#home_phone').val(response.home_phone);
          $('#mobile_phone').val(response.mobile_phone);
          $('select[name^="country"] option[value="'+response.country+'"]').attr("selected","selected");
          $('select[name^="region"] option[value="'+response.region+'"]').attr("selected","selected");
          $('select[name^="city"] option[value="'+response.city+'"]').attr("selected","selected");
          $('select[name^="zip_code"] option[value="'+response.zip_code+'"]').attr("selected","selected");
          $('#work_phone').val(response.work_phone);
          $('#addCutomer').text('Update');
        }
      });
      return false;
    });
  });
  $(document).on('keyup','#searchCust',function(){
    //customerRecords();
  });

  function customerRecords(){
    var searchterm = $('#searchCust').val();
    var arrangeBy = $('.arrangeBy').val();
    var filter = $('.filter').val();
    $.ajax({
      type: "post",
      url: "{{url('/searchrecord/')}}",
      data: { term:searchterm,sort:arrangeBy,filter:filter},
      success: function (response) {
        console.log(response.html);
        $('#accordion').html('');
        $('#accordion').html(response.html);
            //$( ".form-control" ).next("label").remove();
          }
        });
  }

  /*image script url reader*/
  function readURLImage(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#output-image').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

// /*******************Edit****************************************************/
$(document).ready(function() { 
  var oTable = $('#customersLists').DataTable({
    "bLengthChange": false,
    processing: true,
    serverSide: true,
        //bDestroy: true,
        "bSortable" : false,
        //columnDefs: [ { orderable: false, targets: [0] } ],
        ajax: {
          url: '{{ route('customer.list') }}',
          data: function (d) {
            d.arrange = $('select[name=arrange]').val();
            d.filter = $('select[name=filter]').val();
          }
        },
        columns: [
        {data: 'id', name: 'id'},
        {data: 'image', name: 'image', orderable: false},
        {data: 'fullname', name: 'fullname', orderable: false},
        {data: 'action', name: 'action',className:'noPrint', orderable: false},
        ]
      });

  $('.arrangeBy').on('change', function(e) { 
    oTable.draw();
    e.preventDefault();
        //customerRecords();
      });

  $('.filter').on('change',function(e){
    oTable.draw();
    e.preventDefault();
        //customerRecords();
      })
});

/*Exports All Users*/
$(document).on('change','#usersAll',function(){
  if (this.checked){
    $(".restusers").each(function() {
      this.checked=true;
    });
  } else {
    $(".restusers").each(function() {
      this.checked=false;
    });
  }
});

$(document).on('click','.checkData',function(){
  if(!this.form.checkbox.checked)
  {
    alert('You must Select One of them.');
    return false;
  }
});    

$(function () {
  $('.monday-from,.monday-to').datetimepicker({
    format: 'LT'
  });
  $('.datepicker').datetimepicker({
    format:'MM/DD/YYYY',
  });
});
</script>

<script type="text/javascript">
  /*  auto-complete code */
  function getCustomerDetail(e){
    var customerId = $('#id-customer').val();
    $.ajax({    
      url: "{{ route('getCustomerDetail') }}",
      type: "post",
      data: {
        customer_id: customerId,
      },
      success: function(data) {
        if(data.status == true){
          $('#customer_email').val(data.customerData.email);
                //$('#customer_email').attr('value',data.customerData.email);
                //$('#customer_email').html(data.customerData.email);
                $('#mobile_phone').val(data.customerData.mobile_phone);
          }else{
            alert('No record found.');
        }
      }
    })
  }
  $(document).on('click','.close-modal',function(){
    window.open(base_url + '/home', "_self");
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    monthly_chart();
    $(".switch").change(function(){
      var val = jQuery(this).attr('val');
      if(val==1){
        monthly_chart();
        var val = jQuery(this).attr('val', 2);
      }
      else{
          //jQuery(this).attr('val', 2);
          yearly_chart();
          var val = jQuery(this).attr('val', 1);
      } 
  });

  function monthly_chart(){
    var chart = new CanvasJS.Chart("chartContainer", {
      animationEnabled: true,
      axisY: {
        titleFontColor: "#4F81BC",
        lineColor: "#4F81BC",
        labelFontColor: "#4F81BC",
        tickColor: "#4F81BC",    
      },
      axisY2: {
        titleFontColor: "#C0504E",
        lineColor: "#C0504E",
        labelFontColor: "#C0504E",
        tickColor: "#C0504E",
        height:"100%"
      },  
      toolTip: {
        shared: true
      },
      data: [{
        type: "column",
        name: "Customers (Monthly)",
        legendText: "Customers",
        color:"#71748d",
        showInLegend: true, 
        dataPoints: <?php echo json_encode($total_month_cust_report); ?>
      },
      {
        type: "column", 
        name: "Revenue (Monthly)",
        legendText: "Revenue",
        axisYType: "secondary",
        color: "#ed145a",
        showInLegend: true,
        dataPoints: <?php echo json_encode($total_month_revunue_report); ?>
      }]
    });
    chart.render();
  }

  function yearly_chart(){
    var chart = new CanvasJS.Chart("chartContainer", {
      animationEnabled: true,
      axisY: {
        titleFontColor: "#4F81BC",
        lineColor: "#4F81BC",
        labelFontColor: "#4F81BC",
        tickColor: "#4F81BC",    
      },
      axisY2: {
        titleFontColor: "#C0504E",
        lineColor: "#C0504E",
        labelFontColor: "#C0504E",
        tickColor: "#C0504E",
        height:"100%"
      },  
      toolTip: {
        shared: true
      },
      data: [{
        type: "column",
        name: "Customers (Yearly)",
        legendText: "Customers",
        color:"#71748d",
        showInLegend: true, 
        dataPoints: <?php echo json_encode($total_year_cust_report); ?>
      },
      {
        type: "column", 
        name: "Revenue (Yearly)",
        legendText: "Revenue",
        axisYType: "secondary",
        color: "#ed145a",
        showInLegend: true,
        dataPoints: <?php echo json_encode($total_year_revenue_report); ?>
      }]
    });
    chart.render();
  }
});
</script>
<script type="text/javascript">
  $(function(){
   $("a#toggle").click(function(){
     $("#complete").slideToggle();
     return false;
   }); 
 });
  $(document).on('click','.services-modal',function(){
    $('#services-modal').modal('show');
  });
  $(document).on('click','.services-selection',function(){
    $('#services-selection').modal('show');
  });
  /*table*/
  $(document).ready(function() {
    $('#example').DataTable( {
      searching: false, 
      paging: false, 
      info: false,
      columnDefs: [ {
        orderable: false,
        className: 'select-checkbox',
        targets:   0
      }],
      select: {
        style:    'os',
        selector: 'td:first-child'
      },
      order: [[ 1, 'asc' ]]
    } );
  });

  $(document).ready(function() {
    $('#id-checkall').val(this.checked);
    $('#id-checkall').change(function() {
      var monday =  $(document).is('#monday',':checked');
      var from =  $('#monday-from').val();
      var to =  $('#monday-to').val();
      if(monday == false && (from == '' || to == '')){
        alert('please select Monday Start Time  and End Time for Apply all days.');
        $("#id-checkall").prop("checked", false);
      }
      if(this.checked) {
        $('.class-chemark ').css('border','unset');
        var monday =  $('#monday').val(this.checked); 
        console.log(monday);
        var from =  $('#monday-from').val();
        var to =  $('#monday-to').val();
        if(from != '' && to != ''){
          $('.class-from').each(function(i, v) {
            $('.div-checkbox ').prop("checked", true);
            $('.class-from ').prop("disabled", false);
            $('.class-to ').prop("disabled", false);
            $('.class-from').val(from);
          });
          $('.class-to').each(function(i, v) {
            $('.class-to').val(to);
          });

        }

      }
      $('#id-checkall').val(this.checked); 
    });
  });

</script>