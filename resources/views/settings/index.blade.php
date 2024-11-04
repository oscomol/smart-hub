@extends(
    auth()->user()->userType === 'administrator' 
        ? 'layout.admin' 
        : (auth()->user()->userType === 'faculty' 
            ? 'layout.xtian.facultyLayout' 
            : (auth()->user()->userType === 'parents' 
                ? 'layout.parent' 
                : 'layout.xtian.studentLayout')
        )
)
@section(auth()->user()->userType === 'administrator' ? 'adminContent' : 'content')

@section('title')
    My Account
@endsection

<div class="container-fluid">
    @include('partials.message')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">My Account</h3>
                </div>
                <div class="card-body">
                    <table id="users-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ auth()->user()->username }}</td>
                                <td>{{ auth()->user()->created_at }}</td>
                                <td>{{ auth()->user()->updated_at }}</td>
                                <td>
                                    <button class="btn btn-warning edit-user" data-id="{{ auth()->user()->id }}">Edit</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Edit Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editUserForm" action="" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Username Field -->
                    <div class="form-group">
                        <label for="edit_username">Username:</label>
                        <input type="text" name="username" class="form-control" id="edit_username" value="{{ old('username', auth()->user()->username) }}" required>
                        @error('username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="edit_password">Password (Leave blank to keep current password):</label>
                        <input type="password" name="password" class="form-control" id="edit_password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Confirmation Field -->
                    <div class="form-group">
                        <label for="edit_password_confirmation">Confirm Password:</label>
                        <input type="password" name="password_confirmation" class="form-control" id="edit_password_confirmation">
                        @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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

@section('script')
<script type="module">
    $(document).ready(function() {
        $('#users-table').DataTable();

        @if ($errors->any())
         $('#editUserModal').modal('show');
        @endif
    });

    $(document).on('click', '.edit-user', function() {
        var userId = $(this).data('id');
        $('#editUserForm').attr('action', '/admin/updateAccount/' + userId);
        $('#edit_username').val('{{ auth()->user()->username }}'); 
        $('#editUserModal').modal('show');
    });
</script>
@endsection
