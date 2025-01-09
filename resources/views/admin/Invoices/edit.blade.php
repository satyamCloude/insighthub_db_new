@extends('layouts.admin')
@section('title', 'Invoices')
@section('content')
<style>
  @media (max-width: 767.98px) {
    .c-inv-desc-table table tr {
      display: block;
      flex-direction: column;
      float: left;
      width: 50%;
    }


    .c-inv-desc-table table tr .inv-desc-mbl {
      height: 140px;
    }

    .c-inv-desc-table table td {
      border: 1px solid #e7e9eb !important;
      display: block;
      flex: 1 1 auto;
      height: 70px;
      width: 100%;
    }


    .c-inv-desc-table table tr {
      display: block;
      flex-direction: column;
      float: left;
      width: 50%;
    }

    .c-inv-desc-table table td {
      border: 1px solid #e7e9eb !important;
      display: block;
      flex: 1 1 auto;
      height: 70px;
      width: 100%;
    }

    .c-inv-desc-table input.quantity {
      margin-top: 0 !important;
    }

    .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
      width: 100% !important;
    }

    .c-inv-desc-table a {
      justify-content: flex-end !important;
      margin-top: 10px;
    }

  }


  .dropify-wrapper.touch-fallback .dropify-message {
    padding: 40px 0;
    transform: translate(0);
  }

  .dropify-wrapper .dropify-message {
    position: relative;
    padding: 40px 0;
    top: 50%;
    transform: translateY(-50%);
  }

  .c-inv-total table tr td {
    border: 1px solid #e8eef3;
    padding: 11px 10px;
  }

  .text-dark-grey {
    color: #616e80;
  }

  .mw-250 {
    max-width: 250px;
    min-width: 140px;
  }

  table {
    border-collapse: separate !important;
    border-spacing: inherit;
  }

  .c-inv-total table tr td .c-inv-sub-padding {
    padding: 5px 10px;
  }

  .height-35 {
    height: 39px !important;
  }

  .rounded {
    border-radius: 0.25rem !important;
  }

  .bootstrap-select:not(.input-group-btn),
  .bootstrap-select[class*=col-] {
    display: inline-block;
    float: none;
    margin-left: 0;
  }

  .custom-file-input-container {
    position: relative;
    overflow: hidden;
    cursor: pointer;
    width: 150px;
    /* Adjust the width as needed */
    height: 40px;
    /* Adjust the height as needed */
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  .custom-file-input {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    background-color: #f8f9fa;
    /* Background color when not hovered or clicked */
    padding: 10px;
  }

  .custom-file-input:hover {
    background-color: #e9ecef;
    /* Background color on hover */
  }

  #selectedFileName {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
  }

  /* Style for file input button */
  .form-control {
    margin-top: 10px;
  }


  .bootstrap-select>select {
    border: none;
    bottom: 0;
    display: block !important;
    height: 100% !important;
    left: 50%;
    opacity: 0 !important;
    padding: 0 !important;
    position: absolute !important;
    width: 0.5px !important;
    z-index: 0 !important;
  }

  .bootstrap-select>.dropdown-toggle {
    align-items: center;
    display: inline-flex;
    justify-content: space-between;
    position: relative;
    text-align: right;
    white-space: nowrap;
    width: 100%;
  }

  .dropdown-menu {
    background-clip: padding-box;
    background-color: #fff;
    border: 1px solid rgba(0, 0, 0, .15);
    border-radius: 0.25rem;
    color: #212529;
    display: none;
    float: left;
    font-size: 1rem;
    left: 0;
    list-style: none;
    margin: 0.125rem 0 0;
    min-width: 10rem;
    padding: 0.5rem 0;
    position: absolute;
    text-align: left;
    top: 100%;
    z-index: 1000;
  }

  .bootstrap-select .dropdown-toggle .filter-option {
    flex: 0 1 auto;
    float: left;
    height: 100%;
    left: 0;
    overflow: hidden;
    position: static;
    text-align: left;
    top: 0;
    width: 100%;
  }
