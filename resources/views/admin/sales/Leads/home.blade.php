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
  
 
 
 .leadbtn:hover{
     
     color:white !important;
 }
  
  .leadbtn::visited{
      
          background: linear-gradient(72.47deg, #7367f0 22.16%, rgba(115, 103, 240, 0.7) 76.47%);
          color:white;
      
  }

.leadbtn:focus{
      
       background: linear-gradient(72.47deg, #7367f0 22.16%, rgba(115, 103, 240, 0.7) 76.47%);
          color:white;
      
  }
  
  .leadbtn:active{
      
       background: linear-gradient(72.47deg, #7367f0 22.16%, rgba(115, 103, 240, 0.7) 76.47%);
          color:white;
      
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
                <h3 class="mb-0 me-2" id="totalLeads">{{$TotalLeads}}</h3>
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
                <h3 class="mb-0 me-2" id="progressLeads">{{$progress}}</h3>
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
                <h3 class="mb-0 me-2" id="winLeads">{{$win}}</h3>
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
                <h3 class="mb-0 me-2" id="lossLeads">{{$loss}}</h3>
              </div>
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
    <!--tabs-->
                <section class="emp_table">
                    <div class="row">
                            <div class="col-md-4 mb-4">
                           
                           
                        </div>
                       
                    <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-header"><span id="tableTitle">Leads's List</h5>
                        </div>
                        <div class="col-md-6 text-end">
                         <button onclick="Leads()"  class="btn btn-primary mt-3 m-3 leadbtn">Leads</button>
                   <button onclick="FollowUps(); "class="btn btn-primary mt-3 m-3 leadbtn">Followup's</button>
                      <a href="{{ url('admin/Leads/add') }}" class="btn btn-primary waves-effect waves-light"> Add</a>
                            <a href="{{ url('admin/Leads/home') }}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
                              <!--<a href="{{url('admin/recent_follow_ups')}}" class="btn btn-primary mt-3 m-3">All Follow UPs</a>-->
                        </div>
                    </div>
   

    <div class="card-datatable table-responsive">
      
            
        <!--  <div class="row">-->
        <!--    <div class="col-md-4 d-flex" style="justify-content: space-between;">-->
        <!--        <h5 class="card-header">Invoices List</h5>-->
        <!--    </div>-->
        <!--    <div class="col-md-8 text-end">-->
        <!--        <form id="downloadPDF" action="{{url('admin/Invoices/downloadPDF')}}">-->
        <!--            <input type="hidden" name="id" class="pdfValue">-->
        <!--            <a href="javascript::void(0);" class="btn btn-danger mt-3 m-3"  onclick="submitForm()"><i class="fa-solid fa-file-pdf"></i></a>-->
        <!--            <a href="{{url('admin/Invoices/EXPORTCSV')}}" class="btn btn-info mt-3 m-3"><i class="fa-solid fa-file-csv"></i></a>-->
        <!--            <a href="{{url('admin/Invoices/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>-->
        <!--            <a href="{{url('admin/Invoices/gst')}}" class="btn btn-primary mt-3 m-3">GST</a>-->
        <!--            <a href="{{url('admin/Invoices/tds')}}" class="btn btn-primary mt-3 m-3">TDS</a>-->
        <!--            <a href="{{url('admin/Invoices/add')}}" class="btn btn-primary mt-3 m-3">Add</a>-->
        <!--        </form>-->
        <!--    </div>-->
        <!--</div>-->
    
                            
        <div id="newpayroll">
    <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
        <div class="row">
            <div class="col-sm-12 col-md-10"></div>
            <div class="col-sm-12 col-md-2">
            </div>
            <div class="col-sm-12 col-md-3">
                <div class="dataTables_length" id="DataTables_Table_3_length">
                    <label>
                        <select name="months" class="form-select month-selector" id="months">
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
                        <select name="year" class="form-select year-selector" id="year"></select>
                    </label>
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
                                                        <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
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
                                                                        <td >
                                                                            {{$user->first_name }} {{$user->last_name }} <br> ({{$user->company_name}})
                                                                        </td>
                                                                       <td>@if($user && $user->phone_number) {{ $user->phone_number }} @endif</td>
                                                                    <td>
                                                                            @if($user && $user->requirement)
                                                                                {{ substr(strip_tags($user->requirement), 0, 10) }}
                                                                            @else
                                                                                --
                                                                            @endif
                                                                    </td>

                                                                                                  <td>
                                                                                                   @foreach($Employee as $Emp)
                                                                                                   @if($user && $user->assignedto == $Emp->id)
                                                                                                       <div class="parent d-flex">
                                                                                                           <div class="child1">
                                                                                                               <img class="rounded-circle" style="margin-right: 15px;" src="{{isset($Emp->profile_img) ? $Emp->profile_img : url('public/images/21104.png')}}" height="30" width="30" alt="User avatar" />
                                                                                                           </div>
                                                                                                           <div class="child2">
                                                                                                               {{$Emp->first_name }} {{$Emp->last_name }} (#{{$Emp->id }})
                                                                                                               <div style="font-size:12px;">
                                                                                                                   {{$Emp->desgname}}
                                                                                                               </div>
                                                                                                           </div>
                                                                                                       </div>
                                                                                                   @endif
                                                                                               @endforeach
                                                                                                  </td>
                                                                                    
                                                                                                  
                                                                                                  <td>
                                                                                                    @if($user && $user->first_name)
                                                                                                     <div class="parent d-flex">
                                                                                                         <div class="child1">
                                                                                                             <img class="rounded-circle" 
                                                                                                                  style="margin-right: 15px;" 
                                                                                                                  src="{{$user->profile_img}}" 
                                                                                                                  height="30" 
                                                                                                                  width="30" 
                                                                                                                  alt="User avatar" />
                                                                                                         </div>
                                                                                                         <div class="child2">
                                                                                                             {{$user->generated_by_first_name }} {{$user->generated_by_last_name }} (#{{$user->generated_by_id }})
                                                                                                             <div style="font-size:12px;">
                                                                                                              {{$user->desgname}}
                                                                                                             </div>
                                                                                                         </div>
                                                                                                     </div>
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
                                                        <div class="p-1" style="float: right;">
                                                            {{ $users->links() }}
                                                        </div>
                                                    </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                         </div>
        </div>
                </section>
            <!--tabs end-->

</div>
</div>
</div>
<script>
    // Function to set current month and year for all selectors with the respective class
    function setCurrentMonthAndYear() {
        const currentDate = new Date();
        const currentMonth = (currentDate.getMonth() + 1).toString().padStart(2, '0'); // getMonth() returns 0-11, so add 1
        const currentYear = currentDate.getFullYear();

        document.querySelectorAll('.month-selector').forEach(select => {
            select.value = currentMonth;
        });

        document.querySelectorAll('.year-selector').forEach(select => {
            if (!select.innerHTML.trim()) { // Only populate if the select is empty
                for (let year = currentYear - 10; year <= currentYear + 10; year++) {
                    const option = document.createElement('option');
                    option.value = year;
                    option.text = year;
                    select.appendChild(option);
                }
            }
            select.value = currentYear;
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        setCurrentMonthAndYear();

        $(document).on('click', '.btn-primary', function() {
            setTimeout(setCurrentMonthAndYear, 1000); // Adjust timeout as needed to ensure elements are loaded
        });
    });

    // Existing AJAX functions
    function LeadAssigned(id, value) {
        $.ajax({
            url: "{{ url('admin/Leads/LeadAssignUpdate') }}",
            method: 'GET',
            data: { id: id, value: value },
            success: function(response) {
                if (response && response.status === 200 && response.success) {
                    $('#assignednewuser').show();
                    setTimeout(function() {
                        $('#assignednewuser').hide(500);
                    }, 2000);
                } else {
                    alert("Opps. Please try again.");
                }
            },
            error: function() {
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
                url: "{{ url('admin/Leads/getleadsYearfilterdata') }}",
                method: 'GET',
                data: { year: selectedYear, month: selectedMonth },
                success: function(response) {
                 console.log(response);
                           if (response.status === 200 && response.success) {
                        var TotalLeads = response.TotalLeads;
                        var progress = response.progress;
                        var win = response.win;
                        var loss = response.loss;
                        var LeadsFollowup = response.LeadsFollowup;
        
                        // Update your UI with the data
                        $('#totalLeads').text(TotalLeads);
                        $('#progressLeads').text(progress);
                        $('#winLeads').text(win);
                        $('#lossLeads').text(loss);
        
                        // Process LeadsFollowup if needed
                        // Example: $('#leadsFollowup').text(JSON.stringify(LeadsFollowup));
                    }
                },
                error: function() {
                }
            });
            $.ajax({
                url: "{{ url('admin/Leads/get_leads_yeardata') }}",
                method: 'GET',
                data: { year: selectedYear, month: selectedMonth },
                success: function(data) {
                    // Handle the successful response
                    $('#result').empty(); // Clear previous content

                    if (data.length > 0) {
                        $('#result').html(data);
                    } else {
                        $('#result').html('<tr><td colspan="8" class="text-center"><span>No Data Found</span></td></tr>');
                    }
                },
                error: function() {
                    $('#result').html('<tr><td colspan="8" class="text-center"><span>Error fetching data.</span></td></tr>');
                }
            });
        }
    });

    function Leads() {
        $.ajax({
            url: "{{ url('admin/Leads/ShowLeads') }}",
            method: 'GET',
            success: function(data) {
                // Handle the successful response
                $('#newpayroll').empty(); // Clear previous content
                $('#tableTitle').text("Leads's List");
                if (data.length > 0) {
                    $('#newpayroll').html(data);
                } else {
                    $('#newpayroll').html('<tr><td colspan="8" class="text-center"><span>No Data Found</span></td></tr>');
                }
                setCurrentMonthAndYear(); // Ensure new content has current month and year
            },
            error: function() {
                $('#newpayroll').html('<tr><td colspan="8" class="text-center"><span>Error fetching data.</span></td></tr>');
            }
        });
    }

    function FollowUps() {
        $.ajax({
            url: "{{ url('admin/Leads/ShowFollowUps') }}",
            method: 'GET',
            success: function(data) {
                // Handle the successful response
                $('#newpayroll').empty(); // Clear previous content
                $('#tableTitle').text("Followup's ");
                if (data.length > 0) {
                    $('#newpayroll').html(data);
                } else {
                    $('#newpayroll').html('<tr><td colspan="8" class="text-center"><span>No Data Found</span></td></tr>');
                }
                setCurrentMonthAndYear(); // Ensure new content has current month and year
            },
            error: function() {
                $('#newpayroll').html('<tr><td colspan="8" class="text-center"><span>Error fetching data.</span></td></tr>');
            }
        });
    }
</script>

<script>
    // Get the current month
    const currentMonth = new Date().getMonth() + 1; // JavaScript months are zero-based, so add 1 to get the correct month number
    // Set the default selected option based on the current month
    document.getElementById('months').value = currentMonth.toString().padStart(2, '0'); // Ensure two-digit format (e.g., '05' for May)
    
    
</script>'
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


      
</script>




@endsection