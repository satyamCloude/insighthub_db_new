@extends('layouts.admin')
@section('title', 'Quotes')
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
<div class="container-xxl flex-grow-1 container-p-y">
   <div class="card-body">
      <div class="invoice-table-wrapper">
         <table width="100%">
            <tbody>
               <tr class="inv-logo-heading">
                  <td class="tthead"><img src="{{ url($InvoiceSettings->invoice_logo) }}" alt="Worksuite" id="logo"></td>
                  <td align="right" class="font-weight-bold f-21 text-dark text-uppercase mt-4 mt-lg-0 mt-md-0 tthead">Quotes</td>
               </tr>
               <tr class="inv-num">
                  <td class="f-14 text-dark">
                     <p class="mt-3 mb-0">
                        <br>
                        Company Name : @if($Quotes && $Quotes->company_name) {{$Quotes->company_name}} @endif<br> 
                        Billing address : @if($Quotes && $Quotes->billing_address) {{$Quotes->billing_address}} @endif <br>
                        Pincode : @if($Quotes && $Quotes->pin_code) {{$Quotes->pin_code}} @endif <br>
                        Call-no : @if($Quotes && $Quotes->contact_no) {{$Quotes->contact_no}} @endif <br>
                        E-mail : @if($Quotes && $Quotes->email_address) {{$Quotes->email_address}} @endif <br>
                        Pan-no : @if($Quotes && $Quotes->pan_number) {{$Quotes->pan_number}} @endif <br>
                        HSN/SAC : @if($Quotes && $Quotes->hsn_number) {{$Quotes->hsn_number}} @endif <br>
                        GSTIN : @if($Quotes && $Quotes->gst_number) {{$Quotes->gst_number}} @endif <br>
                        Tan-no : @if($Quotes && $Quotes->tan_number) {{$Quotes->tan_number}} @endif <br>
                     </p>
                  </td>
                  <td align="right">
                     <table class="inv-num-date text-dark f-13 mt-3">
                        <tbody>
                           <tr>
                              <td class="bg-light-grey border-right-0 f-w-500">
                                 Invoice Number
                              </td>
                              <td class="border-left-0"> @if($Quotes && $Quotes->invoice_number1) {{$Quotes->invoice_number1}} @else 
                                 @if($Quotes && $Quotes->id) {{$Quotes->id}} @endif @endif @if($Quotes && $Quotes->invoice_number2) {{$Quotes->invoice_number2}} @endif 
                              </td>
                           </tr>
                           <tr>
                              <td class="bg-light-grey border-right-0 f-w-500">Invoice Date</td>
                              <td class="border-left-0"> @if($Quotes && $Quotes->date_created) {{$Quotes->date_created}} @endif </td>
                           </tr>
                           <tr>
                              <td class="bg-light-grey border-right-0 f-w-500">Due Date</td>
                              <td class="border-left-0">@if($Quotes && $Quotes->valid_until) {{$Quotes->valid_until}} @endif</td>
                           </tr>
                        </tbody>
                     </table>
                  </td>
               </tr>
               <tr>
                  <td height="20"></td>
               </tr>
            </tbody>
         </table>
         <table width="100%">
            <tbody>
               <tr class="inv-unpaid">
                  <td class="f-14 text-dark">
                  <!-- <p class="mb-0 text-left">
                     <span class="text-dark-grey text-capitalize">Billed To</span><br>
                     @if($InvoiceSettings->show_client_name ==1)
                     @if($Quotes && $Quotes->first_name) {{$Quotes->first_name}} @endif  @if($Quotes && $Quotes->last_name) {{$Quotes->last_name}} @endif 
                     @endif
                     <br>
                     @if($InvoiceSettings->show_client_phone ==1)
                     @if($Quotes && $Quotes->phone_number) {{$Quotes->phone_number}} @endif 
                     @endif
                     <br>
                     @if($InvoiceSettings->show_client_email ==1)
                     @if($Quotes && $Quotes->email) {{$Quotes->email}} @endif 
                     @endif
                     <br>
                     @if($InvoiceSettings->show_client_company_name == 1)
                     @if($Quotes && $Quotes->company_id) {{$Quotes->company_id}} @endif
                     @endif
                     <br>
                     @if($InvoiceSettings->show_client_company_address ==1)
                     @if($Quotes && $Quotes->address_1) {{$Quotes->address_1}} @endif <br>
                     @if($Quotes && $Quotes->address_2) {{$Quotes->address_2}} @endif <br>
                     @if($Quotes && $Quotes->pincode) {{$Quotes->pincode}} @endif <br>
                     @endif
                     @if($Quotes && $Quotes->gstin) {{$Quotes->gstin}} @endif <br>
                     @if($Quotes && $Quotes->hsn_sac) {{$Quotes->hsn_sac}} @endif <br>
                  </p> -->
                  <p class="mb-0 text-left">
                        <span class="text-dark-grey text-capitalize">Billed To</span><br>
                        
                        @if($InvoiceSettings->show_client_name == 1)
                            @if($Quotes && $Quotes->first_name) 
                                Name: {{$Quotes->first_name}} 
                            @endif  
                            @if($Quotes && $Quotes->last_name) 
                                {{$Quotes->last_name}} 
                            @endif
                            <br>
                        @endif
                        
                        @if($InvoiceSettings->show_client_phone == 1)
                            @if($Quotes && $Quotes->phone_number) 
                                Call-no: {{$Quotes->phone_number}} 
                            @endif
                            <br>
                        @endif
                        
                        @if($InvoiceSettings->show_client_email == 1)
                            @if($Quotes && $Quotes->email) 
                                E-mail: {{$Quotes->email}} 
                            @endif
                            <br>
                        @endif
                        
                        @if($InvoiceSettings->show_client_company_name == 1)
                            @if($Quotes && $Quotes->company_id) 
                                Company Name: {{$Quotes->company_id}} 
                            @endif
                            <br>
                        @endif
                        
                        @if($InvoiceSettings->show_client_company_address == 1)
                            @if($Quotes && $Quotes->address_1) 
                                Address 1: {{$Quotes->address_1}} 
                            @endif 
                            <br>
                            @if($Quotes && $Quotes->address_2) 
                                Address 2: {{$Quotes->address_2}} 
                            @endif 
                            <br>
                            @if($Quotes && $Quotes->pincode) 
                                Pincode: {{$Quotes->pincode}} 
                            @endif 
                            <br>
                        @endif
                        
                        @if($Quotes && $Quotes->gstin) 
                            GSTIN: {{$Quotes->gstin}} 
                            <br>
                        @endif
                        
                        @if($Quotes && $Quotes->hsn_sac) 
                            HSN/SAC: {{$Quotes->hsn_sac}} 
                            <br>
                        @endif
                    </p>

                  </td>
                  <td align="right" class="mt-2 mt-lg-0 mt-md-0">
                     @if ($Quotes && $Quotes->is_payment_recieved == 0)
                     <span class="unpaid rounded f-15">Unpaid</span>
                     @elseif ($Quotes && $Quotes->is_payment_recieved == 1)
                     <span class="paid rounded f-15" style="
                              background-color: #fff;
                              border: 1px solid #28c76f;
                              color: #28c76f;
                              padding: 11px 22px;
                              position: relative;
                              text-transform: uppercase;
                        ">Paid
                     </span>
                     @else
                     <span class="unpaid rounded f-15">Unpaid</span>
                     @endif
                  </td>
               </tr>
               <tr>
                  <td height="30" colspan="2"></td>
               </tr>
            </tbody>
         </table>
         <h1 class="text-dark" style="font-size: 1.375rem !important;">INVOICE ITEMS</h1>
         <table width="100%" class="inv-desc d-none d-lg-table d-md-table">
            <tbody>
               <tr>
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
                              <td>{!!$Quote->description!!}</td>
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
         <!-- Mobile View Table -->
         <table width="100%" class="inv-desc-mob d-block d-lg-none d-md-none">
            <tbody>
               <!-- Description -->
               <tr>
                  <th width="50%" class="bg-light-grey text-dark-grey font-weight-bold">
                     Description
                  </th>
                  <td class="p-0">
                     <table>
                        <tbody>
                           <tr width="100%" class="font-weight-semibold f-13">
                              <td class="border-left-0 border-right-0 border-top-0">
                                 yh
                              </td>
                           </tr>
                           <tr>
                              <td class="border-left-0 border-right-0 border-bottom-0 f-12">
                                 rty
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </td>
               </tr>
               <!-- Quantity -->
               <tr>
                  <th width="50%" class="bg-light-grey text-dark-grey font-weight-bold">
                     Quantity
                  </th>
                  <td width="50%">1</td>
               </tr>
               <!-- Unit Price (USD) -->
               <tr>
                  <th width="50%" class="bg-light-grey text-dark-grey font-weight-bold">
                     Unit Price (USD)
                  </th>
                  <td width="50%">20.00</td>
               </tr>
               <!-- Amount (USD) -->
               <tr>
                  <th width="50%" class="bg-light-grey text-dark-grey font-weight-bold">
                     Amount (USD)
                  </th>
                  <td width="50%">20.00</td>
               </tr>
               <!-- Sub Total -->
               <tr>
                  <td height="3" class="p-0" colspan="2"></td>
               </tr>
               <tr>
                  <th width="50%" class="text-dark-grey font-weight-normal">Sub Total</th>
                  <td width="50%" class="text-dark-grey font-weight-normal"><span id="SubTotal"></span></td>
               </tr>
               <!-- Total -->
               <tr>
                  <th width="50%" class="text-dark-grey font-weight-bold">Total</th>
                  <td width="50%" class="text-dark-grey font-weight-bold">20.00</td>
               </tr>
               <!-- Total Due -->
               <tr>
                  <th width="50%" class="f-16 bg-light-grey text-dark font-weight-bold">Total Due</th>
                  <td width="50%" class="f-16 bg-light-grey text-dark font-weight-bold">
                     20.00 USD
                  </td>
               </tr>
            </tbody>
         </table>
         <!-- Note Section -->
         <table class="inv-note" width="100%">
            <tbody>
               <tr>
                  <td align="end" height="30" colspan="2">
                     @if($InvoiceSettings && $InvoiceSettings->autorised_sign)   
                     <img src="@if($InvoiceSettings && $InvoiceSettings->autorised_sign) {{$InvoiceSettings->autorised_sign}} @endif" class="mt-2 mb-2" height="70" width="15%">
                     @endif
                  </td>
               </tr>
               <tr>
                  <td>Note</td>
                  <td style="text-align: right;">Terms and Conditions</td>
               </tr>
               <tr>
                  <td style="vertical-align: text-top">
                     <p class="text-dark-grey">@if($Quotes && $Quotes->subject) {{$Quotes->subject}} @endif</p>
                  </td>
                  <td style="text-align: right;">
                     <p class="text-dark-grey">{{$InvoiceSettings->invoice_terms}}</p>
                  </td>
               </tr>
               <tr>
                  <td colspan="2" align="right">
                     <table>
                        <!-- Additional tables can be added if needed -->
                     </table>
                  </td>
               </tr>
               <tr>
                  <td>
                     <table>
                        <tbody>
                           <tr>
                              <!-- Additional rows can be added if needed -->
                           </tr>
                        </tbody>
                     </table>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
