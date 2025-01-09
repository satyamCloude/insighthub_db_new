@extends('layouts.admin')
@section('title', 'Invoices')
@section('content')
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

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row invoice-preview">
                <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
                    <div class="card invoice-preview-card">
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
                                                            @endif
                                                      <br>
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
                                                        {{ $InvoiceDetails->gstin }}
                                                    @endif
                                                    </br>
                                                    </br>Place of supply : @if ($InvoiceDetails)
                                                        {{ $InvoiceDetails->address_1 }} {{ $InvoiceDetails->address_2 }}
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
                                    $taxTotals  = [];
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
                                            <td width="10%" align="left" valign="top"
                                                style="border:1px solid #D1D1D1;padding:2px 0;">
                                                <span style="margin-left:4px;">Qty</span>
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
                                                        @php
                                                        $quantity = $InvoiceDetails->orders->quantity ?? 1;
                                                        $prices=$InvoiceDetails->price;
                                                        $subTotal += $prices; 
                                                        @endphp
                                                        {{ number_format($prices, 2) }}
                                                        
                                                    @elseif($InvoiceDetails->amount)
                                                        @php
                                                        $quantity = $InvoiceDetails->orders->quantity ?? 1;
                                                        $prices=$InvoiceDetails->amount;
                                                        $subTotal += $prices; 
                                                        @endphp
                                                        {{ number_format($prices, 2) }}
                                                    @endif
                                                    @if ($Currency && $Currency->code)
                                                        ({{ $Currency->code }})
                                                    @endif
                                                </span>
                                            </td>
                                            
                                             <td width="10%" align="left" valign="top"
                                                style="border:1px solid #D1D1D1;padding:2px 0;">
                                                <span style="margin-left:4px;">
                                                    {{$InvoiceDetails->orders->quantity}}
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
                                                    <span>{{ $Currency->prefix }}
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
                                                        {{ $Currency->prefix }} {{ $InvoiceDetails->final_total_amt }}
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
                                                    <!-- <li>Payment shall be drawn in the favour of : CloudTechtiq Technologies
                                                        Private Ltd, Jaipur, Rajasthan.</li>
                                                    <li>Service termination shall be done automatically at the end of
                                                        service period unless renewed by client.</li>
                                                    <li>SLA at <a
                                                            href="https://www.cloudtechtiq.com/service-level-agreement">https://www.cloudtechtiq.com/service-level-agreement</a>
                                                    </li>
                                                    <li>Cloudtechtiq Technologies Pvt. Ltd. is not responsible or liable for
                                                        any data loss due to hardware failure or
                                                        any other reason. Although company will try at its level best to
                                                        help retrieve it's client's data (in the case of
                                                        hardware failure), but its responsibility is limited to provide with
                                                        an equivalent (replacement) service asap. If
                                                        any client has signed up for a backup plan with us, Cloudtechtiq
                                                        will help restoring the data subject to
                                                        availbility of restoration point at that time</li> -->
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

                <!-- Invoice Actions -->
                <div class="col-xl-3 col-md-4 col-12 invoice-actions">
                    <div class="card">
                        <div class="card-body">
                            <!-- <button class="btn btn-primary d-grid w-100 mb-2" data-bs-toggle="offcanvas"
                                data-bs-target="#sendInvoiceOffcanvas">
                                <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                        class="ti ti-send ti-xs me-2"></i>Send Invoice</span>
                            </button> -->
                            <a href="{{url('admin/Invoices/downloadPDF?id='.$InvoiceDetails->id)}}" class="btn btn-primary d-grid w-100 mb-2">Download</a>
                            <a class="btn btn-label-secondary d-grid w-100 mb-2" target="_blank" href="#"
                                onclick="window.print(); return false;">
                                Print
                            </a>
                            <a href="#" class="btn btn-primary d-grid w-100 auto_pay" data-id="{{$InvoiceDetails->id}}">
                                Pay Invoice
                            </a>
                           <!--  <button class="btn btn-primary d-grid w-100" data-bs-toggle="offcanvas"
                                data-bs-target="#addPaymentOffcanvas">
                                <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                        class="ti ti-currency-dollar ti-xs me-2"></i>Add Payment</span>
                            </button> -->
                        </div>
                    </div>
                </div>
                <!-- /Invoice Actions -->
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

                <span id="errorMsg"></span>

                <input type="hidden" id="invoiceId">

                <div class="mb-3">

                    <label for="selectBox" class="form-label">Payment Method</label>

                    <select class="form-select" id="selectBox">

                        <option value="0">Select</option>

                        <option value="1">Razorpay</option>

                        <option value="2">PayPal</option>

                    </select>

                </div>

                

                <div class="mb-3">

                    <label for="paymentDate" class="form-label">Transaction Date</label>

                    <input type="date" class="form-control" id="transaction_date">

                </div>

                <div class="mb-3">

                    <label for="paymentDate" class="form-label">Transaction ID</label>

                    <input type="text" class="form-control" id="transaction_id">

                    <input type="hidden" class="form-control" id="invoiceIds">

                </div>

                <div class="mb-3">

                    <label for="tdsPercent" class="form-label">TDS Percent</label>

                    <input type="number" class="form-control" id="tdsPercent">

                </div>

                <div class="mb-3 form-check">

                    <input type="checkbox" class="form-check-input" id="showPaymentAmount">

                    <label class="form-check-label" for="showPaymentAmount">Full Payment</label>

                </div>

                <div class="mb-3" id="paymentAmountContainer" >

                    <label for="paymentAmount" class="form-label">Payment Amount</label>

                    <input type="number" class="form-control" id="paymentAmount">

                    <input type="hidden" class="form-control" id="paymentAmounthidden">

                </div>



                <div class="mb-3" id="paymentAmountContainer" >

                    <input type="checkbox" class="form-check-input" id="confrm_mail">

                    <label class="form-check-label" for="showPaymentAmount">Send Confirmation Mail</label>

                </div>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                <button type="button"  id="paymentFormSubmit" class="btn btn-primary">Save changes</button>

            </div>

        </div>

    </div>

