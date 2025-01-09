<?php $__env->startSection('title', 'Order'); ?>
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
       <div class=" d-flex" style="justify-content:space-between;">
           <!--<div class="col-10">-->
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Order /</span> Add</h4>
            <!--</div>-->
                    <!--<div class="col-2">-->
                      <div class="action-btns">
                                  <a href="<?php echo e(url('admin/Orders/home')); ?>" class="btn btn-label-primary me-3 mt-3">
                                    <span class="align-middle"> Back</span>
                                  </a>
                                </div>
                                <!--</div>-->
    </div>
                
    <!-- Sticky Actions -->
    <form action="<?php echo e(url('admin/Orders/store')); ?>" method="post" enctype="multipart/form-data"> 
        <?php echo csrf_field(); ?>
        <div class="row">
            
               
          <div class="col-8">
            <div class="card">
              <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
                <h5 class="card-title mb-sm-0 me-2">Add New Order</h5>
               
              </div>
              <div class="card-body">
                <div class="row mb-4 mt-3"> 
                    <div class="col-md-6">
                        <label for="client_id" class="form-label">Client <span class="text-danger">*</span></label><br/>
                        <div class="dropdown w-100">
                              <button class="dropbtn" style="justify-content:space-between;margin-right:3%">
                                  <div >
                                <img src="<?php echo e(url('/')); ?>/public/images/profile_Ri1o.jpeg" alt="" style="display:none;" class="rounded-circle avatar-xs" id="selected_client_img">
                                  <span id="selected_client_btn">Select Client</span></div> <div >
                                  <i class="fa fa-angle-down" style="font-size:24px"></i></div> </button>
                                  <div class="dropdown-content">
                                    <?php $__currentLoopData = $Client; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="outer" id="client_<?php echo e($client->id); ?>" style="display:flex;margin:6px;padding:4px;color:black;" onclick="selectClient('<?php echo e($client->id); ?>', '<?php echo e($client->profile_img); ?>')">
                                        
                                                                      <?php if($client->profile_img): ?>
                                       <img src="<?php echo e($client->profile_img); ?>"  class="rounded-circle avatar-xs">
                                                                                <?php else: ?>
                                                                             <img src="<?php echo e(url('/')); ?>/public/images/profile_Ri1o.jpeg" alt="" class="rounded-circle avatar-xs">
                                                                                <?php endif; ?>
                                        <div class="sie_cont" style="display:flex;flex-direction:column;margin:5px;">
                                            <span><?php echo e($client->first_name); ?> (#<?php echo e($client->id); ?>)</span>
                                            <span><?php echo e($client->status); ?></span>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </div>
                        </div>
                        <input type="hidden" name="client_id" id="set_client_id" required>
                    </div>
                    <div class="col-md-6">
                        <label for="product_code" class="form-label">Payment Method <span class="text-danger">*</span></label>
                        <select class="form-control select2" name="bank_account" required>
                          <option value="1">Paypal Basics</option>
                          <option value="2">Bank Transfer</option>
                          <option value="3">Debit/Credit Card</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-2">
                          <label for="promo_code" class="form-label">Promotion Code (optional)</label>
                          <input type="text" class="form-control" name="promo_code" />
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="phone_number" class="form-label">Order Status <span class="text-danger">*</span></label>
                        <select  class="form-control select2 " name="status" >
                          <option value="0" selected >Pending</option>
                          <option value="1" >Accepted</option>
                          <option value="2" >Declined</option>
                        </select>
                    </div>
                    <div class="row mb-4 mt-3"> 
                    <div class="col-md-3">
                          <input type="checkbox"  name="generate_invoice" />
                          <label for="generate_invoice" class="form-label">Generate Invoice </label>
                    </div>
                    
                    <div class="col-md-3">
                          <input type="checkbox"  name="order_confirmation"/>
                          <label for="purchase_date" class="form-label">Order Confirmation </label>
                    </div>
                    
                    <div class="col-md-3">
                          <input type="checkbox"  name="send_email" />
                          <label for="warranty_expiry" class="form-label">Send Email</label>
                    </div>
                    
                    <div class="col-md-3">
                          <input type="checkbox"  name="is_payment_received" />
                          <label for="payment_confm" class="form-label">Is Payment Recieved</label>
                    </div>
                  </div>
                    <div class="row mb-4"> 
                    <h5>Product/Services</h5>
                    <div class="col-md-6">
                        <label for="base_amount" class="form-label">Product/Services <span class="text-danger">*</span></label>
                        <!--<select class="form-control select2" name="product_id[]" onChange="getBillingCycle(this.value)" required id="product">-->
                        <!--  <option>Select Product</option>-->
                        <!--  <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
                        <!--  <option value="<?php echo e($product->id); ?>" tax-rate="<?php echo e($product->rate); ?>" tax-id="<?php echo e($product->tax_id); ?>" tax-name="<?php echo e($product->tax_name); ?>"><?php echo e($product->product_name); ?></option>-->
                        <!--  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
                        <!--</select>-->
                        <select id="selectpickerGroups" name="product_id[]" onChange="getBillingCycle(this.value)" required class="selectpicker w-100" data-style="btn-default">
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(count($product->productsWithTax) > 0): ?>
                                <optgroup label="<?php echo e($product->category_name); ?>">
                                    <?php $__currentLoopData = $product->productsWithTax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <option value="<?php echo e($value->id); ?>" tax-rate="<?php echo e($value->rate); ?>" tax-id="<?php echo e($product->tax_id); ?>" tax-name="<?php echo e($value->tax_name); ?>" ><?php echo e($value->product_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </optgroup>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                          <label for="domain" class="form-label">Domain <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="domain" name="domain"  required/>
                    </div>
                    
                    <div class="col-md-6 mt-2">
                        <label for="billing_cycle" class="form-label">Billing Cycle <span class="text-danger">*</span></label>
                        <select class="form-control select2" name="billingcycle" id="billing_cycle" placeholder="" onchange="calculateAmt()" required>
                            <?php $__currentLoopData = $BillingCycles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $BillingCycle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($BillingCycle->id); ?>">
                                    <?php echo e($default_currency->prefix); ?>

                                    <?php echo e(number_format($BillingCycle->price, 2)); ?>

                                    <?php echo e($default_currency->code); ?>

                                    <?php if($BillingCycle->product_plan == 1 || $BillingCycle->payment_type == 1): ?>
                                        Free
                                    <?php elseif($BillingCycle->product_plan == 2 && $BillingCycle->payment_type == 2): ?>
                                        One Time
                                    <?php elseif($BillingCycle->product_plan == 3 && $BillingCycle->payment_type == 3): ?>
                                        <?php echo e(ucfirst($BillingCycle->plan_type)); ?>

                                    <?php endif; ?>
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="1" onkeyup="calculateAmt()" />
                    </div>
                    
                    <div id="addons"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-4 ">
            <div class="card">
                <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
                    <h5>Order Summary</h5>  
                </div>
                <div class="card-body">
                    <!-- Gift wrap -->
                    <dl class="row mt-4">
                        <dt class="col-6 fw-normal text-heading">
                            <div class="clearfix">
                                <span class="pull-left float-left">Sub Total</span>
                            </div>
                        </dt>
                        <dd class="col-6 text-end">
                            <div class="pull-right float-right">
                                <?php echo e($default_currency->prefix); ?> <span id="sub_total">0.00</span> <?php echo e($default_currency->code); ?>

                            </div>
                        </dd>
                    </dl>
                    <hr class="mx-n4">
                    <div id="addonView">
                        
                    </div>
                    <!-- Gift wrap -->
                    <dl class="row mt-4">
                        <dt class="col-6 fw-normal text-heading">
                            <div class="clearfix">
                                <span class="pull-left float-left" id="tax_name">GST(0%)</span>
                            </div>
                        </dt>
                        <dd class="col-6 text-end">
                            <div class="pull-right float-right">
                                <?php echo e($default_currency->prefix); ?> <span id="tax_amount">0.00</span> <?php echo e($default_currency->code); ?> 
                            </div>
                        </dd>
                    </dl>
                    <hr class="mx-n4">
                    <h5>
                    <dl class="row mb-0">
                        <dt class="col-6 text-heading">Total</dt>
                        <dd class="col-6 fw-medium text-end text-heading mb-0">
                            <div class="total-due-today">
                                <?php echo e($default_currency->prefix); ?> <span id="total_amount">0.00</span> <?php echo e($default_currency->code); ?>

                                <input type="hidden" id="gstAmt" name="gstAmt">
                                <input type="hidden" id="totalAmt" name="totalAmt">
                                <input type="hidden" id="currency" name="currency" value="<?php echo e($default_currency->id); ?>">
                                <input type="hidden" id="tax_id" name="tax_id" value="<?php echo e($default_currency->id); ?>">
                            </div>
                        </dd>
                    </dl>
                    </h5>
                    
                </div>
                
              </div>
            <div class="d-grid justify-content-center mt-3 ">
                <button type="submit" class="btn btn-primary btn-next btn-small waves-effect waves-light w-100">Submit Order</button>
            </div>
          </div>
        </div>
    </form>
  </div>
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


    function selectClient(id) {
       var clientName = $('#client_' + id + ' .sie_cont span:first-child').text(); 
        var imgSrc = $('#client_' + id + ' img').attr('src'); 
        $('#selected_client_img').show();
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
      
    function getBillingCycle(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: "<?php echo e(url('admin/Orders/billingCycle')); ?>/" + id,
            success: function(res) {
                console.log(res);
                let options = '<option value="0">Select Billing Cycle</option>';
                const default_currency = {
                    prefix: '<?php echo e($default_currency->prefix); ?>',
                    code: '<?php echo e($default_currency->code); ?>'
                };
                const billingCycleOptions = {
                    hourly: 'Hourly',
                    monthly: 'Monthly',
                    quartely: 'Quarterly',
                    semiannually: 'Semiannually',
                    annually: 'Annually',
                    biennially: 'Biennially',
                    triennially: 'Triennially'
                };
    
                res.forEach(function(BillingCycle) {
                    let optionText = default_currency.prefix + 
                                     numberFormat(BillingCycle.price, 2) + 
                                     ' ' + default_currency.code;
                    
                    if (BillingCycle.product_plan == 1) {
                        optionText += ' Free';
                    } else if (BillingCycle.product_plan == 2) {
                        optionText += ' One Time';
                    } else if (BillingCycle.product_plan == 3) {
                        optionText += ' ' + billingCycleOptions[BillingCycle.plan_type.toLowerCase()];
                    }
    
                    options += `<option value="${BillingCycle.id}" data-price="${BillingCycle.price}">${optionText}</option>`;
                });
    
                $('#billing_cycle').html(options);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching billing cycles:', error);
            }
        });
    }

    $('#selectpickerGroups').change(function(){
        var product_id = $(this).val();
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: "<?php echo e(url('admin/Orders/getAddonProducts')); ?>/" + product_id,
            success: function(res) {
                if(res.length > 0){
                    $('#addons').html(res);
                }else{
                    $('#addons').html(''); 
                }
                
            },
            error: function(xhr, status, error) {
                console.error('Error fetching billing cycles:', error);
            }
        });
    });

    $(document).on('change', '.addon-checkbox', function() {
        calculateAmt();
    });
    
   function calculateAmt() {
    const selectedOption = $('#billing_cycle option:selected');
    const price = parseFloat(selectedOption.data('price'));
    const product = $('#selectpickerGroups option:selected');
    const rate = parseFloat(product.attr('tax-rate'));
    const taxName = product.attr('tax-name');
    const tax_id = product.attr('tax-id');
    
    const quantity = parseInt($('#quantity').val()) || 1;

    if (isNaN(price) || isNaN(rate)) {
        console.error('Invalid price or tax rate selected');
        return;
    }

    // Calculate the subtotal for the main product
    const subTotal = price * quantity;

    // Calculate GST for the main product
    let gst = (subTotal * rate) / 100;

    // Calculate total amount including GST for the main product
    let totalAmount = subTotal + gst;

    // Calculate GST and total amount for addons
    let addonTotal = 0;
    $('.addon-checkbox:checked').each(function() {
        const addonPrice = parseFloat($(this).data('price'));
        const addonGstRate = parseFloat($(this).data('tax-rate'));
        const addonSubTotal = addonPrice; // Assuming quantity is 1 for addons
        const addonGst = (addonSubTotal * addonGstRate) / 100;
        addonTotal += addonSubTotal + addonGst;
    });

    // Add addon GST to the main product GST
    gst += (addonTotal - addonTotal / (1 + rate / 100));

    // Add addon total to the main total amount
    totalAmount += addonTotal;

    // Update the HTML elements with the calculated values
    $('#sub_total').text(numberFormat(subTotal, 2));
    $('#price').val(numberFormat(subTotal, 2));
    $('#tax_name').text(`${taxName} (${rate}%)`);
    $('#tax_amount').text(numberFormat(gst, 2)); // Display combined GST
    $('#gstAmt').val(numberFormat(gst, 2)); // GST amount for main product and addons
    $('#total_amount').text(numberFormat(totalAmount, 2));
    $('#totalAmt').val(numberFormat(totalAmount, 2));

    // Update addon view HTML
    let addonViewHtml = '';
    $('.addon-checkbox:checked').each(function() {
        const addonName = $(this).attr('data-name');
        const addonPrice = parseFloat($(this).data('price'));
        addonViewHtml += `<dl class="row mb-0">
                            <dt class="col-6 fw-normal text-heading">
                                <div class="clearfix">
                                    <span class="pull-left float-left">${addonName}</span>
                                </div>
                            </dt>
                            <dd class="col-6 text-end">
                                <div class="pull-right float-right">
                                    <?php echo e($default_currency->prefix); ?> <span>${numberFormat(addonPrice, 2)}</span> <?php echo e($default_currency->code); ?>

                                </div>
                            </dd>
                        </dl>`;
    });
    $('#addonView').html(addonViewHtml);
}




    
    function numberFormat(number, decimals) {
        if (isNaN(number)) {
            return number; // If number is not a valid number, return it as is.
        }
    
        const fixedNumber = parseFloat(number).toFixed(decimals);
        const parts = fixedNumber.split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return parts.join('.');
    }
    
    // Trigger the change event on page load if a billing cycle is pre-selected
    $(document).ready(function() {
        $('#billing_cycle').trigger('change');
    });


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/Orders/create.blade.php ENDPATH**/ ?>