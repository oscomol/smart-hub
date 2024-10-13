@extends('layout.admin')
@section('breadcrumbs')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Governance and Leadership</li>
    </ol>
</nav>
@endsection
@section('title', 'Governance and Leadership')

@section('adminContent')
<div class="container-fluid">
    @include('partials.message')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- Header -->
                <div class="card-header">
                    <h4 class="card-title text-center">Governance Structure</h4>
                    <button class="btn btn-primary float-right" data-toggle="modal" data-target="#add">Add</button>
                </div>

                <!-- Body -->
                <div class="card-body">
                    @foreach($governances as $governance)
                    <div class="card mb-4 border">
                        <div class="card-body">
                            <!-- Chairman Section -->
                            <div class="row text-center">
                                <div class="col-12 mb-4">
                                    <div class="border p-3" style="border-radius: 8px;">
                                        <h5 class="font-weight-bold">{{  $governance->chairman }}</h5>
                                        <p>Chairman</p>
                                    </div>
                                </div>

                                <!-- Deputy Chairmen -->
                                <div class="col-6 mb-3">
                                    <div class="border p-3" style="border-radius: 8px;">
                                        <h5 class="font-weight-bold">{{  $governance->d_chairman }}</h5>
                                        <p>Elected Deputy Chairman</p>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="border p-3" style="border-radius: 8px;">
                                        <h5 class="font-weight-bold">{{  $governance->a_chairman }}</h5>
                                        <p>Appointed Deputy Chairman</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Heads of Departments (HODs) Section -->
                            <div class="row">
                                <div class="col-12 text-center mb-4">
                                    <h5 class="font-weight-bold p-2">Heads of Departments (HODs)</h5>
                                </div>

                                <!-- HOD cards -->
                                @php
                                    $hods = [
                                        ['name' => 'Science', 'value' =>  $governance->hod_science],
                                        ['name' => 'Mathematics', 'value' =>  $governance->hod_mathematics],
                                        ['name' => 'English', 'value' =>  $governance->hod_english],
                                        ['name' => 'Filipino', 'value' =>  $governance->hod_filipino],
                                        ['name' => 'Araling Panlipunan', 'value' =>  $governance->hod_araling_panlipunan],
                                        ['name' => 'Values Education', 'value' =>  $governance->hod_values_education],
                                        ['name' => 'MAPEH', 'value' =>  $governance->hod_mapeh],
                                        ['name' => 'T.L.E.', 'value' =>  $governance->hod_tle]
                                    ];
                                @endphp

                                @foreach($hods as $hod)
                                <div class="col-md-4 mb-3">
                                    <div class="border p-3" style="border-radius: 8px;">
                                        <h5 class="font-weight-bold">{{ $hod['value'] }}</h5>
                                        <p>HOD {{ $hod['name'] }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Footer for actions -->
                        <div class="card-footer text-right">
                            <a href="{{ route('governance.edit', $governance->id) }}" class="btn btn-warning btn-md">Edit</a>                        
                            <button class="btn btn-danger btn-md" 
                                data-toggle="modal" 
                                data-target="#deleteModal" 
                                data-id="{{  $governance->id }}">
                                Delete
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Add  Governance and Leadership Modal --}}
<div class="modal fade" id="add" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLabel">Add  Governance and Leadership</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('governance.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    {{--  Governance Council --}}
                    <fieldset>
                        <legend> Governance Council</legend>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="chairman">Chairman: </label>
                                    <input type="text" class="form-control" id="chairman" name="chairman" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="d_chairman">Elected Deputy Chairman: </label>
                                    <input type="text" class="form-control" id="d_chairman" name="d_chairman" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="a_chairman">Appointed Deputy Chairman: </label>
                                    <input type="text" class="form-control" id="a_chairman" name="a_chairman" required>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    
                    {{-- Heads of Departments (HODs) --}}
                    <fieldset>
                        <legend>Heads of Departments (HODs)</legend>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hod_science">HOD Science: </label>
                                    <input type="text" class="form-control" id="hod_science" name="hod_science" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hod_mathematics">HOD Mathematics: </label>
                                    <input type="text" class="form-control" id="hod_mathematics" name="hod_mathematics" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hod_english">HOD English: </label>
                                    <input type="text" class="form-control" id="hod_english" name="hod_english" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hod_filipino">HOD Filipino: </label>
                                    <input type="text" class="form-control" id="hod_filipino" name="hod_filipino" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hod_araling_panlipunan">HOD Araling Panlipunan: </label>
                                    <input type="text" class="form-control" id="hod_araling_panlipunan" name="hod_araling_panlipunan" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hod_values_education">HOD Values Education: </label>
                                    <input type="text" class="form-control" id="hod_values_education" name="hod_values_education" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hod_mapeh">HOD MAPEH: </label>
                                    <input type="text" class="form-control" id="hod_mapeh" name="hod_mapeh" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hod_tle">HOD T.L.E: </label>
                                    <input type="text" class="form-control" id="hod_tle" name="hod_tle" required>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteLabel">Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Are you sure you want to delete this record?</p>
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


@section('scripts')
<script type="module">
    $(document).ready(function() {
       
    // Delete Confirmation Modal
    $('#deleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var modal = $(this);
        var id = button.data('id');
        modal.find('#deleteForm').attr('action', '/governance/' + id);
    });
});
</script>
@endsection
