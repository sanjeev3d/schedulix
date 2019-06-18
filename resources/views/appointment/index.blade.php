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
  .New-customer-modal-div .modal-dialog {
    max-width: 800px !important;
  }
  .modal-backdrop
  {
    opacity:0.5 !important;
  }
  .tablescroll{
    height:150px;  
    overflow-y:scroll;
    padding: 20px;
  }
  .New-customer-modal-div .modal-dialog {
    max-width: 1000px !important;
  }
  .timingColor{
    background-color: #ed145b;
    color: white;
  }
  .loader {
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    width: 50px;
    height: 50px;
    -webkit-animation: spin 2s linear infinite; /* Safari */
    animation: spin 2s linear infinite;
  }
  .timeSlot{
    font-size: 15px;
  }
  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

</style>

<head>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>  
  <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">   -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css" />
</head>


<!-- ============================================================== -->
@if(!empty(Auth::user()->role_id))
<div class="dashboard-wrapper dashboard-wrapper-new-div ">
  <div class="dashboard-ecommerce">
    @else
    <div class="dashboard-ecommerce">
      @endif
      <div class="container-fluid dashboard-content ">
        <div class="ecommerce-widget">
          <div class="row">
            <!-- recent orders  -->
            <!-- ============================================================== -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="admin-penal-right-side-contain-common-main-div">
                <div class="card common-card-div">
                  <div class="cstomer-page-contain-main-div">
                    <h4 class="main-common-heading">Appointment</h4>
                    @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible">
                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                     {{ Session::get('success') }}
                   </div>
                   @endif 
                   @if(Session::has('success-error'))
                   <div class="alert alert-danger alert-dismissible">
                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                     {{ Session::get('success-error') }}
                   </div>
                   @endif
                   <div class="search-customer-main-div">
                    <div class="left-side-contain-div">
                      <div class="row">
                      </div>
                    </div>
                    <div class="right-side-contain-div">
                      @if(empty(Auth::id()))
                      <p class="linkss-div" id="modal-open"><a href="{{route('userlogin')}}" class="login"><img src="{{asset('assets/images/user-img.png')}}"> Login </a></p>
                      @endif
                      <p class="linkss-div" id="modal-open"><a href="javascript:void(0)" class="add-customer"><img src="{{asset('assets/images/link-circle-img.png')}}"> Add Appointment</a></p>
                    </div>
                  </div>
                   <!-- start full calendar -->
                   @if(empty(Auth::id()))
                    <div class="panel panel-primary">  
                      <div class="panel-heading">Scheduled Appointments</div>  
                      <div class="panel-body"> {!! $calendar->calendar() !!} {!! $calendar->script() !!} </div>  
                    </div>
                   @endif
                  <!-- end full calendar -->
                  @if(!empty(Auth::id()))
                  <div class="accordion-main-div">
                    <div id="accordion">
                      <div id="accordion-inner"></div>
                      <div class="table-responsive">
                        <table id="appointmentLists" class="table table-striped table-bordered w-100">
                          <thead>
                            <tr>
                              <th>#</th>
                              @if(!empty(Auth::id())&& (Auth::user()->role_id ==2))
                              <th>Customer Name</th>
                              @elseif(!empty(Auth::id())&& (Auth::user()->role_id ==5))
                              <th>Buniness Name</th>
                              @endif
                              <th>Email</th>
                              <th>Phone</th>
                              <th>appointment date</th>
                              <th>appointment time</th>
                              <th>service</th>
                              <th>Staff Name</th>
                              <th class="noPrint">Action</th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                  </div>
                  @endif
                  <!-- Star Modal Popup Code -->
                  <div class="common-modal-main-div" id="myModal" >
                    <!-- The Modal Two -->
                    <div class="modal New-customer-modal-div" id="New-customer-modal" data-keyboard="false" data-backdrop="static" >
                      <div class="modal-dialog ">
                        <div class="modal-content ">
                          <!-- Modal body -->
                          <div class="modal-header header-color">
                            @if(isset($editAppointment->id))
                            <h4 class="modal-main-heading" style="margin-top: 10px;">Edit Appointment</h4>
                            @else
                            <h4 class="modal-main-heading" style="margin-top: 10px;">Appointment</h4>
                            @endif
                            <button style="color: white;" type="button" class="close close-modal" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body" >
                            <h4 class="modal-main-heading"></h4>
                            <form id="add_appointment">

                              {{ csrf_field() }}
                              <input type="hidden" id="appointment_id" name="appointment_id" value="@if(isset($editAppointment->id)) {{$editAppointment->id}} @endif">
                              <div class="new-customer-form-div">
                                <div class="row" >
                              <!-- <div class="col-md-12 common-height-div">
                                <div class="form-group">
                                  <label>Title</label>
                                  <input type="text" class="form-control common-height-class" placeholder="Title" name="title" id="title" value="@if(isset($editAppointment->title)) {{$editAppointment->title}} @endif" autocomplete="off" readonly="">
                                   <div class="error title"></div>
                                </div>
                              </div> -->
                              <div class="col-md-3 common-height-div">
                                <div class="form-group">
                                  <!-- <label>Start Date</label> -->
                                  <!-- <input type="text" class="form-control datepicker common-height-class" placeholder="Start Date" name="start_date" id="start_date" autocomplete="off" value="@if(isset($editAppointment->start_date)) {{date('m/d/Y',strtotime($editAppointment->start_date))}} @endif"> -->
                                  <div class="datepicker"  id="start_date"></div>
                                  <input type="hidden" name="appointment_date" id="appointment_date">
                                  <div class="error appointment_date"></div>
                                </div>
                              </div>


                              <div class="col-md-9 common-height-div custom-padding-divss" style="border:solid 1px #ed145b;">
                                

                                <div class="row" style="margin-top: 10px;">
                                  <div class="col-md-4 "><h4 style="margin-left: -20px;" align="center">Services</h4></div>
                                  <div class="col-md-4"><h4 style="margin-left: 30px;" align="center">Staff Names</h4></div>
                                  <div class="col-md-4"><h4 align="center">Prices [
                                    @if(!empty($getCurrency))  {{ ucfirst($getCurrency->currency) }} @else Bahraini Dinar @endif]  </h4></div>

                                  </div>
                                  <div class="form-group custom-padding-divss tablescroll" style="margin-top: -10px;">
                                    
                                   @if(count($servicesData) > 0)
                                   @foreach($servicesData as $k=> $service)
                                   <div class="row custom-margin-div">
                                    <div class="col-md-5 padding-remove-div">
                                      <div class="customer-date-divs ">
                                        <label class="containerdsd">
                                          <!-- <input type="checkbox" class="common-checkbox-div" id="monday" name="week[monday][check]" checked="checked"> -->
                                          <input type="checkbox" onchange="service()" name="appointment[{{$k}}][service_id]" class="dynamic-services service_id restservices common-checkbox-div" value="{{$service->id}}" @if(isset($editAppointment->serviceAppointment))
                                          @foreach($editAppointment->serviceAppointment as $key => $value)
                                          @if($value->services_id == $service->id)
                                          checked
                                          @endif
                                          @endforeach
                                          @endif>
                                          <span class="checkmark"></span>
                                          {{$service->name}}
                                        </label>
                                      </div>
                                    </div>
                                    <div class="col-md-4 padding-remove-div">
                                      <div class="date-time-div">
                                        <!-- <input type="text" name="week[monday][from]" class="form-control" id="monday-from" value="" placeholder="Start Time"> -->
                                        <select class="form-control selectbox" name="appointment[{{$k}}][staff_id]">
                                          <option value="">-select here-</option>
                                          @if(isset($allMember))
                                          @foreach($allMember as $cb)
                                          <option value="{{$cb->id}}"
                                           @if(isset($editAppointment->serviceAppointment))
                                           @foreach($editAppointment->serviceAppointment as $k => $v)
                                           @if(($v->services_id == $service->id) && ($v->staff_id == $cb->id))
                                           selected
                                           @endif
                                           @endforeach
                                           @endif
                                           >{{($cb->name)}}</option>
                                           
                                           @endforeach
                                           @endif
                                         </select>
                                       </div>
                                     </div>
                                     <div class="col-md-3 padding-remove-div">
                                      <div class="date-to-text">
                                        <p>{{$service->price}}</p>
                                      </div>
                                    </div>
                                  </div>
                                  @endforeach
                                  @endif
                                  <div id="service-id"class='error appointment_service'></div>
                                </div>
                              </div>
                              <div class="col-md-6 common-height-div" style="border:solid 1px #ed145b;">
                                <div class="form-group">
                                  <b><p style="margin-top: 10px;" align="center">Timing</p></b>
                                  <div class="tablescroll" id="business_time"></div>
                                  <input type ="hidden" id="id-business_time" name="business_time" value="">
                                  <div class="error business_time"></div>
                                </div>
                              </div>
                              @if(!empty(Auth::id())&& (Auth::user()->role_id ==2))
                              <div class="col-md-6 common-height-div" style="border:solid 1px #ed145b; padding-right: 1px;">
                                <b>  <p style="margin-top: 10px;" align="center">Customer Info</p></b>
                                <!-- <div class="col-md-2 common-height-div"> -->
                                  <div class="form-group">
                                    <input class="typeahead form-control" type="text" name="customers_name" id="id-customer" autocomplete="off" placeholder="Enter customer name / Search It" value="@if(isset($editAppointment->customerAppointment->name)) {{$editAppointment->customerAppointment->name}} {{$editAppointment->customerAppointment->last_name}} @endif" >
                                    <input type="hidden" name="customer_id" id="customer_id" autocomplete="off">
                                    <div id="suggesstion-box"></div>
                                    <div class="error customers_name"></div>
                                  </div>
                                  <!-- </div> -->
                                  <!-- <div class="col-md-2 common-height-div"> -->
                                    <div class="form-group">
                                      <input type="text" class="form-control common-height-class" placeholder="admin@gmail.com" name="customer_email" id="customer_email" value="@if(isset($editAppointment->customerAppointment->email)) {{$editAppointment->customerAppointment->email}} @endif">
                                      <div class="error customer_email"></div>
                                    </div>
                                    <!-- </div> -->
                                    <!-- <div class="col-md-2 common-height-div"> -->
                                      <div class="form-group">
                                        <div class="phone-field-common-div">
                                          <div class="country-number-div">
                                            <input type="text" class="form-control common-height-class" name="mobile_phone" value="@if(isset($editAppointment->customerAppointment->mobile_phone)) {{$editAppointment->customerAppointment->mobile_phone}} @endif" id="mobile_phone" placeholder="Mobile Number">
                                            <div class="error mobile_phone" ></div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    @elseif(!empty(Auth::id())&& (Auth::user()->role_id ==5))
                                    <input type="hidden" name="businessId" value=" @if (isset($businessId )){{ $businessId}} @endif">
                                    <div class="col-md-6 common-height-div" style="border:solid 1px #ed145b; padding-right: 1px;">
                                      <b>  <p align="center">Customer Info</p></b>
                                      <!-- <div class="col-md-2 common-height-div"> -->
                                        <div class="form-group">
                                          <input class="form-control" type="text" name="customers_name" id="id-customer" autocomplete="off" placeholder="Enter customer name" value="@if(isset($customerData)) {{$customerData->name}}  @endif" readonly="readonly" >
                                          <input type="hidden" name="customer_id" id="customer_id" autocomplete="off">
                                          <div id="suggesstion-box"></div>
                                          <div class="error customers_name"></div>
                                        </div>
                                        <!-- </div> -->
                                        <!-- <div class="col-md-2 common-height-div"> -->
                                          <div class="form-group">
                                            <input type="text" class="form-control common-height-class" placeholder="admin@gmail.com" name="customer_email" id="customer_email" readonly="readonly" value="@if(isset($customerData)) {{$customerData->email}} @endif">
                                            <div class="error customer_email"></div>
                                          </div>
                                          <!-- </div> -->
                                          <!-- <div class="col-md-2 common-height-div"> -->
                                            <div class="form-group">
                                              <div class="phone-field-common-div">
                                                <div class="country-number-div">
                                                  <input type="text" class="form-control common-height-class" name="mobile_phone" value="@if(isset($customerData->mobile_phone)) {{$customerData->mobile_phone}} @endif" id="mobile_phone" readonly="readonly" placeholder="Mobile Number">
                                                  <div class="error mobile_phone" ></div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          @else
                                          <input type="hidden" name="busUnique_id" value="@if (isset($bus_id )){{ $bus_id  }} @endif">
                                          <input type="hidden" name="businessId" value=" @if (isset($businessId )){{ $businessId}} @endif">
                                          <div class="col-md-6 common-height-div" style="border:solid 1px #ed145b; padding-right: 1px;">
                                            <b> <p align="center">Customer Info</p></b>                                  
                                            <div class="form-group">
                                              <input class="form-control" type="text" name="customers_name" id="id-customer" autocomplete="off" placeholder="Enter customer name" value="@if(isset($editAppointment->customerAppointment->name)) {{$editAppointment->customerAppointment->name}} {{$editAppointment->customerAppointment->last_name}} @endif" >
                                              <input type="hidden" name="customer_id" id="customer_id" autocomplete="off">
                                              <div id="suggesstion-box"></div>
                                              <div class="error customers_name"></div>
                                            </div>
                                            <div class="form-group">
                                              <input type="text" class="form-control common-height-class" placeholder="admin@gmail.com" name="customer_email" id="customer_email" value="@if(isset($editAppointment->customerAppointment->email)) {{$editAppointment->customerAppointment->email}} @endif">
                                              <div class="error customer_email"></div>
                                            </div>
                                            <div class="form-group">
                                              <div class="phone-field-common-div">
                                                <div class="country-number-div">
                                                  <input type="text" class="form-control common-height-class" name="mobile_phone" value="@if(isset($editAppointment->customerAppointment->mobile_phone)) {{$editAppointment->customerAppointment->mobile_phone}} @endif" id="mobile_phone" placeholder="Mobile Number">
                                                  <div class="error mobile_phone" ></div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          @endif
                              <!-- <div class="col-md-6 common-height-div">
                                <div class="form-group">
                                  <label>From</label>
                                  <input type="text" name="time_from" class="form-control monday-from" id="time_from" placeholder="Start Time" autocomplete="off" value="@if(isset($editAppointment->time_from)) {{$editAppointment->time_from}} @endif">

                                  <div class="error time_from" autocomplete="off"></div>
                                </div>
                              </div>
                              <div class="col-md-6 common-height-div">
                                <div class="form-group">
                                  <label>To</label>

                                  <input type="text" name="time_to" placeholder="End Time" class="form-control monday-to" value="@if(isset($editAppointment->time_to)) {{$editAppointment->time_to}} @endif" id="time_to">
                                  <div class="error time_to" autocomplete="off"></div>
                                </div>
                              </div> -->
                              <div class="col-md-12 common-height-div">
                                <div class="form-group">
                                  <label>Any Instruction</label>
                                  <textarea name="description" class="form-control" rows="1" id="description">@if(isset($editAppointment->description)) {{$editAppointment->description}} @endif</textarea>
                                  <div class="error description"></div>
                                </div>
                              </div>
                              
                              <div class="col-md-12">
                               @if(isset($editAppointment->id))
                               <button style="float: right;text-align: center;" class="SubmitButton checkData" type="button" id="addCutomer" onclick="submitForm()">Update</button>
                               <div class="myloader"></div>

                               <!-- <a  href="javascript:void(0);" class="btn common-modal-btn delete" id="{{$editAppointment->id}}">Delete Appointment</a> -->

                              {{--<a style="float: right;text-align: center;" href="javascript:delete_account({{$editAppointment->id}},'deleteappointment','deleteappointment')" class="SubmitButton common-modal-btn delete" id="{{$editAppointment->id}}">Delete</a>--}}
                               @else
                               <button class="SubmitButton checkData" style="float: right;text-align: center;" type="button" id="addCutomer" onclick="submitForm()">Add</button>
                               <div class="myloader"></div>
                               @endif
                             </div>
                           </div>
                         </div>
                       </form>   
                     </div>

                   </div>
                 </div>
               </div> <!-- End export-customer-modal-div -->


             </div> <!-- End common-modal-main-div -->

             <!-- End Modal Popup Code -->

           </div> <!-- End cstomer-page-contain-main-div -->        

         </div> <!-- End common-card-div -->
       </div> <!-- End admin-penal-right-side-contain-common-main-div -->
     </div> <!-- End col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 -->
     <!-- ============================================================== -->
     <!-- end recent orders  -->

   </div> <!-- End row -->

 </div> <!-- End ecommerce-widget -->
