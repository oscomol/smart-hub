@extends('layout.admin')

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Student Records</li>
        </ol>
    </nav>
@endsection

@section('title')
    Student Management
@endsection

@section('adminContent')
<div class="container-fluid pt-3">
    @include('partials.message')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Student Records</h3>
                    <button type="button" class="btn btn-primary mb-3 float-right" data-toggle="modal" data-target="#addStudentModal">
                        Add New Student
                    </button>
                </div>
                <div class="card-body">
                    <table id="students-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>LRN</th>
                                <th>Student Name</th>
                                <th>Contact Number</th>
                                <th>Barangay</th>
                                <th>Municipality/City</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>{{ $student->lrn }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->contact_number }}</td>
                                    <td>{{ $student->barangay }}</td>
                                    <td>{{ $student->municipality }}</td>
                                    <td>
                                        <div class="dropdown show">
                                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Options
                                            </a>
                                    
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#" onclick="openEditModal({{ $student->id }}, '{{ $student->lrn }}', '{{ $student->name }}', '{{ $student->sex }}', '{{ $student->birth_date }}', '{{ $student->mother_tongue }}', '{{ $student->ip_ethnic_group }}', '{{ $student->religion }}', '{{ $student->barangay }}', '{{ $student->municipality }}', '{{ $student->contact_number }}', '{{ $student->learning_modality }}', '{{ $student->remarks }}', '{{ $student->father_name }}', '{{ $student->mother_name }}', '{{ $student->relationship }}')">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a class="dropdown-item" href="#" onclick="openDeleteModal({{ $student->id }})">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                                <a class="dropdown-item" href="{{ route('students.show', $student->id) }}">
                                                    <i class="fas fa-eye"></i> View Info
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
        </div>
    </div>
</div>
<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"> <!-- Use modal-lg for a wider modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudentModalLabel">Student's Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="studentInfoForm" action="{{ route('students.store') }}" method="POST">
                    @csrf
                
                    <!-- Student's Information -->
                    <h5>Student's Information</h5>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="lrn">LRN:</label>
                            <input type="text" name="lrn" class="form-control" id="lrn" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="sex">Sex:</label>
                            <select name="sex" class="form-control" id="sex" required>
                                <option value="">Select Sex</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="birth_date">Birth Date:</label>
                            <input type="date" name="birth_date" class="form-control" id="birth_date" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mother_tongue">Mother Tongue:</label>
                            <input type="text" name="mother_tongue" class="form-control" id="mother_tongue" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="ip_ethnic_group">IP (Ethnic Group):</label>
                            <input type="text" name="ip_ethnic_group" class="form-control" id="ip_ethnic_group" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="religion">Religion:</label>
                            <input type="text" name="religion" class="form-control" id="religion" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="barangay">Barangay:</label>
                            <input type="text" name="barangay" class="form-control" id="barangay" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="municipality">Municipality:</label>
                            <input type="text" name="municipality" class="form-control" id="municipality" required>
                        </div>
                    </div>
                    
                    <!-- Guardian Information -->
                    <h5>Guardian Information</h5>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="father_name">Father's Name:</label>
                            <input type="text" name="father_name" class="form-control" id="father_name" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mother_name">Mother's Name:</label>
                            <input type="text" name="mother_name" class="form-control" id="mother_name" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="relationship">Relationship:</label>
                            <input type="text" name="relationship" class="form-control" id="relationship" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="contact_number">Contact Number:</label>
                            <input type="text" name="contact_number" class="form-control" id="contact_number" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="learning_modality">Learning Modality:</label>
                            <input type="text" name="learning_modality" class="form-control" id="learning_modality" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="remarks">Remarks:</label>
                            <textarea name="remarks" class="form-control" id="remarks"></textarea>
                        </div>
                    </div>
                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Student Info</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
