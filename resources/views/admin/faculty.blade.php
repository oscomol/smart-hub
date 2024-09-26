@extends('layout.admin')

@section('breadcrumbs')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Faculty Records</li>
    </ol>
</nav>
@endsection

@section('adminContent')
<div class="container">
 
    @include('partials.message')
    <h2>Faculty Records</h2>
    <p>Manage faculty records on this page.</p>
    <hr>

   <!-- Button to Add record -->
    <a href="{{ route('admin.create') }}" class="btn btn-primary mb-3">
        Add New Faculty
    </a>


    <div class="table-responsive">
        <table id="facultyTable" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Birth Date</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Faculty ID</th>
                    <th>Degree</th>
                    <th>Specialization</th>
                    <th>University</th>
                    <th>Graduation Year</th>
                    <th>Employment Date</th>
                    <th>Current Position</th>
                    <th>Department</th>
                    <th>Employment Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($faculties as $faculty)
                <tr>
                    <td>{{ $faculty->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($faculty->birth)->format('m/d/Y') }}</td>
                    <td>{{ $faculty->gender }}</td>
                    <td>{{ $faculty->address }}</td>
                    <td>{{ $faculty->phone }}</td>
                    <td>{{ $faculty->email }}</td>
                    <td>{{ $faculty->faculty_id }}</td>
                    <td>{{ $faculty->degree }}</td>
                    <td>{{ $faculty->specialization }}</td>
                    <td>{{ $faculty->university }}</td>
                    <td>{{ $faculty->graduation_year }}</td>
                    <td>{{ \Carbon\Carbon::parse($faculty->employment_date)->format('m/d/Y') }}</td>
                    <td>{{ $faculty->current_position }}</td>
                    <td>{{ $faculty->department }}</td>
                    <td>{{ $faculty->employment_type }}</td>
                    <td>
                        <a href="{{ route('admin.faculty.details', $faculty->id) }}" class="btn btn-primary btn-sm">View Details</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- DataTables CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#facultyTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "lengthChange": true,
            "pageLength": 10,
        });
    });
</script>
@endsection
