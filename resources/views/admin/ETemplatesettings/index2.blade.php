@extends('layouts.admin')
@section('title', 'Template Settings')
@section('content')
<style type="text/css">
      .bs-stepper-content{
        padding: 0px 10px 0px 10px !important;
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
   <h4 class="py-3 mb-4"><span class="text-muted fw-light">Template's /</span> Home</h4>
   @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
   @endif
   <div class="row g-4 mb-4">
      <div class="col-sm-2 col-xl-2">
      </div>
    </div>
<div class="card">
      <div class="row">
         <div class="col-md-6">
            <h5 class="card-header">Invoice Module</h5>
         </div>
         <!-- <div class="col-md-6 text-end">
            <a href="{{url('/')}}/admin/Quotes/EXPORTCSV" class="btn btn-info mt-3 m-3 waves-effect waves-light"><i class="fa-solid fa-file-csv"></i></a>
            <a href="{{url('admin/Quotes/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
            <a href="{{url('admin/Quotes/add')}}" class="btn btn-primary mt-3 m-3">Add Quotes</a>
         </div> -->
      </div>
      <div class="card-datatable table-responsive">
         <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
            
            <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
               <thead>
                  <tr>
                     <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                     <th>ID</th>
                     <th>Subject</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                @foreach($InvoiceModule as $InvoiceModules)
                  <tr class="odd">
                     <td>{{$InvoiceModules->id}}</td>
                     <td>{{$InvoiceModules->subject}}</td>
                     <td><a href="{{url('admin/ETemplatesettings/InvoiceModule/home/'.$InvoiceModules->id)}}"><button class="btn btn-primary">View</button></a></td>
                  </tr>
                
                  @endforeach                
               </tbody>
            </table>
            
         </div>
      </div>
   </div>

   <div class="card my-5">
      <div class="row">
         <div class="col-md-6">
            <h5 class="card-header">Quotes Module</h5>
         </div>
         <!-- <div class="col-md-6 text-end">
            <a href="{{url('/')}}/admin/Quotes/EXPORTCSV" class="btn btn-info mt-3 m-3 waves-effect waves-light"><i class="fa-solid fa-file-csv"></i></a>
            <a href="{{url('admin/Quotes/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
            <a href="{{url('admin/Quotes/add')}}" class="btn btn-primary mt-3 m-3">Add Quotes</a>
         </div> -->
      </div>
      <div class="card-datatable table-responsive">
         <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
            
            <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
               <thead>
                  <tr>
                     <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                     <th>ID</th>
                     <th>Subject</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($QuotesModule as $InvoiceModules)
                  <tr class="odd">
                     <td>{{$InvoiceModules->id}}</td>
                     <td>{{$InvoiceModules->subject}}</td>
                     <td><a href="{{url('admin/ETemplatesettings/QuotesModule/home/'.$InvoiceModules->id)}}"><button class="btn btn-primary">View</button></a></td>
                  </tr>
                
                  @endforeach            
               </tbody>
            </table>
            
         </div>
      </div>
   </div>

   <div class="card my-5">
      <div class="row">
         <div class="col-md-6">
            <h5 class="card-header">Ticket Module</h5>
         </div>
         <!-- <div class="col-md-6 text-end">
            <a href="{{url('/')}}/admin/Quotes/EXPORTCSV" class="btn btn-info mt-3 m-3 waves-effect waves-light"><i class="fa-solid fa-file-csv"></i></a>
            <a href="{{url('admin/Quotes/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
            <a href="{{url('admin/Quotes/add')}}" class="btn btn-primary mt-3 m-3">Add Quotes</a>
         </div> -->
      </div>
      <div class="card-datatable table-responsive">
         <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
            
            <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
               <thead>
                  <tr>
                     <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                     <th>ID</th>
                     <th>Subject</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                @foreach($TicketModule as $InvoiceModules)
                  <tr class="odd">
                     <td>{{$InvoiceModules->id}}</td>
                     <td>{{$InvoiceModules->subject}}</td>
                     <td><a href="{{url('admin/ETemplatesettings/TicketEmailSetting/home/'.$InvoiceModules->id)}}"><button class="btn btn-primary">View</button></a></td>
                  </tr>
                
                  @endforeach              
               </tbody>
            </table>
            
         </div>
      </div>
   </div>




  

   <div class="card my-5">
      <div class="row">
         <div class="col-md-6">
            <h5 class="card-header">Client Module</h5>
         </div>
         <!-- <div class="col-md-6 text-end">
            <a href="{{url('/')}}/admin/Quotes/EXPORTCSV" class="btn btn-info mt-3 m-3 waves-effect waves-light"><i class="fa-solid fa-file-csv"></i></a>
            <a href="{{url('admin/Quotes/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
            <a href="{{url('admin/Quotes/add')}}" class="btn btn-primary mt-3 m-3">Add Quotes</a>
         </div> -->
      </div>
      <div class="card-datatable table-responsive">
         <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
            
            <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
               <thead>
                  <tr>
                     <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                     <th>ID</th>
                     <th>Subject</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($ClientModule as $InvoiceModules)
                  <tr class="odd">
                     <td>{{$InvoiceModules->id}}</td>
                     <td>{{$InvoiceModules->subject}}</td>
                     <td><a href="{{url('admin/ETemplatesettings/ClientSettings/home/'.$InvoiceModules->id)}}"><button class="btn btn-primary">View</button></a></td>
                  </tr>
                
                  @endforeach            
               </tbody>
            </table>
            
         </div>
      </div>
   </div>



    <div class="card my-5">
      <div class="row">
         <div class="col-md-6">
            <h5 class="card-header">Other Module</h5>
         </div>
         <!-- <div class="col-md-6 text-end">
            <a href="{{url('/')}}/admin/Quotes/EXPORTCSV" class="btn btn-info mt-3 m-3 waves-effect waves-light"><i class="fa-solid fa-file-csv"></i></a>
            <a href="{{url('admin/Quotes/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
            <a href="{{url('admin/Quotes/add')}}" class="btn btn-primary mt-3 m-3">Add Quotes</a>
         </div> -->
      </div>
      <div class="card-datatable table-responsive">
         <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
            
            <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
               <thead>
                  <tr>
                     <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                     <th>ID</th>
                     <th>Subject</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($OtherModule as $InvoiceModules)
                  <tr class="odd">
                     <td>{{$InvoiceModules->id}}</td>
                     <td>{{$InvoiceModules->subject}}</td>
                     <td><a href="{{url('admin/ETemplatesettings/OtherModule/home/'.$InvoiceModules->id)}}"><button class="btn btn-primary">View</button></a></td>
                  </tr>
                
                  @endforeach                  
               </tbody>
            </table>
            
         </div>
      </div>
   </div>
<!-- <div class="container-xxl flex-grow-1 container-p-y">

           @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
    @if(Session::has('error'))
        <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
    @endif

    <div class="bs-stepper vertical mt-2 linear">
      <div class="bs-stepper-header">
                  <div class="step @if(Session::get('TabViews2')== 'InvoiceModule') active @endif">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="InvoiceModule">
                      <span class="bs-stepper-circle"><i class="fa-brands fa-app-store-ios"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Invoice Module</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>
                    <div class="step @if(Session::get('TabViews2')== 'QuotesModule') active @endif">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="QuotesModule">
                      <span class="bs-stepper-circle"><i class="fa-brands fa-app-store-ios"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Quotes Module</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>
                  <div class="line"></div>
                  <div class="step @if(Session::get('TabViews2')== 'Ticket') active @endif">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Ticket">
                      <span class="bs-stepper-circle"><i class="fa-solid fa-coins"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Ticket Email Module</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div> -->
                  <!-- <div class="line"></div>
                  <div class="step @if(Session::get('TabViews2')== 'Company') active @endif">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Company">
                      <span class="bs-stepper-circle"><i class="fas fa-building"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Company</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>  -->
                 
                 <!--  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Invoice">
                      <span class="bs-stepper-circle"><i class="fas fa-file-invoice"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Invoice</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div> 
                  
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Leads">
                      <span class="bs-stepper-circle"><i class="fas fa-chalkboard"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Leads</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="LeaveS">
                      <span class="bs-stepper-circle"><i class="fas fa-sign-out-alt"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Leave</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Mail">
                      <span class="bs-stepper-circle"><i class="fas fa-envelope"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Mail</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>  
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Module">
                      <span class="bs-stepper-circle"><i class="fab fa-buromobelexperte"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Module</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div> 
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Notice">
                      <span class="bs-stepper-circle"><i class="far fa-sticky-note"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Notice</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>  
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="PaymentMethod">
                      <span class="bs-stepper-circle"><i class="fas fa-hand-holding-usd"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Payment Method</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div> 
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="ProjectCategory">
                      <span class="bs-stepper-circle"><i class="fas fa-project-diagram"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Project Category</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>  
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Profile">
                      <span class="bs-stepper-circle"><i class="ti ti-users ti-sm"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Profile</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Performance">
                      <span class="bs-stepper-circle"><i class="fas fa-chart-line"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Performance</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div> 
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="PayRoll">
                      <span class="bs-stepper-circle"><i class="fas fa-user-tag"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">PayRoll</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div> 
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Role">
                      <span class="bs-stepper-circle"><i class="fas fa-user-tag"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Role</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div> 
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="ServiceAutomation">
                      <span class="bs-stepper-circle"><i class="fas fa-cogs"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Service Automation</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="SmSEmail">
                      <span class="bs-stepper-circle"> <i class="fas fa-sms"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">SmS/Email Template</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Security">
                      <span class="bs-stepper-circle"><i class="fas fa-unlock-alt"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Security</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="SecurityIP">
                      <span class="bs-stepper-circle"><i class="fas fa-key"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Security IP</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Storage">
                      <span class="bs-stepper-circle"><i class="fas fa-hdd"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Storage</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>
                  <div class="line"></div> 
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="TaskCategory">
                      <span class="bs-stepper-circle"><i class="fas fa-tasks"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Task Category</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div> -->
              <!--     <div class="line"></div> 
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Tax">
                      <span class="bs-stepper-circle"><i class="fa-brands fa-square-pied-piper"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Tax</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div> -->
                  <!-- <div class="line"></div> 
                   <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="TicketEmail">
                      <span class="bs-stepper-circle"><i class="fas fa-ticket-alt"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Ticket-Email</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>  --> 
      <!-- </div>
      <div class="bs-stepper-content"></div>
    </div>
</div> -->
</div>
<!-- <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
 @if(session('TabViews2'))
    <script>
      window.onload = function() {
    var tabs = "{{ session('TabViews2') }}";
    if (tabs) {
        Tab(tabs);
    }
}
    </script>
@endif
<script type="text/javascript">
  function Tab(value) {
    // Remove 'active' class from all tabs
    $('.bs-stepper-header .step').removeClass('active');

    // Add 'active' class to the clicked tab
    $('.bs-stepper-header .step button[value="' + value + '"]').parent().addClass('active');

    // AJAX request to load tab content
    $.ajax({
        url: "{{ url('admin/ETempleteSettings/TabView') }}",
        method: 'GET',
        data: { type: value },
        success: function (response) {
            $('.bs-stepper-content').html(response);
            $('.select2').select2();

        CKEDITOR.replace('product_description', {
            extraPlugins: 'scayt',
            scayt_autoStartup: true,
     
    });
        },
        error: function () {
            // Handle error if needed
        }
    });
  }
</script> -->



@endsection