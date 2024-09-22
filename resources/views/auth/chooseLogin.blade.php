@extends('layout.auth.authLayout')

@section('title')
    Choose Login
@endsection

@section('content')
<div class="login-box">

    <div class="login-logo">
        <a href="../../index2.html">SNHS <b>Smart-Hub</b></a>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Choose user type</p>
            <div class="row">
                <a href="{{url('login', ['userType' => "student"])}}" class="btn btn-info btn btn-sm col-12">Student</a>
                <a href="{{url('login', ['userType' => "parents"])}}"  class="btn btn-info btn btn-sm col-12 mt-2">Parents</a>
                <a href="{{url('login', ['userType' => "faculty"])}}"  class="btn btn-info btn btn-sm col-12 mt-2">Faculty</a>
                <a href="{{url('login', ['userType' => "administrator"])}}"  class="btn btn-info btn btn-sm col-12 mt-2">Administrator</a>
            </div>

        </div>

    </div>
</div>   
@endsection