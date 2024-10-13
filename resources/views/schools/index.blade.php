@extends('layout.admin')

@section('title', 'School Information')

@section('adminContent')
<div class="container-fluid">
    @include('partials.message')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">School Information</h3>
                    <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addSchoolModal">Add School</button>
                </div>
                <div class="card-body">
                    <table id="infoTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Name of the School</th>
                                <th>Location</th>
                                <th>Type of School</th>
                                <th>Year Established</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schools as $school)
                                <tr>
                                    <td>{{ $school->name }}</td>
                                    <td>{{ $school->location }}</td>
                                    <td>{{ $school->type }}</td>
                                    <td>{{ $school->year_established }}</td>
                                    <td>
                                        <button class="btn btn-warning" 
                                                data-toggle="modal" 
                                                data-target="#editSchoolModal" 
                                                data-id="{{ $school->id }}" 
                                                data-name="{{ $school->name }}" 
                                                data-location="{{ $school->location }}" 
                                                data-type="{{ $school->type }}" 
                                                data-principal="{{ $school->principal_name }}" 
                                                data-year="{{ $school->year_established }}">
                                            Edit
                                        </button>
                                        <button class="btn btn-danger" 
                                                data-toggle="modal" 
                                                data-target="#deleteSchoolModal" 
                                                data-id="{{ $school->id }}">
                                            Delete
                                        </button>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Add School Modal --}}
<div class="modal fade" id="addSchoolModal" tabindex="-1" aria-labelledby="addSchoolModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSchoolModalLabel">Add School</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('schools.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="schoolName">Name of the School</label>
                        <input type="text" class="form-control" id="schoolName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="schoolLocation">Location</label>
                        <input type="text" class="form-control" id="schoolLocation" name="location" required>
                    </div>
                    <div class="form-group">
                        <label for="schoolType">Type of School</label>
                        <input type="text" class="form-control" id="schoolType" name="type" required>
                    </div>
                    <div class="form-group">
                        <label for="principalName">Principal's Name</label>
                        <input type="text" class="form-control" id="principalName" name="principal_name" required>
                    </div>
                    <div class="form-group">
                        <label for="yearEstablished">Year Established</label>
                        <input type="number" class="form-control" id="yearEstablished" name="year_established" required min="1900" max="{{ date('Y') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add School</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit School Modal -->
<div class="modal fade" id="editSchoolModal" tabindex="-1" aria-labelledby="editSchoolModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSchoolModalLabel">Edit School</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="editSchoolForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editSchoolName">Name of the School</label>
                        <input type="text" class="form-control" id="editSchoolName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="editSchoolLocation">Location</label>
                        <input type="text" class="form-control" id="editSchoolLocation" name="location" required>
                    </div>
                    <div class="form-group">
                        <label for="editSchoolType">Type of School</label>
                        <input type="text" class="form-control" id="editSchoolType" name="type" required>
                    </div>
                    <div class="form-group">
                        <label for="editPrincipalName">Principal's Name</label>
                        <input type="text" class="form-control" id="editPrincipalName" name="principal_name" required>
                    </div>
                    <div class="form-group">
                        <label for="editYearEstablished">Year Established</label>
                        <input type="number" class="form-control" id="editYearEstablished" name="year_established" required min="1900" max="{{ date('Y') }}">
                    </div>
                    <input type="hidden" id="editSchoolId" name="school_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update School</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Delete School Modal --}}
<div class="modal fade" id="deleteSchoolModal" tabindex="-1" aria-labelledby="deleteSchoolModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteSchoolModalLabel">Delete School</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="deleteSchoolForm">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Are you sure you want to delete this school?</p>
                    <input type="hidden" id="deleteSchoolId" name="school_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@section('script')
<script type="module">
    $(function() {
        $('#infoTable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        // Populate edit modal with data
        $('#editSchoolModal').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget);
        const id = button.data('id');
        const name = button.data('name');
        const location = button.data('location');
        const type = button.data('type');
        const principalName = button.data('principal');
        const year = button.data('year');

        const modal = $(this);
        modal.find('#editSchoolId').val(id);
        modal.find('#editSchoolName').val(name);
        modal.find('#editSchoolLocation').val(location);
        modal.find('#editSchoolType').val(type);
        modal.find('#editPrincipalName').val(principalName);
        modal.find('#editYearEstablished').val(year);
        
        const actionUrl = "{{ route('schools.update', 'school_id') }}".replace('school_id', id);
        modal.find('form').attr('action', actionUrl);
    });


        // Populate delete modal with school ID
        $('#deleteSchoolModal').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget);
        const id = button.data('id');
        const modal = $(this);
        modal.find('#deleteSchoolId').val(id);
        
        const actionUrl = "{{ route('schools.destroy', 'school_id') }}".replace('school_id', id);
        modal.find('form').attr('action', actionUrl);
    });

});
</script>
@endsection
