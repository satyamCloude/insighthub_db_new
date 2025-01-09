@extends('layouts.admin')
@section('title', 'Task')
@section('content')
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Task /</span> Home</h4>
    @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>InProgress</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$InProgress}}</h3>
                            <!-- <p class="text-success mb-0">0</p> -->
                          </div>
                          <p class="mb-0">Total</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-primary">
                            <i class="fa-solid fa-diagram-project"></i>
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
                          <span>Completed</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$Completed}}</h3>
                            <!-- <p class="text-success mb-0"></p> -->
                          </div>
                          <p class="mb-0">Total</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-success">
                            <i class="fa-solid fa-diagram-project"></i>
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
                          <span>OverDue</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$OverDue}}</h3>
                            <!-- <p class="text-danger mb-0"></p> -->
                          </div>
                          <p class="mb-0">Total</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-warning">
                            <i class="fa-solid fa-diagram-project"></i>
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
                          <span>Cancel</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$Cancel}}</h3>
                            <!-- <p class="text-success mb-0"></p> -->
                          </div>
                          <p class="mb-0">Total</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-danger">
                            <i class="fa-solid fa-diagram-project"></i>
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
          <h5 class="card-header">Task's List</h5>
      </div>
      <div class="col-md-6 text-end">
         <a href="{{url('Employee/Task/EXPORTCSV')}}" class="btn btn-info mt-3 m-3"><i class="fa-solid fa-file-csv"></i></a>
          <a href="{{url('Employee/Task/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
          @if($RoleAccess[array_search('Task', array_column($RoleAccess, 'per_name'))]['add'] == 1)
          <a href="{{url('Employee/Task/add')}}" class="btn btn-primary mt-3 m-3">Add</a>
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
                  <label>Search: <input type="search" value="{{$search}}" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                </form>
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
                             @if(in_array('Task', array_column($RoleAccess, 'per_name')))
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" style="">
                                @if($RoleAccess[array_search('Task', array_column($RoleAccess, 'per_name'))]['update'] == 1)
                                    <li><a class="dropdown-item" href="{{url('Employee/Task/edit/'.$Inventor->id)}}">Edit</a></li>
                                @endif
                                @if($RoleAccess[array_search('Task', array_column($RoleAccess, 'per_name'))]['delete'] == 1)
                                    <li><button class="dropdown-item delete_debtcase" url="{{url('Employee/Task/delete/'.$Inventor->id)}}" id="{{$Inventor->id}}">Delete</button></li>
                                @endif
                            </ul>
                        </div>
                    @endif
                    
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
              {{ $Task->links() }}
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




// function strtTimer() {
//     var selectedProject = $('#projectSelect').val();
//     var selectedTask = $('#taskSelect').val();
//     var memo = $('#memo').val();

//     if (selectedProject && selectedTask) {
//         $.ajax({
//             url: "{{ url('Employee/Task/StartTimer') }}",
//             method: 'GET',
//             data: {
//                 project_id: selectedProject,
//                 task_id: selectedTask,
//                 memo: memo,
//             },
//             success: function (resp) {
//                 console.log(resp.data.start_time);
//                 $('#mymodal').modal('hide');
//                 $('#task_time_strt').show();

//                 // Start countdown timer
//                 startCountdown();

//                 // Update the active-timer span with the start time
//                 updateTimer(0);

//                 $('#strtTimer').html('<i class="fas fa-play"></i>');
//             },
//             error: function (xhr, status, error) {
//                 // Show error in modal or perform other error handling
//             }
//         });
//     }
// }

// function startCountdown() {
//     var startTime = new Date().getTime();

//     setInterval(function () {
//         // Calculate elapsed time in milliseconds
//         var elapsedTime = new Date().getTime() - startTime;

//         // Update the timer element
//         updateTimer(elapsedTime);
//     }, 1000);
// }

// function updateTimer(elapsedTime) {
//     // Convert elapsed time to HH:mm:ss format
//     var hours = pad(Math.floor(elapsedTime / (60 * 60 * 1000)));
//     var minutes = pad(Math.floor((elapsedTime % (60 * 60 * 1000)) / (60 * 1000)));
//     var seconds = pad(Math.floor((elapsedTime % (60 * 1000)) / 1000));

//     var formattedTime = hours + ':' + minutes + ':' + seconds;

//     // Update the timer element
//     $('#active-timer2').text(formattedTime);
// }

// function pad(number) {
//     return number < 10 ? '0' + number : number;
// }


function changepro(id) {
  var id = id.id;
  var status = "progress";
$('.progchange'+id).html('<select onchange="updatepro(\''+status+'\', value, '+id+')" class="form-select" name="status_pro">'+
                     '<option value="10">Select %</option>'+
                     '<option value="10">10 %</option>'+
                     '<option value="20">20 %</option>'+
                     '<option value="30">30 %</option>'+
                     '<option value="40">40 %</option>'+
                     '<option value="50">50 %</option>'+
                     '<option value="60">60 %</option>'+
                     '<option value="70">70 %</option>'+
                     '<option value="80">80 %</option>'+
                     '<option value="90">90 %</option>'+
                     '<option value="100">100 %</option>'+
                 '</select>');
  $('.hide'+id).html('');
}

function changestatus(id) {
  var id = id.id;
  var status = "stu";
  $('.statuschange'+id).html('<select onchange="updatepro(\''+status+'\', value, '+id+')" class="form-select" name="status_id">'+
                         '<option value="1">Select satuts</option>'+
                         '<option value="1">In Progress</option>'+
                         '<option value="2">Completed</option>'+
                         '<option value="3">Over Due</option>'+
                         '<option value="4">Cancel</option>'+
                      '</select>');
  $('.statushide'+id).html('');
}

function updatepro(status,value,id){
  $.ajax({
        url: "{{ url('Employee/Task/UpdateStatus') }}",
        method: 'GET',
        data: { id: id,
                status_pro: value, 
                status : status
              },
        success: function () {
           location.reload();
        },
        error: function () {
           
        }
    });



}

</script>
@endsection