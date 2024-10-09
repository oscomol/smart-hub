@extends('layout.admin')

@section('adminContent')
<div class="container-fluid">
    @include('partials.message')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Add Administrative Procedures</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('procedures.storeProcedure')}}" method="POST">
                        @csrf
                        <div class="modal-body">
                            {{--  Administrative Procedures --}}
                            <fieldset>
                                <legend> School Schedules</legend>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="school_time">School Timings</label>
                                            <input type="text" class="form-control" id="school_time" name="school_time" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="office_hours">Office Hours</label>
                                            <input type="text" class="form-control" id="office_hours" name="office_hours" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            
                            {{-- Communication Channels --}}
                            <fieldset>
                                <legend>Communication Channels</legend>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fb">FaceBook </label>
                                            <input type="text" class="form-control" id="fb" name="fb" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>
                                    </div>
                                    
                                </div>
                            </fieldset>
                              {{-- Communication Channels --}}
                              <fieldset>
                                <legend>Additional Information</legend>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fee_structure">Fee Structure</label>
                                            <input type="text" class="form-control" id="fee_structure" name="fee_structure" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="meetings">Parent-Teacher Meetings</label>
                                            <input type="meetings" class="form-control" id="meetings" name="meetings" required>
                                        </div>
                                    </div>
                                    
                                </div>
                            </fieldset>
                        </div>
                        <div class="modal-footer">
                            <a href="{{route('procedures.index')}}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
