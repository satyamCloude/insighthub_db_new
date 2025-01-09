<div class="col-sm-12 col-md-3">
    <div class="d-flex justify-content-center" >
        <select name="months" class="form-select " id="leadType">
            <option value="All">All</option>
            <option value="Call">Call</option>
            <option value="Email">Email</option>
        </select>&nbsp;&nbsp;&nbsp;&nbsp;
        <select name="filter" class="form-select " id="filter" >
            <option value="">Select</option>
            <option value="today">Today</option>
            <option value="tomorrow">Tomorrow</option>
            <option value="month">This Month</option>
        </select>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <select name="statusFilter" class="form-select " id="statusFilter" >
            <option value="">Select</option>
            <option value="0">Pending</option>
            <option value="1">Completed</option>
            <option value="2">Due</option>
        </select>
    </div>
</div>
                
<table class="table table-hover bg-white rounded" id="result">
    <thead class="">
      <tr>
        <th>ID</th>
        <th>Lead's ID</th>
        <th>Next Follow Up</th>
        <th>Type</th>
        <!-- <th>Client Name</th>-->
        <!--<th>Phone Number</th>-->
        <th>Requirement</th>
        <th>Note</th>
        <th>Follow Up By</th>
        <th>Status</th>
        <th>Created At</th>
        <th class="text-right">Action</th>
      </tr>
    </thead>
       <tbody>
        <tr class="group">
          <td colspan="10" style="background-color:#dbdade">Today</td>
        </tr>
                @if(count($today) > 0)
              @foreach($today as $Followup)
               @php 
               $leadStatus = DB::table('lead_statuses')->where('id',$Followup->leads_status)->first(); 
               $followUpBy = DB::table('users')->where('id',$Followup->follow_up_by)->first();  @endphp
        
              <tr>
                <td>{{$Followup->id}}</td>         
                <td><a href="{{url('Employee/Leads/view/'.$Followup->leads_id)}}">{{$Followup->leads_id}}</a></td>         
                <td>
                    @php
                    if($Followup->status == 0){
                        $color = 'black';
                    }elseif($Followup->status == 1){
                        $color = 'green';
                    }else{
                        $color = 'red';
                    }
                    @endphp
                   <span style="color:{{$color}}"> {{$Followup->follow_up_next}}</span></td>
                 
                <td>{{$Followup->action_schedule}}</td>
                <!-- <td>@if($Followup && $Followup->first_name)-->
                <!--                                <div class="parent d-flex">-->
                <!--                                    <div class="child1">-->
                <!--                                         @if($Followup->profile_img)-->
                <!--                                                <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{$Followup->profile_img}}" height="30" width="30" alt="User avatar" />-->
                <!--                                            @else-->
                <!--                                                <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{url('public/images/21104.png')}}" height="30" width="30" alt="User avatar" />-->
                <!--                                            @endif-->
                <!--                                    </div>-->
                <!--                                    <div class="child2">-->
                <!--                                          {{$Followup->first_name }} {{$Followup->last_name }} <br> <span style="color:#6e6c76;font-size:85%">{{$Followup->comp_name }}</span>-->
                <!--                                    </div>-->
                <!--                                </div>-->
                <!--                           @endif </td>-->
                <!--<td>{{$Followup->phone_number}}</td>-->
                <td>
                    @if($Followup && $Followup->requirement)
                        {{ substr(strip_tags($Followup->requirement), 0, 10) }}
                    @else
                        --
                    @endif
                </td>
                <td><a href="#" class="read-more" data-bs-toggle="modal" data-bs-target="#fullKRAModal" data-remark="{{$Followup->remark}}"> {{substr(strip_tags($Followup->remark), 0, 5)}}  </a></td>
                              
        
               
                   <td>@if($followUpBy && $followUpBy->id)
                                                <div class="parent d-flex">
                                                    <div class="child1">
                                                         @if($followUpBy->profile_img)
                                                                <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{$followUpBy->profile_img}}" height="30" width="30" alt="User avatar" />
                                                            @else
                                                                <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{url('public/images/21104.png')}}" height="30" width="30" alt="User avatar" />
                                                            @endif
                                                    </div>
                                                    <div class="child2">
                                                          {{$followUpBy->first_name }} {{$followUpBy->last_name }} {{$followUpBy->id }} <br> <span style="color:#6e6c76;font-size:85%"></span>
                                                    </div>
                                                </div>
                                           @else -- @endif </td>
                                            <td>
                    <div style="display:flex;align-items:center;">
                        <div class="status" style="background-color:{{$leadStatus->label_color}};width:13px;height:13px;border-radius:50%;">&nbsp;</div>
                        <span style="padding: 5px;border-radius: 4px;">{{ucfirst($leadStatus->lead_status)}}</span>
                    </div>
                </td>
                 <td>{{$Followup->created_at}}</td>  
                <td>
                  <a href="#" onclick="EditFollowUp({{$Followup->id}})"><i class="fa-solid fa-edit"></i></a>
                  &nbsp;&nbsp;
                  <a class="delete_debtcase2" href="{{url('Employee/LeadsFollowup/delete/'.$Followup->id)}}" id="{{$Followup->id}}"><i class="fa-solid fa-trash"></i></a>
                </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td></td>
                <td>No data found</td>
                <td></td>
              </tr>
              @endif     
              <tr class="group">
              <td colspan="10" style="background-color:#dbdade">Tommorrow</td>
        </tr>
                @if(count($tomorrow) > 0)
              @foreach($tomorrow as $Followup)
               @php 
               $leadStatus = DB::table('lead_statuses')->where('id',$Followup->leads_status)->first(); 
               $followUpBy = DB::table('users')->where('id',$Followup->follow_up_by)->first();  @endphp
        
              <tr>
                <td>{{$Followup->id}}</td>         
                <td><a href="{{url('Employee/Leads/view/'.$Followup->leads_id)}}">{{$Followup->leads_id}}</a></td>         
                <td>
                    @php
                    if($Followup->status == 0){
                        $color = 'black';
                    }elseif($Followup->status == 1){
                        $color = 'green';
                    }else{
                        $color = 'red';
                    }
                    @endphp
                   <span style="color:{{$color}}"> {{$Followup->follow_up_next}}</span></td>
                 
                <td>{{$Followup->action_schedule}}</td>
                <!-- <td>@if($Followup && $Followup->first_name)-->
                <!--                                <div class="parent d-flex">-->
                <!--                                    <div class="child1">-->
                <!--                                         @if($Followup->profile_img)-->
                <!--                                                <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{$Followup->profile_img}}" height="30" width="30" alt="User avatar" />-->
                <!--                                            @else-->
                <!--                                                <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{url('public/images/21104.png')}}" height="30" width="30" alt="User avatar" />-->
                <!--                                            @endif-->
                <!--                                    </div>-->
                <!--                                    <div class="child2">-->
                <!--                                          {{$Followup->first_name }} {{$Followup->last_name }} <br> <span style="color:#6e6c76;font-size:85%">{{$Followup->comp_name }}</span>-->
                <!--                                    </div>-->
                <!--                                </div>-->
                <!--                           @endif </td>-->
                <!--<td>{{$Followup->phone_number}}</td>-->
                <td>
                    @if($Followup && $Followup->requirement)
                        {{ substr(strip_tags($Followup->requirement), 0, 10) }}
                    @else
                        --
                    @endif
                </td>
                <td><a href="#" class="read-more" data-bs-toggle="modal" data-bs-target="#fullKRAModal" data-remark="{{$Followup->remark}}"> {{substr(strip_tags($Followup->remark), 0, 5)}}  </a></td>
                              
        
               
                   <td>@if($followUpBy && $followUpBy->id)
                                                <div class="parent d-flex">
                                                    <div class="child1">
                                                         @if($followUpBy->profile_img)
                                                                <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{$followUpBy->profile_img}}" height="30" width="30" alt="User avatar" />
                                                            @else
                                                                <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{url('public/images/21104.png')}}" height="30" width="30" alt="User avatar" />
                                                            @endif
                                                    </div>
                                                    <div class="child2">
                                                          {{$followUpBy->first_name }} {{$followUpBy->last_name }} {{$followUpBy->id }} <br> <span style="color:#6e6c76;font-size:85%"></span>
                                                    </div>
                                                </div>
                                           @else -- @endif </td>
                                            <td>
                    <div style="display:flex;align-items:center;">
                        <div class="status" style="background-color:{{$leadStatus->label_color}};width:13px;height:13px;border-radius:50%;">&nbsp;</div>
                        <span style="padding: 5px;border-radius: 4px;">{{ucfirst($leadStatus->lead_status)}}</span>
                    </div>
                </td>
                 <td>{{$Followup->created_at}}</td>  
                <td>
                  <a href="#" onclick="EditFollowUp({{$Followup->id}})"><i class="fa-solid fa-edit"></i></a>
                  &nbsp;&nbsp;
                  <a class="delete_debtcase2" href="{{url('Employee/LeadsFollowup/delete/'.$Followup->id)}}" id="{{$Followup->id}}"><i class="fa-solid fa-trash"></i></a>
                </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td></td>
                <td>No data found</td>
                <td></td>
              </tr>
              @endif
        <tr class="group">
          <td colspan="10" style="background-color:#dbdade">This Month</td>
        </tr>
    
        @if(count($thisMonth) > 0)
      @foreach($thisMonth as $Followup)
       @php 
       $leadStatus = DB::table('lead_statuses')->where('id',$Followup->leads_status)->first(); 
       $followUpBy = DB::table('users')->where('id',$Followup->follow_up_by)->first();  @endphp

      <tr>
        <td>{{$Followup->id}}</td>         
        <td><a href="{{url('Employee/Leads/view/'.$Followup->leads_id)}}">{{$Followup->leads_id}}</a></td>         
        <td>
            @php
            if($Followup->status == 0){
                $color = 'black';
            }elseif($Followup->status == 1){
                $color = 'green';
            }else{
                $color = 'red';
            }
            @endphp
           <span style="color:{{$color}}"> {{$Followup->follow_up_next}}</span></td>
         
        <td>{{$Followup->action_schedule}}</td>
        <!-- <td>@if($Followup && $Followup->first_name)-->
        <!--                                <div class="parent d-flex">-->
        <!--                                    <div class="child1">-->
        <!--                                         @if($Followup->profile_img)-->
        <!--                                                <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{$Followup->profile_img}}" height="30" width="30" alt="User avatar" />-->
        <!--                                            @else-->
        <!--                                                <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{url('public/images/21104.png')}}" height="30" width="30" alt="User avatar" />-->
        <!--                                            @endif-->
        <!--                                    </div>-->
        <!--                                    <div class="child2">-->
        <!--                                          {{$Followup->first_name }} {{$Followup->last_name }} <br> <span style="color:#6e6c76;font-size:85%">{{$Followup->comp_name }}</span>-->
        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                           @endif </td>-->
        <!--<td>{{$Followup->phone_number}}</td>-->
        <td>
            @if($Followup && $Followup->requirement)
                {{ substr(strip_tags($Followup->requirement), 0, 10) }}
            @else
                --
            @endif
        </td>
        <td><a href="#" class="read-more" data-bs-toggle="modal" data-bs-target="#fullKRAModal" data-remark="{{$Followup->remark}}"> {{substr(strip_tags($Followup->remark), 0, 5)}}  </a></td>
                      

       
           <td>@if($followUpBy && $followUpBy->id)
                                        <div class="parent d-flex">
                                            <div class="child1">
                                                 @if($followUpBy->profile_img)
                                                        <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{$followUpBy->profile_img}}" height="30" width="30" alt="User avatar" />
                                                    @else
                                                        <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{url('public/images/21104.png')}}" height="30" width="30" alt="User avatar" />
                                                    @endif
                                            </div>
                                            <div class="child2">
                                                  {{$followUpBy->first_name }} {{$followUpBy->last_name }} {{$followUpBy->id }} <br> <span style="color:#6e6c76;font-size:85%"></span>
                                            </div>
                                        </div>
                                   @else -- @endif </td>
                                    <td>
            <div style="display:flex;align-items:center;">
                 @php
                    if($Followup->status == 0){
                        $color = 'black';
                        $status = 'Upcomming';
                    }elseif($Followup->status == 1){
                        $color = 'green';
                        $status = 'Completed';
                    }else{
                        $color = 'red';
                        $status = 'Due';
                    }
                @endphp
                <div class="status" style="background-color:{{$color}};width:13px;height:13px;border-radius:50%;">&nbsp;</div>
                <span style="padding: 5px;border-radius: 4px;">{{ucfirst($status)}}</span>
            </div>
        </td>
         <td>{{$Followup->created_at}}</td>  
        <td>
          <a href="#" onclick="EditFollowUp({{$Followup->id}})"><i class="fa-solid fa-edit"></i></a>
          &nbsp;&nbsp;
          <a class="delete_debtcase2" href="{{url('Employee/LeadsFollowup/delete/'.$Followup->id)}}" id="{{$Followup->id}}"><i class="fa-solid fa-trash"></i></a>
        </td>
      </tr>
      @endforeach
      @else
      <tr>
        <td></td>
        <td>No data found</td>
        <td></td>
      </tr>
      @endif
      </tbody>
   
