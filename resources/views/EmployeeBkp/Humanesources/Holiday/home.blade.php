@extends('layouts.admin')
@section('title', 'Holiday')
@section('content')
@section('content')
@php 
$id = Auth::user()->id;

$RoleAccess = \App\Models\RoleAccess::select('role_accesses.add','role_accesses.view','role_accesses.update','role_accesses.delete','permissions.name as per_name')
                        ->leftjoin('employee_details','employee_details.admin_type_id','role_accesses.role_id')
                        ->leftjoin('permissions','permissions.id','role_accesses.permission_id')
                        ->where('employee_details.user_id',$id)
                        ->where('role_accesses.view','!=',null)
                        ->orWhere('role_accesses.add','!=',null)
                        ->orWhere('role_accesses.update','!=',null)
                        ->orWhere('role_accesses.delete','!=',null)
                        ->get()
                        ->toArray();
@endphp
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

<style type="text/css">
  .actives{
    border: 0px solid #1ff11f;
    padding: 0px 1px 0px 17px;
    border-radius: 146px;
    background: #1ff11f;
    }

  .inactives{
    border: 0px solid red;
    padding: 0px 1px 0px 17px;
    border-radius: 146px;
    background: red;
    }
    .orangecose{
    border: 0px solid orange;
    padding: 0px 1px 0px 17px;
    border-radius: 146px;
    background: orange;
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Holiday /</span> Home</h4>
    @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
  <!-- Users List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Holiday's List</h5>
      </div>
      <div class="col-md-6 text-end">
        <a href="{{url('Employee/Holiday/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
          @if($RoleAccess[array_search('Holiday', array_column($RoleAccess, 'per_name'))]['add'] == 1)
          <a href="{{url('Employee/Holiday/add')}}" class="btn btn-primary mt-3 m-3">Add</a>
          @endif
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
                  <label>Search: <input value="{{$searchTerm}}" type="search" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                </form>
              </div>
            </div>
          </div>
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>Date</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if(count($Holiday) > 0)
             @foreach($Holiday as $key=> $user)
              <tr class="odd">
                  <td>{{ $key+1 }} </td>
                  <td>{{ $user->date }}</td>
                  <td>{{ $user->description }}</td>
                  <td>
                     @if(in_array('Holiday', array_column($RoleAccess, 'per_name')))
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" style="">
                            
                                @if($RoleAccess[array_search('Holiday', array_column($RoleAccess, 'per_name'))]['update'] == 1)
                                    <li><a class="dropdown-item" href="{{url('Employee/Holiday/edit/'.$user->id)}}">Edit</a></li>
                                @endif
                                @if($RoleAccess[array_search('Holiday', array_column($RoleAccess, 'per_name'))]['delete'] == 1)
                                    <li><button class="dropdown-item delete_debtcase" url="{{url('Employee/Holiday/delete/'.$user->id)}}" id="{{$user->id}}">Delete</button></li>
                                @endif
                            </ul>
                        </div>
                    @endif

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
          <div class="p-1" style="float: right;">
              {{ $Holiday->links() }}
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