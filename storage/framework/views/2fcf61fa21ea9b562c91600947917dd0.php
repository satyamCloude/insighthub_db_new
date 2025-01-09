<?php if($payment_type == 2): ?>
    
    <div class="row">
        <div class="col-md-2 bg-success">
            <label for="Currency" class="form-label">Currency</label>
        </div>
        <div class="col-md-2 bg-success">
            <label for="One Time" class="form-label">One Time</label>
        </div>
    </div>
    
    
        <?php $__currentLoopData = $currency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currencys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $matchingPrice = null;
                $pricing = DB::table('product_pricing')
                ->where('currency_id',$currencys->id)
                ->where('product_plan',2)
                ->where('product_id',$p_id)
                ->where('deleted_at',null)
                ->first();
            ?>
            <?php if(isset($price)): ?>
                <?php $__currentLoopData = $price; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $priceItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($currencys->id == $priceItem['currency_id']): ?>
                    <?php
                        $matchingPrice = $priceItem['price'];
                        break; 
                    ?>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            
            
            <?php if($pricing): ?>
                <div class="row mt-3">
                    <div class="col-md-2">
                        <label for="INR "class="form-label mt-3"><?php echo e($currencys->name); ?></label>
                    </div>
                    <div class="col-md-2">
                        <!-- <input type="hidden" class="form-control" name="product_plan[]"  value="<?php echo e($payment_type); ?>" required/> -->
                        <input type="hidden" class="form-control" name="plan_type[]"  value="<?php echo e($plan_type); ?>" required/>
                        <input type="hidden" class="form-control" name="currency_id[]"  value="<?php echo e($currencys->id); ?>" required/>
                        <input type="number" class="form-control" name="price[]" value="<?php echo e($pricing->price); ?>" placeholder="<?php echo e($currencys->prefix); ?>" />
                    </div>
                </div>
            <?php else: ?>
                <div class="row mt-3">
                    <div class="col-md-2">
                        <label for="INR "class="form-label mt-3"><?php echo e($currencys->name); ?></label>
                    </div>
                    <div class="col-md-2">
        
                        <!-- <input type="hidden" class="form-control" name="product_plan[]"  value="<?php echo e($payment_type); ?>" required/> -->
                        <input type="hidden" class="form-control" name="plan_type[]"  value="<?php echo e($plan_type); ?>" required/>
                        <input type="hidden" class="form-control" name="currency_id[]"  value="<?php echo e($currencys->id); ?>" required/>
                        <input type="number" class="form-control" name="price[]" value="<?php echo e($matchingPrice ? $matchingPrice : ''); ?>"  placeholder="<?php echo e($currencys->prefix); ?>"/>

                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php elseif($payment_type == 3): ?>
    <div class="mb-4 paymenttype">
        <!-- Header Row -->
        <div class="row">
            <div class="col-md-1 bg-success">
                <label for="Currency" class="form-label">Currency</label>
            </div>
            <div class="col-md-1 bg-success">
                <label for="Hourly" class="form-label">Hourly</label>
            </div>
            <div class="col-md-1 bg-success">
                <label for="Monthly" class="form-label">Monthly</label>
            </div>
            <div class="col-md-1 bg-success">
                <label for="Quarterly" class="form-label">Quarterly</label>
            </div>
            <div class="col-md-2 bg-success">
                <label for="Semi-Annually" class="form-label">Semi-Annually</label>
            </div>
            <div class="col-md-2 bg-success">
                <label for="Annually" class="form-label">Annually</label>
            </div>
            <div class="col-md-2 bg-success">
                <label for="Biennially" class="form-label">Biennially</label>
            </div>
            <div class="col-md-2 bg-success">
                <label for="Triennially" class="form-label">Triennially</label>
            </div>
        </div>

        <?php $__currentLoopData = $currency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currencys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            // Fetch all pricings for the current currency and product
            $pricings = DB::table('product_pricing')
                ->where('currency_id', $currencys->id)
                ->where('product_plan', 3)
                ->where('product_id', $p_id)
                ->where('deleted_at', null)
                ->get();

            // Create an associative array for easy lookup
            $pricingMap = $pricings->keyBy('plan_type');
        ?>
        <?php if(count($pricings) > 0): ?>
        <div class="row mt-3">
            <div class="col-md-1" style="padding-left: 0rem;">
                <label for="Currency" class="form-label mt-3"><?php echo e($currencys->name); ?></label>
            </div>
            <?php $__currentLoopData = ['hourly', 'monthly', 'quartely', 'semiannually', 'annually', 'biennially', 'triennially']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $planType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $pricing = $pricingMap->get($planType);
                                        $isChecked = $pricing && $pricing->price > 0 ? 'checked' : '';

                ?>
            <div class="col-md-1" style="padding-left: 0rem;">
                <input type="hidden" class="form-control" name="currency_id[]" value="<?php echo e($currencys->id); ?>" required />
                <input type="hidden" class="form-control" name="plan_type[]" value="<?php echo e($planType); ?>" required />
                <input type="number" class="form-control" name="price[]" value="<?php echo e($pricing->price ?? ''); ?>" style="padding-right: 0px; padding-left: 0px;" placeholder="<?php echo e($currencys->prefix); ?>" />
                <input type="checkbox" name="selected_plans[<?php echo e($currencys->id); ?>][]" value="<?php echo e($planType); ?>" <?php echo e($isChecked); ?> />

            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


    </div>


        <?php else: ?>
    <div class="row mt-3">
        <div class="col-md-1" style="padding-left: 0rem;">
            <label for="INR" class="form-label mt-3"><?php echo e($currencys->name); ?></label>
        </div>
        <div class="col-md-1" style="padding-left: 0rem;">
            <input type="hidden" class="form-control" name="currency_id[]" value="<?php echo e($currencys->id); ?>" required/>
            <input type="hidden" class="form-control" name="plan_type[]" value="hourly" required/>
            <input type="number" class="form-control" style="padding-right: 0px; padding-left: 0px;" name="price[]" placeholder="<?php echo e($currencys->prefix); ?>" />
            <input type="checkbox" name="selected_plans[<?php echo e($currencys->id); ?>][]" value="hourly" />
        </div>
        <div class="col-md-1 px-0">
            <input type="hidden" class="form-control" name="currency_id[]" value="<?php echo e($currencys->id); ?>" required/>
            <input type="hidden" class="form-control" name="plan_type[]" value="monthly" required/>
            <input type="number" class="form-control" style="padding-right: 0px; padding-left: 0px;" name="price[]"  value="0" placeholder="<?php echo e($currencys->prefix); ?>" />
            <input type="checkbox" name="selected_plans[<?php echo e($currencys->id); ?>][]" value="monthly" checked />
        </div>
        <div class="col-md-1" style="padding-right: 0rem;">
            <input type="hidden" class="form-control" name="currency_id[]" value="<?php echo e($currencys->id); ?>" required/>
            <input type="hidden" class="form-control" name="plan_type[]" value="quartely" required/>
            <input type="number" class="form-control" style="padding-right: 0px; padding-left: 0px;" name="price[]" placeholder="<?php echo e($currencys->prefix); ?>" />
            <input type="checkbox" name="selected_plans[<?php echo e($currencys->id); ?>][]" value="quartely" />
        </div>
        <div class="col-md-2">
            <input type="hidden" class="form-control" name="currency_id[]" value="<?php echo e($currencys->id); ?>" required/>
            <input type="hidden" class="form-control" name="plan_type[]" value="semiannually" required/>
            <input type="number" class="form-control" name="price[]"  style="padding-right: 0px; padding-left: 0px;" placeholder="<?php echo e($currencys->prefix); ?>" />
            <input type="checkbox" name="selected_plans[<?php echo e($currencys->id); ?>][]" value="semiannually" />
        </div>
        <div class="col-md-2">
            <input type="hidden" class="form-control" name="currency_id[]" value="<?php echo e($currencys->id); ?>" required/>
            <input type="hidden" class="form-control" name="plan_type[]" value="annually" required/>
            <input type="number" class="form-control" name="price[]" style="padding-right: 0px; padding-left: 0px;" placeholder="<?php echo e($currencys->prefix); ?>" />
            <input type="checkbox" name="selected_plans[<?php echo e($currencys->id); ?>][]" value="annually" />
        </div>
        <div class="col-md-2">
            <input type="hidden" class="form-control" name="currency_id[]" value="<?php echo e($currencys->id); ?>" required/>
            <input type="hidden" class="form-control" name="plan_type[]" value="biennially" required/>
            <input type="number" class="form-control" name="price[]"  style="padding-right: 0px; padding-left: 0px;" placeholder="<?php echo e($currencys->prefix); ?>" />
            <input type="checkbox" name="selected_plans[<?php echo e($currencys->id); ?>][]" value="biennially" />
        </div>
        <div class="col-md-2">
            <input type="hidden" class="form-control" name="currency_id[]" value="<?php echo e($currencys->id); ?>" required/>
            <input type="hidden" class="form-control" name="plan_type[]" value="triennially" required/>
            <input type="number" class="form-control" name="price[]"  style="padding-right: 0px; padding-left: 0px;" placeholder="<?php echo e($currencys->prefix); ?>" />
            <input type="checkbox" name="selected_plans[<?php echo e($currencys->id); ?>][]" value="triennially" />
        </div>
    </div>
<?php endif; ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <div class="row"></div>
<?php endif; ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/settings/Product/currency.blade.php ENDPATH**/ ?>