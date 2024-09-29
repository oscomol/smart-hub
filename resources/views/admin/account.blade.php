@extends('layout.admin')

@section('breadcrumbs')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Accounts</li>
    </ol>
</nav>
@endsection

@section('adminContent')
<div class="container mt-4">

    @include('partials.message')
    
    <h2>Accounts</h2>
    <p>Manage users account on this page.</p>
    <div class="title-line"></div>
    
    <!-- Button to Add User -->
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#registerUserModal">
        Add New User
    </button>
   
    
    <!-- Users Table -->
    <table id="users-table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>LRN(student)</th>
                <th>User Type</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->lrn }}</td>
                    <td>{{ $user->userType }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                    <td>
                        <button class="btn btn-warning edit-user" data-id="{{ $user->id }}">Edit</button>
                    <form action="{{ route('admin.account.delete', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                    </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- Add Modal -->
<div class="modal fade" id="registerUserModal" tabindex="-1" role="dialog" aria-labelledby="registerUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerUserModalLabel">Register New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="registerUserForm" action="{{ route('admin.account.register') }}" method="POST">

                    @csrf

                    <!-- Username Field -->
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" class="form-control" id="username" required>
                    </div>

                    <!-- LRN Field -->
                    <div class="form-group">
                        <label for="lrn">LRN (for Students only):</label>
                        <input type="text" name="lrn" class="form-control" id="lrn">
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                      <!-- Password Field -->
                      <div class="form-group">
                        <label for="password_confirmation">Confirm Password:</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                    </div>

                    <!-- User Type Field -->
                    <div class="form-group">
                        <label for="userType">User Type:</label>
                        <select name="userType" class="form-control" id="userType" required>
                            <option value="">Select User Type</option>
                            <option value="administrator">Admin</option>
                            <option value="staff">Staff</option>
                            <option value="faculty">Faculty</option>
                            <option value="student">Student</option>
                            <option value="parents">Parents</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Register User</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editUserForm" action="" method="POST">
                    @csrf
                    @method('POST')

                    <!-- Username Field -->
                    <div class="form-group">
                        <label for="edit_username">Username:</label>
                        <input type="text" name="username" class="form-control" id="edit_username" required>
                    </div>

                    <!-- LRN Field -->
                    <div class="form-group">
                        <label for="edit_lrn">LRN (for Students only):</label>
                        <input type="text" name="lrn" class="form-control" id="edit_lrn">
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="edit_password">Password:</label>
                        <input type="password" name="password" class="form-control" id="edit_password">
                    </div>
                    
                    <!-- Password Confirmation Field -->
                    <div class="form-group">
                        <label for="edit_password_confirmation">Confirm Password:</label>
                        <input type="password" name="password_confirmation" class="form-control" id="edit_password_confirmation">
                    </div>

                    <!-- User Type Field -->
                    <div class="form-group">
                        <label for="edit_userType">User Type:</label>
                        <select name="userType" class="form-control" id="edit_userType" required>
                            <option value="">Select User Type</option>
                            <option value="admin">Admin</option>
                            <option value="staff">Staff</option>
                            <option value="faculty">Faculty</option>
                            <option value="student">Student</option>
                            <option value="parents">Parents</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </div>

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
<!-- Include DataTables CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- DataTables Initialization -->
<script>
    $(document).ready(function() {
        $('#users-table').DataTable();
    });

    $(document).on('click', '.edit-user', function() {
        var userId = $(this).data('id');
        $.get('/admin/accounts/edit/' + userId, function(data) {
            $('#editUserForm').attr('action', '/admin/accounts/update/' + userId);
            $('#edit_username').val(data.username);
            $('#edit_lrn').val(data.lrn);
            $('#edit_userType').val(data.userType);
            $('#editUserModal').modal('show');
        });
    });
</script>
@endsection
