<!DOCTYPE html>
<html
lang="en"
class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
dir="ltr"
data-theme="theme-default"
data-assets-path="{{url('public/assets/')}}"
data-template="vertical-menu-template">
<head>
   <meta charset="utf-8" />
   <meta
   name="viewport"
   content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

   <title>Print Quotes</title>

   <meta name="description" content="" />

   <!-- Favicon -->
   <link rel="icon" type="image/x-icon" href="{{url('public/logo/favicon.png')}}" />

   <!-- Fonts -->
   <link rel="preconnect" href="https://fonts.googleapis.com" />
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />


   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

   <!-- Core CSS -->
   <link rel="stylesheet" href="{{url('public/assets/vendor/css/rtl/core.css')}}" class="template-customizer-core-css" />
   <link rel="stylesheet" href="{{url('public/assets/vendor/css/rtl/theme-default.css')}}" class="template-customizer-theme-css" />
   <link rel="stylesheet" href="{{url('public/assets/css/demo.css')}}" />

   <!-- Vendors CSS -->
   <link rel="stylesheet" href="{{url('public/assets/vendor/libs/node-waves/node-waves.css')}}" />
   <link rel="stylesheet" href="{{url('public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
   <link rel="stylesheet" href="{{url('public/assets/vendor/libs/typeahead-js/typeahead.css')}}" />
   <link rel="stylesheet" href="{{url('public/assets/vendor/libs/flatpickr/flatpickr.css')}}" />

   <!-- Page CSS -->

   <link rel="stylesheet" href="{{url('public/assets/vendor/css/pages/app-invoice.css')}}" />



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
        width: 100%;
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


    @media print {
       p.bodyText {font-family:georgia, times, serif;}
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

.paid {
  background-color: #fff;
  border: 1px solid #00ff11;
  color: #00ff11;
  padding: 11px 22px;
  position: relative;
  text-transform: uppercase;
}

</style>
</head>

<body>

  <!-- Content wrapper -->
  <div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card-body">



            <div class="invoice-table-wrapper">
                <table width="100%">
                    <tbody><tr class="inv-logo-heading">
                        <td class="tthead"><img src="{{$Quotes->companylogo}}" alt="Worksuite" id="logo"></td>
                        <td align="right" class="font-weight-bold f-21 text-dark text-uppercase mt-4 mt-lg-0 mt-md-0 tthead">
                        Quotes</td>
                    </tr>
                    <tr class="inv-num">
                        <td width="61%" class="f-14 text-dark">
                             <p class="mt-3 mb-0"><br>
                               @if($InvoiceSettings->show_client_company_name == 1)
                               {{$Quotes->company_name}}
                               @endif<br> 

                               {{$Quotes->contact_no}} <br>
                               {{$Quotes->billing_address}}
                             </p>
                        </td>
                        <td align="right">
                            <table class="inv-num-date text-dark f-13 mt-3" width="100%">
                              <tbody>
                                <tr>
                                  <td class="bg-light-grey border-right-0 f-w-500">
                                    Quote Number
                                  </td>
                                  <td class="border-left-0">{{$Quotes->invoice_number1}} {{$Quotes->invoice_number2}}</td>
                                </tr>
                                <tr>
                                  <td class="bg-light-grey border-right-0 f-w-500">Quote Date</td>
                                  <td class="border-left-0">{{$Quotes->date_created}}</td>
                                </tr>
                                <tr>
                                  <td class="bg-light-grey border-right-0 f-w-500">Due Date</td>
                                  <td class="border-left-0">{{$Quotes->valid_until}}</td>
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
                              <span class="text-dark-grey text-capitalize">Billed To</span><br>
                              @if($InvoiceSettings->show_client_name ==1)
                              {{ $Quotes->first_name }} {{ $Quotes->last_name }}
                              @endif<br>

                              @if($InvoiceSettings->show_client_email ==1)
                              {{ $Quotes->email }}
                              @endif<br>

                              @if($InvoiceSettings->show_client_phone ==1)
                              {{ $Quotes->phone_number }}
                              @endif<br>

                              @if($InvoiceSettings->show_client_company_address ==1)
                              {{ $Quotes->address_1 }}<br>
                              {{ $Quotes->address_2 }}<br>
                              @endif

                              {{ $Quotes->pincode }}<br>

                            </p>
                    </td>
                        <td align="right" class="mt-2 mt-lg-0 mt-md-0">
                            <input type="hidden" value="{{ $Quotes->is_payment_recieved }}" id="is_payment_recieved">
                            @if ($Quotes->is_payment_recieved == 0)
                            <span class="unpaid rounded f-15">Unpaid</span>
                            @elseif ($Quotes->is_payment_recieved == 1)
                            <span class="paid rounded f-15">Paid</span>
                            @endif
                          </td>
                    </tr>
                    <tr>
                        <td height="30" colspan="2"></td>
                    </tr>
                </tbody></table>
                <table width="100%" class="inv-desc d-lg-table d-md-table">
                    <tbody><tr>
                        <td colspan="2">
                            <table class="inv-detail f-14 table-responsive-sm" width="100%">
                                <tbody>
                                    <tr class="i-d-heading bg-light-grey text-dark-grey font-weight-bold">
                                      <td class="border-right-0" width="35%">Description</td>
                                      <td class="border-right-0 border-left-0" align="right">
                                        Quantity
                                      </td>
                                      <td class="border-right-0 border-left-0" align="right">
                                        Unit Price @if($Currency && $Currency->code)({{$Currency->code}}) @endif
                                      </td>
                                      <td class="border-right-0 border-left-0" align="right">Tax</td>
                                      <td class="border-left-0" align="right" width="20%">
                                        Amount @if($Currency && $Currency->code)({{$Currency->code}}) @endif
                                      </td>
                                    </tr>
                                    @foreach($QuotesCal as $Quote)
                                        @php 
                                            $Tax = \App\Models\TaxSetting::whereIn('id', explode(',',$Quote->Caltax))->get(); 
                                            $TaxRatePer = $Tax->sum('rate');
                                        @endphp
                                        <input type="hidden" class="Caltax" value="{{$TaxRatePer}}">
                                        <tr class="text-dark font-weight-semibold f-13">
                                            <td>{{$Quote->description}}</td>
                                            <td align="right">{{$Quote->qty}}<br> <span class="f-11 text-dark-grey">Pcs</span></td>
                                            <td align="right">{{$Quote->unit_price}}</td>
                                            <td align="right" >
                                                @foreach($Tax as $tax)
                                                    {{$tax->tax_name}} {{$tax->rate}}% @if(!$loop->last) , @endif
                                                @endforeach
                                            </td>
                                            <td align="right" class="total_amt">{{$Quote->total}}</td>
                                        </tr>
                                    @endforeach
                                                                                     <!--    <tr class="text-dark f-12">
                                                        <td colspan="5" class="border-bottom-0">
                                                            rty
                                                                                                        </td>
                                                                                                    </tr> -->

                                     <tr>
                                         <td colspan="3" class="blank-td border-bottom-0"></td>
                                           <td class="p-0" align="right">
                                            <table width="100%">
                                              <tbody>
                                                <tr class="text-dark-grey" align="right">
                                                  <td class="w-50 border-top-0 border-left-0">
                                                    Sub Total
                                                  </td>
                                                </tr>
                                                <tr class="text-dark-grey" align="right">
                                                  <td class="w-50 border-top-0 border-left-0">
                                                     Total Tax
                                                  </td>
                                                </tr>
                                                
                                                <tr class=" text-dark-grey font-weight-bold" align="right">
                                                  <td class="w-50 border-bottom-0 border-left-0">
                                                    Total
                                                  </td>
                                                </tr>
                                                <tr class="bg-light-grey text-dark f-w-500 f-16" align="right">
                                                  <td class="w-50 border-bottom-0 border-left-0">
                                                    Total Due
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </td>
                                         <td class="p-0" align="right">
                                                <table width="100%">
                                                  <tbody>
                                                    <tr class="text-dark-grey" align="right">
                                                      <td align="right" class="border-top-0 border-right-0 sub_total"></td>
                                                    </tr>
                                                     <tr class="text-dark-grey" align="right">
                                                      <td align="right" class="border-top-0 border-right-0 total_tax"></td>
                                                    </tr>
                                                    <tr class=" text-dark-grey font-weight-bold" align="right">
                                                      <td class="border-bottom-0 border-right-0 total2"></td>
                                                    </tr>
                                                    <tr class="bg-light-grey text-dark f-w-500 f-16" align="right">
                                                      <td class="border-bottom-0 border-right-0">
                                                        <span class="totalDue"></span>
                                                      </td>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                              </td>
                                             </tr>
                                         </tbody>
                                     </table>
                                     </td>

                                 </tr>
                             </tbody>
                         </table>

                             <table class="inv-note" width="100%">
                                 <tbody>
                                 <tr>
                                     <td width="100%"></td>
                                     <td><img src="{{$Quotes->signature}}"  class="mt-2 mb-2" height="70" width="15%"></td>
                                 </tr>
                                 <tr>
                                     <td>Note</td>
                                     <td style="text-align: right;">Terms and Conditions</td>
                                 </tr>
                                 <tr>
                                     <td style="vertical-align: text-top">
                                         <p class="text-dark-grey">{{$Quotes->subject}}</p>
                                     </td>

                                     <td style="text-align: right;">
                                         <p class="text-dark-grey">{{$InvoiceSettings->invoice_terms}}</p>
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


                                                                <div class="content-backdrop fade"></div>
                                                            </div>
                                                            <!-- Content wrapper -->
                                                        </div>
                                                        <!-- / Layout page -->
                                                    </div>

                                                    <!-- Overlay -->
                                                    <div class="layout-overlay layout-menu-toggle"></div>

                                                    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
                                                    <div class="drag-target"></div>
                                                </div>
                                                <!-- / Layout wrapper -->

                                                <!-- Core JS -->
                                                <!-- build:js assets/vendor/js/core.js -->

                                                <script src="{{url('public/assets/vendor/libs/jquery/jquery.js')}}"></script>
                                                <script src="{{url('public/assets/vendor/libs/popper/popper.js')}}"></script>
                                                <script src="{{url('public/assets/vendor/js/bootstrap.js')}}"></script>
                                                <script src="{{url('public/assets/vendor/libs/node-waves/node-waves.js')}}"></script>
                                                <script src="{{url('public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
                                                <script src="{{url('public/assets/vendor/libs/hammer/hammer.js')}}"></script>
                                                <script src="{{url('public/assets/vendor/libs/i18n/i18n.js')}}"></script>
                                                <script src="{{url('public/assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>
                                                <script src="{{url('public/assets/vendor/js/menu.js')}}"></script>

                                                <!-- endbuild -->

                                                <!-- Vendors JS -->
                                                <script src="{{url('public/assets/vendor/libs/moment/moment.js')}}"></script>
                                                <script src="{{url('public/assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
                                                <script src="{{url('public/assets/vendor/libs/cleavejs/cleave.js')}}"></script>
                                                <script src="{{url('public/assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>

                                                <!-- Main JS -->
                                                <script src="{{url('public/assets/js/main.js')}}"></script>

                                                <!-- Page JS -->
                                                <script src="{{url('public/assets/js/offcanvas-add-payment.js')}}"></script>
                                                <script src="{{url('public/assets/js/offcanvas-send-invoice.js')}}"></script>
                                            </body>
                                            </html>



