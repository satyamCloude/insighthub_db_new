@extends('layouts.admin')
@section('title', 'Cloud Hosting')
@section('content')
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Cloud Hosting /</span> Home</h4>
    @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Cloud Hosting</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$Total}}</h3>
                            <!-- <p class="text-success mb-0">0</p> -->
                          </div>
                          <p class="mb-0">Total</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-primary">
                            <i class="menu-icon fa-solid fa-cloud m-0"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
    </div>
    <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Active</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$Active}}</h3>
                            <!-- <p class="text-success mb-0"></p> -->
                          </div>
                          <p class="mb-0">Total</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-success">
                            <i class="menu-icon fa-solid fa-cloud m-0"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
    </div>
    <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Suspended</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$Suspended}}</h3>
                            <!-- <p class="text-danger mb-0"></p> -->
                          </div>
                          <p class="mb-0">Total</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-warning">
                            <i class="menu-icon fa-solid fa-cloud m-0"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
    </div>
    <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Terminated</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$Terminated}}</h3>
                            <!-- <p class="text-success mb-0"></p> -->
                          </div>
                          <p class="mb-0">Total</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-danger">
                            <i class="menu-icon fa-solid fa-cloud m-0"></i>
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
          <h5 class="card-header">CloudHosting's List</h5>
      </div>
      <div class="col-md-6 text-end">
          <!--<a href="{{url('Employee/CloudHosting/EXPORTCSV')}}" class="btn btn-info mt-3 m-3"><i class="fa-solid fa-file-csv"></i></a>-->
          <a href="{{url('Employee/CloudHosting/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
          <!--<a href="{{url('Employee/CloudHosting/add')}}" class="btn btn-primary mt-3 m-3">Add</a>-->
      </div>
    </div>
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_length" id="DataTables_Table_3_length"><label>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
              <div id="DataTables_Table_3_filter" class="dataTables_filter">
                <form method="GET" action="">
                  <label>Search: <input value="{{$search}}" type="search" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                </form>
              </div>
            </div>
          </div>
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>Unique ID</th>
                <th>CUSTOMER NAME</th>
                <th>PRODUCTS</th>
                <th>SERVICE TYPE</th>
                <th>SIGN UP</th>
                <th>STATUS</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if(count($CloudHosting) > 0)
              @php $i=1;  @endphp
              @foreach($CloudHosting as $key=> $CloudHostings)
                   @php
                $isEmployeeIdNull = is_null($CloudHostings->employee_id);
                $isEmployeeIdMatch = !is_null($CloudHostings->employee_id) && in_array(Auth::user()->id, explode(',', $CloudHostings->employee_id));
            @endphp

            @if($isEmployeeIdNull || $isEmployeeIdMatch)
              <tr class="odd">
                  <td>{{ $i }} </td>
                <td>@if($CloudHostings && $CloudHostings->unique_service_id) {{ $CloudHostings->unique_service_id }} @endif</td>
                  <td>
                   <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{isset($CloudHostings->profile_img) ? $CloudHostings->profile_img : url('public/images/21104.png')}}" height="30" width="30" alt="User avatar" />{{$CloudHostings->first_name }}<div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$CloudHostings->email}}</div>
                          </td>
                  <td>@if($CloudHostings && $CloudHostings->product_name) {{ $CloudHostings->product_name }} @endif</td>
                  <td>@if($CloudHostings && $CloudHostings->service_type == '1') {{ 'MANAGED' }} @elseif($CloudHostings && $CloudHostings->service_type == '2') {{ 'UNMANAGED' }} @endif </td>
                  <td>@if($CloudHostings && $CloudHostings->signup_date) {{ $CloudHostings->signup_date }} @endif</td>
                   <td>
                   @switch($CloudHostings->status)
                          @case('1')
                            <button class="btn btn-success btn-sm">Active</button>
                              @break
                          @case('2')
                            <button class="btn btn-warning btn-sm">Suspended</button>
                              @break
                          @case('3')
                            <button class="btn btn-danger btn-sm">Terminated</button>
                              @break
                          @default
                                <span></span>
                          @endswitch
                  </td>
                  <td>

                    @if(in_array('CloudHosting', array_column($RoleAccess, 'per_name')))
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" style="">
                                @if($RoleAccess[array_search('CloudHosting', array_column($RoleAccess, 'per_name'))]['update'] == 1)
                                    <li><a class="dropdown-item" href="{{url('Employee/CloudHosting/edit/'.$CloudHostings->id)}}">Edit</a></li>
                                @endif
                                @if($RoleAccess[array_search('CloudHosting', array_column($RoleAccess, 'per_name'))]['delete'] == 1)
                                    <li><button class="dropdown-item delete_debtcase" url="{{url('Employee/CloudHosting/delete/'.$CloudHostings->id)}}" id="{{$CloudHostings->id}}">Delete</button></li>
                                @endif
                            </ul>
                        </div>
                    @endif
                  </td>
              </tr>
                                  @endif

              @endforeach
              @else
              <tr>
                <td class="text-center" colspan="8">No Data Found</td>
              </tr>
              @endif 
            </tbody>
        </table>
          <div class="p-1" style="float: right;">
              {{ $CloudHosting->links() }}
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