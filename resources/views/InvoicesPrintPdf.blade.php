@extends('layouts.admin')
@section('title', 'Invoices')
@section('content')
    <style>


.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1.25rem;
}

#logo {
    height: 20px;
}

.f-21 {
    font-size: 21px;
}

.text-dark {
    color: #28313c!important;
}


.font-weight-bold {
    font-weight: 700!important;
}

.text-uppercase {
    text-transform: uppercase!important;
}

.f-14 {
    font-size: 14px!important;
}

.mt-3, .my-3 {
    margin-top: 1rem!important;
}

.mb-0, .my-0 {
    margin-bottom: 0!important;
}

.f-13 {
    font-size: 13px;
}


.text-dark-grey {
    color: #616e80;
}

.text-capitalize {
    text-transform: capitalize!important;
}

.inv-unpaid td:nth-child(2) {
    text-align: right;
}


.unpaid {
    background-color: #fff;
    border: 1px solid #d30000;
    color: #d30000;
    padding: 11px 22px;
    position: relative;
    text-transform: uppercase;
}

.f-15 {
    font-size: 15px!important;
}

.rounded {
    border-radius: 0.25rem!important;
}

.invoice .inv-desc-mob .i-d-heading, .invoice .inv-desc-mob .i-d-heading td, .invoice .inv-detail .i-d-heading, .invoice .inv-detail .i-d-heading td {
    border: 1px solid #dbdbdb;
}

.i-d-heading td {
    border: 1px solid #dbdbdb;
}

.inv-detail td {
    border: 1px solid #e7e9eb;
    padding: 11px 10px;
    word-break: break-word;
}


.text-dark {
    color: #28313c!important;
}

.f-w-500 {
    font-weight: 500!important;
}


.inv-note td {
    width: 50%;
}

.inv-note td {
    width: 50%;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1.25rem;
}


.inv-detail, .inv-desc-mob td, th{
            padding: 11px 10px;
            border: 1px solid #e7e9eb;
            word-break: break-word;
        }

@media (max-width: 767.98px){


    .inv-logo-heading img{
        width: auto;
    }                       
    .inv-logo-heading td{
        width: 100%;
        display: block;
        margin: 0 auto;
        text-align: center;
    }
    .inv-num-date{
        width: 100%;

        td{
            display: table-cell !important;
            text-align: left !important;
        }
    }
    .inv-num td{
        display: block;
        margin: 0 auto;
        text-align: center;
    }
    .blank-td{
        display: none;
    }
    .inv-note td, .inv-unpaid td{
        width: 100%;
        display: block;
    }
    .inv-detail {
        margin-bottom: 5px;
    }
    .inv-desc::-webkit-scrollbar {
        width: 5px;
        background: white ;
        height: 10px;
    }
    .inv-desc::-webkit-scrollbar-thumb {
        border-radius: 7px;
        background-color: grey ;
    }

    .inv-note td {
    display: block;
    width: 100%;
}
}

.invoice .card-footer{
    display: flex;
    flex-flow: row;
    justify-content: flex-end;

}

.inv-num-date td {
    border: 1px solid #dbdbdb;
    padding: 6px;
}

.f-w-500 {
    font-weight: 500!important;
}

.bg-light-grey {
    background-color: #f1f1f3;
}

.border-right-0 {
    border-right: 0!important;
}

.border-left-0 {
    border-left: 0!important;
}

