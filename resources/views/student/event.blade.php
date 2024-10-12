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
                        <table id="eventDataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Start At</th>
                                    <th>End At</th>
                                    <th>IN</th>
                                    <th>OUT</th>
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
                                       @if (isset($item->timeInTime))
                                            <span class="badge bg-info">
                                                {{$item->timeInTime}}
                                            </span>
                                       @else
                                       <form action="{{route('event.in', ['id' => $item->id])}}" method="POST">
                                        @csrf
                                        @method('post')
                                        <input type="hidden" name="type" value="IN">
                                        <button type="submit" class="btn btn-sm btn btn-info" {{$item->starting == false ? 'disabled':''}}>Time In</button>
                                       </form>
                                       @endif
                                    </td>
                                    <td>
                                        @if (isset($item->timeOutTime))
                                            <span class="badge bg-info">
                                                {{$item->timeOutTime}}
                                            </span>
                                       @else
                                       <form action="{{route('event.in', ['id' => $item->id])}}" method="POST">
                                        @csrf
                                        @method('post')
                                        <input type="hidden" name="type" value="OUT">
                                        @if (isset($item->timeInTime))
                                        <button type="submit" class="btn btn-sm btn btn-info" {{$item->end == false ? 'disabled':''}}>OUT</button>
                                        @else
                                        <button type="submit" class="btn btn-sm btn btn-info" disabled>Time Out</button>
                                        @endif
                                       </form>
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
            $('#eventDataTable').DataTable({
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