@extends('layouts.admin')
@section('title', 'TimeSheet')
@section('content')

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
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">TimeSheet /</span> Home</h4>
    @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
  <!-- Users List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">TimeSheet's List</h5>
      </div>
      <div class="col-md-6 text-end">
         <a href="{{url('Employee/TimeSheet/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
           @if($RoleAccess[array_search('TimeSheet', array_column($RoleAccess, 'per_name'))]['add'] == 1)
          <a href="{{url('Employee/TimeSheet/add')}}" class="btn btn-primary mt-3 m-3">Add</a>
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
                  <label>Search: <input type="search" value="{{$searchTerm}}" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                </form>
              </div>
            </div>
          </div>
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>Task</th>
                <th>Employee</th>
                <th>Start time</th>
                <th>End time</th>
                <th>Total Hours</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if(count($TimeSheet) > 0)
             @foreach($TimeSheet as $key=> $user)
             @php $users =  \App\Models\User::whereIn('id', explode(',',$user->emp_id))->where('type',4)->get(); @endphp                      
              <tr class="odd">
                  <td>{{ $key+1 }} </td>
                  <td>{{ $user->taskname }}</td>
                  <td>
                    <ul class="list-unstyled m-0 d-flex align-items-center avatar-group my-3">
                      @foreach($users as $useraa)
                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" data-bs-original-title="{{$useraa->first_name}}">
                        <img class="rounded-circle" src="{{$useraa->profile_img}}" alt="Avatar">
                      </li>
                        @endforeach()
                    </ul>
                  </td>
                  <td>{{ $user->start_time }}</td>
                  <td>{{ $user->end_time }}</td>
                  <td>{{ $user->total_hours }}</td>
                  <td>
                     @if(in_array('TimeSheet', array_column($RoleAccess, 'per_name')))
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" style="">
                               
                                @if($RoleAccess[array_search('TimeSheet', array_column($RoleAccess, 'per_name'))]['update'] == 1)
                                    <li><a class="dropdown-item" href="{{url('Employee/TimeSheet/edit/'.$user->id)}}">Edit</a></li>
                                @endif
                                @if($RoleAccess[array_search('TimeSheet', array_column($RoleAccess, 'per_name'))]['delete'] == 1)
                                    <li><button class="dropdown-item delete_debtcase" url="{{url('Employee/TimeSheet/delete/'.$user->id)}}" id="{{$user->id}}">Delete</button></li>
                                @endif
                            </ul>
                        </div>
                    @endif
                   
                  </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td class="text-center" colspan="7">No Data Found</td>
              </tr>
              @endif
            </tbody>
        </table>
          <div class="p-1" style="float: right;">
              {{ $TimeSheet->links() }}
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