@extends('layout.xtian.facultyLayout')

@section('title')
    Faculty Details
@endsection

@section('more')
<ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
        <a class="btn btn-sm btn btn-info" data-toggle="dropdown" href="#" aria-expanded="false">
            More
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
            <a href="{{url('/faculty/edit', ["id" => $faculty->id])}}" class="dropdown-item">
                Manage Information
            </a>
            <a href="{{url('/faculty/qualification', ["id" => $faculty->id])}}" class="dropdown-item" >
               Qualifications
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{url('/faculty/teaching-assignment', ["id" => $faculty->id])}}" class="dropdown-item">
               Add Teaching Assignment
            </a>
            <div class="dropdown-divider"></div>
        </div>
    </li>
</ul>
   
@endsection


@section('content')
<div class="container-fluid">
    <h2>{{ $faculty->name }}'s Details</h2>
    <hr>

    <div class="row">
        <div class="col-md-6">
            <h5>Personal Information</h5>
            <div class="title-line"></div>
            <p><strong>Birth Date:</strong> {{ \Carbon\Carbon::parse($faculty->birth)->format('m/d/Y') }}</p>
            <p><strong>Gender:</strong> {{ $faculty->gender }}</p>
            <p><strong>Address:</strong> {{ $faculty->address }}</p>
            <p><strong>Phone:</strong> {{ $faculty->phone }}</p>
            <p><strong>Email:</strong> {{ $faculty->email }}</p>
        </div>

        <div class="col-md-6">
            <h5>Academic Information</h5>
            <div class="title-line"></div>
            <p><strong>Faculty ID:</strong> {{ $faculty->faculty_id }}</p>
            <p><strong>Degree:</strong> {{ $faculty->degree }}</p>
            <p><strong>Specialization:</strong> {{ $faculty->specialization }}</p>
            <p><strong>University:</strong> {{ $faculty->university }}</p>
            <p><strong>Graduation Year:</strong> {{ $faculty->graduation_year }}</p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <h5>Employment Details</h5>
            <div class="title-line"></div>
            <p><strong>Employment Date:</strong> {{ \Carbon\Carbon::parse($faculty->employment_date)->format('m/d/Y') }}</p>
            <p><strong>Current Position:</strong> {{ $faculty->current_position }}</p>
            <p><strong>Department:</strong> {{ $faculty->department }}</p>
            <p><strong>Employment Type:</strong> {{ $faculty->employment_type }}</p>
        </div>

        <div class="col-md-6">
            <h5>Additional Information</h5>
            <div class="title-line"></div>
            <p><strong>Languages Spoken:</strong> {{ $faculty->language ?? 'N/A' }}</p>
            <p><strong>Certification:</strong> {{ $faculty->certification ?? 'N/A' }}</p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <h5>Professional Experience</h5>
            <div class="title-line"></div>
            <p><strong>Experience:</strong> {{ $faculty->experience ?? 'N/A' }}</p>
            <p><strong>Development Activities:</strong> {{ $faculty->development_activities ?? 'N/A' }}</p>
            <p><strong>Workshops:</strong> {{ $faculty->workshops ?? 'N/A' }}</p>
            <p><strong>Conferences:</strong> {{ $faculty->conferences ?? 'N/A' }}</p>
            <p><strong>Research:</strong> {{ $faculty->research ?? 'N/A' }}</p>
            <p><strong>Awards:</strong> {{ $faculty->awards ?? 'N/A' }}</p>
        </div>
    </div>
</div>
@endsection