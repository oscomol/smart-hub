@extends('layout.admin')
@section('breadcrumbs')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Policies</li>
    </ol>
</nav>
@endsection
@section('title', 'Policies')
@section('adminContent')
<div class="container-fluid">
    @include('partials.message')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- Header -->
                <div class="card-header">
                    <h4 class="card-title">Manage Policy</h4>
                    <a href="{{ route('policies.createPolicies') }}" class="btn btn-primary float-right">Add</a>
                </div>

                <!-- Body -->
                <div class="card-body">
                    @if($policies->isEmpty())
                        <p class="text-center">No policy added yet.</p>
                    @else
                        @foreach($policies as $policy)
                        <div class="card mb-4 border">
                            <div class="card-body">
                           
                                <fieldset class="mb-3">
                                    <legend>School Policy</legend>
                                    <div class="row">
                                        <div class="col-6 mb-4">
                                            <div class="border p-3 rounded">
                                                <h5 class="font-weight-bold">{{$policy->attendance_policy}}</h5>
                                                <p>Attendance Policy</p>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-4">
                                            <div class="border p-3 rounded">
                                                <h5 class="font-weight-bold">{{$policy->disciplinary_policy}}</h5>
                                                <p>	Disciplinary Policy</p>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-4">
                                            <div class="border p-3 rounded">
                                                <h5 class="font-weight-bold">{{$policy->examination_policy}}</h5>
                                                <p>	Examination Policy</p>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                           <!-- Footer for actions -->
                            <div class="card-footer text-right">
                                <a href="{{ route('policies.editPolicies', $policy->id) }}" class="btn btn-warning btn-md">Edit</a>                        
                                <button class="btn btn-danger btn-md" 
                                    data-toggle="modal" 
                                    data-target="#deleteModal" 
                                    data-id="{{ $policy->id }}">
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
        var policyId = button.data('id');  
        var form = $(this).find('form');      
        form.attr('action', '{{ url("policies") }}/' + policyId);  
    });
</script>
@endsection
