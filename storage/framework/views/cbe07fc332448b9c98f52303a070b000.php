
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
                <button type="button" onclick="Tab(value)" value="SecurityIP" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </button>
            </div>
          </div>
          <form action="<?php echo e(url('admin/Security/store')); ?>" method="post" enctype="multipart/form-data"> 
            <?php echo csrf_field(); ?>
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="User_ip_address" class="form-label"><h5>User IP Address <span class="text-danger">*</span></h5></label>
                      <input type="text" class="form-control" name="User_ip_address" />
                </div>
                <div class="col-md-6">
                      <label for="status" class="form-label"><h5>Status <span class="text-danger">*</span></h5></label>
                      <select name="status" class="form-select">
                            <option value="1">Active</option>
                            <option value="2">In Active</option>
                    </select>
                </div>
            </div>
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                 <button type="button" onclick="Tab(value)" value="SecurityIP" class="btn btn-outline-danger">Discard</button>
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
 <?php /**PATH /home/insighthub/public_html/resources/views/admin/settings/Security/create.blade.php ENDPATH**/ ?>