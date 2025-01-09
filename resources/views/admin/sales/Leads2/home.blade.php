@extends('layouts.admin')
@section('title', 'Leads')
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

  .btmtable th{

background-color:#eae8fd !important;

  }

  .btmtable{

    border-radius:4px;
  }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Leads /</span> Home</h4>
  @if(Session::has('success'))
  <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
  @endif
  <div  id="assignednewuser" style="display:none;" class="alert alert-success">This Lead is assigned to new user.</div>
  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Total Leads</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2">{{$TotalLeads}}</h3>
                <!-- <p class="text-success mb-0">0</p> -->
              </div>
              <!-- <p class="mb-0">Total Leads</p> -->
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-primary">
                <i class="ti ti-user ti-sm"></i>
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
              <span>Progress Leads</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2">{{$progress}}</h3>
                <!-- <p class="text-success mb-0"></p> -->
              </div>
              <!-- <p class="mb-0">Last week analytics</p> -->
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-danger">
                <i class="ti ti-user-plus ti-sm"></i>
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
              <span>Win Leads</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2">{{$win}}</h3>
                <!-- <p class="text-danger mb-0"></p> -->
              </div>
              <!-- <p class="mb-0">Last week analytics</p> -->
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-success">
                <i class="ti ti-user-check ti-sm"></i>
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
              <span>Loss Leads</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2">{{$loss}}</h3>
                <!-- <p class="text-success mb-0"></p> -->
              </div>
              <!-- <p class="mb-0">Last week analytics</p> -->
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-warning">
                <i class="ti ti-user-exclamation ti-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Users List Table -->
<!-- Users List Table -->
<div class="card">
    <div class="row">
        <div class="col-md-6">
            <h5 class="card-header">Leads's List</h5>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ url('admin/Leads/home') }}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
            <a href="{{ url('admin/Leads/add') }}" class="btn btn-success mt-3 m-3">Add Leads</a>
              <a href="{{url('admin/recent_follow_ups')}}" class="btn btn-primary mt-3 m-3">All Follow UPs</a>
        </div>
    </div>
    <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
            <div class="row">
                
                <div class="col-sm-12 col-md-3">
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
                
                <div class="col-sm-12 col-md-5 d-flex " style="align-self:center;">
                      
                        <form>
                          <div class="input-group input-daterange" id="bs-datepicker-daterange">
                          <input type="date" id="dateRangePicker" placeholder="MM/DD/YYYY" class="form-control fromDate" name="from" value="{{request()->get('from')}}" >
                          <span class="input-group-text">to</span>
                          <input type="date" placeholder="MM/DD/YYYY" class="form-control toDate" name="to" value="{{request()->get('to')}}">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                      </div>
                        </form>
                    </div>
                           <div class="col-sm-12 col-md-4 d-flex justify-content-center justify-content-md-end">

                    <div id="DataTables_Table_3_filter" class="dataTables_filter">
                        <form method="GET" action="{{ url('admin/Leads/home') }}">
                            <label>Search:
                                <input type="search" value="{{ $searchTerm }}" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3">
                            </label>
                        </form>
                    </div>
                </div>
                </div>
            </div>
            <div class="table_div" style="margin-top:20px;padding: 0 12px;">
            <table class="dt-responsive table dataTable dtr-column mt-4 btmtable" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info" style="margin-top:10px;border-radius:4px;">
          <thead>
            <tr>
              <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
              <th>Lead ID</th>
              <th>CLIENT NAME</th>
              <th>MOBILE NUMBER</th>
              <th>REQUIREMENT</th>
              <th>ASSIGNED TO</th>
              <th>GENERATED BY</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
                <tbody id="result">
            @if(count($users) > 0)
            @foreach($users as $key=> $user)
            @php $leadStatus = DB::table('lead_statuses')->where('id',$user->status)->first();  @endphp
            <tr class="odd">
              <td>{{ $user->id }} </td>
              <td>
                {{$user->first_name }}
              </td>
              <td>@if($user && $user->phone_number) {{ $user->phone_number }} @endif</td>
              <td>
                @if($user && $user->requirement)
                    @php
                        $requirement = strip_tags($user->requirement);
                        $requirement = str_word_count($requirement, 2, '<>');
                        $requirement = array_slice($requirement, 0, 10);
                        $requirement = implode(' ', $requirement);
                    @endphp
                    {{ $requirement }} 
                @endif
            </td>
              <td>

                @foreach($Employee as $Emp)
                @if($user && $user->assignedto == $Emp->id)
                <img class="rounded-circle" style="margin-right: 15px;" src="{{isset($Emp->profile_img) ? $Emp->profile_img : url('public/images/21104.png')}}" height="30" width="30" alt="User avatar" />{{$Emp->first_name }}<div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$Emp->post_name}}</div>
                @endif
                @endforeach
              </td>

              
              <td>
                @if($user && $user->first_name)
                <img class="rounded-circle"
                style="margin-right: 15px;" 
                src="{{$user->profile_img}}"
                height="30"
                width="30"
                alt="User avatar" />{{$user->generated_by_first_name }}<div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$user->post_name}}</div>
              @endif</td>
              <td>
                <div style="display:flex;align-items:center;">
                <div class="status" style="background-color:{{$user->leadStatusColor}};width:13px;height:13px;border-radius:50%;">&nbsp;</div>
              <span style="padding: 5px;border-radius: 4px;">{{ucfirst($leadStatus->lead_status)}}</span>
</div>
             </td>
 
             <td>
              <div class="d-flex">

                <a href="{{url('admin/Leads/view/'.$user->id)}}"><svg style="margin-left: 10px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" font-size="1.375rem" class="iconify iconify--tabler" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><circle cx="12" cy="12" r="2"></circle><path d="M22 12c-2.667 4.667-6 7-10 7s-7.333-2.333-10-7c2.667-4.667 6-7 10-7s7.333 2.333 10 7"></path></g></svg></a>



<a href="{{ url('admin/Leads/delete/'.$user->id) }}" id="{{ $user->id }}" class="delete_debtcase">
    <svg style="margin-left: 10px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" font-size="1.375rem" class="iconify iconify--tabler" width="1em" height="1em" viewBox="0 0 24 24">
        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 7h16m-10 4v6m4-6v6M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3"></path>
    </svg>
</a>

                <a href="{{url('admin/Quotes/add/?id='.$user->id)}}">
                <svg style="margin-left: 10px; fill: #7367f0;" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path d="M9.983 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849h-4v-10h9.983zm14.017 0v7.391c0 5.704-3.748 9.571-9 10.609l-.996-2.151c2.433-.917 3.996-3.638 3.996-5.849h-3.983v-10h9.983z"/></svg>
                </a>

               


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
</div>
    <div class="p-1" style="float: right;">
      {{ $users->links() }}
    </div>
  </div>
</div>
</div>
</div>
<script>
 $(document).ready(function () {
    $(".delete_debtcase").click(function (e) {
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
    url: "{{ url('admin/Leads/LeadAssignUpdate') }}",
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

  $selectYear.on('change', fetchData);
  $selectMonth.on('change', fetchData);

  function fetchData() {
    var selectedYear = $selectYear.val();
    var selectedMonth = $selectMonth.val();

    $.ajax({
      url: "{{ url('admin/Leads/get_leads_yeardata') }}",
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
</script>

<script>
    // Get the current month
    const currentMonth = new Date().getMonth() + 1; // JavaScript months are zero-based, so add 1 to get the correct month number
    // Set the default selected option based on the current month
    document.getElementById('months').value = currentMonth.toString().padStart(2, '0'); // Ensure two-digit format (e.g., '05' for May)
</script>'


@endsection