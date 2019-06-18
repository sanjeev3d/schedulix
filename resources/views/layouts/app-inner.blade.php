<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href=" {{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }} ">
    
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap-glyphicons.css') }} ">
    <link rel="stylesheet" href=" {{ asset('assets/vendor/bootstrap/css/bootstrap-datetimepicker.min.css') }} ">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/0.4.5/sweet-alert.css">
    
    <link rel="stylesheet" href=" {{ asset('assets/libs/css/style.css') }} ">
    <!-- <link rel="stylesheet" href="{{ asset('assets/libs/css/bootstrap-datetimepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/libs/css/calendar.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/libs/css/fullcalendar.min.css') }}" /> -->

    <link rel="stylesheet" href="https://pixinvent.com/bootstrap-admin-template/robust/app-assets/vendors/css/calendars/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://pixinvent.com/bootstrap-admin-template/robust/app-assets/css/plugins/calendars/fullcalendar.min.css" />
    

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/circular-std/style.css') }} " >
    
    <link rel="stylesheet" href=" {{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }} ">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css ">
    <link rel="stylesheet" href=" {{ asset('css/select2.css') }} ">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Schedulix') }}</title>
</head>

<body>

    @include('layouts.header') 
    @if(!empty(Auth::id()))
        @include('layouts.sidebar') 
    @endif
    @yield('content')
    @include('layouts.footer') 
    <script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }} "></script>
    
    <!-- bootstap bundle js -->
    <script src=" {{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }} "></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/moment.js') }} "></script>

    <script src=" {{ asset('assets/vendor/bootstrap/js/bootstrap-datetimepicker.js') }} "></script>
    <!-- <script src="https://pixinvent.com/bootstrap-admin-template/robust/app-assets/vendors/js/vendors.min.js"></script>
    <script src="https://pixinvent.com/bootstrap-admin-template/robust/app-assets/vendors/js/extensions/moment.min.js"></script> -->
    <script src="https://pixinvent.com/bootstrap-admin-template/robust/app-assets/vendors/js/extensions/fullcalendar.min.js"></script>
    <!-- <script src="https://pixinvent.com/bootstrap-admin-template/robust/app-assets/js/scripts/extensions/fullcalendar.min.js"></script> -->
    <script src="{{asset ('/js/custom.js')}}"></script>

    <!-- <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <!-- sweetalert js -->
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@7.1.0/dist/promise.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.all.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="{{ asset('assets/libs/js/canvasjs.min.js') }}"></script>
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
    
    <script type="text/javascript">
        var base_url    = "{{ url('/') }}";

        $(document).ready(function(){

            jQuery(document).on('click', '#ServicesModal .submit', function(){
                service_name = jQuery(".modal_service_name").val();
                service_duration = jQuery(".modal_service_duration").val();
                service_price = jQuery(".modal_service_price").val();
                if(service_name == "" && service_duration == "" && service_price == ""){
                    jQuery(".service_modal_error").text('All fields are required.');
                    jQuery(".service_modal_error").slideDown();
                }
            });
            
            jQuery(document).on('click', '#add_staff', function(){
                jQuery("#staffModal .insert_staff").show();
                jQuery("#staffModal .Update_staff").hide();

                jQuery("#staffModal .btn").text('Submit');

                /*$("#staffModal input[name='staff_service[]']").each(function( index ) {
                    jQuery(this).attr('checked', false);
                });

                $("#staffModal select[name='staff_role'] option").each(function( index ) {
                    jQuery(this).attr('selected', false);
                });*/

                $("#staffModal").find('input[name="staff_id"]').val('');
                $("#staffModal").find('input[name="staff_name"]').val(''); 
                $("#staffModal").find('input[name="email"]').val(''); 
                $("#staffModal").find('input[name="staff_mobile"]').val(''); 
                $("#staffModal").find('input[name="staff_role"]').val('');
            });

            jQuery(document).on('click', '#staff_edit', function(){

                jQuery("#staffModal .insert_staff").hide();
                jQuery("#staffModal .Update_staff").show();

                jQuery("#staffModal .btn").text('Update');

                jQuery("#staffModal #modal_user_id").val(jQuery(this).attr('staff_user_id'));
                
                var staff_role = jQuery(this).attr('staff_role');
                var select_services = jQuery(this).attr('select_services_id');
                select_services_arr = select_services.split(",");
                
                $("#staffModal input[name='staff_service[]']").each(function( index ) {
                    var sel_service = $( this ).val();
                    $.each(select_services_arr, function( index, value ) {
                        if(sel_service == value){
                            jQuery("#sel_service_"+sel_service).attr('checked', true);
                        }
                    });
                });

                $("#staffModal select[name='staff_role'] option").each(function( index ) {
                    var sel_role = $( this ).val();
                    if(sel_role == staff_role){
                        $(this).attr('selected', true);
                    }
                });

                $("#staffModal").find('input[name="staff_id"]').val(jQuery(this).attr('staff_user_id'));
                $("#staffModal").find('input[name="staff_name"]').val(jQuery(this).attr('staff_name')); 
                $("#staffModal").find('input[name="email"]').val(jQuery(this).attr('email')); 
                $("#staffModal").find('input[name="staff_mobile"]').val(jQuery(this).attr('staff_mobile')); 
                //$("#staffModal").find('input[name="staff_role"]').val(jQuery(this).attr('staff_role'));
            });

            jQuery(document).on('click', '#change_pass_label', function(){
                jQuery("#hidden_pass").slideUp();
                jQuery(".change_pass").slideDown();
                jQuery('#change_pass_label').hide();
            });

            jQuery(document).on("click", ".upload-icon", function(){
                jQuery("#upload_business_logo").click();
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

           

            /*window.onload = function () {

                
            }*/
        });
    </script>
    <script type="text/javascript">
        const meters = document.querySelectorAll('svg[data-value] .meter');
        meters.forEach( (path) => {
          let length = path.getTotalLength();
          let value = parseInt(path.parentNode.getAttribute('data-value'));
          let to = length * ((100 - value) / 100);
          path.getBoundingClientRect();
          path.style.strokeDashoffset = Math.max(0, to);  
        });
    </script>
    <script type="text/javascript">
        $("#staff_mobile" ).keyup(function() {
            var mobileno = $('#staff_mobile').val();
            if(mobileno.length >= 10 ){
              $('#errorMsg').show();
            }
            else{
                $('#errorMsg').hide();
            }
        });
        $(".pin_code" ).keyup(function() {
            var mobileno = $('.pin_code').val();
            if(mobileno.length >= 6 ){
              $('#pincode_err_msg').show();
            }
            else{
                $('#pincode_err_msg').hide();
            }
        });
        $(".business_phone" ).keyup(function() {
            var mobileno = $('.business_phone').val();
            if(mobileno.length >= 10 ){
              $('#business_phone_err_msg').show();
            }
            else{
                $('#business_phone_err_msg').hide();
            }
        });
        $("#modal_service_price" ).keyup(function() {
            var mobileno = $('#modal_service_price').val();
            if(mobileno.length >= 2 ){
              $('#ModalerrorMsg').show();
            }
            else{
                $('#ModalerrorMsg').hide();
            }
        });
    </script>
    <script>
        $(document).ready(function(){
            $('#country').on('change', function(){
                var country = $('#country').val();
                console.log(country);
                $.ajax({
                    url: "{{ route('Country') }}",
                    type: "post",
                    data: { country_id:country },
                    success: function(data){
                        console.log(data);
                        $("#state").html('');
                        var state = $('#state').removeAttr('disabled');
                        $("#state").append('<option selected disabled>State</option>');
                        $.each(data, function( index, value ) {
                            $("#state").append('<option value="'+value.id+'">'+value.state_name+'</option>');
                        });
                    }
                });  
            });

            $('#state').on('change', function(){
                var state = $('#state').val();
                console.log(state);
                $.ajax({
                    url: "{{ route('State') }}",
                    type: "post",
                    data: {state_id:state },
                    success: function(data){
                        console.log(data);
                        $("#city").html('');
                        var city = $('#city').removeAttr('disabled');
                        $("#city").append('<option selected disabled>City</option>');
                        $.each(data, function( index, value ) {
                            $("#city").append('<option value="'+value.id+'">'+value.city_name+'</option>');
                        });
                    }
                });  
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
    </script>

    <script type="text/javascript" src="{{ asset('js/jquery.validate.js') }}"></script>

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

    @stack('scripts')

</body>
</html>