  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Template</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2"><?php echo e($Total); ?></h3>
                <!-- <p class="text-success mb-0">0</p> -->
              </div>
              <p class="mb-0">Total</p>
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
    <div class="col-sm-6 col-xl-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Active Template</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2"><?php echo e($active); ?></h3>
                <!-- <p class="text-danger mb-0"></p> -->
              </div>
              <p class="mb-0">Total</p>
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
    <div class="col-sm-6 col-xl-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>InActive Template</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2"><?php echo e($Inactive); ?></h3>
                <!-- <p class="text-success mb-0"></p> -->
              </div>
              <p class="mb-0">Total</p>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-danger">
                <i class="ti ti-user-exclamation ti-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Template List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Template's List</h5>
      </div>
      <div class="col-md-6 text-end">
        <button type="button" onclick="Tab(value)" value="SmSEmail" class="btn btn-label-warning mt-2"><i class="fas fa-sync-alt"></i></button>
        <button type="button" onclick="Tab(value)" value="AddSmSEmail" class="btn btn-label-primary me-2 mt-2">Add</button>
      </div>
    </div>
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
         
          <table id="example" class="table table-striped" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th>ID</th>
                <th>Template Name</th>
                <th>SATAUS</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="result">
              <?php if(count($Template) > 0): ?>
             <?php $__currentLoopData = $Template; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr class="odd">
                  <td><?php echo e($key+1); ?> </td>
                  <td><?php if($user && $user->name): ?> <?php echo e($user->name); ?> <?php endif; ?></td>
                   <td>
                    <?php switch($user->status):
                    case ('1'): ?>
                      <span class="badge bg-label-success">Active</span>
                        <?php break; ?>
                    <?php case ('2'): ?>
                      <span class="badge bg-label-danger">InActive</span>
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
                        <li><a class="dropdown-item" onclick="EditTemplateSettings(<?php echo e($user->id); ?>)">Edit</a></li>
                        <li><button class="dropdown-item delete_debtcase" url="<?php echo e(url('admin/Template/delete/'.$user->id)); ?>" id="<?php echo e($user->id); ?>">Delete</button></li>
                      </ul>
                    </div>
                  </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?>
              <tr>
                <td class="text-center" colspan="4">No Data Found</td>
              </tr>
              <?php endif; ?>             

            </tbody>
        </table>
         
      </div>
      </div>
    </div>


<script>
  
   function EditTemplateSettings(id) {
    $.ajax({
        url: `<?php echo e(url('admin/Template/edit/')); ?>/${id}`,
        method: 'GET',
        data: { id: id },
        success: function (response) {
            $('.bs-stepper-content').html(response);
        },
        error: function () {
            // Handle error if needed
        }
    });
}
    $(document).ready(function () {

        $(".delete_debtcase").click(function (e) {
            var id = $(this).attr('id');
            var url = $(this).attr('url');
            e.preventDefault();
            bootbox.confirm({
                message: "Are you sure?",
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

     $(document).ready(function() {
        $('#example').DataTable();
    });

</script><?php /**PATH /home/insighthub/public_html/resources/views/admin/settings/Template/home.blade.php ENDPATH**/ ?>