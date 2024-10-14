@extends('layout.admin')

@section('breadcrumbs')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Chat System</li>
    </ol>
</nav>
@endsection

@section('title')
    Chat System
@endsection

@section('adminContent')
<div class="container-fluid">
    @include('partials.message')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Collaboration Tools</h3>
                </div>
                <div class="card-body">
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

