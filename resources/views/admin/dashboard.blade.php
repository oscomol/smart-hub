@extends('layout.admin')

@section('breadcrumbs')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Home</li>
    </ol>
</nav>
@endsection

@section('adminContent')
    <div class="container">
        <h2>Welcome to the Dashboard</h2>
        <p>This is where you can see an overview of your application.</p>
    </div>
@endsection
