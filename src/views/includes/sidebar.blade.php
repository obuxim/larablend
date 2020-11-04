<div class="sidebar" data-color="white" data-active-color="info">
    <div class="logo">
        <a href="{{config('app.url', 'https://duoneos.com')}}" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{asset('vendor/larablend/paper/img/logo-small.png')}}">
            </div>
            <!-- <p>CT</p> -->
        </a>
        <a href="{{config('app.url', 'https://duoneos.com')}}" class="simple-text logo-normal">
            {{config('app.name', 'Larablend')}}
            <!-- <div class="logo-image-big">
              <img src="vendor/larablend/paper/img/logo-big.png">
            </div> -->
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="{{asset('vendor/larablend/paper/img/faces/ayo-ogunseinde-2.jpg')}}" />
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#user" class="collapsed">
              <span>
                @auth Auth::user()->name @endauth
                @guest User @endguest
                <b class="caret"></b>
              </span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse" id="user">
                    <ul class="nav">
                        <li>
                            <a href="/profile/show">
                                <span class="sidebar-normal">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="/profile/edit">
                                <span class="sidebar-normal">Edit Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="/settings">
                                <span class="sidebar-normal">Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="/settings">
                                <span class="sidebar-normal">Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li class="active">
                <a href="/dashboard">
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#department">
                    <p>
                        Departments <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="department">
                    <ul class="nav">
                        <li>
                            <a href="/department/index">
                                <span class="sidebar-mini-icon"><i class="nc-icon nc-bullet-list-67"></i></span>
                                <span class="sidebar-normal"> All Departments </span>
                            </a>
                            <a href="/department/create">
                                <span class="sidebar-mini-icon"><i class="nc-icon nc-simple-add"></i></span>
                                <span class="sidebar-normal"> Create Department </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#shift">
                    <p>
                        Shifts <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="shift">
                    <ul class="nav">
                        <li>
                            <a href="/shift/index">
                                <span class="sidebar-mini-icon"><i class="nc-icon nc-bullet-list-67"></i></span>
                                <span class="sidebar-normal"> All Shifts </span>
                            </a>
                            <a href="/shift/create">
                                <span class="sidebar-mini-icon"><i class="nc-icon nc-simple-add"></i></span>
                                <span class="sidebar-normal"> Create Shift </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#employee">
                    <p>
                        Employees <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="employee">
                    <ul class="nav">
                        <li>
                            <a href="/employee/index">
                                <span class="sidebar-mini-icon"><i class="nc-icon nc-bullet-list-67"></i></span>
                                <span class="sidebar-normal"> All Employees </span>
                            </a>
                            <a href="/employee/create">
                                <span class="sidebar-mini-icon"><i class="nc-icon nc-simple-add"></i></span>
                                <span class="sidebar-normal"> Create Employee </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#attendance">
                    <p>
                        Attendances <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="attendance">
                    <ul class="nav">
                        <li>
                            <a href="/attendance_device">
                                <span class="sidebar-mini-icon"><i class="nc-icon nc-bullet-list-67"></i></span>
                                <span class="sidebar-normal"> Devices </span>
                            </a>
                            <a href="/attendance/today">
                                <span class="sidebar-mini-icon"><i class="nc-icon nc-bullet-list-67"></i></span>
                                <span class="sidebar-normal"> Today's Attendances </span>
                            </a>
                            <a href="/attendance/monthly">
                                <span class="sidebar-mini-icon"><i class="nc-icon nc-bullet-list-67"></i></span>
                                <span class="sidebar-normal"> Employee Monthly Attendance </span>
                            </a>
                            <a href="/attendance/attend">
                                <span class="sidebar-mini-icon"><i class="nc-icon nc-bullet-list-67"></i></span>
                                <span class="sidebar-normal"> All Attendance </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="/salary_sheet/index">
                    <p>Salary Sheets</p>
                </a>
            </li>
        </ul>
    </div>
</div>
