@extends('layout.admin')

@section('title')
    Announcement
@endsection

@section('adminContent')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List of Announcements</h3>
                        <div class="card-tools">
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#add-announcement">
                                Add Announcement
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="facultyAnnDataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Announcement</th>
                                    <th>Create At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($announcements as $item)
                                   <tr>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->announcement}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit-announcement-{{$item->id}}">
                                            <li class="fa fa-edit"></li>
                                        </button>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-announcement-{{$item->id}}">
                                            <li class="fa fa-trash"></li>
                                        </button>
                                    </td>
                                   </tr>

                                   <div>


                                    <form action="{{route('edit.announcement', ['id' => $item->id])}}" method="POST">
                                        @csrf
                                        @method('put')
                                    <div class="modal fade" id="edit-announcement-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Announcement Form</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="title{{$item->id}}" class="form-label">Announcement name</label>
                                                    <input type="text" class="form-control" id="title{{$item->id}}" name="title" value="{{$item->title}}">
                                                  </div>
                                                  <div class="mb-3">
                                                    <label for="announcement{{$item->id}}" class="form-label">Description</label>
                                                    <textarea class="form-control" id="announcement{{$item->id}}" name="announcement">
                                                        {{$item->announcement}}
                                                    </textarea>
                                                  </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary btn btn-sm" data-dismiss="modal">Close</button>
                                              <button type="submit" class="processing btn btn-primary  btn btn-sm">Save</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </form>


                                    <div class="modal fade" id="delete-announcement-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                              <form action="{{route('delete.announcement')}}" method="POST">
                                                @csrf
                                                @method("delete")
                                                <input type="hidden" value="{{$item->id}}" name="eventId">
                                                <button type="submit" class="processing btn btn-danger  btn btn-sm">Delete</button>
                                              </form>
                                            </div>
                                          </div>
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
    </div>

    <form action="{{route('add.announcement')}}" method="POST">
        @csrf
        @method('post')
    <div class="modal fade" id="add-announcement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Announcement Form</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="title" class="form-label">announcement name</label>
                    <input type="text" class="form-control" id="title" name="title">
                  </div>
                  <div class="mb-3">
                    <label for="announcement" class="form-label">Description</label>
                    <textarea class="form-control" id="announcement" name="announcement"></textarea>
                  </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn btn-sm" data-dismiss="modal">Close</button>
              <button type="submit" class="processing btn btn-primary  btn btn-sm">Save</button>
            </div>
          </div>
        </div>
      </div>
    </form>
@endsection

@section('script')
    <script type="module">
        $(function(){
            $('#facultyAnnDataTable').DataTable({
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