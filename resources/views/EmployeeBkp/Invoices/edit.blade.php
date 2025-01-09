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
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Inventory /</span> Add</h4>
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
          <form action="{{url('admin/Invoices/update/'.$id)}}" method="post" enctype="multipart/form-data"> 
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
              <label for="client_id" class="form-label">Assigned To <span class="text-danger">*</span></label>
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
               <!-- Content wrapper -->
               <div class="content-wrapper">
                <div id="sortable">
                  <!-- DESKTOP DESCRIPTION TABLE START -->
                  <div class="d-flex px-4 py-3 c-inv-desc item-row" id="append_div_copy">
                    <div class="c-inv-desc-table w-100 d-lg-flex d-md-flex d-block"  >
                      <table width="100%">
                        <tbody>
                          <tr class="text-dark-grey font-weight-bold f-14">
                            <td width="50%" class="border-0 inv-desc-mbl btlr">Description</td>
                            <td width="10%" class="border-0" align="right">
                            Quantity                                    </td>
                            <td width="10%" class="border-0" align="right">
                            Unit Price</td>
                            <td width="13%" class="border-0" align="right">Tax </td>
                            <td width="17%" class="border-0 bblr-mbl" align="right">
                            Amount</td>
                          </tr>
                          <tr>
                            <td class="border-bottom-0 btrr-mbl btlr">
                              <input type="text" class="form-control f-14 border-0 w-100 item_name" name="item_name[]" placeholder="Item Name" autocomplete="off">
                            </td>
                            <td class="border-bottom-0 d-block d-lg-none d-md-none">
                              <textarea class="form-control f-14 border-0 w-100 mobile-description form-control" name="item_summary[]" placeholder="Enter Description (optional)"></textarea>
                            </td>
                            <td class="border-bottom-0">
                              <input type="number" min="1" class="form-control f-14 border-0 w-100 text-right quantity mt-3" value="1" name="quantity[]" autocomplete="off">
                              <select class="text-dark-grey float-right border-0 f-12" name="unit_id[]">
                                <option selected="" value="1">Pcs</option>
                              </select>
                              <input type="hidden" name="product_id[]" value="" autocomplete="off">
                            </td>
                            <td class="border-bottom-0">
                              <input type="number" min="1" class="f-14 border-0 w-100 text-right cost_per_item form-control" placeholder="0.00" value="0" name="cost_per_item[]" autocomplete="off">
                            </td>
                            <td class="border-bottom-0">
                              <div class="select-others height-35 rounded border-0">
                                <div class="dropdown bootstrap-select show-tick select-picker type customSequence border-0"><select id="multiselect" name="taxes[0][]" multiple="multiple" class="select-picker type customSequence border-0" data-size="3">
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
                                </select><button type="button" tabindex="-1" class="btn dropdown-toggle btn-light bs-placeholder" data-toggle="dropdown" role="combobox" aria-owns="bs-select-9" aria-haspopup="listbox" aria-expanded="false" data-id="multiselect" title="Nothing selected"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">Nothing selected</div></div> </div></button><div class="dropdown-menu "><div class="inner show" role="listbox" id="bs-select-9" tabindex="-1" aria-multiselectable="true"><ul class="dropdown-menu inner show" role="presentation"></ul></div></div></div>
                              </div>
                            </td>
                            <td rowspan="2" align="right" valign="top" class="bg-amt-grey btrr-bbrr">
                              <span class="amount-html">0.00</span>
                              <input type="hidden" class="amount" name="amount[]" value="0" autocomplete="off">
                            </td>
                          </tr>
                          <tr class="d-none d-md-table-row d-lg-table-row">
                            <td colspan="3" class="dash-border-top bblr border-right-0">
                              <textarea class="f-14 border p-3 rounded w-100 desktop-description form-control" name="item_summary[]" placeholder="Enter Description (optional)"></textarea>
                            </td>
                            <td class="border-left-0">
                              <div class="dropify-wrapper" style="height: 81.6px;"><div class="dropify-message"><span class=""><img src="{{ url('public/images/cloud.png') }}" style="    width: 54px;
                              margin-top: 25px;
                              "></span> <p>Choose a file</p><p class="dropify-error">Some error occurred.</p></div><div class="dropify-loader"></div><div class="dropify-errors-container"><ul></ul></div><input type="file" class="dropify" name="invoice_item_image[]" data-allowed-file-extensions="png jpg jpeg bmp" data-messages-default="test" data-height="70" autocomplete="off"><button type="button" class="dropify-clear">Remove</button><div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-filename"><span class="dropify-filename-inner"></span></p><p class="dropify-infos-message">Drop a file or click to replace</p></div></div></div></div>
                              <input type="hidden" name="invoice_item_image_url[]" autocomplete="off">
                            </td>
                          </tr>
                        </tbody>
                      </table>
            &nbsp;&nbsp;&nbsp;
            <a href="javascript:;" class="d-flex align-items-center justify-content-center ml-3 remove-item" onclick="removeSection(this)"><i class="fa fa-times-circle f-20 text-lightest"></i></a>  &nbsp;&nbsp;&nbsp;
        <a href="javascript:;" class="d-flex align-items-center justify-content-center ml-3 add-item" onclick="addNewSection()"><i class="fa fa-plus-circle f-20 text-lightest"></i></a>

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
                                <td width="20%" class="text-dark-grey">Discount                                        </td>
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
                                            </select><button type="button" tabindex="-1" class="btn dropdown-toggle btn-light" data-toggle="dropdown" role="combobox" aria-owns="bs-select-10" aria-haspopup="listbox" aria-expanded="false" data-id="discount_type" title="%"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">%</div></div> </div></button><div class="dropdown-menu "><div class="inner show" role="listbox" id="bs-select-10" tabindex="-1"><ul class="dropdown-menu inner show" role="presentation"></ul></div></div></div>
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
  var sectionCount = 1;

  function addNewSection() {
    // Clone the content of the existing section
    var newSection = $("#append_div_copy").clone();

    // Generate a unique ID for the new section
    var newSectionId = "append_div_copy_" + sectionCount;
    sectionCount++;
    
    // Update the ID and clear input values in the new section (optional)
    newSection.attr('id', newSectionId);
    newSection.find('input, textarea, select').val('');

    // Append the new section to the parent container
    $(".append_div").append(newSection);
  }

  function removeSection(button) {
    // Find the closest 'item-row' and remove it
    $(button).closest('.item-row').remove();
  }
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