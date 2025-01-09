<?php $__env->startSection('title', 'Create'); ?>
<?php $__env->startSection('content'); ?>
<!-- Content -->
<style>
 .avatar-upload {
    position: relative;
    max-width: 205px;
    margin: 50px auto;
}

.avatar-upload .avatar-edit {
    position: absolute;
    right: 12px;
    z-index: 1;
    top: 10px;
}

.avatar-upload .avatar-edit input {
    display: none;
}

.avatar-upload .avatar-edit label {
    display: inline-block;
    width: 34px;
    height: 34px;
    margin-bottom: 0;
    border-radius: 100%;
    background: #ffffff;
    border: 1px solid transparent;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
    cursor: pointer;
    font-weight: normal;
    transition: all 0.2s ease-in-out;
}

.avatar-upload .avatar-edit label:hover {
    background: #f1f1f1;
    border-color: #d6d6d6;
}

.avatar-upload .avatar-edit label:after {
    content: "\f040";
    font-family: "FontAwesome";
    color: #757575;
    position: absolute;
    top: 10px;
    left: 0;
    right: 0;
    text-align: center;
    margin: auto;
}

.avatar-upload .avatar-preview {
    width: 192px;
    height: 192px;
    position: relative;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
}

.avatar-upload .avatar-preview > div {
    width: 100%;
    height: 100%;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}
.selected {
    background-color: #f0f0f0; /* Change background color to indicate selection */
    font-weight: bold; /* Change font weight to indicate selection */
}
.dropbtn {
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  background-color: #fff;
  border: 1px solid #dbdade;
  border-radius: 0.375rem;
  border-color: #C9C8CE !important;
  height:40px;
  width:100%;
  text-align:left;
  color:#6f6b7d;
  font-weight:500;
  font-size:16px;
  display:flex;
  justify-content:space-between;
  align-items:center;
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
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: white;
}


.outer:hover{

  background-color:#685dd8 !important;
  color:white !important;

}


.outer{


  background-color: rgba(115, 103, 240, 0.08);
  color: #7367f0;

  border-radius:10px;



}



