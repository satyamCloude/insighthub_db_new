<?php $__env->startSection('title', 'TimeShift'); ?>
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
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">TimeShift /</span> Home</h4>
    <?php if(Session::has('success')): ?>
   <div class="alert alert-success" role="alert"><?php echo e(Session::get('success')); ?></div>
    <?php endif; ?>
    
    
    
  <!-- Users List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Time Shift's List</h5>
      </div>
      <!--<div class="col-md-6 text-end pe-4">-->
      <!--  <form method="GET" action="">    -->
      <!--      <label>Search: <input type="search" value="" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3">-->
      <!--      </label>-->
      <!--  </form>-->
      <!--</div>-->
    </div>
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
    <thead>
        <tr>
            <th>Employee</th>
            <th>Monday</th>
            <th>Tuesday</th>
            <th>Wednesday</th>
            <th>Thursday</th>
            <th>Friday</th>
            <th>Saturday1</th>
            <th>Saturday2</th>
            <th>Saturday3</th>
            <th>Saturday4</th>
            <th>Sunday</th>
        </tr>
    </thead>
   <tbody>
<?php $__empty_1 = true; $__currentLoopData = $TimeShift; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <tr>
        <td class="text-center">
            <img class="avatar rounded-circle" src="<?php echo e($user->profile_img); ?>"><br/>
            <?php echo e($user->first_name); ?>

        </td>
        
        <!-- Display schedule for Monday to Friday -->
        <?php for($day = 1; $day <= 5; $day++): ?>
             <td >
                <?php if($user->weekly_off_id == $day ): ?>
                  <span class="text-success"> Week Off</span>
                <?php elseif($user->additional_week_off_first == $day || $user->additional_week_off_second ==  $day || $user->additional_week_off_third == $day || $user->additional_week_off_fourth == $day  ): ?>
                 <span class="text-warning"> Week Off</span>
                <?php else: ?>
                <?php echo e(\Carbon\Carbon::parse($user->StartTime)->format('H:i') . ' - ' . \Carbon\Carbon::parse($user->EndTime)->format('H:i')); ?>

                <?php endif; ?>
            </td>
        <?php endfor; ?>
        
        <!-- Display schedule for Saturday1, Saturday2, Saturday3, Saturday4 -->
        <td>
            <?php if($user->weekly_off_id == 6): ?>
               <span class="text-success"> Week Off</span>
            <?php elseif( $user->additional_week_off_first == 6): ?>
               <span class="text-warning"> Week Off</span>
            <?php else: ?>
                <?php echo e(\Carbon\Carbon::parse($user->StartTime)->format('H:i') . ' - ' . \Carbon\Carbon::parse($user->EndTime)->format('H:i')); ?>

            <?php endif; ?>
        </td>
        <td>
            <?php if($user->weekly_off_id == 6): ?>
                <span class="text-success"> Week Off</span>
            <?php elseif($user->additional_week_off_second == 6): ?>
                <span class="text-warning"> Week Off</span>
            <?php else: ?>
                <?php echo e(\Carbon\Carbon::parse($user->StartTime)->format('H:i') . ' - ' . \Carbon\Carbon::parse($user->EndTime)->format('H:i')); ?>

            <?php endif; ?>
        </td>
        <td>
            <?php if($user->weekly_off_id == 6 ): ?>
               <span class="text-success"> Week Off</span>
            <?php elseif($user->additional_week_off_third == 6): ?>
            <span class="text-warning"> Week Off</span>
            <?php else: ?>
                <?php echo e(\Carbon\Carbon::parse($user->StartTime)->format('H:i') .  ' - ' .  \Carbon\Carbon::parse($user->EndTime)->format('H:i')); ?>

            <?php endif; ?>
        </td>
        <td>
            <?php if($user->weekly_off_id == 6): ?>
                 <span class="text-success"> Week Off</span>
            <?php elseif($user->additional_week_off_fourth == 6): ?>
             <span class="text-warning"> Week Off</span>
            <?php else: ?>
                <?php echo e(\Carbon\Carbon::parse($user->StartTime)->format('H:i') .  ' - ' .  \Carbon\Carbon::parse($user->EndTime)->format('H:i')); ?>

            <?php endif; ?>
        </td>
        
        <!-- Display schedule for Sunday -->
        <td>
            
            
            
            <?php if($user->weekly_off_id == 7): ?>
                <span class="text-success"> Week Off</span>
            <?php else: ?>
                <?php echo e(\Carbon\Carbon::parse($user->StartTime)->format('H:i')  . ' - ' .  \Carbon\Carbon::parse($user->EndTime)->format('H:i')); ?>

            <?php endif; ?>
        </td>
        
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <tr>
        <td class="text-center" colspan="11">No Data Found</td>
    </tr>
<?php endif; ?> 


</tbody>

</table>

          <div class="p-1" style="float: right;">
              <?php echo e($TimeShift->links()); ?>

          </div>
      </div>
      </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/Humanesources/TimeShift/roaster.blade.php ENDPATH**/ ?>