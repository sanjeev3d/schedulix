@extends('layouts.app-inner')

@section('content')

<style>
 .modal-backdrop.fade {
  opacity: 1;
}
.modal-backdrop {
  background-color: rgba(0,0,0,0.5);
}
.error {
  color:red;
}
</style>
<div class="dashboard-wrapper dashboard-wrapper-new-div ">
  <div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content">
      <div class="ecommerce-widget">
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="admin-penal-right-side-contain-common-main-div">
              <div class="card common-card-div business-logo-main staff">
                <div class="row">
                  <div class="col-sm-12 col-md-12 col-xs-12">
                    <!-- @if(session()->has('success'))
                    <div class="alert alert-success">{{ session()->get('success') }}</div>
                    @endif -->
                    @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      {{ Session::get('success') }}
                    </div>
                    @endif
                   <!--  @if(session()->has('error'))
                    <div class="alert alert-danger">{{ session()->has('error') }}</div>
                    @endif -->
                    @if(session()->has('success_delete'))
                    <div class="alert alert-success">{{ session()->get('success_delete') }}</div>
                    @endif
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <h2 class="pb-2 pt-5">Staff</h2>
                  </div>
                  <div class="col-md-6 add-services" style="cursor: pointer;">
                    <a class="add-service-btn float-right pb-2 pt-5" data-toggle="modal" data-target="#staffModal" id="add_staff">
                      <button type="button"><i class="fa fa-plus"></i></button>
                      <span class="ml-2">Add Staff</span>
                    </a>
                  </div>
                </div>
                <div class="business-logo text-center pd-10">
                  <div class="row">
                    <div class="col-md-2 padding-remove-div">
                     <h4 class="service-menu-heading-div">Staff Name</h4>
                   </div>
                   <div class="col-md-2 padding-remove-div">
                    <h4 class="service-menu-heading-div">Email</h4>
                  </div>
                  <div class="col-md-2 padding-remove-div">
                    <h4 class="service-menu-heading-div">Mobile(Optional)</h4>
                  </div>
                  <div class="col-md-2 padding-remove-div">
                    <h4 class="service-menu-heading-div">Role </h4>
                  </div>
                      <!-- <div class="col-md-2 padding-remove-div">
                          <h4 class="service-menu-heading-div">Services </h4>
                        </div> -->
                        <div class="col-md-2 padding-remove-div">
                          <h4 class="service-menu-heading-div">Action </h4>
                        </div>
                      </div>
                      <?php 
                      /* echo "<pre>";
                      print_r($all_staff);
                      die;*/
                      ?>

                  @if($all_staff->isEmpty())
                  <div class="row">
                    <h3 class="pt-4 text_center">No Staff found ..!</h3>
                  </div>
                  @else
                  @foreach($all_staff as $users_staff_result)
                  <form method="post" >
                    <div class="row">
                      <input type="hidden" name="business_id" value="<?php if(isset($business_id)){ echo $business_id->business_id; } ?>">
                      <input type="hidden" name="staff_user_id" value="{{ $users_staff_result->user_id }}">
                      {{ csrf_field() }}

                         <!-- <div class="staff-icon">
                         </div> -->
                         <div class="col-md-2 form-group padding-remove-div information-school text-left">
                          <input type="text" name="staff_name" class="form-control form-information shadow" placeholder="Zia" value="{{ $users_staff_result->name }}">
                          @if ($errors->has('staff_name'))
                          <span class="help-block">
                            <strong>{{ $errors->first('staff_name') }}</strong>
                          </span>
                          @endif
                        </div>

                        <div class="col-md-2 form-group padding-remove-div information-school  text-left">
                          <input type="text" name="email" class="form-control form-information shadow" placeholder="aaa@gmail.com" value="{{ $users_staff_result->email }}">
                          @if ($errors->has('email'))
                          <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                          </span>
                          @endif
                        </div>

                        <div class="col-md-2 form-group padding-remove-div information-school text-left">
                          <input type="number" name="staff_mobile" class="form-control form-information shadow" placeholder="8565156562" value="{{ $users_staff_result->mobile }}">
                          @if ($errors->has('staff_mobile'))
                          <span class="help-block">
                            <strong>{{ $errors->first('staff_mobile') }}</strong>
                          </span>
                          @endif
                        </div>

                        <div class="col-md-2 padding-remove-div information-school form-group text-left">
                          <select class="form-control form-information shadow" name="staff_role" id="sel1">
                            <option value="3" {{ $users_staff_result->role_id == 3 ? 'selected' : '' }} >Manager</option>
                            <option value="4" {{ $users_staff_result->role_id == 4 ? 'selected' : '' }} >Staff</option>
                          </select>
                          @if ($errors->has('staff_role'))
                          <span class="help-block">
                            <strong>{{ $errors->first('staff_role') }}</strong>
                          </span>
                          @endif
                        </div>
                        <?php
                        $select_service_arr = array();
                        ?>
                        @foreach($all_services as $all_service)
                        @foreach($select_services as $select_services_val) @if($select_services_val->service_id == $all_service->id && $users_staff_result->user_id == $select_services_val->user_id) <?php array_push($select_service_arr, $all_service->id); ?> @endif @endforeach
                        @endforeach

                        <?php
                        $service_sel = "";
                        if(!empty($select_service_arr)){
                          $service_sel = implode(',', $select_service_arr);
                        }
                        
                        ?>
                        <!-- <div class="col-md-2 padding-remove-div information-school form-group text-left">
                          <select class="form-control form-information shadow" name="staff_service[]" multiple="" id="sel1">
                            
                          </select>
                          @if ($errors->has('staff_service'))
                            <span class="help-block">
                              <strong>{{ $errors->first('staff_service') }}</strong>
                            </span>
                          @endif
                        </div> -->
                        <!-- <div class="col-md-1 padding-remove-div staff-setting-btn ">
                           <button type="submit" name="update" class="btn">Update</button>
                         </div> -->
                        <!-- <div class=" ml-2 staff-mobile-update padding-remove-div  ">
                          <button type="submit" name="update" class="btn">
                            <i class="fa fa-refresh"></i>
                          </button>
                        </div> -->
                        <div style="padding: 10px;" class="col-md-2 padding-remove-div action_btn_top">
                          <a class="action_btn" id="staff_edit" data-toggle="modal" data-target="#staffModal" staff_user_id="{{ $users_staff_result->user_id }}" staff_name="{{ $users_staff_result->name }}" email="{{ $users_staff_result->email }}" staff_mobile="{{ $users_staff_result->mobile }}" staff_role="{{ $users_staff_result->role_id }}" select_services_id="<?php echo $service_sel; ?>">
                            <i class="fas fa-pencil-alt"></i>
                          </a>
                            <!-- <a  class="action_btn" href="{{ route('staff_delete.destroy', $users_staff_result->id) }}">
                                <i style="width: 20px;" class="fas fa-times"></i>
                              </a> -->
                              {{--<a  class="action_btn deleteStaff" data-id="{{$users_staff_result->id}}" href="javascript:void()">
                                <i style="width: 20px;" class="fas fa-times"></i>
                              </a>--}}
                              <a style="margin-left: 10px;" href="javascript:delete_account('{{$users_staff_result->id}}','deletecategory','deletestaff')" data-toggle="tooltip" id="%s" class="action_btn" >
                                <i style="width: 20px;" class="fas fa-times"></i>
                              </a> 
                            </div>
                          </div>
                        </form>
                        @endforeach
                        @endif
                        <div class="text-left mt-3">
                          <div>
                            <div id="staffModal" class="modal services fade" role="dialog" data-keyboard="false" data-backdrop="static">
                              <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content staff-modal-content">
                                  <div class="modal-header header-color">
                                    <h4 class="modal-main-heading" style="font-size: 20px;margin:0px;">Staff</h4>
                                    <button style="color: white;" type="button" class="close refreshall" data-dismiss="modal">&times;</button>
                                  </div>
                                  <div class="modal-body">
                                    <form method="post" id="addStaff" style="padding-top: 3%;">
                                      <input type="hidden" name="staff_user_id" id="modal_user_id" value="">
                                      <input type="hidden" name="service_menu_id" value="">
                                      <input type="hidden" name="business_id" value="<?php if(isset($business_id)){ echo $business_id->business_id; } ?>">

                                      {{ csrf_field() }}

                                      <div class="row"> 
                                        <div class="col-md-6 form-group information-school text-left">
                                          <label>Staff Name </label>
                                          <input type="text" name="staff_name" class="form-control form-information shadow" placeholder="Staff Name" />
                                          <div class="error staff_name"></div>
                                        </div>

                                        <div class="col-md-6 form-group information-school  text-left">
                                         <label>Email </label>
                                         <input type="text" name="email" class="form-control form-information shadow" placeholder="Email Id" />
                                         <div class="error email"></div>
                                       </div>
                                     </div>
                                     <div class="row">
                                      <div class="col-md-6 form-group information-school text-left">
                                        <label>Mobile (optional)</label>
                                        <input type="number" name="staff_mobile" id="staff_mobile" class="form-control form-information shadow" placeholder="Mobile Number" />
                                        <div class="col-md-12 form-group information-school text-left" style="margin-top: 12px;">
                                          <!-- <span id="errorMsg" style="display:none;color:red;">The staff mobile may not be greater than 10 characters.</span> -->
                                          <div class="error staff_mobile"></div>
                                        </div>
                                      </div>

                                      <div class="col-md-6 information-school form-group text-left">
                                        <label>Role </label>
                                        <select class="form-control form-information shadow" id="sel1" name="staff_role">
                                          <option value="3">Manager</option>
                                          <option value="4">Staff</option>
                                        </select>
                                      </div>
                                      <div class="error staff_role"></div>
                                    </div>
                                    <div class="row information-school common-check-box-div" style="margin-top: 0px!important;padding: 0px 15px;">
                                      <p><label>Services</label></p>
                                      <div class="col-md-12">
                                        @foreach($all_services as $all_service)
                                        <div class="services_main">
                                          <label class="containersss">{{ $all_service->name }}
                                           <input type="checkbox" name="staff_service[]" class="form-control" id="sel_service_<?php echo $all_service->id; ?>" value="{{ $all_service->id }}">
                                           <span class="checkmark"></span>
                                         </label>
                                       </div>
                                       @endforeach
                                     </div>
                                     <div class="error staff_service"></div>
                                   </div>
                                   <div class="modal-footer">
                                    <button type="submit" name="submit" class="SubmitButton">Submit</button>
                                  </div>
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
        </div>
      </div>
    </div>
  </div>
  @endsection
  @push('scripts')

  <script type="text/javascript">
    $(document).ready(function(){
      $("#addStaff").validate({
        rules: {},
        messages: {},
        submitHandler: function(form) {
          var business_id =  $('#business_id').val();
          if(business_id){
            var url = "{{url('/staff/store')}}"+"/"+business_id;
          }else {
            var url = "{{url('/staff/store')}}";
          }
          var formData = new FormData($('#addStaff')[0]);
          $.ajax({
            type: 'POST',
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
              }else {
                $('.error').text("");
                window.open(base_url + '/staff', "_self");
              }
            }
          });
        }
      });
    });
  // $(document).on('click','.action_btn',function(){
  // $('.error').text("");
  // });
  // $(document).on('click','.add-service-btn',function(){
  // $('.error').text("");
  // });
  $(document).on('click','.refreshall',function(){
    window.open(base_url + '/staff', "_self");
  });
</script>

@endpush