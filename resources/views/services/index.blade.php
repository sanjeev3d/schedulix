@extends('layouts.app-inner')

@section('content')

<style type="text/css">
    .fade:not(.show) {
        opacity: 1;
    }
    .error{
        color: red;
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
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            {{ Session::get('success') }}
                        </div>
                        @endif 
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                        <div class="admin-penal-right-side-contain-common-main-div services">
                            <div class="card common-card-div business-logo-main">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h2 class="pb-2 pt-5">Services</h2>
                                    </div>
                                    <div class="col-md-6 add-services ">
                                        <a class="add-service-btn float-right pb-2 pt-5" data-toggle="modal" data-target="#ServicesModal" style="cursor: pointer;">
                                            <button type="button"><i class="fa fa-plus"></i></button>
                                            <span class="ml-2">Add Service</span>
                                        </a>
                                    </div>
                                </div>
                                <?php
                                /*echo "<pre>";
                                print_r($businessinfo);
                                die;*/
                                ?>
                                <div class="service-menu-div">
                                    <div class="row">
                                        <div class="col-md-6 padding-remove-div">
                                         <h4 class="service-menu-heading-div">Service Title</h4>
                                     </div>
                                     <div class="col-md-2 padding-remove-div">
                                        <h4 class="service-menu-heading-div">Duration (Minutes)</h4>
                                    </div>
                                    <div class="col-md-2 padding-remove-div">
                                        <h4 class="service-menu-heading-div">Price [@if($businessinfo) {{ ucfirst($businessinfo->currency) }} @else Bahraini Dinar @endif]</h4>
                                    </div>
                                    <div class="col-md-2 padding-remove-div">
                                        <h4 class="service-menu-heading-div">Action </h4>
                                    </div>
                                    <div class="col padding-remove-div"></div>
                                </div>
                                <?php
                                   /* echo "<pre>";
                                    print_r($users_services_data);
                                    die;*/
                                    ?>

                                    @if($users_services_data->isEmpty())
                                    <div class="row">
                                        <h3 class="text_center">No services found ..!</h3>
                                    </div>
                                    @else
                                    @foreach($users_services_data as $users_services_result)

                                    <form method="post" action="{{ route('services_create.create') }}">
                                        <div class="row"> 
                                            <input type="hidden" name="service_menu_id" value="{{ $users_services_result->id }}">
                                            <input type="hidden" name="business_id" value="@if(isset($getBusinessId)) {{ $getBusinessId->business_id }} @endif">
                                            {{ csrf_field() }}
                                            <div class="col-md-6 padding-remove-div">
                                                <input type="text" name="service_name" class="form-control" placeholder="Enter Service Name" value="{{ $users_services_result->name }}">
                                            </div>
                                            <div class="col-md-2 padding-remove-div">
                                                <input type="number" name="service_duration" class="form-control" placeholder="Enter Duration Time" value="{{ $users_services_result->duration }}">
                                            </div>
                                            <div class="col-md-2 padding-remove-div">

                                                <input type="text" name="service_price" id="service_price" class="form-control service_price" placeholder="Enter Price" value="{{ $users_services_result->price }}" max="9" min="0">
                                                    <!-- <div class="col-md-12 form-group information-school text-left" style="margin-top: 12px;">
                                                        <span id="errorMsg" style="display:none;color:red;">Service price may not be greater than 2 digits.</span>
                                                    </div> -->
                                                </div>
                                                <div class="col-md-2 padding-remove-div action_btn_top">
                                                 <!--  <button type="submit" name="update" class="btn">Update</button> -->
                                                 <a class="action_btn"><button type="submit" name="update">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button></a>

                                                <a class="action_btn" onclick="return confirm('Are you sure you want to delete this item?');" href="{{ route('services_delete.destroy', $users_services_result->id) }}">
                                                    <i class="fas fa-times"></i>
                                                    </a
                                                    >
                                                </div>
                                            </div>
                                        </form>
                                        @endforeach
                                        @endif

                                        <div class="modal main-modal-div services-selection" id="ServicesModal" style=" padding-right: 17px;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- Modal body -->
                                                    <div class="modal-body p-0">
                                                        <div class="modal-header header-color">
                                                            <h4 class="modal-main-heading">Add Service</h4>
                                                            <button style="color: white;" type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <form method="post" id="service_modal_form"  style="padding-top: 1%;">
                                                            <div class="modal-body">
                                                                <div class="alert alert-error service_modal_error"></div>

                                                                <div class="row">
                                                                    <input type="hidden" name="modal_business_id" value="@if(isset($getBusinessId)) {{ $getBusinessId->business_id }} @endif">
                                                                    {{ csrf_field() }}
                                                                    <div class="col-md-6 padding-remove-div">
                                                                        <h4 class="service-menu-heading-div">Service Title</h4>
                                                                        <input type="text" name="modal_service_name" class="form-control modal_service_name" placeholder="Enter service name">
                                                                        <div class="error modal_service_name"></div>
                                                                    </div>
                                                                    <div class="col-md-3 padding-remove-div">
                                                                        <h4 class="service-menu-heading-div">Duration (Minutes)</h4>
                                                                        <input type="number" name="modal_service_duration" class="form-control modal_service_duration" placeholder="Enter duration time">
                                                                        <div class="error modal_service_duration"></div>
                                                                    </div>
                                                                    <div class="col-md-3 padding-remove-div">
                                                                        <h4 class="service-menu-heading-div">Price [@if($businessinfo) {{ ucfirst($businessinfo->currency) }} @else Bahraini Dinar  @endif)</h4>
                                                                        <input type="text" name="modal_service_price" class="form-control modal_service_price" placeholder="Enter price" id="modal_service_price" >
                                                                        <div class="col-md-12 form-group information-school text-left" style="margin-top: 12px;">
                                                                            <!-- <span id="ModalerrorMsg" style="display:none;color:red;">Service price may not be greater than 1 digits.</span> -->
                                                                        </div>
                                                                        <div class="error modal_service_price"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="col-md-1 padding-remove-div" style="position: relative;right: 10%;">
                                                                    <button type="button" onclick="submitForm()" class="SubmitButton">Submit</button>
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
@push('scripts')
<script type="text/javascript">
    function submitForm() {
        $('.error').text("");
        var url = "{{route('services.store')}}";
        var formData = new FormData($('#service_modal_form')[0]);
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
                }else if(res.status==true) {
                    $('.error').text("");
                    $('#ServicesModal').modal('hide');
                    window.open(base_url + '/services', "_self");
                }else{
                    window.open(base_url + '/services', "_self");
                }
            }
        });
    }
</script>
@endpush