</div>


    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>


    $('.auto_pay').click(function() {

        var invoiceId = "{{$InvoiceDetails->id}}";

        var paymentAmount = parseFloat("{{$InvoiceDetails->final_total_amt}}"); // Convert amount to dollars

        $('#invoiceId').val(invoiceId);

        $('#paymentAmounthidden').val(paymentAmount.toFixed(2)); // Format to 2 decimal places

        $('#paymentAmount').val(''); // Clear the payment amount input initially

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



    $('#paymentFormSubmit').click(function() {

        var invoiceId = $('#invoiceId').val();

        var paymentMethod = $('#selectBox').val();

        var transactionDate = $('#transaction_date').val();

        var transactionId = $('#transaction_id').val();

        var tdsPercent = $('#tdsPercent').val();

        var showPaymentAmount = $('#showPaymentAmount').val();

        var confrm_mail = $('#confrm_mail').val();

        var paymentAmount = $('#paymentAmount').val();

         $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

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

                fullPaymentStatus: showPaymentAmount

            },

            success: function(response) {

                // Handle success response

                console.log(response);

                $('#paymentModal').modal('hide'); // Hide the modal on success

                //  setTimeout(function() {

                //     location.reload();

                // }, 2000);

            },

            error: function(xhr, status, error) {

                // Handle error

                console.error(xhr.responseText);

                // Show error message

                $('#errorMsg').text("An error occurred. Please try again."); // Assuming you have an element with id 'errorMsg' to display the error message

            }

        });

    });


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
                var totalValue = parseFloat(totalText.replace(/[^\d.]/g,
                '')); // Extract the numeric part of the total text
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


@endsection
