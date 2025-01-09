@extends('layouts.admin')
@section('title', 'My Profile')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

  <div class="Invoicescreen">
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">
        <div class="card mb-4">
          <h5 class="card-header">Recent Invoices</h5>
          @if(Auth::user()->status == 4)
          <script>
            $(document).ready(function(){
                // alert('Your are not allowed to perform this action. first complete your profile');
              var id = {{Auth::user()->id}};
              $.ajax({
                url: "{{url('user/MyProfile/edit')}}",
                method: 'GET',
                data: { id: id },
                success: function (data) {
                  if (data && typeof data == 'string') {
                    $('#showedit').html(data);
                    $('#showedit').modal('show');
                  } else {
                    $('#showedit').html('<div>No Data Found</div>');
                    $('#showedit').modal('show');
                  }
                },
                error: function () {
                  $('#showedit .modal-content').html('<div>Error fetching data.</div>');
                  $('#showedit').modal('show');
                }
              });
            });
          </script>
          @endif
          <div class="card-body">
            @if(Session::has('error'))
            <div class="alert alert-danger">{{Session::get('error')}}</div>
            @endif
            <div class="table-responsive">
              <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
               <thead>
                <tr>
                  <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>

                  <th>Invoice ID</th>
                  <th class="text-truncate">Invoice Date</th>
                            <th>Due Date</th>
                            <th>Paid Amount</th>
                            <th>Due Amount</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
             <tbody>
    @if(count($Invoice) > 0)
        @foreach($Invoice as $key => $Inventor)
            <tr class="odd">
                <td>
                    <a href="{{ url('user/userInvoiceView/'.$Inventor->id) }}">
                        @if($Inventor && $Inventor->invoice_number2)
                            {{ $Inventor->invoice_number2 }}
                        @endif
                    </a>
                </td>
                  <td>@if($Inventor && $Inventor->issue_date) {{ $Inventor->issue_date }} @else -- @endif</td>
                                    <td>@if($Inventor && $Inventor->due_date) {{ $Inventor->due_date }} @endif</td>
                                        <td>
                                        @php
                                            if(floatVal($Inventor->final_total_amt) != $Inventor->paid_amount){
                                                $final_amt = $Inventor->paid_amount;
                                            }else{
                                                $final_amt = floatVal($Inventor->final_total_amt) - 0;
                                            }
                                        @endphp
                                      {{ isset($Inventor) ? $Inventor->prefix . number_format($final_amt, 2) : '' }}

                                    </td>
                                   <td>
    @php
        // Calculate the amount due after subtracting the paid amount from the final total amount
        $final_total_amt = floatval($Inventor->final_total_amt);
        $paid_amount = floatval($Inventor->paid_amount);

        // Initial due amount calculation
        $due_amount = $final_total_amt - $paid_amount;

        // Apply TDS if due amount is greater than zero
        if ($due_amount > 0) {
            $tds_percent = floatval($Inventor->tds_percent);
            $due_amount -= $due_amount * ($tds_percent / 100);
        }
    @endphp
    {{ isset($Inventor) ? $Inventor->prefix . number_format($due_amount, 2) : '' }}
