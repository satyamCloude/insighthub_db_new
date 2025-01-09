@extends('layouts.admin')
@section('title', 'Buisness Address')
@section('content')
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Buisness Address /</span> Home</h4>
    @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif

  <!-- Users List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Buisness Address</h5>
      </div>
      <div class="col-md-6 text-end">
          <a href="{{url('admin/BuisnessAddress/add')}}" class="btn btn-primary mt-3 m-3">Add Buisness Address</a>
      </div>
    </div>
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_length" id="DataTables_Table_3_length"><label>
              </div>
            </div>
         
          </div>
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>Location</th>
                <th>Address</th>
                <th>Country</th>
                <th>Tax Name</th>
                <th>Default</th>
                <th>Action</th>
              </tr>
             </thead>
            <tbody>
              @if(count($CurrencySettings) > 0)
             @foreach($CurrencySettings as $key=> $user)
              <tr class="odd">
                  <td>{{ $key+1 }} </td>
                  <td>@if($user && $user->name) {{ $user->name }} @endif</td>
                  <td>@if($user && $user->prefix) {{ $user->prefix }} @endif</td>
                  <td>@if($user && $user->code) {{ $user->code }} @endif</td>
                  <td>@if($user && $user->exchange_rate) {{ $user->exchange_rate }} @endif</td>
                  <td>@if($user && $user->currency_format) {{ $user->currency_format }} @endif</td>
                 
                  <td>
                    <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end" style="">   
                            <li><a class="dropdown-item" href="{{url('admin/CurrencySettings/edit/'.$user->id)}}">Edit</a></li>
                            <li><button class="dropdown-item delete_debtcase" url="{{url('admin/CurrencySettings/delete/'.$user->id)}}" id="{{$user->id}}">Delete</button></li>
                          </ul>
                      </div>
                  </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td class="text-center" colspan="4">No Data Found</td>
              </tr>
              @endif             

            </tbody>
        </table>
          
        </div>
      </div>
    </div>
</div>



<script>
    $(document).ready(function () {

        $(".delete_debtcase").click(function (e) {
            var id = $(this).attr('id');
            var url = $(this).attr('url');
            e.preventDefault();
            bootbox.confirm({
                message: "Are you sure?",
                buttons: {
                    cancel: {
                        label: '<i class="fa fa-times"></i> Cancel'
                    },
                    confirm: {
                        label: '<i class="fa fa-check"></i> Delete'
                    },
                },
                callback: function (result) {
                    if (result) {
                        window.location.href = url;
                    }
                }
            });
        });
    });


</script>
@endsection