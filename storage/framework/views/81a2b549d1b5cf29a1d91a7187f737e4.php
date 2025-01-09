<?php $__env->startSection('title', 'Task'); ?>
<?php $__env->startSection('content'); ?>
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Task /</span> Add</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="<?php echo e(url('admin/Task/home')); ?>" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="<?php echo e(url('admin/Task/store')); ?>" method="post" enctype="multipart/form-data"> 
            <?php echo csrf_field(); ?>
            <div class="card-body">
              <h5 class="mb-4">1. Company Details</h5>
              <div class="row "> 
                <div class="col-sm-6 mb-4">
                      <label for="project_name" class="form-label">Title  <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="task_name" required/>
                </div>
                <div class="col-sm-6 mb-4">
                      <label for="project_name" class="form-label">Task category <span class="text-danger">*</span></label>
                      <select class="form-select select2" name="Taskcategory_id">
                        <?php $__currentLoopData = $TaskCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $TaskCategorys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option value="<?php echo e($TaskCategorys->id); ?>"><?php echo e($TaskCategorys->category_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                </div>
                <div class="col-sm-6 mb-4">
                      <label for="client_id" class="form-label">Project <span class="text-danger">*</span></label>
                      <select class="form-select select2" name="project_id" required>
                          <?php $__currentLoopData = $Project; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($Project->id); ?>"><?php echo e($Project->project_name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                </div>
                <div class="col-sm-6 mb-4"></div>
                <div class="col-sm-3 mb-4">
                      <label for="project_name" class="form-label">Start Date  <span class="text-danger">*</span></label>
                      <input type="date" class="form-control" name="startDate" required/>
                </div>
                <div class="col-sm-3 mb-4">
                      <label for="project_name" class="form-label endDate">End Date  <span class="text-danger">*</span></label>
                      <input type="date" class="form-control endDate" name="endDate" required/>
                </div>
                <div class="col-sm-6 mb-4">
                     <div class="form-check mt-4">
                      <input class="form-check-input mr-0 mr-lg-2 mr-md-2" type="checkbox" value="yes" name="without_duedate" onclick="withoutduedate()" autocomplete="off">
                          <label class="form-check-label cursor-pointer" for="without_duedate">Without Due Date</label>
                      </div>
                </div>
                <div class="col-sm-12 mb-4">
                      <label for="client_id" class="form-label">Assigned To <span class="text-danger">*</span></label>
                      <select class="form-select select2" name="AssignedTo[]" multiple required>
                          <?php $__currentLoopData = $Employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($Employee->id); ?>"><?php echo e($Employee->first_name); ?> <?php echo e($Employee->last_name); ?> (#<?php echo e($Employee->id); ?>) <br>| <?php echo e($Employee->jobrole); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                </div>
                <div class="col-sm-12 mb-4">
                      <label for="Description" class="form-label">Description <span class="text-danger">*</span></label>
                      <div class="editor-container">
                        <div class="full-editor geteditor"></div>
                        <input type="hidden" name="Description" class="hidden-field">
                      </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="d-flex">
              <h3 class="m-2">Other Details</h3>
              <span id="Icone"><i onclick="Other()" class="fa-solid fa-arrow-up mt-4 mb-1"></i></span>
            </div>
            <hr>
            <div class="card-body">
              <div class="row mb-4" id="showOther" style="display: none;"> 
                <div class="col-sm-6 mb-4">
                      <label for="priority_id" class="form-label">Priority <span class="text-danger">*</span></label>
                      <select class="form-select select2" name="priority_id">
                         <option value="1">High</option>
                         <option value="2">Medium</option>
                         <option value="3">Low</option>
                      </select>
                </div>
                <div class="col-sm-6 mb-4">
                      <label for="status_id" class="form-label">Status <span class="text-danger">*</span></label>
                      <select class="form-select select2" name="status_id">
                         <option value="1">In Progress</option>
                         <option value="2">Completed</option>
                         <option value="3">Over Due</option>
                         <option value="4">Cancel</option>
                      </select>
                </div>
                <div class="col-sm-12 mb-4">
                      <label for="Addfile" class="form-label">Add File <span class="text-danger">*</span></label>
                      <input type="file" class="form-control" name="Addfile">
                </div>
              </div>               
            </div>               
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="<?php echo e(url('admin/Task/home')); ?>" type="button" class="btn btn-outline-danger">Discard</a>
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
<script>
  function withoutduedate() {
    $('.endDate').toggle();
  }
 function Other() {
  $('#showOther').toggle();
  var iconElement = $('#Icone i');
  if ($('#showOther').is(':visible')) {
    // If 'showOther' is visible, set the arrow-down icon
    iconElement.attr('class', 'fa-solid fa-arrow-down mt-4 mb-1');
  } else {
    // If 'showOther' is hidden, set the arrow-up icon
    iconElement.attr('class', 'fa-solid fa-arrow-up mt-4 mb-1');
  }
}

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/Task/create.blade.php ENDPATH**/ ?>