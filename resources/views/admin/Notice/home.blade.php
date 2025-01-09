@extends('layouts.admin')
@section('title', 'Notice')
@section('content')
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

<style type="text/css">
  .actives {
    border: 0px solid #1ff11f;
    padding: 0px 1px 0px 17px;
    border-radius: 146px;
    background: #1ff11f;
  }

  .inactives {
    border: 0px solid red;
    padding: 0px 1px 0px 17px;
    border-radius: 146px;
    background: red;
  }

  .orangecose {
    border: 0px solid orange;
    padding: 0px 1px 0px 17px;
    border-radius: 146px;
    background: orange;
  }
</style>

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Notice</h4>
  @if(Session::has('success'))
  <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
  @endif
  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Total</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2">{{ $Total }}</h3>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-primary">
                <i class="ti ti-user ti-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Public</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2">{{ $Public }}</h3>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-danger">
                <i class="ti ti-user-plus ti-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Private</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2">{{ $Private }}</h3>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-success">
                <i class="ti ti-user-check ti-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Users List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
        <h5 class="card-header">Notice's List</h5>
      </div>
      <div class="col-md-6 text-end">
        <a href="{{ url('admin/Notice/showNotice') }}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
      </div>
    </div>
    <div class="card-datatable table-responsive">
      <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <div class="dataTables_length" id="DataTables_Table_3_length"></div>
          </div>
          <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
            <div id="DataTables_Table_3_filter" class="dataTables_filter">
              <form method="GET" action="">
                <label>Search: <input value="{{ $searchTerm }}" type="search" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
              </form>
            </div>
          </div>
        </div>
        <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
          <thead>
            <tr>
              <th>ID</th>
              <th>APPLIED DATE</th>
              <th>TILL DATE</th>
              <th>STATUS</th>
              <!-- <th>ACTION</th> -->
            </tr>
          </thead>
          <tbody>
            @if(count($Notice) > 0)
            @foreach($Notice as $key => $user)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $user->Applieddate ?? '' }}</td>
              <td>{{ $user->Tilldate ?? '' }}</td>
              <td>
                @switch($user->status)
                @case('1')
                <span class="badge bg-label-success">Public</span>
                @break
                @case('2')
                <span class="badge bg-label-danger">Private</span>
                @break
                @default
                <span></span>
                @endswitch
              </td>
            
            </tr>
            @endforeach
            @else
            <tr>
              <td class="text-center" colspan="8">No Data Found</td>
            </tr>
            @endif
          </tbody>
        </table>
        <div class="p-1" style="float: right;">
          {{ $Notice->links() }}
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function EditNotesSettings(id) {
  $.ajax({
    url: `{{ url('admin/Notice/edit/') }}/${id}`,
    method: 'GET',
    data: { id: id },
    success: function(response) {
      $('.bs-stepper-content').html(response);
    },
    error: function() {
      // Handle error if needed
    }
  });
}

$(document).ready(function() {
  $(".delete_debtcase").click(function(e) {
    var id = $(this).attr('id');
    var url = $(this).data('url');
    e.preventDefault();
    bootbox.confirm({
      message: "Are you sure?",
      buttons: {
        cancel: {
          label: '<i class="fa fa-times"></i> Cancel'
        },
        confirm: {
          label: '<i class="fa fa-check"></i> Delete'
        }
      },
      callback: function(result) {
        if (result) {
          window.location.href = url;
        }
      }
    });
  });
});
</script>
@endsection