</td>

                                      <td>
                                        @php
                                            if (isset($Inventor)) {
                                                $final_total_amt = floatval($Inventor->final_total_amt);
                                                $paid_amount = floatval($Inventor->paid_amount);
                                                $tds_percent = floatval($Inventor->tds_percent);
                                                if ($final_total_amt == $paid_amount) {
                                                    $final_amt = $final_total_amt - (($final_total_amt * $tds_percent / 100));
                                                }else {
                                                    $final_amt = $final_total_amt - ($final_total_amt * ($tds_percent / 100));
                                                 }
                                            }else{
                                                $final_amt =  0.00;
                                            }
                                        @endphp
                                        {{ isset($Inventor) ? $Inventor->prefix . number_format($final_amt, 2) : '' }}
                                    </td>
                <td>
                    @if($Inventor && floatval($Inventor->final_total_amt) == floatval($Inventor->paid_amount))
                        <span class="btn btn-success btn-sm">Paid</span>
                    @elseif($Inventor && $Inventor->paid_amount > 0 && floatval($Inventor->final_total_amt) != floatval($Inventor->paid_amount))
                        <span class="btn btn-warning btn-sm">Partially Paid</span>
                    @else
                        <span class="btn btn-danger btn-sm">Unpaid</span>
                    @endif
                </td>
               
                <td>
                   @php
                   $finalAmount = 0.00;
                                            if(floatVal($Inventor->final_total_amt) != $Inventor->paid_amount){
                                                $final_amt1 = floatVal($Inventor->final_total_amt) - $Inventor->paid_amount;
                                            }else{
                                                $final_amt1 = isset($Inventor) ? floatVal($Inventor->final_total_amt) - $Inventor->paid_amount : 0.00;
                                            }
                                           $final_amts = $final_amt1 - (($final_amt1 * $tds_percent / 100));
                                           $finalAmount  = $final_amts;
                                        @endphp
                    @if($Inventor && floatval($Inventor->final_total_amt) == floatval($Inventor->paid_amount))
                        <span class="btn btn-success btn-sm">Paid</span>
                    @else
                      <button class="btn btn-primary btn-next add-tds" data-id="{{ $Inventor->id }}"  data-clientid="{{ $Inventor->client_id }}" data-amount="{{ $finalAmount }}">Pay</button>
                        <!-- <button class="btn btn-primary btn-next rzp-payment-btn" data-id="{{ $Inventor->id }}" data-amount="{{ $Inventor->final_total_amt }}">Pay</button> -->
                    @endif
                </td>
            </tr>
        @endforeach
    @else
     @php
                   $finalAmount = 0.00;
                                            
                                        @endphp
        <tr>
            <td class="text-center" colspan="8">No Data Found</td>
        </tr>
    @endif
</tbody>

            </table>

            <div class="p-1" style="float: right;">
              {{ $Invoice->links() }}
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

</div>

@if(Auth::user()->status == 4)
<div class="modal fade show" id="showedit" data-bs-backdrop="static" tabindex="-1" aria-modal="true" role="dialog" style="display: block;">
</div>
@endif

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
                <a href="#" id="paypalButton">
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
                <input type="hidden" id="amtWithoutGSTHidden">
                <input type="hidden" id="currencyhidden">
                <input type="hidden" id="finalamtHidden">
                <input type="hidden" id="tdsPercentHidden">
                <input type="hidden" id="OrderIdHidden">

                <div class="mb-3">
                    <label for="selectBox" class="form-label">Payment Method</label>
                    <select class="form-control" id="selectBox">
                        <option value="0">Select</option>
                        <option value="1">Credit/Debit</option>
                        <option value="2">PayPal</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tdsPercent" >TDS <span id="tdsperc"></span></label>
                    <select class="form-control"  id="tdsPercent" required >
                                <option value="">Select</option>
                                <option value="2" >2%</option>
                                <option value="4" >4%</option>
                                <option value="10" >10%</option>
                                <option value="12">12%</option>
                                <option value="15" >15%</option>
                                <option value="18" >18%</option>
                                <option value="20">20%</option>
                                </select>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="showPaymentAmount">
                    <label class="form-check-label" for="showPaymentAmount">Full Payment</label>
                </div>
                
                <div class="mb-3" id="paymentAmountContainer" >
                    <label for="paymentAmount" class="form-label">Payment Amount :  @if($default_currency && $default_currency->default_currency){{$default_currency->default_currency}}@endif <span id="totalAmount">0.00</span></label>
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

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>



