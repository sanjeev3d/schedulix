        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark sidebar-new-main-div">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <button class="navbar-toggler mobile-bar-menu-icon-div" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class=""><i class="fas fa-bars"></i></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column navbar-new-div">
                            @if(!empty(Auth::user()->role_id))
                            @if(Auth::user()->role_id ==2 )
                            <li class="nav-item">
                                <a class="nav-link {{Request::is('home') ? 'active' : ''}}" href="{{ route('home') }}">
                                    <img src="{{asset('assets/images/menu-icon1.png')}}" class="img-fluid">                         
                                Dashboard</a>
                            </li>
                            @endif
                            @if( Auth::user()->role_id == 2 )
                            <li class="nav-item">
                                <a class="nav-link {{Request::is('customers') ? 'active' : ''}}" href="{{ route('customerList') }}">
                                    <img src="{{asset('assets/images/menu-icon3.png')}}" class="img-fluid">
                                Customers</a>
                            </li>
                            @endif
                             @if(Auth::user()->role_id == 5 || Auth::user()->role_id == 2 )
                            <li class="nav-item">
                                <a class="nav-link {{Request::is('appointment') ? 'active' : ''}}" href="{{route('appointment.calendar')}}">
                                    <img src="{{asset('assets/images/menu-icon2.png')}}" class="img-fluid">
                                Appointments</a>
                            </li>
                             @endif
                            @if( Auth::user()->role_id == 2 )
                            <li class="nav-item">
                                <a class="nav-link {{Request::is('business_details') ? 'active' : ''}}" href="{{ action('BusinessDetailsController@index') }}">
                                    <img src="{{asset('assets/images/menu-icon4.png')}}" class="img-fluid">
                                Business Details</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{Request::is('business_timing') ? 'active' : ''}}" href="{{ action('BussinessTimingController@index') }}">
                                    <img src="{{asset('assets/images/menu-icon4.png')}}" class="img-fluid">
                                Business Timing</a>
                            </li>

                            <!-- <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <img src="{{asset('assets/images/menu-icon5.png')}}" class="img-fluid">
                                Settings</a>
                            </li> -->
                            
                            <li class="nav-item">
                                <a class="nav-link {{Request::is('services') ? 'active' : ''}}" href="{{ action('ServicesController@index') }}">
                                    <img src="{{asset('assets/images/menu-icon4.png')}}" class="img-fluid">
                                Services</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{Request::is('staff') ? 'active' : ''}}" href="{{ action('StaffController@index') }}">
                                    <img src="{{asset('assets/images/menu-icon4.png')}}" class="img-fluid">
                                Staff</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{Request::is('privacy') ? 'active' : ''}}" href="{{ action('PrivacyController@index') }}">
                                    <img src="{{asset('assets/images/menu-icon4.png')}}" class="img-fluid">
                                Privacy Policy</a>
                            </li>

                            <!-- <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <img src="{{asset('assets/images/menu-icon6.png')}}" class="img-fluid">
                                Membership</a>
                            </li> -->
                            <?php  $busId = Auth::user()->unique_id; ?>
                            <li class="nav-item">
                                <a class="nav-link {{Request::is('*/appointment*') ? 'active' : ''}}" href="{{ url( '/'. $busId .'/appointment?microsite="'.base64_encode('microsite').'"')}}">
                                    <img src="{{asset('assets/images/menu-icon6.png')}}" class="img-fluid">
                                Microsite</a>
                            </li>
                         <!--    <li class="nav-item">
                                <a href="#lvl1a" class="nav-link" data-toggle="collapse" data-parent="#leftnav">   <img src="{{asset('assets/images/menu-icon6.png')}}" class="img-fluid">Submenu</a>
                                <div class="collapse list-group-submenu" id="lvl1a">
                                  <a href="#lvl1a-sub" class="nav-link active" data-toggle="collapse" data-parent="#lvl1a-sub">Level 2 Link </a>
                                  <div class="collapse list-group-submenu" id="lvl1a-sub">
                                    <a href="#" class="nav-link" data-parent="#lvl1a-sub">Level 3 Link</a>
                                    <a href="#" class="nav-linkselected" data-parent="#lvl1a-sub">Level 3 Link</a>
                                    <a href="#" class="nav-link" data-parent="#lvl1a-sub">Level 3 Link</a>
                                  </div>
                                  <a href="#" class="list-group-item">Level 2 Link</a>
                                  <a href="#" class="list-group-item">Level 2 Link</a>
                                </div>
                            </li> -->
                            @endif
                            @if(Auth::user()->role_id == 5 || Auth::user()->role_id == 2 )
                            <li class="nav-item">
                                <a class="nav-link"  href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <img src="{{asset('assets/images/user-img.png')}}" class="img-fluid">
                                LogOut</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                            @endif
                        @endif
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->