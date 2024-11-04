@extends('layout.auth.authLayout')

@section('title')
    {{ ucfirst($userType) }} || Login
@endsection

@section('content')
    <div class="login-box">
        <form action="{{ url('/login', ['userType' => $userType]) }}" method="POST">
            @csrf
            @method('post')
            <div class="login-logo">
                <a href="../../index2.html">OSNHS <b>Smart-Hub</b></a>
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in as {{ ucfirst($userType) }}</p>

                    @if (session('error'))
                    <div class="alert alert-danger pb-0">
                         <p>Hmmm, credentials not valid!</p>
                     </div>
                    @endif

                    @if ($userType === "administrator" || $userType === "faculty")
                        <!-- Username Field for administrator and faculty only -->
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Username" name="username" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                    @elseif ($userType === "student" || $userType === "parents")
                        <!-- LRN Field for students and parents -->
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" placeholder="Enter student LRN" name="lrn" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-id-card"></span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Password Field for all user types -->
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block btn btn-sm">Sign In</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
