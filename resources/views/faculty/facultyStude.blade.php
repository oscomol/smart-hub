@extends('layout.xtian.facultyLayout')

@section('title')
   Grade {{$grade->grade}} - {{$grade->section}}
@endsection


@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List of class</h3>
                </div>
                <div class="card-body">
                    <table id="facultyClassDataTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>LRN</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($students as $item)
                              <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->lrn}}</td>
                                <td>
                                    <button>
                                        Grade
                                    </button>
                                </td>
                              </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('script')
    <script type="module">
        $(function(){
            $('#facultyClassDataTable').DataTable({
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