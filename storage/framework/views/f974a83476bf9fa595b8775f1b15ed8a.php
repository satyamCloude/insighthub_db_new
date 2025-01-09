<?php $__env->startSection('title', 'Switch'); ?>
<?php $__env->startSection('content'); ?>
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Switch /</span> Home</h4>
    <?php if(Session::has('success')): ?>
   <div class="alert alert-success" role="alert"><?php echo e(Session::get('success')); ?></div>
    <?php endif; ?>
  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Switch</span>
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
    <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Switch</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2"><?php echo e($Suspended); ?></h3>
                            <!-- <p class="text-success mb-0">0</p> -->
                          </div>
                          <p class="mb-0">Suspended</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-danger">
                            <i class="ti ti-user ti-sm"></i>
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
                          <span>Switch</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2"><?php echo e($Active); ?></h3>
                            <!-- <p class="text-success mb-0"></p> -->
                          </div>
                          <p class="mb-0">Active</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-success">
                            <i class="ti ti-user-plus ti-sm"></i>
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
                          <span>Switch</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2"><?php echo e($Terminated); ?></h3>
                            <!-- <p class="text-danger mb-0"></p> -->
                          </div>
                          <p class="mb-0">Terminated</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-danger">
                            <i class="ti ti-user-check ti-sm"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
    </div>
  </div>
  <!-- Switch List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Switch's List</h5>
      </div>
      <div class="col-md-6 text-end">
        <a href="<?php echo e(url('admin/Switchs/home')); ?>" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
          <a href="<?php echo e(url('admin/Switchs/add')); ?>" class="btn btn-primary mt-3 m-3">Add</a>
      </div>
    </div>
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_length" id="DataTables_Table_3_length"><label>
              </div>
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
                <th>Customer Name</th>
                <th>Products</th>
                <th>Public Ip</th>
                <th>Service Type</th>
                <th>Sign Up</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="result">
              <?php if(count($Switchs) > 0): ?>
             <?php $__currentLoopData = $Switchs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr class="odd">
                  <td><?php echo e($key+1); ?> </td>
                  <td>
                    <img 
                            class="rounded-circle"
                            style="margin-right: 15px;margin-top: 10px;" 
                            src="<?php echo e($user->profile_img); ?>"
                            height="30"
                            width="30"
                            alt="User avatar" /><?php echo e($user->first_name); ?><div style="font-size:12px;margin-left: 46px;margin-top: -11px;"><?php echo e($user->email); ?></div>
                          </td>
                  <td><?php if($user && $user->product_name): ?> <?php echo e($user->product_name); ?> <?php endif; ?></td>
                  <td><?php if($user && $user->ip_address): ?> <?php echo e($user->ip_address); ?> <?php endif; ?></td>
                  <td><?php echo e($user ? ($user->service_type == '1' ? 'Managed' : ($user->service_type == '2' ? 'UnManaged' : '')) : ''); ?></td>
                  <td><?php if($user && $user->signup_date): ?> <?php echo e($user->signup_date); ?> <?php endif; ?></td>
                  <td><?php switch($user->status):
                          case ('1'): ?>
                            <span class="badge bg-label-success">Active</span>
                              <?php break; ?>
                          <?php case ('2'): ?>
                            <span class="badge bg-label-warning">Suspended</span>
                              <?php break; ?>
                          <?php case ('3'): ?>
                            <span class="badge bg-label-danger">Terminated</span>
                              <?php break; ?>
                          <?php default: ?>
                                <span></span>
                          <?php endswitch; ?></td>
                  <td>
                    <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end" style="">
                            <li><a class="dropdown-item" href="<?php echo e(url('admin/Switchs/edit/'.$user->id)); ?>">Edit</a></li>
                            <li><button class="dropdown-item delete_debtcase" url="<?php echo e(url('admin/Switchs/delete/'.$user->id)); ?>" id="<?php echo e($user->id); ?>">Delete</button></li>
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
              <?php echo e($Switchs->links()); ?>

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
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/NetworkManagement/Switchs/home.blade.php ENDPATH**/ ?>