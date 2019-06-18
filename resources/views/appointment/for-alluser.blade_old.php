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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>  
  <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">   -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css" />
</head>
    
<!-- ============================================================== -->
<div class="dashboard-wrapper dashboard-wrapper-new-div ">
  <div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content ">
      <div class="ecommerce-widget">
        <div class="row">
          <!-- recent orders  -->
          <!-- ============================================================== -->
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="admin-penal-right-side-contain-common-main-div">
              <div class="card common-card-div">
                <div class="cstomer-page-contain-main-div">
                  <h4 class="main-common-heading">Calendar</h4>
                  @if(Session::has('success'))
                  <div class="alert alert-success alert-dismissible">
                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                     {{ Session::get('success') }}
                   </div>
                   @endif
                  {{-- <div class="search-customer-main-div">
                    <div class="left-side-contain-div">
                      <div class="row">
                      </div>
                    </div>
                    <div class="right-side-contain-div">
                      <p class="linkss-div" id="modal-open"><a href="javascript:void(0)" class="add-customer"><img src="{{asset('assets/images/link-circle-img.png')}}"> Add Appointment</a></p>
                    </div>
                  </div> --}}

                  <!-- start full calendar -->
                  {{-- <div class="panel panel-primary">  
                    <div class="panel-heading">Scheduled Appointments</div>  
                    <div class="panel-body"> {!! $calendar->calendar() !!} {!! $calendar->script() !!} </div>  
                  </div> --}}
                  <!-- end full calendar -->
                  <!-- Star Modal Popup Code -->
                  <div class="common-modal-main-div" id="myModal" >
                <!-- The Modal Two -->
                <div class="modal New-customer-modal-div" id="New-customer-modal" data-keyboard="false" data-backdrop="static">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <!-- Modal body -->
                      <div class="modal-body">
                        <h4 class="modal-main-heading">New Appointment</h4>

                        <form id="form_appointment">

                          {{ csrf_field() }}
                          <input type="hidden" id="appointment_id" name="appointment_id" value="@if(isset($editAppointment->id)) {{$editAppointment->id}} @endif">
                          <div class="new-customer-form-div">
                            <div class="row">
                              <!-- <div class="col-md-12 common-height-div">
                                <div class="form-group">
                                  <label>Title</label>
                                  <input type="text" class="form-control common-height-class" placeholder="Title" name="title" id="title" value="@if(isset($editAppointment->title)) {{$editAppointment->title}} @endif" autocomplete="off" readonly="">
                                   <div class="error title"></div>
                                </div>
                              </div> -->
                              <div class="col-md-6 common-height-div">
                                <div class="form-group">
                                  <label>Start Date</label>
                                  <input type="text" class="form-control datepicker common-height-class" placeholder="Start Date" name="start_date" id="start_date" autocomplete="off" value="@if(isset($editAppointment->start_date)) {{date('m/d/Y',strtotime($editAppointment->start_date))}} @endif">
                                   <div class="error start_date"></div>
                                </div>
                              </div>
                              <div class="col-md-6 common-height-div">
                                <div class="form-group">
                                  <label>End Date</label>
                                  <input type="text" class="form-control datepicker common-height-class" placeholder="End Date" name="end_date" id="end_date" value="@if(isset($editAppointment->start_date)) {{date('m/d/Y',strtotime($editAppointment->end_date))}} @endif" autocomplete="off">
                                  <div class="error end_date"></div>
                                </div>
                              </div>
                              <div class="col-md-6 common-height-div">
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
                              </div>
                              <div class="col-md-12 common-height-div">
                                <div class="form-group ">
                                  <label>Services</label>

                                  <div class="services">
                                   @if(count($servicesData) > 0)
                                     @foreach($servicesData as $service)
                                      <input type="checkbox" name="service_id[]" class="dynamic-services service_id" value="{{$service->id}}" @if(isset($editAppointment->serviceAppointment))
                                        @foreach($editAppointment->serviceAppointment as $key => $value)
                                          @if($value->services_id == $service->id)
                                            checked
                                          @endif
                                        @endforeach
                                      @endif >

                                      {{$service->name}}
                                     @endforeach
                                   @endif
                                   <div class="error service_id"></div>
                                 </div>
                                </div>
                              </div>
                                <div class="col-md-12 common-height-div">
                                    <div class="form-group">
                                        <label>Customer Name</label>
                                        <input class="typeahead form-control" type="text" name="customers_name" id="id-customer" autocomplete="off">
                                        <div class="error customers_name"></div>
                                    </div>

                                </div>
                                <div class="col-md-12 common-height-div">
                                  <div class="form-group">
                                    <label>Customer's Email</label>
                                    <input type="text" class="form-control common-height-class" placeholder="admin@gmail.com" name="customer_email" id="customer_email" value="@if(isset($editAppointment->customerAppointment->email)) {{$editAppointment->customerAppointment->email}} @endif">
                                     <div class="error customer_email"></div>
                                  </div>
                                </div>
                                <div class="col-md-12 common-height-div">
                                  <div class="form-group">
                                    <label>Mobile Phone</label>
                                    <div class="phone-field-common-div">
                                      <div class="country-number-code-div">
                                        <input type="text" class="form-control common-height-class" placeholder="+91" >
                                      </div>
                                      <div class="country-number-div">
                                        <input type="text" class="form-control common-height-class" name="mobile_phone" value="@if(isset($editAppointment->customerAppointment->mobile_phone)) {{$editAppointment->customerAppointment->mobile_phone}} @endif" id="mobile_phone" placeholder="Mobile Number">
                                        <div class="error mobile_phone" ></div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <input type="hidden" name="busUnique_id" value="{{ $bus_id }}">
                              <div class="col-md-12 common-height-div">
                                <div class="form-group">
                                  <label>Descriptions</label>
                                   <textarea name="description" class="form-control" rows="3" id="description">@if(isset($editAppointment->description)) {{$editAppointment->description}} @endif</textarea>
                                   <div class="error description"></div>
                                </div>
                              </div>
                            <div class="col-md-12">
                              <button class="btn common-modal-btn" type="button" id="addCutomer" onclick="submitForm()">Add</button>
                              @if(isset($editAppointment->id))
                            <a  href="javascript:delete_account({{$editAppointment->id}},'deleteappointment','deleteappointment')" class="btn common-modal-btn delete" id="{{$editAppointment->id}}">Delete Appointment</a>
                            @endif
                            <button style="float: right;" class="btn common-modal-btn close-modal" type="button" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> 
              </div> 
            </div> 
          </div> 
        </div> 
      </div> 
    </div> 
  </div> 
