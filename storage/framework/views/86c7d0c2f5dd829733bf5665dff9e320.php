<?php $__env->startSection('title', 'Inventory'); ?>
<?php $__env->startSection('content'); ?>
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Inventory /</span> Home</h4>
    <?php if(Session::has('success')): ?>
   <div class="alert alert-success" role="alert"><?php echo e(Session::get('success')); ?></div>
    <?php endif; ?>
  <!-- Users List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Inventory's List</h5>
      </div>
      <div class="col-md-6 text-end">
         <a href="<?php echo e(url('admin/Inventory/EXPORTCSV')); ?>" class="btn btn-info mt-3 m-3"><i class="fa-solid fa-file-csv"></i></a>
          <a href="<?php echo e(url('admin/Inventory/home')); ?>" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
          <a href="<?php echo e(url('admin/Inventory/add')); ?>" class="btn btn-primary mt-3 m-3">Add</a>
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
                <th>Product Name</th>
                <th>Assigned To</th>
                <th>Total Amount</th>
                <th>Purchase Date</th>
                <th>Warranty Expiry</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if(count($Inventory) > 0): ?>
              <?php $__currentLoopData = $Inventory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $Inventor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr class="odd">
                  <td><?php echo e($key+1); ?> </td>
                  <td><?php if($Inventor && $Inventor->product_name): ?> <?php echo e($Inventor->product_name); ?> <?php endif; ?></td>
                  <td>
                    <img 
                            class="rounded-circle"
                            style="margin-right: 15px;margin-top: 10px;" 
                            src="<?php echo e($Inventor->profile_img); ?>"
                            height="30"
                            width="30"
                            alt="User avatar" /><?php echo e($Inventor->first_name); ?><div style="font-size:12px;margin-left: 46px;margin-top: -11px;"><?php echo e($Inventor->email); ?></div></td>
                  <td><?php if($Inventor && $Inventor->total_amount): ?> <?php echo e($Inventor->total_amount); ?> <?php endif; ?></td>
                  <td><?php if($Inventor && $Inventor->purchase_date): ?> <?php echo e($Inventor->purchase_date); ?> <?php endif; ?></td>
                  <td><?php if($Inventor && $Inventor->warranty_expiry): ?> <?php echo e($Inventor->warranty_expiry); ?> <?php endif; ?></td>
                  <td>
                    <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end" style="">
                            <li><a class="dropdown-item" href="<?php echo e(url('admin/Inventory/edit/'.$Inventor->id)); ?>">Edit</a></li>
                            <li><button class="dropdown-item delete_debtcase" url="<?php echo e(url('admin/Inventory/delete/'.$Inventor->id)); ?>" id="<?php echo e($Inventor->id); ?>">Delete</button></li>
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
              <?php echo e($Inventory->links()); ?>

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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/Inventory/home.blade.php ENDPATH**/ ?>