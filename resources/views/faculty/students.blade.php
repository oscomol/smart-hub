@extends('layout.xtian.facultyLayout')

@section('title')
    Student management
@endsection


@section('content')
 <div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List of Students</h3>
        </div>
        <div class="card-body">
            <table id="facultyStudentDataTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>LRN</th>
                        <th>Grade and Section</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($students as $item)
                       <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->lrn}}</td>
                            <td>
                                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                    @if (isset($item->grade))
                                        Grade {{$item->grade->grade}} - {{$item->grade->section}}
                                    @else
                                        Select
                                    @endif
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" role="menu">

                                    <form action="{{route('update.enroll', ['id' => '0'])}}" method="post">
                                        @csrf
                                        @method('post')
                                        <input type="hidden" name="studentId" value="{{$item->lrn}}">
                                        <button type="submit" class="dropdown-item text-danger">
                                          Remove
                                        </button>
                                    </form>

                                    @foreach ($grades as $grade)
                                    <form action="{{route('update.enroll', ['id' => $grade->id])}}" method="post">
                                        @csrf
                                        @method('post')
                                        <input type="hidden" name="studentId" value="{{$item->lrn}}">
                                        <button type="submit" class="dropdown-item">
                                          Grade {{$grade->grade}} - {{$grade->section}}
                                        </button>
                                    </form>

                                    @endforeach
                                </div>
                            </td>
                       </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
 </div>
@endsection

@section('script')
    <script type="module">
        $(function(){
            $('#facultyStudentDataTable').DataTable({
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