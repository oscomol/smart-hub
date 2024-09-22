<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css'])

</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
          <img class="animation__wobble" src="{{ url('/photos/logo.png') }}" alt="AdminLTELogo" height="60"
          width="60"><br>
          <p class="animation__wobble">Clinic Reservation System</p>
        </div>
      
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
          </ul>
        </nav>
        
       
        
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
              <img src="{{ url('/photos/logo.png') }}" alt="AdminLTE Logo" class="img-circle elevation-3" style="opacity: .8; width: 40px; height: 40px;">
              <span class="brand-text font-weight-light">CRSystem</span>
            </a>
        
            <!-- Sidebar -->
            <div class="sidebar">
              <!-- Sidebar user panel (optional) -->
              <div class="user-panel mt-3 pb-2 mb-3 d-flex">
                <div class="image">
                  <img src="{{ url('/photos/userLogin.png') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                  {{-- <a href="#" class="d-block">{{$user->name}}</a> --}}
                </div>
              </div>
        
              <!-- SidebarSearch Form -->
        
              <!-- Sidebar Menu -->
              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
                    <li class="nav-item">
                      <a href="{{url('/admin/dashboard')}}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                          Dashboard
                        </p>
                      </a>
                    </li>
        
                  <li class="nav-item">
                    <a href="{{url('/admin/today-schedule')}}" class="nav-link {{ request()->is('admin/today-schedule') ? 'active' : '' }}">
                      <i class="nav-icon far fa-calendar"></i>
                      <p>
                        Weekly Schedule
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/admin/history')}}" class="nav-link {{ request()->is('admin/history') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-address-book"></i>
                      <p>
                        Reservations
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/admin/doctors')}}" class="nav-link {{ request()->is('admin/doctors') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-address-card"></i>
                      <p>
                        Doctor's List
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/admin/list')}}" class="nav-link {{ request()->is('admin/list') ? 'active' : '' }}">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        Administrator
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/admin/users')}}" class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-users"></i>
                      <p>
                        Users
                      </p>
                    </a>
                  </li>
                  
                </ul>
              </nav>
            </div>
          </aside>
    

     
       
      
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0">@yield('title')</h1>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <section class="content">
            @yield('adminContent')
          </section>
        </div>
        <aside class="control-sidebar control-sidebar-dark">
          
        </aside>
      </div>

     @vite(['resources/js/app.js'])

     @yield('script')

    
</body>

</html>

<style>
    .customStyle{
      border-bottom: 1px solid gray;
      margin-bottom: 10px;
    }
    </style>