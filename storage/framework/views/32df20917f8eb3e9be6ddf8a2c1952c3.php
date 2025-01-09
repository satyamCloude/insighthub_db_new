
<style type="text/css">
      .bs-stepper-content{
        padding: 0px 10px 0px 10px !important;
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
   <h4 class="py-3 mb-4"><span class="text-muted fw-light">Template's /</span> Home</h4>
   <?php if(Session::has('success')): ?>
   <div class="alert alert-success" role="alert"><?php echo e(Session::get('success')); ?></div>
   <?php endif; ?>
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
            <a href="<?php echo e(url('admin/ETemplatesettings/InvoiceModule/add')); ?>" class="btn btn-primary mt-3 m-3">Add Invoice Module</a>
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
                <?php $__currentLoopData = $InvoiceModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $InvoiceModules): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr class="odd">
                     <td><?php echo e($InvoiceModules->id); ?></td>
                     <td><?php echo e($InvoiceModules->name); ?></td>
                     <td><?php echo e($InvoiceModules->subject); ?></td>
                     <td><a href="<?php echo e(url('admin/ETemplatesettings/InvoiceModule/home/'.$InvoiceModules->id)); ?>"><button class="btn btn-primary">View</button></a></td>
                  </tr>
                
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                
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
            <a href="<?php echo e(url('admin/ETemplatesettings/QuotesModule/add')); ?>" class="btn btn-primary mt-3 m-3">Add Quotes Module</a>
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
                  <?php $__currentLoopData = $QuotesModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $InvoiceModules): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr class="odd">
                     <td><?php echo e($InvoiceModules->id); ?></td>
                     <td><?php echo e($InvoiceModules->name); ?></td>
                     <td><?php echo e($InvoiceModules->subject); ?></td>
                     <td><a href="<?php echo e(url('admin/ETemplatesettings/QuotesModule/home/'.$InvoiceModules->id)); ?>"><button class="btn btn-primary">View</button></a></td>
                  </tr>
                
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>            
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
                <?php $__currentLoopData = $TicketModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $InvoiceModules): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr class="odd">
                     <td><?php echo e($InvoiceModules->id); ?></td>
                     <td><?php echo e($InvoiceModules->name); ?></td>
                     <td><?php echo e($InvoiceModules->subject); ?></td>
                     <td><a href="<?php echo e(url('admin/ETemplatesettings/TicketEmailSetting/home/'.$InvoiceModules->id)); ?>"><button class="btn btn-primary">View</button></a></td>
                  </tr>
                
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>              
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
            <a href="<?php echo e(url('admin/ETemplatesettings/LoginRegisterModule/add')); ?>" class="btn btn-primary mt-3 m-3">Add</a>
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
                  <?php $__currentLoopData = $LoginRegisterModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $InvoiceModules): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr class="odd">
                     <td><?php echo e($InvoiceModules->id); ?></td>
                     <td><?php echo e($InvoiceModules->name); ?></td>
                     <td><?php echo e($InvoiceModules->subject); ?></td>
                     <td><a href="<?php echo e(url('admin/ETemplatesettings/LoginRegisterModule/home/'.$InvoiceModules->id)); ?>"><button class="btn btn-primary">View</button></a></td>
                  </tr>
                
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                  
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
            <a href="<?php echo e(url('admin/ETemplatesettings/InOfficeModule/add')); ?>" class="btn btn-primary mt-3 m-3">Add</a>
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
                  <?php $__currentLoopData = $InOfficeModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $InvoiceModules): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr class="odd">
                     <td><?php echo e($InvoiceModules->id); ?></td>
                     <td><?php echo e($InvoiceModules->name); ?></td>
                     <td><?php echo e($InvoiceModules->subject); ?></td>
                     <td><a href="<?php echo e(url('admin/ETemplatesettings/InOfficeModule/home/'.$InvoiceModules->id)); ?>"><button class="btn btn-primary">View</button></a></td>
                  </tr>
                
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                  
               </tbody>
            </table>
         </div>
      </div>
   </div>

</div>

<?php /**PATH /home/insighthub/public_html/resources/views/admin/ETemplatesettings/index.blade.php ENDPATH**/ ?>