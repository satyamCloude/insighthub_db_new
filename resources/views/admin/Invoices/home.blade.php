@extends('layouts.admin')

@section('title', 'Invoices')

@section('content')

<!-- Add the Bootstrap JavaScript and jQuery dependencies -->

<style>

    .dropdown-item:not(.disabled).active, .dropdown-item:not(.disabled):active {
        background-color: #fff;
    }

    .show-total-amount {
        border-radius: 2px;
        text-align: center;
    }

    .inner_cont{ 
        background-color:white;
        color:grey;
        border-radius: 6px;
        box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;padding:0px 5px;
    }

</style>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Invoices /</span> Home</h4>

    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif

    <!-- Users List Table -->
    <div class="show-total-amount">
        <div class="card">
        <div class="row" style="margin:0px 2px;">
            <div class="card" style="color: white;text-align:left;background: linear-gradient(72.47deg, #7367f0 22.16%, rgba(115, 103, 240, 0.7) 76.47%);">
                <h5 class="card-header" style="text-align:left;padding-left: 1px;padding-top:5px;font-size: 22px;">Overview</h5>
                <div class="row">
                    @foreach($currencies as $currency)
                    <div class="col-sm-3">
                        <div class="inner_cont">
                            <span style="color: #5d596c;font-weight: 500;font-size: 22px;margin-bottom: 9px;">{{ $currency->name }}</span>
                            <ul style="padding-left: 1px;list-style: none;margin-top:7px;">
                                <li style="margin-right:26px;color:#1cab5b">Paid &nbsp; {{ $currency->prefix }}{{ number_format($result[$currency->code]->total_paid, 2) }} {{ $currency->code }}</li>
                                <li style="margin-right:26px;color:#ea5455;">Unpaid &nbsp; {{ $currency->prefix }}{{ number_format($result[$currency->code]->total_unpaid, 2) }} {{ $currency->code }}</li>
                                <li style="margin-right:26px;color:#dc7a1b;">Overdue &nbsp; {{ $currency->prefix }}{{ number_format($result[$currency->code]->total_due, 2) }} {{ $currency->code }}</li>
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
    <br>
    <div class="card">
        <div class="row">
            <div class="col-md-4 d-flex" style="justify-content: space-between;">
                <h5 class="card-header">Invoices List</h5>
            </div>
            <div class="col-md-8 text-end">
                <form id="downloadPDF" action="{{url('admin/Invoices/downloadPDF')}}">
                    <input type="hidden" name="id" class="pdfValue">
                    <a href="javascript::void(0);" class="btn btn-danger mt-3 m-3"  onclick="submitForm()"><i class="fa-solid fa-file-pdf"></i></a>
                    <a href="{{url('admin/Invoices/EXPORTCSV')}}" class="btn btn-info mt-3 m-3"><i class="fa-solid fa-file-csv"></i></a>
                    <a href="{{url('admin/Invoices/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
                    <a href="{{url('admin/Invoices/gst')}}" class="btn btn-primary mt-3 m-3">GST</a>
                    <a href="{{url('admin/Invoices/tds')}}" class="btn btn-primary mt-3 m-3">TDS</a>
                    <a href="{{url('admin/Invoices/add')}}" class="btn btn-primary mt-3 m-3">Add</a>
                </form>
            </div>
        </div>
    
        <div class="card-datatable table-responsive">
            <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                      <div class="dataTables_length" id="DataTables_Table_3_length"></div>
                    </div>
    
                    <div class="col-sm-12">
                <form>
                    <div class="row mb-4"> 
                        <div class="col-md-3">
                            <label for="client_id" class="form-label">From Date <span class="text-danger">*</span></label>
                            <input type="date" name="fDate" class="form-control" value="{{$fDate}}">
                        </div>
                        <div class="col-md-3">
                            <label for="client_id" class="form-label">To Date<span class="text-danger">*</span></label>
                            <input type="date" name="tDate" class="form-control"  value="{{$tDate}}">
                        </div>
                        <div class="col-md-2">
                            <label for="warranty_expiry" class="form-label">Client Name<span class="text-danger">*</span></label>
                            <input type="text" name="cName" class="form-control" value="{{$cName}}">
                        </div>
                        <div class="col-md-2">
                            <label for="warranty_expiry" class="form-label">Invoice Id<span class="text-danger">*</span></label>
                            <input type="text" name="invoiceId" class="form-control" value="{{$invoiceId}}">
                        </div>
                        <div class="col-md-2">
                            <label for="warranty_expiry" class="form-label">Status<span class="text-danger">*</span></label>
                            <select name="status" class="form-control select2">
                                <option value="">Select Status</option>
                                <option value="1" {{$status == 1 ? 'selected':''}}>Paid</option>
                                <option value="2" {{$status == 0 ? 'selected':''}}>UnPaid</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <button type="submit" class="btn btn-success btn-sm" style="margin-top: 8px;">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
                </div>
                <table id="invoiceListTable" class="invoice-list-table table border-top">
                    <thead>
                        <tr>
                            <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 30.6562px; display: none;" aria-label=""></th>
                            <th style="width: 42.6562px;padding-left:11px;padding-right:1px;"><input type="checkbox" id="selectAll">#ID</th>
                            <th>Customer Name</th>
                            <th>Invoice ID</th>
                            <th class="text-truncate">Invoice Date</th>
                            <th>Due Date</th>
                            <th>Paid Amount</th>
                            <th>Due Amount</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th class="cell-fit">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($Invoice) > 0)
                            @foreach($Invoice as $key => $Inventor)
                                <tr class="odd">
                                    <td style="padding-left:6px;padding-right:0px;">
                                        <input type="checkbox" name="ids[]" class="selectId" value="{{$Inventor->id}}">&nbsp;&nbsp;{{ $key + 1 }}
                                    </td>
                                    <td>
                                        <div class="parent d-flex">
                                            <div class="child1">
                                                 @if($Inventor->profile_img)
                                                        <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{$Inventor->profile_img}}" height="30" width="30" alt="User avatar" />
                                                    @else
                                                        <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{url('public/images/21104.png')}}" height="30" width="30" alt="User avatar" />
                                                    @endif
                                            </div>
                                            <div class="child2">
                                                  {{$Inventor->first_name }} {{$Inventor->last_name }} | (#{{$Inventor->users_id }}) <br> <span style="color:#6e6c76;font-size:85%">{{$Inventor->comp_name }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/Invoices/view/'.$Inventor->id) }}">
                                            @if($Inventor && $Inventor->invoice_number2) 
                                                {{ $Inventor->invoice_number2 }} 
                                            @endif
                                        </a>
                                    </td>
                                    <td>@if($Inventor && $Inventor->issue_date) {{ $Inventor->issue_date }} @endif</td>
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
                                            if(floatVal($Inventor->final_total_amt) != $Inventor->paid_amount){
                                                $final_amt1 = floatVal($Inventor->final_total_amt) - $Inventor->paid_amount;
                                            }else{
                                                $final_amt1 = isset($Inventor) ? floatVal($Inventor->final_total_amt) : 0.00;
                                            }

                                             $tds_percent = floatval($Inventor->tds_percent);
                                             
                                            $final_amt1 = $final_amt1 - ($final_amt1 * ($tds_percent / 100));
                                            
                                        @endphp
                                        {{ isset($Inventor) ? $Inventor->prefix . number_format($final_amt1, 2) : '' }}
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
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" style="">
                                                  @php
                                            if(floatVal($Inventor->final_total_amt) != $Inventor->paid_amount){
                                                $final_amt1 = floatVal($Inventor->final_total_amt) - $Inventor->paid_amount;
                                            }else{
                                                $final_amt1 = isset($Inventor) ? floatVal($Inventor->final_total_amt) - $Inventor->paid_amount : 0.00;
                                            }
                                        @endphp
                                             @if($Inventor && floatval($Inventor->final_total_amt) == floatval($Inventor->paid_amount))
                                                    <button class="dropdown-item btn-next auto_pay" data-id="{{ $Inventor->id }}"  data-clientid="{{ $Inventor->client_id }}" data-amount="{{ $final_amt1 }}">Pay</button>
                                            @elseif($Inventor && $Inventor->paid_amount > 0 && floatval($Inventor->final_total_amt) != floatval($Inventor->paid_amount))
                                                     <button class="dropdown-item btn-next auto_pay" data-id="{{ $Inventor->id }}"  data-clientid="{{ $Inventor->client_id }}" data-amount="{{ $final_amt1 }}">Pay</button>
                                                @endif
                                                    <li><a class="dropdown-item" href="{{ url('admin/Invoices/edit/'.$Inventor->id) }}">Edit</a></li>
                                                <li><button class="dropdown-item delete_debtcase" url="{{ url('admin/Invoices/delete/'.$Inventor->id) }}">Delete</button></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
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
                        <option value="3">NEFT/IMPS/RTGS</option>
                    </select>
                </div>

                

                <div class="mb-3">

                    <label for="paymentDate" class="form-label">Transaction Date</label>

                    <input type="date" class="form-control" id="transaction_date" required>

                </div>

                <div class="mb-3">

                    <label for="paymentDate" class="form-label">Transaction ID</label>

                    <input type="text" class="form-control" id="transaction_id" required>

                    <input type="hidden" class="form-control" id="invoiceIds">

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
                
                <div class="mb-3 form-check">
                    
                    <input type="checkbox" class="form-check-input" id="creditAmount" required>
                    {{ $default_currency->prefix }} <span id="creditBalance" >0.00</span>
                    <label class="form-check-label" for="creditAmount"> : Credit Balance </label>
                </div>
                
                

                <div class="mb-3" id="paymentAmountContainer" >

                    <label for="paymentAmount" class="form-label">Payment Amount : {{$default_currency->prefix}} <span id="totalAmount">0.00</span></label>

                    <input type="number" class="form-control" id="paymentAmount" required>

                    <input type="hidden" class="form-control" id="paymentAmounthidden">

                </div>



                <div class="mb-3" id="paymentAmountContainer" >

                    <input type="checkbox" class="form-check-input" id="confrm_mail">

                    <label class="form-check-label" for="confrm_mail">Send Confirmation Mail</label>

                </div>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                <button type="button"  id="paymentFormSubmit" class="btn btn-primary">Save changes</button>

            </div>

        </div>

    </div>

</div>

<script>

    $(document).ready(function () {

        $('#invoiceListTable').DataTable();

    });

</script>



<script>

    $('.auto_pay').click(function() {
        
        var invoiceId = this.getAttribute('data-id');
        var clientid = this.getAttribute('data-clientid');
        var paymentAmount = parseFloat(this.getAttribute('data-amount'));

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ url('admin/Client/getCredit') }}/"+clientid, // Controller route
            type: 'GET',
            success: function(response) {
               
                $('#invoiceId').val(invoiceId);
                if(response > 0){
                    $('#creditBalance').text(response);
                }
                
                $('#totalAmount').text(paymentAmount.toFixed(2));
                $('#paymentAmounthidden').val(paymentAmount.toFixed(2)); // Format to 2 decimal places
                $('#paymentAmount').val(''); // Clear the payment amount input initially
                $('#paymentModal').modal('show');
            },
            error: function(xhr, status, error) {
               
            }

        });

       
    });
    
    $('#creditAmount').change(function(){
        var totalAmount = parseFloat($('#totalAmount').text()); // Parse as float to handle decimal values
        var creditBalance = parseFloat($('#creditBalance').text()); // Parse as float to handle decimal values
        var paymentAmount = Math.min(totalAmount, creditBalance).toFixed(2); // Correct method name
        if($(this).is(':checked')){
            $('#paymentAmount').val(paymentAmount);
        } else {
            $('#paymentAmount').val('');
        }
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



$('#paymentFormSubmit').click(function() {
    // Retrieve form data
    var invoiceId = $('#invoiceId').val();
    var paymentMethod = $('#selectBox').val();
    var transactionDate = $('#transaction_date').val();
    var transactionId = $('#transaction_id').val();
    var tdsPercent = $('#tdsPercent').val();
    var showPaymentAmount = $('#showPaymentAmount').prop('checked');
    var confrm_mail = $('#confrm_mail').prop('checked');
    var paymentAmount = $('#paymentAmount').val();
    var creditAmount = $('#creditAmount').prop('checked');
    var creditBalance = parseFloat($('#creditBalance').text());

    // Basic validation
    if (!invoiceId || invoiceId.trim() === '') {
        $('#errorMsg').text("Please provide Invoice ID.");
        return; // Prevent form submission
    }
    if (paymentMethod === '0') {
        $('#errorMsg').text("Please select Payment Method.");
        return; // Prevent form submission
    }
    if (!transactionDate || transactionDate.trim() === '') {
        $('#errorMsg').text("Please select Transaction Date.");
        return; // Prevent form submission
    }
    if (!transactionId || transactionId.trim() === '') {
        $('#errorMsg').text("Please provide Transaction ID.");
        return; // Prevent form submission
    }
  
    if (!paymentAmount || isNaN(paymentAmount) || parseFloat(paymentAmount) <= 0) {
        $('#errorMsg').text("Please provide valid Payment Amount.");
        return; // Prevent form submission
    }

    // Additional validation for credit amount checkbox
    if (creditAmount && creditBalance <= 0) {
        $('#errorMsg').text("Cannot use credit balance without sufficient balance.");
        return; // Prevent form submission
    }

    // Perform AJAX request
    $.ajax({
        url: "{{ url('admin/Invoices/autopayinvoice') }}", // Controller route
        type: 'POST',
        data: {
            invoiceId: invoiceId,
            paymentMethod: paymentMethod,
            transactionDate: transactionDate,
            transactionId: transactionId,
            tdsPercent: tdsPercent,
            paymentAmount: paymentAmount,
            confrm_mail: confrm_mail,
            fullPaymentStatus: showPaymentAmount,
            creditAmount: creditAmount,
            creditBalance: creditBalance
        },
        success: function(response) {
            console.log(response);
            $('#paymentModal').modal('hide'); // Hide the modal on success
            // Optionally reload the page after successful submission
            setTimeout(function() {
                location.reload();
            }, 2000);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            $('#errorMsg').text("An error occurred. Please try again."); // Show error message
        }
    });
});

</script>



<script>

    function downloadPDF(invoiceId) {

        window.location.href = "{{ url('admin/Invoices/downloadPDF') }}/" + invoiceId;

    }

</script>

<script>

    $(document).ready(function () {

        $(".delete_debtcase").click(function (e) {

            var url = $(this).attr('url');

            e.preventDefault();

            bootbox.confirm({

                message: "Are you sure?",

                buttons: {

                    cancel: {

                        label: '<i class="fa fa-times"></i> Cancel'

                    },

                    confirm: {

                        label: '<i class="fa fa-check"></i> Delete'

                    },

                },

                callback: function (result) {

                    if (result) {

                        window.location.href = url;

                    }

                }

            });

        });

    });



    $(document).ready(function () {

        $("#selectAll").click(function () {

            $(".selectId").prop("checked", $(this).prop("checked"));

            var id = [];



            $('.selectId:checked').each(function(i) {

                id.push($(this).val()); 

            });

            $('.pdfValue').val(id);

        });

        $(".selectId").click(function () {

         var id = [];



         $('.selectId:checked').each(function(i) {

            id.push($(this).val()); 

        });

         $('.pdfValue').val(id);

         if (!$(this).prop("checked")) {

            $("#selectAll").prop("checked", false);

        }

    });

    });



    $('.pdfDownload').click(function() {

        var id = [];

        $('.selectId:checked').each(function(i) {

            id.push($(this).val()); 

        });



        if (id.length > 0) {



        } else {

            alert('Please select at least one checkbox to download the PDF.');

        }

    });







   



    function submitForm() {

     var id = [];



     $('.selectId:checked').each(function(i) {

        id.push($(this).val()); 

    });

     if (id.length > 0) {

        var form = document.getElementById('downloadPDF');

        form.submit();

    }else {

        alert('Please select at least one checkbox to download the PDF.');

    }

}



</script><script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>

    document.querySelectorAll('.rzp-payment-btn').forEach(button => {

        button.addEventListener('click', function() {

            var invoiceId = this.getAttribute('data-id');

            var paymentAmount = parseFloat(this.getAttribute('data-amount'))*100; // Convert amount to paise

            

            var finalAmount = paymentAmount.toFixed(2);

            var options = {

                "key": "rzp_test_905d9rOq4TKriv",

                "amount": finalAmount,

                "currency": "{{ $default_currency->code }}",

                "name": "Tech CRM",

                "image": "{{url('/')}}/public/logo/company.png",

                "handler": function(response) {

                    window.location.href = "{{ url('admin/Invoices/paymentStatusUpdate') }}?orderId=" + invoiceId + "&payment_id=" + response.razorpay_payment_id;

                },

                "theme": {

                    "color": "#3399cc"

                }

            };



            var rzp1 = new Razorpay(options);

            rzp1.open();

        });

    });

</script>



@endsection