@extends('layout.admin')

@section('title', 'Student Info')

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.student') }}">Student Record</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $student->name }}</li>
        </ol>
    </nav>
@endsection

@section('adminContent')

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            
           <!-- Print Header Partial -->
           @include('partials.print_header')

            <h2 class="mb-0">{{ $student->name }}</h2>
        </div>
        <div class="card-body">
            <!-- Personal Info Section -->
            <h4>Personal Information</h4>
            <div class="row">
                <div class="col-md-4">
                    <p><strong>LRN:</strong> {{ $student->lrn }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Name:</strong> {{ $student->name }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Sex:</strong> {{ $student->sex }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <p><strong>Birth Date:</strong> {{ $student->birth_date }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Mother Tongue:</strong> {{ $student->mother_tongue }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>IP Ethnic Group:</strong> {{ $student->ip_ethnic_group }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <p><strong>Religion:</strong> {{ $student->religion }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Barangay:</strong> {{ $student->barangay }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Municipality:</strong> {{ $student->municipality }}</p>
                </div>
            </div>

            <!-- Guardian Info Section -->
            <h4>Guardian Information</h4>
            <div class="row">
                <div class="col-md-4">
                    <p><strong>Father's Name:</strong> {{ $student->guardian->father_name }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Mother's Name:</strong> {{ $student->guardian->mother_name }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Relationship:</strong> {{ $student->guardian->relationship }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <p><strong>Contact Number:</strong> {{ $student->contact_number }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Learning Modality:</strong> {{ $student->learning_modality }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Remarks:</strong> {{ $student->remarks }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button id="printButton" class="btn btn-primary" onclick="printStudentInfo()">Print</button>
            <button id="downloadExcel" class="btn btn-secondary" onclick="window.location.href='{{ route('student.export', $student->id) }}'">
                Download Excel
            </button>
        </div>
    </div>
</div>

<script>
function printStudentInfo() {
   
    document.getElementById('printHeader').style.display = 'block';
    document.getElementById('printButton').style.display = 'none';
    document.getElementById('downloadExcel').style.display = 'none';
    window.print();
    document.getElementById('printHeader').style.display = 'none';
    document.getElementById('printButton').style.display = 'inline-block';
    document.getElementById('downloadExcel').style.display = 'inline-block';
}
</script>

@endsection
