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
    @include('partials.print_header')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">School Facilities Information</h2>
                    <button id="printButton" class="btn btn-primary mb-3 float-right" onclick="printFaci()">Print</button>
                    <a href="{{ route('facilities.create') }}" id="addButton" class="btn btn-primary btn-md float-right mr-3">Add</a>
                </div>                
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Number</th>
                                <th>Description</th>
                                <th class="actions-column">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($facilities as $facility)
                            <tr data-id="{{ $facility->id }}" class="facility-row">
                                <td>{{ $facility->name }}</td>
                                <td>{{ $facility->number }}</td>
                                <td>{{ $facility->description }}</td>
                                <td class="actions-column">
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
<script>
    function printFaci() {
        // Show the header and hide the buttons and action columns
        document.getElementById('printHeader').style.display = 'block';
        document.getElementById('printButton').style.display = 'none';
        document.getElementById('addButton').style.display = 'none';

        // Hide all elements with the actions-column class
        document.querySelectorAll('.actions-column').forEach(element => {
            element.style.display = 'none';
        });

        // Trigger the print dialog
        window.print();

        // Restore the styles after printing
        document.getElementById('printHeader').style.display = 'none';
        document.getElementById('printButton').style.display = 'inline-block';
        document.getElementById('addButton').style.display = 'inline-block';

        // Show the action columns again
        document.querySelectorAll('.actions-column').forEach(element => {
            element.style.display = 'table-cell';
        });
    }
</script>


@endsection


