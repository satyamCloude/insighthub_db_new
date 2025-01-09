<?php $__env->startSection('title', 'Order'); ?>
<?php $__env->startSection('content'); ?>
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
 <h4 class="py-3 mb-4"><span class="text-muted fw-light">Order /</span> Home</h4>
<?php if(Session::has('success')): ?>
<div class="alert alert-success" role="alert"><?php echo e(Session::get('success')); ?></div>
<?php endif; ?>


  <!-- Users List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
        <h5 class="card-header">Order's List</h5>
      </div>
      <div class="col-md-6 text-end">
        <!-- <a href="<?php echo e(url('admin/Invoices/home')); ?>" class="btn btn-outline-primary mt-3 m-3">Make Invoice</a> -->

        <!-- <a href="<?php echo e(url('admin/Orders/EXPORTCSV')); ?>" class="btn btn-info mt-3 m-3"><i class="fa-solid fa-file-csv"></i></a> -->
        <!-- <a href="<?php echo e(url('admin/Orders/home')); ?>" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a> -->
        <a href="<?php echo e(url('admin/Orders/create')); ?>" class="btn btn-primary mt-3 m-3">Add</a>
      </div>
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
              <th>Order no.</th>
              <th>Client</th>
              <th>Amount</th>
              <th>Order Date</th>
              <th>Payment Method</th>
              <th>Payment Status</th>
              <th>Status</th>
              <!-- <th>Action</th> -->
            </tr>
          </thead>

          <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                        <?php
                                                            $checkInvoice = App\Models\Invoice::where('order_id', $product->order_number)->first();
                                                            if ($checkInvoice && ($checkInvoice->paid_amount == $checkInvoice->final_total_amt || $checkInvoice->paid_amount > $checkInvoice->final_total_amt)) {
                                                                $is_payment_recieved = 1; // fully paid
                                                            } elseif ($checkInvoice && $checkInvoice->paid_amount < $checkInvoice->final_total_amt) {
                                                                $is_payment_recieved = 2; // partially paid
                                                            } else {
                                                                $is_payment_recieved = 0; // unpaid
                                                            }
                                                        ?>
            <tr class="<?php echo e($key % 2 == 0 ? 'even' : 'odd'); ?>">
              <td><?php echo e($key + 1); ?></td>
              <td><a href="<?php echo e(url('admin/Orders/view/'.$product->order_number)); ?>"><?php echo e($product->order_number); ?></a>
              </td>
             
              
               <td>
                            <?php
                                $client = DB::table('users')
                                ->leftjoin('client_details','client_details.user_id','users.id')
                                ->leftjoin('company_details','company_details.id','client_details.company_id')
                                ->where('users.id', $product->client_id)
                                ->select('users.profile_img','users.first_name','users.last_name','users.id','company_details.company_name as comp_name')
                                ->first();
                            ?>
                            <?php if($client && $client->id): ?>
                            
                                        <div class="parent d-flex">
                                            <div class="child1">
                                                <?php if($client && $client->profile_img): ?>
                                                <img class="rounded-circle" style="margin-right: 15px; margin-top: 10px;" 
                                                     src="<?php echo e($client->profile_img ? $client->profile_img : asset('images/21104.png')); ?>" 
                                                     height="30" width="30" alt="User avatar" />
                                                <?php else: ?>
                                                <img class="rounded-circle" style="margin-right: 15px; margin-top: 10px;" 
                                                     src=" https://i.pinimg.com/564x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg" 
                                                     height="30" width="30" alt="User avatar" />
                                               
                                                <?php endif; ?>
                                                
                                            </div>
                                            <div class="child2">
                                                <a href="<?php echo e(url('admin/Client/home')); ?>">
                                                    <?php echo e($client->first_name); ?> <?php echo e($client->last_name); ?> | <?php echo e($client->id); ?><br>
                                                    <span style="color:#6e6c76; font-size:85%;"><?php echo e($client->comp_name); ?></span>
                                                </a>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                </td>

              <td> <?php if($product->total_amt != 'NaN'): ?> <?php echo e($product->total_amt); ?> <?php else: ?> -- <?php endif; ?></td>
              <td><?php if($product->order_date): ?> <?php echo e(date('d-m-Y', strtotime($product->order_date))); ?> <?php endif; ?></td>
              
              <td>
                    <?php if($product->bank_account == 1): ?>
                    Paypal
                    <?php elseif($product->bank_account == 2): ?>
                    Bank Transfer
                    <?php else: ?>
                    Debit/Credit
                    <?php endif; ?>
              </td>
              
           <!--    <td>
                  <?php if($product->is_payment_recieved == 0 ): ?> 
                    <span class="btn btn-danger btn-sm"> Unpaid </span> 
                  <?php else: ?> 
                    <span class="btn btn-success btn-sm"> Paid </span> 
                  <?php endif; ?>
              </td> -->
                <td>
                                                        <?php switch($is_payment_recieved):
                                                            case (0): ?>
                                                                <span class="btn btn-danger btn-sm">UnPaid</span>
                                                                <?php break; ?>
                                                            <?php case (1): ?>
                                                                <span class="btn btn-success btn-sm">Paid</span>
                                                                <?php break; ?>
                                                            <?php case (2): ?>
                                                                <span class="btn btn-info btn-sm">Partially Paid</span>
                                                                <?php break; ?>
                                                            <?php default: ?>
                                                                <span>--</span>
                                                        <?php endswitch; ?>
                                                    </td>
              
              <td>

                <select onchange="updatepro(this.value,`<?php echo e($product->order_number); ?>`)" class="form-control select2" name="status_id">
                  <option value="0" <?php echo e($product->order_status == 0 ? 'selected':''); ?>>Pending</option>
                  <option value="1" <?php echo e($product->order_status == 1 ? 'selected':''); ?>>Accepted</option>
                  <option value="2" <?php echo e($product->order_status == 2 ? 'selected':''); ?>>Declined</option>
                </select>
              </td>
              <!-- <td>
                <a href="<?php echo e(url('admin/Orders/orderInvoiceCreate/'.$product->order_number)); ?>" class="btn btn-primary btn-sm">Invoice</a>
              </td> -->
              <!--  <td>
                          <div class="btn-group">
                              <svg style="margin-left: 10px"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" url="<?php echo e(url('admin/Project/delete/'.$product->order_number)); ?>" id="<?php echo e($product->order_number); ?>" aria-hidden="true" role="img" font-size="1.375rem" class="iconify iconify--tabler delete_debtcase" width="1em" height="1em" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 7h16m-10 4v6m4-6v6M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3"></path>
                              </svg>
                            </td> -->
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
              <td class="text-center" colspan="8">No Data Found</td>
            </tr>
            <?php endif; ?>
          </tbody>
        </table>

        <div class="p-1" style="float: right;">
          <?php echo e($users->links()); ?>

        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function downloadPDF(invoiceId) {
    window.location.href = "<?php echo e(url('admin/Order/downloadPDF')); ?>/" + invoiceId;
  }
