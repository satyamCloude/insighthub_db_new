@extends('layouts.admin')
@section('title', 'Quotes')
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
   .fix_height{
   min-height: 144px;
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
   .red {
   color: red;
   }
   .green {
   color: green;
   }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
   <h4 class="py-3 mb-4"><span class="text-muted fw-light">Quotes /</span> Home</h4>
   @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
   @endif
   <div class="row g-4 mb-4">
      <div class="col-sm-2 col-xl-2">
         <div class="card fix_height">
            <div class="card-body">
               <div class="d-flex align-items-start justify-content-between">
                  <div class="content-left">
                     <span>Total Quotes</span>
                     <div class="d-flex align-items-center my-2">
                        <h3 class="mb-0 me-2">{{$TotalQuotes}}</h3>
                     </div>
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
      <div class="col-sm-2 col-xl-2">
         <div class="card fix_height">
            <div class="card-body">
               <div class="d-flex align-items-start justify-content-between">
                  <div class="content-left">
                     <span>Delivered Quotes</span>
                     <div class="d-flex align-items-center my-2">
                        <h3 class="mb-0 me-2">{{$delivered}}</h3>
                        <!-- <p class="text-success mb-0"></p> -->
                     </div>
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
      <div class="col-sm-2 col-xl-2">
         <div class="card fix_height">
            <div class="card-body">
               <div class="d-flex align-items-start justify-content-between">
                  <div class="content-left">
                     <span>Onhold Quotes</span>
                     <div class="d-flex align-items-center my-2">
                        <h3 class="mb-0 me-2">{{$onhold}}</h3>
                        <!-- <p class="text-danger mb-0"></p> -->
                     </div>
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
      <div class="col-sm-2 col-xl-2">
         <div class="card fix_height">
            <div class="card-body">
               <div class="d-flex align-items-start justify-content-between">
                  <div class="content-left">
                     <span>Accepted Quotes</span>
                     <div class="d-flex align-items-center my-2">
                        <h3 class="mb-0 me-2">{{$accepted}}</h3>
                        <!-- <p class="text-success mb-0"></p> -->
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
      <div class="col-sm-2 col-xl-2">
         <div class="card fix_height">
            <div class="card-body">
               <div class="d-flex align-items-start justify-content-between">
                  <div class="content-left">
                     <span>Lost Quotes</span>
                     <div class="d-flex align-items-center my-2">
                        <h3 class="mb-0 me-2">{{$lost}}</h3>
                        <!-- <p class="text-success mb-0"></p> -->
                     </div>
                     <!-- <p class="mb-0">Lost Quotes</p> -->
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
      <div class="col-sm-2 col-xl-2">
         <div class="card fix_height">
            <div class="card-body">
               <div class="d-flex align-items-start justify-content-between">
                  <div class="content-left">
                     <span>Win Quotes</span>
                     <div class="d-flex align-items-center my-2">
                        <h3 class="mb-0 me-2">{{$win}}</h3>
                        <!-- <p class="text-success mb-0"></p> -->
                     </div>
                     <!-- <p class="mb-0">Win Quotes</p> -->
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
   <div class="card" style="width: 100%;">
      <div class="row">
         <div class="col-md-6">
            <h5 class="card-header">Quote's List</h5>
         </div>
         <div class="col-md-6 text-end">
            <form id="downloadPDFForm" method="POST">
               @csrf <!-- Add CSRF token if using Laravel -->
               <input type="hidden" name="ids[]" class="pdfValue">
               <a href="javascript:void(0);" class="btn btn-danger mt-3 m-3" onclick="downloadPDF()"><i class="fa-solid fa-file-pdf"></i></a>
               <!--<a href="#" class="btn btn-info mt-3 m-3 waves-effect waves-light"><i class="fa-solid fa-file-csv"></i></a>-->
               <a href="{{ url('Employee/Quotes/home') }}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
               @if($RoleAccess[array_search('Quotes', array_column($RoleAccess, 'per_name'))]['add'] == 1)
               <a href="{{url('Employee/Quotes/add')}}" class="btn btn-primary mt-3 m-3">Add Quotes</a>
               @endif
            </form>
         </div>
      </div>
      <div class="card-datatable table-responsive">
         <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
            <!-- <div class="row">
               <div class="col-sm-12 col-md-6">
                  <div class="dataTables_length" id="DataTables_Table_3_length">
                     <label>
                  </div>
               </div>
               <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
               <div id="DataTables_Table_3_filter" class="dataTables_filter">
               <form method="GET" action="">    
               <label>Search: <input type="search" value="{{$searchTerm}}" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
               </form>
               </div>
               </div>
            </div> -->
            <div class="row">
               <div class="col-sm-12 col-md-10"></div>
               <div class="col-sm-12 col-md-2"></div>
               <div class="col-sm-12 col-md-5 d-flex " style="align-self:center;">
                  <form method="GET" action=""> 
                     <div class="input-group input-daterange" id="bs-datepicker-daterange">
                        <input type="date" id="dateRangePicker" placeholder="MM/DD/YYYY" class="form-control fromDate" name="from" value="{{request()->get('from')}}" >
                        <span class="input-group-text">to</span>
                        <input type="date" placeholder="MM/DD/YYYY" class="form-control toDate" name="to" value="{{request()->get('to')}}">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                     </div>
                  </form>
               </div>
               <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
                  <div id="DataTables_Table_3_filter" class="dataTables_filter">
                     <form method="GET" action="">    
                        <label>Search: <input type="search" value="{{$searchTerm}}" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                     </form>
                  </div>
               </div>
            </div>

            <div class="table_div" style="margin-top:20px; padding: 0 12px;">
               <table class="dt-responsive table dataTable dtr-column mt-4 btmtable" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info" style="margin-top:10px;border-radius:4px;width: max-content !important;">
                  <thead>
                     <tr>
                        <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                        <th><input type="checkbox" id="selectAll"> &nbsp;&nbsp;&nbsp;#</th>
                        <th>CLIENT NAME</th>
                        <th>SUBJECT</th>
                        <!-- <th>STAGE</th> -->
                        <th>TOTAL AMOUNT</th>
                        <th>VALID UNTIL</th>
                        <th>LAST MODIFICATION</th>
                        <th>Generated bY</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @if(count($users) > 0)
                     @foreach($users as $key => $user)
                     @php 
                     $empDetl = \App\Models\EmployeeDetail::where('user_id', Auth::user()->id)
                     ->first();
                     $generated_by = \App\Models\User::select('users.first_name','users.last_name','users.company_name','users.id as emp_id', 'users.profile_img', 'company_logins.company_name','jobroles.name as jobrole')
                     ->leftJoin('employee_details', 'employee_details.user_id', '=', 'users.id')
                     ->leftJoin('jobroles', 'employee_details.jobrole_id', '=', 'jobroles.id')
                     ->leftJoin('company_logins', 'company_logins.id', '=', 'employee_details.company_id')
                     ->where('users.id', $user->quotesuser_id)
                     ->first();
                     @endphp
                     <tr class="odd">
                        <td><input type="checkbox" name="ids[]" class="selectId" value="{{$user->id}}"> &nbsp;&nbsp;{{ $key + 1 }} </td>
                        <td  >
                           <div class="d-flex">
                              @if($user->leads_id === 0)
                              @php
                              $user_data = null;
                              if ($user->customer_name) {
                              $user_data = \App\Models\User::select('users.first_name','users.last_name','users.company_name','users.id as client_id', 'users.profile_img', 'users.email')
                              ->where('users.id', $user->customer_name)
                              ->first();
                              }
                              @endphp
                              @if($user_data)
                              @if($user_data->profile_img)
                              <img class="rounded-circle" src="{{ $user_data->profile_img }}" height="30" width="30" alt="User avatar" style="width:45px;border-radius:50%;height:auto;margin-right: 15px;">
                              @else
                              <img src="https://i.pinimg.com/564x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg" style="width:45px;border-radius:50%;height:auto;margin-right: 15px;">
                              @endif
                              <div >                              
                                 <a href="@if($empDetl && $empDetl->department_id != 1){{ url('Employee/Quotes/view/'.$user->id) }}@else # @endif">
                                    {{ $user_data->first_name }} {{ $user_data->last_name }} (#{{ $user_data->client_id }})
                                 </a><br/>
                                 <small>{{ $user_data->company_name }}</small>
                              </div>
                              @endif
                              @else
                              @php
                              $user_data2 = \App\Models\Leads::select('leads.first_name', 'leads.last_name', 'leads.email')
                              ->where('leads.id', $user->leads_id)
                              ->first();
                              @endphp
                              @if($user_data2)
                              <img src="https://i.pinimg.com/564x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg" style="width:45px;border-radius:50%;height:auto;">
                              <a href="{{ url('Employee/Quotes/view/'.$user->id) }}">{{ $user_data2->first_name }} {{ $user_data2->last_name }} (#{{ $user_data2->client_id }})</a>
                              <div style="font-size:12px; margin-left: 46px; margin-top: -11px;">{{ $user_data2->jobrole }}</div>
                              @else
                              <img src="https://i.pinimg.com/564x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg" style="width:45px;border-radius:50%;height:auto;margin-right: 15px;">
                              @endif
                              @endif
                           </div>
                        </td>
                        <td>@if($user && $user->subject) {{ $user->subject }} @endif</td>
                        <td>@if($user && $user->total) {{ $user->total }} @endif</td>
                        @php
                        $validDate = $user && $user->valid_until ? $user->valid_until : null;
                        $isExpired = $validDate && $user->valid_until < date('Y-m-d');
                        @endphp
                        <td class="{{ $isExpired ? 'red' : 'green' }}">
                           @if($validDate)
                           {{ date('d-m-Y', strtotime($user->valid_until)) }} 
                           @endif
                        </td>
                        <td>@if($user && $user->updated_at) {{ date('d-m-Y', strtotime($user->updated_at)) }} @endif</td>
                        <td>
                           @if($generated_by && $generated_by->profile_img)
                           <img class="rounded-circle" style="margin-right: 15px; margin-top: 10px;" src="{{ $generated_by->profile_img }}" height="30" width="30" alt="User avatar" />
                           @else
                           <img src="https://i.pinimg.com/564x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg" style="width:45px;border-radius:50%;height:auto;">
                           @endif
                           @if($generated_by && $generated_by->first_name) {{ $generated_by->first_name }} @endif @if($generated_by && $generated_by->last_name) (#{{ $generated_by->emp_id }}) @endif
                           <div style="font-size:12px; margin-left: 46px; margin-top: -11px;"> @if($generated_by && $generated_by->jobrole) {{ $generated_by->jobrole }}  @else - @endif</div>
                        </td>
                        <!--  <td>
                           @if($user['status']=="1")
                               <button onclick="changeStatus('{{ $user->id }}', '0')" class="btn btn-danger">Decline</button>
                           @else
                               <button onclick="changeStatus('{{ $user->id }}', '1')" class="btn btn-success">Accept</button>
                           @endif
                           
                           </td> -->
                        <td>
                           @switch($user->status)
                           @case('1')
                           <button  class="btn btn-warning">Pending</button>
                           @break
                           @case('2')
                           <button  class="btn btn-warning">Pending</button>
                           @break
                           @case('3')
                           <button  class="btn btn-primary">Accepted</button>
                           @break
                           @case('4')
                           <button  class="btn btn-danger">Lost</button>
                           @break
                           @case('5')
                           <button  class="btn btn-success">Win</button>
                           @break
                           @default
                           <button  class="btn btn-warning">Pending</button>
                           @endswitch
                        </td>
                        <td>
                           <div class="btn-group">
                              <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="ti ti-dots-vertical"></i>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-end" style="">
                                 <!-- <li><a class="dropdown-item" href="{{ url('Employee/Quotes/downloadPDF/'.$user->id) }}">Download</a></li> -->
                                 @if($user->status == '3')
                                    <li><a class="dropdown-item" href="{{ url('Employee/Quotes/MakeQuotesInvoice/'.$user->id) }}">Make Invoice</a></li>
                                 @endif
                                 <li><a class="dropdown-item" href="{{ url('Employee/Quotes/SendQuotes/'.$user->id) }}">Send</a></li>
                                 @if($RoleAccess[array_search('Quotes', array_column($RoleAccess, 'per_name'))]['update'] == 1)
                                 <li><a class="dropdown-item" href="{{ url('Employee/Quotes/edit/'.$user->id)}}">Edit</a></li>
                                 @endif
                              </ul>
                           </div>
                        </td>
                     </tr>
                     @endforeach
                     @else
                     <tr>
                        <td class="text-center" colspan="10">No Data Found</td>
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
       // Check/uncheck all checkboxes when clicking on the "selectAll" checkbox
       $("#selectAll").click(function () {
           $(".selectId").prop("checked", $(this).prop("checked"));
       });
   
       // Check if all checkboxes are checked when clicking on each checkbox
       $(".selectId").click(function () {
           if ($(".selectId:checked").length === $(".selectId").length) {
               $("#selectAll").prop("checked", true);
           } else {
               $("#selectAll").prop("checked", false);
           }
       });
   });
   
   function downloadPDF() {
       var selectedIds = [];
       $('.selectId:checked').each(function() {
           selectedIds.push($(this).val());
       });
   
       if (selectedIds.length > 0) {
           // Redirect to a route that generates PDF of selected invoices
           window.location.href = "{{ url('Employee/Quotes/downloadPDF') }}?ids=" + selectedIds.join(',');
       } else {
           alert('Please select at least one invoice to download the PDF.');
       }
   }
   
   function submitForm() {
       var form = document.getElementById('downloadPDFForm');
       form.action = "{{ url('Employee/Quotes/downloadPDF') }}"; // Set action to download PDF route
       form.submit();
   }
</script>
<script>
   function changeStatus(userId, status) {
      // Send AJAX request to the controller function with userId and status
      $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });
         $.ajax({
            type: 'POST',
            url: "{{url('Employee/Quotes/changeQuotesStatus')}}",
            data: {
               userId: userId,
               status: status
            },
            success: function (res) {
            if (res && res.data && res.data.exchange_rate) {
               $('#exchange_rate').val(res.data.exchange_rate);
            }else{
               $('#exchange_rate').val('');
            }
         },
      });
   }
   
</script>
@endsection

























