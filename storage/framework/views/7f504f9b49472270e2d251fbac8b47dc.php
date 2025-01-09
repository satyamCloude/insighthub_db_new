    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Edit Detail's</h5>
            <div class="action-btns">
                <button type="button"  class="btn btn-warning mt-3 m-3" onclick="Tab(value)" value="Role">
                <span class="align-middle"> Back</span>
              </button>
            </div>
          </div>
          <form action="<?php echo e(url('admin/Role/update/'.$Role->id)); ?>" method="post" enctype="multipart/form-data"> 
            <?php echo csrf_field(); ?>
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="name" class="form-label"><h5>Name <span class="text-danger">*</span></h5></label>
                      <input type="text" class="form-control" <?php if($Role && $Role->name): ?> value="<?php echo e($Role->name); ?>" <?php endif; ?> name="name" />
                </div>
                <div class="col-md-6">
                      <label for="status" class="form-label"><h5>Status <span class="text-danger">*</span></h5></label>
                      <select name="status" class="form-select">
                            <option <?php if($Role && $Role->status == '1'): ?> selected <?php endif; ?> value="1">Active</option>
                            <option <?php if($Role && $Role->status == '2'): ?> selected <?php endif; ?> value="2">In Active</option>
                    </select>
                </div>
            </div>
              <hr>
              <h5 class="mb-4">2. Permission</h5>
               <div class="table-sm-responsive role-permissions" id="role-permission-2" style="position: static; zoom: 1;">
                                <table class="table table-bordered mt-3 permisison-table table-hover" id="example">
                                  <thead class="thead-light">
                                    <tr>
                                      <th width="20%">Module</th>
                                       <th width="16%">View</th>
                                       <th width="16%">Add</th>
                                       <th width="16%">Update</th>
                                       <th width="16%">Delete</th>
                                       <th width="2%">#</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                       <?php $__currentLoopData = $Permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $Per): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <tr>
                                        <!-- <td></td> -->
                                        <td><?php echo e($Per->name); ?>

                                            <input type="hidden" name="permission_id[]" value="<?php echo e($Per->id); ?>" >
                                        </td>
                                        <td>
                                            <select class="select-picker role-permission-select border-0" name="view[]" data-permission-id="<?php echo e($Per->id); ?>" data-role-id="2">
                                              <option <?php if(isset($RoleAccess[$key]) && $RoleAccess[$key]->view == 0): ?>  selected  <?php endif; ?>   value="" >None</option>
                                              <option <?php if(isset($RoleAccess[$key]) && $RoleAccess[$key]->view == 1): ?> selected <?php endif; ?>  value="1" >All</option>
                                              <option <?php if(isset($RoleAccess[$key]) && $RoleAccess[$key]->view == 2): ?> selected <?php endif; ?>  value="2" >Owned by</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="select-picker role-permission-select border-0" name="add[]" data-permission-id="<?php echo e($Per->id); ?>" data-role-id="2">
                                              <option <?php if(isset($RoleAccess[$key]) && $RoleAccess[$key]->add == 0): ?>  selected  <?php endif; ?>  value="" >None</option>
                                              <option <?php if(isset($RoleAccess[$key]) && $RoleAccess[$key]->add == 1): ?> selected <?php endif; ?> value="1" >All</option>
                                            </select>
                                        </td>
                                        <td>
                                          <select class="select-picker role-permission-select border-0" name="update[]" data-permission-id="<?php echo e($Per->id); ?>" data-role-id="2">
                                            <option <?php if(isset($RoleAccess[$key]) && $RoleAccess[$key]->update == 0): ?>  selected  <?php endif; ?>   value="" >None</option>
                                            <option <?php if(isset($RoleAccess[$key]) && $RoleAccess[$key]->update == 1): ?> selected <?php endif; ?>  value="1" >All</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select class="select-picker role-permission-select border-0" name="delete[]" data-permission-id="<?php echo e($Per->id); ?>" data-role-id="2">
                                            <option <?php if(isset($RoleAccess[$key]) && $RoleAccess[$key]->delete == 0): ?>  selected  <?php endif; ?>   value="" >None</option>
                                            <option <?php if(isset($RoleAccess[$key]) && $RoleAccess[$key]->delete == 1): ?> selected <?php endif; ?>  value="1" >All</option>
                                          </select>
                                        </td>
                                        <td class="text-center bg-light border-left">
                                          <input type="checkbox" class="ShowSelect" data-permission-id="<?php echo e($Per->id); ?>" <?php echo e($Per->isChecked ? 'checked' : ''); ?>>
                                        </td>                             
                                      </tr>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </tbody>
                                </table>
                              </div>
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="<?php echo e(url('admin/Role/home')); ?>" type="button" class="btn btn-outline-danger">Discard</a>
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
  <script>
  $(document).ready(function () {
    // Handle checkbox change event
    $('.ShowSelect').change(function () {
        var permissionId = $(this).data('permission-id');
        var isChecked = $(this).prop('checked');

        // Update the corresponding select elements based on checkbox state
        var $selects = $('.role-permission-select[data-permission-id="' + permissionId + '"]');

        if (isChecked) {
            // If checkbox is checked, set all select elements to 1
            $selects.val('1');
        } else {
            // If checkbox is unchecked, set values to an empty string
            $selects.val('');
        }
    });
});

</script><?php /**PATH /home/insighthub/public_html/resources/views/admin/settings/Role/edit.blade.php ENDPATH**/ ?>