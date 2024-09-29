@extends('layout.xtian.facultyLayout')

@section('title')
    Faculties
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List of administrators</h3>
                    </div>
                    <div class="card-body">
                        <table id="facultyDataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>ID</th>
                                    <th>Position</th>
                                    <th>Department</th>
                                    <th>Employment Type</th>
                                    <th>Specialization</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($faculties as $faculty)
                                    <tr>
                                        <th>{{$faculty->name}}</th>
                                        <td>{{$faculty->faculty_id}}</td>
                                        <td>{{$faculty->current_position}}</td>
                                        <td>{{$faculty->department}}</td>
                                        <td>{{$faculty->employment_type}}</td>
                                        <td>{{$faculty->specialization}}</td>
                                        <td>
                                            <a href="{{url('/faculty', ["id" => $faculty->id])}}" class="btn btn-sm btn btn-success">View</a>
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

@section('script')
    <script type="module">
        $(function(){
            $('#facultyDataTable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
        })
    </script>
@endsection