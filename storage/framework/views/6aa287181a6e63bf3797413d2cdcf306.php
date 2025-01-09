<style>
  .modal-backdrop {
    z-index: 1040; /* Ensure modal backdrop is below modals */
}

.modal-content {
    z-index: 1050; /* Ensure modal content is above modal backdrop */
}

.select2-dropdown {
    z-index: 1060 !important; /* Ensure select2 dropdown appears above modals */
}

  .dropbtn {
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    background-color: #fff;
    border: 1px solid #dbdade;
    border-radius: 0.375rem;
    border-color: #C9C8CE !important;
    height: 40px;
    width: 100%;
    text-align: left;
    color: #6f6b7d;
    font-weight: 500;
    font-size: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  }

  .dropdown {
    position: relative;
    display: inline-block;
  }

  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 100%;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
    max-height: 350px;
    overflow-x: scroll;
  }

  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }

  .dropdown-content a:hover {
    background-color: #f1f1f1
  }

  .dropdown:hover .dropdown-content {
    display: block;
  }

  .dropdown:hover .dropbtn {
    background-color: white;
  }


  .outer:hover {

    background-color: #685dd8 !important;
    color: white !important;

  }


  .outer {


    background-color: rgba(15, 103, 240, 0.08);
    color: #7367f0;

    border-radius: 10px;



  }

  .c-inv-total td{
    text-align: right;
  }