</div> <!-- End container-fluid dashboard-content -->
</div> <!-- End dashboard-ecommerce -->
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<!-- ============================================================== -->

<!-- ============================================================== -->
            <!-- <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            Copyright Â© 2018 Concept. All rights reserved. Dashboard by <a href="https://colorlib.com/wp/">Colorlib</a>.
                        </div>

                    </div>
                </div>
              </div> -->
              <!-- ============================================================== -->
              <!-- end footer -->
              <!-- ============================================================== -->
            </div> <!-- End dashboard-wrapper -->
            <!-- ============================================================== -->

          </div> <!-- End dashboard-wrapper -->
          <!-- ============================================================== -->
          @endsection

<!--   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script> -->

  @push('scripts')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script type = "text/javascript">

    $(document).ready(function(){
        var dt = "{{(isset($busIId)) ? $busIId : '' }}";
        if(dt!= ''){
            var weekday = ["sunday","monday","tuesday","wednesday","thursday","friday","saturday"];
            var d = new Date();
            var dayname = weekday[d.getDay()];
            console.log(d);
            console.log(dayname);
            getTimeSlots(dayname,d);
        }else {
            var date = "{{(isset($editAppointment->appointment_date)) ? $editAppointment->appointment_date : '' }}";
        if(date) {
            var weekday = ["sunday","monday","tuesday","wednesday","thursday","friday","saturday"];
            var d = new Date(date);
            console.log(d);
            var dayname = weekday[d.getDay()];
            getTimeSlots(dayname,d);
        }else {
            var weekday = ["sunday","monday","tuesday","wednesday","thursday","friday","saturday"];
            var d = new Date();
            var dayname = weekday[d.getDay()];
            console.log(d);
            console.log(dayname);
            getTimeSlots(dayname,d);
        }
    }
});

    function convert(str) {
      var date = new Date(str),
      mnth = ("0" + (date.getMonth()+1)).slice(-2),
      day  = ("0" + date.getDate()).slice(-2);
      return [ date.getFullYear(), mnth, day ].join("-");
    }

    function getTimeSlots(day,d){
        //console.log(d);
       // console.log(day);
       var getDate = convert(d);
       // console.log(getDate);
       var day = day;
       var businessId = '{{$businessId}}';
       var appointment_id = "{{(isset($editAppointment->id)) ? $editAppointment->id : '' }}";
       $.ajax({
        type: "post",
        url: "{{url('/get-slots')}}",
        data: { day:day,businessId:businessId,date:getDate,appointment_id:appointment_id},
        success: function (res) {
            $('.error').html('');
            $('#appointment_date').val('');
            $('#business_time').html('');
            $('#id-business_time').val('');
            $('#business_time').html(res.html);
            $('#appointment_date').val(res.date);
            $('#id-business_time').val(res.bus_time);
        }
    });
 }


 $(document).on('click','.timeSlot',function(){
  $('.timeSlot').removeClass('timingColor');
  $(this).addClass('timingColor');
  var busTime = $(this).text();   
  $('#id-business_time').val(busTime);


});


 function submitForm() {
    var appointment_id =  $('#appointment_id').val();
    var dt = "{{(isset($busIId)) ? $busIId : '' }}";

    if(appointment_id)
    {
        var url = "{{url('/addAppointment/')}}"+"/"+appointment_id;
    }
    else
    {
        var url = "{{url('/addAppointment')}}";
    }

    var formData = new FormData($('#add_appointment')[0]);
    $('.myloader').addClass('loader');
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
                     var value  = $('.restservices').is(':checked');
                     if(value == false){
                         $('#service-id').text('Service field required.');
                     }
                });
            }
            else if(res.status == 'bus_check'){
                swal({
                    title: "Business",
                    text: res.msg,
                    button: "close",
                    timer: 10000,
                });
            }else if(res.status==true) {
                $('.error').text("");
                $('#add_appointment ')[0].reset();
                swal({
                    title: "Done",
                    text: res.msg,
                     icon: "success",
                    button: "close",
                    timer: 10000,
                });
                $('#New-customer-modal').modal('hide');
            }else if(res.status =='unique_check'){
                $('.error').text("");
                $('.customer_email').text(res.error);

            }else if(res.status =='exception'){
                swal({
                    title: "Warning",
                    text: res.msg,
                    icon: "warning",
                    button: "close",
                    dangerMode: true,
                    timer: 10000,
                });
            } else{
                $('.myloader').removeClass('loader');
                    window.open(base_url + '/appointment', "_self");
            }
        }
    });
            //return false;
}

    var popup ="{{ !empty($openPopup) ? true:false }}";
    if(popup ==true) {
        $('#New-customer-modal').modal('show');
    }

    $(document).ready(function(){
        var getEditAppoint = " {{(!empty($id)) ? true : false }}";
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
        return false
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

// $(document).on('click','.checkData',function(){
//   if(!this.form.checkbox.checked)
//   {
//     alert('You must Select One of them.');
//     return false;
//   }
// });    

$(function () {

  var getDate = "{{(isset($editAppointment->appointment_date)) ? $editAppointment->appointment_date : '' }}";
  $('.datepicker').datetimepicker({
    defaultDate: getDate ? new Date(getDate) : new Date(),
    format:'MM/DD/YYYY',
    inline: true,
        //Default: false
      });
  $(".datepicker").on("dp.change", function (e) {
    var weekday = ["sunday","monday","tuesday","wednesday","thursday","friday","saturday"];
    var d = new Date(e.date);
    
    var dayname = weekday[d.getDay()];
    getTimeSlots(dayname,d);
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

                } else {
                  alert('No record found.');
                }
              }
            })

  }

  $(document).ready(function() { 
    var path = "{{ route('autocomplete') }}";
    $('input.typeahead').typeahead({
      source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
          
          if(data.status == false) {
            $('#customer_email').val('');
            $('#customer_email').attr("readonly", false);
            $('#mobile_phone').val('');
            $('#mobile_phone').attr("readonly", false);
          } else{
            return process(data);
          }
        });
      },
      updater: function(item) {
        var cust_id = item.id;
        getCustomerDetail(cust_id);

      }
    });
  });

  function getCustomerDetail(item) {
    var customerId = item;
    $.ajax({    
      url: "{{ route('getCustomerDetail') }}",
      type: "post",
      data: {
        customer_id: customerId,
      },
      success: function(data) {
        if(data.status == true){
          $('#customer_email').val(data.customerData.email);
          $('#customer_email').attr("readonly", "readonly");
          $('#id-customer').val(data.customerData.name +' '+ data.customerData.last_name);
          $('#customer_id').val(data.customerData.id);
          $('#mobile_phone').val(data.customerData.mobile_phone);
          $('#mobile_phone').attr("readonly", "readonly");

        } else {
          alert('No record found.');
        }
      }
    })
  }

  $(document).on('click','.close-modal',function(){
   var dt = "{{(isset($bus_id)) ? $bus_id : '' }}";
   if (dt) {
     $('#New-customer-modal').modal('hide');
       window.open(base_url +'/'+dt+'/appointment', "_self");
       $('#New-customer-modal').modal('hide');
   }else{
    window.open(base_url + '/appointment', "_self");
   }
   
 });

  $(document).ready(function() {
    $('.selectbox').on('change',function(e) {
      var appointment_id =  $('#appointment_id').val();
      if(appointment_id) {
        var action = "{{route('getServices')}}";
      }
      else {
        var action = "{{route('getServices')}}";
      }
      var busId = $('.selectbox').val();
      $.ajax({
        url: action,
        type: 'POST',
        data: {business_id: busId,appointment_id:appointment_id },
        success: function (res) { 
          if(res.status == true) {
            var html = '';
            $("#services").html('');
            if(res.checked == true) { 
              $.each(res.services, function( index, value ) {
                html+= '<input type="checkbox" name="service_id[]" class="dynamic-services service_id" value="'+value.id+'"';
                $.each(res.appointmentServices, function( ind, val ) {
                  if(value.id == val.services_id) {
                    html+= 'checked = "checked"';
                  }
                });
                html+= '>'+value.name;
              });
            }else {
              $.each(res.services, function( index, value ) {
                html+= '<input type="checkbox" name="service_id[]" class="dynamic-services service_id" value="'+value.id+'"'>
                +value.name;
              }); 
            }                           
          }
          $("#services").html(html);
        }
        
      })
    });
  });

  $(document).on("change",".common-checkbox-div",function(){

    if($(this).prop("checked") == true){
      $(this).next(".checkmark").css("border","unset");
    }
    else if($(this).prop("checked") == false){
      $(this).next(".checkmark").css("border","2px solid #ed145b");
    }else{

    }

  });
  $('.common-checkbox-div:checked').each(function(index, elem) {
    $(this).next(".checkmark").css("border","unset");
  });

  $(document).on('click','.add-customer',function(){
    $(".checkmark").css("border","2px solid #ed145b");
  });

  // appointment Datatable

    $(document).ready(function() { 
    $.fn.dataTable.ext.classes.sPageButton ='btn-sm btn-danger yajra-pagination';
   //$.fn.dataTableExt.oJUIClasses ='margin-top:10px';
      var oTable = $('#appointmentLists').DataTable({
          "bLengthChange": false,
          processing: true,
          serverSide: true,
          //bDestroy: true,
          "bSortable" : false,
          ajax: {
              method:'post',
              url: '{{ route('appointment.list') }}',
              data: function (d) {
                  d.arrange = $('select[name=arrange]').val();
                  d.filter = $('select[name=filter]').val();
              }
          },
          columns: [
              {data: 'id', name: 'id'},
              {data: 'name', name: 'name', orderable: false},
              {data: 'email', name: 'email', orderable: false},
              {data: 'phone', name: 'phone', orderable: false},
              {data: 'appointment_date', name: 'appointment_date', orderable: false},
              {data: 'appointment_time', name: 'appointment_time', orderable: false},
              {data: 'service', name: 'service', orderable: false},
              {data: 'staffname', name: 'staffname', orderable: false},
              {data: 'action', name: 'action',className:'noPrint', orderable: false,width:'100px'},
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

      $(document).on('click','.edit-appointment',function(){
        var appointment_id = $(this).attr('id');
        alert(appointment_id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "get",
            url: "{{url('/appointment/')}}"+"/"+appointment_id,
            data: { id:appointment_id},
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




function service(){
    $(document).on('change','.restservices',function(){
        $('#service-id').html('');
        var value  = $('.restservices').is(':checked');
        if(value == false){
            $('#service-id').html('');
            $('.checkData').prop('disabled', true);
            $('#service-id').html('Service field required.');
        }else if(value == true){
            $('.checkData').prop('disabled', false);
        }
    });
}
    function checkService() {
            $(document).on('click','.checkData',function(){
            var value  = $('.restservices').is(':checked');
            if(value == false) {
                $('#service-id').html('');
                $('.checkData').prop('disabled', true);
                $('#service-id').html('Service field required.');
            }
            service();
        }); 
    }
    
    $(document).ready(function() {
        checkService();
    });
</script>
@endpush

