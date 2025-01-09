  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-4">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Notice</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2"><?php echo e($Total); ?></h3>
                            <!-- <p class="text-success mb-0">0</p> -->
                          </div>
                          <p class="mb-0">Total</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-primary">
                            <i class="fa-solid fa-book"></i>
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
                          <span>Public</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2"><?php echo e($Public); ?></h3>
                            <!-- <p class="text-danger mb-0"></p> -->
                          </div>
                          <p class="mb-0">Total</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-success">
                            <i class="fa-solid fa-book"></i>
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
                          <span>Private</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2"><?php echo e($Private); ?></h3>
                            <!-- <p class="text-success mb-0"></p> -->
                          </div>
                          <p class="mb-0">Total</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-danger">
                            <i class="fa-solid fa-book"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
    </div>
  </div>
  <!-- Notice List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Notice's List</h5>
      </div>
      <div class="col-md-6 text-end">
        <button type="button" onclick="Tab(value)" value="Notice" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></button>
          <button type="button" onclick="Tab(value)" value="AddNotice" class="btn btn-primary mt-3 m-3">Add</button>
      </div>
    </div>
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_length" id="DataTables_Table_3_length"><label></div>
            </div>
            <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
              <div id="DataTables_Table_3_filter" class="dataTables_filter">
                  <form method="GET" action="">    
                  <label>Search: <input type="search" value="<?php echo e($searchTerm); ?>" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                </form>
              </div>
            </div>
          </div>
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>Applied date</th>
                <th>Till date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="result">
              <?php if(count($Notice) > 0): ?>
             <?php $__currentLoopData = $Notice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr class="odd">
                  <td><?php echo e($key+1); ?> </td>
                  <td><?php if($user && $user->Applieddate): ?> <?php echo e($user->Applieddate); ?> <?php endif; ?></td>
                  <td><?php if($user && $user->Tilldate): ?> <?php echo e($user->Tilldate); ?> <?php endif; ?></td>
                   <td>
                   <?php switch($user->status):
                          case ('1'): ?>
                            <span class="badge bg-label-success">Public</span>
                              <?php break; ?>
                          <?php case ('2'): ?>
                            <span class="badge bg-label-danger">Private</span>
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
                            <li><a class="dropdown-item" onclick="EditNotesSettings(<?php echo e($user->id); ?>)">Edit</a></li>
                            <li><button class="dropdown-item delete_debtcase" url="<?php echo e(url('admin/Notice/delete/'.$user->id)); ?>" id="<?php echo e($user->id); ?>">Delete</button></li>
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
              <?php echo e($Notice->links()); ?>

          </div>
      </div>
      </div>
    </div>
<script>
   function EditNotesSettings(id) {
    $.ajax({
        url: `<?php echo e(url('admin/Notice/edit/')); ?>/${id}`,
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
</script><?php /**PATH /home/insighthub/public_html/resources/views/admin/settings/Notice/home.blade.php ENDPATH**/ ?>