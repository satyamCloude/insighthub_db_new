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
                <th>Shift Name</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Working Hours</th>
                <th>Shift Assigned</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if(count($TimeShift) > 0)
             @foreach($TimeShift as $key=> $user)
                        @php
                            $users = \App\Models\User::select('users.first_name', 'users.profile_img')
                                ->leftJoin('employee_details', 'employee_details.user_id', '=', 'users.id')
                                ->where('employee_details.shift_id', $user->id)
                                ->get();
                        @endphp
                      
              <tr class="odd">
                  <td>{{ $key+1 }} </td>
                  <td>{{ $user->shift_name }}</td>
                  <td>{{ $user->StartTime }}</td>
                  <td>{{ $user->EndTime }}</td>
                  <td>{{ $user->working_hours }}</td>
                  <td>
                    <ul class="list-unstyled m-0 d-flex align-items-center avatar-group my-3">
                      @foreach($users as $useraa)
                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" data-bs-original-title="{{$useraa->first_name}}">
                        <img class="rounded-circle" src="{{$useraa->profile_img}}" alt="Avatar">
                      </li>
                        @endforeach()
                    </ul>
                  </td>
                  <td>
                    <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end" style="">
                            <li><a class="dropdown-item" href="{{url('Employee/TimeShift/edit/'.$user->id)}}">Edit</a></li>
                            <li><button class="dropdown-item delete_debtcase" url="{{url('Employee/TimeShift/delete/'.$user->id)}}" id="{{$user->id}}">Delete</button></li>
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