@extends('layout.admin')

@section('title')
    Notifications
@endsection

@section('adminContent')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List of administrators</h3>
                </div>
                <div class="card-body">
                    <table id="facultyNotifDataTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Message</th>
                                <th>Create At</th>
                                <th>Read</th>
                                <th>Event</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notifs as $item)
                                <tr>
                                  <td>{{$item->message}}</td>
                                  <td>{{$item->created_at}}</td>
                                  <td>
                                    <span class="badge {{$item->isNew == "Y" ? "bg-red":"bg-secondary"}}">
                                        {{$item->isNew == "Y" ? "Unread":"Read"}}
                                    </span>
                                  </td>
                                  <td>{{$item->type}}</td>
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
            $('#facultyNotifDataTable').DataTable({
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