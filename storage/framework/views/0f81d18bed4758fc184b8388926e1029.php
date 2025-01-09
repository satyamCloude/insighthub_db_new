<div class="card">
  

 <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_length" id="DataTables_Table_3_length"><label>
              </div>
            </div>
          </div>
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>IP</th>
                <th>Activity</th>
                <th>URL</th>
                <th>Method</th>
                <th>Browser</th>
                <th>Created At</th>
              </tr>
            </thead>
            <tbody id="result">
              <?php if(count($LogActivity) > 0): ?>
             <?php $__currentLoopData = $LogActivity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr class="odd">
                  <td><?php echo e($key+1); ?> </td>
                  <td><?php if($user && $user->ip): ?> <?php echo e($user->ip); ?> <?php endif; ?></td>
                  <td><?php if($user && $user->subject): ?> <?php echo e($user->subject); ?> <?php endif; ?></td>
                  <td><?php if($user && $user->url): ?> <?php echo e($user->url); ?> <?php endif; ?></td>
                  <td><?php if($user && $user->method): ?> <?php echo e($user->method); ?> <?php endif; ?></td>
                  <td><?php if($user && $user->browser): ?> <?php echo e($user->browser); ?> <?php endif; ?></td>
                  <td><?php if($user && $user->created_at): ?> <?php echo e($user->created_at); ?> <?php endif; ?></td>
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
          </div>
      </div>
      </div>
      </div>
<?php /**PATH /home/insighthub/public_html/resources/views/Employee/MyProfile/Activity.blade.php ENDPATH**/ ?>