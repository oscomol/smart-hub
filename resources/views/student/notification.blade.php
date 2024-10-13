@extends('layout.xtian.studentLayout')

@section('title')
    Notification
@endsection


@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Notifications</h3>
                    </div>
                    <div class="card-body">
                        <table id="notifDataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Classification</th>
                                    <th>Announcement</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($notifData as $item)
                                  <tr class="{{$item->isNew ? 'bg-warning':''}}">
                                    <td>{{$item->type}}</td>
                                    <td>
                                        @if (isset($item->previewMessage))
                                            {{$item->previewMessage}}
                                        @else
                                            {{$item->message}}
                                        @endif
                                    </td>
                                    <td>{{$item->created_at}}</td>
                                    <td>
                                        <button class="btn btn-sm btn btn-info" data-toggle="modal" data-target="#view-notification-{{$item->id}}">View</button>
                                    </td>
                                  </tr>

                                  <div>

                                    <div class="modal fade" id="view-notification-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                                <h6>{{$item->type}}</h6>
                                                <p>{{$item->message}}</p>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary btn btn-sm" data-dismiss="modal">Close</button>
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
@endsection


@section('script')
    <script type="module">
        $(function(){
            $('#notifDataTable').DataTable({
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