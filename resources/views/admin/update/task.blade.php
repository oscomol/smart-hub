@extends('layout.admin')

@section('title')
    Events
@endsection

@section('adminContent')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List of Events</h3>
                        <div class="card-tools">
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#add-event">
                                Add Event
                            </button>
                        </div>
                </div>
                <div class="card-body">
                    <table id="taskDataTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Start At</th>
                                <th>End At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($events as $item)
                              <tr>
                                <td>{{$item->eventName}}</td>
                                <td>{{$item->eventDescription}}</td>
                                <td>{{$item->startAt}}</td>
                                <td>{{$item->endAt}}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit-event-{{$item->id}}">
                                        <li class="fa fa-edit"></li>
                                    </button>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-event-{{$item->id}}">
                                        <li class="fa fa-trash"></li>
                                    </button>
                                    {{-- <a href="{{route('attendance.event', ['id' => $item->id])}}" class="btn btn-sm btn btn-secondary">
                                      <li class="fa fa-arrow-circle-right"></li>
                                    </a> --}}
                                </td>
                              </tr>
                              <div>


                                <form action="{{ route('edit.event', ['id' => $item->id]) }}" method="POST">
                                    @csrf
                                    @method('put')
                                <div class="modal fade" id="edit-event-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Event Form</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="eventName{{$item->id}}" class="form-label">Event name</label>
                                                <input type="text" class="form-control" id="eventName{{$item->id}}" name="eventName" value="{{$item->eventName}}">
                                              </div>
                                              <div class="mb-3">
                                                <label for="startAt{{$item->id}}" class="form-label">Start At</label>
                                                <input type="datetime-local" class="form-control" id="startAt{{$item->id}}" name="startAt"  value="{{$item->startAt}}">
                                              </div>
                                              <div class="mb-3">
                                                <label for="endAt{{$item->id}}" class="form-label">End At</label>
                                                <input type="datetime-local" class="form-control" id="endAt{{$item->id}}" name="endAt"  value="{{$item->endAt}}">
                                              </div>
                                              <div class="mb-3">
                                                <label for="eventDescription{{$item->id}}" class="form-label">Description</label>
                                                <textarea class="form-control" id="eventDescription{{$item->id}}" rows="3" name="eventDescription">
                                                    {{$item->eventDescription}}
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


                                <div class="modal fade" id="delete-event-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                          <form action="{{route('delete.event')}}" method="POST">
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

    <form action="{{route('add.event')}}" method="POST">
        @csrf
        @method('post')
    <div class="modal fade" id="add-event" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Event Form</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="eventName" class="form-label">Event name</label>
                    <input type="text" class="form-control" id="eventName" name="eventName">
                  </div>
                  <div class="mb-3">
                    <label for="startAt" class="form-label">Start At</label>
                    <input type="datetime-local" class="form-control" id="startAt" name="startAt">
                  </div>
                  <div class="mb-3">
                    <label for="endAt" class="form-label">End At</label>
                    <input type="datetime-local" class="form-control" id="endAt" name="endAt">
                  </div>
                  <div class="mb-3">
                    <label for="eventDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="eventDescription" rows="3" name="eventDescription"></textarea>
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
            $('#taskDataTable').DataTable({
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