</div> 

            </div> <!-- End dashboard-wrapper -->
            <!-- ============================================================== -->

        </div> <!-- End dashboard-wrapper -->
        <!-- ============================================================== -->
@endsection


  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
  

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type = "text/javascript">


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

    function getCustomerDetail(item){
      
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
                      $('#id-customer').val(data.customerData.name);
                      $('#mobile_phone').val(data.customerData.mobile_phone);
                      $('#mobile_phone').attr("readonly", "readonly");

                  }
                    
                   else {

                    alert('No record found.');
                  }
                }
            })

        }
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

        var formData = new FormData($('#form_appointment')[0]);

        $.ajax({
            type: 'post',
            url: url,
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function (res) { 
                if(res.status == false) {
                    $('.error').text("");
                    jQuery.each(res.error, function(index, val) {
                        if ($('div').find('.'+index )) {
                            $('.'+index).text(val[0]);
                        }
                    });
                }else if(res.status == 'bus_check'){

                    swal({
                        title: "Business",
                        text: res.msg,
                        button: "close",
                        timer: 10000,
                    });
                }else if(res.status==true) {
                    $('.error').text("");
                    $('#form_appointment')[0].reset();
                    swal({
                        title: "Done",
                        text: res.msg,
                        icon: "success",
                        button: "close",
                        timer: 10000,
                    });
                }else if(res.status =='unique_check'){
                        $('.error').text("");
                        $('.customer_email').text(res.error);
                    
                }

                // else {
                //    window.open(base_url + '/appointment', "_self");
                // }
            }
        });
            //return false;
    }

$(document).ready(function() {
    
    $(document).ready(function(){
        $('#New-customer-modal').modal('show');
        // $( ".form-control" ).next("label").remove();
        // $( ".form-control" ).removeClass('error-red');
        // $('.modal-body').find('select').val('');
    })

    /******************Edit****************************************************/
    

});


 






$(document).on('keyup','#searchCust',function(){
    //customerRecords();
});



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
    
    $(document).on('click','.close-modal',function(){
        window.open(base_url + '/appointment', "_self");
    });

</script>

@endpush