@extends('layouts.admin')
@section('title', 'Cart')
@section('content')


<style>
    @media only screen and (max-width: 1200px) {
        .secondary-cart-sidebar {
            width: 100% !important;
        }

        .cart-body {
            width: 100% !important;
        }

        .secondary-cart-body {
            width: 100% !important;
        }

        #frmConfigureProduct {

            margin-top: 40px;
        }
    }



    .w-hidden {


        display: none;
    }


    .cart-body {
        /*float: right;*/
        width: 100%;
        position: relative;
        min-height: 1px;
        /*padding-right: 15px;*/
        /*padding-left: 15px;*/
        box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
        background-color: white;
    }

    div.header-lined h1 {
        margin-top: 0;
        margin-bottom: 15px;
        padding: 6px 0;
        border-bottom: 1px solid #ccc;
        font-weight: 400;
        color: #006D77;
    }

    .font-size-36 {
        font-size: 36px;
    }


    .sidebar-collapsed {
        margin-top: 20px;
        padding: 4px;
        border-radius: 4px;
    }

    @media only screen and (min-width: 1200px) {
        .sidebar-collapsed {
            display: none;
        }
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, .125);
        border-radius: 0.25rem;
    }

    .secondary-cart-body {
        float: left;
        width: 100%;
        position: relative;
        min-height: 1px;
        padding-right: 15px;
        padding-left: 15px;
    }

    .product-info {
        margin: 0 0 20px 0;
        padding: 6px 15px;
        font-size: .85em;
        background-color: #f8f8f8;
        border-top: 1px solid #efefef;
        border-bottom: 1px solid #efefef;
    }

    .product-info .product-title {
        margin: 0;
        font-size: 1.6em;
    }


    ol,
    ul {
        list-style: none;
    }

    .form-group {
        position: relative;
    }


    #order-standard_cart label,
    #order-standard_cart p.domain-renewal-desc {
        margin-right: 10px;
        font-weight: 300;
        font-size: 13px;
        color: #666;
    }



    #order-standard_cart .panel-addon .panel-body {
        border-radius: 4px;
    }

    .icheckbox_square-blue {
        background-position: 0 0;
    }


    .icheckbox_square-blue,
    .iradio_square-blue {
        display: inline-block;
        vertical-align: middle;
        margin: 0;
        padding: 0;
        width: 22px;
        height: 22px;
        background: url(blue.png) no-repeat;
        border: none;
        cursor: pointer;
    }


    .clearfix::after {
        display: block;
        clear: both;
        content: "";
    }

    .float-left {
        float: left !important;
    }

    .float-right {
        float: right !important;
    }


    .btn-lg {
        padding: 0.5rem 1rem;
        font-size: 1.25rem;
        border-radius: 0.3rem;
    }


    .order-summary .total-due-today span {
        display: block;
        text-align: right;
    }


    /*.order-summary .total-due-today .amt {
    font-size: 2.3em;
}*/


    .order-summary .summary-totals {
        margin: 5px 0;
        padding: 5px 0;
        border-top: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
    }


    .order-summary .product-group {
        margin: 0 0 5px 0;
        display: block;
        font-style: italic;
    }


    .order-summary .product-name {
        display: block;
        font-weight: 700;
        font-size: 1.2em;
    }


    .summary-container {
        margin: 0;
        padding: 10px;
        min-height: 100px;
        /*border-radius: 3px;*/
        background-color: #f8f8f8;
        font-size: .8em;
    }


    .order-summary h2 {
        margin: 0;
        padding: 10px;
        color: #fff;
        text-align: center;
        font-size: 1.4em;
        font-weight: 400;
    }




    .order-summary .loader {
        position: relative;
        top: 10px;
        height: 0;
        padding-right: 10px;
        text-align: right;
        color: #efefef;
    }




    .order-summary {
        margin: 0 0 1px 0;
        padding: 0;
        background-color: #666;
        border-bottom: 3px solid #666;
        border-radius: 4px;
        /* position: absolute; */
    }



    .secondary-cart-sidebar {
        /*float: right;*/
        width: 100%;
        position: relative;
        min-height: 1px;
        /*padding-right: 15px;*/
        /*padding-left: 15px;*/
        /*top:0px !important;*/
    }


    .info-text-sm {
        font-size: .85em;
        text-align: center;
    }



    .panel-addon .panel-add {
        display: block;
        padding: 4px;
        background-color: #7367f0a8;
        color: #333;
        border-radius: 0 0 4px 4px;
    }

    .panel-addon {
        font-size: .8em;
        text-align: center;
    }

    .sub-heading {
        height: 0;
        border-top: 1px solid #ddd;
        text-align: center;
        margin-top: 20px;
        margin-bottom: 30px;
    }


    .form-group {
        margin-bottom: 25px;
    }


    .sub-heading span,
    #order-standard_cart .sub-heading-borderless span {
        display: inline-block;
        position: relative;
        padding: 0 8px;
        top: -11px;
        font-size: 16px;
        color: #7367f0;
        background-color: white;
    }




    .form-control {
        position: relative;
        vertical-align: top;
        border: 1px solid #ddd;
        display: -moz-inline-stack;
        display: inline-block;
        color: #626262;
        outline: 0;
        background-color: #fff;
        border-radius: 3px;
    }