<!-- Edit Student Modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="editStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="editStudentInfoForm" action="{{ route('students.update', ':id') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="editStudentModalLabel">Edit Student's Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add fields similar to the create form -->
                    <input type="hidden" name="student_id" id="student_id">

                    <!-- Student's Information -->
                    <h5>Student's Information</h5>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="edit_lrn">LRN:</label>
                            <input type="text" name="lrn" class="form-control" id="edit_lrn" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="edit_name">Name:</label>
                            <input type="text" name="name" class="form-control" id="edit_name" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="edit_sex">Sex:</label>
                            <select name="sex" class="form-control" id="edit_sex" required>
                                <option value="">Select Sex</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="edit_birth_date">Birth Date:</label>
                            <input type="date" name="birth_date" class="form-control" id="edit_birth_date" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="edit_mother_tongue">Mother Tongue:</label>
                            <input type="text" name="mother_tongue" class="form-control" id="edit_mother_tongue" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="edit_ip_ethnic_group">IP (Ethnic Group):</label>
                            <input type="text" name="ip_ethnic_group" class="form-control" id="edit_ip_ethnic_group" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="edit_religion">Religion:</label>
                            <input type="text" name="religion" class="form-control" id="edit_religion" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="edit_barangay">Barangay:</label>
                            <input type="text" name="barangay" class="form-control" id="edit_barangay" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="edit_municipality">Municipality/City:</label>
                            <input type="text" name="municipality" class="form-control" id="edit_municipality" required>
                        </div>
                    </div>

                    <!-- Guardian Information -->
                    <h5>Guardian Information</h5>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="edit_father_name">Father's Name:</label>
                            <input type="text" name="father_name" class="form-control" id="edit_father_name" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="edit_mother_name">Mother's Name:</label>
                            <input type="text" name="mother_name" class="form-control" id="edit_mother_name" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="edit_relationship">Relationship:</label>
                            <input type="text" name="relationship" class="form-control" id="edit_relationship" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="edit_contact_number">Contact Number:</label>
                            <input type="text" name="contact_number" class="form-control" id="edit_contact_number" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="edit_learning_modality">Learning Modality:</label>
                            <input type="text" name="learning_modality" class="form-control" id="edit_learning_modality" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="edit_remarks">Remarks:</label>
                            <textarea name="remarks" class="form-control" id="edit_remarks"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Student Info</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteStudentModal" tabindex="-1" role="dialog" aria-labelledby="deleteStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="deleteStudentForm" action="{{ route('students.destroy', ':id') }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteStudentModalLabel">Delete Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this student?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- DataTables Initialization -->
<script>
    $(document).ready(function() {
        $('#students-table').DataTable();
    });

    function openEditModal(id, lrn, name, sex, birthDate, motherTongue, ipEthnicGroup, religion, barangay, municipality, contactNumber, learningModality, remarks, fatherName, motherName, relationship) {
    $('#student_id').val(id);
    $('#edit_lrn').val(lrn);
    $('#edit_name').val(name);
    $('#edit_sex').val(sex);
    $('#edit_birth_date').val(birthDate);
    $('#edit_mother_tongue').val(motherTongue);
    $('#edit_ip_ethnic_group').val(ipEthnicGroup);
    $('#edit_religion').val(religion);
    $('#edit_barangay').val(barangay);
    $('#edit_municipality').val(municipality);
    $('#edit_contact_number').val(contactNumber);
    $('#edit_learning_modality').val(learningModality);
    $('#edit_remarks').val(remarks);
    $('#edit_father_name').val(fatherName);
    $('#edit_mother_name').val(motherName);
    $('#edit_relationship').val(relationship);
    
    const updateUrl = '{{ route("students.update", ":id") }}'.replace(':id', id);
    $('#editStudentInfoForm').attr('action', updateUrl);
    
    $('#editStudentModal').modal('show'); 
}

function openDeleteModal(id) {
    const deleteUrl = '{{ route("students.destroy", ":id") }}'.replace(':id', id);
    $('#deleteStudentForm').attr('action', deleteUrl);
    $('#deleteStudentModal').modal('show'); 
}


</script>
@endsection
