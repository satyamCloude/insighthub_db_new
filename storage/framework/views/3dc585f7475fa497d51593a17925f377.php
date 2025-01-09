<?php $__env->startSection('title', 'Log Activity'); ?>
<?php $__env->startSection('content'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row mt-4 m-4">
        <div class="col-md-5">
          
        </div>
        <div class="col-md-7 text-end">
           <a href="<?php echo e(url('admin/LogActivity/home')); ?>"class="btn btn-primary">System</a>
           <a href="<?php echo e(url('admin/LogActivity/ticket')); ?>"class="btn btn-light">Ticket</a>
           <a href="<?php echo e(url('admin/LogActivity/invoice')); ?>"class="btn btn-light">Invoice</a>
           <a href="<?php echo e(url('admin/LogActivity/lead')); ?>"class="btn btn-light">Lead</a>
        </div>
    </div>
    <div class="card  m-4">
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <div class="row bg-label-dark text-dark">
            <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-start">
              <h5 class="card-header">System Log</h5>
            </div>
            <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
              <div id="DataTables_Table_3_filter" class="dataTables_filter">
                  <form method="GET" action="">    
                  <label>Search: <input value="<?php echo e($searchTerm); ?>" type="search" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                  <a href="<?php echo e(url('admin/LogActivity/home')); ?>"class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
                </form>
              </div>
            </div>
          </div>
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px;" aria-label=""></th>
                <th>Login Time</th>
                <!--<th>Last Access</th>-->
                <th>Logout Time</th>
                <th>Username</th>
                <th>IP Address</th>
              </tr>
            </thead>
            <tbody id="result">
              <?php if(count($LogActivity) > 0): ?>
             <?php $__currentLoopData = $LogActivity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr class="odd">
                  <td></td>
                  <td><?php echo e($user->created_at->format('d/m/Y H:i')); ?></td>
                  <td><?php if($user && $user->logout_time): ?> <?php echo e($user->logout_time->format('d/m/Y H:i')); ?> <?php else: ?> - <?php endif; ?></td>
                  <td> <?php echo e($user->first_name); ?></td>
                  <!--<td> <?php echo e($user->last_access); ?></td>-->
                  <td> <?php echo e($user->ip); ?></td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?>
              <tr>
                <td class="text-center" colspan="8">No Data Found</td>
              </tr>
              <?php endif; ?>             

            </tbody>
          </table>
          <?php echo e($LogActivity->links()); ?>

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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/settings/LogActivity/home.blade.php ENDPATH**/ ?>