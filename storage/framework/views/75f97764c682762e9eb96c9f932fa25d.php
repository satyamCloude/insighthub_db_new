<?php $__env->startSection('title', 'Job Role'); ?>
<?php $__env->startSection('content'); ?>
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Job Role /</span> Edit</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Edit Detail's</h5>
            <div class="action-btns">
              <a href="<?php echo e(url('Employee/JobRole/home')); ?>" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="<?php echo e(url('Employee/JobRole/update/'.$JobRole->id)); ?>" method="post" enctype="multipart/form-data"> 
            <?php echo csrf_field(); ?>
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="name" class="form-label">Job Role Name <span class="text-danger">*</span></label>
                      <input type="name" class="form-control" name="name"  <?php if(isset($JobRole) && $JobRole->name): ?> value="<?php echo e($JobRole->name); ?>" <?php endif; ?>  placeholder="Job Role Name"/>
                </div>
                <div class="col-md-6">
                      <label for="email" class="form-label">Employee Name <span class="text-danger">*</span></label>
                      <select class="form-control select2" name="assign_emp_id[]" multiple>
                        <?php $__currentLoopData = $Employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option  <?php if(in_array($emp->id,explode(',',$JobRole->assign_emp_id))): ?> selected <?php endif; ?> value="<?php echo e($emp->id); ?>" value="<?php echo e($emp->id); ?>"><?php echo e($emp->first_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                      </select>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="<?php echo e(url('Employee/JobRole/home')); ?>" type="button" class="btn btn-outline-danger">Discard</a>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/Employee/Humanesources/JobRole/edit.blade.php ENDPATH**/ ?>