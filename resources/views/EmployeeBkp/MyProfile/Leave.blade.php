<div class="card">
  

<div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>Employee</th>
                <th>Leave Date</th>
                <th>Duration</th>
                <th>Leave Status</th>
                <th>Leave Type</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="result">
              @if(count($Leave) > 0)
              @foreach($Leave as $key=> $user)
              <tr class="odd">
                  <td>{{ $key+1 }} </td>
                  <td>{{ $user->first_name }}</td>
                  <td>@if($user && $user->date) {{ $user->date }} @else {{ $user->start_date }} @endif </td>
                  <td>
                      @if($user->duration == 1)
                          {{ 'Full Day' }}
                      @elseif($user->duration == 2)
                          {{ 'Multiple' }}
                      @elseif($user->duration == 3)
                          {{ 'First Half' }}
                      @elseif($user->duration == 4)
                          {{ 'Second Half' }}
                      @endif
                  </td>
                  <td>
                   @switch($user->status)
                          @case('1')
                            <span class="badge bg-label-success">APPROVED</span>
                              @break
                          @case('2')
                            <span class="badge bg-label-danger">UNAPPROVED</span>
                              @break
                          @case('3')
                            <span class="badge bg-label-warning">PENDING</span>
                              @break
                          @default
                          @endswitch
                  </td>
                  <td>{{ $user->leave_type }}</td>
                  <td>
                    <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end" style="">
                            <li><a class="dropdown-item" href="{{url('admin/Leave/edit/'.$user->id)}}">Edit</a></li>
                            <li><button class="dropdown-item delete_debtcase" url="{{url('admin/Leave/delete/'.$user->id)}}" id="{{$user->id}}">Delete</button></li>
                          </ul>
                      </div>
                  </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td class="text-center" colspan="9">No Data Found</td>
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