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
  }.custom-file-input-container {
    position: relative;
    overflow: hidden;
    cursor: pointer;
    width: 150px; /* Adjust the width as needed */
    height: 40px; /* Adjust the height as needed */
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  .custom-file-input {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    background-color: #f8f9fa; /* Background color when not hovered or clicked */
    padding: 10px;
  }

  .custom-file-input:hover {
    background-color: #e9ecef; /* Background color on hover */
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
              <span class="text-danger showinvoice_err"></span>

            </div>

            <div class="col-md-2">
              <label for="product_code" class="form-label">Invoice Date<span class="text-danger">*</span></label>
              <input type="date" class="form-control startDate height-35 f-15" name="issue_date" required/>
            </div>

            <div class="col-md-2">
              <label for="product_code" class="form-label">Due Date<span class="text-danger">*</span></label>
              <input type="date" class="form-control endDate height-35 f-15" name="due_date" required/>
            </div>
            <div class="col-md-3">
             <label for="purchase_date" class="form-label">Currency<span class="text-danger">*</span></label>
             <select class="form-control select2 height-35 f-15" name="currency" id="currencies">
               @foreach($currencies as $currencies)
               <option value="{{$currencies->id}}">{{$currencies->code}} ({{$currencies->prefix}})</option>
               @endforeach
               
             </select>
           </div>
           <div class="col-md-2">
            <label for="phone_number" class="form-label">Exchange Rate<span class="text-danger">*</span></label>
            <!-- <input type="number" class="form-control" name="phone_number"  required/> -->
            <input type="number" id="exchange_rate" name="exchange_rate" class="form-control height-45 f-15" value="1" readonly="" autocomplete="off">
          </div>  
        </div>
        <hr/>
        <div class="row mb-4"> 
          <div class="col-md-4">
            <label for="client_id" class="form-label">Client  <span class="text-danger">*</span></label>
            <select class="form-control select2" name="client_id" required>
              @foreach($Client as $Employee)
              <option value="{{$Employee->id}}">{{$Employee->first_name}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <label for="client_id" class="form-label">Project <span class="text-danger">*</span></label>
            <select class="form-control select2" name="project_id" required>
              @foreach($Project as $Project)
              <option value="{{$Project->id}}">{{$Project->project_name}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <label for="warranty_expiry" class="form-label">Calculate Tax<span class="text-danger">*</span></label>
            <select class="form-control select2" name="calc_tax" id="when_calc_tax" required>
              <option value="1" selected>After Discount</option>
              <option value="0">Before Discount</option>
            </select>
          </div>
        </div>
        <div class="row mb-4"> 
          <div class="col-md-3">
            <label for="base_amount" class="form-label">Bank Account <span class="text-danger">*</span></label>
            <select class="form-control select2" name="bank_account" required>
              <option value="1">Paypal Basics</option>
              <option value="2">Bank Transfer</option>
              <option value="3">Debit/Credit Card</option>
            </select>
          </div>

        </div>
        <div class="row mb-4"> 
          <div class="col-md-4">
            <label for="assigned_to_id"  class="form-label">Billing Address</label><br>
            <span class="text-dark">{{ $billing_address->billing_address }}</span>

          </div> 
          <div class="col-md-4">
            <label for="assigned_to_id"  class="form-label">Shipping Address</label><br>
            <textarea class="form-control" name="shipping_address"></textarea>

          </div>
          <div class="col-md-4">
            <label for="assigned_to_id"  class="form-label">Generated By</label>
            <select class="form-control select2" name="generated_by" required>
              @foreach($Company as $Employee)
              <option value="{{$Employee->id}}">{{$Employee->company_name}}</option>
              @endforeach

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
                 <select class="form-control select2" name="services_id" required id="services">
                  <option value="0">Services</option>
                  @foreach($Service as $Employee)
                  <option value="{{ $Employee->id }}">{{ $Employee->product_name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-4">
                <select class="form-control select2" name="services_type" required id="services_type" style="display: none;">
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
                <a href="javascript:;" class="d-flex align-items-center justify-content-center ml-3 add-item"
                onclick="addNewSection()"><i class="fa fa-plus-circle f-20 text-lightest"></i>Add Item</a>
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
                              placeholder="Item Name" autocomplete="off" required>
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
                              placeholder="0.00" value="0" name="cost_per_item[]" autocomplete="off" id="cost_per_item1" readonly required>
                            </td>
                            <td class="border-bottom-0">
                              <div class="select-others height-35 rounded border-0">
                                <div class="dropdown bootstrap-select show-tick select-picker type customSequence border-0">
                                  <select id="multiselect1" name="taxes[]" multiple="multiple" class="select-picker type customSequence border-0 multiselect" data-size="3">
                                   @foreach($Tax as $Taxs)
                                   <option data-rate="{{ $Taxs->rate }}" data-tax-text="{{ $Taxs->tax_name . ':' . $Taxs->rate }}" value="{{$Taxs->id}}">{{ $Taxs->tax_name . ':' . $Taxs->rate }}</option>
                                   @endforeach

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
                            <div class="dropify-wrapper" style="height: 81.6px;" id="show_img1">
                              <div class="dropify-message" ><span class=""><img id="show_imgs1" src="{{ url('public/images/cloud.png') }}" style="width: 54px;
                              margin-top: 25px;
                              "></span>
                              <p>Choose a file</p>
                              <p class="dropify-error">Some error occurred.</p>
                            </div>
                            <div class="dropify-loader"></div>
                            <div class="dropify-errors-container">
                              <ul></ul>
                            </div>
                            <input type="file" class="dropify" id="upload_imag1" name="invoice_item_image[]"
                            data-allowed-file-extensions="png jpg jpeg bmp"  sectionCount="1" data-messages-default="test" data-height="70"
                            autocomplete="off">
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
                          <input type="hidden" name="invoice_item_image_url[]" autocomplete="off">
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  &nbsp;&nbsp;&nbsp;
                  <a href="javascript:;" class="d-flex align-items-center justify-content-center ml-3 remove-item"
                  onclick="removeSection(this)"><i class="fa fa-times-circle f-20 text-lightest"></i></a> &nbsp;&nbsp;&nbsp;

                </div>
              </div>


            </div>
            <div class="row append_div">
            </div>


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
                            <input type="hidden" class="sub-total-field" id="sub_total" name="sub_total" value="0" autocomplete="off">
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
                                      <select class="form-control" id="discount_type" name="discount_type">
                                        <option value="percent">%
                                        </option>
                                        <option value="fixed">
                                        Amount</option>
                                      </select>
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
                            <input type="hidden" class="total-field" name="total"  id="final_total_amt" value="0.00">
                            <span id="hidden_total_tax_cal" style="display:none">0</span>
                            <span id="hidden_total_tax_after_dic" style="display:none">0</span>
                            <span id="hidden_total_taxs" style="display:none">0</span>
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
          <div class="custom-file-input-container" onclick="document.getElementById('hiddenFileInput').click();">
            <div class="custom-file-input">
              <span id="selectedFileName">Choose File</span>
            </div>
          </div>
          <input type="file" name="invoice_attachment" id="hiddenFileInput" class="form-control" style="display: none;" onchange="displayFileName(this)">
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
</div>

<script>
  $(document).ready(function () {
    $('#multiselect1').selectpicker();

    $('#services').change(function () {
      var selectedServiceId = $(this).val();
      $('#services_type').show();
      $('input.cost_per_item').val('');

    }); 
    $('#currencies').change(function () {
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
        success: function (res) {
          if (res && res.data && res.data.exchange_rate) {
           $('#exchange_rate').val(res.data.exchange_rate);
         }else{
           $('#exchange_rate').val('');
         }
       },
     });

    });   
    $('#invoice_number2').keyup(function () {
      var invoice_number2 = $(this).val();
      $.ajax({
        type: 'GET',
        url: "{{url('admin/Invoices/check_invoice_number')}}",
        data: {
          invoice_number2: invoice_number2,
        },
        success: function (res) {
          if (res.status === false) {
            $('.showinvoice_err').text(res.message);
          } else {
            $('.showinvoice_err').text('');
          }
        },
        error: function (xhr, status, error) {
          console.error('AJAX Error: ' + error);
        },
      });
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
          if (res.data !== undefined && res.data !== null) {
            var selectedServiceTypeValue = res.data[selectedServiceType];
            if (selectedServiceTypeValue !== undefined && selectedServiceTypeValue !== null) {
              $('input.cost_per_item').val(selectedServiceTypeValue);
              $('input.cost_per_item').prop('readonly', true);
              calculateTotal(1);
            } else {
              $('.amount-html').text(0.00);
              $('.total').text(0.00);
              $('.sub-total').text(0.00);
              $('input.final_total_amt').val(0.00);
              $('input.sub_total').val(0.00);
              $('input.cost_per_item').val(0.00);
              $('#invoice-taxes').html();
              $('input.cost_per_item').prop('readonly', false);
            }
          } else {
                        // console.log("res.data is empty");
          }
        },
      });

    });
  });
  $('.discount_value').on('keyup', function () {
   calcDiscount(1);

 });
  $('.discount_value').on('change', function () {
   calcDiscount(1);

 });
  $('#discount_type').on('change', function () {
    calcDiscount(1);
  });
  function displayFileName(input) {
    var fileName = input.files[0].name;
    document.getElementById('selectedFileName').innerText = fileName;
  }

  $(document).ready(function () {
    $(document).on('change','input[name^="invoice_item_image["]',function () {
      var sectionCount = $(this).attr('sectionCount');
      var file = this.files[0];
      if (file) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#show_img' + sectionCount).html("<img src='"+e.target.result+"' style='height:140px;width:140px'>");
        };
        reader.readAsDataURL(file);
      } else {
        $('#show_img' + sectionCount + ' span img').attr('src', '{{ url('public/images/cloud.png') }}');
                    // $('#show_img' + sectionCount).html("<img src=''{{ url('public/images/cloud.png') }}' style='height:140px;width:140px'>");
      }
    });

  
  });


  var sectionCount = 2;

  function initializeSelectPicker(sectionCount) {
    $('#multiselect' + sectionCount).selectpicker();
  }
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
    placeholder="Item Name" autocomplete="off" required>
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
    placeholder="0.00" value="0" name="cost_per_item[]" autocomplete="off" id="cost_per_item${sectionCount}" readonly required>
    </td>
    <td class="border-bottom-0">
    <div class="select-others height-35 rounded border-0">
    <div class="dropdown bootstrap-select show-tick select-picker type customSequence border-0">
    <select id="multiselect${sectionCount}" name="taxes[${sectionCount - 1}][]" multiple="multiple">
    @foreach($Tax as $Taxs)
    <option data-rate="{{ $Taxs->rate }}" data-tax-text="{{ $Taxs->tax_name . ':' . $Taxs->rate }}" value="{{$Taxs->id}}">{{ $Taxs->tax_name . ':' . $Taxs->rate }}</option>
    @endforeach
    </select>
    <div class="dropdown-menu">
    <div class="inner show" role="listbox" id="bs-select-${sectionCount}" tabindex="-1" aria-multiselectable="true">
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
    <div class="dropify-wrapper" id="show_img${sectionCount}" style="height: 81.6px;">
    <div class="dropify-message" ><span class=""><img id="show_imgs${sectionCount}" src="{{ url('public/images/cloud.png') }}" style="    width: 54px;
    margin-top: 25px;
    "></span>
    <p>Choose a file</p>
    <p class="dropify-error">Some error occurred.</p>
    </div>
    <div class="dropify-loader"></div>
    <div class="dropify-errors-container">
    <ul></ul>
    </div><input type="file" class="dropify" id="upload_imag${sectionCount}" name="invoice_item_image[]" sectionCount="${sectionCount}"
    data-allowed-file-extensions="png jpg jpeg bmp" data-messages-default="test" data-height="70"
    autocomplete="off"><button type="button" class="dropify-clear" id="remove_button${sectionCount}">Remove</button>
    <div class="dropify-preview" id="show_imag${sectionCount}"><span class="dropify-render"></span>
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

    </div>
    </div>
    `;
    $(".append_div").append(newSectionHTML);
    initializeSelectPicker(sectionCount);
     

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
        if (res.data !== undefined && res.data !== null) {
          var selectedServiceTypeValue = res.data[selectedServiceType];
          if (selectedServiceTypeValue !== undefined && selectedServiceTypeValue !== null) {
            $('input.cost_per_item').val(selectedServiceTypeValue);
            var quantity =  $('input.quantity').val();
            var cost_per_item =  $('input.cost_per_item').val();
            subTotl =  parseFloat(quantity) *  parseFloat(cost_per_item) || 0.00;
          $('#total-amt'+sectionCount).text(subTotl);
            $('input.cost_per_item').prop('readonly', true);
          } else {
            $('input.cost_per_item').val('');
            $('input.cost_per_item').prop('readonly', false);
          }
        } else {
                        // console.log("res.data is empty");
        }

        sectionCount++;
      },
    });

   
   

  }
  function calcDiscount(sectionCount) {

   var discount_value = parseFloat($('.discount_value').val()) || 0;
   var discount_type = $('#discount_type').val();
   var sub_total = parseFloat($('#sub_total').val()) || 0;
  var hidden_total_taxs = parseFloat($('#hidden_total_taxs').text())|| 0;
  var total_value =  parseFloat(sub_total) + parseFloat(hidden_total_taxs)|| 0;
  //alert(total_value);
   var totl_disc_value = 0;
   if(discount_value == 0 && hidden_total_taxs){
    $('.total').text(0.00);
    $('#hidden_total_tax_after_dic').text(0.00);
    $('#final_total_amt').val(0.00);
   }
   if (discount_type == 'percent') {
    var disc_value = (sub_total * discount_value) / 100;
    totl_disc_value = sub_total - disc_value;
    $('#discount_amount').text(disc_value.toFixed(2));
  } else {
    totl_disc_value = sub_total - discount_value;
    $('#discount_amount').text(discount_value.toFixed(2));
  }
  total_value = parseFloat(total_value) - parseFloat(disc_value)|| 0;
  var when_calc_tax = $('#when_calc_tax').val();
  if (when_calc_tax == 1) {
    totl_disc_value = parseFloat(totl_disc_value) - parseFloat(hidden_total_taxs);
    $('.total').text(total_value.toFixed(2));
    $('#hidden_total_tax_after_dic').text(total_value.toFixed(2));
    $('#total_value').val(total_value.toFixed(2));
  } else {
    hidden_total_tax_cal = parseFloat(totl_disc_value) - parseFloat(hidden_total_taxs);
    $('.total').text();
    $('#final_total_amt').val(total_value.toFixed(2));
  }
}

function calculateTotal(sectionCount) {
  var quantity = parseFloat($(`#qty${sectionCount}`).val()) || 0;
  var costPerItem = parseFloat($(`#cost_per_item${sectionCount}`).val()) || 0;
  var hidden_total_taxs = parseFloat($(`#hidden_total_taxs`).val()) || 0;
  var discount_amount = $('.discount_amount').text();
  var totalAmount = quantity * costPerItem;
  totalAmount2 = ((totalAmount + hidden_total_taxs) - discount_amount);
  $(`#total-amt${sectionCount}`).text(totalAmount2.toFixed(2));
  $(`#amount${sectionCount}`).val(totalAmount2);
  $('.total').text(totalAmount2.toFixed(2));
  calculateTotalAmount();
}
function calculateTotalAmount() {
  var overallTotal = 0;
  $('.amount-html').each(function () {
    var currentTotal = parseFloat($(this).text()) || 0;
    overallTotal += currentTotal;
  });
  $('.sub-total').text(overallTotal.toFixed(2));
  $('#sub_total').val(overallTotal.toFixed(2));
}