</style>
</style>
<div class="row mb-4">
  <div class="col-12">
    <div class="card">
      <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
        <h5 class="card-title mb-sm-0 me-2">Payroll Settings</h5>
        <div>
          <!-- <button type="button" class="btn btn-label-info text-dark" onclick="SettingsModal()"><i class="fa-solid fa-gear"></i></button> -->
          <button type="button" class="btn btn-label-primary" onclick="AddModal()">Add</button>
        </div>
      </div>
      <div class="card-body">
        <div class="card-datatable table-responsive mt-4">
          <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
            <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
              <!-- ... Table Header ... -->
              <thead>
                <tr>
                  <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                  <th>ID</th>
                  <th>Employee</th>
                  <th>Increment Salary</th>
                  <th>Total Salary</th>
                  <th>Increment Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="result">
                <?php if(count($PayRollSetting) > 0): ?>
                  <?php $__currentLoopData = $PayRollSetting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $PayRol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="odd">
                      <td><?php echo e($key+1); ?></td>
                      <td>
                        <img class="rounded-circle"
                          style="margin-right: 15px;margin-top: 10px;" 
                          src="<?php echo e($PayRol->profile_img); ?>"
                          height="30"
                          width="30"
                          alt="User avatar" /><?php echo e($PayRol->first_name); ?><div style="font-size:12px;margin-left: 46px;margin-top: -11px;"><?php echo e($PayRol->email); ?></div>
                      </td>
                      <td><?php echo e($PayRol->increment_sallery); ?></td>
                      <td><?php echo e($PayRol->Total_salary); ?></td>
                      <td><?php echo e($PayRol->increment_date); ?></td>
                      <td>
                        <a type="button" onclick="EditPayRolls(<?php echo e($PayRol->user_id); ?>)"><i class="fas fa-eye"></i></a>
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="PayRollModal" data-bs-backdrop="static" tabindex="-1" style="display: none; z-index: 1050;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
      <form action="<?php echo e(url('admin/PayRollSetting/store')); ?>"   class="modal-content" method="post" enctype="multipart/form-data"> 
        <?php echo csrf_field(); ?>
        <div class="modal-header">
          <h4>PayRoll</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-12 mb-3">
                <label class="form-label">Increment Sallery</label>
                <div class="input-group">
                  <!--   <select class="form-control select2" onchange="EmployeeData(this.value)" name="user_id">
                        <?php $__currentLoopData = $Employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Empl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($Empl->id); ?>"><?php echo e($Empl->first_name); ?></option>   
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select> -->
                    <div class="dropdown">
                      <button class="dropbtn" style="justify-content:space-between;margin-right:3%" type="button">
                          <div >
                         <img src="<?php echo e(url('/')); ?>/public/images/profile_Ri1o.jpeg" alt="" id="selected_client_img" class="rounded-circle avatar-xs" style="display:none;">
                          <span id="selected_client_btn">Select Client</span></div> <div >
                          <i class="fa fa-angle-down" style="font-size:24px"></i></div> </button>
                    <div class="dropdown-content">
                        <?php $__currentLoopData = $Employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="outer" id="client_<?php echo e($client->id); ?>" style="display:flex;margin:6px;padding:4px;color:black;" onclick="selectClient('<?php echo e($client->id); ?>', '<?php echo e($client->profile_img); ?>')">
                            
                                                                      <?php if($client->profile_img): ?>
                                       <img src="<?php echo e($client->profile_img); ?>"  class="rounded-circle avatar-xs">
                                                                                <?php else: ?>
                                                                             <img src="<?php echo e(url('/')); ?>/public/images/profile_Ri1o.jpeg" alt="" class="rounded-circle avatar-xs">
                                                                                <?php endif; ?>
                           
                            <div class="sie_cont" style="display:flex;flex-direction:column;margin:5px;">
                                <span><?php echo e($client->first_name); ?> <?php echo e($client->last_name); ?> (#<?php echo e($client->id); ?>) <br><?php echo e($client->company_name); ?></span>
                                <span><?php echo e($client->status); ?></span>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <input type="hidden" name="user_id" id="set_client_id">
                    <input type="text" id="oldsalary" placeholder="Old Salary" readonly class="form-control oldsalary">
                    <input type="text" id="increment_salary" name="increment_sallery" placeholder="Increment Salary" class="form-control" required>
                    <input type="text" id="Total_salary" name="Total_salary" readonly placeholder="Total Salary" class="form-control">
                </div>
            </div>
            <div class="col-sm-12">
                <label class="form-label">Increment Date</label>
                <input type="date" name="increment_date" class="form-control" required>
            </div>
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">
        Close
    </button>
    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
    </div>
    </form>
    </div>
</div>
<div class="modal fade" id="SettingsModal" data-bs-backdrop="static" tabindex="-1" style="display: none; z-index: 1050;" aria-modal="true" role="dialog">

    <div class="modal-dialog modal-lg">
      <form action="<?php echo e(url('admin/PayRollSetting/SettingApply/1')); ?>"   class="modal-content" method="post" enctype="multipart/form-data"> 
        <?php echo csrf_field(); ?>
        <div class="modal-header">
          <h4>PayRoll Settings</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-6 mb-3">
                <label class="form-label">Cron Url</label>
                <input type="text" name="cron_url" <?php if($PayCron && $PayCron->cron_url): ?> value="<?php echo e($PayCron->cron_url); ?>" <?php endif; ?> class="form-control">
            </div>
            <div class="col-sm-6 mb-3">
                <label class="form-label">Cron schedule Date</label>
                <input type="date" name="cron_date" <?php if($PayCron && $PayCron->cron_date): ?> value="<?php echo e($PayCron->cron_date); ?>" <?php endif; ?> class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" <?php if($PayCron && $PayCron->auto_generate == '1'): ?> checked <?php endif; ?> name="auto_generate" id="defaultCheck3" >
                  <label class="form-check-label" for="defaultCheck3"> Auto Generate </label>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">
        Close
    </button>
    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
    </div>
    </form>
    </div>
</div>
<script>
    function EditPayRolls(id) {
        $.ajax({
            url: `<?php echo e(url('admin/PayRollSetting/view/')); ?>/${id}`,
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

    function EmployeeData(selectedValue) {
        $('#Total_salary').val('');
        $('#increment_salary').val('');

        $.ajax({
            url: "<?php echo e(url('admin/PayRollSetting/EmployeeData')); ?>",
            method: 'GET',
            data: { id: selectedValue },
            success: function (response) {
                if (response.success && response.data && response.data.net_salary !== undefined) {
                    $('.oldsalary').val(response.data.net_salary);
                } else {
                    console.error('Invalid response format or missing net_salary property.');
                }
            },
            error: function () {
                // Handle error
            }
        });
    }

  numberCount = 1;


  function selectClient(id) {
   var clientName = $('#client_' + id + ' .sie_cont span:first-child').text(); 
   $('#selected_client_img').show();
    var imgSrc = $('#client_' + id + ' img').attr('src'); 
    $('#selected_client_img').attr('src', imgSrc); 
    $('#selected_client_btn').text(clientName); // Set the button text to the selected client name
    $('#set_client_id').val(id); // Set the hidden input value to the selected client ID

    $('.dropdown-content .outer').removeClass('selected');

    // Add the 'selected' class to the clicked option
    $('#client_' + id).addClass('selected');

    $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: 'GET',
          url: "<?php echo e(url('admin/Invoices/getClientDetails')); ?>/"+id,
          
          success: function(res) {
            console.log(res);// Make sure to adjust this based on your actual Select2 initialization method
            // alert(res.data.address_1 );
            $('#shipping_address').val(res.data.address_1 +', '+ res.data.address_2);
          },
        });
        EmployeeData(id);
  }


    $('#increment_salary').keyup(function() {
        var incrementSalaryValue = parseFloat($(this).val()) || 0;
        var oldSalaryValue = parseFloat($('#oldsalary').val()) || 0;
        var totalSalary = incrementSalaryValue + oldSalaryValue;
        $('#Total_salary').val(totalSalary.toFixed(2));
    });

    function AddModal() {
        $('#PayRollModal').modal('show');
    }

    function SettingsModal() {
        $('#SettingsModal').modal('show');
    }

    function Tabor(value) {
        if(value == 'Support') {
            $('#Supportsmtp').show(500);
            $('#Salessmtp').hide(500);
            $('#Accountsmtp').hide(500);
        }
        if(value == 'Sales') {
            $('#Salessmtp').show(500);
            $('#Supportsmtp').hide(500);
            $('#Accountsmtp').hide(500);
        }
        if(value == 'Account') {
            $('#Accountsmtp').show(500);
            $('#Supportsmtp').hide(500);
            $('#Salessmtp').hide(500);
        }
    }

    function TabAuth(value) {
        if(value == 'Support') {
            $('#SupportAuth').show(500);
            $('#SalesAuth').hide(500);
            $('#AccountAuth').hide(500);
        }
        if(value == 'Sales') {
            $('#SalesAuth').show(500);
            $('#SupportAuth').hide(500);
            $('#AccountAuth').hide(500);
        }
        if(value == 'Account') {
            $('#AccountAuth').show(500);
            $('#SupportAuth').hide(500);
            $('#SalesAuth').hide(500);
        }
    }

    function reinitializeSelect2() {
        $('#PayRollModal').on('shown.bs.modal', function () {
            $('.select2').select2({
                dropdownParent: $('#PayRollModal')
            });
        });
    }

    reinitializeSelect2();
</script>
<?php /**PATH /home/insighthub/public_html/resources/views/admin/settings/PayRollSetting/home.blade.php ENDPATH**/ ?>