@extends('layout.admin')
@section('breadcrumbs')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">School Facilities Information</li>
    </ol>
</nav>
@endsection
@section('title', 'School Facilities')
@section('adminContent')
<div class="container-fluid">
    @include('partials.message')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">School Facilities Information</h2>
                    <a href="{{ route('facilities.create') }}" class="btn btn-primary btn-md float-right"> Add</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Number</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($facilities as $facility)
                            <tr data-id="{{ $facility->id }}" class="facility-row">
                                <td>{{ $facility->name }}</td>
                                <td>{{ $facility->number }}</td>
                                <td>{{ $facility->description }}</td>
                                <td>
                                    <a href="{{ route('facilities.editFacilities', $facility->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('facilities.destroyFacilities', $facility->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this facility?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
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
@endsection


