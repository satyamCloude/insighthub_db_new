<div class="card">
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <div class="row">
            <div class="col-sm-12 col-md-4">
              <div class="dataTables_length" id="DataTables_Table_3_length"><label>
                                 <select name="months" class="form-select" id="months">
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>



                <select name="year" class="form-select" id="year">  </select>
              </div>
            </div>
            
                <div class="col-sm-12 col-md-4 d-flex justify-content-center" style="align-self:center;">
                      
                      <!--  <form>-->
                      <!--    <div class="input-group input-daterange" id="bs-datepicker-daterange">-->
                      <!--    <input type="date" id="dateRangePicker" placeholder="MM/DD/YYYY" class="form-control fromDate" name="from" value="{{request()->get('from')}}" >-->
                      <!--    <span class="input-group-text">to</span>-->
                      <!--    <input type="date" placeholder="MM/DD/YYYY" class="form-control toDate" name="to" value="{{request()->get('to')}}">-->
                      <!--    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>-->
                      <!--</div>-->
                      <!--  </form>-->
                    </div>
            <div class="col-sm-12 col-md-4 d-flex justify-content-center justify-content-md-end">
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
                <!--<th>Employee</th>-->
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
                  <!--<td>-->
                  <!--       @if($user->profile_img)-->

                  <!--                                   <img -->
                  <!--          class="rounded-circle"-->
                  <!--          style="margin-right: 15px;margin-top: 10px;" -->
                  <!--          src="{{$user->profile_img}}"-->
                  <!--          height="30"-->
                  <!--          width="30"-->
                  <!--          alt="User avatar" />-->
                  <!--                                  @else-->

                  <!--                                  <img class="rounded-circle"-->

                  <!--                                  style="margin-right: 15px;margin-top: 10px;" -->

                  <!--                                  src="{{url('public/images/21104.png')}}"-->

                  <!--                                  height="30"-->

                  <!--                                  width="30"-->

                  <!--                                  alt="User avatar" />-->

                  <!--                                  @endif-->
                  <!--      {{$user->first_name }}<div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$user->email}}</div>-->
                    
                  <!--        </td>-->
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
                      @if($user && ($user->status == 3))
                             <select name="Status" class="form-select" onchange="LeaveStatusUpdate(this.value,{{$user->emp_Id}},{{$user->id}},{{$user->RoleID}},{{Auth::user()->id}},{{$AuthRoles}})">
                                <option @if($user && $user->status == 1) selected @endif value="1">APPROVED</option>
                                <option @if($user && $user->status == 2) selected @endif value="2">UNAPPROVED</option>
                                <option @if($user && $user->status == 3) selected @endif value="3">PENDING</option>
                              </select> 
                        @else
                               @switch($user->status)
                                @case('2')
                                    <span class="badge bg-label-danger">UNAPPROVED</span>
                                    @break
                                @case('1')
                                    <span class="badge bg-label-success">APPROVED</span>
                                    @break
                                @default
                                   <span class="badge bg-label-warning">Pending</span>
                            @endswitch
                        @endif
                  
                  </td>
                     <td>{{ $user->leave_type }}</td>
                  <td>
                    <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end" style="">
                            <li><a class="dropdown-item" href="{{url('admin/Leave/edit/'.$user->id)}}">Edit</a></li>
                             <li><a class="dropdown-item" href="{{url('admin/Leave/view/'.$user->id)}}">View</a></li>
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
              {{ $Leave->links() }}
          </div>
        </div>
      </div>      </div>
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
      $(document).ready(function () {
        var currentYear = new Date().getFullYear();
        var startYear = 2015;
        var $selectYear = $('#year');
        var $selectMonth = $('#months');

        // Populate the select elements with options
        for (var year = currentYear; year >= startYear; year--) {
            $selectYear.append($('<option>', {
                value: year,
                text: year
            }));
        }

        // Handle the change event of the select elements
        $selectYear.on('change', fetchData);
        $selectMonth.on('change', fetchData);
        
                
         function fetchData() {
                var selectedYear = $('#year').val();
                var selectedMonth = $('#months').val();
                var id = {{ $id }}; // Assuming $id is passed correctly in blade
                // Make an AJAX request to fetch data based on the selected year and month
                $.ajax({
                    url: "{{ url('admin/Leave/Show_leaves_yeardata_single') }}",
                    method: 'GET',
                    data: { year: selectedYear, id: id, month: selectedMonth },
                    success: function (data) {
                        console.log(data); // Log the response for debugging
                        $('#result').empty(); // Clear previous content
        
                        if (data.length > 0) {
                            $('#result').html(data);
                        } else {
                            $('#result').html('<tr><td colspan="8" class="text-center"><span>No Data Found</span></td></tr>');
                        }
                    },
                    error: function () {
                        $('#result').html('<tr><td colspan="8" class="text-center"><span>Error fetching data.</span></td></tr>');
                    }
                });
            }
         // Donut Chart
  // --------------------------------------------------------------------

      });
function LeaveStatusUpdate(status, empId, LeaveId, RoleID, ApproveID, AuthRole) {
    $.ajax({
        url: "{{ url('admin/Leave/LeaveStatusUpdate') }}",
        method: 'POST', // Assuming you want to send data with POST request
        data: {
            _token: '{{ csrf_token() }}', // Include the CSRF token
            status: status,
            statusnew: status,
            empId: empId,
            LeaveId: LeaveId,
            RoleID: RoleID,
            ApproveID: ApproveID,
            AuthRole: AuthRole,
        },
        success: function (response) {
            if (response.success == true) {
                $('#ResMsg').show().html(response.message);
                
                   setTimeout(function() {
        window.location.reload();
    }, 400);
                // Hide #ResMsg after 3 seconds
                setTimeout(function () {
                    $('#ResMsg').hide(500);
                }, 600);
                
            }
        },
        error: function () {
            alert("Oops! Some technical error occurred.");
        }
    });
}


</script>