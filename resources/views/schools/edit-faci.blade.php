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
                    <form action="{{ route('facilities.updateFacilities', $facility->id) }}" method="POST">
                        @csrf
                        @method('PUT') 
                        <div class="form-group">
                            <label for="name">Facility Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $facility->name) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="number">Total Number</label>
                            <input type="number" name="number" id="number" class="form-control" value="{{ old('number', $facility->number) }}" required> 
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" required>{{ old('description', $facility->description) }}</textarea>
                        </div>
                        <a href="{{route('facilities.index')}}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Facility</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
