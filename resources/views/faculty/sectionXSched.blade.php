@extends('layout.xtian.facultyLayout')

@section('title')
    Class Schedule management
@endsection

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List of Grades</h3>
                    <div class="card-tools">
                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#add-grade">
                            Add Grade
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="facultyClassDataTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Grade</th>
                                <th>Section</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($grades as $item)
                               <tr>
                                <td>{{$item->grade}}</td>
                               <td>{{$item->section}}</td>
                               <td>
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit-grade-{{$item->id}}">
                                    <li class="fa fa-edit"></li>
                                </button>

                                <a href="{{route('show.schedule', ['id' => $item->id])}}" class="btn btn-sm btn btn-primary">
                                    <li class="fa fa-pen"></li>
                                </a>

                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-grade-{{$item->id}}">
                                    <li class="fa fa-trash"></li>
                                </button>

                               

                              </td>
                               </tr>



                               <div>


                                <div class="modal fade" id="delete-grade-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Confim Delete</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                       <div class="modal-body">
                                        Are you sure to delete this ?
                                       </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary btn btn-sm" data-dismiss="modal">Cancel</button>
                                          <form action="{{route('delete.grade')}}" method="POST">
                                            @csrf
                                            @method("delete")
                                            <input type="hidden" value="{{$item->id}}" name="gradeId">
                                            <button type="submit" class="btn btn-danger  btn btn-sm">Delete</button>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              </div>


                                <form action="{{route('edit.grade', ['id' => $item->id])}}" method="POST">
                                    @csrf
                                    @method('put')
                                <div class="modal fade" id="edit-grade-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Update Grade and Section</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="grade{{$item->id}}" class="form-label">Select Grade</label>
                                                <select class="form-control" name="grade" id="grade{{$item->id}}">
                                                    <option value="7" {{$item->grade == "7" ? 'selected':""}}>Grade 7</option>
                                                    <option value="8 {{$item->grade == "8" ? 'selected':""}}">Grade 8</option>
                                                    <option value="9" {{$item->grade == "9" ? 'selected':""}}>Grade 9</option>
                                                    <option value="10" {{$item->grade == "10" ? 'selected':""}}>Grade 10</option>
                                                    <option value="11" {{$item->grade == "11" ? 'selected':""}}>Grade 11</option>
                                                    <option value="12" {{$item->grade == "12" ? 'selected':""}}>Grade 12</option>
                                                  </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="section{{$item->id}}" class="form-label">Enter section</label>
                                                <input type="text" class="form-control" id="section{{$item->id}}" name="section" value="{{$item->section}}">
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
                               </div>

                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <form action="{{route('add.grade')}}" method="POST">
        @csrf
        @method('post')
    <div class="modal fade" id="add-grade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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