<?php $__env->startSection('title', 'Attendence'); ?>
<?php $__env->startSection('content'); ?>
<style>

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
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Attendence/</span> Add</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="<?php echo e(url('Employee/Attendence/home')); ?>" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="<?php echo e(url('Employee/Attendence/store')); ?>" method="post" enctype="multipart/form-data"> 
            <?php echo csrf_field(); ?>
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row mb-4"> 
                <!--<div class="col-md-6">-->
                <!--      <label for="email" class="form-label">Employee Name <span class="text-danger">*</span></label>-->
                <!--      <select class="form-control" name="emp_Id" >-->
                <!--        <?php $__currentLoopData = $Employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
                <!--        <option  value="<?php echo e($emp->id); ?>"><?php echo e($emp->first_name); ?></option>-->
                <!--        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
                <!--      </select>-->
                <!--</div>-->
                       <div class="col-md-6">
                <label for="client_id" class="form-label">Employee Name <span class="text-danger">*</span></label>
                <div class="dropdown">
                      <button class="dropbtn" style="justify-content:space-between;margin-right:3%" type="button">
                          <div >
                         <img src="<?php echo e(url('/')); ?>/public/images/profile_Ri1o.jpeg" alt="" id="selected_client_img" class="rounded-circle avatar-xs" style="display:none;">
                          <span id="selected_client_btn">Select Employee</span></div> <div >
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
                                <span><?php echo e($client->first_name); ?> <?php echo e($client->last_name); ?> (#<?php echo e($client->id); ?>) </span>
                                <span><?php echo e($client->status); ?></span>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <input type="hidden" name="emp_Id" id="set_client_id">
            </div>
                <div class="col-md-6">
                      <label for="name" class="form-label">Punch Date <span class="text-danger">*</span></label>
                      <input type="date" class="form-control" name="punch_date"  required/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="name" class="form-label">Punch In <span class="text-danger">*</span></label>
                      <input type="time" class="form-control" name="punch_in"  required/>
                </div>
                <div class="col-md-6">
                      <label for="name" class="form-label">Punch Out <span class="text-danger">*</span></label>
                      <input type="time" class="form-control" name="punch_out" required/>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="<?php echo e(url('Employee/Attendence/home')); ?>" type="button" class="btn btn-outline-danger">Discard</a>
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
  }


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/Employee/Humanesources/Attendence/create.blade.php ENDPATH**/ ?>