</script>
<script>
  $(document).ready(function() {

    $(".delete_debtcase").click(function(e) {
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
        callback: function(result) {
          if (result) {
            window.location.href = url;
          }
        }
      });
    });
  });

  function changepro(id) {
    var id = id.id;
    var status = "progress";
    $('.progchange' + id).html('<select onchange="updatepro(\'' + status + '\', value, ' + id +
      ')" class="form-control select2" name="status_pro">' +
      '<option value="10">Select %</option>' +
      '<option value="10">10 %</option>' +
      '<option value="20">20 %</option>' +
      '<option value="30">30 %</option>' +
      '<option value="40">40 %</option>' +
      '<option value="50">50 %</option>' +
      '<option value="60">60 %</option>' +
      '<option value="70">70 %</option>' +
      '<option value="80">80 %</option>' +
      '<option value="90">90 %</option>' +
      '<option value="100">100 %</option>' +
      '</select>');
    $('.select2').select2()
    $('.hide' + id).html('');
  }

  function changestatus(id) {

    var id = id.id;
    var status = "stu";
    $('.statuschange' + id).html('<select onchange="updatepro(\'' + status + '\', value, ' + id +
      ')" class="form-control select2" name="status_id">' +
      '<option value="0">Select satuts</option>' +
      '<option value="0">Pending</option>' +
      '<option value="1">Accepted</option>' +
      '<option value="2">Declined</option>' +
      '<option value="3">Cancel</option>' +
      '</select>');
    $('.select2').select2()
    $('.statushide' + id).html('');
  }

  function CallInvoice(id) {
    window.location.href = '<?php echo e(url('/')); ?>/admin/Invoices/add?order_id=' + id;
  }

  function updatepro(value, id) {
    var status = "stu";
    // alert(value);
    // alert(id);
    $.ajax({
      url: "<?php echo e(url('admin/Orders/UpdateStatus')); ?>",
      method: 'GET',
      data: {
        id: id,
        status_pro: value,
        status: status
      },
      success: function() {
        // location.reload();
      },
      error: function() {
      }
    });
  }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/Orders/home.blade.php ENDPATH**/ ?>