.w-30{
    width: 30%;
}
.w-70{
    width: 70%;
}
.height-35{
    height: 39px !important;
}
.height-40{
    height: 40px !important;
}
.height-44{
    height: 44px !important;
}
.height-50{
    height: 50px !important;
}
.px-6{
    padding-left: 6px !important;
    padding-right: 6px !important;
}
.p-20{
    padding: 20px !important;
}
.pl-20{
    padding-left: 20px !important;
}
.py-20{
    padding-left: 20px !important;
    padding-right: 20px !important;
}
.mt-94{
    margin-top: 94px;
}
.mt-105{
    margin-top: 105px;

}
.mb-12{
    margin-bottom: 12px;
}
.mb-20{
    margin-bottom: 20px;
}
.mr-30{
    margin-right: 30px;
}
.b-shadow-4{
    box-shadow: 0 0 4px 0 #e8eef3;
}
.b-r-8{
    border-radius: 8px !important;
}
.d-grid{
    display: grid;
}


    </style>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card-body">

        
        
                    <div class="invoice-table-wrapper">
                        <table width="100%">
                            <tbody><tr class="inv-logo-heading">
                                <td class="tthead"><img src="{{url('/')}}/public/logo/company.png" alt="Worksuite" id="logo"></td>
                                <td align="right" class="font-weight-bold f-21 text-dark text-uppercase mt-4 mt-lg-0 mt-md-0 tthead">
                                    Invoice</td>
                            </tr>
                            <tr class="inv-num">
                                <td class="f-14 text-dark">
                                    <p class="mt-3 mb-0">{{$InvoiceDetails->company_name}}<br>{{$Company->company_name}}<br>{{$Company->contact_no}}<br></p><br>
                                </td>
                                <td align="right">
                                    <table class="inv-num-date text-dark f-13 mt-3">
                                        <tbody><tr>
                                            <td class="bg-light-grey border-right-0 f-w-500">
                                                Invoice Number</td>
                                            <td class="border-left-0">{{$Invoice->invoice_number1.$Invoice->invoice_number2}}</td>
                                        </tr>
                                           <tr>
                                            <td class="bg-light-grey border-right-0 f-w-500">Invoice Date</td>
                                            <td class="border-left-0">{{$Invoice->issue_date}}</td>
                                        </tr>
                                        <tr>
                                                <td class="bg-light-grey border-right-0 f-w-500">Due Date</td>
                                                <td class="border-left-0">{{$Invoice->due_date}}</td>
                                            </tr>
                                       </tbody>
                                   </table>
                                </td>
                            </tr>
                            <tr>
                                <td height="20"></td>
                            </tr>
                        </tbody></table>
                        <table width="100%">
                            <tbody><tr class="inv-unpaid">
                                <td class="f-14 text-dark">
                                    <p class="mb-0 text-left">

                                                                        <span class="text-dark-grey text-capitalize">Billed To</span>
                                                                        <br>{{$InvoiceDetails->first_name}} {{ $InvoiceDetails->last_name }}<br>
                                                                              {{ $InvoiceDetails->email}}<br>
                                                                              {{ $InvoiceDetails->address_1}}<br>
                                                                              {{ $InvoiceDetails->address_2}}<br>
                                                                              {{ $InvoiceDetails->pincode}}<br></p>
                                </td>
                                      <td align="right" class="mt-2 mt-lg-0 mt-md-0">
                                                    @if ($InvoiceDetails->is_payment_received == 0)
                                                        <span class="unpaid rounded f-15">Unpaid</span>
                                                    @elseif ($InvoiceDetails->is_payment_received == 1)
                                                        <span class="paid rounded f-15">Paid</span>
                                                    @endif

                                                        </td>
                            </tr>
                            <tr>
                                <td height="30" colspan="2"></td>
                            </tr>
                        </tbody></table>
                        <table width="100%" class="inv-desc d-none d-lg-table d-md-table">
                            <tbody><tr>
                                <td colspan="2">
                                    <table class="inv-detail f-14 table-responsive-sm" width="100%">
                                        <tbody>
                                            <tr class="i-d-heading bg-light-grey text-dark-grey font-weight-bold">
                                            <td class="border-right-0" width="35%">Description</td>
                                                                            <td class="border-right-0 border-left-0" align="right">
                                                Quantity                                </td>
                                            <td class="border-right-0 border-left-0" align="right">
                                                Unit Price (USD)
                                            </td>
                                            <td class="border-right-0 border-left-0" align="right">Tax</td>
                                            <td class="border-left-0" align="right" width="20%">
                                                Amount                                    (USD)</td>
                                        </tr>
                                       @foreach($InvoiceDetailsAll as $order)
                                                    <tr class="text-dark font-weight-semibold f-13">
                                                        <td>{{ $order->item_name }}</td>
                                                        <td align="right">{{ $order->quantity }} <br><span class="f-11 text-dark-grey">Pcs</span></td>
                                                        <td align="right">{{ number_format($order->cost_per_item, 2) }}</td>
                                                        <td align="right">{{ $order->taxes }}</td>
                                                        <td align="right" class="total_amt">{{ number_format($order->amount, 2) }}</td>
                                                    </tr>
                                                @endforeach
                                                                                     <!--    <tr class="text-dark f-12">
                                                        <td colspan="5" class="border-bottom-0">
                                                            rty
                                                                                                        </td>
                                                    </tr> -->
                                                                                                            
                                        <tr>
                                            <td colspan="3" class="blank-td border-bottom-0 border-left-0 border-right-0"></td>
                                            <td class="p-0 border-right-0" align="right">
                                                <table width="100%">
                                                    <tbody><tr class="text-dark-grey" align="right">
                                                        <td class="w-50 border-top-0 border-left-0">
                                                            Sub Total</td>
                                                    </tr>
                                                    <tr class=" text-dark-grey font-weight-bold" align="right">
                                                        <td class="w-50 border-bottom-0 border-left-0">
                                                            Total</td>
                                                    </tr>
                                                    <tr class="bg-light-grey text-dark f-w-500 f-16" align="right">
                                                        <td class="w-50 border-bottom-0 border-left-0">
                                                            Total                                                Due</td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                            <td class="p-0 border-left-0" align="right">
                                                <table width="100%">
                                                    <tbody><tr class="text-dark-grey" align="right">
                                                        <td align="right" class="border-top-0 border-right-0 sub_total"></td>
                                                          
                                                    </tr>
                                                                                                                                    <tr class=" text-dark-grey font-weight-bold" align="right">
                                                        <td class="border-bottom-0 border-right-0 total2">
                                                            
                                                        </td>
                                                    </tr>
                                                    <tr class="bg-light-grey text-dark f-w-500 f-16" align="right">

                                                        
                                                            @if ($InvoiceDetails->is_payment_received == 0)
                                                         <td class="border-bottom-0 border-right-0 ">
                                                            <span class="total3"></span>
                                                            {{$InvoiceDetails->code}}</td>
                                                    @elseif ($InvoiceDetails->is_payment_received == 1)
                                                        <td class="border-bottom-0 border-right-0">
                                                            00.00
                                                             {{$InvoiceDetails->code}}</td>
                                                    @endif
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </td>
            
                            </tr>
                        </tbody></table>
                        <table width="100%" class="inv-desc-mob d-block d-lg-none d-md-none">
            
                                                                        <tbody><tr>
                                        <th width="50%" class="bg-light-grey text-dark-grey font-weight-bold">
                                            Description</th>
                                        <td class="p-0 ">
                                            <table>
                                                <tbody><tr width="100%" class="font-weight-semibold f-13">
                                                    <td class="border-left-0 border-right-0 border-top-0">
                                                        yh</td>
                                                </tr>
                                                                                        <tr>
                                                        <td class="border-left-0 border-right-0 border-bottom-0 f-12">
                                                            rty
                                                                                                        </td>
                                                    </tr>
                                                                                </tbody></table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="50%" class="bg-light-grey text-dark-grey font-weight-bold">
                                            Quantity</th>
                                        <td width="50%">1</td>
                                    </tr>
                                    <tr>
                                        <th width="50%" class="bg-light-grey text-dark-grey font-weight-bold">
                                            Unit Price                                (USD)</th>
                                        <td width="50%">20.00
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="50%" class="bg-light-grey text-dark-grey font-weight-bold">
                                            Amount                                (USD)</th>
                                        <td width="50%">20.00</td>
                                    </tr>
                                    <tr>
                                        <td height="3" class="p-0 " colspan="2"></td>
                                    </tr>
                                                
                            <tr>
                                <th width="50%" class="text-dark-grey font-weight-normal">Sub Total                    </th>
                                <td width="50%" class="text-dark-grey font-weight-normal">
                                    20.00</td>
                            </tr>
                            
                                            <tr>
                                <th width="50%" class="text-dark-grey font-weight-bold">Total</th>
                                <td width="50%" class="text-dark-grey font-weight-bold">
                                    20.00</td>
                            </tr>
                            <tr>
                                <th width="50%" class="f-16 bg-light-grey text-dark font-weight-bold">
                                    Total Due                        </th>
                                <td width="50%" class="f-16 bg-light-grey text-dark font-weight-bold">
                                    20.00
                                    USD</td>
                            </tr>
                        </tbody></table>
                        <table class="inv-note" width="100%">
                            <tbody><tr>
                                <td height="30" colspan="2"></td>
                            </tr>
                            <tr>
                                <td>Note</td>
                                <td style="text-align: right;">Terms and Conditions</td>
                            </tr>
                            <tr>
                                <td style="vertical-align: text-top">
                                    <p class="text-dark-grey">{{$InvoiceDetails->recipient_notes}}</p>
                                </td>
                                                                     
                                <td style="text-align: right;">
                                    <p class="text-dark-grey">Thank you for your business.</p>
                                    <!-- <p class="text-dark-grey">{{$InvoiceDetails->recipient_notes}}.</p> -->
                                </td>
                            </tr>
                            
                            <tr>
                                <td colspan="2" align="right">
                                    <table>
            
                                                                </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table>
                                        <tbody><tr>
                                                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                        </tbody></table>
                    </div>
                </div>
            </div>
            </div>
          <!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function () {
        calculateSum();

        function calculateSum() {
            var totalAmtSum = 0;

            // Iterate over each element with class 'total_amt'
            $('.total_amt').each(function () {
                var totalAmt = parseFloat($(this).text().replace(/[^0-9.-]+/g,""));
                if (!isNaN(totalAmt)) {
                    totalAmtSum += totalAmt;
                }
            });

            // Update the element with class 'sub_total'
            $('.sub_total').text(numberWithCommas(totalAmtSum.toFixed(2)));
            $('.total2').text(numberWithCommas(totalAmtSum.toFixed(2)));
            $('.total3').text(numberWithCommas(totalAmtSum.toFixed(2)));
        }

        // Format number with commas for better readability
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
                    window.print();

    });
</script>
 

@endsection

