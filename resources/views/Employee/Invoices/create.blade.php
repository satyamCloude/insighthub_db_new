@extends('layouts.admin')
@section('title', 'Invoices')
@section('content')
<style>
  @media (max-width: 767.98px){
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
      border: 1px solid #e7e9eb!important;
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
      border: 1px solid #e7e9eb!important;
      display: block;
      flex: 1 1 auto;
      height: 70px;
      width: 100%;
    }

    .c-inv-desc-table input.quantity {
      margin-top: 0!important;
    }

    .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
      width: 100%!important;
    }

    .c-inv-desc-table a {
      justify-content: flex-end!important;
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
    border-collapse: separate!important;
    border-spacing: inherit;
  }

  .c-inv-total table tr td .c-inv-sub-padding {
    padding: 5px 10px;
  }

  .height-35 {
    height: 39px!important;
  }

  .rounded {
    border-radius: 0.25rem!important;
  }

  .bootstrap-select:not(.input-group-btn), .bootstrap-select[class*=col-] {
    display: inline-block;
    float: none;
    margin-left: 0;
  }

  .bootstrap-select>select {
    border: none;
    bottom: 0;
    display: block!important;
    height: 100%!important;
    left: 50%;
    opacity: 0!important;
    padding: 0!important;
    position: absolute!important;
    width: 0.5px!important;
    z-index: 0!important;
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
    border: 1px solid rgba(0,0,0,.15);
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

  .bootstrap-select .dropdown-toggle:after, .bootstrap-select .dropup .dropdown-toggle:after {
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
    font-family: Roboto,Helvetica Neue,Helvetica,Arial;
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
    background: rgba(243,65,65,.8);
    bottom: 0;
    left: 0;
    opacity: 0;
    position: absolute;
    right: 0;
    text-align: left;
    top: 0;
    transition: visibility 0s linear .15s,opacity .15s linear;
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
    font-family: Roboto,Helvetica Neue,Helvetica,Arial;
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

  .bootstrap-select>.dropdown-toggle, .input-group .bootstrap-select.form-control .dropdown-toggle {
    background-color: #fff;
    border-color: #e8eef3;
    font-size: 14px;
    padding: 0.5rem;
  }
  .bootstrap-select .dropdown-toggle:after, .bootstrap-select .dropup .dropdown-toggle:after {
    border-left: 0.3em solid transparent;
    border-right: 0.3em solid transparent;
    content: "";
    display: inline-block;
    height: 0;
    margin-left: 0.255em;
    vertical-align: 0.255em;
    width: 0;
  }

  .dropify-font-upload:before, .dropify-wrapper .dropify-message span.file-icon:before {
    content: "\e800";
  }

  .dropify-font:before, .dropify-wrapper .dropify-message span.file-icon:before, [class*=" dropify-font-"]:before, [class^=dropify-font-]:before {
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


  select.form-control[multiple], select.form-control[size], textarea.form-control {
    height: auto;
  }

  .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
    width: 220px;
  }


  .f-14 {
    font-size: 14px!important;
  }


  .text-dark-grey {
    color: #616e80;
  }

  .font-weight-bold {
    font-weight: 700!important;
  }

  .c-inv-desc table tr td {
    border: 1px solid #e7e9eb;
    padding: 11px 10px;
  }

  .btlr {
    border-top-left-radius: 4px;
  }

  .c-inv-desc-table .cost_per_item, .c-inv-desc-table .item_name, .c-inv-desc-table .quantity, .hsn_sac_code {
    border: 1px solid #e7e9eb!important;
    border-radius: 0.25rem!important;
    padding: 0.5rem!important;
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

  .bootstrap-select:not(.input-group-btn), .bootstrap-select[class*=col-] {
    display: inline-block;
    float: none;
    margin-left: 0;
  }

  .bootstrap-select>select {
    border: none;
    bottom: 0;
    display: block!important;
    height: 100%!important;
    left: 50%;
    opacity: 0!important;
    padding: 0!important;
    position: absolute!important;
    width: 0.5px!important;
    z-index: 0!important;
  }

  .show>.btn-light.dropdown-toggle {
    background-color: #dae0e5;
    border-color: #d3d9df;
    color: #212529;
  }

  .bootstrap-select>.dropdown-toggle.bs-placeholder, .bootstrap-select>.dropdown-toggle.bs-placeholder:active, .bootstrap-select>.dropdown-toggle.bs-placeholder:focus, .bootstrap-select>.dropdown-toggle.bs-placeholder:hover {
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

  .bootstrap-select .dropdown-toggle:after, .bootstrap-select .dropup .dropdown-toggle:after {
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
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Invoices /</span> Add</h4>
  <!-- Sticky Actions -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
          <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
          <div class="action-btns">
            <a href="{{url('admin/Invoices/home')}}" class="btn btn-label-primary me-3">
              <span class="align-middle"> Back</span>
            </a>
          </div>
        </div>
        <form action="{{url('admin/Invoices/store')}}" method="post" enctype="multipart/form-data"> 
          @csrf
          <div class="card-body">
            <h5 class="mb-4">1. Invoice Details</h5>
            <div class="row mb-4"> 
              <div class="col-md-3">
                <label for="product_name" class="form-label">Invoice Number<span class="text-danger">*</span></label>

                <div class="input-group">
                  <div class="input-group-prepend">
                    <input type="text" name="invoice_number1" id="invoice_number1" value="INV#" class="form-control height-35 f-15" readonly>
                  </div>
                  <input type="number" name="invoice_number2" id="invoice_number2" class="form-control height-35 f-15" required autocomplete="off">
                </div>
              </div>

              <div class="col-md-2">
                <label for="product_code" class="form-label">Invoice Date<span class="text-danger">*</span></label>
                <input type="date" class="form-control startDate" name="issue_date" required/>
              </div>
              
              <div class="col-md-2">
                <label for="product_code" class="form-label">Due Date<span class="text-danger">*</span></label>
                <input type="date" class="form-control endDate" name="due_date" required/>
              </div>
              <div class="col-md-3">
               <label for="purchase_date" class="form-label">Currency<span class="text-danger">*</span></label>
               <select class="form-control" name="currency">
                <option value="1">USD ($)</option>
                <option value="2">GBP (£)</option>
                <option value="3">EUR (€)</option>
                <option value="4">INR (₹)</option>
              </select>
            </div>
            <div class="col-md-2">
              <label for="phone_number" class="form-label">Exchange Rate<span class="text-danger">*</span></label>
              <!-- <input type="number" class="form-control" name="phone_number"  required/> -->
              <input type="number" id="exchange_rate" name="exchange_rate" class="form-control" value="1" readonly="" autocomplete="off">
            </div>  
          </div>
          <hr/>
          <div class="row mb-4"> 
            <div class="col-md-4">
              <label for="client_id" class="form-label">Client  <span class="text-danger">*</span></label>
              <select class="form-select" name="client_id" required>
                @foreach($Client as $Employee)
                <option value="{{$Employee->id}}">{{$Employee->first_name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-4">
              <label for="client_id" class="form-label">Project <span class="text-danger">*</span></label>
              <select class="form-select" name="project_id" required>
                @foreach($Project as $Project)
                <option value="{{$Project->id}}">{{$Project->project_name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-4">
              <label for="warranty_expiry" class="form-label">Calculate Tax<span class="text-danger">*</span></label>
              <select class="form-select" name="calc_tax" required>
                <option value="1">After Discount</option>
                <option value="0">Before Discount</option>
              </select>
            </div>
          </div>
          <div class="row mb-4"> 
            <div class="col-md-3">
              <label for="base_amount" class="form-label">Bank Account <span class="text-danger">*</span></label>
              <select class="form-select" name="bank_account" required>
                <option value="1">Primary Account | Altenwerth Ltd</option>
                <option value="0">Secondary Account|Farrell, Hyatt and Wuckert</option>
              </select>
            </div>

          </div>
          <div class="row mb-4"> 
            <div class="col-md-4">
              <label for="assigned_to_id"  class="form-label">Billing Address</label><br>
              <textarea class="form-control" name="billing_address"></textarea>

            </div> 
            <div class="col-md-4">
              <label for="assigned_to_id"  class="form-label">Shipping Address</label><br>
              <textarea class="form-control" name="shipping_address"></textarea>

            </div>
            <div class="col-md-4">
              <label for="assigned_to_id"  class="form-label">Generated By</label>
              <select class="form-select" name="generated_by" required>
               <option value="worksuite">Worksuite</option>

             </select>
           </div>
         </div>
         <hr/>
              <!-- <div class="row mb-4"> 

                <div class="col-md-12">
                      <label for="bill_attachment"  class="form-label">Bill Attachment</label>
                      <input type="file" class="form-control" name="bill_attachment"/>
                </div> 
              </div> -->
             <!--  <div class="row mb-4"> 
                <div class="col-md-12">
                      <label for="product_description"  class="form-label">Product Description</label>
                      <div class="editor-container">
                        <div class="full-editor geteditor"></div>
                        <input type="hidden" name="product_description" class="hidden-field">
                      </div>
                </div> 
              </div>  -->

              <div class="row mb-4 "> 
                <div class="col-md-4">
                     <select class="form-select" name="services_id" required id="services">
                      <option value="0">Services</option>
                      @foreach($Service as $Employee)
                          <option value="{{ $Employee->id }}">{{ $Employee->product_name }}</option>
                      @endforeach
                  </select>
                </div>

              <div class="col-md-4">
                  <select class="form-select" name="services_type" required id="services_type" style="display: none;">
                      <option value="0">Package Time Period</option>
                          <option value="onetime_inr">Onetime INR</option>
                          <option value="onetime_usd">Onetime Used</option>
                          <option value="recurr_inr_hourly">recurr inr hourly</option>
                          <option value="recurr_inr_monthly">recurr inr Monthly</option>
                          <option value="recurr_inr_quartely">recurr inr Quaterly</option>
                          <option value="recurr_inr_semiannually">recurr inr Semi Annually</option>
                          <option value="recurr_inr_annually">recurr inr Annually</option>
                          <option value="recurr_inr_biennially">recurr inr Biennially</option>
                          <option value="recurr_inr_triennially">recurr inr Triennially</option>
                          <option value="recurr_usd_hourly">recurr usd hourly</option>
                          <option value="recurr_usd_monthly">recurr usd Monthly</option>
                           <option value="recurr_usd_quartely">recurr usd Quaterly</option>
                          <option value="recurr_usd_semiannually">recurr usd Semi Annually</option>
                          <option value="recurr_usd_annually">recurr usd Annually</option>
                          <option value="recurr_usd_biennially">recurr usd Biennially</option>
                          <option value="recurr_usd_triennially">recurr usd Triennially</option>
                  </select>
                </div>
               <!-- Content wrapper -->
               <div class="content-wrapper">
                <div id="sortable">
                  <!-- DESKTOP DESCRIPTION TABLE START -->
                  <div class="d-flex px-4 py-3 c-inv-desc item-row" id="append_div_copy1">
                    <div class="c-inv-desc-table w-100 d-lg-flex d-md-flex d-block">
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
                              <input type="text" class="form-control f-14 border-0 w-100 item_name" name="item_name[]"
                              placeholder="Item Name" autocomplete="off">
                            </td>
                            <td class="border-bottom-0 d-block d-lg-none d-md-none">
                              <textarea class="form-control f-14 border-0 w-100 mobile-description form-control" name="item_summary[]"
                              placeholder="Enter Description (optional)"></textarea>
                            </td>
                            <td class="border-bottom-0">
                              <input type="number" min="1" class="form-control f-14 border-0 w-100 text-right quantity mt-3" value="1"
                              name="quantity[]" autocomplete="off" id="qty1">
                              <select class="text-dark-grey float-right border-0 f-12" name="unit_id[]">
                                <option selected="" value="1">Pcs</option>
                              </select>
                              <input type="hidden" name="product_id[]" value="" autocomplete="off">
                            </td>
                            <td class="border-bottom-0">
                              <input type="number" min="1" class="f-14 border-0 w-100 text-right cost_per_item form-control"
                              placeholder="0.00" value="0" name="cost_per_item[]" autocomplete="off" id="cost_per_item1" readonly>
                            </td>
                            <td class="border-bottom-0">
                              <div class="select-others height-35 rounded border-0">
                                <div class="dropdown bootstrap-select show-tick select-picker type customSequence border-0"><select
                                  id="multiselect" name="taxes[0][]" multiple="multiple"
                                  class="select-picker type customSequence border-0" data-size="3">
                                  <option data-rate="10" data-tax-text="GST:10%" value="1">GST:
                                  10%</option>
                                  <option data-rate="18" data-tax-text="CGST:18%" value="2">CGST:
                                  18%</option>
                                  <option data-rate="10" data-tax-text="VAT:10%" value="3">VAT:
                                  10%</option>
                                  <option data-rate="10" data-tax-text="IGST:10%" value="4">IGST:
                                  10%</option>
                                  <option data-rate="10" data-tax-text="UTGST:10%" value="5">UTGST:
                                  10%</option>
                                </select>
                                <div class="dropdown-menu ">
                                  <div class="inner show" role="listbox" id="bs-select-9" tabindex="-1" aria-multiselectable="true">
                                    <ul class="dropdown-menu inner show" role="presentation"></ul>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td rowspan="2" align="right" valign="top" class="bg-amt-grey btrr-bbrr">
                            <span class="amount-html" id="total-amt1">0.00</span>
                            <input type="hidden" class="amount" name="amount[]" value="0" id="amount1" autocomplete="off">
                          </td>
                        </tr>
                        <tr class="d-none d-md-table-row d-lg-table-row">
                          <td colspan="3" class="dash-border-top bblr border-right-0">
                            <textarea class="f-14 border p-3 rounded w-100 desktop-description form-control" name="item_summary[]"
                            placeholder="Enter Description (optional)"></textarea>
                          </td>
                          <td class="border-left-0">
                            <div class="dropify-wrapper" style="height: 81.6px;">
                              <div class="dropify-message"><span class=""><img src="{{ url('public/images/cloud.png') }}" style="width: 54px;
                              margin-top: 25px;
                              "></span>
                              <p>Choose a file</p>
                              <p class="dropify-error">Some error occurred.</p>
                            </div>
                            <div class="dropify-loader"></div>
                            <div class="dropify-errors-container">
                              <ul></ul>
                            </div><input type="file" class="dropify" name="invoice_item_image[]"
                            data-allowed-file-extensions="png jpg jpeg bmp" data-messages-default="test" data-height="70"
                            autocomplete="off"><button type="button" class="dropify-clear">Remove</button>
                            <div class="dropify-preview"><span class="dropify-render"></span>
                              <div class="dropify-infos">
                                <div class="dropify-infos-inner">
                                  <p class="dropify-filename"><span class="dropify-filename-inner"></span></p>
                                  <p class="dropify-infos-message">Drop a file or click to replace</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <input type="hidden" name="invoice_item_image_url[]" autocomplete="off">
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  &nbsp;&nbsp;&nbsp;
                  <a href="javascript:;" class="d-flex align-items-center justify-content-center ml-3 remove-item"
                  onclick="removeSection(this)"><i class="fa fa-times-circle f-20 text-lightest"></i></a> &nbsp;&nbsp;&nbsp;
                  <a href="javascript:;" class="d-flex align-items-center justify-content-center ml-3 add-item"
                  onclick="addNewSection()"><i class="fa fa-plus-circle f-20 text-lightest"></i></a>
                </div>
              </div>

              <!-- DESKTOP DESCRIPTION TABLE END -->

            </div>
            <div class="row append_div">
            </div>
            <!-- SECOND TABLE NEW  -->

            <hr class="m-0 border-top-grey">
            <div class="d-flex px-lg-4 px-md-4 px-3 pb-3 c-inv-total">
              <table width="100%" class="text-right f-14">
                <tbody>
                  <tr>
                    <td width="50%" class="border-0 d-lg-table d-md-table d-none"></td>
                    <td width="50%" class="p-0 border-0 c-inv-total-right">
                      <table width="100%">
                        <tbody>
                          <tr>
                            <td colspan="2" class="border-top-0 text-dark-grey">
                            Sub Total</td>
                            <td width="30%" class="border-top-0 sub-total">0.00</td>
                            <input type="hidden" class="sub-total-field" name="sub_total" value="0" autocomplete="off">
                          </tr>
                          <tr>
                            <td width="20%" class="text-dark-grey">Discount </td>
                            <td width="40%" style="padding: 5px;">
                              <table width="100%" class="mw-250">
                                <tbody>
                                  <tr>
                                    <td width="70%" class="c-inv-sub-padding">
                                      <input type="number" min="0" name="discount_value" class="form-control f-14 border-0 w-100 text-right discount_value" placeholder="0" value="0" autocomplete="off">
                                    </td>
                                    <td width="30%" align="left" class="c-inv-sub-padding">
                                      <div class="select-others select-tax height-35 rounded border-0">
                                        <div class="dropdown bootstrap-select form-control select-picker"><select class="form-control select-picker" id="discount_type" name="discount_type">
                                          <option value="percent">%
                                          </option>
                                          <option value="fixed">
                                          Amount</option>
                                        </select><div class="dropdown-menu "><div class="inner show" role="listbox" id="bs-select-10" tabindex="-1"><ul class="dropdown-menu inner show" role="presentation"></ul></div></div></div>
                                      </div>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                            <td><span id="discount_amount">0.00</span>
                            </td>
                          </tr>
                          <tr>
                            <td>Tax</td>
                            <td colspan="2" class="p-0 border-0">
                              <table width="100%" id="invoice-taxes"><tr><td colspan="2"><span class="tax-percent">0.00</span></td></tr></table>
                            </td>

                          </tr>
                          <tr class="bg-amt-grey f-16 f-w-500">
                            <td colspan="2">Total</td>
                            <td><span class="total">0.00</span></td>
                            <input type="hidden" class="total-field" name="total" value="0.00" autocomplete="off">
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


        </div>
        <div class="row mb-4"> 
          <div class="col-md-12">
            <label for="product_description"  class="form-label">Note For The Recipient</label>
            <div class="editor-container">
             <textarea class="form-control" name="recipient_notes"></textarea>
           </div>
         </div> 
       </div>
       <div class="row mb-4"> 
        <div class="col-md-12">
          <label for="product_description"  class="form-label">Add File</label>
          <div class="editor-container">
            <input type="file" name="invoice_attachment" class="form-control">
          </div> 
        </div>

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

      <div class="card-footer">
        <div class="row mb-4"> 
          <div class="col-md-6 text-end" >
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
<!-- /Sticky Actions -->
</div>

<script>
    $(document).ready(function () {
        $('#services').change(function () {
            var selectedServiceId = $(this).val();
            $('#services_type').show();
            $('input.cost_per_item').val('');

        });

        $('#services_type').change(function () {
            var selectedServiceType = $(this).val();
            var selectedServiceId = $('#services').val();
           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      $.ajax({
              type: 'POST',
              url: "{{url('admin/Invoices/get_product_price')}}",
              data: {
                selectedServiceId: selectedServiceId,
                selectedServiceType: selectedServiceType,
              },
              success: function (res) {
                    console.log(res.data);
                    if (res.data !== undefined && res.data !== null) {
                        var selectedServiceTypeValue = res.data[selectedServiceType];
                        if (selectedServiceTypeValue !== undefined && selectedServiceTypeValue !== null) {
                            // Set the value of all input elements with class 'cost_per_item'
                            $('input.cost_per_item').val(selectedServiceTypeValue);
                            // Make all input elements with class 'cost_per_item' readonly
                            $('input.cost_per_item').prop('readonly', true);
                        } else {
                            $('input.cost_per_item').val('');
                            $('input.cost_per_item').prop('readonly', false);
                        }
                    } else {
                        // console.log("res.data is empty");
                    }
                },
            });

        });
    });
</script>
<script>
  $(document).ready(function() {
    $('#multiselect').selectpicker();
    $('#multiselect').selectpicker('refresh');
  });

  // $(document).ready(function() {
  //   // Add an event listener to the cost_per_item input field
  //   $('.cost_per_item, .quantity').on('input', function() {
  //     // Find the closest section
  //     var section = $(this).closest('.item-row');

  //     // Get values from the current section
  //     var costPerItem = parseFloat(section.find('.cost_per_item').val()) || 0;
  //     var quantity = parseInt(section.find('.quantity').val()) || 1;

  //     // Calculate the result
  //     var result = costPerItem * quantity;

  //     // Update the amount in the current section
  //     section.find('#amount-html').text(result.toFixed(2)); // Display result with 2 decimal places
  //   });
  // });
</script>

<script>
  var sectionCount = 2;
  function addNewSection() {
          

    var newSectionId = "append_div_copy_" + sectionCount;
    var newSectionHTML = `
    <div class="d-flex px-4 py-3 c-inv-desc item-row" id="append_div_copy${sectionCount}">
    <div class="c-inv-desc-table w-100 d-lg-flex d-md-flex d-block">
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
    <input type="text" class="form-control f-14 border-0 w-100 item_name" name="item_name[]"
    placeholder="Item Name" autocomplete="off">
    </td>
    <td class="border-bottom-0 d-block d-lg-none d-md-none">
    <textarea class="form-control f-14 border-0 w-100 mobile-description form-control" name="item_summary[]"
    placeholder="Enter Description (optional)"></textarea>
    </td>
    <td class="border-bottom-0">
    <input type="number" min="1" class="form-control f-14 border-0 w-100 text-right quantity mt-3" value="1"
    name="quantity[]" autocomplete="off" id="qty${sectionCount}">
    <select class="text-dark-grey float-right border-0 f-12" name="unit_id[]">
    <option selected="" value="1">Pcs</option>
    </select>
    <input type="hidden" name="product_id[]" value="" autocomplete="off">
    </td>
    <td class="border-bottom-0">
    <input type="number" min="1" class="f-14 border-0 w-100 text-right cost_per_item form-control"
    placeholder="0.00" value="0" name="cost_per_item[]" autocomplete="off" id="cost_per_item${sectionCount}" readonly>
    </td>
    <td class="border-bottom-0">
    <div class="select-others height-35 rounded border-0">
    <div class="dropdown bootstrap-select show-tick select-picker type customSequence border-0"><select
    id="multiselect" name="taxes[0][]" multiple="multiple"
    class="select-picker type customSequence border-0" data-size="3">
    <option data-rate="10" data-tax-text="GST:10%" value="1">GST:
    10%</option>
    <option data-rate="18" data-tax-text="CGST:18%" value="2">CGST:
    18%</option>
    <option data-rate="10" data-tax-text="VAT:10%" value="3">VAT:
    10%</option>
    <option data-rate="10" data-tax-text="IGST:10%" value="4">IGST:
    10%</option>
    <option data-rate="10" data-tax-text="UTGST:10%" value="5">UTGST:
    10%</option>
    </select>
    <div class="dropdown-menu ">
    <div class="inner show" role="listbox" id="bs-select-9" tabindex="-1" aria-multiselectable="true">
    <ul class="dropdown-menu inner show" role="presentation"></ul>
    </div>
    </div>
    </div>
    </div>
    </td>
    <td rowspan="2" align="right" valign="top" class="bg-amt-grey btrr-bbrr">
    <span class="amount-html" id="total-amt${sectionCount}">0.00</span>
    <input type="hidden" class="amount" name="amount[]" value="0" id="amount${sectionCount}" autocomplete="off">
    </td>
    </tr>
    <tr class="d-none d-md-table-row d-lg-table-row">
    <td colspan="3" class="dash-border-top bblr border-right-0">
    <textarea class="f-14 border p-3 rounded w-100 desktop-description form-control" name="item_summary[]"
    placeholder="Enter Description (optional)"></textarea>
    </td>
    <td class="border-left-0">
    <div class="dropify-wrapper" style="height: 81.6px;">
    <div class="dropify-message"><span class=""><img src="{{ url('public/images/cloud.png') }}" style="    width: 54px;
    margin-top: 25px;
    "></span>
    <p>Choose a file</p>
    <p class="dropify-error">Some error occurred.</p>
    </div>
    <div class="dropify-loader"></div>
    <div class="dropify-errors-container">
    <ul></ul>
    </div><input type="file" class="dropify" name="invoice_item_image[]"
    data-allowed-file-extensions="png jpg jpeg bmp" data-messages-default="test" data-height="70"
    autocomplete="off"><button type="button" class="dropify-clear">Remove</button>
    <div class="dropify-preview"><span class="dropify-render"></span>
    <div class="dropify-infos">
    <div class="dropify-infos-inner">
    <p class="dropify-filename"><span class="dropify-filename-inner"></span></p>
    <p class="dropify-infos-message">Drop a file or click to replace</p>
    </div>
    </div>
    </div>
    </div>
    <input type="hidden" name="invoice_item_image_url[]" autocomplete="off">
    </td>
    </tr>
    </tbody>
    </table>
    &nbsp;&nbsp;&nbsp;
    <a href="javascript:;" class="d-flex align-items-center justify-content-center ml-3 remove-item"
    onclick="removeSection(this)"><i class="fa fa-times-circle f-20 text-lightest"></i></a> &nbsp;&nbsp;&nbsp;
    <a href="javascript:;" class="d-flex align-items-center justify-content-center ml-3 add-item"
    onclick="addNewSection()"><i class="fa fa-plus-circle f-20 text-lightest"></i></a>
    </div>
    </div>
    `;
    $(".append_div").append(newSectionHTML);
    sectionCount++;
    // Add event listener for quantity and cost_per_item changes
  // $(`#qty${sectionCount}, #cost_per_item${sectionCount}`).on('keyup', function () {
  //   console.log('Keyup event triggered');
  //   calculateTotal(sectionCount);
  // });
      var selectedServiceType = $('#services_type').val();
            var selectedServiceId = $('#services').val();
           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      $.ajax({
              type: 'POST',
              url: "{{url('admin/Invoices/get_product_price')}}",
              data: {
                selectedServiceId: selectedServiceId,
                selectedServiceType: selectedServiceType,
              },
              success: function (res) {
                    console.log(res.data);
                    if (res.data !== undefined && res.data !== null) {
                        var selectedServiceTypeValue = res.data[selectedServiceType];
                        if (selectedServiceTypeValue !== undefined && selectedServiceTypeValue !== null) {
                            $('input.cost_per_item').val(selectedServiceTypeValue);
                            $('input.cost_per_item').prop('readonly', true);
                        } else {
                            $('input.cost_per_item').val('');
                            $('input.cost_per_item').prop('readonly', false);
                        }
                    } else {
                        // console.log("res.data is empty");
                    }
                },
            });

  }

  $(`#qty1, #cost_per_item1`).on('keyup', function () {
      console.log('Keyup event triggered');
      calculateTotal(1);
  });

  $(".append_div").on('keyup', '[id^="qty"], [id^="cost_per_item"]', function () {
    console.log('Keyup event triggered');
    var sectionCount = $(this).attr('id').match(/\d+/)[0];
    calculateTotal(sectionCount);
  });
    $(`#qty1, #cost_per_item1`).on('mouseover', function () {
        console.log('Mouseover event triggered');
        calculateTotal(1);
    });

$('.dropify').on('change', function () {
    // Uncomment the following line if you want to alert the file name
     alert(this.files[0].name);

    var dropifyPreview = $(this).closest('.dropify-wrapper').find('.dropify-preview');
    var dropifyRender = dropifyPreview.find('.dropify-render');
    var dropifyInfos = dropifyPreview.find('.dropify-infos');
    
    // Check if a file is selected
    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            // Display the uploaded file in the dropify-render span
            dropifyRender.html(`<img src="${e.target.result}" style="max-width:100%; max-height:100%;" />`);
        };

        reader.readAsDataURL(this.files[0]);

        // Update file name in the dropify-infos
        dropifyInfos.find('.dropify-filename-inner').text(this.files[0].name);
        dropifyInfos.find('.dropify-infos-message').text('File selected');
    } else {
        // Clear the dropify-render span if no file is selected
        dropifyRender.html('');
        
        // Reset file name and message in dropify-infos
        dropifyInfos.find('.dropify-filename-inner').text('');
        dropifyInfos.find('.dropify-infos-message').text('Drop a file or click to replace');
    }
});



   $(".append_div").on('mouseover', '[id^="qty"], [id^="cost_per_item"]', function () {
    console.log('mouseover event triggered');
    var sectionCount = $(this).attr('id').match(/\d+/)[0];
    calculateTotal(sectionCount);
  });
   
  function calculateTotal(sectionCount) {
  // alert(sectionCount)
    var quantity = parseFloat($(`#qty${sectionCount}`).val()) || 0;
    var costPerItem = parseFloat($(`#cost_per_item${sectionCount}`).val()) || 0;
    var totalAmount = quantity * costPerItem;

  // Display the total amount
    $(`#total-amt${sectionCount}`).text(totalAmount.toFixed(2));

  // Set the hidden input value
    $(`#amount${sectionCount}`).val(totalAmount);
  }

// Initial calculation for the first section
calculateTotal(1); // Assuming you want to calculate the total for the first existing section



// Initial calculation for the first section
function removeSection(button) {
    // Find the closest 'item-row' and remove it
  $(button).closest('.item-row').remove();
}
</script>

<script>
  $(document).ready(function() {
    // Initialize the Bootstrap-select dropdown for discount type
    $('#discount_type').selectpicker();

    // Optionally, refresh the dropdown to ensure correct rendering
    $('#discount_type').selectpicker('refresh');
  });
</script>

<script>
  $(document).ready(function () {
    // Function to update the hidden field based on the editor content
    function updateHiddenField(index) {
      var editorContentText = $(".full-editor.geteditor").eq(index).html();
      console.log("Editor " + (index + 1) + " Text content: " + editorContentText);

      // Update the value of the hidden field based on the index
      $('.hidden-field').eq(index).val(editorContentText);
    }

    // Use event delegation to handle keyup and blur on any .full-editor.geteditor
    $(document).on('keyup blur', '.full-editor.geteditor', function () {
      // Get the index of the editor
      var index = $(".full-editor.geteditor").index(this);

      // Update the corresponding hidden field
      updateHiddenField(index);
    });
  });
  $(document).ready(function () {
    // Function to handle keyup event
    function handleKeyup() {
      var base_amount = $('#base_amount').val();
      var gst_vat = $('#gst_vat').val();

        // Ensure that base_amount and gst_vat are numeric before performing the calculation
      if ($.isNumeric(base_amount) && $.isNumeric(gst_vat)) {
            // Calculate gst_vat amount
        var gst_vat_amount = base_amount * (gst_vat / 100);  

            // Set the value of #tax_amount
        $('#tax_amount').val(gst_vat_amount);

            // Calculate total amount
        var total_amount = parseInt(base_amount) + parseInt(gst_vat_amount);

            // Display the total amount without the decimal part
        $('#total_amount').val(total_amount);
      }
    }

    // Trigger the function on document ready
    handleKeyup();

    // Bind the function to the keyup event for #base_amount
    $('#base_amount').on('keyup', function () {
      handleKeyup();
    });

    // Bind the function to the keyup event for #gst_vat
    $('#gst_vat').on('keyup', function () {
      handleKeyup();
    });
  });


</script>
@endsection