$(`#qty1, #cost_per_item1`).on('keyup', function () {
  calculateTotal(1);
  calcDiscount(1);
}); 
$(`#qty1, #cost_per_item1`).on('change', function () {
  calculateTotal(1);
  calcDiscount(1);
});
$('#services_type').on('mouseleave', function () {
  calculateTotal(1);
  calcDiscount(1);
});
$('#multiselect1').on('change', function () {
  calcDiscount(1);
  
  var $select = $(this);
  var selectedOptions = $select.val();
  var sub_total = parseFloat($('#sub_total').val());
  var $taxTable = $('#invoice-taxes tbody');
  $taxTable.empty();
  var totalTax = 0;
  if (selectedOptions && selectedOptions.length > 0 && !isNaN(sub_total)) {
    selectedOptions.forEach(function (optionValue) {
      var $option = $select.find('option[value="' + optionValue + '"]');
      var optionText = $option.data('tax-text');
      var optionRate = $option.data('rate');
      var calc_tax = (sub_total * (optionRate / 100)).toFixed(2);
      console.log("sub_total"+sub_total);
      console.log("optionText"+optionText);
      console.log("optionRate"+optionRate);
      console.log("calc_tax"+calc_tax);
      totalTax += parseFloat(calc_tax);
      var $row = $('<tr>');
      $row.append($('<td>').text(optionText));
      $row.append($('<td>').text(optionRate + '%'));
      $row.append($('<td>').text(calc_tax));
      $taxTable.append($row);
    });
    var calc_tax = 0;
  }

  var newTotal = sub_total + totalTax;
  $('#hidden_total_tax_cal').text(newTotal.toFixed(2));
  $('#hidden_total_taxs').text(totalTax.toFixed(2));
  var when_calc_tax = $('#when_calc_tax').val();
  var discount_amount = $('#discount_amount').text();
  if (when_calc_tax == 0) {
   newTotal =parseFloat(discount_amount) +  parseFloat(newTotal)|| 0;
   $('.total').text(newTotal.toFixed(2));  
   $('#final_total_amt').val(newTotal.toFixed(2));
 } else if (when_calc_tax == 0 && discount_amount > 0) {
     if(discount_amount>0){
   newTotal = parseFloat(newTotal) - parseFloat(discount_amount) || 0;
   $('.total').text(newTotal.toFixed(2));  
   $('#final_total_amt').val(newTotal.toFixed(2));
 }
 }else{
  if(discount_amount>0){
   newTotal = parseFloat(newTotal) - parseFloat(discount_amount) || 0;
   $('.total').text(newTotal.toFixed(2));  
   $('#final_total_amt').val(newTotal.toFixed(2));
 }
}
calcDiscount(1);
});