cv
  .bootstrap-select .dropdown-toggle:after,
  .bootstrap-select .dropup .dropdown-toggle:after {
    border-left: 0.3em solid transparent;
    border-right: 0.3em solid transparent;
    content: "";
    display: inline-block;
    height: 0;
    margin-left: 0.255em;
    vertical-align: 0.255em;
    width: 0;
  }

  .dropify-wrapper {
    border: 1px solid #e8eef3;
    border-radius: 0.25rem;
    z-index: 0;
  }

  .dropify-wrapper {
    background-color: #fff;
    background-image: none;
    border: 2px solid #e5e5e5;
    color: #777;
    cursor: pointer;
    display: block;
    font-family: Roboto, Helvetica Neue, Helvetica, Arial;
    font-size: 14px;
    height: 200px;
    line-height: 22px;
    max-width: 100%;
    overflow: hidden;
    padding: 5px 10px;
    position: relative;
    text-align: center;
    transition: border-color .15s linear;
    width: 100%;
  }

  .dropify-wrapper .dropify-message {
    position: relative;
    top: 50%;
    transform: translateY(-50%);
  }

  .dropify-wrapper .dropify-loader {
    display: none;
    position: absolute;
    right: 15px;
    top: 15px;
    z-index: 9;
  }

  .dropify-wrapper .dropify-errors-container {
    background: rgba(243, 65, 65, .8);
    bottom: 0;
    left: 0;
    opacity: 0;
    position: absolute;
    right: 0;
    text-align: left;
    top: 0;
    transition: visibility 0s linear .15s, opacity .15s linear;
    visibility: hidden;
    z-index: 3;
  }

  .dropify-wrapper input {
    bottom: 0;
    cursor: pointer;
    height: 100%;
    left: 0;
    opacity: 0;
    position: absolute;
    right: 0;
    top: 0;
    width: 100%;
    z-index: 5;

  }

  .dropify-wrapper .dropify-clear {
    background: none;
    border: 2px solid #fff;
    color: #fff;
    display: none;
    font-family: Roboto, Helvetica Neue, Helvetica, Arial;
    font-size: 11px;
    font-weight: 700;
    opacity: 0;
    padding: 4px 8px;
    position: absolute;
    right: 10px;
    text-transform: uppercase;
    top: 10px;
    transition: all .15s linear;
    z-index: 7;
  }

  .dropify-wrapper .dropify-preview {
    background-color: #fff;
    bottom: 0;
    display: none;
    height: 100%;
    left: 0;
    overflow: hidden;
    padding: 5px;
    position: absolute;
    right: 0;
    text-align: center;
    top: 0;
    width: 100%;
    z-index: 1;
  }

  .bg-amt-grey {
    background-color: #e7e9eb;
  }

  .btrr-bbrr {
    border-bottom-right-radius: 4px;
    border-top-right-radius: 4px;
  }

  .bootstrap-select>.dropdown-toggle {
    align-items: center;
    display: inline-flex;
    justify-content: space-between;
    position: relative;
    text-align: right;
    white-space: nowrap;
    width: 100%;
  }

  .bootstrap-select>.dropdown-toggle,
  .input-group .bootstrap-select.form-control .dropdown-toggle {
    background-color: #fff;
    border-color: #e8eef3;
    font-size: 14px;
    padding: 0.5rem;
  }

  .bootstrap-select .dropdown-toggle:after,
  .bootstrap-select .dropup .dropdown-toggle:after {
    border-left: 0.3em solid transparent;
    border-right: 0.3em solid transparent;
    content: "";
    display: inline-block;
    height: 0;
    margin-left: 0.255em;
    vertical-align: 0.255em;
    width: 0;
  }

  .dropify-font-upload:before,
  .dropify-wrapper .dropify-message span.file-icon:before {
    content: "\e800";
  }

  .dropify-font:before,
  .dropify-wrapper .dropify-message span.file-icon:before,
  [class*=" dropify-font-"]:before,
  [class^=dropify-font-]:before {
    speak: none;
    display: inline-block;
    font-family: dropify;
    font-style: normal;
    font-variant: normal;
    font-weight: 400;
    line-height: 1em;
    margin-left: 0.2em;
    margin-right: 0.2em;
    text-align: center;
    text-decoration: inherit;
    text-transform: none;
    width: 1em;
  }

  .dropify-wrapper .dropify-message p {
    margin: 5px 0 0;
  }


  select.form-control[multiple],
  select.form-control[size],
  textarea.form-control {
    height: auto;
  }

  .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
    width: 220px;
  }


  .f-14 {
    font-size: 14px !important;
  }


  .text-dark-grey {
    color: #616e80;
  }

  .font-weight-bold {
    font-weight: 700 !important;
  }

  .c-inv-desc table tr td {
    border: 1px solid #e7e9eb;
    padding: 0px 10px;
  }

  .btlr {
    border-top-left-radius: 4px;
  }

  .c-inv-desc-table .cost_per_item,
  .c-inv-desc-table .item_name,
  .c-inv-desc-table .quantity,
  .hsn_sac_code {
    border: 1px solid #e7e9eb !important;
    border-radius: 0.25rem !important;
    padding: 0.5rem !important;
  }

  .form-control {
    background-color: #fff;
    border: 1px solid #e8eef3;
    border-radius: 0.25rem;
    box-shadow: none;
    color: #28313c;
    font-weight: 400;
    height: auto;
    padding: 0 6px;
    position: relative;
    transition: all .3s ease;
  }

  .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
    width: 220px;
  }

  .bootstrap-select:not(.input-group-btn),
  .bootstrap-select[class*=col-] {
    display: inline-block;
    float: none;
    margin-left: 0;
  }

  .bootstrap-select>select {
    border: none;
    bottom: 0;
    display: block !important;
    height: 100% !important;
    left: 50%;
    opacity: 0 !important;
    padding: 0 !important;
    position: absolute !important;
    width: 0.5px !important;
    z-index: 0 !important;
  }

  .show>.btn-light.dropdown-toggle {
    background-color: #dae0e5;
    border-color: #d3d9df;
    color: #212529;
  }

  .bootstrap-select>.dropdown-toggle.bs-placeholder,
  .bootstrap-select>.dropdown-toggle.bs-placeholder:active,
  .bootstrap-select>.dropdown-toggle.bs-placeholder:focus,
  .bootstrap-select>.dropdown-toggle.bs-placeholder:hover {
    color: #999;
  }

  .bootstrap-select .dropdown-toggle .filter-option {
    flex: 0 1 auto;
    float: left;
    height: 100%;
    left: 0;
    overflow: hidden;
    position: static;
    text-align: left;
    top: 0;
    width: 100%;
  }

  .bootstrap-select .dropdown-toggle .filter-option-inner-inner {
    overflow: hidden;
  }

  .bootstrap-select .dropdown-toggle:after,
  .bootstrap-select .dropup .dropdown-toggle:after {
    border-left: 0.3em solid transparent;
    border-right: 0.3em solid transparent;
    content: "";
    display: inline-block;
    height: 0;
    margin-left: 0.255em;
    vertical-align: 0.255em;
    width: 0;
  }

  .bootstrap-select .dropdown-menu {
    box-sizing: border-box;
    min-width: 100%;
  }

  .w-30 {
    width: 30%;
  }

  .w-70 {
    width: 70%;
  }

  .height-35 {
    height: 39px !important;
  }

  .height-40 {
    height: 40px !important;
  }

  .height-44 {
    height: 44px !important;
  }

  .height-50 {
    height: 50px !important;
  }

  .px-6 {
    padding-left: 6px !important;
    padding-right: 6px !important;
  }

  .p-20 {
    padding: 20px !important;
  }

  .pl-20 {
    padding-left: 20px !important;
  }

  .py-20 {
    padding-left: 20px !important;
    padding-right: 20px !important;
  }

  .mt-94 {
    margin-top: 94px;
  }

  .mt-105 {
    margin-top: 105px;


  }

  .mb-12 {
    margin-bottom: 12px;
  }

  .mb-20 {
    margin-bottom: 20px;
  }

  .mr-30 {
    margin-right: 30px;
  }

  .b-shadow-4 {
    box-shadow: 0 0 4px 0 #e8eef3;
  }

  .b-r-8 {
    border-radius: 8px !important;
  }

  .d-grid {
    display: grid;
  }



  .dropbtn {
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    background-color: #fff;
    border: 1px solid #dbdade;
    border-radius: 0.375rem;
    border-color: #C9C8CE !important;
    height: 40px;
    width: 100%;
    text-align: left;
    color: #6f6b7d;
    font-weight: 500;
    font-size: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  }

  .dropdown {
    position: relative;
    display: inline-block;
  }

  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 100%;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
    max-height: 350px;
    overflow-x: scroll;
  }

  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }

  .dropdown-content a:hover {
    background-color: #f1f1f1
  }

  .dropdown:hover .dropdown-content {
    display: block;
  }

  .dropdown:hover .dropbtn {
    background-color: white;
  }


  .outer:hover {

    background-color: #685dd8 !important;
    color: white !important;

  }


  .outer {


    background-color: rgba(15, 103, 240, 0.08);
    color: #7367f0;

    border-radius: 10px;



  }

  .c-inv-total td{
    text-align: right;
  }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Invoices /</span> Add</h4>
  <!-- Sticky Actions -->
  <div class="row">
    <div class="col-12">
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
      @endif
      <div class="card">
        <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
          <h5 class="card-title mb-sm-0 me-2">Edit Detail's</h5>
          <div class="action-btns">
            <a href="{{url('admin/Invoices/home')}}" class="btn btn-label-primary me-3">
              <span class="align-middle"> Back</span>
            </a>
          </div>
        </div>
          <form action="{{url('admin/Invoices/update/'.$id)}}" method="post" enctype="multipart/form-data"> 
          @csrf
           @csrf
          <div class="card-body">
            <h5 class="mb-4">1. Invoice Details</h5>
            <div class="row mb-4">
              <div class="col-md-3">
                <label for="product_name" class="form-label">Invoice Number<span class="text-danger">*</span></label>

                <div class="input-group">
                  <div class="input-group-prepend">
                    <input type="text" name="invoice_number1" id="invoice_number1" value="INV#" class="form-control height-35 f-15" readonly>
                    <input type="hidden" name="selectedOrderID" id="selectedOrderID" value="@if($selected_order_id) {{$selected_order_id}} @else 0 @endif" class="form-control height-35 f-15" readonly>
                  </div>
                  <input type="number" name="invoice_number2" id="invoice_number2" class="form-control height-35 f-15" required autocomplete="off" value="{{$Inventory->invoice_number2}}" readonly>
                </div>
                <span class="text-danger showinvoice_err"></span>

              </div>

              <div class="col-md-2">
                <label for="product_code" class="form-label">Invoice Date<span class="text-danger">*</span></label>
                <input type="date" class="form-control startDate height-35 f-15" name="issue_date"  value="{{$Inventory->issue_date}}"  required />
              </div>

              <div class="col-md-2">
                <label for="product_code" class="form-label">Due Date<span class="text-danger">*</span></label>
                <input type="date" class="form-control endDate height-35 f-15" name="due_date"  value="{{$Inventory->due_date}}" required />
              </div>
              <div class="col-md-4" style="margin-top: 9px; width: 432.014px;">
                  <label for="purchase_date" class="form-label">Currency<span class="text-danger">*</span></label>
                  <select class="form-control select2 height-35 f-15" name="currency" id="currencies">
                      @foreach($currencies as $currency)
                      <option value="{{ $currency->id }}" @if($Inventory->currency == $currency->id) selected @endif>
                          {{ $currency->code }} ({{ $currency->prefix }})
                      </option>
                      @endforeach
                  </select>
              </div>
                <input type="hidden" id="exchange_rate" name="exchange_rate" class="form-control height-45 f-15" value="1" readonly="" autocomplete="off">
            </div>
            <hr />
            <div class="row mb-4">
                    
                       <div class="col-md-4 customer_name">
                        <label for="client_id" class="form-label">Client <span class="text-danger">*</span></label>
                        <div class="dropdown">
                            @php
                            // Use the `firstWhere` collection method to find the first client matching the Ticket's client_id
                            $client = collect($Client)->firstWhere('id', $Inventory->client_id);
                    
                            // Use null coalescence operator to handle the case when $client is null
                            $first_name = $client->first_name ?? 'Select Client';
                            $last_name = $client->last_name ?? '';
                            $id = $client->id ?? '';
                            $profile_img = $client->profile_img ?? '';
                            @endphp
                            <button class="dropbtn" style="justify-content:space-between;margin-right:3%" type="button">
                                <div>
                                    <img src="{{ $profile_img ? $profile_img : url('/') . '/public/images/profile_Ri1o.jpeg' }}" alt="" id="selected_client_img" class="rounded-circle avatar-xs" style="display:{{ $profile_img ? 'inline' : 'none' }};">
                                    <span id="selected_client_btn">{{ $first_name }} {{ $last_name }} ({{ $id }})</span>
                                </div>
                                <div>
                                    <i class="fa fa-angle-down" style="font-size:24px"></i>
                                </div>
                            </button>
                            <div class="dropdown-content" style="max-height: 45vh; overflow: auto;">
                                @foreach($Client as $client)
                                <div class="outer" id="client_{{ $client->id }}" style="display:flex;margin:6px;padding:4px;color:black;" onclick="selectClient('{{ $client->id }}', '{{ $client->profile_img }}', '{{ $client->first_name }} {{ $client->last_name }} (#{{ $client->id }})')">
                                    <div style="border-radius:50%;">
                                        @if($client->profile_img)
                                        <img src="{{ $client->profile_img }}" style="width:45px; border-radius:50%; height:auto;">
                                        @else
                                        <img src="{{url('/')}}/public/images/profile_Ri1o.jpeg" style="width:45px; border-radius:50%; height:auto;">
                                        @endif
                                    </div>
                                    <div class="sie_cont" style="display:flex; flex-direction:column; margin:5px;">
                                        <span>{{ $client->first_name }} {{ $client->last_name }} (#{{ $client->id }}) <br>{{ $client->company_name }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <input type="hidden" name="client_id" id="set_client_id" value="{{ $id }}">
                    </div>


                       <div class="col-md-4">
                <label for="project_id" class="form-label">Project <span class="text-danger">*</span></label>
                <select class="form-control select2" name="project_id" onchange="getProjectDetails(this.value)" required>
                    <option value="0">Select Project</option>
                    @foreach($Project as $project)
                        <option value="{{ $project->id }}"  @if($Inventory->project_id == $project->id) selected @endif>
                            {{ $project->project_name }}
                        </option>
                    @endforeach
                </select>
            </div>

                     <div class="col-md-4">
            <label for="warranty_expiry" class="form-label">Calculate Tax<span class="text-danger">*</span></label>
            <select class="form-control select2" name="calc_tax" id="when_calc_tax" required onchange="CalculateTax()">
                <option value="0" @if($Inventory->calc_tax == 0) selected @endif>Before Discount</option>
                <option value="1"@if($Inventory->calc_tax == 1) selected @endif>After Discount</option>
            </select>
        </div>

            </div>
           <div class="row mb-4">
    <div class="col-md-3">
        <label for="base_amount" class="form-label">Payment Method <span class="text-danger">*</span></label>
        <select class="form-control select2" name="bank_account" required>
            <option value="1"  @if($Inventory->bank_account == 1) selected @endif>Paypal Basics</option>
            <option value="2"  @if($Inventory->bank_account == 2) selected @endif>Bank Transfer</option>
            <option value="3"  @if($Inventory->bank_account == 3) selected @endif>Debit/Credit Card</option>
        </select>
    </div>
</div>

        <div class="row mb-4">
            <div class="col-md-4">
                <label for="assigned_to_id" class="form-label">Billing Address</label><br>
                <textarea class="form-control m-0" name="billing_address" readonly style="resize:none">{{ $billing_address->address_1 }}</textarea>
            </div>

              <div class="col-md-4">
                <label for="assigned_to_id" class="form-label">Shipping Address</label><br>
                <textarea class="form-control m-0" name="shipping_address" id="shipping_address"></textarea>

              </div>
              <div class="col-md-4">
                <label for="assigned_to_id" class="form-label">Generated By</label>
                <textarea class="form-control m-0" name="generated_by" id="generated_by" value="1"  style="resize:none" readonly>{{ $billing_address->company_name }}</textarea>
                
              
              </div>
            </div>
            <hr />

            <div class="row mb-4">
              <div class="col-md-4">
               
                
                <div class="dropdown">
                  <button class="dropbtn" type="button" type="button">
                    <div >
                      <span id="selected_service_img"></span> 
                      <span id="selected_service_btn">Select</span>
                    </div> 
                    <div >
                      <i class="fa fa-angle-down" style="font-size:24px"></i>
                    </div> 
                  </button>
                  <div class="dropdown-content">
                    @foreach($Services as $category)
                    <div class="outer" id="service_{{ $category->id }}" style="display:flex;margin:6px;padding:4px;color:black;" 
                    onclick="getProduct1('{{ $category->id }}','{{ $category->faIcon}}')">
                         <span class="mt-2" >{!!$category->faIcon!!}</span>
                      <div class="sie_cont" style="display:flex;flex-direction:column;margin:5px;">
                        <span>{{ $category->category_name }}</span>
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
                <input type="hidden" name="services_id[]" id="set_service_id">
              </div>

              <div class="col-md-4" id="get_service_orderss">
                <select class="form-control select2" name="services_id[]" onChange="getProductDetailWithFullData(this.value)" required id="services">
                  <option>Select Product</option>
                  @foreach($ProductNews as $product)
                  <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="content-wrapper">
              <div class="c-inv-desc-table item-row mt-4 w-100 d-lg-flex d-md-flex d-block">
                  <table width="100%">
                    <tbody>
                      <tr class="text-dark-grey font-weight-bold f-14">
                        <td width="50%" class="border-0 inv-desc-mbl btlr">Description</td>
                        <td width="10%" class="border-0" align="right">
                          Quantity </td>
                        <td width="10%" class="border-0" align="right">
                          Unit Price </td>
                        <td width="13%" class="border-0" align="right">Tax </td>
                        <td width="17%" class="border-0 bblr-mbl" align="right">
                          Amount</td>
                      </tr>
                      <tr>
                        <td class="border-bottom-0 btrr-mbl btlr">
                          <input type="text" class="form-control f-14 border-0 w-100 item_name" id="item_name" name="item_name[]" placeholder="Item Name" autocomplete="off" value="{{isset($productDetails) ? $productDetails->product_name : ''}}">
                
                          <input type="hidden" name="product_id[]" value="{{$productDetails->proId}}" autocomplete="off">
                        </td>
                        <td class="border-bottom-0 d-block d-lg-none d-md-none">
                          <textarea class="form-control f-14 border-0 w-100 mobile-description form-control item_summary" id="item_summary" name="item_summary" placeholder="Enter Description (optional)">{{isset($productDetails) ? $productDetails->description : ''}}</textarea>
                        </td>
                       <td class="border-bottom-0">
                        <input type="number" min="1" class="form-control f-14 border-0 w-100 text-right qty quantity mt-3" value="@if($Inventory && $Inventory->quantity){{$Inventory->quantity}}@else 1 @endif" name="quantity[]" autocomplete="off" id="qty{{$numberCount}}" sectionCount="{{$numberCount}}">
                        <select class="text-dark-grey float-right border-0 f-12" name="unit_id">
                            <option selected="" value="1">Pcs</option>
                        </select>
                    </td>
                    
                    <td class="border-bottom-0">
                        <input type="number" min="1" class="f-14 border-0 w-100 text-right cost_per_item form-control" value="{{$productDetails ? $productDetails->price : '0.00' }}" name="cost_per_items[]" autocomplete="off" id="cost_per_item{{$numberCount}}" sectionCount="{{$numberCount}}" readonly required>
                    </td>
                    
                    <td class="border-bottom-0">
                        <div class="select-others height-35 rounded border-0">
                            <div class="dropdown bootstrap-select show-tick select-picker type customSequence border-0">
                                <select id="multiselect1" name="taxes{{$numberCount}}[]" multiple="multiple" onchange="CalculateTax()" class="select-picker type customSequence border-0 multiselect" data-size="3">
                                    @foreach($Tax as $Taxs)
                                    <option data-rate="{{ $Taxs->tax_name }}" data-product-id{{$numberCount}}="{{$numberCount}}" data-tax-value="{{ $Taxs->rate }}" data-tax{{$numberCount}}="{{ $Taxs->tax_name . ':' . $Taxs->rate }}" value="{{$Taxs->id}}" @if($Taxs->id == $productDetails->taxId) selected @endif>{{ $Taxs->tax_name . ':' . $Taxs->rate }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="applied_tax[]" id="applied_tax{{$numberCount}}">
                                <div class="dropdown-menu">
                                    <div class="inner show" role="listbox" id="bs-select-9" tabindex="-1" aria-multiselectable="true">
                                        <ul class="dropdown-menu inner show" role="presentation"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>

                        
                      <td rowspan="2" align="right" valign="top" class="bg-amt-grey btrr-bbrr">
                            @php
                                $price = isset($productDetails) ? $productDetails->price : 0;
                                if (isset($Inventory->quantity) && $Inventory->quantity) {
                                    $totalPrice = $Inventory->quantity * $price;
                                } else {
                                    $totalPrice = $price;
                                }
                            @endphp
                            <span class="amount-html" id="total-amt{{$numberCount}}">{{ str_replace(',','',number_format($totalPrice, 2)) }}</span>
                            <input type="hidden" id="total_tax{{$numberCount}}">
                        </td>
                        
                      </tr>
                      <tr class="d-none d-md-table-row d-lg-table-row">
                        <td colspan="3" class="dash-border-top bblr border-right-0">
                          <textarea class="f-14 border p-3 px-1 rounded w-100 desktop-description form-control item_summary" id="item_summary" name="item_summary" placeholder="Enter Description (optional)" style="margin:unset; border: unset!important;box-shadow: unset !important;height: 120px;">{{isset($productDetails) ? strip_tags($productDetails->description) : ''}}</textarea>
                        </td>
                        <td class="border-left-0">
                          <div class="dropify-wrapper" style="height: 81.6px;" id="show_img1">
                            <div class="dropify-message"><span class=""><img id="show_imgs1" src="{{ url('public/images/cloud.png') }}" style="width: 54px;
                              margin-top: 25px;
                              "></span>
                              <p>Choose a file</p>
                              <p class="dropify-error">Some error occurred.</p>
                            </div>
                            <div class="dropify-loader"></div>
                            <div class="dropify-errors-container">
                              <ul></ul>
                            </div>
                            <input type="file" class="dropify" id="upload_imag1" name="invoice_item_image[]" data-allowed-file-extensions="png jpg jpeg bmp" sectionCount="1" data-messages-default="test" data-height="70" autocomplete="off">
                            <button type="button" class="dropify-clear" id="remove_button1">Remove</button>
                
                            <div class="dropify-preview" id="show_imag1"><span class="dropify-render"></span>
                              <div class="dropify-infos">
                                <div class="dropify-infos-inner">
                                  <p class="dropify-filename"><span class="dropify-filename-inner"></span></p>
                                  <p class="dropify-infos-message">Drop a file or click to replace</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <a href="javascript:;" class="d-flex align-items-center justify-content-center ml-3 remove-item"
                          onclick="removeSection(this)"><i class="fa fa-times-circle f-20 text-lightest"></i></a> 
                           &nbsp;&nbsp;&nbsp;
              </div>
              <hr class="m-0 border-top-grey mt-4">
              @if($addonOrders)
                @foreach($addonOrders as $key => $addons)
                <div class="c-inv-desc-table item-row mt-4 w-100 d-lg-flex d-md-flex d-block">
                              <table width="100%">
                                <tbody>
                                  <tr class="text-dark-grey font-weight-bold f-14">
                                    <td width="50%" class="border-0 inv-desc-mbl btlr">Description</td>
                                    <td width="10%" class="border-0" align="right">
                                      Quantity </td>
                                    <td width="10%" class="border-0" align="right">
                                      Unit Price </td>
                                    <td width="13%" class="border-0" align="right">Tax </td>
                                    <td width="17%" class="border-0 bblr-mbl" align="right">
                                      Amount</td>
                                  </tr>
                                  <tr>
                                    <td class="border-bottom-0 btrr-mbl btlr">
                                      <input type="text" class="form-control f-14 border-0 w-100 item_name" id="item_name" name="item_name[]" placeholder="Item Name" autocomplete="off" value="{{isset($addons) ? $addons->product_name : ''}}">
                            
                                      <input type="hidden" name="product_id[]" value="{{$addons->product_id}}" autocomplete="off">
                                    </td>
                                    <td class="border-bottom-0 d-block d-lg-none d-md-none">
                                      <textarea class="form-control f-14 border-0 w-100 mobile-description form-control item_summary" id="item_summary" name="item_summary" placeholder="Enter Description (optional)">{{isset($addons) ? $addons->description : ''}}</textarea>
                                    </td>
                                    <td class="border-bottom-0">
                                      <input type="number" min="1" class="form-control f-14 border-0 w-100 text-right qty quantity mt-3" value="@if($addons && $addons->quantity){{$addons->quantity}}@else 1 @endif" name="quantity[]" autocomplete="off" id="qty{{$numberCount}}" sectionCount="{{$numberCount}}">
                                      <select class="text-dark-grey float-right border-0 f-12" name="unit_id">
                                        <option selected="" value="1">Pcs</option>
                                      </select>
                            
                                    </td>
                                    <td class="border-bottom-0">
                                      <input type="number" min="1" class="f-14 border-0 w-100 text-right cost_per_item form-control" value="{{$addons ? $addons->price : '0.00' }}" name="cost_per_items[]" autocomplete="off" id="cost_per_item{{$numberCount}}" sectionCount="{{$numberCount}}" readonly required>
                                    </td>
                                    <script>
                                      $(document).ready(function() {
                                   
                                    $("#multiselect{{$key+2}}").selectpicker();
                                      });
                                    </script>
                                    
                                    <td class="border-bottom-0">
                                    <div class="select-others height-35 rounded border-0">
                                        <div class="dropdown bootstrap-select show-tick select-picker type customSequence border-0">
                                            <select id="multiselect{{$key+2}}" name="taxes{{$numberCount}}[]" multiple="multiple" onchange="CalculateTax()" class="select-picker type customSequence border-0 multiselect" data-size="3">
                                                @foreach($Tax as $Taxs)
                                                <option data-rate="{{ $Taxs->tax_name }}" data-product-id{{$numberCount}}="{{$numberCount}}" data-tax-value="{{ $Taxs->rate }}" data-tax{{$numberCount}}="{{ $Taxs->tax_name . ':' . $Taxs->rate }}" value="{{$Taxs->id}}" 
                                                  @if($addons->tax == $Taxs->id) selected @endif>{{ $Taxs->tax_name . ':' . $Taxs->rate }}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="applied_tax[]" id="applied_tax{{$numberCount}}">
                                            <div class="dropdown-menu">
                                                <div class="inner show" role="listbox" id="bs-select-9" tabindex="-1" aria-multiselectable="true">
                                                    <ul class="dropdown-menu inner show" role="presentation"></ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                  <td rowspan="2" align="right" valign="top" class="bg-amt-grey btrr-bbrr">
                                    @php
                                        $price = isset($addons) ? $addons->price : 0;
                                        if (isset($addons->quantity) && $addons->quantity) {
                                            $totalPrice = $addons->quantity * $price;
                                        } else {
                                            $totalPrice = $price;
                                        }
                                    @endphp
                                    <span class="amount-html" id="total-amt{{$numberCount}}">{{ str_replace(',','',number_format($totalPrice, 2)) }}</span>
                                    <input type="hidden" id="total_tax{{$numberCount}}">
                                </td>


                                  </tr>
                                  <tr class="d-none d-md-table-row d-lg-table-row">
                                    <td colspan="3" class="dash-border-top bblr border-right-0">
                                      <textarea class="f-14 border p-3 px-1 rounded w-100 desktop-description form-control item_summary" id="item_summary" name="item_summary" placeholder="Enter Description (optional)" style="margin:unset; border: unset!important;box-shadow: unset !important;height: 120px;">{{isset($addons) ? strip_tags($addons->description) : ''}}</textarea>
                                    </td>
                                    <td class="border-left-0">
                                      <div class="dropify-wrapper" style="height: 81.6px;" id="show_img1">
                                        <div class="dropify-message"><span class=""><img id="show_imgs1" src="{{ url('public/images/cloud.png') }}" style="width: 54px;
                                          margin-top: 25px;
                                          "></span>
                                          <p>Choose a file</p>
                                          <p class="dropify-error">Some error occurred.</p>
                                        </div>
                                        <div class="dropify-loader"></div>
                                        <div class="dropify-errors-container">
                                          <ul></ul>
                                        </div>
                                        <input type="file" class="dropify" id="upload_imag1" name="invoice_item_image[]" data-allowed-file-extensions="png jpg jpeg bmp" sectionCount="1" data-messages-default="test" data-height="70" autocomplete="off">
                                        <button type="button" class="dropify-clear" id="remove_button1">Remove</button>
                            
                                        <div class="dropify-preview" id="show_imag1"><span class="dropify-render"></span>
                                          <div class="dropify-infos">
                                            <div class="dropify-infos-inner">
                                              <p class="dropify-filename"><span class="dropify-filename-inner"></span></p>
                                              <p class="dropify-infos-message">Drop a file or click to replace</p>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                          <a href="javascript:;" class="d-flex align-items-center justify-content-center ml-3 remove-item"
                          onclick="removeSection(this)"><i class="fa fa-times-circle f-20 text-lightest"></i></a> 
                           &nbsp;&nbsp;&nbsp;
                </div>
                <hr class="m-0 border-top-grey mt-4">
                @endforeach
              @endif
              <div class=" append_div m-0 border-top-grey mt-4">
              </div>


              <!--<hr class="m-0 border-top-grey mt-4">-->
              <div class="d-flex  border-top-grey  pb-3 c-inv-total mt-4">
                <table width="100%" class="text-right f-14  border-top-grey">
                  <tbody>
                    <tr>
                      <td width="50%" class="border-0 d-lg-table d-md-table d-none"></td>
                      <td width="50%" class="p-0 border-0 c-inv-total-right">
                        <table width="100%">
                          <tbody>
                            <tr>
                              <td colspan="2" class="border-top-0 text-dark-grey">
                                Sub Total</td>
                              <td width="30%" class="border-top-0 sub-total" id="sub-total">0.00</td>
                              <input type="hidden" class="sub-total-field" id="sub_total" name="sub_total" autocomplete="off">
                            </tr>
                            <tr>
                              <td width="20%" class="text-dark-grey">Discount </td>
                              <td width="42.7%"  style="padding: 5px;">
                                <table width="100%" class="mw-250">
                                  <tbody>
                                    <tr>
                                      <td width="70%" class="c-inv-sub-padding">
                                        <input type="number" min="0" name="discount_value" class="form-control f-14 border-0 w-100 text-right discount_value" placeholder="0" autocomplete="off" @if($Inventory && $Inventory->discount_value) value="{{$Inventory->discount_value}}" @else value="0" @endif>
                                      </td>
                                      <td width="30%" align="left" class="c-inv-sub-padding">
                                        <select class="form-control" id="discount_type" name="discount_type">
                                          <option  @if($Inventory && $Inventory->discount_value == 'percent') selected @endif value="percent">%
                                          </option>
                                          <option @if($Inventory && $Inventory->discount_value == 'fixed') selected @endif value="fixed">
                                            Amount</option>
                                        </select>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                              <td><span class="discount_amount">  @if($Inventory && $Inventory->discount_amount) {{ str_replace(',','',number_format($Inventory->discount_amount, 2)) }}  @else 0.00 @endif</span>
                                  <input type="hidden" name="discount_amount" class="discount_amount1"  @if($Inventory && $Inventory->discount_amount) value="{{$Inventory->discount_amount}}" @endif>
                              </td>
                            </tr>
                            <tr>
                              <td>Tax</td>
                              <td colspan="2" class="p-0 border-0">
                                <table width="100%" id="invoice-taxes">
                                  <tr>
                                    <td colspan="2">
                                      <span class="tax-percent"></span>
                                    </td>
                                    <td colspan="2">
                                      <span class="tax-name"></span>
                                    </td>
                                    <td colspan="2">
                                      <span class="tax-amount"></span>
                                      <input type="hidden" id="tax-amount">
                                    </td>

                                  </tr>
                                </table>

                              </td>

                            </tr>
                            <tr class="bg-amt-grey f-16 f-w-500">
                              <td colspan="2">Total</td>
                              <td><span class="total ">0.00</span></td>
                              <input type="hidden" class="total-field " name="final_total_amt" id="final_total_amt" value="0.00">
                              <span id="hidden_total_tax_cal" style="display:none;">0</span>
                              <span id="hidden_total_tax_after_dic" style="display:none;">0</span>
                              <span id="hidden_total_taxs" style="display:none;">0</span>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- / Content -->


          
            <div class="row mb-4">
              <div class="col-md-12">
                <label for="product_description" class="form-label">Note For The Recipient</label>
                <div class="editor-container">
                  <textarea class="form-control  w-50" name="recipient_notes">The company is registered under MSME Act, 2006(Reg. No. UDYAM-RJ-0062383) effective from 6th April 2021</textarea>
                </div>
              </div>
            </div>
            <div class="row mb-4">
              
            </div>
            <div class="row mb-4">
              <div class="col-md-12">
                <div class="editor-container">
                  <div class="form-check">
                    <input type="checkbox" name="is_payment_recieved" class="form-check-input">
                    <label class="form-check-label">I have received the payment.</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="row mb-4">
              <div class="col-md-6 text-end">
                <a href="{{url('admin/Invoices/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
              </div>
              <div class="col-md-6">
                <button type="submit" class="btn btn-success">Save</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>


  numberCount = 1;

  function selectClient(id) {
   var clientName = $('#client_' + id + ' .sie_cont span:first-child').text(); 
   $('#selected_client_img').show();
    var imgSrc = $('#client_' + id + ' img').attr('src'); 
    $('#selected_client_img').attr('src', imgSrc); 
    $('#selected_client_btn').text(clientName); // Set the button text to the selected client name
    $('#set_client_id').val(id); // Set the hidden input value to the selected client ID

    $('.dropdown-content .outer').removeClass('selected');

    // Add the 'selected' class to the clicked option
    $('#client_' + id).addClass('selected');

    $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: 'GET',
          url: "{{url('admin/Invoices/getClientDetails')}}/"+id,
          
          success: function(res) {
            console.log(res);// Make sure to adjust this based on your actual Select2 initialization method
            // alert(res.data.address_1 );
            $('#shipping_address').val(res.data.address_1 +', '+ res.data.address_2);
          },
        });
  }


  $(document).ready(function() {
  numberCount = 1;

 $("#multiselect1").selectpicker();
    CalculateTax();// Call the function to update overall totals

    $('#services').change(function() {
      var selectedServiceId = $(this).val();
      var selectedClientId = $('#client_id').val();

      $('#services_type').show();
      // $('input.cost_per_item').val('');

      if (selectedServiceId && selectedClientId) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: 'GET',
          url: "{{url('admin/Invoices/get_selected_product_plan')}}",
          data: {
            selectedServiceId: selectedServiceId,
            selectedClientId: selectedClientId,
          },
          success: function(res) {
            console.log(res);
            $('.select2').select2(); // Make sure to adjust this based on your actual Select2 initialization method
          },
        });
      }
    });


    $('#currencies').change(function() {
      var selectedCurrencyId = $(this).val();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type: 'POST',
        url: "{{url('admin/Invoices/selectedCurrencyData')}}",
        data: {
          selectedCurrencyId: selectedCurrencyId,
        },
        success: function(res) {
          if (res && res.data && res.data.exchange_rate) {
            $('#exchange_rate').val(res.data.exchange_rate);
          } else {
            $('#exchange_rate').val('');
          }
        },
      });

    });
    $('#invoice_number2').keyup(function() {
      var invoice_number2 = $(this).val();
      $.ajax({
        type: 'GET',
        url: "{{url('admin/Invoices/check_invoice_number')}}",
        data: {
          invoice_number2: invoice_number2,
        },
        success: function(res) {
          if (res.status === false) {
            $('.showinvoice_err').text(res.message);
          } else {
            $('.showinvoice_err').text('');
          }
        },
        error: function(xhr, status, error) {
          console.error('AJAX Error: ' + error);
        },
      });
    });

    $('.discount_value').on('keyup', function() {
      calcDiscount();
    });
    $('.discount_value').on('change', function() {
      calcDiscount();
    });
    $('#discount_type').on('change', function() {
      calcDiscount();
    });

    $(document).on('change', 'input[name^="invoice_item_image["]', function() {
      var sectionCount = $(this).attr('sectionCount');
      var file = this.files[0];
      if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#show_img' + sectionCount).html("<img src=" + e.target.result + "style='height:140px;width:140px'>");
        };
        reader.readAsDataURL(file);
      } else {
        $('#show_img' + sectionCount + ' span img').attr('src', "{{ url('public/images/cloud.png') }}");
       
      }
    });


  });

    //GET PRODUCT NAME
  function getProduct(id) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: 'get',
      url: "{{url('admin/getProduct')}}",
      data: {
        id: id,
      },
      success: function(res) {
        console.log(res);
        $('#get_service_orderss').html(res);
        $('.select2').select2();
      },
    });
  }


  function displayFileName(input) {
    var fileName = input.files[0].name;
    document.getElementById('selectedFileName').innerText = fileName;
  }



 function calcDiscount() {
    var discount_value = parseFloat($('.discount_value').val()) || 0;
    var discount_type = $('#discount_type').val();
    var sub_total = parseFloat($('#sub_total').val()) || 0;
    var hidden_total_taxs = parseFloat($('#hidden_total_taxs').text()) || 0;

    var total_value = sub_total + hidden_total_taxs;

    var total_discount_value = 0;

    if (discount_value == 0 && hidden_total_taxs) {
        $('.total').text(0.00);
        $('#hidden_total_tax_after_dic').text(0.00);
        $('#final_total_amt').val(0.00);
    }

    if (discount_type == 'percent') {
        var disc_value = (sub_total * discount_value) / 100;
        total_discount_value = sub_total - disc_value;
        $('.discount_amount').text(disc_value.toFixed(2));
        $('.discount_amount1').val(disc_value.toFixed(2));
    } else {
        disc_value = discount_value;
        total_discount_value = sub_total - discount_value;
        $('.discount_amount').text(disc_value.toFixed(2));
        $('.discount_amount1').val(disc_value.toFixed(2));
    }

    CalculateTax();
}


  $(document).on('keyup',`.qty, .cost_per_item`, function() {
    $sectionCount = $(this).attr('sectionCount');
    calculateTotal($sectionCount);
    calcDiscount();
  });

  $(document).on('change',`.qty, .cost_per_item`, function() {
    $sectionCount = $(this).attr('sectionCount');
    calculateTotal($sectionCount);
    calcDiscount();
  });

  $(`.qty, .cost_per_item`).on('keyup', function() {
    calculateTotal(numberCount);
    calcDiscount();
  });

  $(`.qty, .cost_per_item`).on('change', function() {
    calculateTotal(numberCount);
    calcDiscount();
  });

  $('#services_type').on('mouseleave', function() {
    calculateTotal(numberCount);
    calcDiscount();
  });
  
  $('#when_calc_tax').on('change', function() {
    calcDiscount();
  });

  calculateTotal(numberCount);


  function removeSection(button) {
    $(button).closest('.item-row').remove();
     CalculateTax();
    calculateTotal(numberCount);
    calcDiscount();
  }

  $(document).ready(function() {
    function updateHiddenField(index) {
      var editorContentText = $(".full-editor.geteditor").eq(index).html();
      console.log("Editor " + (index + 1) + " Text content: " + editorContentText);
      $('.hidden-field').eq(index).val(editorContentText);
    }
    $(document).on('keyup blur', '.full-editor.geteditor', function() {
      var index = $(".full-editor.geteditor").index(this);
      updateHiddenField(index);
    });
  });

  $(document).ready(function() {
    function handleKeyup() {
      var base_amount = $('#base_amount').val();
      var gst_vat = $('#gst_vat').val();
      if ($.isNumeric(base_amount) && $.isNumeric(gst_vat)) {
        var gst_vat_amount = base_amount * (gst_vat / 100);
        $('#tax_amount').val(gst_vat_amount);
        var total_amount = parseInt(base_amount) + parseInt(gst_vat_amount);
        $('#total_amount').val(total_amount);
      }
    }
    handleKeyup();
    $('#base_amount').on('keyup', function() {
      handleKeyup();
    });
    $('#gst_vat').on('keyup', function() {
      handleKeyup();
    });
  });



  function getProductDetailWithFullData(product_id) {

    numberCount++;

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: 'POST',
      url: "{{url('admin/Invoices/get_product_price')}}",
      data: {
        product_id: product_id,
        numberCount: numberCount,
      },
      success: function(res) {
        console.log(res);

        if (parseFloat(numberCount) == 2){

         $('#append_div_copy1').html('');
        }
          $('.append_div').append(res);

          $('#multiselect1' + numberCount).selectpicker();
          calculateTotal(numberCount);
      },
    });
  }

  function getProjectDetails(project_id) {
    numberCount++;
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: 'POST',
      url: "{{url('admin/Invoices/get_project_details')}}",
      data: {
        project_id: project_id,
        numberCount: numberCount,
      },
      success: function(res) {
        
        if (parseFloat(numberCount) == 2){
          $('#append_div_copy1').html('');
        }
          $('.append_div').append(res);
          $('#multiselect1' + numberCount).selectpicker();
          calculateTotal(numberCount);
      },
    });
  }


