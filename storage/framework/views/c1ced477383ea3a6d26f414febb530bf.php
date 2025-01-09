<style type="text/css">
  .smtp-form {
    display: none;
  }
</style>


<div class="row mb-4">
  <div class="col-md-12">
    <div class="card">
      <div
        class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
        <h5 class="card-title mb-sm-0 me-2">Ticket-Email Setting's</h5>
        <h5 class="card-title mb-sm-0 me-2">For Send</h5>
      </div>

      <div class="card-body">
        <div class="sticky-element pb-4 mt-3">
          <div class="row ">


            <div class="col-md-12 mt-2 d-flex  align-self-baseline">
              <select name="leadsetting" onchange="Taber(this.value)" class="form-control">
                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($department->allow_for_ticket): ?>
                <option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?></option>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>

            </div>
            <!--  <div class="col-md-4 d-flex justify-content-center align-self-baseline">
                            <input type="radio" name="leadsetting" id="radio2" onclick="Taber(value)" value="Sales">&nbsp;&nbsp;
                            <label for="radio2">Sales E-mail</label>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center align-self-baseline">
                            <input type="radio" name="leadsetting" id="radio3" onclick="Taber(value)" value="Account">&nbsp;&nbsp;
                            <label for="radio3">Account E-mail</label>
                        </div> -->
          </div>
        </div>

        <form action="<?php echo e(url('admin/TicketEmailSetting/update/'.$department->id)); ?>" method="post"
          enctype="multipart/form-data" id="smtp-form" class="smtp-form">
          <?php echo csrf_field(); ?>
          <div class="row ">
            <div class="col-sm-6 mb-4">
              <label for="smtp_mailer" class="form-label">
                <h5>MAIL MAILER <span class="text-danger">*</span></h5>
              </label>
              <input type="text" class="form-control" name="smtp_mailer" id="smtp_mailer">

              <input type="hidden" class="form-control"  name="id" id="id1">
              <input type="hidden" class="form-control"  name="department_id" id="department_id1">

            </div>
            <div class="col-sm-6 mb-4">
              <label for="smtp_host" class="form-label">
                <h5>MAIL HOST <span class="text-danger">*</span></h5>
              </label>
              <input type="text" class="form-control" name="smtp_host" id="smtp_host">
            </div>
            <div class="col-sm-6 mb-4">
              <label for="smtp_port" class="form-label">
                <h5>MAIL_PORT <span class="text-danger">*</span></h5>
              </label>
              <input type="text" class="form-control" name="smtp_port" id="smtp_port">
            </div>
            <div class="col-sm-6 mb-4">
              <label for="smtp_username" class="form-label">
                <h5>MAIL USERNAME <span class="text-danger">*</span></h5>
              </label>
              <input type="text" class="form-control" name="smtp_username"
              id="smtp_username">
            </div>
            <div class="col-sm-6 mb-4">
              <label for="smtp_password" class="form-label">
                <h5>MAIL PASSWORD<span class="text-danger">*</span></h5>
              </label>
              <input type="text" class="form-control" name="smtp_password" id="smtp_password">
            </div>
            <div class="col-sm-6 mb-4">
              <label for="smtp_encryption" class="form-label">
                <h5>MAIL ENCRYPTION<span class="text-danger">*</span></h5>
              </label>
              <input type="text" class="form-control" name="smtp_encryption"
              id="smtp_encryption">
            </div>
            <div class="col-sm-6 mb-5 text-end">
              <a href="#" type="button" class="btn btn-outline-danger waves-effect">Discard</a>
            </div>
            <div class="col-sm-6 mb-5">
              <button type="submit" name="smtp" value="support"
                class="btn btn-success waves-effect waves-light">Submit</button>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div
        class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
        <h5 class="card-title mb-sm-0 me-2">Ticket-Email Setting's</h5>
        <h5 class="card-title mb-sm-0 me-2">For Receive</h5>
      </div>

      <div class="card-body ">
        <div class="sticky-element bg-label-secondary mt-4">
          <div class="row">
            <select name="auth"  onchange="TabAuth(this.value)" class="form-control">
              <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($department->allow_for_ticket): ?>
              <option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?></option>
              <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
        </div>

        <form action="<?php echo e(url('admin/TicketEmailSetting/update/'.$department->id)); ?>" method="post"
          enctype="multipart/form-data" id="SupportAuth" class="smtp-form">
          <?php echo csrf_field(); ?>
        <div class="row mt-5" >
          <div class="col-sm-6 mb-4">
            <label for="support_email" class="form-label">
              <h5>E-mail <span class="text-danger">*</span></h5>
            </label>
            <input type="text" class="form-control" name="email" id="support_email">
          </div>
          <div class="col-sm-6 mb-4">
            <label for="Auth" class="form-label">
              <h5>Authentication Code <span class="text-danger">*</span></h5>
            </label>
            <input type="text" class="form-control" name="password" id="support_Auth">
            <input type="hidden" class="form-control" name="id" id="id2">
            <input type="hidden" class="form-control" name="department_id" id="department_id2">
          </div>
          <div class="col-sm-6 mb-5 text-end">
            <a href="#" type="button" class="btn btn-outline-danger waves-effect">Discard</a>
          </div>
          <div class="col-sm-6 mb-5">
            <button type="submit" name="Auth" value="support"
              class="btn btn-success waves-effect waves-light">Submit</button>
          </div>
        </div>
    </form>

      </div>
    </div>
  </div>
</div>




<script>
  var selectedAuth = $('select[name="leadsetting"]').val();
  Taber(selectedAuth);
  function Taber(value) {
    $('#department_id1').val(value);
    // Make an AJAX request to fetch data based on the selected value
    $.ajax({
      url: "<?php echo e(url('admin/Settings/smtp-details')); ?>/" + value, // Specify the URL to your API endpoint
      type: 'GET', // Or 'POST' if your endpoint requires it
      success: function (response) {
        // Handle the response data, update the form fields if needed
        $('#smtp_mailer').val(response.smtp_mailer);
        $('#smtp_host').val(response.smtp_host);
        $('#smtp_port').val(response.smtp_port);
        $('#smtp_username').val(response.smtp_username);
        $('#smtp_password').val(response.smtp_password);
        $('#smtp_encryption').val(response.smtp_encryption);
        $('#email').val(response.email);
        $('#password').val(response.password);
        $('#id1').val(response.id);
        $('#smtp-form').show(500);

      },
      error: function (xhr, status, error) {
        // Handle errors if AJAX request fails
        console.error(xhr.responseText);
      }
    });
  }

  var selectedAuth = $('select[name="auth"]').val();
  TabAuth(selectedAuth);

  function TabAuth(value) {
    $('#department_id2').val(value);
    // Make an AJAX request to fetch data based on the selected value
    $.ajax({
      url: "<?php echo e(url('admin/Settings/smtp-details')); ?>/" + value, // Specify the URL to your API endpoint
      type: 'GET', // Or 'POST' if your endpoint requires it
      success: function (response) {
        // Handle the response data, update the form fields if needed
        $('#support_email').val(response.email);
        $('#support_Auth').val(response.password);
        $('#id2').val(response.id);
        $('#SupportAuth').show(500);

      },
      error: function (xhr, status, error) {
        // Handle errors if AJAX request fails
        console.error(xhr.responseText);
      }
    });
  }
</script><?php /**PATH /home/insighthub/public_html/resources/views/admin/settings/TicketEmailSetting/home.blade.php ENDPATH**/ ?>