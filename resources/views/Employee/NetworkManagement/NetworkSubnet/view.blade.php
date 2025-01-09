@extends('layouts.admin')
@section('title', 'NetworkSubnet')
@section('content')
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">NetworkSubnet /{{$NetworkSubnet->network_subnet}} / </span> Home</h4>
    @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif

  <!-- NetworkSubnet List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">IP's List</h5>
      </div>
      <div class="col-md-6 text-end">
        <a href="{{url('Employee/NetworkSubnet/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
      </div>
    </div>
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>IP Address</th>
                <th>Customer Name</th>
                <th>Host Name</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="result">
              @if(count($IPAddress) > 0)
             @foreach($IPAddress as $key=> $user)
              <tr class="odd">
                  <td>{{ $key+1 }} </td>
                  <td>@if($user && $user->ip_address) {{ $user->ip_address }} @endif</td>
                  <td>
                    @if($user->first_name)
                    <img 
                            class="rounded-circle"
                            style="margin-right: 15px;margin-top: 10px;" 
                            @if($user && $user->profile_img)
                            src="{{$user->profile_img}}"
                            @else
                            src="https://i.pinimg.com/564x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg"
                            @endif
                            height="30"
                            width="30"
                            alt="User avatar" />{{$user->first_name }}<div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$user->email}}</div>
                            @endif
                          </td>

                  <td>@if($user && $user->hostname_id) {{ $user->hostname_id }} @endif</td>
                  <td>@if($user && $user->status == 1) <h6 class="btn btn-success waves-effect waves-float waves-light"> Free </h6> @elseif($user && $user->status == 2)<h6 class="btn btn-danger waves-effect waves-float waves-light"> Assigned </h6> @endif</td>
                  <td>
                    <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end" style="">
                            <li><a class="dropdown-item" href="{{url('Employee/IPAddress/edit/'.$user->id)}}">Edit</a></li>
                            <li><button class="dropdown-item delete_debtcase" url="{{url('Employee/IPAddress/delete/'.$user->id)}}" id="{{$user->id}}">Delete</button></li>
                          </ul>
                      </div>
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
              {{ $IPAddress->links() }}
          </div>
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