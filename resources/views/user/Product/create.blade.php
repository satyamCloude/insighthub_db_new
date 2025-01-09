@extends('layouts.admin')

@section('title', 'Order')

@section('content')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .inner_container {

            background-color: white;

            box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;

        }

        .tabs_inside {
            background-color: #7367f0;
            margin: 20px;
        }

        F #order-standard_cart .panel-addon .panel-body {
            border-radius: 4px;

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
        
        .order_summary .select2-container--default{
            width:120px!important;
        }
    </style>



    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>



    <div class="container-xxl flex-grow-1 container-p-y">

        <h2 class="text-left">Configure your Products</h2>

        <form action="{{ url('user/get-related-datas/submit_cart_order') }}" method="post"
            onsubmit="return validateForm(event)">

            @csrf

            <div class="row">

                <div class="col-md-8">

                    <div class="border rounded" style="background-color: white">

                        <div class="row">

                            <div class="col-12 mb-4">

                                <!--  <span class="text-light fw-medium mt-2">Basic</span> -->

                                <div class="bs-stepper wizard-modern wizard-modern-example mt-2">

                                    <div class="bs-stepper-header">

                                        <div class="step active" data-target="#personal-info-modern">

                                            <button type="button" class="step-trigger" id="second-step"
                                                aria-selected="false">

                                                <span class="bs-stepper-circle">1</span>

                                                <span class="bs-stepper-label">

                                                    <span class="bs-stepper-title">Configure Products</span>

                                                    <span class="bs-stepper-subtitle">Configure your selected

                                                        products</span>

                                                </span>

                                            </button>

                                        </div>

                                        @if ($addOnProducts)
                                            <div class="line">

                                                <i class="ti ti-chevron-right"></i>

                                            </div>

                                            <div class="step" data-target="#social-links-modern">

                                                <button type="button" class="step-trigger" aria-selected="false">

                                                    <span class="bs-stepper-circle">2</span>

                                                    <span class="bs-stepper-label">

                                                        <span class="bs-stepper-title">Add-Ons</span>

                                                        <span class="bs-stepper-subtitle">Maximise your utility with

                                                            add-ons</span>

                                                    </span>

                                                </button>

                                            </div>
                                        @endif

                                    </div>

                                    <div class="bs-stepper-content" style="box-shadow:none;padding-bottom:0px;">


                                        <!-- Personal Info -->

                                        <div id="personal-info-modern" class="content active dstepper-block ">

                                            <div class="content-header mb-3">
                                                <div id="validation_msg" style="display: none; color: red;"></div>

                                                <h6 class="mb-0">Configure Server</h6>

                                                <small>Configure your desired options and continue to checkout.</small>

                                                <div style="color: red; display:none" id="validation_msg"
                                                    class="alert text-danger"></div>

                                            </div>

                                            <div class="row g-3">

                                                <div class="col-sm-6">

                                                    <label class="form-label " for="first-name-modern">Choose Billing
                                                        Cycle*</label>
                                                    <select class="form-control select2" name="billingcycle"
                                                        id="inputBillingcycle" placeholder="">
                                                        @foreach ($BillingCycles as $key => $BillingCycle)
                                                            <option value="{{ $BillingCycle->id }}"
                                                                @if ($order && $order->billing_cycle == $BillingCycle->id) selected @endif>
                                                                {{ $default_currency->prefix }}
                                                                {{ number_format($BillingCycle->price, 2) }}
                                                                {{ $default_currency->code }}
                                                                @if ($BillingCycle->product_plan == 1 || $BillingCycle->payment_type == 1)
                                                                    {{ ucfirst($BillingCycle->plan_type) }}
                                                                    <!-- Capitalize the first letter of plan_type -->
                                                                @elseif($BillingCycle->product_plan == 2 && $BillingCycle->payment_type == 2)
                                                                    {{ ucfirst($BillingCycle->plan_type) }}
                                                                    <!-- Capitalize the first letter of plan_type -->
                                                                @elseif($BillingCycle->product_plan == 3 && $BillingCycle->payment_type == 3)
                                                                    {{ ucfirst($BillingCycle->plan_type) }}
                                                                    <!-- Capitalize the first letter of plan_type -->
                                                                @endif
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>

                                                <div class="col-sm-6">

                                                    <label class="form-label" for="last-name-modern">Host Name/Domain
                                                        Name*</label>

                                                    <input type="text" name="hostname" class="form-control"
                                                        id="inputHostname"
                                                        @if ($order && $order->hostname) value="{{ $order->hostname }}" @endif
                                                        placeholder="servername.example.com">

                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label" for="country-modern">Operating System </label>
                                                    <select name="os_id" id="inputConfigOption72"
                                                        class="form-control select2">
                                                        <option value="">Select Operating System</option>
                                                        @foreach ($operating_systems as $operating_system)
                                                            <option value="{{ $operating_system->id }}"
                                                                data-price="{{ $operating_system->price }}"
                                                                data-prefix="{{ $operating_system->prefix }}"
                                                                data-code="{{ $operating_system->code }}"
                                                                @if ($order && $order->os_id == $operating_system->id) selected @endif
                                                                operating-system="{{ $operating_system->ostype }}">
                                                                {{ $operating_system->ostype }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-12 order_summary d-flex justify-content-between">

                                                    <button class="btn btn-label-secondary btn-prev waves-effect"
                                                        id="prev2"
                                                        @if ($addOnProducts) @else disabled @endif>

                                                        <i class="ti ti-arrow-left me-sm-1 me-0" type="button"></i>

                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>

                                                    </button>

                                                    <button class="btn btn-primary btn-next waves-effect waves-light"
                                                        id="btn2" type="button"
                                                        @if ($addOnProducts) @else disabled @endif>

                                                        <span
                                                            class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>

                                                        <i class="ti ti-arrow-right"></i>

                                                    </button>

                                                </div>

                                            </div>

                                        </div>

                                        <!-- Social Links -->

                                        <div id="social-links-modern" class="content">

                                            <div class="content-header mb-3">

                                                <h6 class="mb-0">Available Addons</h6>

                                                <small>Select your desired addons.</small>

                                            </div>

                                            <div class="row g-3">

                                                <div class="col-sm-12">



                                                    @if ($addOnProducts)
                                                    <div id="addon_products">
                                                        @foreach ($addOnProducts as $addOnProduct)
                                                            <div class="mt-3"
                                                                onClick="addToCart(`{{ $addOnProduct->price }}`,`{{ $products->tax_percent }}`,`{{ $default_currency->prefix }}`,`{{ $default_currency->code }}`,`{{ isset($addOnProduct->product_name) ? ucfirst($addOnProduct->product_name) : '' }}`,`{{ $addOnProduct->id }}`,`{{ $products->tax_percent }}`,`{{ $products->product_id }}`)">
                                                                <div class="panel card panel-default panel-addon">

                                                                    <div class="panel-body card-body">

                                                                        <label>



                                                                            <div class="icheckbox_square-blue"
                                                                                style="position: relative;">

                                                                                <input type="checkbox" name="addons[5]"
                                                                                    style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">

                                                                                <ins class="iCheck-helper"
                                                                                    style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">

                                                                                </ins>

                                                                            </div>

                                                                            <strong>{{ $addOnProduct->product_name ?? '' }}</strong>

                                                                        </label><br>

                                                                        {!! $addOnProduct->descriptions ?? '' !!}

                                                                    </div>

                                                                    <div class="panel-price" id="addons_price">

                                                                        {{ $default_currency->prefix }}
                                                                        {{ $addOnProduct->price }}

                                                                        {{ $default_currency->code }} Monthly

                                                                    </div>

                                                                    <div class="panel-add text-white">

                                                                        <i class="fas fa-plus"></i>

                                                                        <span
                                                                            id="addon-button{{ $addOnProduct->id }}">ADD</span>
                                                                        <input type="hidden" name="addon_product[]">

                                                                    </div>

                                                                </div>



                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    @endif

                                                </div>

                                                <div class="col-12 d-flex justify-content-between">

                                                    <button class="btn btn-label-secondary btn-prev waves-effect"
                                                        id="prev3"> <i class="ti ti-arrow-left me-sm-1 me-0"></i>

                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>

                                                    </button> 
                                                </div>

                                            </div>

                                        </div>



                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-xl-4">

                    <div class="border rounded p-4 mb-3 pb-3" style="background-color:white;min-height: 339px;">
                        <!-- Offer -->
                        <div class="d-flex justify-content-between">
                            <h6>Order Summary</h6>
                            <select id="currency_id" name="currency_id" class="fomr-control select2">
                                @foreach($all_currency as $currency)
                                <option value="{{$currency->id}}">{{$currency->code}} ({{$currency->prefix}})</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Gift wrap -->
                        <hr class="mx-n4">
                        <!-- Price Details -->
                        <h6>Price Details</h6>
                        <dl class="row mb-0">
                            <dt class="col-6 fw-normal text-heading">{{ $products->product_name }}</dt>
                            <dd class="col-6 text-end">
                                <span class="pull-right float-right" id="amtWithoutGst" >{{ $default_currency->prefix }} {{ $products->price }} {{ $default_currency->code }} </span>
                            </dd>
                            <div class="opersys" id="opersys">
                            </div>
                            <div class="clearfix"></div>
                            <div class="HostContPanel" id="HostContPanel"></div>
                            <div class="clearfix addOnProductDetails">
                            </div>
                            <input type="hidden" id="order_Id">
                            <dt class="col-6 fw-normal text-heading">
                                <div class="clearfix">
                                    <span class="pull-left float-left">{{ $products->tax_name }}
                                        ({{ $products->tax_percent }}%) </span>
                                    @php
                                        $totalAmount = $products->price * ($products->tax_percent / 100);
                                        $formattedTotalAmount = number_format($totalAmount, 2);
                                        $formattedTotalAmounts = $totalAmount;
                                    @endphp
                                </div>

                            </dt>

                            <dd class="col-6 text-end">

                                <div class="pull-right float-right">
                                    <span class="gstAmount"
                                        formattedTotalAmount="{{ $formattedTotalAmounts }}">{{ $default_currency->prefix }} {{ $formattedTotalAmount }} {{ $default_currency->code }}
                                    </span>
                                    <input type="hidden" id="amoutGst" @if($client && $client->tax_exampt == 0) value="{{ $formattedTotalAmounts }}" @else value="0" @endif>
                                </div>

                            </dd>

                        </dl>



                        <hr class="mx-n4">

                        <dl class="row mb-0">

                            <dt class="col-6 text-heading">Total</dt>

                            <dd class="col-6 fw-medium text-end text-heading mb-0">

                                <div class="total-due-today">

                                    @php

                                        $totalDueToday = $totalAmount + session('orderDetail')['withoutGst'];

                                        $formattedTotalDueToday = number_format($totalDueToday, 2);

                                        $totalDueToday = $totalDueToday;

                                    @endphp

                                    <span class="pull-right float-right formattedTotalDueToday" attr="{{ $totalDueToday }}">{{ $default_currency->prefix }} {{ $formattedTotalDueToday }} {{ $default_currency->code }}</span>

                                    <input type="hidden" name="price" value="{{ $products->price }}">

                                    <input type="hidden" class="formattedTotalDueTodayAmt" name="total_amt"
                                        value="{{ $formattedTotalDueToday }}">

                                    <input type="hidden" name="tax_id" value="{{ $products->tax_id }}">

                                    <input type="hidden" name="product_id" value="{{ $products->id }}">

                                    <span id="total_amt" style="display: none">{{ $totalDueToday }}</span>
                                </div>

                            </dd>

                        </dl>

                    </div>

                    <div class="d-grid">

                        <!-- <a href="{{ url('user/order/checkOutPage') }}"> -->

                        <button type="submit" class="btn btn-primary btn-next waves-effect waves-light w-100">Add to

                            Cart</button>

                        <!-- </a> -->

                    </div>

                </div>

            </div>

        </form>

    </div>

    @if (Auth::user()->status == 4)
        <div class="modal fade show" id="showedit" data-bs-backdrop="static" tabindex="-1" aria-modal="true"
            role="dialog" style="display: block;">

        </div>
    @endif

    <script type="text/javascript">
        jQuery.noConflict();

        function QuoteStatuts(value, Qid) {

            // Get the CSRF token from the meta tag in your HTML

            var csrfToken = $('meta[name="csrf-token"]').attr('content');



            $.ajax({

                url: "{{ url('user/Quotes/StatuPdate') }}",

                method: 'post',

                data: {

                    value: value,

                    Qid: Qid,

                    _token: csrfToken

                },

                success: function(response) {

                    if (response.success == true) {

                        $('#ResMsg').show().html(response.message);



                        // Hide #ResMsg after 3 seconds

                        setTimeout(function() {

                            $('#ResMsg').hide(500);



                            // Reload the page after 3 seconds

                            setTimeout(function() {

                                location.reload();

                            }, 1000);

                        }, 1000);

                    }

                },

                error: function() {

                    alert("Oops! Some technical error occurred.");

                }

            });

        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.5/sweetalert2.min.js"
        integrity="sha512-WHVh4oxWZQOEVkGECWGFO41WavMMW5vNCi55lyuzDBID+dHg2PIxVufsguM7nfTYN3CEeQ/6NB46FWemzpoI6Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        // Function to validate the form fields

        function validateForm(event) {

            event.preventDefault();

            const form = event.target;

            const hostname = document.getElementById('inputHostname').value.trim();

            const inputBillingcycle = document.getElementById('inputBillingcycle').value;

            const hostingPanelId = document.getElementById('inputConfigOption72').value;



            const errors = [];



            if (hostname === '') {

                errors.push('Please enter a hostname');

            } else {

                // Regular expression to check proper domain name format

                const domainRegex = /^[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;



                if (!domainRegex.test(hostname)) {

                    errors.push('Please enter a valid domain name');

                }

            }



            // Validate operating system

            if (inputBillingcycle === '') {
                errors.push('Please choose billing cycle');
            }



            // Validate hosting panel

            if (hostingPanelId === '') {

                errors.push('Please select a operating system');

            }



            // Display error messages

            const validationMsg = document.getElementById('validation_msg');

            if (errors.length > 0) {

                validationMsg.innerText = errors.join('\n');

                validationMsg.style.display = 'block'; // Show the validation message

                // Hide the first step and show the second step

                document.querySelector('#second-step').click();

            } else {

                validationMsg.innerText = ''; // Clear previous error messages

                validationMsg.style.display = 'none'; // Hide the validation message

                form.submit();

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


        $(window).load(function() {

            swal({

                    title: "Are you sure?",

                    text: "You will not be able to recover this imaginary file!",

                    type: "warning",

                    showCancelButton: true,

                    confirmButtonClass: "btn-danger",

                    confirmButtonText: "Yes, delete it!",

                    cancelButtonText: "No, cancel plx!",

                    closeOnConfirm: false,

                    closeOnCancel: false

                },

                function(isConfirm) {

                    if (isConfirm) {

                        swal("Deleted!", "Your imaginary file has been deleted.", "success");

                    } else {

                        swal("Cancelled", "Your imaginary file is safe :)", "error");

                    }

                });

        });
    </script>



    <script>
        $(document).ready(function() {

            // Hide all content sections except the first one

            $('.content').not(':first').hide();



            // Next button click event

            $('.btn-next').click(function() {

                var current = $(this).closest('.content');

                var next = current.next('.content');



                current.hide();

                next.show();
            });



            // Previous button click event

            $('.btn-prev').click(function() {

                var current = $(this).closest('.content');

                var prev = current.prev('.content');
                current.hide();

                prev.show();

            });

        });
    </script>

    <script>
        $(document).ready(function() {

            // Function to update step buttons based on active section

            function updateStepButtons(activeIndex) {

                $('.step').removeClass('active');

                $('.step').find('.step-trigger').attr('aria-selected', 'false');

                $('.step').eq(activeIndex).addClass('active').find('.step-trigger').attr('aria-selected', 'true');

            }



            // Function to show the corresponding section based on step button clicked

            $('.step').click(function() {

                var target = $($(this).data('target'));



                // Hide all content sections

                $('.content').hide();



                // Show the corresponding section

                target.show();



                // Update step buttons

                updateStepButtons($('.content').index(target));

            });



            // Hide all content sections except the first one

            $('.content').not(':first').hide();



            // Next button click event

            $('.btn-next').click(function() {

                var current = $(this).closest('.content');

                var next = current.next('.content');



                current.hide();

                next.show();



                // Update step buttons

                updateStepButtons($('.content').index(next));

            });



            // Previous button click event

            $('.btn-prev').click(function() {

                var current = $(this).closest('.content');

                var prev = current.prev('.content');



                current.hide();

                prev.show();



                // Update step buttons

                updateStepButtons($('.content').index(prev));

            });

        });





        // var selectedOptionText = $('#inputBillingcycle').find('option:selected').text().trim();

        // var parts = selectedOptionText.split(/\s+/);

        // $('#payment_interval').text(parts[3]);

        // $('#payment_interval_amt').text(parts[1]);



        $(document).ready(function() {

            var timeout = null; // Variable to store timeout reference

            $(window).scroll(function() {

                var scrollPos = $(window).scrollTop();

                var maxHeight = 1500; // Adjust the maximum height where you want to stop the div



                // Clear previous timeout to avoid multiple executions

                clearTimeout(timeout);



                // Use a timeout to delay the adjustment of sidebar position

                timeout = setTimeout(function() {

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




        // function opersys() {
        //     var price = 0;
        //     var addOnProductId = 0;
        //     var tax_percent = "{{ $products->tax_percent }}";
        //     var product_id = null;
        //     var previousPrice = 0;
        //     var previousTax = 0;
        //     var selectedOption = $('#inputConfigOption72').find('option:selected');
        //     var selectedOptionId = selectedOption.val();
        //     var selectedOptionText = selectedOption.text();
        //     var prefix = selectedOption.data('prefix');
        //     var code = selectedOption.data('code');
        //     var product_name = selectedOption.attr('operating-system');
        //     var price = 0;

        //     if (selectedOptionId) {

        //         if (selectedOption.data('price') !== undefined && selectedOption.data('price') !== '') {
        //             price = selectedOption.data('price') ?? 0;
        //         }

        //         $('#opersys').html('<div class="clearfix">' +
        //             '<span class="pull-left float-left" id="productName">' + product_name + '</span>' +
        //             '<span class="pull-right float-right">' + prefix + ' ' + price.toFixed(2) + ' ' + code +'</span>' +
        //             '</div>');

        //         // Subtract the previous price and tax from the formatted total due today
        //         var formattedTotalDueToday = parseFloat($('.formattedTotalDueToday').attr('attr').replace(/,/g,
        //             ''));
        //         var totalAmountMinusPreviousPriceAndTax = formattedTotalDueToday - previousPrice -
        //             previousTax;

        //         var totalAmountWithNewPrice = totalAmountMinusPreviousPriceAndTax + parseFloat(price);
        //         // Update the displayed total
        //         $('.formattedTotalDueToday').html(prefix+' '+totalAmountWithNewPrice.toFixed(2)+ ' ' +code);
        //         $('.formattedTotalDueToday').attr('attr',totalAmountWithNewPrice);
        //         $('.formattedTotalDueTodayAmt').val(totalAmountWithNewPrice.toFixed(2));

        //         previousPrice = parseFloat(price);

        //         var total_tax = parseFloat((price * tax_percent / 100).toFixed(2));
        //         previousTax = total_tax;
        //         // Update GST amount and total GST amount
        //         var gstAmount = parseFloat($('.gstAmount').attr('formattedTotalAmount'));
        //         var totalGstAmount = (gstAmount + total_tax).toFixed(2);
        //         $('.gstAmount').html(prefix+' '+totalGstAmount+' '+code);
        //         $('#amoutGst').val(totalGstAmount);

        //         // Recalculate other totals as needed
        //         var totalTaxAmount = totalAmountWithNewPrice + previousTax + previousPrice;
        //         var totalAmountWithTax = parseFloat(price) + total_tax;
        //         var totalFinalAmount = totalAmountWithNewPrice + total_tax;
        //         $('.formattedTotalDueToday').html(prefix + ' '+totalFinalAmount.toFixed(2)+' '+code);
        //         $('.formattedTotalDueToday').attr('attr',totalFinalAmount.toFixed(2));
        //         $('.formattedTotalDueTodayAmt').val(totalFinalAmount.toFixed(2));
        //     }

        // }
        function opersys() {
            var price = 0;
            var addOnProductId = 0;
            var tax_percent = "{{ $products->tax_percent }}";
            var product_id = null;
            var previousPrice = 0;
            var previousTax = 0;
            var selectedOption = $('#inputConfigOption72').find('option:selected');
            var selectedOptionId = selectedOption.val();
            var selectedOptionText = selectedOption.text();
            var prefix = selectedOption.data('prefix');
            var code = selectedOption.data('code');
            var product_name = selectedOption.attr('operating-system');
            var price = 0;
            var tax_exempt = "{{ $client->tax_exampt }}" == 1;

            if (selectedOptionId) {
                if (selectedOption.data('price') !== undefined && selectedOption.data('price') !== '') {
                    price = selectedOption.data('price') ?? 0;
                }

                $('#opersys').html('<div class="clearfix">' +
                    '<span class="pull-left float-left" id="productName">' + product_name + '</span>' +
                    '<span class="pull-right float-right">' + prefix + ' ' + price.toFixed(2) + ' ' + code + '</span>' +
                    '</div>');

                // Subtract the previous price and tax from the formatted total due today
                var formattedTotalDueToday = parseFloat($('.formattedTotalDueToday').attr('attr').replace(/,/g, ''));
                var totalAmountMinusPreviousPriceAndTax = formattedTotalDueToday - previousPrice - previousTax;

                var totalAmountWithNewPrice = totalAmountMinusPreviousPriceAndTax + parseFloat(price);
                // Update the displayed total
                $('.formattedTotalDueToday').html(prefix + ' ' + totalAmountWithNewPrice.toFixed(2) + ' ' + code);
                $('.formattedTotalDueToday').attr('attr', totalAmountWithNewPrice);
                $('.formattedTotalDueTodayAmt').val(totalAmountWithNewPrice.toFixed(2));

                previousPrice = parseFloat(price);

                if (!tax_exempt) {
                    var total_tax = parseFloat((price * tax_percent / 100).toFixed(2));
                    previousTax = total_tax;
                    // Update GST amount and total GST amount
                    var gstAmount = parseFloat($('.gstAmount').attr('formattedTotalAmount'));
                    var totalGstAmount = (gstAmount + total_tax).toFixed(2);
                    $('.gstAmount').html(prefix + ' ' + totalGstAmount + ' ' + code);
                    $('#amoutGst').val(totalGstAmount);

                    // Recalculate other totals as needed
                    var totalTaxAmount = totalAmountWithNewPrice + previousTax + previousPrice;
                    var totalAmountWithTax = parseFloat(price) + total_tax;
                    var totalFinalAmount = totalAmountWithNewPrice + total_tax;
                    $('.formattedTotalDueToday').html(prefix + ' ' + totalFinalAmount.toFixed(2) + ' ' + code);
                    $('.formattedTotalDueToday').attr('attr', totalFinalAmount.toFixed(2));
                    $('.formattedTotalDueTodayAmt').val(totalFinalAmount.toFixed(2));
                }
            }
        }



        $(document).ready(function() {

            var price = 0;

            var prefix = "{{ $default_currency->prefix }}";

            var addOnProductId = 0;

            var code = "{{ $default_currency->code }}";

            var tax_percent = "{{ $products->tax_percent }}";

            var product_id = null;

            var previousPrice = 0;
            var previousTax = 0;

            billyingCycle();
            opersys();

            $('#inputConfigOption72').change(function() {
                opersys();
            });

            $('#inputBillingcycle').change(function() {
                billyingCycle();

            });

        });

        // function billyingCycle() {
        //     var selectedOptionText = $('#inputBillingcycle').find('option:selected').text().trim();
        //     var parts = selectedOptionText.split(/\s+/);
        //     $('#payment_interval').text(parts[3]);
        //     $('#payment_interval_amt').text(parts[1]);
        //     $('#amtWithoutGst').text(parts[0] +' '+parts[1]+' '+parts[2]);

        //     // Remove any non-numeric characters from the amount
        //     var amountWithoutCommas = parts[1].replace(/[^0-9.]/g, '');

        //     var total_tax = parseFloat((amountWithoutCommas * "{{ $products->tax_percent }}" / 100));

        //     $('.gstAmount').text(parts[0] +' '+ total_tax.toFixed(2)+' '+parts[2]);
        //     $('.gstAmount').attr('formattedTotalAmount', total_tax);

        //     var addonPrice = parseFloat($('#addonPrice').text());
        //     var totalAmount = parseFloat(amountWithoutCommas);
        //     var totalTaxAmount;

        //     if (!isNaN(addonPrice)) {
        //         totalTaxAmount = (parseFloat(totalAmount) + parseFloat(total_tax) + parseFloat(
        //             addonPrice)).toFixed(2);
        //     } else {
        //         totalTaxAmount = (parseFloat(totalAmount) + parseFloat(total_tax)).toFixed(2);
        //     }

        //     // Update the text content of '.formattedTotalDueToday' with the new calculated amount
        //     $('.formattedTotalDueToday').text(parts[0] +' '+ totalTaxAmount+' '+parts[2]);
        //     $('.formattedTotalDueToday').attr('attr',totalTaxAmount);
        //     $('.formattedTotalDueTodayAmt').val(totalTaxAmount);
        // }

        function billyingCycle() {
            var selectedOptionText = $('#inputBillingcycle').find('option:selected').text().trim();
            var parts = selectedOptionText.split(/\s+/);
            $('#payment_interval').text(parts[3]);
            $('#payment_interval_amt').text(parts[1]);
            $('#amtWithoutGst').text(parts[0] + ' ' + parts[1] + ' ' + parts[2]);

            // Remove any non-numeric characters from the amount
            var amountWithoutCommas = parts[1].replace(/[^0-9.]/g, '');

            var tax_percent = "{{ $products->tax_percent }}";
            var tax_exempt = "{{ $client->tax_exampt }}" == 1;
            var total_tax = 0;

            if (!tax_exempt) {
                total_tax = parseFloat((amountWithoutCommas * tax_percent / 100).toFixed(2));
                $('.gstAmount').text(parts[0] + ' ' + total_tax.toFixed(2) + ' ' + parts[2]);
                $('.gstAmount').attr('formattedTotalAmount', total_tax);
            } else {
                $('.gstAmount').text(parts[0] + ' 0.00 ' + parts[2]);
                $('.gstAmount').attr('formattedTotalAmount', 0);
            }

            var addonPrice = parseFloat($('#addonPrice').text());
            var totalAmount = parseFloat(amountWithoutCommas);
            var totalTaxAmount;

            if (!isNaN(addonPrice)) {
                totalTaxAmount = (totalAmount + total_tax + addonPrice).toFixed(2);
            } else {
                totalTaxAmount = (totalAmount + total_tax).toFixed(2);
            }

            // Update the text content of '.formattedTotalDueToday' with the new calculated amount
            $('.formattedTotalDueToday').text(parts[0] + ' ' + totalTaxAmount + ' ' + parts[2]);
            $('.formattedTotalDueToday').attr('attr', totalTaxAmount);
            $('.formattedTotalDueTodayAmt').val(totalTaxAmount);
        }

        ////////Add to cart



        var addedProducts = [];

        var removedProducts = [];

        // function addToCart(price, tax_percent, prefix, code, product_name, addOnProductId, tax, product_id) {

        //     if (addedProducts.includes(addOnProductId)) {

        //         removeAddedProduct(price, tax_percent, addOnProductId); // Remove the addon

        //         removedProducts.push(addOnProductId); // Mark the addon as removed

        //         $('#addon-button' + addOnProductId).text('ADD').parent().css('background-color', '#7367f0a8');

        //     } else {

        //         $('#addon-button' + addOnProductId).text('ADDED').parent().css('background-color', '#49a149');

        //         addedProducts.push(addOnProductId);

        //         var total_tax = parseFloat((price * tax_percent / 100).toFixed(2));

        //         var gstAmount = parseFloat($('.gstAmount').attr('formattedTotalAmount'));

        //         var gstAmounttotal_tax = parseFloat(((gstAmount) + (total_tax)).toFixed(2));

        //         var gstAmount3 = parseFloat($('#amoutGst').val());

        //         var totalGstAmount = (total_tax + gstAmount3).toFixed(2);

        //         var totalGstAmount1 = (total_tax + gstAmount3);

        //         $('.gstAmount').html(prefix+' '+totalGstAmount+' '+code);

        //         $('#amoutGst').val(totalGstAmount1);



        //         var totalTaxAmountprice = parseFloat((price));

        //         var totalTaxAmounttotal_tax = parseFloat((total_tax));

        //         var totalTaxAmount = (totalTaxAmountprice + totalTaxAmounttotal_tax);

        //         var formattedTotalDueToday = parseFloat($('.formattedTotalDueToday').attr('attr').replace(/,/g, ''));

        //          totalTaxAmount = (formattedTotalDueToday + totalTaxAmount).toFixed(2);

        //         var totalAmountWithTax = parseFloat(((price) + (total_tax)));

        //         var totalFinalAmount = parseFloat(formattedTotalDueToday) + parseFloat(totalAmountWithTax)

        //         $('.formattedTotalDueToday').html(prefix + ' '+ totalTaxAmount + ' ' + code);
        //         $('.formattedTotalDueToday').attr('attr',totalTaxAmount);
        //         $('.formattedTotalDueTodayAmt').val(totalTaxAmount);

        //         addOnProductDetails(price, prefix, code, product_name, tax_percent, addOnProductId, tax, product_id);

        //     }

        // }

        function addToCart(price, tax_percent, prefix, code, product_name, addOnProductId, tax, product_id) {
            var tax_exempt = "{{ $client->tax_exampt }}" == 1;

            if (addedProducts.includes(addOnProductId)) {
                removeAddedProduct(price, tax_percent, addOnProductId); // Remove the addon
                removedProducts.push(addOnProductId); // Mark the addon as removed
                $('#addon-button' + addOnProductId).text('ADD').parent().css('background-color', '#7367f0a8');
            } else {
                $('#addon-button' + addOnProductId).text('ADDED').parent().css('background-color', '#49a149');
                addedProducts.push(addOnProductId);

                var total_tax = 0;
                if (!tax_exempt) {
                    total_tax = parseFloat((price * tax_percent / 100).toFixed(2));
                }

                var gstAmount = parseFloat($('.gstAmount').attr('formattedTotalAmount'));
                var gstAmounttotal_tax = parseFloat(((gstAmount) + (total_tax)).toFixed(2));
                var gstAmount3 = parseFloat($('#amoutGst').val());
                var totalGstAmount = (total_tax + gstAmount3).toFixed(2);
                var totalGstAmount1 = (total_tax + gstAmount3);

                $('.gstAmount').html(prefix + ' ' + totalGstAmount + ' ' + code);
                $('#amoutGst').val(totalGstAmount1);

                var totalTaxAmountprice = parseFloat((price));
                var totalTaxAmounttotal_tax = parseFloat((total_tax));
                var totalTaxAmount = (totalTaxAmountprice + totalTaxAmounttotal_tax);

                var formattedTotalDueToday = parseFloat($('.formattedTotalDueToday').attr('attr').replace(/,/g, ''));
                totalTaxAmount = (formattedTotalDueToday + totalTaxAmount).toFixed(2);

                var totalAmountWithTax = parseFloat(((price) + (total_tax)));
                var totalFinalAmount = parseFloat(formattedTotalDueToday) + parseFloat(totalAmountWithTax);

                $('.formattedTotalDueToday').html(prefix + ' ' + totalTaxAmount + ' ' + code);
                $('.formattedTotalDueToday').attr('attr', totalTaxAmount);
                $('.formattedTotalDueTodayAmt').val(totalTaxAmount);

                addOnProductDetails(price, prefix, code, product_name, tax_percent, addOnProductId, tax, product_id);
            }
        }








        //////append product in order summery

        function addOnProductDetails(price, prefix, code, product_name, tax_percent, addOnProductId, tax, product_id) {

            // addOrder(price, addOnProductId, tax, product_id);

            $('.addOnProductDetails').append('<div class="clearfix mb-2">' +

                '<span class="pull-left float-left fw-normal text-heading" style="max-width: 50%;" id="productName">' +
                product_name + '</span>' +

                '<input type="hidden" name="addon_ids[]" value="' + addOnProductId + '" id="addon_ids">' +

                '<span class="pull-right float-right">&nbsp;' + code + '</span>' +

                '<span class="pull-right float-right" id="addonPrice">' + price + '</span>' +

                '<span class="pull-right float-right">' + prefix + '</span>' +

                '</div>'

            );

        }


        /////remove added product
        function removeAddedProduct(price, tax_percent, addOnProductId) {
            var tax_exempt = "{{ $client->tax_exampt }}" == 1;

            deleteOrder();

            // Remove the addon from the addedProducts array
            var index = addedProducts.indexOf(addOnProductId);
            if (index !== -1) {
                addedProducts.splice(index, 1);
            }

            // Remove the addon from the order summary
            $('.addOnProductDetails').find('input[value="' + addOnProductId + '"]').parent().remove();

            // Recalculate totals
            var total_tax = 0;
            if (!tax_exempt) {
                var total_tax_price = parseFloat(price);
                var total_tax_tax_percent = parseFloat(tax_percent);
                total_tax = (total_tax_price * total_tax_tax_percent / 100);
            }

            var totalTaxAmount = $('.formattedTotalDueToday').attr('attr');
            var gstAmount = $('#amoutGst').val();
            var gstVarAmount = (gstAmount - total_tax).toFixed(2);
            var totalAmount = parseFloat(totalTaxAmount) - (total_tax + parseFloat(price));

            totalAmount = totalAmount.toFixed(2);

            $('.gstAmount').html(gstVarAmount);
            $('#amoutGst').val(gstVarAmount);
            $('.formattedTotalDueToday').html(totalAmount);
            $('.formattedTotalDueToday').attr('attr', totalAmount);
            $('.formattedTotalDueTodayAmt').val(totalAmount);
        }




        ////////////////ADD ORDER

        function addOrder(price, addOnProductId, tax, product_id) {



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

                success: function(resp) {

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

                data: {
                    id: id
                },

                success: function(resp) {

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

                    success: function(resp) {

                        window.location.href = url;

                    }

                });

            }
        }
        
        
        $(document).ready(function() {
            // Trigger when currency selection changes
            $('#currency_id').change(function() {
                var currencyId = $(this).val();
               
                updateBillingCycle(currencyId);
            });
        
            // Function to update billing cycle dropdown based on selected currency
            function updateBillingCycle(currencyId) {
                var product_id = {{$products->id}};
                $.ajax({
                    url: "{{url('user/get-billing-cycles')}}/" + currencyId + '/' + product_id,  // Replace with your route to fetch billing cycles based on currency
                    type: 'GET',
                    success: function(data) {
                        // Assuming 'data' is the HTML options for billing cycles returned from the server
                        $('#inputBillingcycle').html(data.billingCycle);
                        $('#addon_products').html(data.addons);
                        $('#inputConfigOption72').html(data.os);
                        // Trigger the billing cycle change event to update calculations
                        $('#inputBillingcycle').change();
                        $('#inputConfigOption72').change();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching billing cycles:', error);
                    }
                });
            }
        
            // Trigger billing cycle change event on page load
            $('#currency_id').change();
        });

    </script>

@endsection
