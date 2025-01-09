    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row p-2">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <button type="button" onclick="Tab(value)" value="Currency" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </button>
            </div>
          </div>
          <form action="<?php echo e(url('admin/CurrencySettings/store')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="card-body text-dark">
              <div class="row mt-4">
                <div class="col-md-6 mb-4">
                  <label for="rate" class="form-label">Currency Name <span class="text-danger">*</span></label>
                  <input type="text" id="name" class="form-control" name="name" >
                </div>
                <div class="col-md-6 mb-4">
                  <label for="rate" class="form-label">Currency Symbol<span class="text-danger">*</span></label>
                  <!-- <input type="text" id="prefix" class="form-control" name="prefix" > -->
                 <!--  <select id="prefix" class="form-control" name="prefix" >
                    <?php $__currentLoopData = $Currency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Currencys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($Currencys->id); ?>"><?php echo e($Currencys->prefix); ?><?php echo e($Currencys->code); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select> -->
                  <input type="text" id="prefix" class="form-control" name="prefix" >
                </div>
                <div class="col-md-3 mb-4">
                  <label for="rate" class="form-label">Currency Code<span class="text-danger">*</span></label>
                  <input type="text" id="code" class="form-control" name="code" >
                </div>
               <!--  <div class="col-md-3 mb-4">
                    <label for="rate" class="form-label">Is Cryptocurrency <span class="text-danger">*</span></label><br>
                    <div class="form-check form-check-inline">
                        <input type="radio" id="is_cryptocurrency_yes" class="form-check-input" name="is_cryptocurrency" value="1">
                        <label class="form-check-label" for="is_cryptocurrency_yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" id="is_cryptocurrency_no" class="form-check-input" name="is_cryptocurrency" value="0">
                        <label class="form-check-label " for="is_cryptocurrency_no">No</label>
                    </div>
                </div> -->
                <!-- <div class="col-md-6">
                      <label for="rate" class="form-label">Exchange Rate <span class="text-danger">*</span></label>
                      <span class="text-dark">( USD To USD )</span>
                      <input type="text" class="form-control" name="exchange_rate" required /><br>
                </div> -->
                <!-- <hr class="mt-4 mb-4" />
                <h4>Currency Format Settings</h4> -->
               <!--  <div class="col-md-6 mb-4">
                      <label for="rate" class="form-label">Currency Position <span class="text-danger">*</span></label>
                      <select class="form-control" name="currency_position" required>
                        <option name="left">Left</option>
                        <option name="right">Right</option>
                        <option name="left_with_space">Left With Space</option>
                        <option name="right_with_space">Right With Space</option>
                      </select>
                </div> -->
                <!-- <div class="col-md-6 mb-4">
                      <label for="rate" class="form-label">Thousand Separator <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="thousand_separator" required />
                </div>
                <div class="col-md-6 mb-4">
                      <label for="rate" class="form-label"><h5>Decimal Separator <span class="text-danger">*</span></h5></label>
                      <input type="text" class="form-control" name="decimal_separator" required />
                </div>
                <div class="col-md-6 mb-4">
                      <label for="rate" class="form-label"><h5>Number of Decimals <span class="text-danger">*</span></h5></label>
                      <input type="number" class="form-control" name="no_of_decimals" required />
                </div> -->
                <hr/>
              </div>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-md-6 text-end" >
                  <button type="button" onclick="Tab(value)" value="Currency" class="btn btn-outline-danger">
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
    <!-- /Sticky Actions --><?php /**PATH /home/insighthub/public_html/resources/views/admin/settings/CurrencySettings/create.blade.php ENDPATH**/ ?>