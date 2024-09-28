@extends('layout.admin')

@section('breadcrumbs')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.faculty') }}">Faculty Records</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $faculty->name }}</li>
    </ol>
</nav>
@endsection

@section('adminContent')
<div class="container">
    <h2>{{ $faculty->name }}'s Details</h2>
    <p>This record belongs to the name above.</p>
     <div class="title-line"></div>

    <div class="row">
        <div class="col-md-6">
            <h5>Personal Information</h5>
            <div class="sub-title-line"></div>
            <p><strong>Birth Date:</strong> {{ \Carbon\Carbon::parse($faculty->birth)->format('m/d/Y') }}</p>
            <p><strong>Gender:</strong> {{ $faculty->gender }}</p>
            <p><strong>Address:</strong> {{ $faculty->address }}</p>
            <p><strong>Phone:</strong> {{ $faculty->phone }}</p>
            <p><strong>Email:</strong> {{ $faculty->email }}</p>
        </div>

        <div class="col-md-6">
            <h5>Academic Information</h5>
            <div class="sub-title-line"></div>
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
            <div class="sub-title-line"></div>
            <p><strong>Employment Date:</strong> {{ \Carbon\Carbon::parse($faculty->employment_date)->format('m/d/Y') }}</p>
            <p><strong>Current Position:</strong> {{ $faculty->current_position }}</p>
            <p><strong>Department:</strong> {{ $faculty->department }}</p>
            <p><strong>Employment Type:</strong> {{ $faculty->employment_type }}</p>
        </div>

        <div class="col-md-6">
            <h5>Additional Information</h5>
            <div class="sub-title-line"></div>
            <p><strong>Languages Spoken:</strong> {{ $faculty->language ?? 'N/A' }}</p>
            <p><strong>Certification:</strong> {{ $faculty->certification ?? 'N/A' }}</p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <h5>Professional Experience</h5>
            <div class="sub-title-line"></div>
            <p><strong>Experience:</strong> {{ $faculty->experience ?? 'N/A' }}</p>
            <p><strong>Development Activities:</strong> {{ $faculty->development_activities ?? 'N/A' }}</p>
            <p><strong>Workshops:</strong> {{ $faculty->workshops ?? 'N/A' }}</p>
            <p><strong>Conferences:</strong> {{ $faculty->conferences ?? 'N/A' }}</p>
            <p><strong>Research:</strong> {{ $faculty->research ?? 'N/A' }}</p>
            <p><strong>Awards:</strong> {{ $faculty->awards ?? 'N/A' }}</p>
        </div>
    </div>
</div>

<style>
    .sub-title-line {
        width: 30%; 
        height: 2px;
        background-color: #000; 
        margin-top: 5px;
        margin-bottom: 15px; 
        border-radius: 1px; 
    }
    .title-line {
        width: 100%; 
        height: 2px;
        background-color: #000; 
        margin-top: 5px;
        margin-bottom: 15px; 
        border-radius: 1px; 
    }
</style>
@endsection
