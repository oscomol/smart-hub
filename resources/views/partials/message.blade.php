<!-- Success Message for Insertion -->
@if(session('insert_success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="font-size: 1.1rem; background-color: #d4edda; color: #155724;">
        <strong>Success!</strong> {{ session('insert_success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- Info Message for Update -->
@if(session('update_info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert" style="font-size: 1.1rem; background-color: #cce5ff; color: #004085;">
        <strong>Info:</strong> {{ session('update_info') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- Warning Message for Deletion -->
@if(session('delete_warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert" style="font-size: 1.1rem; background-color: #fff3cd; color: #856404;">
        <strong>Warning!</strong> {{ session('delete_warning') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- Error Message -->
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-size: 1.1rem; background-color: #f8d7da; color: #721c24;">
        <strong>Error!</strong> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