</style>
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">IPAddress /</span> Add</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="<?php echo e(url('admin/IPAddress/home')); ?>" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="<?php echo e(url('admin/IPAddress/store')); ?>" method="post" enctype="multipart/form-data"> 
            <?php echo csrf_field(); ?>
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="ip_address" class="form-label">IP Address <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="ip_address" placeholder="Enter Network Subnet" required/>
                </div>
                <div class="col-md-6">
                      <label for="private_ip" class="form-label">Private IP <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="private_ip" placeholder="Enter Private IP" required/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="vlan" class="form-label">VLAN <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="vlan" placeholder="Enter VLAN" required/>
                </div>
                <div class="col-md-6">
                      <label for="gateway" class="form-label">Gateway <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="gateway" placeholder="Enter Gateway" required/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="primary_name_server" class="form-label">Primary Name Server <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="primary_name_server" placeholder="Enter Primary Name Server" required/>
                </div>
                <div class="col-md-6">
                      <label for="secondary_name_server" class="form-label">Secondary Name Server<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="secondary_name_server" placeholder="Enter Secondary Name Server" required/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="dc_location_id" class="form-label">DC Location <span class="text-danger">*</span></label>
                      <select class="form-control" name="dc_location_id" required>
                                                         
                        <?php $__currentLoopData = $Countrys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($Count->country_id); ?>"><?php echo e($Count->country_name); ?></option>                                              
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                </div>
                <div class="col-md-6">
                      <label for="ip_type" class="form-label">IP Type <span class="text-danger">*</span></label>
                      <select class="form-control" name="ip_type" required>
                                
                        <option value="1">Public</option>                         
                        <option value="2">Private</option>                         
                      </select>
                </div>
              </div>
                <div class="row mb-4"> 
                  <!-- <div class="col-md-6">
                       <label for="customer_id" class="form-label">Customer Name <span class="text-danger">*</span></label>
                      <select class="form-control" name="customer_id" required>
                                    
                       <?php $__currentLoopData = $customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($Count->id); ?>"><?php echo e($Count->first_name); ?></option>                                              
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                  </div> -->
                    <div class="col-md-6 customer_name">
                                  <label for="customer_name" class="form-label">Customer Name <span class="text-danger">*</span></label>
                                  <div class="dropdown">
                                      <button class="dropbtn" id="selected_customer_btn">Select Customer<i class="fa fa-angle-down" style="font-size:24px"></i></button>
                                      <div class="dropdown-content" style="max-height: 45vh;overflow: auto;">
                                          
                                         <?php $__currentLoopData = $customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendors): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <div class="outer" id="customer_<?php echo e($vendors->id); ?>" style="display:flex;margin:6px;padding:4px;color:black;" onclick="getUserDetails('<?php echo e($vendors->id); ?>')">
                                              <div style="border-radius:50%;">
                                                  <?php if($vendors->profile_img): ?>
                                                                                                    <img src="<?php echo e($vendors->profile_img); ?>" style="width:45px;border-radius:50%;height:auto;">

                                                  <?php else: ?>
                                                                                                    <img src="https://i.pinimg.com/564x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg" style="width:45px;border-radius:50%;height:auto;">

                                                  <?php endif; ?>
                                              </div>
                                              <div class="sie_cont" style="display:flex;flex-direction:column;margin:5px;">
                        <span><?php echo e($vendors->first_name); ?> <?php echo e($vendors->last_name); ?> |  #<?php echo e($vendors->id); ?> <br> <?php echo e($vendors->company_name); ?></span>
                                              </div>
                                          </div>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </div>
                                  </div>
                                  <input type="hidden" name="customer_id" id="customer_name">
                        </div>
                  <div class="col-md-6">
                      <label for="subnet_mask" class="form-label">Subnet Mask <span class="text-danger">*</span></label>
                       <input type="text" class="form-control" name="subnet_mask" placeholder="Enter Subnet Mask" required/>
                  </div>
                </div>
              <div class="row mb-4"> 
                <div class="col-md-12">
                      <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                       <div class="editor-container">
                            <div class="full-editor geteditor"></div>
                            <input type="hidden" name="description" class="hidden-field">
                        </div>
                </div>
            </div>      
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="<?php echo e(url('admin/IPAddress/home')); ?>" type="button" class="btn btn-outline-danger">Discard</a>
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
            </div> 
          </form>
        </div>
      </div>
    </div>
    <!-- /Sticky Actions -->
  </div>
<!-- / Content -->
<script>
  $(document).ready(function () {
    // Function to update the hidden field based on the editor content
    function updateHiddenField(index) {
      var editorContentText = $(".full-editor.geteditor").eq(index).html();
      console.log("Editor " + (index + 1) + " Text content: " + editorContentText);

      // Update the value of the hidden field based on the index
      $('.hidden-field').eq(index).val(editorContentText);
    }

    // Use event delegation to handle keyup and blur on any .full-editor.geteditor
    $(document).on('keyup blur', '.full-editor.geteditor', function () {
      // Get the index of the editor
      var index = $(".full-editor.geteditor").index(this);

      // Update the corresponding hidden field
      updateHiddenField(index);
    });
  });
  function getUserDetails(id) {
    $.ajax({
        type: 'GET',
        url: "<?php echo e(url('admin/getUserDetails')); ?>",
        data: {
            id: id,
        },
        success: function (res) {
            var responseObject = JSON.parse(res);
            if (responseObject.status === true) {
                $('#customer_name').val(id);
                $('#first_name').val(responseObject.first_name);
                $('#last_name').val(responseObject.last_name);
                $('#email').val(responseObject.email);
                $('#phone_number').val(responseObject.phone_number);
                $('#company_id').val(responseObject.company_name);
                
                // Update the button text with the selected customer's name
                $('#selected_customer_btn').text(responseObject.first_name + ' ' + responseObject.last_name);
            } else {
                $('.showinvoice_err').text(responseObject.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ' + error);
        },
    });
}

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/NetworkManagement/IPAddress/create.blade.php ENDPATH**/ ?>