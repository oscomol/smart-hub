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
    <style>
        /* Custom Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa; /* Light background for contrast */
            margin: 0;
            padding: 0;
        }

        nav {
            margin-bottom: 20px; /* Space below the navbar */
        }

        .navbar-brand img {
            border-radius: 50%; /* Circular logo */
        }

        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Soft shadow for depth */
        }

        .nav-link {
            font-weight: 600; /* Bold text for better visibility */
        }

        .container-fluid {
            padding: 20px; /* Add padding for content */
            background-color: white; /* White background for content */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); /* Shadow effect */
        }

        .notifC {
            transform: translate(-4px, -8px);
            font-weight: bold; /* Highlight notifications */
            color: #dc3545; /* Bootstrap's danger color for emphasis */
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ url('/student') }}">
            <img src="{{ asset('img/school-logo.jpg') }}" alt="School Logo" height="40" width="40">
            SSDH
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <!-- Parent links -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('parents.schedule') }}">Grades & Class Schedule</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('parents.announcement') }}">School Announcements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('parents.info') }}">My Child Record</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('settings.account') }}">Account Settings</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
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

    <script type="module">
        $(function(){
            getData();
            setInterval(() => {
                getData();
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
                                    window.location.href = "{{ url('/student/notification') }}";
                                }
                            });
                        } else {
                            $('.notifC').text("");
                        }
                    },
                    error: function(err) {
                        console.error("Error fetching data:", err);
                    }
                });
            }
        });
    </script>
</body>
</html>
