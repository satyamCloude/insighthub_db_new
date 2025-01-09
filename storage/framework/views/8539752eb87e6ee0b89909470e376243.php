
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <button type="button" onclick="Tab(value)" value="ProjectCategory" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </button>
            </div>
          </div>
         <form action="<?php echo e(url('admin/ProjectCategory/store')); ?>" method="post" enctype="multipart/form-data">
             <?php echo csrf_field(); ?>
            <div class="card-body">
              <h5 class="mb-4">1. Project Category</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="project_name" class="form-label">Project Category Name  <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="category_name" required/>
                </div>
             
            </div>
          </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                 <button type="button" onclick="Tab(value)" value="ProjectCategory" class="btn btn-label-primary me-3">
                <span class="align-middle"> Discard</span>
              </button>
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>Submit</button>
                </div>
              </div>
            </div> 
          </form>
        </div>
      </div>
    </div><?php /**PATH /home/insighthub/public_html/resources/views/admin/ProjectCategory/create.blade.php ENDPATH**/ ?>