$('#when_calc_tax').on('change', function () {
  var when_calc_tax = $('#when_calc_tax').val();
  var hidden_total_tax_cal = parseFloat($('#hidden_total_tax_cal').text())|| 0;
  var hidden_total_tax_after_dic = parseFloat($('#hidden_total_tax_after_dic').text())|| 0;
  var sub_total = parseFloat($('#sub_total').val())|| 0;
  if(hidden_total_tax_after_dic==0){
    hidden_total_tax_after_dic = sub_total;
  }
  if(hidden_total_tax_cal==0){
    hidden_total_tax_cal = sub_total;
  }
  if (when_calc_tax == 1) {
    $('.total').text(hidden_total_tax_after_dic.toFixed(2));
    $('#final_total_amt').val(hidden_total_tax_after_dic.toFixed(2));
  } else {
    $('.total').text(hidden_total_tax_cal.toFixed(2));
    $('#final_total_amt').val(hidden_total_tax_cal.toFixed(2));
  }
});
calculateTotal(1); 

$(".append_div").on('change', '[id^="multiselect"]', function () {
  var $select = $(this);
  var selectedOptions = $select.val();
  var sub_total = parseFloat($('#sub_total').val());
  var $taxTable = $('#invoice-taxes tbody');
  $taxTable.empty();
  var totalTax = 0;
  if (selectedOptions && selectedOptions.length > 0 && !isNaN(sub_total)) {
    selectedOptions.forEach(function (optionValue) {
      var $option = $select.find('option[value="' + optionValue + '"]');
      var optionText = $option.data('tax-text');
      var optionRate = $option.data('rate');
      var calc_tax = (sub_total * (optionRate / 100)).toFixed(2);
      console.log("sub_total"+sub_total);
      console.log("optionText"+optionText);
      console.log("optionRate"+optionRate);
      console.log("calc_tax"+calc_tax);
      totalTax += parseFloat(calc_tax);
      var $row = $('<tr>');
      $row.append($('<td>').text(optionText));
      $row.append($('<td>').text(optionRate + '%'));
      $row.append($('<td>').text(calc_tax));
      $taxTable.append($row);
    });
    var calc_tax = 0;
  }

  var newTotal = sub_total + totalTax;
  $('#hidden_total_tax_cal').text(newTotal.toFixed(2));
  $('#hidden_total_taxs').text(totalTax.toFixed(2));
  var when_calc_tax = $('#when_calc_tax').val();
  var discount_amount = $('.discount_amount').text();
  if (when_calc_tax == 0) {
   newTotal = discount_amount+newTotal;
   $('#hidden_total_tax_cal').text(newTotal.toFixed(2));
   $('.total').text(newTotal.toFixed(2));  
   $('#final_total_amt').val(newTotal.toFixed(2));
 }
});


