<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    <title>@yield('title')</title>

    @vite(['resources/css/app.css'])
    

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{ asset('img/school-logo.jpg') }}" alt="School Logo" height="60" width="60"><br>
            <p class="animation__wobble">Smart School Data Hub......</p>
        </div>

       <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light py-3">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <h5 class="py-2">Old Sagay National High School</h5>
                </li>

            </ul>

           <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item float-right ms-4">
                    <a class="nav-link text-dark" href="{{ route('chat.show') }}">
                        <i class="far fa-comments"></i> Chat
                    </a>
                </li>

                {{-- <li class="nav-item float-right ms-4">
                    <a class="nav-link text-dark" href="#">
                        <i class="far fa-bell"></i> Notification
                    </a>
                </li> --}}

            </ul>

        </nav>
        <!-- /.navbar -->


        <!-- Sidebar -->
        <aside class="main-sidebar elevation-4">
            <a href="#" class="brand-link d-block text-center">
                <img src="{{ asset('img/school-logo.jpg') }}" alt="School Logo" class="img-fluid img-circle elevation-3" style="max-width: 150px;"> <!-- Adjust width if needed -->
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-2 mb-3 text-center">
                    <!-- Center the content -->
                    <div class="info">
                        <h4>Smart Data Hub</h4>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i> 
                                <p>Dashboard</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{url('/admin/grade-section/list')}}" class="nav-link {{ request()->is('faculty/grade-section/list') ? 'active' : '' }}">
                              <i class="nav-icon fa fa-university"></i>
                              <p>
                                Class Management
                              </p>
                            </a>
                          </li>
      
                          <li class="nav-item">
                            <a href="{{url('/admin/student/list')}}" class="nav-link {{ request()->is('faculty/student/list') ? 'active' : '' }}">
                              <i class="nav-icon fa fa-graduation-cap"></i>
                              <p>
                                Student Management
                              </p>
                            </a>
                          </li>



                        <!-- Accounts -->
                        <li class="nav-item">
                            <a href="{{ route('admin.account') }}" class="nav-link {{ request()->is('admin/account') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-circle"></i>
                                <p>Accounts</p>
                            </a>
                        </li>

                        <!-- Records Dropdown -->
                        <li class="nav-item has-treeview {{ request()->is('admin/student') || request()->is('admin/faculty') || request()->is('admin/staff') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('admin/student') || request()->is('admin/faculty') || request()->is('admin/staff') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-folder"></i> 
                                <p>
                                    Records
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <!-- Student Records -->
                                <li class="nav-item">
                                    <a href="{{ route('admin.student') }}" class="nav-link {{ request()->is('admin/student') ? 'active' : '' }}">
                                        <i class="fas fa-user-graduate nav-icon"></i> 
                                        <p>Student Records</p>
                                    </a>
                                </li>

                                <!-- Faculty Records -->
                                <li class="nav-item">
                                    <a href="{{ route('admin.faculty') }}" class="nav-link {{ request()->is('admin/faculty') ? 'active' : '' }}">
                                        <i class="fas fa-chalkboard-teacher nav-icon"></i> 
                                        <p>Faculty Records</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item {{ request()->is('schools*') || request()->is('governance*') || request()->is('facilities*') || request()->is('procedures*') || request()->is('policies*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('schools*') || request()->is('governance*') || request()->is('facilities*') || request()->is('procedures*') || request()->is('policies*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-building"></i> 
                                <p>
                                    Administrative Details
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('schools.index') }}" class="nav-link {{ request()->is('schools*') ? 'active' : '' }}">
                                        <i class="fas fa-school nav-icon"></i> 
                                        <p>School Information</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('governance.index') }}" class="nav-link {{ request()->is('governance*') ? 'active' : '' }}">
                                        <i class="fas fa-user-tie nav-icon"></i>
                                        <p>Governance and Leadership</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('facilities.index') }}" class="nav-link {{ request()->is('facilities*') ? 'active' : '' }}">
                                        <i class="fas fa-building nav-icon"></i> 
                                        <p>School Facilities</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('procedures.index') }}" class="nav-link {{ request()->is('procedures*') ? 'active' : '' }}">
                                        <i class="fas fa-clipboard-list nav-icon"></i> 
                                        <p>Administrative Procedures</p>
                                    </a>
                                </li>                                
                                <li class="nav-item">
                                    <a href="{{ route('policies.index') }}" class="nav-link {{ request()->is('policies*') ? 'active' : '' }}">
                                        <i class="fas fa-file-alt nav-icon"></i> 
                                        <p>Policies</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Logs -->

                        <li class="nav-item">
                            <a href="{{ route('admin.memo') }}" class="nav-link {{ request()->is('admin/memo') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file"></i> 
                                <p>Memo</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{url('/admin/announcements')}}" class="nav-link {{ request()->is('admin/announcements') ? 'active' : '' }}">
                              <i class="nav-icon fa fa-bullhorn"></i>
                              <p>
                                Announcement
                              </p>
                            </a>
                          </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.notif') }}" class="nav-link {{ request()->is('admin/notifications') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-bell"></i> 
                                <p>Notification</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.events') }}" class="nav-link {{ request()->is('admin/events') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-calendar"></i> 
                                <p>Events</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.logs') }}" class="nav-link {{ request()->is('admin/logs') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-history"></i> 
                                <p>Logs</p>
                            </a>
                        </li>

                        <!-- Account Settings -->
                        <li class="nav-item">
                            <a href="{{ route('settings.account') }}" class="nav-link {{ request()->is('settings/account') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>Account Settings</p>
                            </a>
                        </li>
                        

                        <!-- Logout -->
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="nav-icon fas fa-sign-out-alt"></i> 
                                <p>Logout</p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>


     
        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6 mt-3">
                            <h4 class="m-0">@yield('title')</h4>
                        </div>
                        <div class="col-sm-6 d-flex justify-content-end mt-3">
                            @yield('breadcrumbs')
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <section class="content">
                @yield('adminContent')
            </section>
        </div>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-light">

        </aside>
    </div>

    @vite(['resources/js/app.js'])
    @yield('script')

    <!-- Footer -->
    <footer class="main-footer">
        <strong>&copy; {{ date('Y') }} Old Sagay National High School.</strong> All rights reserved.
    </footer>
    
</body>

</html>
<style>
      
    .brand-link {
    color: #212529; 
    text-decoration: none; 
    }

    .brand-link:hover {
        color: #0056b3; 
        text-decoration: none; 
    }

    .brand-link img {
        width: 40px;
        height: 40px;
        margin-right: 10px;
    }
    

    .user-panel .image img {
        width: 30px; 
        height: 30px;
    }

    .user-panel .info {
        line-height: 30px;
    }

    .sidebar {
        padding: 10px 0; 
    }

    .main-sidebar {
        background-color: #f8f9fa; 
        color: #212529; 
    }

 
    .content-wrapper {
        background-color: #ffffff; 
    }

  
    .main-header.navbar {
        background-color: #ffffff; 
        color: #212529;
    }
</style>