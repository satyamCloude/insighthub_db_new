    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Edit Detail's</h5>
            <div class="action-btns">
              <button type="button" onclick="Tab(value)" value="SmSEmail" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </button>
            </div>
          </div>
          <form action="<?php echo e(url('admin/Template/update/'.$Template->id)); ?>" method="post" enctype="multipart/form-data"> 
            <?php echo csrf_field(); ?>
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row mb-4"> 
                <div class="col-md-4">
                      <label for="name" class="form-label"><h5>Template name <span class="text-danger">*</span></h5></label>
                      <input type="text" class="form-control" name="name" <?php if($Template && $Template->name): ?> value="<?php echo e($Template->name); ?>" <?php endif; ?> />
                </div>
                <div class="col-md-4">
                      <label for="subject" class="form-label"><h5>Subject <span class="text-danger">*</span></h5></label>
                      <input type="text" class="form-control" name="subject" <?php if($Template && $Template->subject): ?> value="<?php echo e($Template->subject); ?>" <?php endif; ?> />
                </div>
                <div class="col-md-4">
                      <label for="status" class="form-label"><h5>Status <span class="text-danger">*</span></h5></label>
                      <select name="status" class="form-select">
                            <option <?php if($Template && $Template->status == '1'): ?> selected <?php endif; ?> value="1">Active</option>
                            <option <?php if($Template && $Template->status == '2'): ?> selected <?php endif; ?> value="2">In Active</option>
                    </select>
                </div>
              </div>
             <div class="row mb-4"> 
                <div class="col-12">
                      <label for="template" class="form-label"><h5>Template Header<span class="text-danger">*</span></h5></label>
                        <textarea type="text" name="template" class="form-control"><?php if($Template && $Template->template): ?> <?php echo $Template->template; ?> <?php endif; ?> </textarea>
                </div>
             </div>
             <div class="row mb-4"> 
                <div class="col-12">
                      <label for="template" class="form-label"><h5>Template Footer<span class="text-danger">*</span></h5></label>
                        <textarea type="text" name="template2" class="form-control"><?php if($Template && $Template->template2): ?> <?php echo $Template->template2; ?> <?php endif; ?> </textarea>
                </div>
             </div>

            
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <button type="button" onclick="Tab(value)" value="SmSEmail" class="btn btn-label-danger me-3">
                <span class="align-middle"> Back</span>
              </button>
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
<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>

<script>
 CKEDITOR.replace( 'template' );
 CKEDITOR.replace( 'template2' );
</script><?php /**PATH /home/insighthub/public_html/resources/views/admin/settings/Template/edit.blade.php ENDPATH**/ ?>