</table>
<!--Modal start-->
<div class="modal fade" id="FollowUpEditModal" data-bs-backdrop="static" tabindex="-1" aria-modal="true" role="dialog"></div>
<div class="modal fade" id="FollowUpModal" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
  <div class="modal-dialog">
    <form action="{{url('Employee/LeadsFollowup/store')}}"   class="modal-content" method="post" enctype="multipart/form-data"> 
      @csrf
      <div class="modal-header">
        <h4>Follow UP</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-6 mb-3 text-muted">Lead Name</div>
          <div class="col-sm-6 mb-3"></div>
          <div class="col-sm-6 mb-3">
            <label for="Follow Up Next" class="form-label">Follow Up Next</label>
            <input type="date" class="form-control" name="follow_up_next" id="Follow Up Next" required/>
            <input type="hidden" class="form-control" name="leads_id">
          </div>
          <div class="col-sm-6 mb-3">
            <label for="StartTime" class="form-label">Start Time</label>
            <input type="time" class="form-control" name="start_time" id="StartTime" required/>
          </div>
          <!--<div class="col-sm-12 mb-3">-->
          <!--  <div class="form-check form-check-primary mt-3">-->
          <!--    <input class="form-check-input" type="checkbox" value="" id="customCheckPrimary"  name="custom_check_primary" onclick="Sendreminder()">-->
          <!--    <label class="form-check-label" for="customCheckPrimary">Send Reminder</label>-->
          <!--  </div>-->
          <!--</div>-->
          <div class="row" id="Sendreminder"></div>
          <div class="col-sm-12 mb-3">
            <label for="Remark" class="form-label">Remark</label>
            <textarea class="form-control" name="remark"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">
          Close
        </button>
        <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="fullKRAModal" tabindex="-1" aria-labelledby="fullKRAModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fullKRAModalLabel">Note</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>
