@extends('layout.admin')

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

            <h2 class="mb-0">Records for {{ $student->name }}</h2>
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
                    <p><strong>Municipality/City:</strong> {{ $student->municipality }}</p>
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

            <!-- Accordion for Academic, Medical, and Disciplinary Records -->
            <h4 class="mt-4">Additional Records</h4>
            <div class="accordion" id="recordsAccordion">
                
                <!-- Academic Records Section -->
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Academic Records
                            </button>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#recordsAccordion">
                        <div class="card-body">
                            
                            <!-- Display existing academic records -->
                            <h5 class="mt-4">Existing Academic Records</h5>
                            @if ($academicRecords->isEmpty())
                                <p>No academic records found.</p>
                            @else
                            <ul>
                                @foreach ($academicRecords as $record)
                                    <li>
                                        <strong>Preschool:</strong> {{ $record->preschool_name }} <br>
                                        <strong>Year Graduated:</strong> {{ $record->preschool_graduation }} <br>
                                        <strong>Awards:</strong> {{ $record->preschool_awards }} <br>
                                    </li>
                                    <li>
                                        <strong>Elementary:</strong> {{ $record->elementary_school }} <br>
                                        <strong>Year Graduated:</strong> {{ $record->elementary_graduation }} <br>
                                        <strong>Awards:</strong> {{ $record->elementary_awards }} <br>
                                    </li>
                                @endforeach
                            </ul>
                             @endif

                               <!-- Form to add academic records -->
                                 @include('partials.academic_form')
                        </div>
                    </div>
                </div>

                <!-- Medical Records Section -->
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Medical Records
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#recordsAccordion">
                        <div class="card-body">
                       
                            <!-- Display existing medical records -->
                            <h5 class="mt-4">Existing Medical Records</h5>
                            @if ($medicalRecords->isEmpty())
                            <p>No medical records found.</p>
                            @else
                                <ul>
                                    @foreach ($medicalRecords as $record)
                                        <li>
                                            <strong>Allergies:</strong> {{ $record->allergies }} <br>
                                            <strong>Medical Conditions:</strong> {{ $record->medical_conditions }} <br>
                                            <strong>Current Medication:</strong> {{ $record->current_medication }} <br>
                                            <strong>Physician Name:</strong> {{ $record->physician_name }} <br>
                                            <strong>Contact Number:</strong> {{ $record->contact_number }} <br>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                               <!-- Form to add medical records -->
                               @include('partials.medical_form')
                        </div>
                    </div>
                </div>

                <!-- Disciplinary Records Section -->
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Disciplinary Records
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#recordsAccordion">
                        <div class="card-body">

                            <!-- Display existing disciplinary records -->
                            <h5 class="mt-4">Existing Disciplinary Records</h5>
                            @if ($disciplinaryRecords->isEmpty())
                            <p>No disciplinary records found.</p>
                            @else
                                <ul>
                                    @foreach ($disciplinaryRecords as $record)
                                        <li>
                                            <strong>Incident Date:</strong> {{ $record->incident_date }} <br>
                                            <strong>Description:</strong> {{ $record->incident_description }} <br>
                                            <strong>Action Taken:</strong> {{ $record->action_taken }} <br>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                               <!-- Form to add disciplinary records -->
                               @include('partials.disciplinary_form')
                        </div>
                    </div>
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
    // Show the header and hide the buttons
    document.getElementById('printHeader').style.display = 'block';
    document.getElementById('printButton').style.display = 'none';
    document.getElementById('downloadExcel').style.display = 'none';
    
    // Hide the accordion
    var accordion = document.getElementById('recordsAccordion'); // Replace with your accordion ID or class
    if (accordion) {
        accordion.style.display = 'none'; // Hide the accordion
    }

    // Trigger the print dialog
    window.print();

    // Restore the styles after printing
    document.getElementById('printHeader').style.display = 'none';
    document.getElementById('printButton').style.display = 'inline-block';
    document.getElementById('downloadExcel').style.display = 'inline-block';

    // Show the accordion again
    if (accordion) {
        accordion.style.display = 'block'; // Restore the accordion
    }
}

</script>

@endsection
