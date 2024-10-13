@extends('layout.xtian.studentLayout')

@section('title')
    Class Schedule
@endsection

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            @if ($gradeSection !== "")
                            {{$gradeSection}}
                            @else
                                Not Enrolled
                            @endif
                        </h3>
                        <div class="card-tools">
                           @if (isset($days[0]['instructor']))
                           <span class="badge bg-info">
                            Instructor: {{$days[0]['instructor']}}
                           </span>
                           @else
                               No Instructor
                           @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="classSchedDataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>Start time</th>
                                    <th>End time</th>
                                    <th>Instructor</th>
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
                                                {{ $item['startAt'] }}
                                            @else
                                                NA
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($item['endAt']))
                                                {{ $item['endAt'] }}
                                            @else
                                                NA
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($item['instructor']))
                                            {{ $item['instructor'] }}
                                        @else
                                            NA
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
        const title = "{{ $title }}";
       
            $('#classSchedDataTable').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": false,
                "autoWidth": false,
                "responsive": true,
                "dom": 'Bfrtip',
                "buttons": [
                    {
                        extend: 'print',
                        text: 'Print',
                        title: "Class Schedule",
                        autoPrint: true,
                        className: 'btn-sm float-end' 
                    }
                ]
            });
        });
    </script>
@endsection


<style>
  
.dt-buttons .btn-sm {
    font-size: 0.875rem; 
    padding: 0.25rem 0.5rem;
}

.float-end {
    float: right;
}

</style>