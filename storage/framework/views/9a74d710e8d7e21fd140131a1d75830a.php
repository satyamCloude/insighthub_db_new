<?php $__env->startSection('title', 'Create'); ?>
<?php $__env->startSection('content'); ?>
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
   <h4 class="py-3 mb-4"><span class="text-muted fw-light">Goal /</span> Edit</h4>
   <!-- Sticky Actions -->
   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
               <h5 class="card-title mb-sm-0 me-2">Edit Detail's</h5>
               <div class="action-btns">
                  <a href="<?php echo e(url('admin/Goal/home')); ?>" class="btn btn-label-primary me-3">
                  <span class="align-middle"> Back</span>
                  </a>
               </div>
            </div>
            <form action="<?php echo e(url('admin/Goal/update/'.$Goal->id)); ?>" method="post" enctype="multipart/form-data">
               <?php echo csrf_field(); ?>
               <div class="card-body">
                  <h5 class="mb-4">1. General Details</h5>
                  <div class="row mb-4">
                     <div class="col-md-6">
                        <label for="date" class="form-label">Employee <span class="text-danger">*</span></label>
                        <select name="employee_id" class="form-control select2" >
                        <?php $__currentLoopData = $Employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php if($Goal && $Goal->employee_id == $Emp->id): ?> selected <?php endif; ?> value="<?php echo e($Emp->id); ?>"><?php echo e($Emp->first_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                     </div>
                     <!-- <div class="col-md-6">
                        <label for="job_role_id" class="form-label">Job Role <span class="text-danger">*</span></label>
                        <select name="job_role_id" class="form-control select2">
                        <?php $__currentLoopData = $Jobroles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php if($Goal && $Goal->job_role_id == $Job->id): ?> selected <?php endif; ?> value="<?php echo e($Job->id); ?>"><?php echo e($Job->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                     </div> -->
                     <div class="col-md-6">
                        <label for="goal_value" class="form-label">Goal Value <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" <?php if($Goal && $Goal->goal_value): ?> value="<?php echo e($Goal->goal_value); ?>" <?php endif; ?> name="goal_value" placeholder="12" />
                     </div>
                  </div>
                  <div class="row mb-4">
                     <div class="col-md-6">
                        <label for="archieved_value" class="form-label">Achieved Value <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" <?php if($Goal && $Goal->archieved_value): ?> value="<?php echo e($Goal->archieved_value); ?>" <?php endif; ?> name="archieved_value" placeholder="12" />
                     </div>
                     <div class="col-md-6">
                        <label for="months_id" class="form-label">Months <span class="text-danger">*</span></label>
                        <select name="months_id" class="form-control select2" id="months">
                        <?php $__currentLoopData = $Months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php if($Goal && $Goal->months_id == $Month->id): ?> selected <?php endif; ?> value="<?php echo e($Month->id); ?>"><?php echo e($Month->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                     </div>
                  </div>
                  <div class="row mb-4">
                     <div class="col-md-6">
                        <label for="currency_id" class="form-label">Currency <span class="text-danger">*</span></label>
                        <select name="currency_id" class="form-control select2" >
                        <?php $__currentLoopData = $Currency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Curr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php if($Goal && $Goal->currency_id == $Curr->id): ?> selected <?php endif; ?> value="<?php echo e($Curr->id); ?>"><?php echo e($Curr->prefix); ?> <?php echo e($Curr->code); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                     </div>
                  </div>
                  <div class="row mb-4">
                     <div class="col-md-12">
                        <label for="note" class="form-label">Notes <span class="text-danger">*</span></label>
                        <div class="editor-container">
                           <div class="full-editor geteditor"><?php if($Goal && $Goal->note): ?> <?php echo $Goal->note; ?> <?php endif; ?></div>
                           <input type="hidden" name="note" <?php if($Goal && $Goal->note): ?> value="<?php echo e($Goal->note); ?>" <?php endif; ?> class="hidden-field">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card-footer">
                  <div class="row mb-4">
                     <div class="col-md-6 text-end" >
                        <a href="<?php echo e(url('admin/Goal/home')); ?>" type="button" class="btn btn-outline-danger">Discard</a>
                     </div>
                     <div class="col-md-6">
                        <button type="submit" class="btn btn-success">Submit</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!-- /Sticky Actions -->
</div>
<!-- / Content -->
<script>
   $(document).ready(function () {
     // Function to update the hidden field based on the editor content
     function updateHiddenField(index) {
       var editorContentText = $(".full-editor.geteditor").eq(index).html();
       console.log("Editor " + (index + 1) + " Text content: " + editorContentText);
   
       // Update the value of the hidden field based on the index
       $('.hidden-field').eq(index).val(editorContentText);
     }
   
     // Use event delegation to handle keyup and blur on any .full-editor.geteditor
     $(document).on('keyup blur', '.full-editor.geteditor', function () {
       // Get the index of the editor
       var index = $(".full-editor.geteditor").index(this);
   
       // Update the corresponding hidden field
       updateHiddenField(index);
     });
   });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/sales/Goal/edit.blade.php ENDPATH**/ ?>