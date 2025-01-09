
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Edit Detail's</h5>
            <div class="action-btns">
              <button type="button" onclick="Tab(value)" value="Notice" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </button>
            </div>
          </div>
          <form action="<?php echo e(url('admin/Notice/update/'.$edit->id)); ?>" method="post" enctype="multipart/form-data"> 
            <?php echo csrf_field(); ?>
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row"> 
                <div class="col-sm-4 mb-4">
                      <label for="name" class="form-label"><h5>Applied date <span class="text-danger">*</span></h5></label>
                      <input type="date" class="form-control" <?php if($edit && $edit->Applieddate): ?> value="<?php echo e($edit->Applieddate); ?>" <?php endif; ?> name="Applieddate" />
                </div>
                <div class="col-sm-4 mb-4">
                      <label for="name" class="form-label"><h5>Till date <span class="text-danger">*</span></h5></label>
                      <input type="date" class="form-control" <?php if($edit && $edit->Tilldate): ?> value="<?php echo e($edit->Tilldate); ?>" <?php endif; ?> name="Tilldate" />
                </div>
                <div class="col-sm-4 mb-4">
                      <label for="status" class="form-label"><h5>Status <span class="text-danger">*</span></h5></label>
                      <select name="status" class="form-select">
                            <option  <?php if($edit && $edit->status == '1'): ?> selected <?php endif; ?> value="1">Public</option>
                            <option <?php if($edit && $edit->status == '2'): ?> selected <?php endif; ?> value="2">Private</option>
                    </select>
                </div>
                <div class="col-sm-12 mb-4">
                      <label for="notice" class="form-label"><h5>Notice <span class="text-danger">*</span></h5></label>
                      <textarea rows="5" name="notice" class="form-control"><?php if($edit && $edit->notice): ?> <?php echo e($edit->notice); ?> <?php endif; ?></textarea>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="<?php echo e(url('admin/Notice/home')); ?>" type="button" class="btn btn-outline-danger">Discard</a>
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
<?php /**PATH /home/insighthub/public_html/resources/views/admin/settings/Notice/edit.blade.php ENDPATH**/ ?>