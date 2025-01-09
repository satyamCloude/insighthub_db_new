<!doctype html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


  <title>Invoice</title>

  <style>
    body {
        margin: 0px;
        font-family: arial;
        font-size: 13px;
    }

    .form_title {
        font-family: Arial, sans-serif, "Helvetica Neue", Helvetica;
        font-weight: bold;
        font-size: 25px;
        text-align: right;
        color: #000;
        text-transform: uppercase;
    }



    .btmbtn {
        background-color: red;
        color: white;
        border: none;
        width: 100%;
    }

    @media print {
        * {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .btmbtn {
            background-color: red;
            color: white;
            border: none;
            width: 88%;
        }

        .btmbtnPAID {
            background-color: green;
            color: white;
            border: none;
            width: 88%;
        }

    }

    .btmbtnPAID {
        background-color: green;
        color: white;
        border: none;
        width: width: 100px;
    }
</style>
</head>


<body style="padding:0 40px;">
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="card-body ">
                            <div class="invoice-table-wrapper">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td><img width="60%" src="{{ url('public/logo/company.png') }}"></td>
                                            <td width="50%" align="left" valign="top" class="form_title"
                                                style="line-height: 1.2;">
                                                <span style="font-size:15px;">

                                                    @if ($Company && $Company->company_name)
                                                        {{ $Company->company_name }}
                                                    @endif <br>
                                                </span>
                                                <span style="font-size: 12px;font-weight: 300;">
                                                    @if ($Company && ($Company->address_1 || $Company->address_2))
                                                        {{ $Company->address_1 ?? '' }}
                                                        {{ $Company->address_2 ?? '' }}<br>
                                                    @endif
                                                    Pin Code:
                                                    @if ($Company && $Company->pin_code)
                                                        {{ $Company->pin_code }}<br>
                                                    @endif
                                                    PAN No :
                                                    @if ($Company && $Company->pan_number)
                                                        {{ $Company->pan_number }}<br>
                                                    @endif
                                                    GSTIN :
                                                    @if ($Company && $Company->gst_number)
                                                        {{ $Company->gst_number }}<br>
                                                    @endif
                                                    HSN/SAC:
                                                    @if ($Company && $Company->hsn_number)
                                                        {{ $Company->hsn_number }}<br>
                                                    @endif
                                                </span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td align="left" valign="top" height="40"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="mb-4">
                                    <tbody>
                                        <tr>
                                            <td width="100%" align="center" valign="top">
                                                <span
                                                    style="font-weight: bold;">
                                                    @if($InvoiceDetails->is_payment_recieved == 0)
                                                    PERFORMA INVOICE
                                                    @else
                                                    TAX INVOICE
                                                    @endif
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td width="50%" align="center" valign="top" class="form_title2"
                                                style="border-top:1px solid black;border-bottom: 1px solid black;">
                                                <b>Email:</b><span>
                                                    @if ($Company)
                                                        {{ $Company->email_address }}
                                                    @endif
                                                </span>
                                            </td>
                                            <td align="center" valign="top" class="form_title2"
                                                style="border-top:1px solid black;border-bottom: 1px solid black;">
                                                <b>Call:</b>
                                                <span>+91 @if ($Company)
                                                        {{ $Company->contact_no }}
                                                    @endif
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td align="left" valign="top" height="40"></td>
                                        </tr>
                                        <tr>
                                            <td width="60%" align="left" valign="top"><b>CLIENT INFORMATION</b></td>
                                            <td width="40%" align="left" valign="top"><b>PAYMENT DETAILS</b></td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" height="13"></td>
                                        </tr>
                                        <tr>
                                            <td width="60%" align="left" valign="top">
                                                <b> @if ($InvoiceSettings && $InvoiceSettings->show_client_name == 1)
                                                    @if ($InvoiceDetails)
                                                        {{ $InvoiceDetails->first_name }} {{ $InvoiceDetails->last_name }}
                                                    @endif
                                                    @endif
                                                </b>
                                                </br><span style="line-height: 1.3;">
                                                 @if ($InvoiceSettings && $InvoiceSettings->show_client_company_address == 1)

                                                    @if ($InvoiceDetails)
                                                        {{ $InvoiceDetails->address_1 }}
                                                    @endif
                                                    </br>
                                                    @if ($InvoiceDetails)
                                                        {{ $InvoiceDetails->address_2 }}
                                                    @endif
                                                    </br>
                                                    @endif
                                                    India</br>
                                                     @if ($InvoiceSettings && $InvoiceSettings->show_client_phone == 1)
                                                    Call : + @if ($InvoiceDetails)
                                                        {{ $InvoiceDetails->phone_number }}
                                                    @endif
                                                    </br> 
                                                    @endif
                                                    @if ($InvoiceSettings && $InvoiceSettings->show_client_company_name == 1)
                                                    Company : + @if ($InvoiceDetails)
                                                        {{ $InvoiceDetails->company_name }}
                                                    @endif
                                                    </br>
                                                    @endif
                                                    @if ($InvoiceSettings && $InvoiceSettings->show_client_name == 1)
                                                     E-mail : @if ($InvoiceDetails)
                                                        {{ $InvoiceDetails->show_client_email }}
                                                    @endif
                                                    </br>
                                                    @endif

                                                    GSTIN : @if ($InvoiceDetails)
                                                        {{ $InvoiceDetails->gst_no }}
                                                    @endif
                                                    </br>
                                                    </br>Place of supply : @if ($InvoiceDetails)
                                                        {{ $InvoiceDetails->shipping_address }}
                                                    @endif
                                                </span>
                                            </td>
                                            <td width="40%" align="left" valign="top">
                                                <b>Invoice No: @if ($InvoiceDetails)
                                                        {{ $InvoiceDetails->invoice_number2 }}
                                                    @endif
                                                </b>
                                                </br>
                                                <span style="line-height: 1.3;">
                                                    Total : @if ($InvoiceDetails)
                                                        {{ $InvoiceDetails->final_total_amt }} {{ $InvoiceDetails->code }}
                                                    @endif
                                                    </br>
                                                    @if ($InvoiceDetails && $InvoiceDetails->is_payment_recieved == 0)
                                                        Due Date:@if ($InvoiceDetails)
                                                            {{ $InvoiceDetails->due_date }}
                                                        @endif
                                                        </br>
                                                    @endif
                                                    Invoice Date:@if ($InvoiceDetails)
                                                        {{ $InvoiceDetails->issue_date }}
                                                    @endif
                                                    </br>
                                                    @if ($InvoiceDetails && $InvoiceDetails->is_payment_recieved == 1)
                                                        Payment Method:
                                                        {{ isset($transaction) ? $transaction->paymentMethod : 'NEFT/IMPS/RTGS' }}
                                                        Transfer
                                                    @endif
                                                    </br>

                                                   @if ($InvoiceSettings && $InvoiceSettings->show_status == 1)
                                                    </br>
                                                    Payment Status :@if ($InvoiceDetails && $InvoiceDetails->is_payment_recieved == 0)
                                                        <button type="button" class="btmbtn">UNPAID</button>
                                                    @elseif ($InvoiceDetails && $InvoiceDetails->is_payment_recieved == 1)
                                                        <button type="button" class="btmbtnPAID">PAID</button>
                                                    @endif
                                                    @endif


                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @php
                                    $subTotal = 0;
                                    $totalTax = 0;
                                    $taxTotals = [];
                                @endphp
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                        <tr>
                                            <td align="left" valign="top" height="40"></td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top"><b>INVOICE ITEMS</b></td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" height="20"></td>
                                        </tr>
                                        </tr>
                                    </tbody>
                                </table>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td width="25%" align="left" valign="top"
                                                style="border:1px solid #D1D1D1;background-color: #EFEFEF;padding:2px 0;">
                                                <b style="margin-left:4px;">Description</b>
                                            </td>
                                            <td width="10%" align="left" valign="top"
                                                style="border:1px solid #D1D1D1;padding:2px 0;">
                                                <span style="margin-left:4px;">Rate</span>
                                            </td>

                                            @foreach ($taxes as $tax)
                                                <td width="10%" align="left" valign="top"
                                                    style="border:1px solid #D1D1D1;padding:2px 0;">
                                                    <span style="margin-left:4px;">{{ $tax->tax_name }}
                                                        ({{ $tax->rate }}%) </span>
                                                </td>
                                            @endforeach

                                            <td width="10%" align="center" valign="top"
                                                style="border:1px solid #D1D1D1;padding:2px 0;"><b>Amount</b>
                                            </td>
                                        </tr>

                                        <tr>

                                            <td width="25%" align="left" valign="top"
                                                style="border:1px solid #D1D1D1;padding:2px 0;">
                                                <span style="margin-left:4px;">
                                                    @if ($InvoiceDetails && $InvoiceDetails->orders->product->product_name)
                                                        {{ $InvoiceDetails->orders->product->product_name }}
                                                        @endif @if ($InvoiceDetails && $InvoiceDetails->orders->product->description)
                                                            <p>{!! $InvoiceDetails->orders->product->description !!} </p>
                                                        @endif
                                                </span>
                                            </td>

                                            <td width="10%" align="left" valign="top"
                                                style="border:1px solid #D1D1D1;padding:2px 0;">
                                                <span style="margin-left:4px;">
                                                    @if ($InvoiceDetails && $InvoiceDetails->price)
                                                        @php $subTotal += $InvoiceDetails->price; @endphp
                                                        {{ number_format($InvoiceDetails->price, 2) }}
                                                    @endif
                                                    @if ($Currency && $Currency->code)
                                                        ({{ $Currency->code }})
                                                    @endif
                                                </span>
                                            </td>

                                           
                                            @foreach ($taxes as $tax)
                                                @php
                                                if(in_array($tax->id , explode(',',$InvoiceDetails->orders->taxes))){
                                                    $taxAmt = 0;
                                                    $quantity = $InvoiceDetails->orders->quantity ?? 1;
                                                    if($InvoiceDetails->price){
                                                        $prices=$InvoiceDetails->price * $quantity;
                                                    }else if($InvoiceDetails->amount){
                                                        $prices=$InvoiceDetails->amount * $quantity;
                                                    }
                                                    
                                                    $taxAmount =
                                                        ((float) $prices * $tax->rate) / 100;
                                                    $totalTax += $taxAmount;

                                                    if (!isset($taxTotals[$tax->tax_name . ' (' . $tax->rate . '%)'])) {
                                                        // If not, initialize it with zero
                                                        $taxTotals[$tax->tax_name . ' (' . $tax->rate . '%)'] = 0;
                                                    }
                                                    // Add the tax amount to the corresponding type
                                                    $taxTotals[$tax->tax_name . ' (' . $tax->rate . '%)'] += $taxAmount;

                                                    $rate = $tax->rate;
                                                }else{
                                                    $rate = 0;
                                                }
                                                @endphp
                                                <td width="10%" align="left" valign="top"
                                                    style="border:1px solid #D1D1D1;padding:2px 0;">
                                                    <span
                                                        style="margin-left:4px;">
                                                            @if($clientDetails && $clientDetails->tax_exampt == 0)
                                                        {{ $rate > 0 ? number_format(($prices * $rate) / 100, 2) : '0.00' }}
                                                            @else
                                                             0.00
                                                             @endif
                                                        ({{ $Currency->code }}) </span>
                                                </td>
                                            @endforeach

                                            @if ($InvoiceDetails && $InvoiceDetails->price)
                                                <td width="10%" align="center" valign="top"
                                                    style="border:1px solid #D1D1D1;padding:2px 0;">
                                                    <b>
                                                    @php
                                                    if($clientDetails && $clientDetails->tax_exampt == 0)
                                                    $totalTax = $totalTax;
                                                     else
                                                     $totalTax = 0.00;
                                                     @endphp
                                                             {{ number_format($InvoiceDetails->price * $InvoiceDetails->orders->quantity + $totalTax, 2) }}
                                                        @if ($Currency && $Currency->code)
                                                            ({{ $Currency->code }})
                                                        @endif
                                                    </b>
                                                </td>
                                                
                                            @elseif($InvoiceDetails && $InvoiceDetails->amount)
                                            <td width="10%" align="center" valign="top"
                                                    style="border:1px solid #D1D1D1;padding:2px 0;">
                                                    <b>
                                                         @php
                                                         if($clientDetails && $clientDetails->tax_exampt == 0)
                                                         $totalTax = $totalTax;
                                                         else
                                                         $totalTax = 0;
                                                         @endphp

                                                        {{ number_format($InvoiceDetails->amount * $InvoiceDetails->orders->quantity + $totalTax, 2) }}

                                                        @if ($Currency && $Currency->code)
                                                            ({{ $Currency->code }})
                                                        @endif
                                                    </b>
                                                </td>
                                            @endif
                                        </tr>

                                        @if (!empty($addOnProduct))
                                            @foreach ($addOnProduct as $addOnProductDetail)
                                                @php
                                                    $taxAmt = 0;
                                                    $subTotal += $addOnProductDetail->price;
                                                @endphp
                                                <tr>
                                                    <td width="25%" align="left" valign="top"
                                                        style="border:1px solid #D1D1D1;padding:2px 0;"><span
                                                            style="margin-left:4px;">
                                                            @if ($addOnProductDetail && $addOnProductDetail->product_name)
                                                                {{ $addOnProductDetail->product_name }}
                                                                @endif @if ($addOnProductDetail && $addOnProductDetail->description)
                                                                    <p>{!! $addOnProductDetail->description !!} </p>
                                                                @endif
                                                        </span>
                                                    </td>
                                                      <td width="10%" align="left" valign="top"
                                                        style="border:1px solid #D1D1D1;padding:2px 0;"><span
                                                            style="margin-left:4px;">
                                                            @if ($addOnProductDetail && $addOnProductDetail->price)
                                                                {{ number_format($addOnProductDetail->price, 2) }}
                                                                @endif @if ($Currency && $Currency->code)
                                                                    ({{ $Currency->code }})
                                                                @endif
                                                        </span></td>
                                                        <td width="10%" align="left" valign="top"
                                                        style="border:1px solid #D1D1D1;padding:2px 0;"><span
                                                            style="margin-left:4px;">
                                                            @if ($addOnProductDetail && $addOnProductDetail->quantity)
                                                                {{$addOnProductDetail->quantity }}
                                                                @endif 
                                                        </span></td>

                                                    @foreach ($taxes as $tax)
                                                        @php
                                                        if(in_array($tax->id , explode(',',$addOnProductDetail->tax))){

                                                            $taxAmount =
                                                                ($addOnProductDetail->price * $tax->rate) / 100;
                                                            $totalTax += (float) $taxAmount;
                                                            $taxAmt += $taxAmount;

                                                            if (
                                                                !isset(
                                                                    $taxTotals[
                                                                        $tax->tax_name . ' (' . $tax->rate . '%)'
                                                                    ],
                                                                )
                                                            ) {
                                                                $taxTotals[
                                                                    $tax->tax_name . ' (' . $tax->rate . '%)'
                                                                ] = 0;
                                                            }
                                                            $taxTotals[
                                                                $tax->tax_name . ' (' . $tax->rate . '%)'
                                                            ] += $taxAmount;

                                                            $rate = $tax->rate;
                                                        }else{
                                                            $rate = 0; 
                                                        }
                                                        @endphp
                                                        <td width="10%" align="left" valign="top"
                                                            style="border:1px solid #D1D1D1;padding:2px 0;">
                                                            <span
                                                                style="margin-left:4px;">
                                                                @if($clientDetails && $clientDetails->tax_exampt == 0)
                                                                {{  $rate > 0 ? number_format(($addOnProductDetail->price  * $addOnProductDetail->quantity * $rate) / 100, 2) : '0.00'}}
                                                                @else
                                                                0.00
                                                                @endif
                                                                ({{ $Currency->code }}) </span>
                                                        </td>
                                                    @endforeach

                                                  @if ($addOnProductDetail && $addOnProductDetail->price)
                                                    <td width="10%" align="center" valign="top" style="border:1px solid #D1D1D1;padding:2px 0;">
                                                        @php

                                                        $taxAmount = (($addOnProductDetail->price * $addOnProductDetail->quantity) * $addOnProductDetail->rate) / 100;
                                                
                                                    if($clientDetails && $clientDetails->tax_exampt == 0)
                                                    $taxAmount =$taxAmount;
                                                    else
                                                    $taxAmount = 0;
                                                        $totalPrice = ($addOnProductDetail->price * $addOnProductDetail->quantity) + $taxAmount;
                                                        @endphp
                                                        <b> 
                                                            {{ number_format($totalPrice, 2) }} 
                                                            @if ($Currency && $Currency->code)
                                                               ({{ $Currency->code }}) </span>
                                                            @endif 
                                                        </b>
                                                    </td>
                                            @endif

                                                </tr>
                                                
                                                
                                            @endforeach
                                        @endif
                                            @if (!empty($OsOrder))
                                                @php
                                                    $osPrice = $OsOrder->os_price;
                                                    $osTaxRate = isset($OsOrder->rate) ? floatval($OsOrder->rate) : 0;
                                                    $osTaxAmount = ($osPrice * $osTaxRate) / 100;
                                                    if($clientDetails && $clientDetails->tax_exampt == 0)
                                                    $osTaxAmount = $osTaxAmount;
                                                    else
                                                    $osTaxAmount = 0; 

                                                    $totalOsPrice = $osPrice + $osTaxAmount;
                                    
                                                    $subTotal += $osPrice;
                                                    $totalTax += $osTaxAmount;
                                    
                                                    if (!isset($taxTotals['Operating System (' . $osTaxRate . '%)'])) {
                                                        $taxTotals['Operating System (' . $osTaxRate . '%)'] = 0;
                                                    }
                                                    $taxTotals['Operating System (' . $osTaxRate . '%)'] += $osTaxAmount;
                                                @endphp
                                                <tr>
                                                   <td width="10%" align="left" valign="top"
                                                style="border:1px solid #D1D1D1;padding:2px 0;">
                                                <span style="margin-left:4px;">{{ $OsOrder->ostype }}</span></td>
                                                    <td width="10%" align="left" valign="top"
                                                style="border:1px solid #D1D1D1;padding:2px 0;">
                                                <span style="margin-left:4px;">{{ number_format($osPrice, 2) }}</span></td>
                                                    <td width="10%" align="left" valign="top"
                                                style="border:1px solid #D1D1D1;padding:2px 0;">
                                                <span style="margin-left:4px;">1</span></td>
                                                    @foreach ($taxes as $tax)
                                                        @php
                                                        if(in_array($tax->id , explode(',',$OsOrder->tax))){

                                                            $taxAmount =
                                                                ($OsOrder->os_price * $OsOrder->rate) / 100;
                                                            $totalTax += (float) $taxAmount;
                                                            $taxAmt += $taxAmount;

                                                            if (
                                                                !isset(
                                                                    $taxTotals[
                                                                        $tax->tax_name . ' (' . $OsOrder->rate . '%)'
                                                                    ],
                                                                )
                                                            ) {
                                                                $taxTotals[
                                                                    $tax->tax_name . ' (' . $OsOrder->rate . '%)'
                                                                ] = 0;
                                                            }
                                                            $taxTotals[
                                                                $tax->tax_name . ' (' . $OsOrder->rate . '%)'
                                                            ] += $taxAmount;

                                                            $rate = $OsOrder->rate;
                                                        }else{
                                                            $rate = 0; 
                                                        }
                                                        @endphp
                                                        <td width="10%" align="left" valign="top"
                                                            style="border:1px solid #D1D1D1;padding:2px 0;">
                                                            <span
                                                                style="margin-left:4px;">
                                                            @if($clientDetails && $clientDetails->tax_exampt == 0)
                                                                {{  $rate > 0 ? number_format(($OsOrder->os_price  * $rate) / 100, 2) : '0.00'}}
                                                                @else
                                                                0.00
                                                                @endif
                                                                ({{ $Currency->code }}) </span>
                                                        </td>
                                                    @endforeach

                                                    <td width="10%" align="left" valign="top"
                                                style="border:1px solid #D1D1D1;padding:2px 0;">
                                                <span style="margin-left:4px;"><b>{{ number_format($totalOsPrice, 2) }} ({{ $Currency->code }})</b></span></td>
                                                </tr>
                                            @endif
                                     
                                     
                                   
                                    </tbody>
                                </table>
                                 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td width="55%" align="right" valign="top"
                                                style="border:1px solid #D1D1D1;background-color: #EFEFEF;padding:2px 0;">
                                                <b style="margin-right:4px;">Sub Total</b></td>
                                            <td width="10%" align="center" valign="top"
                                                style="border:1px solid #D1D1D1;background-color: #EFEFEF;padding:2px 0;">
                                                <b style="margin-left:4px;">
                                                    @if ($InvoiceDetails)
                                                        {{ $Currency->prefix }} {{ number_format($subTotal, 2) }}
                                                    @else
                                                        0.00
                                                        @endif @if ($Currency && $Currency->code)
                                                            ({{ $Currency->code }})
                                                        @endif
                                                </b></td>
                                        </tr>

                                        <!--  @foreach ($taxes as $tax)
                                            <tr>
                                              <td width="55%" align="right" valign="top"
                                              style="border:1px solid #D1D1D1;background-color: #EFEFEF;padding:2px 0;"><b
                                                style="margin-right:4px;">{{ $tax->tax_name }} ({{ $tax->rate }}%)</b></td>
                                              <td width="10%" align="center" valign="top"
                                              style="border:1px solid #D1D1D1;background-color: #EFEFEF;padding:2px 0;"><b
                                                style="margin-left:4px;">{{ $Currency->prefix }} {{ number_format($totalTax, 2) }} ({{ $Currency->code }})</b></td>
                                              
                                          </tr>
                                            @endforeach -->
                                            @if($clientDetails && $clientDetails->tax_exampt == 0)
                                        @foreach ($taxTotals as $type => $total)
                                            <tr>
                                                <td width="55%" align="right" valign="top"
                                                    style="border:1px solid #D1D1D1;background-color: #EFEFEF;padding:2px 0;">
                                                    <b style="margin-right:4px;">{{ $type }}</b>
                                                </td>
                                                <td width="10%" align="center" valign="top"
                                                    style="border:1px solid #D1D1D1;background-color: #EFEFEF;padding:2px 0;">
                                                    <b style="margin-left:4px;">{{ $Currency->prefix }}
                                                        {{ number_format($total, 2) }} ({{ $Currency->code }})</b>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif




                                        <!-- <tr>
                                            <td width="55%" align="right" valign="top" style="border:1px solid #D1D1D1;background-color: #EFEFEF;padding:2px 0;">

                                                @if ($InvoiceDetails && $InvoiceDetails->taxes)
                                                @php
                                                    $givenAmount = $InvoiceDetails->sub_total;

                                                @endphp
                                                @if (count($taxes) > 1) {{-- If there are multiple taxes --}}
                                                @foreach ($taxes as $tax)
                                                    <b>{{ $tax->tax_name }} ({{ $tax->rate }} %)</b><br>
                                                @endforeach
                                                @else
                                                    {{-- If there is a single tax --}}
                                                <b>{{ $taxes->first()->tax_name }} ({{ $taxes->first()->rate }} %)</b>
                                                @endif
                                                @endif
                                            </td>
                                            <td width="45%" align="right" valign="top" style="border:1px solid #D1D1D1;background-color: #EFEFEF;padding:2px 0;">
                                                @if ($InvoiceDetails && $InvoiceDetails->taxes)
                                                  @if (count($taxes) > 1)
                                                  @foreach ($taxes as $tax)
                                                        <b>{{ $tax->tax_name }} ({{ $tax->rate }} %)</b><br>
                                                                                                      {{ $givenAmount * ($tax->rate / 100) }}<br>
                                                        @endforeach
                                                    @else
                                                        {{ $givenAmount * ($taxes->first()->rate / 100) }}
                                                  @endif
                                                @endif
                                            </td>
                                        </tr> -->

                                        <tr>
                                            <td width="55%" align="right" valign="top"
                                                style="border:1px solid #D1D1D1;background-color: #EFEFEF;padding:2px 0;">
                                                <b style="margin-right:4px;">Total</b>
                                            </td>
                                            <td width="10%" align="center" valign="top"
                                                style="border:1px solid #D1D1D1;background-color: #EFEFEF;padding:2px 0;">
                                                <b style="margin-left:4px;">
                                                    @if ($InvoiceDetails && $InvoiceDetails->final_total_amt)
                                                        {{ $Currency->prefix }} {{ $InvoiceDetails->final_total_amt }}
                                                    @endif
                                                    @if ($Currency && $Currency->code)
                                                        (
                                                        {{ $Currency->code }})
                                                    @endif
                                                </b>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                        <tr>
                                            <td align="left" valign="top" height="20"></td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top"><b>TRANSACTIONS</b></td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" height="20"></td>
                                        </tr>
                                        </tr>
                                    </tbody>
                                </table>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td width="25%" align="center" valign="top"
                                                style="border:1px solid #D1D1D1;background-color: #EFEFEF;padding:2px 0;">
                                                <b style="margin-right:4px;">Transaction Date</b> </td>
                                            <td width="25%" align="center" valign="top"
                                                style="border:1px solid #D1D1D1;background-color: #EFEFEF;padding:2px 0;">
                                                <b style="margin-right:4px;">Gateway</b> </td>
                                            <td width="25%" align="center" valign="top"
                                                style="border:1px solid #D1D1D1;background-color: #EFEFEF;padding:2px 0;">
                                                <b style="margin-right:4px;">Transaction ID</b></td>
                                            <td width="25%" align="center" valign="top"
                                                style="border:1px solid #D1D1D1;background-color: #EFEFEF;padding:2px 0;">
                                                <b style="margin-right:4px;">Amount</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            @if (!empty($transaction))
                                                <td width="25%" align="center" valign="top"
                                                    style="border:1px solid #D1D1D1;background-color: #FFFFFF;padding:2px 0;">
                                                    <span>{{ isset($transaction) ? date('Y-m-d', strtotime($transaction->created_at)) : '' }}</span>
                                                </td>
                                                <td width="25%" align="center" valign="top"
                                                    style="border:1px solid #D1D1D1;background-color: #FFFFFF;padding:2px 0;">
                                                    <span>{{ isset($transaction) ? $transaction->paymentMethod : '' }}</span>
                                                </td>
                                                <td width="25%" align="center" valign="top"
                                                    style="border:1px solid #D1D1D1;background-color: #FFFFFF;padding:2px 0;">
                                                    <span>{{ isset($transaction) ? $transaction->razorpay_payment_id : '' }}</span>
                                                </td>
                                                <td width="25%" align="center" valign="top"
                                                    style="border:1px solid #D1D1D1;background-color: #FFFFFF;padding:2px 0;">
                                                    <span>
                                                        {{ $InvoiceDetails->final_total_amt }}</span>
                                                </td>
                                            @else
                                                <td align="center" valign="top"
                                                    style="border:1px solid #D1D1D1;background-color: #FFFFFF;padding:2px 0;">
                                                    <span style="margin-right:4px;">No Related Transactions Found</span>
                                                </td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td width="75%" align="right" valign="top"
                                                style="border:1px solid #D1D1D1;background-color: #EFEFEF;padding:2px 0;">
                                                <b style="margin-right:4px;">Balance</b>
                                            </td>
                                            <td align="center" valign="top"
                                                style="border:1px solid #D1D1D1;background-color: #EFEFEF;padding:2px 0;">
                                                <b style="margin-right:4px;">
                                                    @if ($InvoiceDetails)
                                                         {{ $InvoiceDetails->final_total_amt }}
                                                        {{ $InvoiceDetails->code }}
                                                    @endif
                                                </b>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                        <tr>
                                            <td align="center" valign="top" height="100"></td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top" style="font-size: 11px;"><b>Note:</b><span>
                                                    The Company is registered under MSME Act, 2006 (Reg. No.
                                                    UDYAM-RJ-17-0062383) effective from 6th April 2021.</span></td>
                                        </tr>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="page-break" style="page-break-after:always;"><span
                                        style="display:none;"></span></div>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                        <tr>
                                            <td align="left" valign="top" height="20"></td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top"><b>TERMS & CONDITIONS</b></td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" height="10"></td>
                                        </tr>
                                        </tr>
                                    </tbody>
                                </table>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                        <tr>
                                            <td align="left" valign="top">
                                                <ul>

                                                    @php
                                                        $InvoiceSettings = App\Models\InvoiceSettings::where(
                                                            'id',
                                                            1,
                                                        )->first();
                                                    @endphp
                                                    <li>
                                                        @if ($InvoiceSettings)
                                                            {{ $InvoiceSettings->invoice_terms }}
                                                          
                                                        @endif
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" height="20"></td>
                                        </tr>
                                        </tr>
                                    </tbody>
                                </table>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                        <tr>
                                            <td align="left" valign="top" height="20"></td>
                                        </tr>
                                        <tr>
                                            <td align="right" valign="top">
                                                @if ($InvoiceSettings && $InvoiceSettings->autorised_sign)
                                                <img src="{{ $InvoiceSettings->autorised_sign }}"
                                                    style="width:160px;margin-right: 10px;">

                                                    @else
                                                    <img src="{{ url('public/images/image.png') }}"
                                                    style="width:60px;margin-right: 10px;">
                                                    @endif

                                                </td>
                                        </tr>
                                        <tr>
                                            <td align="right" valign="top"><span
                                                    style="color:rgb(167, 167, 167);">Digitally signed by</span></td>
                                        </tr>
                                        <tr>
                                            <td align="right" valign="top"><span
                                                    style="font-weight: 600;color:rgb(167, 167, 167);">Rajesh Mehla</span>
                                            </td>
                                        </tr>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
    </div>
</div>
</body>

<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
        calculateSum();

        function calculateSum() {
            var totalAmtSum = 0;
            // Iterate over each element with class 'total_amt'
            $('.total_amt').each(function() {
                var totalAmt = parseFloat($(this).text().replace(/[^0-9.-]+/g, ""));
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
    });
    $(document).ready(function() {
        var totalTax = 0;
        var totalAmount = 0;
        var is_payment_recieved = $('#is_payment_recieved').val();
        $('.Caltax').each(function() {
            var taxValue = parseFloat($(this).val());
            totalTax += taxValue;
        });

        $('.total_amt').each(function() {
            var totalText = $(this).text();
            var totalValue = parseFloat(totalText.replace(/[^\d.]/g, '')); // Extract the numeric part of the total text
            totalAmount += totalValue;
        });
        var totalTaxAmount = totalAmount * (totalTax / 100);
        var totalAmountNew = totalAmount + totalTaxAmount;
        $('.total_tax').text(totalTaxAmount.toFixed(2));
        $('.sub_total').text(totalAmount.toFixed(2));
        $('.total2').text(totalAmountNew.toFixed(2));
        if (is_payment_recieved == 0) {
            $('.totalDue').text(totalAmountNew.toFixed(2));
        } else {
            totalAmountNew = 0;
            $('.totalDue').text(totalAmountNew.toFixed(2));
        }
        $('#SubTotal').text(totalAmount.toFixed(2));
        $('#TotalTax').text(totalTax.toFixed(2));
    });
</script>

</html>