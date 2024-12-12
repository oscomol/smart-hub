@extends('layout.admin')

@section('title')
    Memo
@endsection

@section('adminContent')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List of Memos</h3>
                    {{-- <div class="card-tools">
                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#add-memo">
                            Add Memo
                        </button>
                    </div> --}}
                </div>
                <div class="card-body">
                    <table id="facultymemoDataTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Memo</th>
                                <th>Create At</th>
                                <th>Updated At</th>
                                {{-- <th>Status</th>
                                <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($memos as $item)
                          <tr>
                              <td>{{$item->memo}}</td>
                              <td>{{$item->created_at}}</td>
                              <td>{{$item->updated_at}}</td>
                              {{-- <td>
                                <span class="badge {{ $item->status == 'PENDING' ? 'bg-secondary' : ($item->status == 'APPROVED' ? 'bg-success' : 'bg-danger') }}">
                                    {{ $item->status == 'PENDING' ? 'Pending' : ($item->status == 'APPROVED' ? 'Approved' : 'Cancelled') }}
                                </span>                                
                              </td>
                              <td>
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit-memo-{{$item->id}}">
                                    <li class="fa fa-edit"></li>
                                </button>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-memo-{{$item->id}}">
                                    <li class="fa fa-trash"></li>
                                </button>
                              </td> --}}
                            </tr>

                            <div>

                                <div class="modal fade" id="delete-memo-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                          <form action="{{route('delete.memo')}}" method="POST">
                                            @csrf
                                            @method("delete")
                                            <input type="hidden" value="{{$item->id}}" name="memoId">
                                            <button type="submit" class="processing btn btn-danger  btn btn-sm">Delete</button>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              </div>


                              <!-- Edit Memo Modal -->
<div class="modal fade" id="edit-memo-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Memo</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form action="{{ route('edit.memo', ['id' => $item->id]) }}" method="POST">
              @csrf
              @method('put')
              <div class="modal-body">
                  <div class="mb-3">
                      <label for="memo-{{$item->id}}" class="form-label">Memorandum</label>
                      <textarea class="form-control" id="memo-{{$item->id}}" name="memo">{{ $item->memo }}</textarea>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                  <button type="submit" class="processing btn btn-primary btn-sm">Save</button>
              </div>
          </form>
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

{{-- <form action="{{route('add.memo')}}" method="POST">
    @csrf
    @method('post')
<div class="modal fade" id="add-memo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Memorandom Form</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="memo" class="form-label">Memorandom</label>
                <textarea class="form-control" id="memo" name="memo"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="processing btn btn-primary btn btn-sm">Save</button>
        </div>
      </div>
    </div>
  </div>
</form> --}}
@endsection

@section('script')
    <script type="module">
        $(function(){
            $('#facultymemoDataTable').DataTable({
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