$(".append_div, #services_type").on('keyup mouseleave change', '[id^="qty"], [id^="cost_per_item"] ,[id^="append_div_copy"]', function () {
  var sectionCount = $(this).attr('id').match(/\d+/)[0];
  calculateTotal(sectionCount);
  calcDiscount(sectionCount);
});
$(".card").on('mouseleave', function () {
  var sectionCount = $(this).attr('id').match(/\d+/)[0];
  calculateTotal(sectionCount);
  calcDiscount(sectionCount);
});

function removeSection(button) {
  $(button).closest('.item-row').remove();
  calculateTotal(1);
  calcDiscount(1);
}

$(document).ready(function () {
  function updateHiddenField(index) {
    var editorContentText = $(".full-editor.geteditor").eq(index).html();
    console.log("Editor " + (index + 1) + " Text content: " + editorContentText);
    $('.hidden-field').eq(index).val(editorContentText);
  }
  $(document).on('keyup blur', '.full-editor.geteditor', function () {
    var index = $(".full-editor.geteditor").index(this);
    updateHiddenField(index);
  });
});
$(document).ready(function () {
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
  $('#base_amount').on('keyup', function () {
    handleKeyup();
  });
  $('#gst_vat').on('keyup', function () {
    handleKeyup();
  });
});


