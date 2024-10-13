@extends('layout.admin')

@section('adminContent')
<div class="container-fluid">
    @include('partials.message')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Add School Policy</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('policies.updatePolicies', $policy->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Include this line for PUT request -->
                        <div class="modal-body">
                            <fieldset>
                                <legend>School Policy</legend>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="attendance_policy">Attendance Policy</label>
                                            <input type="text" class="form-control" id="attendance_policy" name="attendance_policy" value="{{ old('attendance_policy', $policy->attendance_policy) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="disciplinary_policy">Disciplinary Policy</label>
                                            <input type="text" class="form-control" id="disciplinary_policy" name="disciplinary_policy" value="{{ old('disciplinary_policy', $policy->disciplinary_policy) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="examination_policy">Examination Policy</label>
                                            <input type="text" class="form-control" id="examination_policy" name="examination_policy" value="{{ old('examination_policy', $policy->examination_policy) }}" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('policies.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
