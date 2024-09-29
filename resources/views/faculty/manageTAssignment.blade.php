@extends('layout.xtian.facultyLayout')

@section('title')
    {{$faculty->name}}'s Qualifications
@endsection



@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List of administrators</h3>
                        <div class="card-tools">
                            <button class="btn btn-sm btn-primary" data-toggle="modal"
                            data-target="#add-assignment">
                                Add Qualification
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="facultyAssignmentDataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Teaching Assignment</th>
                                    <th>Date added</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assingments as $item)
                                    <tr>
                                        <td>{{$item->assignment}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>
                                        <button class="btn btn-sm btn btn-success" data-toggle="modal"
                                        data-target="#update-assignment-{{$item->id}}">
                                            <li class="fa fa-edit"></li>
                                        </button>
                                        <button class="btn btn-sm btn btn-danger"  data-toggle="modal"
                                        data-target="#delete-assignment-{{$item->id}}">
                                            <li class="fa fa-trash"></li>
                                        </button>
                                    </td>
                                    </tr>

                                    <div>


                                        <form action="{{ route('update.assignment', ['assignment_id' => $item->id]) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="modal fade" id="update-assignment-{{$item->id}}" tabindex="-1"
                                            role="dialog" aria-labelledby="modal-default-p-update" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modal-default-p-update">Update Qualification
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                
                                                        <div class="mb-3 mt-3">
                                                            <label for="assignment-{{$item->id}}" class="form-label">Qualification</label>
                                                            <input type="text" class="form-control" id="assignment-{{$item->id}}" name="assignment" value="{{$item->assignment}}">
                                                        </div>
                                
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success btn-sm">
                                                            Save
                                                        </button>
                                                        <button type="button" class="btn btn-secondary btn-sm"
                                                            data-dismiss="modal">
                                                            Cancel
                                                        </button>
                                                    </div>
                                
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                       


                                        <form action="{{ route('delete.assignment', ['assignment_id' => $item->id]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <div class="modal fade" id="delete-assignment-{{$item->id}}" tabindex="-1"
                                            role="dialog" aria-labelledby="modal-default-p-update" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modal-default-p-update">Delete Teaching Assignment
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure to delete this Teaching Assignment ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success btn-sm">
                                                            Continue
                                                        </button>
                                                        <button type="button" class="btn btn-secondary btn-sm"
                                                            data-dismiss="modal">
                                                            Cancel
                                                        </button>
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


        <form action="{{ route('add.assignment', ['faculty_id' => $faculty->id]) }}" method="post">
            @csrf
            @method('post')
            <div class="modal fade" id="add-assignment" tabindex="-1"
            role="dialog" aria-labelledby="modal-default-p-update" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-default-p-update">Add Assignment
                        </h5>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3 mt-3">
                            <label for="assignment" class="form-label">Assignment</label>
                            <input type="text" class="form-control" id="assignment" name="assignment">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-sm">
                            Save
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm"
                            data-dismiss="modal">
                            Cancel
                        </button>
                    </div>

                </div>
            </div>
        </div>
        </form>

@endsection



@section('script')
    <script type="module">
        $(function(){
            $('#facultyAssignmentDataTable').DataTable({
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