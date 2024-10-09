@extends('layout.admin')

@section('adminContent')
<div class="container-fluid">
    @include('partials.message')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Edit Facility</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('governance.update', $governance->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            {{-- Governance Council --}}
                            <fieldset>
                                <legend> Governance and Leadership</legend>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="chairman">Chairman: </label>
                                            <input type="text" class="form-control" id="chairman" name="chairman" value="{{ old('chairman', $governance->chairman) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="d_chairman">Elected Deputy Chairman: </label>
                                            <input type="text" class="form-control" id="d_chairman" name="d_chairman" value="{{ old('d_chairman', $governance->d_chairman) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="a_chairman">Appointed Deputy Chairman: </label>
                                            <input type="text" class="form-control" id="a_chairman" name="a_chairman" value="{{ old('a_chairman', $governance->a_chairman) }}" required>
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
                                            <input type="text" class="form-control" id="hod_science" name="hod_science" value="{{ old('hod_science', $governance->hod_science) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hod_mathematics">HOD Mathematics: </label>
                                            <input type="text" class="form-control" id="hod_mathematics" name="hod_mathematics" value="{{ old('hod_mathematics', $governance->hod_mathematics) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hod_english">HOD English: </label>
                                            <input type="text" class="form-control" id="hod_english" name="hod_english" value="{{ old('hod_english', $governance->hod_english) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hod_filipino">HOD Filipino: </label>
                                            <input type="text" class="form-control" id="hod_filipino" name="hod_filipino" value="{{ old('hod_filipino', $governance->hod_filipino) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hod_araling_panlipunan">HOD Araling Panlipunan: </label>
                                            <input type="text" class="form-control" id="hod_araling_panlipunan" name="hod_araling_panlipunan" value="{{ old('hod_araling_panlipunan', $governance->hod_araling_panlipunan) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hod_values_education">HOD Values Education: </label>
                                            <input type="text" class="form-control" id="hod_values_education" name="hod_values_education" value="{{ old('hod_values_education', $governance->hod_values_education) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hod_mapeh">HOD MAPEH: </label>
                                            <input type="text" class="form-control" id="hod_mapeh" name="hod_mapeh" value="{{ old('hod_mapeh', $governance->hod_mapeh) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hod_tle">HOD T.L.E: </label>
                                            <input type="text" class="form-control" id="hod_tle" name="hod_tle" value="{{ old('hod_tle', $governance->hod_tle) }}" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="modal-footer">
                            <a href="{{route('governance.index')}}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
