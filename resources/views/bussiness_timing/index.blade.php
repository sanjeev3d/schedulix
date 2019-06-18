@extends('layouts.app-inner')

@section('content')

<style type="text/css">
    .fade:not(.show) {
    opacity: 1;
}
</style>
<div class="dashboard-wrapper dashboard-wrapper-new-div ">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
             <div class="ecommerce-widget">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @if(session()->has('error'))
                         <div class="alert alert-danger">{{ session()->get('error') }}</div>
                        @endif

                        @if(session()->has('success_delete'))
                        <div class="alert alert-success">{{ session()->get('success_delete') }}</div>
                        @endif

                        @if(session()->has('error_delete'))
                        <div class="alert alert-danger">{{ session()->get('error_delete') }}</div>
                        @endif

                        @if(session()->has('create_success'))
                        <div class="alert alert-success">{{ session()->get('create_success') }}</div>
                        @endif

                        @if(session()->has('create_error'))
                        <div class="alert alert-danger">{{ session()->get('create_error') }}</div>
                        @endif

                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                        <div class="admin-penal-right-side-contain-common-main-div services">
                            <div class="card common-card-div business-logo-main">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h2 class="pb-2 pt-5">Bussiness Timing</h2>
                                    </div>
                                </div>
                                <div class="service-menu-div">
                                    <div class="row">
                                        <div class="col-md-12 padding-remove-div information-school">
                                                        <div class="customer-date-divs" style="float: right;">
                                                            <label class="containerdsd">Apply All Days
                                                                <input type="checkbox" class="common-checkbox-div" id="id-checkall" name="">
                                                                <span class="checkmark checkall"></span>
                                                            </label>
                                                        </div>
                                                    </div>

                                        <div class="col-md-12">
                                            <form id="step5" name="step5" class="reg_step" action="{{ route('business_timing.store') }}" method="post" style="padding-top: 3%;">
                                                @csrf
                                                <?php 
                                                    $days = array(); 
                                                    foreach($business_time as $bt){
                                                        $days[] = $bt->day;

                                                    }                                                
                                                ?>
                                                @if(isset($business_time))
                                                <input type="hidden" name="business_id" value="@if(isset($getBusinessId)){{ $getBusinessId->business_id }} @endif">
                                                
                                                {{-- <div class="col-md-12"> --}}
                                                <div class="row custom-margin-div">
                                                    <div class="col-md-2 padding-remove-div information-school">
                                                        <div class="customer-date-divs">
                                                            <label class="containerdsd">Monday
                                                                <input type="checkbox" class="common-checkbox-div " id="monday" name="week[monday][check]" @foreach($business_time as $bt)  @if($bt->day == 'monday') checked="checked" @endif @endforeach>
                                                                
                                                                <span class="checkmark  " day_name="monday" @foreach($business_time as $bt) @if($bt->day == 'monday') style="border:unset;" value="0" @endif @endforeach></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 padding-remove-div information-school">
                                                        <div class="date-time-div">
                                                            <input type="text" name="week[monday][from]" class="form-control class-fromm  form-information shadow" id="monday-from" placeholder="Start Time" value="@foreach($business_time as $bt)@if($bt->day == 'monday'){{ $bt->start_time }}@endif\r @endforeach" {{ in_array('monday', $days) ? 'enable' : 'disabled' }}>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 padding-remove-div information-school">
                                                        <div class="date-to-text">
                                                            <p>To</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 padding-remove-div information-school">
                                                        <div class="date-time-div">
                                                            <input type="text" name="week[monday][to]" placeholder="End Time" class="form-control form-information shadow class-too" id="monday-to" value="@foreach($business_time as $bt)@if($bt->day == 'monday'){{ $bt->end_time }}@endif\r @endforeach"   {{ in_array('monday', $days) ? 'enable' : 'disabled' }}>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row custom-margin-div">
                                                    <div class="col-md-2 padding-remove-div information-school">
                                                        <div class="customer-date-divs">
                                                            <label class="containerdsd">Tuesday
                                                              <input type="checkbox" id="tuesday" class="common-checkbox-div div-checkbox  form-information shadow" name="week[tuesday][check]" @foreach($business_time as $bt) @if($bt->day == 'tuesday')  checked="checked" @endif @endforeach >

                                                              <span class="checkmark class-chemark " day_name="tuesday" @foreach($business_time as $bt) @if($bt->day == 'tuesday') style="border:unset;" value="0" @endif @endforeach></span>
                                                          </label>
                                                      </div>
                                                    </div>
                                                    <div class="col-md-4 padding-remove-div information-school">
                                                        <div class="date-time-div">
                                                            <input type="text" name="week[tuesday][from]" placeholder="Start Time" class="form-control form-information  class-from shadow" id="tuesday-from" value="@foreach($business_time as $bt)@if($bt->day == 'tuesday'){{ $bt->start_time }}@endif\r @endforeach" {{ in_array('tuesday', $days) ? 'enable' : 'disabled' }}>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 padding-remove-div information-school">
                                                        <div class="date-to-text">
                                                            <p>To</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 padding-remove-div information-school">
                                                        <div class="date-time-div">
                                                            <input type="text" name="week[tuesday][to]" placeholder="End Time" class="form-control form-information shadow class-to" id="tuesday-to" value="@foreach($business_time as $bt)@if($bt->day == 'tuesday'){{ $bt->end_time }}@endif\r @endforeach" {{ in_array('tuesday', $days) ? 'enable' : 'disabled' }}>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row custom-margin-div">
                                                    <div class="col-md-2 padding-remove-div information-school">
                                                        <div class="customer-date-divs">
                                                            <label class="containerdsd">Wednesday
                                                                <input type="checkbox" id="wednesday" class="common-checkbox-div div-checkbox " name="week[wednesday][check]" @foreach($business_time as $bt) @if($bt->day == 'wednesday')  checked="checked" @endif @endforeach>
                                                                <span class="checkmark class-chemark" day_name="wednesday" @foreach($business_time as $bt) @if($bt->day == 'wednesday') style="border:unset;" value="0" @endif @endforeach></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 padding-remove-div information-school">
                                                        <div class="date-time-div">
                                                            <input type="text" name="week[wednesday][from]" placeholder="Start Time" class="form-control class-from form-information shadow" id="wednesday-from" value="@foreach($business_time as $bt)@if($bt->day == 'wednesday'){{ $bt->start_time }}@endif\r @endforeach" {{ in_array('wednesday', $days) ? 'enable' : 'disabled' }}>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 padding-remove-div information-school">
                                                        <div class="date-to-text">
                                                            <p>To</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 padding-remove-div information-school">
                                                        <div class="date-time-div">
                                                            <input type="text" name="week[wednesday][to]" placeholder="End Time" class="form-control form-information shadow class-to" id="wednesday-to" value="@foreach($business_time as $bt)@if($bt->day == 'wednesday'){{ $bt->end_time }}@endif\r @endforeach" {{ in_array('wednesday', $days) ? 'enable' : 'disabled' }}>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row custom-margin-div">
                                                    <div class="col-md-2 padding-remove-div information-school">
                                                        <div class="customer-date-divs">
                                                            <label class="containerdsd">Thursday
                                                                <input type="checkbox" id="thursday" class="common-checkbox-div div-checkbox " name="week[thursday][check]" @foreach($business_time as $bt) @if($bt->day == 'thursday')  checked="checked" @endif @endforeach>
                                                                 
                                                                <span class="checkmark class-chemark" day_name="thursday" @foreach($business_time as $bt) @if($bt->day == 'thursday') style="border:unset;" value="0" @endif @endforeach></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 padding-remove-div information-school">
                                                        <div class="date-time-div">
                                                            <input type="text" name="week[thursday][from]" placeholder="Start Time" class="form-control form-information class-from shadow" id="thursday-from" value="@foreach($business_time as $bt)@if($bt->day == 'thursday'){{ $bt->start_time }}@endif\r @endforeach" {{ in_array('thursday', $days) ? 'enable' : 'disabled' }}> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 padding-remove-div information-school">
                                                        <div class="date-to-text">
                                                            <p>To</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 padding-remove-div information-school">
                                                        <div class="date-time-div">
                                                            <input type="text" name="week[thursday][to]" placeholder="End Time" class="form-control form-information shadow class-to" id="thursday-to" value="@foreach($business_time as $bt)@if($bt->day == 'thursday'){{ $bt->end_time }}@endif\r @endforeach" {{ in_array('thursday', $days) ? 'enable' : 'disabled' }}>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row custom-margin-div">
                                                    <div class="col-md-2 padding-remove-div information-school">
                                                        <div class="customer-date-divs">
                                                            <label class="containerdsd">Friday
                                                                <input type="checkbox" id="friday" class="common-checkbox-div div-checkbox " name="week[friday][check]" @foreach($business_time as $bt) @if($bt->day == 'friday')  checked="checked" @endif @endforeach>
                                                                 
                                                                <span class="checkmark class-chemark" day_name="friday" @foreach($business_time as $bt) @if($bt->day == 'friday') style="border:unset;" value="0" @endif @endforeach></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 padding-remove-div information-school">
                                                        <div class="date-time-div">
                                                            <input type="text" name="week[friday][from]" placeholder="Start Time" class="form-control form-information class-from shadow" id="friday-from" value="@foreach($business_time as $bt)@if($bt->day == 'friday'){{ $bt->start_time }}@endif\r @endforeach" {{ in_array('friday', $days) ? 'enable' : 'disabled' }}>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 padding-remove-div information-school">
                                                        <div class="date-to-text">
                                                            <p>To</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 padding-remove-div information-school">
                                                        <div class="date-time-div">
                                                            <input type="text" name="week[friday][to]" placeholder="End Time" class="form-control form-information shadow class-to" id="friday-to" value="@foreach($business_time as $bt)@if($bt->day == 'friday'){{ $bt->end_time }}@endif\r @endforeach" {{ in_array('friday', $days) ? 'enable' : 'disabled' }}>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row custom-margin-div">
                                                    <div class="col-md-2 padding-remove-div information-school">
                                                        <div class="customer-date-divs">
                                                            <label class="containerdsd">Saturday
                                                                <input type="checkbox" id="saturday" class="common-checkbox-div div-checkbox " name="week[saturday][check]" @foreach($business_time as $bt) @if($bt->day == 'saturday')  checked="checked" @endif @endforeach>
                                                                <span class="checkmark class-chemark" day_name="saturday" @foreach($business_time as $bt) @if($bt->day == 'saturday') style="border:unset;" value="0" @endif @endforeach></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 padding-remove-div information-school">
                                                        <div class="date-time-div">
                                                            <input type="text" name="week[saturday][from]" class="form-control class-from form-information shadow" placeholder="Start Time" id="saturday-from" value="@foreach($business_time as $bt)@if($bt->day == 'saturday'){{ $bt->start_time }}@endif\r @endforeach" {{ in_array('saturday', $days) ? 'enable' : 'disabled' }}>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 padding-remove-div information-school">
                                                        <div class="date-to-text">
                                                            <p>To</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 padding-remove-div information-school">
                                                        <div class="date-time-div">
                                                            <input type="text" name="week[saturday][to]" class="form-control class-to form-information shadow" placeholder="End Time" id="saturday-to" value="@foreach($business_time as $bt)@if($bt->day == 'saturday'){{ $bt->end_time }}@endif\r @endforeach" {{ in_array('saturday', $days) ? 'enable' : 'disabled' }}>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row custom-margin-div">
                                                    <div class="col-md-2 padding-remove-div information-school">
                                                        <div class="customer-date-divs">
                                                            <label class="containerdsd">Sunday
                                                                <input type="checkbox" id="sunday" class="common-checkbox-div div-checkbox " name="week[sunday][check]" @foreach($business_time as $bt) @if($bt->day == 'sunday')  checked="checked" @endif @endforeach>
                                                                
                                                                 
                                                                <span class="checkmark class-chemark" day_name="sunday" @foreach($business_time as $bt) @if($bt->day == 'sunday') style="border:unset;" value="0" @endif @endforeach></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 padding-remove-div information-school">
                                                        <div class="date-time-div">
                                                            <input type="text" name="week[sunday][from]" class="form-control class-from form-information shadow " placeholder="Start Time" id="sunday-from" value="@foreach($business_time as $bt)@if($bt->day == 'sunday'){{ $bt->start_time }}@endif\r @endforeach" {{ in_array('sunday', $days) ? 'enable' : 'disabled' }}>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 padding-remove-div information-school">
                                                        <div class="date-to-text">
                                                            <p>To</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 padding-remove-div information-school">
                                                        <div class="date-time-div">
                                                            <input type="text" id="sunday-to" name="week[sunday][to]" class="form-control form-information shadow class-to" placeholder="End Time" value="@foreach($business_time as $bt)@if($bt->day == 'sunday'){{ $bt->end_time }}@endif\r @endforeach" {{ in_array('sunday', $days) ? 'enable' : 'disabled' }}>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span id="step_5_error" style="display: none;color: #f00; width: 100%; float: left; text-align: center;">Please select business type.</span>
                                                <div class="text-right">
                                                    <input type="submit" class="SubmitButton bus_time" id="businessTiming" value="Submit" />
                                                </div>
                                                @endif
                                            </form>
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
<style type="text/css">
    .modal-backdrop.fade {
        opacity: 1;
    }
    .modal-backdrop {
        background-color: rgba(0,0,0,0.5) !important;
    }
</style>
@endsection

<script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }} "></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#id-checkall').val(this.checked);
        $('#id-checkall').change(function() {
            var monday =  $(document).is('#monday',':checked');
            var from =  $('#monday-from').val();
            var to =  $('#monday-to').val();
            if(monday == false && (from == '' || to == '')){
                alert('please select Monday Timing  Start Time  and End Time for Apply all days.');
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

