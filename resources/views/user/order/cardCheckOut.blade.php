@extends('layouts.admin')
@section('title', 'Cart')
@section('content')
<style>
    .fa-wallet{
        font-size: 26px;
        color: darkblue;
        width: 35px;
        /*margin-left: 14px;*/
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Checkout Wizard -->
    <!-- Checkout Wizard -->
    <div id="wizard-checkout" class="bs-stepper wizard-icons wizard-icons-example mb-5">
        <div class="bs-stepper-header m-auto border-0 py-4">
            <div class="step" data-target="#checkout-cart">
                <button type="button" class="step-trigger">
                    <!-- <span class="bs-stepper-icon">
                        <svg viewBox="0 0 58 54">
                            <use xlink:href="{{URL('public/assets/svg/icons/wizard-checkout-cart.svg#wizardCart')}}">
                            </use>
                        </svg>
                    </span>
                    <span class="bs-stepper-label">Cart</span> -->
                </button>
                <h4 class="py-3 mb-4"><span class="text-muted fw-light">Order/Checkout</span> </h4>
            </div>
        </div>
        <div class="bs-stepper-content border-top" id="wizard-checkout-form">
            <!-- <form id="wizard-checkout-form" onSubmit="return false"> -->
            <!-- Cart -->
            <div id="checkout-cart" class="content">
                <div class="row">
                    <!-- Cart left -->
                    <div class="col-xl-12 mb-3 mb-xl-0">
                        <h5>My Shopping Bag ({{$AddonOrder? count($AddonOrder)+1 : 0}} Items)</h5>
                        @if(!empty($order))
                        <h6>Product Details :</h6>
                        @else
                        <div class="bs-stepper-header m-auto border-0 py-4">
                            <div class="step active" data-target="#checkout-cart">
                                <button type="button" class="step-trigger" aria-selected="true">
                                    <span class="bs-stepper-icon">
                                        <svg viewBox="0 0 58 54">
                                            <use xlink:href="{{url('/')}}/public/assets/svg/icons/wizard-checkout-cart.svg#wizardCart">
                                            </use>
                                        </svg>
                                    </span>
                                    <!-- <span class="bs-stepper-label">Cart</span> -->
                                </button>
                            </div>
                        </div>
                        <h4 class="py-3 mb-4 text-center"><span class="text-muted fw-light">Your cart is empty. Please add product to continue.</span> </h4>
                        @endif
                    </div>
                    <div class="col-xl-8 mb-3 mb-xl-0">
                        @if(!empty($order))
                        <ul class="list-group mb-3">
                            <li class="list-group-item p-4">
                                <div class="d-flex gap-3">
                                    <div class="flex-grow-1">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p class="me-3" style="margin-top: 21px;">
                                                    <a href="javascript:void(0)" class="text-body">{{ucfirst($order->product_name)}} ({{ucfirst($order->hostname)}})</a>
                                                </p>
                                                {!! $order->description !!}
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-md-end">
                                                    <button type="button" onclick="removeProduct(`{{url('user/order/removeProduct/'.$order->id)}}`)" class="btn-close btn-pinned" aria-label="Close"></button>
                                                    <div class="my-2 my-md-4 mb-md-5">
                                                        <span class="text-primary">{{$order->code}}
                                                            {{number_format((float)$order->price, 2)}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <hr>
                        @endif
                        @php
                        $totalAmount3 = 0;
                        $OsPriceTax = 0;
                        $Osprice = 0;
                        $addonPrice = $order ? $order->price : 0;
                        $tax = $order ? $order->tax : 0;
                        $addonPriceTax = $addonPrice * ($tax / 100);
                        @endphp

                        @if($AddonOrder && count($AddonOrder) > 0)
                            <h6>Add-On Items :</h6>
                            @if(!empty($AddonOrder))
                                @foreach($AddonOrder as $Cart)
                                    @php
                                    $price = $Cart->price ?? 0;
                                    $tax = $Cart->tax ?? $tax; // Update tax rate if available, otherwise, keep the default value
                                    $addonPrice += (float)$price;
                                    $taxAmount = $price * ($tax / 100);
                                    $addonPriceTax += (float)$taxAmount;
                                    @endphp
                                    <ul class="list-group mb-3 mt-3">
                                        <li class="list-group-item p-4">
                                            <div class="d-flex gap-3">
                                                <div class="flex-grow-1">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <p class="me-3" style="margin-top: 21px;">
                                                                <a href="javascript:void(0)" class="text-body">{{ucfirst($Cart->product_name)}}</a>
                                                            </p>
                                                            {!! $Cart->description !!}
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="text-md-end">
                                                                <button type="button" onclick="removeAddons(`{{url('user/order/removeAddons/'.$Cart->id)}}`)" class="btn-close btn-pinned" aria-label="Close"></button>
                                                                <div class="my-2 my-md-4 mb-md-5">
                                                                    <span class="text-primary">{{$order->code}}
                                                                        {{number_format((float)$Cart->price, 2)}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                @endforeach
                            @endif
                        @endif

                        @if($OsOrder && count($OsOrder) > 0)
                        <h6>Operating Systems :</h6>
                            @if(!empty($OsOrder))
                                @foreach($OsOrder as $Carts)
                                    @php
                                    $Ostax = $Carts->tax ?? 00; // Update tax rate if available, otherwise, keep the default value
                                    $Osprice += (float)$Carts->os_price;
            
                                    $OstaxAmount = $Carts->os_price * ($Ostax / 100);
                                    $OsPriceTax += (float)$OstaxAmount;
                                    @endphp
                                    <ul class="list-group mb-3 mt-3">
                                        <li class="list-group-item p-4">
                                            <div class="d-flex gap-3">
                                                <div class="flex-grow-1">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <p class="me-3" style="margin-top: 21px;">
                                                                <a href="javascript:void(0)" class="text-body">{{ucfirst($Carts->ostype)}}</a>
                                                            </p>
                                                            {!! $Carts->ostype !!}
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="text-md-end">
                                                                <button type="button" onclick="removeAddons(`{{url('user/order/removeOsOrder/'.$order->id)}}`)" class="btn-close btn-pinned" aria-label="Close"></button>
                                                                <div class="my-2 my-md-4 mb-md-5">
                                                                  
                                                            <span class="text-primary">{{ $order->code }} {{ number_format((float)$Carts->os_price, 2) }}</span>
                                                        </div>
            
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                @endforeach
                            @endif
                        @endif
                    </div>
            @php
    // Calculate addonPrice
    $addonPrice = $addonPrice + $Osprice;

    // Format addonPrice as a numeric string with 2 decimal places
    $totalAmount = number_format($addonPrice, 2);

    // Assign addonPrice to totalAmount1
    $totalAmount1 = $addonPrice;

    // Format addonPriceTax as a numeric string with 2 decimal places
    $totalAmountTax = number_format($addonPriceTax, 2);

    // Assign addonPriceTax to totalAmountTax1
    $totalAmountTax1 = $addonPriceTax;

    // Assign addonPrice to totalAmountCart
    $totalAmountCart = $addonPrice;

    // Format Osprice as a numeric string with 2 decimal places
    $totalAmounts = number_format($Osprice, 2);

    // Format OsPriceTax as a numeric string with 2 decimal places
    $totalAmountTaxs = number_format($OsPriceTax, 2);

    // Assign OsPriceTax to totalAmountTax3
    $totalAmountTax3 = $OsPriceTax;

    // Assign Osprice to totalAmountCart (this might be redundant, check if necessary)
    $totalAmountCart = $Osprice;

    // Handle cases where variables might be null or non-numeric
    $totalAmount1 = $totalAmount1 ?? 0.00;
    $totalAmountTax1 = $totalAmountTax1 ?? 0.00;
    $totalAmounts = $totalAmounts ?? 0.00;
    $totalAmountTaxs = $totalAmountTaxs ?? 0.00;

    // Calculate final amount including tax
    $finalAmountRoz = ($totalAmount1 + $totalAmountTax1);
    if($clientDetails && $clientDetails->tax_exampt == 0){
        $tax = $order ? $order->tax : 0;
    }else{
        $tax = 0;
    }
     // Assuming $order is an object with a 'tax' property
    $totalAmountTax = $addonPrice * ($tax / 100);

    // Calculate final amount by adding tax to addonPrice
    $finalAmount = floatval($totalAmountTax) + floatval($addonPrice);

@endphp

                    <!-- Cart right -->
                    @if(!empty($order))
                    <div class="col-xl-4">
                        <input type="hidden" id="finalAmount" value="{{$finalAmount}}">
                        <div class="border rounded p-4 mb-3 pb-3">
                            <h5><b>Price Details</b></h5>
                            <hr class="mx-n4" />
                            <dl class="row mb-0">
                                <dt class="col-6 fw-normal text-heading">Order Total</dt>
                                <dd class="col-6 text-end">{{$order->code}} {{$totalAmount}}</dd>
                                <dt class="col-6 fw-normal text-heading">Total GST ({{$tax}})%</dt>
                                <dd class="col-6 text-end">{{$order->code}}       {{number_format($totalAmountTax,2)}} </dd>
                            </dl>
                            <hr class="mx-n4" />
                            <dl class="row mb-0">
                                <dt class="col-6 text-heading">Sub Total</dt>
                                <dd class="col-6 fw-medium text-end text-heading mb-0">{{$order->code}}
                                    {{number_format($finalAmount,2)}}
                                </dd>
                            </dl>
                        </div>
                        <dl class="row mb-2">
                            <dt class="col-6 fw-normal text-heading">
                               <input type="checkbox" name="wallet_amt" id="wallet_amt" value="{{$credits}}"> Wallet
                            </dt>
                            <dd class="col-6 text-end">{{$order->code}} {{$credits}}</dd>
                        </dl>
                        <hr>
                        <dl class="row mb-4">
                            <dt class="col-6 text-heading">Total</dt>
                            <dd class="col-6 fw-medium text-end text-heading mb-0">{{$order->code}}
                                <span id="totalWithWallet">{{number_format($finalAmount,2)}}
                            </dd>
                        </dl>
                        <!--<hr>-->
                        <div class="d-grid">
                            @if(floatVal($finalAmount) > 0)
                                <button class="btn btn-primary btn-next add-tds" data-id="{{ $order->invoice_id }}"  data-clientid="{{ $order->client_id }}" data-amount="{{ $finalAmount }}">Place Order</button>
                            @else
                                @if($order->plan_type == 'free')
                                    <button class="btn btn-primary btn-next btn-place-order">Place Order</button>
                                @else
                                    <button class="btn btn-primary btn-next btn-place-order" onClick="bootboxAlert()" data-id="{{ $order->invoice_id }}"  data-clientid="{{ $order->client_id }}" data-amount="{{ $finalAmount }}">Place Order</button>
                                @endif
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <!-- Payment -->
            <!-- </form> -->
        </div>
    </div>
</div>


<!-- Payment Methods modal -->
<div class="modal fade " id="paymentMethods" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-enable-otp modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close hide-payment-method" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-3">Select payment methods</h3>
                    <p class="text-muted">Supported payment methods</p>
                </div>
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" id="rzp-button1" style="cursor: pointer;">
                    <div class="d-flex gap-2 align-items-center">

                        <img src="../../assets/img/icons/payments/razor-light.png" class="img-fluid w-px-50 h-px-30" alt="visa-card" data-app-light-img="icons/payments/razor-light.png" data-app-dark-img="icons/payments/razor-light.png">

                        <h6 class="m-0">Razor Pay</h6>
                    </div>
                    <h6 class="m-0 d-none d-sm-block">Debit / Credit</h6>
                </div>
                <a href="{{ url('paypal/handle-payment?type=checkout&amount=' . $finalAmount.'&order_id=') }}{{$order ? $order->id : ''}}&currency_code={{$order ? $order->code : ''}}" id="paypalButton">
                    <div class="d-flex justify-content-sm-between align-items-center border-bottom pb-3 mb-3">

                        <div class="d-flex gap-2 align-items-center">
                            <img src="../../assets/img/icons/payments/paypal-light.png" class="img-fluid w-px-50 h-px-30" alt="american-express-card" data-app-light-img="icons/payments/paypal-light.png" data-app-dark-img="icons/payments/paypal-dark.png">
                            <h6 class="m-0">Paypal</h6>
                        </div>
                        <h6 class="m-0 d-none d-sm-block">Credit Card</h6>
                    </div>
                </a>

            </div>
        </div>
    </div>
</div>

<!-- payment method select modal end -->
<!-- modal for tds and remark -->

<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Payment Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span id="errorMsg" style="color:red"></span>
                <input type="hidden" id="invoiceId">
                <div class="mb-3">
                    <label for="selectBox" class="form-label">Payment Method</label>
                    <select class="form-control" id="selectBox">
                        <option value="0">Select</option>
                        <option value="1">Credit/Debit</option>
                        <option value="2">PayPal</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tdsPercent" >TDS Percent</label>
                    <select class="form-control"  id="tdsPercent" required>
                                <option value="">Select</option>
                                <option value="2">2%</option>
                                <option value="4">4%</option>
                                <option value="10">10%</option>
                                <option value="12">12%</option>
                                <option value="15">15%</option>
                                <option value="18">18%</option>
                                <option value="20">20%</option>
                                </select>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="showPaymentAmount">
                    <label class="form-check-label" for="showPaymentAmount">Full Payment</label>
                </div>
                
                <div class="mb-3" id="paymentAmountContainer" >
                    <label for="paymentAmount" class="form-label">Payment Amount : {{$default_currency->prefix}} <span id="totalAmount">0.00</span></label>
                    <input type="number" class="form-control" id="paymentAmount" required>
                    <input type="hidden" class="form-control" id="paymentAmounthidden">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button"  id="paymentFormSubmit" class="btn btn-primary">Save changes</button>
            </div>

        </div>

    </div>

</div>
      

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->


<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>

$('#wallet_amt').change(function(){
    var amount = "{{$finalAmount}}"; 
    var order_id = "{{$order ? $order->id : ''}}";
    var walletAmount = 0; // Initialize walletAmount variable
    if ($(this).is(':checked')) {
                var wallet_amt = $(this).val(); 
                 wallet_amt = $(this).val().replace(/,/g, '');
                wallet_amt = parseFloat(wallet_amt);
               // alert(wallet_amt);
                var finalAmt;
                if (parseFloat(amount) > wallet_amt) {
                    finalAmt = parseFloat(amount) - wallet_amt;
                    walletAmount = wallet_amt;
                } else {
                    finalAmt = 0;
                    walletAmount = parseFloat(amount);
                }
    } else {
        finalAmt = parseFloat(amount);
        walletAmount = 0; // If wallet is not checked, set walletAmount to 0
    }
    $('#totalWithWallet').text(finalAmt.toFixed(2)); // Update the displayed total amount with wallet consideration


        $('#paymentAmounthidden').val(finalAmt.toFixed(2)); // Format to 2 decimal places
        $('#paymentAmount').val(''); // Clear the payment amount input initially
        $('#totalAmount').text(finalAmt.toFixed(2)); 
        $('.btn-next').attr('data-amount', finalAmt.toFixed(2));



    // Update the PayPal button URL
    var paypalUrl = "{!! url('paypal/handle-payment?type=checkout&amount=') !!}" + finalAmt.toFixed(2) + '&order_id=' + order_id + '&wallet_amt=' + walletAmount.toFixed(2);
    $('#paypalButton').attr('href', paypalUrl);
});




    $('.add-tds').click(function() {

             var invoiceId = this.getAttribute('data-id');
        var clientid = this.getAttribute('data-clientid');
        var paymentAmount = parseFloat(this.getAttribute('data-amount'));
        $('#invoiceId').val(invoiceId);
        $('#paymentAmounthidden').val(paymentAmount.toFixed(2)); // Format to 2 decimal places
        $('#paymentAmount').val(''); // Clear the payment amount input initially
        $('#totalAmount').text(paymentAmount.toFixed(2)); // Clear the payment amount input initially
        $('#paymentModal').modal('show');
        

    });



    $('#showPaymentAmount').change(function() {

        var paymentAmounthidden = $('#paymentAmounthidden').val();

        var isChecked = $(this).is(':checked');

        if (isChecked) {

            $('#paymentAmount').val(paymentAmounthidden); // Format to 2 decimal places

        } else {

            $('#paymentAmount').val(''); // Clear the payment amount input

        }

    });




    
    document.getElementById('rzp-button1').onclick = function(e) {

       
        var paymentAmount = $('#paymentAmount').val();
        var payment = "{{$finalAmount}}";
        var amount = "{{$finalAmount}}";
        var orderId = "{{$order ? $order->id : 0}}";
        var amtWithoutGst = "{{$totalAmount}}";
        // var payment = payment.toFixed(2);
        var walletAmount = 0;
        var walletBalance = 0;
        if ($('#wallet_amt').is(':checked')) {
            walletAmount = parseFloat($('#wallet_amt').val()); 
            if (walletAmount > payment) {
                payment = 0;
                walletBalance = payment;
            } else {
                payment -= walletAmount;
                walletBalance = walletAmount;
            }
        }

        payment = paymentAmount;
        amountNew = paymentAmount+walletAmount;
        payment = payment*100;
             // alert(walletAmount);

     
        var options = {
            "key": "{{ $PaymentDetail->key_id ?? 'rzp_test_905d9rOq4TKriv' }}",
            "amount": payment,
            "currency": "{{$order ? $order->code : ''}}",
            "name": "CloudTechtiq",
            "image": "{{$PaymentDetail->logo_url ?? url('public/logo/company.png') }}",
            "theme": {
                "color": "{{$PaymentDetail->theme_color ?? '#3399cc'}}"
            },
            "handler": function(response) {
                window.location.href = "{{ url('user/order/update') }}?orderId=" + orderId + "&payment_id=" + response.razorpay_payment_id +"&paymentAmount=" + paymentAmount + "&amount=" + amountNew + "&amtWithoutGst=" + amtWithoutGst + "&walletBalance=" + walletBalance;
            }
        };
        var rzp1 = new Razorpay(options);
        rzp1.on('payment.failed', function(response) {
    
        });
        
        rzp1.open();
        e.preventDefault();
    }
    // user/order/deleteProductFormCheckOut/id
    function removeProduct(url) {
        bootbox.confirm({
            title: "Delete Product?",
            message: "Do you want to delete this product ?.",
            buttons: {
                cancel: {
                    label: '<i class="fa fa-times"></i> Cancel'
                },
                confirm: {
                    label: '<i class="fa fa-check"></i> Confirm'
                }
            },
            callback: function(result) {
                if (result == true) {
                    window.location.href = url;
                }
            }
        });
    }

    function removeAddons(url) {
        bootbox.confirm({
            title: "Delete Product?",
            message: "Do you want to delete this product ?.",
            buttons: {
                cancel: {
                    label: '<i class="fa fa-times"></i> Cancel'
                },
                confirm: {
                    label: '<i class="fa fa-check"></i> Confirm'
                }
            },
            callback: function(result) {
                if (result == true) {
                    window.location.href = url;
                }
            }
        });
    }

    $('#paymentFormSubmit').click(function() {

        // var orderId = $('#invoiceId').val();
        var tdsPercent = $('#tdsPercent').val();
        var wallet_amt = $('#wallet_amt').val();
        var remarks = $('#remarks').val();
        var orderId = "{{$order ? $order->id : 0}}";
        var amount = "{{$finalAmountRoz}}";
        var amtWithoutGst = "{{$totalAmount}}";
        var walletBalance = 0; 
        var invoiceId = $('#invoiceId').val();
        var paymentMethod = $('#selectBox').val();
        var tdsPercent = $('#tdsPercent').val();
        var showPaymentAmount = $('#showPaymentAmount').prop('checked');
        var paymentAmount = $('#paymentAmount').val();
        var creditAmount = $('#creditAmount').prop('checked');
        var creditBalance = parseFloat($('#creditBalance').text());


            if (!invoiceId || invoiceId.trim() === '') {
                $('#errorMsg').text("Please provide Invoice ID.");
                return; // Prevent form submission
            }
            if (paymentMethod === '0') {
                $('#errorMsg').text("Please select Payment Method.");
                return; // Prevent form submission
            }

        
            if (!paymentAmount || isNaN(paymentAmount) || parseFloat(paymentAmount) <= 0) {
                $('#errorMsg').text("Please provide valid Payment Amount.");
                return; // Prevent form submission
            }
                 
         
         
            if (wallet_amt > amount) {
                wallet_amt = wallet_amt-amount;
            } 
         
         $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        $.ajax({

            url: "{{ url('user/order/addTdsRemarkBeforePay') }}", // Controller route

            type: 'POST',

            data: {
                tdsPercent: tdsPercent,
                remarks: remarks,
                orderId: orderId,
                paymentMethod: paymentMethod,
                paymentAmount: paymentAmount,
                fullPaymentStatus: showPaymentAmount,
            },

            success: function(response) {
                if(response.success == true){
                   $('#paymentModal').modal('hide'); // Hide the modal on success
                   if($('#wallet_amt').is(':checked') && amount <= wallet_amt){
                       window.location.href = "{{ url('user/order/update') }}?orderId=" + orderId + "&payment_id=" + 'wallet_id' + "&paymentAmount=" + paymentAmount +"&amount=" + amount + "&amtWithoutGst=" + amtWithoutGst + "&walletBalance=" + wallet_amt;
                   }else{
                        $('#paymentMethods').modal('show'); 
                   }
                
            }else{
               $('#paymentModal').modal('hide'); // Hide the modal on success

            }
            },

            error: function(xhr, status, error) {

                // Handle error

                console.error(xhr.responseText);

                // Show error message

                $('#errorMsg').text("An error occurred. Please try again."); // Assuming you have an element with id 'errorMsg' to display the error message

            }

        });

    });



    function bootboxAlert() {
        bootbox.alert('Your cart is empty please add prodouct');
    }

    jQuery.noConflict();

    $('.hide-payment-method').click(function() {
        var modal = $('#paymentMethods');
        modal.hide(); // Hide the modal
        modal.removeClass('show');
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open').removeAttr('style');
        $('.btn-place-order').click();
    });
</script>

@endsection