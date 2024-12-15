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
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($students as $item)
                              <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->lrn}}</td>
                                <td>
                                    <button type="button" data-toggle="modal" data-target="#addUserModal-{{$item->id}}" class="btn btn-sm btn-info">
                                        @if (isset($item->grade))
                                            Graded - <span style="font-weight: bold">({{$item->grade}})</span>
                                        @else
                                        Add Grade
                                        @endif
                                    </button>

                                    @if (isset($item->grade))
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteGradeModal-{{$item->id}}">Delete</button>
                                    @else
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteGradeModal-{{$item->id}}" disabled>Delete</button>
                                    @endif
                                   
                                </td>
                              </tr>


                              <div class="modal fade" id="deleteGradeModal-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteGradeModal-{{$item->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header p-1">
                                            <h5 class="modal-title" id="deleteGradeModal-{{$item->id}}">
                                                {{$item->name}}({{$item->lrn}})
                                            </h5>
                                            {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button> --}}
                                        </div>
                                        <div class="modal-body">
                                            Are you sure to delete grade for student  {{$item->name}}({{$item->lrn}})?
                                        </div>
                                        <div class="modal-footer p-1">
                                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                           <form action="{{route('update.grade', [
                                            'studentId' => $item->lrn
                                            ])}}" method="POST">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" name="actionType" value="del">
                                            <input type="hidden" name="section" value="{{$grade->id ?? ""}}">
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                           </form>                                        
                                        </div>
                                    </div>
                                </div>
                            </div>


                              <div class="modal fade" id="addUserModal-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel-{{$item->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header p-1">
                                            <h5 class="modal-title" id="addUserModalLabel-{{$item->id}}">
                                                {{$item->name}}({{$item->lrn}})
                                            </h5>
                                            {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button> --}}
                                        </div>
                                       <form action="{{route('update.grade', [
                                        'studentId' => $item->lrn
                                        ])}}" method="POST">
                                        @csrf
                                        @method('post')
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="enterGrade-{{$item->id}}">Enter or update grade</label>
                                                <input type="number" class="form-control" name="grade" id="enterGrade-{{$item->id}}" value="{{$item->grade ?? ""}}">
                                                
                                            </div>

                                            <input type="hidden" name="section" value="{{$grade->id ?? ""}}">

                                        </div>
                                        <div class="modal-footer p-1">
                                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-sm btn-info">Submit</button>
                                        </div>
                                       </form>
                                    </div>
                                </div>
                            </div>


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