
<div class="dashboard-main-wrapper">
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand main-logo-div" href="{{ route('home') }}">
                    <img src="{{asset('assets/images/main-logo.png')}}" class="img-fluid">
                </a>
                <button class="navbar-toggler mobile-bar-icon-div" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class=""><i class="fas fa-bars"></i></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav navbar-right-top left-side-menu-main-div">
                        <li class="nav-item dropdown nav-user">
                            <a style="color: #ed145b !important;padding: 12px 20px !important;border: 1px solid red;margin-left: 15px;border-radius: 45px;margin-right: 0;" href="{{url('/appointment?open= '.base64_encode('appointment')) }}" class="header-style btn"><i class="fas fa-calendar-plus"></i> New Appointments</a>
                        </li>
                        @if(!empty(Auth::user()->role_id))
                            @if( Auth::user()->role_id == 2 )
                            <li class="nav-item dropdown nav-user">
                                <a style="color: #ed145b !important;padding: 12px 20px !important;border: 1px solid red;margin-left: 15px;border-radius: 45px;margin-right: 0;" class="btn" href="{{ url('/customers?open= '.base64_encode('customer')) }}"><i class="fas fa-user-plus"></i> New Customers</a>
                            </li>
                            @endif 
                        @endif
                    </ul>
                    @if(!empty(Auth::user()->role_id) && Auth::user()->role_id ==2 )
                       <ul class="navbar-nav ml-auto navbar-right-top right-side-menu-main-div">
                           <li class="nav-item">
                               <a class="nav-link" href="#">
                                   <svg width="200" height="10" data-value="{{ Session::get('percentage') }}">
                                     <path class="bg" stroke="#ccc" d="M0 10, 200 10"></path>
                                     <path class="meter" stroke="#ed145b" d="M0 10, 200 10" style="stroke-dasharray: 200; stroke-dashoffset: 200;"></path>
                                   </svg> {{ Session::get('percentage') }}%
                               </a>
                           </li>
                       </ul>
                    @endif
                    <ul class="navbar-nav ml-auto navbar-right-top right-side-menu-main-div">
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">
                                <img src="{{asset('assets/images/search-img.png')}}" class="img-fluid">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <img src="{{asset('assets/images/bail-img.png')}}" class="img-fluid">
                                <span class="circle-divs">2</span>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <div class="dropdown user-dropdown-menu-div">
                              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                <img src="{{asset('assets/images/user-img.png')}}" class="img-fluid">
                                @if(!empty(Auth::user()->name)) {{Auth::user()->name}} @endif
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Settings</a>
                                <a class="dropdown-item" href="#">Log Out</a>
                              </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->