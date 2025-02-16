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
                    <tr>
                        <th>#</th>
                        <th>DEPARTMENT</th>
                        <th>SUBJECT</th>
                        <th>EMAIL</th>
                        <th>ASSIGNED TO</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
            </tr>
                  </tr>
                </thead>
                <tbody>
                  <?php if(count($Ticket) > 0): ?>
                    <?php $__currentLoopData = $Ticket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$Tick): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <?php $client =  \App\Models\User::select('first_name','profile_img','email')->where('id',$Tick->client_id)->where('type',2)->first() ?>
                     <?php $Department =  \App\Models\Department::where('id',$Tick->department_id)->first() ?>
                          <tr>
                            <td><?php echo e($key+1); ?></td>
                            <td><?php if($Department && $Department->name): ?><?php echo e($Department->name); ?> <?php else: ?> <?php echo $Tick->department_id; ?> <?php endif; ?></td>
                            <td><?php echo e($Tick->subject); ?></td>
                            <td>
                    <?php if($client && $client->email): ?>
                        <?php echo e($client->email); ?>

                    <?php else: ?>
                        <?php
                            preg_match('/<([^>]+)>/', $Tick->department_id, $matches);
                            $extractedEmail = isset($matches[1]) ? $matches[1] : null;
                        ?>

                        <?php echo e($extractedEmail ?? $Tick->department_id); ?>

                    <?php endif; ?>
                </td>

                            <td>
                              <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label=" <?php if($client && $client->profile_img): ?> <?php echo e($client->first_name); ?> <?php endif; ?>" data-bs-original-title=" <?php if($client && $client->profile_img): ?> <?php echo e($client->first_name); ?> <?php else: ?> Google <?php endif; ?>">
                                  <img <?php if($client && $client->profile_img): ?> src="<?php echo e($client->profile_img); ?>" <?php else: ?> src="<?php echo e(url('public/logo/google.jpg')); ?>"   <?php endif; ?> alt="Avatar" class="rounded-circle">
                                </li>
                              </ul>
                            </td>
                            <td>
                              <?php if($Tick->status == 1): ?>
                              <span class="badge bg-label-success me-1">Open</span>
                              <?php elseif($Tick->status == 2): ?>
                              <span class="badge bg-label-primary me-1">InProgress</span>
                              <?php elseif($Tick->status == 3): ?>
                              <span class="badge bg-label-info me-1">Pending</span>
                              <?php elseif($Tick->status == 4): ?>
                              <span class="badge bg-label-danger me-1">OnHold</span>
                              <?php elseif($Tick->status == 5): ?>
                              <span class="badge bg-label-secondary me-1">Resolved</span>
                              <?php elseif($Tick->status == 6): ?>
                              <span class="badge bg-label-warning me-1">Closed</span>
                              <?php endif; ?>
                            </td>
                            <td>
                              <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                  <i class="ti ti-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item text-dark" href="<?php echo e(url('admin/Ticket/view/'.$Tick->id)); ?>"><i class="ti ti-eye me-1"></i> View</a>
                                  <a class="dropdown-item text-dark" href="<?php echo e(url('admin/Ticket/edit/'.$Tick->id)); ?>"><i class="ti ti-pencil me-1"></i> Edit</a>
                                  <a class="dropdown-item delete_debtcase text-dark" url="<?php echo e(url('admin/Ticket/delete/'.$Tick->id)); ?>"><i class="ti ti-trash me-1"></i> Delete</a>
                                </div>
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
              </div>
            </div>
          </div>
</div>
<script type="text/javascript">
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
</script><?php /**PATH /home/insighthub/public_html/resources/views/Employee/MyProfile/Ticket.blade.php ENDPATH**/ ?>