
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
            <a href="{{url('admin/ETemplatesettings/InvoiceModule/add')}}" class="btn btn-primary mt-3 m-3">Add Invoice Module</a>
         </div> -->
      </div>
      <div class="card-datatable table-responsive">
         <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
            
            <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
               <thead>
                  <tr>
                     <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Subject</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                @foreach($InvoiceModule as $InvoiceModules)
                  <tr class="odd">
                     <td>{{$InvoiceModules->id}}</td>
                     <td>{{$InvoiceModules->name}}</td>
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
            <a href="{{url('admin/ETemplatesettings/QuotesModule/add')}}" class="btn btn-primary mt-3 m-3">Add Quotes Module</a>
         </div> -->
      </div>
      <div class="card-datatable table-responsive">
         <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
            
            <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
               <thead>
                  <tr>
                     <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Subject</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($QuotesModule as $InvoiceModules)
                  <tr class="odd">
                     <td>{{$InvoiceModules->id}}</td>
                     <td>{{$InvoiceModules->name}}</td>
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
   
      </div>
      <div class="card-datatable table-responsive">
         <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
            
            <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
               <thead>
                  <tr>
                     <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Subject</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                @foreach($TicketModule as $InvoiceModules)
                  <tr class="odd">
                     <td>{{$InvoiceModules->id}}</td>
                     <td>{{$InvoiceModules->name}}</td>
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
            <h5 class="card-header">Login and Registration</h5>
         </div>
         <!-- <div class="col-md-6 text-end">
            <a href="{{url('admin/ETemplatesettings/LoginRegisterModule/add')}}" class="btn btn-primary mt-3 m-3">Add</a>
         </div> -->
      </div>
      <div class="card-datatable table-responsive">
         <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
            
            <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
               <thead>
                  <tr>
                     <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Subject</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($LoginRegisterModule as $InvoiceModules)
                  <tr class="odd">
                     <td>{{$InvoiceModules->id}}</td>
                     <td>{{$InvoiceModules->name}}</td>
                     <td>{{$InvoiceModules->subject}}</td>
                     <td><a href="{{url('admin/ETemplatesettings/LoginRegisterModule/home/'.$InvoiceModules->id)}}"><button class="btn btn-primary">View</button></a></td>
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
            <h5 class="card-header">InOffice</h5>
         </div>
         <!-- <div class="col-md-6 text-end">
            <a href="{{url('admin/ETemplatesettings/InOfficeModule/add')}}" class="btn btn-primary mt-3 m-3">Add</a>
         </div> -->
      </div>
      <div class="card-datatable table-responsive">
         <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
            
            <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
               <thead>
                  <tr>
                     <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Subject</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($InOfficeModule as $InvoiceModules)
                  <tr class="odd">
                     <td>{{$InvoiceModules->id}}</td>
                     <td>{{$InvoiceModules->name}}</td>
                     <td>{{$InvoiceModules->subject}}</td>
                     <td><a href="{{url('admin/ETemplatesettings/InOfficeModule/home/'.$InvoiceModules->id)}}"><button class="btn btn-primary">View</button></a></td>
                  </tr>
                
                  @endforeach                  
               </tbody>
            </table>
         </div>
      </div>
   </div>

</div>

