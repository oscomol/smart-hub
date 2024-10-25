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

@section('title')
    Faculty Details
@endsection

@section('adminContent')
<div class="container-fluid">
    <!-- Print Header Partial -->
    @include('partials.print_header')

    <div class="card">
        <div class="card-header">
             <!-- Print Button -->
             <button id="printButton" class="btn btn-primary mb-3" onclick="printStudentInfo()">Print</button>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h5 class="card-title">Personal Information</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Name:</strong>{{ $faculty->name }}</p>
                            <p><strong>Birth Date:</strong> {{ \Carbon\Carbon::parse($faculty->birth)->format('m/d/Y') }}</p>
                            <p><strong>Gender:</strong> {{ $faculty->gender }}</p>
                            <p><strong>Address:</strong> {{ $faculty->address }}</p>
                            <p><strong>Phone:</strong> {{ $faculty->phone }}</p>
                            <p><strong>Email:</strong> {{ $faculty->email }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h5 class="card-title">Academic Information</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Faculty ID:</strong> {{ $faculty->faculty_id }}</p>
                            <p><strong>Degree:</strong> {{ $faculty->degree }}</p>
                            <p><strong>Specialization:</strong> {{ $faculty->specialization }}</p>
                            <p><strong>University:</strong> {{ $faculty->university }}</p>
                            <p><strong>Graduation Year:</strong> {{ $faculty->graduation_year }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h5 class="card-title">Employment Details</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Employment Date:</strong> {{ \Carbon\Carbon::parse($faculty->employment_date)->format('m/d/Y') }}</p>
                            <p><strong>Current Position:</strong> {{ $faculty->current_position }}</p>
                            <p><strong>Department:</strong> {{ $faculty->department }}</p>
                            <p><strong>Employment Type:</strong> {{ $faculty->employment_type }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h5 class="card-title">Additional Information</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Languages Spoken:</strong> {{ $faculty->language ?? 'N/A' }}</p>
                            <p><strong>Certification:</strong> {{ $faculty->certification ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h5 class="card-title">Professional Experience</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Experience:</strong> {{ $faculty->experience ?? 'N/A' }}</p>
                            <p><strong>Development Activities:</strong> {{ $faculty->development_activities ?? 'N/A' }}</p>
                            <p><strong>Workshops:</strong> {{ $faculty->workshops ?? 'N/A' }}</p>
                            <p><strong>Conferences:</strong> {{ $faculty->conferences ?? 'N/A' }}</p>
                            <p><strong>Research:</strong> {{ $faculty->research ?? 'N/A' }}</p>
                            <p><strong>Awards:</strong> {{ $faculty->awards ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function printStudentInfo() {
        // Show the header and hide the buttons
        document.getElementById('printHeader').style.display = 'block';
        document.getElementById('printButton').style.display = 'none';
      
        // Trigger the print dialog
        window.print();
    
        // Restore the styles after printing
        document.getElementById('printHeader').style.display = 'none';
        document.getElementById('printButton').style.display = 'inline-block';
    }
</script>

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
