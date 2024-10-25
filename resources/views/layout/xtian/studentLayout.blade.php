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

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{url('/student')}}">
            <img src="{{ asset('img/school-logo.jpg') }}" alt="School Logo" height="40" width="40">
            SSDH
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">

                    <a class="nav-link {{ request()->is('student') ? 'active' : '' }}" href="{{url('/student')}}">Grade and Schedule</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('student/event') ? 'active' : '' }}" href="{{url('/student/event')}}">Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('student/announcement') ? 'active' : '' }}" href="{{url('/student/announcement')}}">Announcement</a>
                </li>
                <li class="nav-item notif">
                    <a class="nav-link {{ request()->is('student/notification') ? 'active' : '' }}" href="{{url('/student/notification')}}">Notification
                        <span class="badge badge-danger notifC"></span>
                    </a>
                </li>
                

                <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle text-bold" data-toggle="dropdown">
                    {{$user->lrn}}
                    </button>
                    
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                        <a href="{{url('/student/info')}}" class="dropdown-item">
                            <li class="fa fa-user mr-2"></li>
                            Student Info
                        </a>
                        <a href="{{ route('settings.account') }}" class="dropdown-item">
                            <i class="nav-icon fas fa-user-cog"></i>
                            Account Settings
                        </a>
                    
                        <form action="{{url('/logout')}}" method="POST">
                            @csrf
                            @method('post')
                            <button type="submit" href="#" class="dropdown-item">
                                <li class="fa fa-lock mr-2"></li>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>

               

            </ul>
            {{-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form> --}}
        </div>
    </nav>

    <div class="container-fluid">
        @yield('content')
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

<script type="module">
    $(function(){
        getData()
        setInterval(() => {
            getData()
        }, 10000);
        function getData() {
            $.ajax({
                url: `{{ url('/student/notification/getNotif') }}`,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response > 0) {
                        $('.notifC').text(response);
                        Swal.fire({
                            icon: "info",
                            text: "New notification received. Check it out!",
                            showCancelButton: false,
                            confirmButtonText: "OK",
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "{{url('/student/notification')}}";
                            }
                        });
                    }else{
                        $('.notifC').text("");
                    }
                },
                error: function(err) {
                    console.error("Error fetching data:", err);
                }
            });
        }


    })
</script>


<style>
   .notifC {
    transform: translate(-4px, -8px); 
    }
</style>