function calculateTotal(sectionCount) {
    var quantity = parseFloat($(`#qty${sectionCount}`).val()) || 0;
    var costPerItem = parseFloat($(`#cost_per_item${sectionCount}`).val()) || 0;
    var totalAmount = quantity * costPerItem;

    $(`#total-amt${sectionCount}`).text(totalAmount.toFixed(2));
    // Remove the following line since it replaces the input value
    // $(`#amount${sectionCount}`).val(totalAmount.toFixed(2)); 
    $('.total').text(totalAmount.toFixed(2));
    
    $('#final_total_amt').val(totalAmount.toFixed(2));

    calculateTotalAmount(sectionCount); // Call the function to update overall totals
}

function calculateTotalAmount(sectionCount) {
    var overallTotal = 0;

    // Loop through each row to calculate the overall subtotal
    $('.amount-html').each(function() {
        var currentTotal = parseFloat($(this).text()) || 0;
        overallTotal += currentTotal;
    });
// alert(overallTotal);
    $('#sub-total').html('<span>' + overallTotal.toFixed(2) + '</span>');
    $('#sub_total').val(overallTotal.toFixed(2));

    // Calculate the total amount including tax
    var hiddenTotalTaxs = parseFloat($('#hidden_total_taxs').text()) || 0;
    var finalTotal = overallTotal + hiddenTotalTaxs;

    $('#final_total_amt').val(finalTotal.toFixed(2));
    $('.total').text(finalTotal.toFixed(2));

   // Get the selected options for the specific row
    var selectedOptions = $('#multiselect1' + sectionCount + ' option:selected');
    CalculateTax();
}

