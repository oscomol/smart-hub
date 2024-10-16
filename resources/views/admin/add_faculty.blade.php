@extends('layout.admin')

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.faculty') }}">Faculty Record</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add New Faculty</li>
        </ol>
    </nav>
@endsection
@section('title')
 Add New Faculty record
@endsection
@section('adminContent')
<div class="container-fluid">
    @include('partials.faculty_form')

</div>

@endsection
