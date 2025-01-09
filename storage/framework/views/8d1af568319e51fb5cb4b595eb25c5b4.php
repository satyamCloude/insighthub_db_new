<div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row p-2">
            <h5 class="card-title mb-sm-0 me-2">Currency Setting's</h5>
            <button type="button" onclick="Tab(value)" value="AddCurrency" class="btn btn-primary">Add Currency</button>
          </div>
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
                <th>Currency Name</th>
                <th>Currency Symbol</th>
                <th>Currency Code</th>
                <!-- <th>Exchange Rate</th>
                <th>Currency Format</th> -->
                <th>Action</th>
              </tr>
             </thead>
            <tbody>
              <?php if(count($CurrencySettings) > 0): ?>
             <?php $__currentLoopData = $CurrencySettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr class="odd">
                  <td><?php echo e($key+1); ?> </td>
                  <td><?php if($user && $user->name): ?> <?php echo e($user->name); ?> <?php endif; ?></td>
                  <td><?php if($user && $user->prefix): ?> <?php echo e($user->prefix); ?> <?php endif; ?></td>
                  <td><?php if($user && $user->code): ?> <?php echo e($user->code); ?> <?php endif; ?></td>
                  <!-- <td><?php if($user && $user->exchange_rate): ?> <?php echo e($user->exchange_rate); ?> <?php endif; ?></td>
                  <td><?php if($user && $user->currency_format): ?> <?php echo e($user->currency_format); ?> <?php endif; ?></td> -->
                 
                  <td>
                    <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end" style="">   
                            <li><a class="dropdown-item" onclick="EditCurrencySettings(<?php echo e($user->id); ?>)">Edit</a></li>
                            <li><button class="dropdown-item delete_debtcase" url="<?php echo e(url('admin/CurrencySettings/delete/'.$user->id)); ?>" id="<?php echo e($user->id); ?>">Delete</button></li>
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
<script>
 function EditCurrencySettings(id) {
    $.ajax({
        url: `<?php echo e(url('admin/CurrencySettings/edit/')); ?>/${id}`,
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


</script>
<?php /**PATH /home/insighthub/public_html/resources/views/admin/settings/CurrencySettings/home.blade.php ENDPATH**/ ?>