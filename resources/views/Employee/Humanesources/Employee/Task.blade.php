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
                <th>Timer</th>
                <th>Task</th>
                <th>Completed On</th>
                <th>Start Date</th>
                <th>Due Date</th>
                <th>Hours Logged</th>
                <th>Assigned To</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if(count($Task) > 0)
              @foreach($Task as $key=> $Inventor)
              <tr class="odd">
                  <td>{{ $key+1 }} </td>
                  <td id="strtTimer"></td>
                  <td>@if($Inventor && $Inventor->task_name) {{ $Inventor->task_name }} @endif</td>
                <td>
                    @if($Inventor && $Inventor->completed_on)
                        {{ \Carbon\Carbon::parse($Inventor->completed_on)->isToday() ? 'Today' : (\Carbon\Carbon::parse($Inventor->completed_on)->isYesterday() ? 'Yesterday' : $Inventor->completed_on) }}
                    @else
                        --
                    @endif
                </td>
                  <td>@if($Inventor && $Inventor->startDate) {{ $Inventor->startDate }} @endif</td>
                  <td>@if($Inventor && $Inventor->endDate) {{ $Inventor->endDate }} @endif</td>
                  <td>0s</td>
                 <!--  <td >
                    <div class="progchange{{$Inventor->id}}">
                    </div>
                    <div class="hide{{$Inventor->id}}">
                      
                   
                    <div class="progress cursor-pointer" onclick="changepro(this)" id="{{$Inventor->id}}">@switch($Inventor->status_id)
                          @case('1')
                      <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width:{{$Inventor->status_pro}}%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">{{$Inventor->status_pro}}%</div>
                              @break
                          @case('2')
                           <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width:{{$Inventor->status_pro}}%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">{{$Inventor->status_pro}}%</div>
                              @break
                          @case('3')
                          <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" style="width:{{$Inventor->status_pro}}%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">{{$Inventor->status_pro}}%</div>
                              @break
                          @case('4')
                           <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width:{{$Inventor->status_pro}}%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">{{$Inventor->status_pro}}%</div>
                              @break
                          @default
                                <span></span>
                          @endswitch
                    </div>
                    </div>
                  </td> -->
                  <!-- <td><div class="avatar me-2"><img data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-dark" data-bs-original-title="@if($Inventor && $Inventor->project_manager_name) {{ $Inventor->project_manager_name }} @endif" @if($Inventor && $Inventor->project_manager_picture) src="{{ $Inventor->project_manager_picture }}" @endif  alt="Avatar" class="rounded-circle" ></div></td> -->
                  <td>
                    <ul class="list-unstyled m-0 d-flex align-items-center avatar-group my-3">
                      
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" data-bs-original-title="{{$Inventor->project_manager_name}}">
                          <img class="rounded-circle" src="{{$Inventor->project_manager_picture}}" alt="Avatar">
                        </li>
                    </ul>
                  </td>
                          <td >
                            <div class="statuschange{{$Inventor->id}}"></div>
                            <div class="statushide{{$Inventor->id}}">
                            @switch($Inventor->status_id)
                          @case('1')
                            <span onclick="changestatus(this)" id="{{$Inventor->id}}" class="badge bg-label-primary">In Progress</span>
                              @break
                          @case('2')
                            <span onclick="changestatus(this)" id="{{$Inventor->id}}" class="badge bg-label-success">Completed</span>
                              @break
                          @case('3')
                            <span onclick="changestatus(this)" id="{{$Inventor->id}}" class="badge bg-label-warning">Over Due</span>
                              @break
                          @case('4')
                            <span onclick="changestatus(this)" id="{{$Inventor->id}}" class="badge bg-label-danger">Cancel</span>
                              @break
                          @default
                                <span></span>
                          @endswitch
                          </div>
                        </td>
                          <td>
                    <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end" style="">
                            <li><a class="dropdown-item" href="{{url('Employee/Task/edit/'.$Inventor->id)}}">Edit</a></li>
                            <li><button class="dropdown-item delete_debtcase" url="{{url('Employee/Task/delete/'.$Inventor->id)}}" id="{{$Inventor->id}}">Delete</button></li>
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
          </div>
        </div>
      </div>
</div>
<script type="text/javascript">
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