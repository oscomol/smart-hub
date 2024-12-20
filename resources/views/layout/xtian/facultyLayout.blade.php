<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css'])

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
          <img class="animation__wobble" src="{{ asset('img/school-logo.jpg') }}" alt="School Logo" height="60" width="60"><br>
          <p class="animation__wobble">Smart School Data Hub</p>
        </div>
      
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link text-dark" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item float-right ms-4">
            <a class="nav-link text-dark" href="{{ route('chat.show') }}"><i class="far fa-comments"></i> Chat</a>
          </li>
        </ul>
      </nav>
        
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
              <img src="{{ asset('img/school-logo.jpg') }}" alt="facultyLTE Logo" class="img-circle elevation-3" style="opacity: .8; width: 40px; height: 40px;">
              <span class="brand-text font-weight-light">SSDH</span>
            </a>
        
            <div class="sidebar">
              <div class="user-panel mt-3 pb-2 mb-3 d-flex">

                <div class="info text-light">
                  FACULTY
                </div>
              </div>
        
              <!-- SidebarSearch Form -->
              <!-- Sidebar Menu -->
              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
                    <li class="nav-item">
                      <a href="{{url('/faculty')}}" class="nav-link {{ request()->is('faculty/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                          Dashboard
                        </p>
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="{{url('/faculty/grade-section/list')}}" class="nav-link {{ request()->is('faculty/grade-section/list') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-university"></i>
                        <p>
                          Class Management
                        </p>
                      </a>
                    </li>

                    {{-- <li class="nav-item">
                      <a href="{{url('/faculty/student/list')}}" class="nav-link {{ request()->is('faculty/student/list') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-graduation-cap"></i>
                        <p>
                          Student Management
                        </p>
                      </a>
                    </li> --}}

                  {{-- <li class="nav-item">
                    <a href="{{url('/faculty/list')}}" class="nav-link {{ request()->is('faculty/list') ? 'active' : '' }}">
                      <i class="nav-icon fa fa-group"></i>
                      <p>
                        Faculties
                      </p>
                    </a>
                  </li> --}}
                  <li class="nav-item">
                    <a href="{{url('/faculty/task/list')}}" class="nav-link {{ request()->is('faculty/task/list') ? 'active' : '' }}">
                      <i class="nav-icon far fa-calendar"></i>
                      <p>
                        Events
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/faculty/announcement/list')}}" class="nav-link {{ request()->is('faculty/announcement/list') ? 'active' : '' }}">
                      <i class="nav-icon fa fa-bullhorn"></i>
                      <p>
                        Announcement
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/faculty/memo/list')}}" class="nav-link {{ request()->is('faculty/memo/list') ? 'active' : '' }}">
                      <i class="nav-icon fa fa-send"></i>
                      <p>
                        Memo
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/faculty/notification/list')}}" class="nav-link {{ request()->is('faculty/notification/list') ? 'active' : '' }}">
                      <i class="nav-icon far fa-bell"></i>
                      <p>
                        Notification
                      </p>
                    </a>
                  </li>
                  <!-- Account Settings -->
                  <li class="nav-item">
                      <a href="{{ route('settings.account') }}" class="nav-link {{ request()->is('settings/account') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-user-cog"></i>
                          <p>Account Settings</p>
                      </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                  </li>
                  
                  {{-- <li class="nav-item">
                    <a href="{{url('/faculty/student/list')}}" class="nav-link {{ request()->is('faculty/student/list') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-address-book"></i>
                      <p>
                        Students
                      </p>
                    </a>
                  </li> --}}

                </ul>
              </nav>
            </div>
          </aside>
    

     
       
      
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid">
              <div class="d-flex justify-content-between">
                <h1 class="m-0">@yield('title')</h1>
                @yield('more')
              </div>
            </div><!-- /.container-fluid -->
          </div>
          <section class="content">
            @yield('content')
          </section>
        </div>
        <aside class="control-sidebar control-sidebar-dark">
          
        </aside>
      </div>

     @vite(['resources/js/app.js'])

     @if (session('success'))
     <script>
         Swal.fire({
             icon: "success",
             text: "{{ session('success') }}",
             timer: 3000
         });
     </script>
 @endif
 
 @if (session('error'))
     <script>
         Swal.fire({
             icon: "error",
             text: "{{ session('error') }}",
             timer: 3000
         });
     </script>
 @endif

     @yield('script')

    
</body>

</html>

<style>
    .customStyle{
      border-bottom: 1px solid gray;
      margin-bottom: 10px;
    }
    </style>
<script type="module">
  $(function() {
    $('form').submit(function() {
        $('.processing').prop('disabled', true).text('Processing...');
    });
  });
</script>

