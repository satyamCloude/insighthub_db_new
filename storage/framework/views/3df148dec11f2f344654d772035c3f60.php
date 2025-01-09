<?php $__env->startSection('title', 'Goal'); ?>
<?php $__env->startSection('content'); ?>
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
</style>
<div class="container-xxl flex-grow-1 container-p-y">
   <h4 class="py-3 mb-4"><span class="text-muted fw-light">Goal /</span> Home</h4>
   <?php if(Session::has('success')): ?>
   <div class="alert alert-success" role="alert"><?php echo e(Session::get('success')); ?></div>
   <?php endif; ?>
   <div class="row g-4 mb-4">
      <div class="col-sm-6 col-xl-3">
         <div class="card">
            <div class="card-body">
               <div class="d-flex align-items-start justify-content-between">
                  <div class="content-left">
                     <span>Total assigned</span>
                     <div class="d-flex align-items-center my-2">
                        <h3 class="mb-0 me-2"><?php echo e($total_goal_value); ?></h3>
                        <!-- <p class="text-success mb-0">0</p> -->
                     </div>
                     <p class="mb-0"><br/></p>
                  </div>
                  <div class="avatar">
                     <span class="avatar-initial rounded bg-label-primary">
                     <i class="fa fa-inr ti-sm"></i>
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
                     <span>Total achieved</span>
                     <div class="d-flex align-items-center my-2">
                        <h3 class="mb-0 me-2"><?php echo e($total_achieve_value); ?></h3>
                        <!-- <p class="text-success mb-0"></p> -->
                     </div>
                     <p class="mb-0"><br/></p>
                  </div>
                  <div class="avatar">
                     <span class="avatar-initial rounded
                        <?php if($status < 40): ?>
                        bg-label-danger
                        <?php elseif($status > 40 && $status < 70): ?>
                        bg-label-warning
                        <?php else: ?>
                        bg-label-success
                        <?php endif; ?> ">
                     <i class="fa fa-inr ti-sm"></i>
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
                     <span>Month top achiever</span>
                     <div class="d-flex align-items-center my-2">
                        <h3 class="mb-0 me-2"><?php echo e($monthlyAchiever? $monthlyAchiever->total_archieved_value : 0); ?> / <?php echo e($monthlyAchiever ? $monthlyAchiever->total_goal_value : 0); ?></h3>
                        <!-- <p class="text-danger mb-0"></p> -->
                     </div>
                     <p class="mb-0">Employee Name : <?php echo e($monthlyAchiever ? $monthlyAchiever->first_name : ''); ?></p>
                  </div>
                  <div class="avatar">
                     <span class="avatar-initial rounded bg-label-primary">
                     <?php if($monthlyAchiever && $monthlyAchiever->profile_img): ?>
                     <img src="<?php echo e($monthlyAchiever ? $monthlyAchiever->profile_img : ''); ?>">
                     <?php else: ?>
                     <span class="avatar-initial rounded"></span>
                     <?php endif; ?>
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
                     <span>Annual top achiever</span>
                     <div class="d-flex align-items-center my-2">
                        <h3 class="mb-0 me-2"><?php echo e($annualAchiever ? $annualAchiever->total_achieved_value : 0); ?> / <?php echo e($annualAchiever ? $annualAchiever->total_goal_value : 0); ?></h3>
                        <!-- <p class="text-danger mb-0"></p> -->
                     </div>
                     <p class="mb-0">Employee Name : <?php echo e($annualAchiever ? $annualAchiever->first_name : ''); ?></p>
                  </div>
                  <div class="avatar">
                     <span class="avatar-initial rounded bg-label-primary">
                     <?php if($annualAchiever && $annualAchiever->profile_img): ?>
                     <img src="<?php echo e($annualAchiever ? $annualAchiever->profile_img : ''); ?>">
                     <?php else: ?>
                     <span class="avatar-initial rounded"></span>
                     <?php endif; ?>
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
            <h5 class="card-header">Goal's List</h5>
         </div>
         <div class="col-md-6 text-end">
            <a href="<?php echo e(url('admin/Goal/home')); ?>" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
            <a href="<?php echo e(url('admin/Goal/add')); ?>" class="btn btn-primary mt-3 m-3">Add Goal</a>
         </div>
      </div>
      <div class="card-datatable table-responsive">
         <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
            <div class="row">
               <div class="col-sm-12 col-md-5 mt-3">
                  <form>
                     <div class="input-group input-daterange" id="bs-datepicker-daterange">
                        <input type="date" id="dateRangePicker" placeholder="MM/DD/YYYY" class="form-control fromDate" name="from" value="<?php echo e(request()->get('from')); ?>" >
                        <span class="input-group-text">to</span>
                        <input type="date" placeholder="MM/DD/YYYY" class="form-control toDate" name="to" value="<?php echo e(request()->get('to')); ?>">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                     </div>
                  </form>
               </div>
               <div class="col-sm-12 col-md-7 d-flex justify-content-center justify-content-md-end">
                  <div id="DataTables_Table_3_filter" class="dataTables_filter">
                     <form method="GET" action="">    
                        <label>Search: <input value="<?php echo e($searchTerm); ?>" type="search" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                     </form>
                  </div>
               </div>
            </div>  
            <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
               <thead>
                  <tr>
                     <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                     <th>ID</th>
                     <th>EMPLOYEE NAME</th>
                     <!-- <th>DESIGNATION</th> -->
                     <th>GOAL VALUE</th>
                     <th>ACHIEVED VALUE</th>
                     <th>ACHIEVED %</th>
                     <th>SATAUS</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody id="result">
                  <?php if(count($Goal) > 0): ?>
                  <?php $__currentLoopData = $Goal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                  $percentage = 0;
                  $progressClass = 'bg-danger';
                  $textClass = 'text-danger';
                  if($user && $user->goal_value != 0){
                  $percentage = ($user->archieved_value / $user->goal_value) * 100;
                  if ($percentage > 2 && $percentage < 100) {
                  $progressClass = 'bg-primary';
                  $textClass = 'text-primary';
                  } elseif ($percentage == 100) {
                  $progressClass = 'bg-success';
                  $textClass = 'text-success';
                  }
                  }
                  ?>
                  <tr class="odd">
                     <td><?php echo e($key + 1); ?> </td>
                     <td>
                        <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="<?php echo e(isset($user->profile_img) ? $user->profile_img : url('public/images/21104.png')); ?>" height="30" width="30" alt="User avatar" /><a href="<?php echo e(url('admin/Goal/view/'.$user->id.'/'.$user->employee_id)); ?>"><?php echo e($user->first_name); ?></a>
                        <div style="font-size:12px;margin-left: 46px;margin-top: -11px;"><?php echo e($user->job_name); ?></div>
                     </td>
                     <!-- <td><?php if($user && $user->job_name): ?> <?php echo e($user->job_name); ?> <?php endif; ?></td> -->
                     <td><?php if($user && $user->goal_value): ?> <?php echo e($user->goal_value); ?> <?php endif; ?></td>
                     <td>
                        <span class="<?php echo e($textClass); ?>">
                        <?php if($user && $user->archieved_value): ?> <?php echo e($user->archieved_value); ?> <?php endif; ?>
                     </td>
                     </span>
                     <td>
                        <?php if($user && $user->goal_value != 0): ?>
                        <div class="progress">
                           <div class="progress-bar <?php echo e($progressClass); ?> progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo e($percentage); ?>%" aria-valuenow="<?php echo e($percentage); ?>" aria-valuemin="0" aria-valuemax="100"><?php echo e(number_format($percentage, 2)); ?>%</div>
                        </div>
                        <?php else: ?>
                        N/A
                        <?php endif; ?>
                     </td>
                     <td>
                        <?php switch($user->status):
                        case ('1'): ?>
                        <span class="badge bg-label-danger">Failed</span>
                        <?php break; ?>
                        <?php case ('2'): ?>
                        <span class="badge bg-label-primary">InProgress</span>
                        <?php break; ?>
                        <?php case ('3'): ?>
                        <span class="badge bg-label-success">Achieved</span>
                        <?php break; ?>
                        <?php default: ?>
                        <span></span>
                        <?php endswitch; ?>
                     </td>
                     <td>
                        <div class="btn-group">
                           <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                           <i class="ti ti-dots-vertical"></i>
                           </button>
                           <ul class="dropdown-menu dropdown-menu-end" style="">
                              <li><a class="dropdown-item" href="<?php echo e(url('admin/Goal/view/'.$user->id.'/'.$user->employee_id)); ?>">View</a></li>
                              <?php if($user->goalCreateMonth >= date('m')): ?>
                              <li><a class="dropdown-item" href="<?php echo e(url('admin/Goal/edit/'.$user->id)); ?>">Edit</a></li>
                              <?php endif; ?>
                              <li><button class="dropdown-item delete_debtcase" url="<?php echo e(url('admin/Goal/delete/'.$user->id)); ?>" id="<?php echo e($user->id); ?>">Delete</button></li>
                           </ul>
                        </div>
                     </td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php else: ?>
                  <tr>
                     <td class="text-center" colspan="8">No Data Found</td>
                  </tr>
                  <?php endif; ?>             
               </tbody>
            </table>
            <div class="p-1" style="float: right;">
               <?php echo e($Goal->links()); ?>

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
         message: "Are you sure! you want to delete this goal?",
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/insighthub_db/resources/views/admin/sales/Goal/home.blade.php ENDPATH**/ ?>