</div>
<script type="text/javascript">
   // $(document).ready(function () {
   //     var totalTax = 0;
   //     var totalAmount = 0;
   //     $('.Caltax').each(function () {
   //         var taxValue = parseFloat($(this).val());
   //         totalTax += taxValue;
   //     });
   //     $('.total_amt').each(function () {
   //         var totalText = $(this).text();
   //         var totalValue = parseFloat(totalText.replace(/[^\d.]/g, '')); // Extract the numeric part of the total text
   //         totalAmount += totalValue;
   //     });
   //     $('#TotalTax').text(totalTax.toFixed(2));
   //     $('#SubTotal').text(totalAmount.toFixed(2));
   //     $('.sub_total').text(totalAmount.toFixed(2));
   //     $('.total_tax').text(totalAmount.toFixed(2));
   //     $('.total2').text(totalAmount.toFixed(2));
   //     $('.totalDue').text(0.00);
   //     // alert('Total Tax: ' + totalTax.toFixed(2));
   // });
   $(document).ready(function () {
   var totalTax = 0;
   var totalAmount = 0;
   var is_payment_recieved = $('#is_payment_recieved').val();
   $('.Caltax').each(function () {
       var taxValue = parseFloat($(this).val());
       totalTax += taxValue;
   });
   
   $('.total_amt').each(function () {
       var totalText = $(this).text();
       var totalValue = parseFloat(totalText.replace(/[^\d.]/g, '')); // Extract the numeric part of the total text
       totalAmount += totalValue;
   });
   var totalTaxAmount  = totalAmount * (totalTax / 100);
   var totalAmountNew = totalAmount + totalTaxAmount;
   $('.total_tax').text(totalTaxAmount.toFixed(2));
   $('.sub_total').text(totalAmount.toFixed(2));
   $('.total2').text(totalAmountNew.toFixed(2));
   if(is_payment_recieved == 0){
       $('.totalDue').text(totalAmountNew.toFixed(2));
   }else{
     totalAmountNew = 0;
         $('.totalDue').text(totalAmountNew.toFixed(2));
   }
   $('#SubTotal').text(totalAmount.toFixed(2));
   $('#TotalTax').text(totalTax.toFixed(2));
   });
   
</script>
@endsection