$('#invoice-taxes').html('');


function CalculateTax() {
    var subtotal = 0;
    var taxList = {};
    var taxTotal = 0;
    var discountAmount = 0;
    var discountType = $("#discount_type").val();
    var discountValue = $(".discount_value").val();
    var sub_totl = $("#sub_total").val();
        sub_totl = parseFloat(sub_totl);
      //  alert(sub_totl);
    $(".item-row").each(function () {
        var amount = parseFloat($(this).find(".amount-html").text());

        subtotal += isNaN(amount) ? 0 : amount;
       // alert(subtotal);
        var itemTaxes = $(this).find("select.multiselect option:selected");
        var quantity = parseInt($(this).find(".quantity").val());
        itemTaxes.each(function () {
            var taxRate = parseFloat($(this).data('tax-value'));
            var taxName = $(this).data("rate");

            if (!isNaN(taxRate)) {
                var taxAmount;
                if ($("#when_calc_tax").val() === "0") {
                    // Calculate tax before discount
                    // var taxBaseAmount = amount * quantity;
                    var taxBaseAmount = amount;
                    taxAmount = (taxBaseAmount * taxRate) / 100;
                } else if($("#when_calc_tax").val() === "1") {
                    var discountedAmount = amount;
                    if (discountType == 'percent') {
                        discountedAmount -= (amount * parseFloat(discountValue)) / 100;
                    } else {
                        discountedAmount -= parseFloat(discountValue);
                    }
                    taxAmount = (discountedAmount * taxRate) / 100 * quantity;
                }

                if (taxList[taxName] === undefined) {
                    taxList[taxName] = taxAmount;
                } else {
                    taxList[taxName] += taxAmount;
                }
                taxTotal += taxAmount;
            }
        });
    });
    var discount_amount = $('.discount_amount').text();
  //  alert(discount_amount);
    if(discount_amount > 0){
      var total = sub_totl + taxTotal - discount_amount;
    }else{
      var total = sub_totl + taxTotal;
    }

    
    $(".total").html(total.toFixed(2));
    $("#final_total_amt").val(total.toFixed(2));

    // Render tax details
    var taxHtml = '';
console.log(taxList);

$.each(taxList, function (taxName, taxAmount) {
        taxHtml += '<tr><td class="text-dark-grey">' + taxName + '</td><td><span class="tax-percent">' + taxAmount.toFixed(2) + '</span></td></tr>';
    });

    if (taxHtml === '') {
        taxHtml = '<tr><td colspan="2"><span class="tax-percent">0.00</span></td></tr>';
    }

    $("#invoice-taxes").html(taxHtml);
}



  function getProduct1(id,icon) {

     var clientName = $('#service_' + id + ' .sie_cont span:first-child').text(); 
    $('#selected_service_img').html(icon); 
    $('#selected_service_btn').text(clientName); // Set the button text to the selected client name
    $('#set_service_id').val(id); // Set the hidden input value to the selected client ID
    $('.dropdown-content .outer').removeClass('selected');

    // Add the 'selected' class to the clicked option
    $('#service_' + id).addClass('selected');
}






</script>
@endsection