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
    <div class="title-line"></div>

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

                        <div class="dropdown show">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </a>
                        
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('admin.faculty.details', $faculty->id) }}">
                                    <i class="fas fa-eye"></i> View Details
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.faculty.edit', $faculty->id) }}">
                                    <i class="fas fa-edit"></i> Edit Faculty
                                </a>
                                <a class="dropdown-item" href="#" onclick="openDeleteModal({{ $faculty->id }})">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </div>
                        </div>
                        
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this faculty member?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .title-line {
        width: 100%; 
        height: 2px;
        background-color: #000; 
        margin-top: 5px;
        margin-bottom: 15px; 
        border-radius: 1px; 
    }
</style>

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
            "order": [[2, 'desc']] 
        });
    });
    function openDeleteModal(id) {

    document.getElementById('deleteForm').action = '/admin/faculty/' + id; 


    $('#deleteModal').modal('show');
}

</script>

@endsection
