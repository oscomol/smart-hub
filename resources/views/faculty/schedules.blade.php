@extends('layout.xtian.facultyLayout')

@section('title')
    Class schedule management
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Grade {{ $grade->grade }} - {{ $grade->section }}</h3>
            </div>
            <div class="card-body">

                <table class="table table-bordered table-striped mb-3">
                    <thead>
                        <tr>
                            <th>Teacher</th>
                            <td>
                                @if (isset($instructor))
                                    {{$instructor->name}}
                                @else
                                NA
                                @endif
                            </td>
                            <th>
                                <div class="card-tools">
                                    <div class="btn-group hide">
                                        <button type="button" class="btn btn-tool dropdown-toggle"
                                            data-toggle="dropdown" aria-expanded="true">
                                            Select instructor
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right hide" role="menu"
                                            x-placement="bottom-end"
                                            style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-124px, 19px, 0px);">
                                            @foreach ($faculties as $item)
                                            <form action="{{route('update.instructor', ['id' => $curId])}}" method="post">
                                                @csrf
                                                @method('post')
                                                <input type="hidden" name="instructorId" value="{{$item->id}}">
                                                <button type="submit" class="dropdown-item">
                                                    {{$item->name}}
                                                </button>
                                            </form>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </thead>
                </table>

                <div class="row">
                    <div class="col-12 col-sm-4">
                       <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Student enrolled
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table id="classStudent" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>LRN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $item)
                                        <tr>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->lrn}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                       </div>
                    </div>
                    <div class="col-12 col-sm-8">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($days as $item)
                                    <tr>
                                        <td>
                                            @if (isset($item['day']))
                                                {{ $item['day'] }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($item['startAt']))
                                                {{ $item['startAt'] }}-{{ $item['endAt'] }}
                                            @else
                                                NA
                                            @endif
                                        </td>
                                        <td class="d-flex g-3">
                                            <button class="btn btn-info btn-sm mr-3" data-toggle="modal"
                                                data-target="#add-schedule-{{ $item['day'] }}">
                                                <li class="fa fa-edit"></li>
                                            </button>
        
                                            <form
                                                action="{{ route('delete.schedule', ['day' => $item['day'], 'id' => $curId]) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-danger" type="submit"
                                                    {{ $item['startAt'] ? '' : 'disabled' }}>
                                                    <li class="fa fa-trash"></li>
                                                </button>
                                            </form>
        
                                        </td>
                                    </tr>
        
                                    <div>
                                        <form action="{{ route('update.schedule') }}" method="POST">
                                            @csrf
                                            @method('post')
                                            <div class="modal fade" id="add-schedule-{{ $item['day'] }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                {{ $item['day'] }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="day"
                                                                value="{{ $item['day'] }}">
                                                            <input type="hidden" name="gradeId"
                                                                value="{{ $curId }}">
                                                            <div class="mb-3">
                                                                <label for="startAt" class="form-label">From</label>
                                                                <input type="time" class="form-control" id="startAt"
                                                                    name="startAt" value="{{ $item['startAt'] ?? '' }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="endAt" class="form-label">To</label>
                                                                <input type="time" class="form-control" id="endAt"
                                                                    name="endAt" value="{{ $item['endAt'] ?? '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn btn-sm"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit"
                                                                class="btn btn-primary  btn btn-sm">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


                
            </div>
        </div>
    </div>

    <form action="{{ route('add.grade') }}" method="POST">
        @csrf
        @method('post')
        <div class="modal fade" id="add-grade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Grade and Section</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="memo" class="form-label">Select Grade</label>
                            <select class="form-control" name="grade">
                                <option value="7">Grade 7</option>
                                <option value="8">Grade 8</option>
                                <option value="9">Grade 9</option>
                                <option value="10">Grade 10</option>
                                <option value="11">Grade 11</option>
                                <option value="12">Grade 12</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="section" class="form-label">Enter section</label>
                            <input type="text" class="form-control" id="section" name="section">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary  btn btn-sm">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection


@section('script')
    <script type="module">
        $(function() {
            $('#classStudent').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
        })
        $(function() {
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
