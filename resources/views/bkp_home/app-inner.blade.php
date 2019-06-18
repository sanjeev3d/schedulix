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
    <link rel="stylesheet" href="{{ asset('assets/libs/css/bootstrap-datetimepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/libs/css/calendar.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/libs/css/fullcalendar.min.css') }}" />
    

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/circular-std/style.css') }} " >
    
    <link rel="stylesheet" href=" {{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }} ">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css ">
    <link rel="stylesheet" href=" {{ asset('css/select2.css') }} ">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Schedulix') }}</title>
</head>

<body>

    @include('layouts.header') 
    @include('layouts.sidebar') 
    @yield('content')
    @include('layouts.footer') 
    <script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }} "></script>
    
    <!-- bootstap bundle js -->
    <script src=" {{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }} "></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/moment.js') }} "></script>
    <script src=" {{ asset('assets/vendor/bootstrap/js/bootstrap-datetimepicker.js') }} "></script>
    <script src="{{asset ('/js/custom.js')}}"></script>
    <!-- <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <!-- sweetalert js -->
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@7.1.0/dist/promise.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.all.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/libs/js/canvasjs.min.js') }}"></script>
    <script type="text/javascript">
        var base_url    = "{{ url('/') }}";

        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            @if(Session::has('error'))
            swal({
                    title:'',
                    type:'error',
                    text: '{{ Session::get('error') }}'
                });
            @endif

            window.onload = function () {

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
                    name: "Proven Oil Reserves (bn)",
                    legendText: "Proven Oil Reserves",
                    color:"#71748d",
                    showInLegend: true, 
                    dataPoints:[
                        { label: "JAN", y: 266.21 },
                        { label: "FEB", y: 302.25 },
                        { label: "MAR", y: 157.20 },
                        { label: "APR", y: 148.77 },
                        { label: "MAY", y: 101.50 },
                        { label: "JUN", y: 97.8 },
                        { label: "JUL", y: 87.8},
                        { label: "AUG", y: 90.8},
                        { label: "SEP", y: 100.8},
                        { label: "OCT", y: 300.8},
                        { label: "NOV", y: 110.8},
                        { label: "DEC", y: 90.8}

                    ]
                },
                {
                    type: "column", 
                    name: "Oil Production (million/day)",
                    legendText: "Oil Production",
                    axisYType: "secondary",
                    color: "#ed145a",
                    showInLegend: true,
                    dataPoints:[
                        { label: "JAN", y: 10.46 },
                        { label: "FEB", y: 2.27 },
                        { label: "MAR", y: 3.99 },
                        { label: "APR", y: 4.45 },
                        { label: "MAY", y: 2.92 },
                        { label: "JUN", y: 3.1 },
                        { label: "JUL", y: 2.8},
                        { label: "AUG", y: 1.8},
                        { label: "SEP", y: 3.8},
                        { label: "OCT", y: 4.8},
                        { label: "NOV", y: 5.9},
                        { label: "DEC", y: 3.8}
                    ]
                }]
            });

            chart.render();
        }
        
        });
    </script>

    @stack('scripts')

</body>

</html>