<!--Modal End-->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('.read-more').on('click', function() {
            var remark = $(this).data('remark');
            $('#fullKRAModal .modal-body').html(remark);
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get month and year select elements
        var monthSelect = document.getElementById('months');
        var yearSelect = document.getElementById('year');

        // Add onchange event listener to month and year select elements
        monthSelect.addEventListener('change', function() {
            submitForm();
        });

        yearSelect.addEventListener('change', function() {
            submitForm();
        });

        // Function to submit the form
        function submitForm() {
            // Get the form element
            var form = document.querySelector('form');

            // Submit the form
            form.submit();
        }
    });
</script>

<script>
 $(document).ready(function () {
    $(".delete_debtcase2").click(function (e) {
        var url = $(this).attr('href');
        e.preventDefault();
        bootbox.confirm({
            message: "Are you sure you want to delete this lead?",
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


  function LeadAssigned(id,value){
   $.ajax({
    url: "{{ url('Employee/Leads/LeadAssignUpdate') }}",
    method: 'GET',
    data: { id: id, value: value },
    success: function (response) {
      if (response && response.status === 200 && response.success) {
        $('#assignednewuser').show();
        setTimeout(function () {
          $('#assignednewuser').hide(500);
        }, 2000);
      } else {
        alert("Opps. Please try again.");
      }
    },
    error: function () {
    }
  });
 }

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
    var selectedYear = $selectYear.val();
    var selectedMonth = $selectMonth.val();

            // Make an AJAX request to fetch data based on the selected year and month
    $.ajax({
      url: "{{ url('Employee/Leads/get_followups_yeardata') }}",
      method: 'GET',
      data: { year: selectedYear, month: selectedMonth },
      success: function (data) {
                    // Handle the successful response
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
  
});
function EditFollowUp(id) {
    $.ajax({
        url: "{{ url('Employee/LeadsFollowup/edit') }}",
        method: 'GET',
        data: { id: id },
        success: function (response) {
            $('#FollowUpEditModal').html(response);
            var myModal = new bootstrap.Modal(document.getElementById('FollowUpEditModal'), {
                backdrop: 'static'
            });
            myModal.show();
        },
        error: function () {
            console.error('An error occurred while trying to fetch the follow-up edit modal.');
        }
    });
}

  $('#leadType').on('change', fetchData1);
  $('#filter').on('change', fetchData1);
  $('#statusFilter').on('change', fetchData1);

   function fetchData1() {
    var leadType =$('#leadType').val();
    var filterVal =$('#filter').val();
    var statusFilter =$('#statusFilter').val();
    $.ajax({
      url: "{{ url('Employee/Leads/get_follow_up_type') }}",
      method: 'GET',
      data: { leadType: leadType,filterVal: filterVal,statusFilter: statusFilter },
      success: function (data) {
                    // Handle the successful response
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

</script>
