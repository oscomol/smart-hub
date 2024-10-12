@extends('layout.xtian.facultyLayout')

@section('title')
    {{$event->eventName}}
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Attendance</h3>
                    </div>
                    <div class="card-body">
                        <table id="eventAttDataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>LRN</th>
                                    <th>IN</th>
                                    <th>OUT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $item)
                                    <tr>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->lrn}}</td>
                                        <td>
                                            @if (isset($item->in))
                                               <span class="badge bg-info">{{$item->in}}</span>
                                            @else
                                                <span class="badge bg-danger">Empty</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($item->out))
                                               <span class="badge bg-info">{{$item->out}}</span>
                                            @else
                                                <span class="badge bg-danger">Empty</span>
                                            @endif
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
            $('#eventAttDataTable').DataTable({
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