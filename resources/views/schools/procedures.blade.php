@extends('layout.admin')
@section('breadcrumbs')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Administrative Procedures</li>
    </ol>
</nav>
@endsection
@section('title', 'Administrative Procedures')
@section('adminContent')
<div class="container-fluid">
    @include('partials.message')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- Header -->
                <div class="card-header">
                    <h4 class="card-title">Manage Procedures</h4>
                    <a href="{{ route('procedures.createProcedure') }}" class="btn btn-primary float-right">Add</a>
                </div>

                <!-- Body -->
                <div class="card-body">
                    @if($procedures->isEmpty())
                        <p class="text-center">No administrative procedures available.</p>
                    @else
                        @foreach($procedures as $procedure)
                        <div class="card mb-4 border">
                            <div class="card-body">
                                <!-- School Schedules Information Section -->
                                <fieldset class="mb-3">
                                    <legend>School Schedules Information</legend>
                                    <div class="row">
                                        <div class="col-6 mb-4">
                                            <div class="border p-3 rounded">
                                                <h5 class="font-weight-bold">{{ $procedure->school_time }}</h5>
                                                <p>School Timings</p>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-4">
                                            <div class="border p-3 rounded">
                                                <h5 class="font-weight-bold">{{ $procedure->office_hours }}</h5>
                                                <p>Office Hours</p>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                
                                <!-- Communication Channels Section -->
                                <fieldset class="mb-3">
                                    <legend>Communication Channels</legend>
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <div class="border p-3 rounded">
                                                <h5 class="font-weight-bold">{{ $procedure->fb }}</h5>
                                                <p>Facebook</p>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <div class="border p-3 rounded">
                                                <h5 class="font-weight-bold">{{ $procedure->email }}</h5>
                                                <p>Email</p>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <!-- Additional Information Section -->
                                <fieldset class="mb-3">
                                    <legend>Additional Information</legend>
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <div class="border p-3 rounded">
                                                <h5 class="font-weight-bold">{{ $procedure->fee_structure }}</h5>
                                                <p>Fee Structure</p>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <div class="border p-3 rounded">
                                                <h5 class="font-weight-bold">{{ $procedure->meetings }}</h5>
                                                <p>Parent-Teacher Meetings</p>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <!-- Footer for actions -->
                            <div class="card-footer text-right">
                                <a href="{{ route('procedures.editProcedure', $procedure->id) }}" class="btn btn-warning btn-md">Edit</a>                        
                                <button class="btn btn-danger btn-md" 
                                    data-toggle="modal" 
                                    data-target="#deleteModal" 
                                    data-id="{{  $procedure->id }}">
                                    Delete
                                </button>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="" id="deleteForm">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this procedure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);  
        var procedureId = button.data('id');  
        var form = $(this).find('form');      
        form.attr('action', '/procedures/' + procedureId);  
    });
</script>
@endsection