<script>





    $('.add-tds').click(function() {
        var invoiceId = this.getAttribute('data-id');
        var tdsPercent = 0;
        var clientid = this.getAttribute('data-clientid');
        var paymentAmount = parseFloat(this.getAttribute('data-amount'));
        $('#invoiceId').val(invoiceId);
        $('#paymentAmounthidden').val(paymentAmount.toFixed(2)); // Format to 2 decimal places
        $('#paymentAmount').val(''); // Clear the payment amount input initially
        $('#totalAmount').text(paymentAmount.toFixed(2)); // Clear the payment amount input initially
       

      
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // AJAX request
            $.ajax({
                url: "{{ url('user/order/getInvoiceData') }}",
                type: 'POST',
                data: {
                    invoiceId:invoiceId,
                },
                success: function(response) {
                    if (response.success == true) {

                       tdsPercent = response.data.tds_percent;
                       order_id = response.data.order_id;
                       amtWithoutGST = response.data.amtWithoutGST;
                       final_total_amt = response.data.final_total_amt;
                       currencyhidden = response.data.currency;
                       $('#amtWithoutGSTHidden').val(amtWithoutGST);
                       $('#OrderIdHidden').val(order_id);
                       $('#currencyhidden').val(currencyhidden);
                       $('#finalamtHidden').val(final_total_amt);
                       $('#tdsPercentHidden').val(tdsPercent);

                            var paypalUrl = "{{ url('paypal/handle-payment?type=checkout&amount=') }}" + encodeURIComponent(paymentAmount) + "&order_id=" + encodeURIComponent(order_id) + "&currency_code=" + encodeURIComponent("INR");
                            $('#paypalButton').attr('href', paypalUrl);
                               var selectedOption = $('#tdsPercent').find('option[value="' + tdsPercent + '"]');
                            selectedOption.prop('selected', true);
                            $('#tdsperc').text(tdsPercent);
                            if (parseFloat(tdsPercent) > 0) {
                                $('#tdsPercent').prop('disabled', true);
                            } else {
                                $('#tdsPercent').prop('disabled', false);
                            }

                    } else {
                        console.log('invoice not found') // Hide the modal on success
                    }
                     $('#paymentModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    $('#errorMsg').text("An error occurred. Please try again.");
                }
            });


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

       

         var orderId = $('#OrderIdHidden').val();
        var finalamtHidden = $('#finalamtHidden').val();
        var amtWithoutGSTHidden = $('#amtWithoutGSTHidden').val();
        var paymentAmount = $('#paymentAmount').val();
        var payment = finalamtHidden;
        var amount = finalamtHidden;
        var amtWithoutGst = amtWithoutGSTHidden;

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
        
     
            var options = {
                "key": "{{ $PaymentDetail->key_id ?? 'rzp_test_905d9rOq4TKriv' }}",
                "amount": payment,
                "currency":"INR",
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

$('#paymentFormSubmit').click(function() {
    var orderId = "0";
    var amount = "0";
    var amtWithoutGst = "0";
    var OrderIdHidden = $('#OrderIdHidden').val();
    var finalamtHidden = $('#finalamtHidden').val();

    orderId = OrderIdHidden;
    var invoiceId = $('#invoiceId').val();
    var paymentMethod = $('#selectBox').val();
    var tdsPercent = $('#tdsPercent').val();
    var paymentAmount = $('#paymentAmount').val();

    

    // Validate form fields
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

    // AJAX setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // AJAX request
    $.ajax({
        url: "{{ url('user/order/addTdsRemarkBeforePay') }}",
        type: 'POST',
        data: {
            tdsPercent: tdsPercent,
            remarks: $('#remarks').val(), // Assuming you have an input field with id 'remarks'
            orderId: orderId,
            paymentMethod: paymentMethod,
            paymentAmount: paymentAmount,
            fullPaymentStatus: $('#showPaymentAmount').prop('checked')
        },
        success: function(response) {
            if (response.success == true) {
                $('#paymentModal').modal('hide'); // Hide the modal on success
                if ($('#wallet_amt').is(':checked') && amount <= $('#wallet_amt').val()) {
                    window.location.href = "{{ url('user/order/update') }}?orderId=" + orderId + "&payment_id=" + 'wallet_id' + "&paymentAmount=" + paymentAmount + "&amount=" + amount + "&amtWithoutGst=" + amtWithoutGst + "&walletBalance=" + $('#wallet_amt').val();
                } else {
                    $('#paymentMethods').modal('show');
                }
            } else {
                $('#paymentModal').modal('hide'); // Hide the modal on success
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            $('#errorMsg').text("An error occurred. Please try again.");
        }
    });

});
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