// $(`#qty1, #cost_per_item1`).on('mouseover', function () {
//   calculateTotal(1);
//   calcDiscount(1);
// });

// $(".append_div").on('mouseover', '[id^="qty"], [id^="cost_per_item"]', function () {
//   var sectionCount = $(this).attr('id').match(/\d+/)[0];
//   calculateTotal(sectionCount);
//   calcDiscount(sectionCount);
// });
// $(".append_div").on('keyup', '[id^="qty"], [id^="cost_per_item"]', function () {
//   var sectionCount = $(this).attr('id').match(/\d+/)[0];
//   calculateTotal(sectionCount);
//   calcDiscount(sectionCount);
// });
// $(".append_div").on('mouseleave', '[id^="qty"], [id^="cost_per_item"]', function () {
//   var sectionCount = $(this).attr('id').match(/\d+/)[0];
//   calculateTotal(sectionCount);
//   calcDiscount(sectionCount);
// }); 
// $("#services_type").on('mouseleave', '[id^="qty"], [id^="cost_per_item"]', function () {
//   var sectionCount = $(this).attr('id').match(/\d+/)[0];
//   calculateTotal(sectionCount);
//   calcDiscount(sectionCount);
// }); 
// $(".append_div").on('change', '[id^="qty"], [id^="cost_per_item"]', function () {
//   var sectionCount = $(this).attr('id').match(/\d+/)[0];
//   calculateTotal(sectionCount);
//   calcDiscount(sectionCount);
// });
</script>
@endsection