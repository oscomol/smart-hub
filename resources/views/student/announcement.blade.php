@extends('layout.xtian.studentLayout')


@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List of events</h3>
                    </div>
                    <div class="card-body">
                        <table id="announcmentDataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Announcement</th>
                                    <th>Description</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($announcements as $item)
                                    <tr>
                                        <td>{{$item->title}}</td>
                                        <td>
                                            @if (isset($item->previewAnn))
                                            {{$item->previewAnn}}
                                            @else
                                            {{$item->announcement}}
                                            @endif
                                        </td>
                                        <td>{{$item->created_at}}</td>
                                        <td>
                                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#view-announcement-{{$item->id}}">
                                                View
                                            </button>
                                        </td>
                                    </tr>

                                    <div>

                                        <div class="modal fade" id="view-announcement-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Announcement</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>{{$item->title}}</h5>
                                                    <p>{{$item->announcement}}</p>
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
            $('#announcmentDataTable').DataTable({
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