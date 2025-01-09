<div class="card">
  

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
                    <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end" style="">
                            <li><a class="dropdown-item" href="{{url('admin/TimeSheet/edit/'.$user->id)}}">Edit</a></li>
                            <li><button class="dropdown-item delete_debtcase" url="{{url('admin/TimeSheet/delete/'.$user->id)}}" id="{{$user->id}}">Delete</button></li>
                          </ul>
                      </div>
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