</style>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>

<body>

    <div class="row mx-0 gy-3 px-lg-5">
        <div class="col-lg-7 mb-md-0 mb-4  mt-5">
            <div class="cart-body">

                <div class="header-lined">
                    <h1 class="" style="padding: 6px;
    border-radius: 4px;
    border-bottom: 5px solid #7367f0;
    background-color: #515151;
    color: white;
    font-size: 28px;">Configure</h1>
                </div>

                <div class="sidebar-collapsed">

                    <div class="panel card panel-default">
                        <div class="m-0 panel-heading card-header">
                            <h3 class="panel-title">
                                <i class="fas fa-plus"></i>&nbsp;

                                Actions

                            </h3>
                        </div>

                        <div class="panel-body card-body">
                            <form role="form">
                                <select class="form-control custom-select" onchange="selectChangeNavigate(this)">
                                    <option menuitemname="View Cart" value="/cart.php?a=view" class="list-group-item">
                                        View Cart
                                    </option>
                                    <option value="" class="list-group-item" selected="">- Choose Another Category -
                                    </option>
                                </select>
                            </form>
                        </div>

                    </div>
                    <div class="panel card panel-default">
                        <div class="m-0 panel-heading card-header">
                            <h3 class="panel-title">
                                <i class="fas fa-plus"></i>&nbsp;

                                Choose Currency

                            </h3>
                        </div>

                        <div class="panel-body card-body">
                            <form role="form">
                                <select class="form-control custom-select" onchange="selectChangeNavigate(this)">
                                    <option value="" class="list-group-item" selected="">- Choose Another Category -
                                    </option>
                                </select>
                            </form>
                        </div>

                    </div>

                    <div class="pull-right form-inline float-right">
                        <form method="post" action="/cart.php?a=confproduct">
                            <input type="hidden" name="token" value="ee71f29718b735f5ede0259d091929f969a6b81e">
                            <select name="currency" onchange="submit()" class="form-control">
                                <option value="">Choose Currency</option>
                                @foreach($all_currency as $all_currencys)
                                <option value="{{$all_currencys->id}}" selected="">{{$all_currencys->prefix}}</option>

                                @endforeach
                            </select>
                        </form>
                    </div>

                </div>

                <form id="frmConfigureProduct">
                    <span style="color: red; display:none" id="validation_msg" class="alert alert-danger"></span>
                    <input type="hidden" name="configure" value="true">
                    <input type="hidden" name="i" value="3">

                    <div class="row">
                        <div class="secondary-cart-body">

                            <p>Configure your desired options and continue to checkout.</p>

                            <div class="product-info">
                                <p class="product-title">{{$products->product_name}}</p>
                                <p></p>
                                <ul class="cloud-plan" style="padding:0 !important;"><br>
                                    <li class="truncated-description">{!! $products->description !!}</li>
                                </ul>
                                <p></p>
                            </div>
                            <span id="selected_prod_id" style="display:none;">{{$products->id}}</span>

                            <div class="alert alert-danger w-hidden" role="alert" id="containerProductValidationErrors">
                                <p>Please correct the following errors before continuing:</p>
                                <ul id="containerProductValidationErrorsList"></ul>
                            </div>

                            <div class="field-container">
                                <div class="form-group">
                                    <label for="inputBillingcycle">Choose Billing Cycle</label>
                                    <br>

                                    <select class="form-control" name="billingcycle" id="inputBillingcycle">

                                        @foreach($BillingCycles as $key => $addOnProduct)

                                        <option value="{{$addOnProduct->id}}" @if(session('orderDetail') &&
                                            $addOnProduct->price == session('orderDetail')['withoutGst']) selected
                                            @endif >
                                            {{$default_currency->prefix}} {{number_format($addOnProduct->price,2)}}
                                            {{$default_currency->code}}
                                            @if($addOnProduct->payment_type == 1)
                                            Free
                                            @elseif($addOnProduct->payment_type == 2)
                                            One Time
                                            @elseif($addOnProduct->payment_type == 3)
                                            @php $options =
                                            ['Hourly','Monthly','Quarterly','Semiannually','Annually','Biennially','Triennially']
                                            @endphp

                                            {{$options[$key]}}

                                            @endif
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="sub-heading">
                                <span class="primary-bg-color">Configure Server</span>
                            </div>

                            <div class="field-container">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputHostname">Hostname</label>
                                            <input type="text" name="hostname" class="form-control" id="inputHostname"
                                                value="" placeholder="servername.example.com" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sub-heading">
                                <span class="primary-bg-color">Configurable Options</span>
                            </div>
                            <div class="product-configurable-options" id="productConfigurableOptions">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputConfigOption72">Operating System</label>
                                            <select name="os_id" id="inputConfigOption72" class="form-control">
                                                <option value="" selected>Select Operating System</option>
                                                @foreach($operating_systems as $operating_system)
                                                <option value="{{ $operating_system->id }}"
                                                    operating-system="{{$operating_system->ostype}}">
                                                    {{ $operating_system->ostype }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputConfigOption70">Hosting Control Panel</label>
                                            <select name="hosting_panel_id" id="inputConfigOption70"
                                                class="form-control">
                                                <option value="" selected>Select Hosting Control Panel</option>
                                                @foreach($hosting_control_panels as $hosting_control_panel)
                                                <option value="{{ $hosting_control_panel->id }}"
                                                    data-price="{{ $hosting_control_panel->price }}"
                                                    hostingControlPanel="{{$hosting_control_panel->hosting_name}}">
                                                    {{ $hosting_control_panel->hosting_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                </div>
                            </div>




                            <div id="productAddonsContainer">
                                <div class="sub-heading">
                                    <span class="primary-bg-color">Available Addons</span>
                                </div>


                                <div class="row addon-products">
                                    @if($addOnProducts)
                                    @foreach($addOnProducts as $addOnProduct)

                                    <div class=""
                                        onClick="addToCart(`{{$addOnProduct->price}}`,`{{$products->tax_percent}}`,`{{$default_currency->prefix}}`,`{{$default_currency->code}}`,`{{isset($addOnProduct->product_name) ? ucfirst($addOnProduct->product_name) :'' }}`,`{{$addOnProduct->product_add_id}}`,`{{$products->tax_percent}}`,`{{$products->product_id}}`)">

                                        <div class="panel card panel-default panel-addon">
                                            <div class="panel-body card-body">
                                                <label>

                                                    <div class="icheckbox_square-blue" style="position: relative;">
                                                        <input type="checkbox" name="addons[5]"
                                                            style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                                        <ins class="iCheck-helper"
                                                            style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                                        </ins>
                                                    </div>
                                                    <strong>{{isset($addOnProduct->product_name) ?? '' }}</strong>
                                                </label><br>
                                                <ul class="cloud-plan" style="padding:0 !important">
                                                    <li>{!! $addOnProduct->descriptions !!}</li>

                                                </ul>
                                            </div>
                                            <div class="panel-price" id="addons_price">
                                                {{$default_currency->prefix}} {{$addOnProduct->price}}
                                                {{$default_currency->code}} Monthly
                                            </div>
                                            <div class="panel-add">
                                                <i class="fas fa-plus"></i>
                                                Add to Cart
                                            </div>
                                        </div>

                                    </div>
                                    @endforeach
                                    @endif

                                </div>
                            </div>

                            <div class="alert alert-warning info-text-sm">
                                <i class="fas fa-question-circle"></i>
                                Have questions? Contact our sales team for assistance. <a href="/contact.php"
                                    target="_blank" class="alert-link">Click here</a>
                            </div>

                        </div>


                    </div>

            </div>

            </form>
        </div>
        <div class="col-lg-5 mt-5">
            <div class="secondary-cart-sidebar" id="scrollingPanelContainer"
                style="top: 0px;box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;/* padding: 0px; */background-color: white;">

                <div id="orderSummary" style="margin-top: 0px;">
                    <div class="order-summary">
                        <div class="loader" id="orderSummaryLoader" style="display: none;">
                            <i class="fas fa-fw fa-sync fa-spin"></i>
                        </div>
                        <h2 class="font-size-30" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
                            background-color: white;
                            padding: 6px;
                            border-radius: 4px;
                            border-bottom: 5px solid #7367f0;
                            background-color: #515151;
                            color: white;
                            font-size: 28px;
                        "">Order Summary</h2>
                            <div class=" summary-container" id="producttotal">
                            <span class="product-name">{{$products->product_name}}</span>



                            <div class="clearfix">
                                <span class="pull-left float-left" id="productName">{{$products->product_name}}</span>
                                <span class="pull-right float-right">{{$default_currency->code}}&nbsp;</span>
                                <span class="pull-right float-right"
                                    id="amtWithoutGst">{{session('orderDetail')['withoutGst']}}
                                </span>
                                <span class="pull-right float-right">{{$default_currency->prefix}}</span>
                            </div>

                            <div class="opersys" id="opersys"></div>
                            <div class="clearfix"></div>
                            <div class="HostContPanel" id="HostContPanel"></div>

                            <div class="clearfix addOnProductDetails">

                            </div>


                            <input type="hidden" id="order_Id">

                            <div class="summary-totals">
                                <div class="clearfix">
                                    <span class="pull-left float-left">Setup Fees:</span>
                                    <span class="pull-right float-right">{{$default_currency->prefix}} 0.00
                                        {{$default_currency->code}}</span>
                                </div>
                                <div class="clearfix">
                                    <span class="pull-left float-left" id="payment_interval">Monthly:</span>
                                    <span class="pull-right float-right">
                                        {{$default_currency->prefix}}
                                        <span id="payment_interval_amt">{{session('orderDetail')['withoutGst']}}</span>
                                        {{$default_currency->code}}
                                    </span>
                                </div>
                                <div class="clearfix">
                                    <span class="pull-left float-left">{{$products->tax_name}}
                                        ({{$products->tax_percent}}%) @ {{$products->tax_percent}}.00%:</span>
                                    @php
                                    $totalAmount = $products->price * ($products->tax_percent / 100);
                                    $formattedTotalAmount = number_format($totalAmount, 2);
                                    $formattedTotalAmounts = $totalAmount;
                                    @endphp
                                    <div class="pull-right float-right">
                                        <span>{{$default_currency->prefix}}</span>
                                        <span class="gstAmount" formattedTotalAmount="{{$formattedTotalAmounts}}"> {{
                                            $formattedTotalAmount }}</span>
                                        <input type="hidden" id="amoutGst" value="{{$formattedTotalAmounts}}">
                                        <span> {{$default_currency->code}}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="total-due-today">
                                @php
                                $totalDueToday = $totalAmount + session('orderDetail')['withoutGst'];
                                $formattedTotalDueToday = number_format($totalDueToday, 2);
                                $totalDueToday = $totalDueToday;
                                @endphp

                                <span class="pull-right float-right">{{ $default_currency->code }}&nbsp;</span>
                                <span class="pull-right float-right formattedTotalDueToday" attr="{{$totalDueToday}}">{{
                                    $formattedTotalDueToday }}</span>
                                <span class="amt pull-right float-right">&nbsp;{{ $default_currency->prefix }}</span>
                                <span id="total_amt" style="display: none">{{ $totalDueToday }}</span>

                            </div>
                            <span>Total Due Today</span>
                    </div>
                </div>
            </div>
            <div class="text-center" style="padding: 6px 0;">
                <button type="button" id="btnCompleteProductConfigs"
                    onClick="orderCheckOut(`{{url('user/order/checkOutPage')}}`)" class="btn btn-primary btn-lg">
                    Continue
                    <i class="fas fa-arrow-circle-right" style="padding:4px;"></i>
                </button>
            </div>
        </div>

    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>

        var selectedOptionText = $('#inputBillingcycle').find('option:selected').text().trim();
        var parts = selectedOptionText.split(/\s+/);
        $('#payment_interval').text(parts[3]);
        $('#payment_interval_amt').text(parts[1]);

        $(document).ready(function () {
            var timeout = null; // Variable to store timeout reference



            $(window).scroll(function () {
                var scrollPos = $(window).scrollTop();
                var maxHeight = 1500; // Adjust the maximum height where you want to stop the div

                // Clear previous timeout to avoid multiple executions
                clearTimeout(timeout);

                // Use a timeout to delay the adjustment of sidebar position
                timeout = setTimeout(function () {
                    // Check if scroll position is below the maximum height
                    if (scrollPos < maxHeight) {
                        // Smoothly animate the top position of the sidebar
                        $('.secondary-cart-sidebar').stop().animate({
                            'top': scrollPos + 10 // Adjust the value as needed
                        }, 200); // Adjust animation duration as needed for smoother effect
                    }
                }, 20); // Use a smaller delay for smoother scrolling
            });
        });



        $(document).ready(function () {

            var price = 0;
            var prefix = 0;
            var addOnProductId = 0;
            var code = 0;
            var tax = 0;
            var product_id = null;

            $('#inputConfigOption72').change(function () {
                var selectedOptionId = $(this).find('option:selected').val();
                var selectedOptionText = $(this).find('option:selected').text();
                var product_name = $(this).find('option:selected').attr('operating-system');

                $('#selected_os_name').text(selectedOptionText);
                addOrder(price, addOnProductId, tax, product_id);

                $('#opersys').html('<div class="clearfix">' +
                    '<span class="pull-left float-left" id="productName">' + product_name + '</span>' +
                    '<span class="pull-right float-right">' + code + '&nbsp;</span>' +
                    '<span class="pull-right float-right">' + price + '&nbsp;</span>' +
                    '<span class="pull-right float-right">' + prefix + '</span>' +
                    '</div>');

                // addOnProductDetails(price=0, prefix=0, code=0, product_name, tax_percent=0,addOnProductId=0,tax=0);
                // $('#selected_os_price').text();

            });




            $('#inputConfigOption70').change(function () {
                var selectedOptionId = $(this).find('option:selected').val();
                var selectedOptionPrice2 = $(this).find('option:selected').attr('data-price');
                var product_name = $(this).find('option:selected').attr('hostingControlPanel');
                var selectedOptionPrice = parseFloat($(this).find('option:selected').attr('data-price')).toFixed(2);
                var selectedOptionText = $(this).find('option:selected').text();
                $('#hosting_control_panel_name').text(selectedOptionText);
                $('#hosting_panel_price').text(selectedOptionPrice);
                var total_amt = $('#total_amts').text();
                var totals = total_amt + selectedOptionPrice2;
                $('#total_amt').text(totals);

                addOrder(price, addOnProductId, tax, product_id);

                $('#HostContPanel').html('<div class="clearfix">' +
                    '<span class="pull-left float-left" id="productName">' + product_name + '</span>' +
                    '<span class="pull-right float-right">' + code + '&nbsp;</span>' +
                    '<span class="pull-right float-right">' + price + '&nbsp;</span>' +
                    '<span class="pull-right float-right">' + prefix + '</span>' +
                    '</div>');
                // addOnProductDetails(price=0, prefix=0, code=0, product_name, tax_percent=0,addOnProductId=0,tax=0);
            });



            $('#inputBillingcycle').change(function () {
                var selectedOptionText = $(this).find('option:selected').text().trim();
                var parts = selectedOptionText.split(/\s+/);
                $('#payment_interval').text(parts[3]);
                $('#payment_interval_amt').text(parts[1]);
                $('#amtWithoutGst').text(parts[1]);

                var total_tax = parseFloat((parts[1] * "{{$products->tax_percent}}" / 100));

                $('.gstAmount').text(total_tax.toFixed(2));
                $('.gstAmount').attr('formattedTotalAmount', total_tax);
                var addonPrice = parseFloat($('#addonPrice').text());
                var totalAmount = parseFloat(parts[1]);
                var totalTaxAmount;
                if (!isNaN(addonPrice)) {
                    totalTaxAmount = (parseFloat(totalAmount) + parseFloat(total_tax) + parseFloat(addonPrice)).toFixed(2);
                } else {
                    totalTaxAmount = (parseFloat(totalAmount) + parseFloat(total_tax)).toFixed(2);
                }

                // Update the text content of '.formattedTotalDueToday' with the new calculated amount
                $('.formattedTotalDueToday').text(totalTaxAmount);
            });





        });
        ////////Add to cart
        var addedProducts = [];
        var removedProducts = [];

        function addToCart(price, tax_percent, prefix, code, product_name, addOnProductId, tax, product_id) {

            if (addedProducts.includes(code)) {
                if (removedProducts.includes(code)) {
                    // Product was already added and then removed, now re-adding
                    removedProducts.splice(removedProducts.indexOf(code), 1); // Remove from removedProducts array
                } else {
                    // Product was already added, now removing
                    removeAddedProduct(price, tax_percent);

                    removedProducts.push(code); // Mark the product as removed
                    return;
                }
            }

            addedProducts.push(code);
            var total_tax = parseFloat((price * tax_percent / 100).toFixed(2));

            var gstAmount = parseFloat($('.gstAmount').attr('formattedTotalAmount'));
            var gstAmounttotal_tax = parseFloat(((gstAmount) + (total_tax)).toFixed(2));
            var gstAmount3 = parseFloat($('#amoutGst').val());
            var totalGstAmount = (total_tax + gstAmount3).toFixed(2);

            var totalGstAmount1 = (total_tax + gstAmount3);

            $('.gstAmount').html(totalGstAmount);
            $('#amoutGst').val(totalGstAmount1);

            var totalTaxAmountprice = parseFloat((price));
            var totalTaxAmounttotal_tax = parseFloat((total_tax));
            var totalTaxAmount = (totalTaxAmountprice + totalTaxAmounttotal_tax);

            var formattedTotalDueToday = parseFloat($('.formattedTotalDueToday').html().replace(/,/g, ''));
            var totalTaxAmount = (formattedTotalDueToday + totalTaxAmount).toFixed(2);

            var totalAmountWithTax = parseFloat(((price) + (total_tax)));
            var totalFinalAmount = parseFloat(formattedTotalDueToday) + parseFloat(totalAmountWithTax)

            $('.formattedTotalDueToday').html(totalTaxAmount);
            addOnProductDetails(price, prefix, code, product_name, tax_percent, addOnProductId, tax, product_id);
        }
        //////append product in order summery
        function addOnProductDetails(price, prefix, code, product_name, tax_percent, addOnProductId, tax, product_id) {
            addOrder(price, addOnProductId, tax, product_id);
            $('.addOnProductDetails').append('<div class="clearfix">' +
                '<span class="pull-left float-left" id="productName">' + product_name + '</span>' +
                '<span class="pull-right float-right">' + code + '&nbsp;</span>' +
                '<span class="pull-right float-right" id="addonPrice">' + price + '&nbsp;</span>' +
                '<span class="pull-right float-right">' + prefix + '</span>' +
                '</div>'
            );
        }
        /////remove added product
        function removeAddedProduct(price, tax_percent) {
            deleteOrder();
            var total_tax_price = parseFloat(price);
            var total_tax_tax_percent = parseFloat(tax_percent);
            var total_tax = (total_tax_price * total_tax_tax_percent / 100);
            var totalTaxAmount = $('.formattedTotalDueToday').html();
            var gstAmount = $('.gstAmount').html();
            var gstVarAmount = (gstAmount - total_tax).toFixed(2);
            var totalAmount = total_tax + total_tax_price;
            var totalAmt = totalTaxAmount - totalAmount;
            var totalAmount = totalAmt.toFixed(2);

            $('.gstAmount').html(gstVarAmount);
            $('#amoutGst').val(gstVarAmount);
            $('.formattedTotalDueToday').html(totalAmount);

            $('.addOnProductDetails .clearfix:last').remove();
            // $('.addOnProductDetails:last .appendedContent').remove();
        }
        ////////////////ADD ORDER
        function addOrder(price, addOnProductId, tax, product_id) {

            var addOnProductId = addOnProductId;
            var tax = tax;
            var price = price;
            var product_id = product_id;

            var total_amt = $('.formattedTotalDueToday').text();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('user/get-related-datas/submit_cart_order') }}",
                method: 'POST',
                data: {
                    addOnProductId: addOnProductId,
                    price: price,
                    total_amt: total_amt,
                    tax: tax,
                    product_id: product_id,
                },
                success: function (resp) {
                    // alert(resp.orderId);
                    $('#order_Id').val(resp.orderId);
                }
            })
        }
        ////////////////ADD ORDER
        function deleteOrder() {
            var id = $('#order_Id').val();
            // alert(order_Id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('user/order/delete') }}",
                method: 'get',
                data: { id: id },
                success: function (resp) {
                    console.log(resp);

                }
            })
        }

        //////reload on checkout page
        function orderCheckOut(url) {
            var isSuccess = validateForm();
            if (isSuccess) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('user/order/addCart') }}",
                    method: 'post',
                    success: function (resp) {
                        window.location.href = url;
                    }
                });
            }




        }


        // Function to validate the form fields
        function validateForm() {
            const hostname = document.getElementById('inputHostname').value.trim();
            const osId = document.getElementById('inputConfigOption72').value;
            const hostingPanelId = document.getElementById('inputConfigOption70').value;

            const errors = [];

            // Validate hostname
            if (hostname === '') {
                errors.push('Please enter hostname');
            }

            // Validate operating system
            if (osId === '') {
                errors.push('Please select operating system');
            }

            // Validate hosting panel
            if (hostingPanelId === '') {
                errors.push('Please select hosting control panel');
            }

            // Display error messages
            const validationMsg = document.getElementById('validation_msg');
            if (errors.length > 0) {
                validationMsg.innerText = errors.join('\n');
                validationMsg.style.display = 'block'; // Show the validation message
                return false; // Prevent form submission
            } else {
                validationMsg.innerText = ''; // Clear previous error messages
                validationMsg.style.display = 'none'; // Hide the validation message
                return true; // Allow form submission
            }
        }

        // // Function to handle form submission
        // function handleSubmit(event) {
        //   event.preventDefault(); // Prevent default form submission
        //   const isValid = validateForm();
        //   if (isValid) {
        //     // Perform form submission
        //     orderCheckOut('{{ url('/checkout') }}'); // Call your submit function here
        //   }
        // }

        // // Add event listener to the submit button
        // document.getElementById('btnCompleteProductConfigs').addEventListener('click', handleSubmit);

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    @endsection