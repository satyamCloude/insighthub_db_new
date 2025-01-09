@extends('layouts.admin')
@section('title', 'Edit')
@section('content')
<style>
 .avatar-upload {
    position: relative;
    max-width: 205px;
    margin: 50px auto;
}

.avatar-upload .avatar-edit {
    position: absolute;
    right: 12px;
    z-index: 1;
    top: 10px;
}

.avatar-upload .avatar-edit input {
    display: none;
}

.avatar-upload .avatar-edit label {
    display: inline-block;
    width: 34px;
    height: 34px;
    margin-bottom: 0;
    border-radius: 100%;
    background: #ffffff;
    border: 1px solid transparent;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
    cursor: pointer;
    font-weight: normal;
    transition: all 0.2s ease-in-out;
}

.avatar-upload .avatar-edit label:hover {
    background: #f1f1f1;
    border-color: #d6d6d6;
}

.avatar-upload .avatar-edit label:after {
    content: "\f040";
    font-family: "FontAwesome";
    color: #757575;
    position: absolute;
    top: 10px;
    left: 0;
    right: 0;
    text-align: center;
    margin: auto;
}

.avatar-upload .avatar-preview {
    width: 192px;
    height: 192px;
    position: relative;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
}

.avatar-upload .avatar-preview > div {
    width: 100%;
    height: 100%;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}
.selected {
    background-color: #f0f0f0; /* Change background color to indicate selection */
    font-weight: bold; /* Change font weight to indicate selection */
}
.dropbtn {
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  background-color: #fff;
  border: 1px solid #dbdade;
  border-radius: 0.375rem;
  border-color: #C9C8CE !important;
  height:40px;
  width:100%;
  text-align:left;
  color:#6f6b7d;
  font-weight:500;
  font-size:16px;
  display:flex;
  justify-content:space-between;
  align-items:center;
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
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: white;
}


.outer:hover{

  background-color:#685dd8 !important;
  color:white !important;

}


.outer{


  background-color: rgba(115, 103, 240, 0.08);
  color: #7367f0;

  border-radius:10px;



}



</style>
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Quotes /</span> Edit</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Edit Detail's</h5>
            <div class="action-btns">
              <a href="{{url('admin/Quotes/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
           <form action="{{url('admin/Quotes/update/'.$Quotes->id)}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
               <div class="row mb-4"> 
                <div class="col-md-2">
                    <h5>1. General Details</h5>
                </div>
                <!-- <div class="col-md-10 d-flex justify-content-end">
                    <a href="#" class="btn rounded-pill btn-primary waves-effect waves-light"><i class="fa-solid fa-download"></i></a>&nbsp;&nbsp;
                    <a href="#" class="btn rounded-pill btn-secondary waves-effect waves-light"><i class="fa-regular fa-file"></i></a>&nbsp;&nbsp;
                    <a href="#" class="btn rounded-pill btn-success waves-effect waves-light"><i class="fa-solid fa-print"></i></a>&nbsp;&nbsp;
                    <a href="#" class="btn rounded-pill btn-info waves-effect waves-light">Invoice</a>
                </div> -->
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="first_name" class="form-label">First name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="first_name" @if($Quotes && $Quotes->first_name) value="{{$Quotes->first_name}}" @endif name="first_name" placeholder="ABC"/>
                </div>
                <div class="col-md-6">
                      <label for="last_name" class="form-label">Last name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="last_name" @if($Quotes && $Quotes->last_name) value="{{$Quotes->last_name}}" @endif name="last_name" placeholder="+ABC"/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="email" class="form-label">Email address <span class="text-danger">*</span></label>
                      <input type="email" class="form-control"  id="email"  @if($Quotes && $Quotes->email) value="{{$Quotes->email}}" @endif name="email" placeholder="name@example.com"/>
                </div>
                <div class="col-md-6">
                      <label for="phone_number" class="form-label">Contact No <span class="text-danger">*</span></label>
                      <input type="number" class="form-control"  id="phone_number" @if($Quotes && $Quotes->phone_number) value="{{$Quotes->phone_number}}" @endif name="phone_number" placeholder="+1234156789"/>
                </div>
              </div>
              <div class="row mb-4"> 
                  <div class="col-md-6">
                      <label for="company_id" class="form-label">Company Name <span class="text-danger">*</span></label>
                     <input type="text" class="form-control"  id="company_id" name="company_id" @if($Quotes && $Quotes->company_id) value="{{$Quotes->company_id}}" @endif placeholder="company name" required/>
                </div>

        <div class="col-md-6 customer_name">
    <label for="customer_name" class="form-label">Customer Name <span class="text-danger">*</span></label>
    <div class="dropdown">
         @php
            // Use the `firstWhere` collection method to find the first client matching the Ticket's ccid
            $client = collect($vendor)->firstWhere('id', $Quotes->customer_name);
    
            // Use null coalescence operator to handle the case when $client is null
           
            $first_name = $client->first_name ?? 'Select Customer';
            $last_name = $client->last_name ?? '';
            $id = $client->id ?? '';
            
        @endphp
        <button  type="button" class="dropbtn" id="selected_customer_btn">{{$first_name}} {{$last_name}}({{$id}})<i class="fa fa-angle-down" style="font-size:24px"></i></button>
        <div class="dropdown-content" style="max-height: 45vh;overflow: auto;">
            
           @foreach($vendor as $vendors)
            <div class="outer" id="customer_{{ $vendors->id }}" style="display:flex;margin:6px;padding:4px;color:black;" onclick="getUserDetails('{{ $vendors->id }}')">
                <div style="border-radius:50%;">
                    <!-- <img src="https://i.pinimg.com/564x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg" style="width:45px;border-radius:50%;height:auto;"> -->
                      @if($vendors->profile_img)
                                                                                                    <img src="{{ $vendors->profile_img }}" style="width:45px;border-radius:50%;height:auto;">

                                                  @else
                                                                                                    <img src="https://i.pinimg.com/564x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg" style="width:45px;border-radius:50%;height:auto;">

                                                  @endif
                </div>
                <div class="sie_cont" style="display:flex;flex-direction:column;margin:5px;">
                    <span>{{ $vendors->first_name }} {{ $vendors->last_name }} ({{ $vendors->id }}) <br/>{{ $vendors->company_name }}</span>
                    <!-- <span>active</span> -->
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <input type="hidden" name="customer_name" id="customer_name" value="{{$id}}">
    <!--  <div class="col-md-6">
                      <label for="customer_name" class="form-label">Customer Name <span class="text-danger">*</span></label>
                      <select name="customer_name" class="form-control select2">
                            <option value="">Select Customer</option>
                            @foreach($vendor as $vendors)
                            <option @if($Quotes && $Quotes->customer_name == $vendors->id) selected @endif value="{{$vendors->id}}">{{$vendors->first_name}}</option>
                            @endforeach
                    </select>
                </div> -->
              
</div>


              </div>
              <hr>
              <h5 class="mb-4">2. Schedule</h5>
              <div class="row mb-4"> 
                <div class="col-md-12">
                      <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" @if($Quotes && $Quotes->subject) value="{{$Quotes->subject}}" @endif name="subject" placeholder="Demo "/>
                </div>
               <!--  <div class="col-md-6">
                      <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                      <select name="status" class="form-control select2" required>
                            <option value="">Select Status</option>
                            <option value="1">Delivered</option>
                            <option value="2">Onhold</option>
                            <option value="3">Accepted</option>
                             <option value="4">Lost</option>
                            <option value="5">Win</option>
                    </select>
                </div> -->
              </div>
              <div class="row mb-4 mt-4 mb-3"> 
                <div class="col-md-6">
                      <label for="date_created" class="form-label">Date Created <span class="text-danger">*</span></label>
                      <input type="date" class="form-control" @if($Quotes && $Quotes->date_created) value="{{$Quotes->date_created}}" @endif name="date_created" placeholder="Demo "/>
                </div>
                <div class="col-md-6 mb-3">
                      <label for="date_created" class="form-label">Valid Until <span class="text-danger">*</span></label>
                      <input type="date" class="form-control" @if($Quotes && $Quotes->valid_until) value="{{$Quotes->valid_until}}" @endif name="valid_until" placeholder="Demo "/>
                </div>
                <!--  <div class="col-md-6 mt-4">
                <label for="product_name" class="form-label">Invoice Number<span class="text-danger">*</span></label>

                <div class="input-group">
                  <div class="input-group-prepend">
                  <input type="text" name="invoice_number1" id="invoice_number1" value="INV#" class="form-control height-35 f-15" readonly>
                  </div>
                    <input type="text" name="invoice_number2" id="invoice_number2" class="form-control height-35 f-15" required autocomplete="off">
                </div>
                <span class="text-danger showinvoice_err"></span>
              </div>
              <div class="col-md-6 mt-4">
                      <label for="signature" class="form-label">Signature <span class="text-danger">*</span></label>
                      <input type="file" class="form-control" name="signature" required/>
                </div>
              </div> -->
              <hr>
              <div class="row d-flex justify-content-between">
              <div class="col-md-2"><h5 class="mb-4">3. Other</h5></div>
              <div class="col-md-2">
                <button type="button" onclick="addMoreFields()" class="btn btn-primary waves-effect waves-light">
                    <i class="ti ti-plus me-1"></i>
                    <span class="align-middle"></span>
                    </button></div>
                  </div>
               @foreach($QuotesCal as $key => $Quot )
              <div class="row newa{{$key+1}} mb-4"> 
                <div class="col-md-2">
                      <label for="qty" class="form-label">Qty <span class="text-danger">*</span></label>
                      <input type="number" class="form-control qty" @if($Quot && $Quot->qty) value="{{$Quot->qty}}" @endif name="qty[]" placeholder="01"/>
                </div>
                <div class="col-md-3">
                      <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                     <textarea class="form-control" id="description" name="description[]" placeholder="...." readonly rows="1">@if($Quot && $Quot->description) {{$Quot->description}} @endif </textarea>
                </div>
                <div class="col-md-2">
                      <label for="unit_price" class="form-label">Unit Price <span class="text-danger">*</span></label>
                      <input type="number"  class="form-control unit_price" @if($Quot && $Quot->unit_price) value="{{$Quot->unit_price}}" @endif id="unit_price" name="unit_price[]" readonly placeholder="01"/>
                </div>
                <div class="col-md-2">
                      <label for="discount" class="form-label">Discount% <span class="text-danger">*</span></label>
                      <input type="number"  class="form-control discount" @if($Quot && $Quot->discount) value="{{$Quot->discount}}" @endif name="discount[]" placeholder="01"/>
                </div>
                  <div class="col-md-1">
                      <label for="total" class="form-label">Tax% <span class="text-danger">*</span></label>
                  <input type="number" class="form-control taxs" name="tax_rate[]"  @if($Quot && $Quot->tax_rate) value="{{$Quot->tax_rate}}" @endif  id="unit_tax" placeholder="0" readonly required/>
                                              <input type="hidden" name="tax[]" id="unit_tax_id"  @if($Quot && $Quot->tax) value="{{$Quot->tax}}" @endif  class="form-control tax"  readonly>

                </div>
                <div class="col-md-2">
                      <label for="total" class="form-label">Total <span class="text-danger">*</span></label>
                      <input type="number"  class="form-control total" @if($Quot && $Quot->total) value="{{$Quot->total}}" @endif readonly name="total[]" placeholder="01"/>
                </div>
                <input type="hidden" id="Products_id1" @if($Quot && $Quot->Products_id) value="{{$Quot->Products_id}}" @endif name="Products_id[]">
                <input type="hidden" id="BillingCycle1" @if($Quot && $Quot->BillingCycle) value="{{$Quot->BillingCycle}}" @endif name="BillingCycle[]">
                <input type="hidden" id="Caltax" @if($Quot && $Quot->BillingCycle) value="{{$Quot->Caltax}}" @endif name="Caltax[]">
                <!-- <div class="col-md-1">
                      <label for="total" class="form-label">Tax <span class="text-danger">*</span></label>
                      <input type="number"  class="form-control" name="total[]" placeholder="01"/>
                </div> -->
                <div class="col-md-1">
                @if($key < 1)
                   <!--  <button type="button" onclick="addMoreFields()" class="btn btn-primary waves-effect waves-light mt-4">
                    <i class="ti ti-plus me-1"></i>
                    <span class="align-middle"></span>
                    </button> -->
                                        <button type="button" class="btn btn-label-danger mt-4 waves-effect" onclick="removeFields(this)"><i class="ti ti-x ti-xs"></i><span class="align-middle"></span></button>

                @else
                    <button type="button" class="btn btn-label-danger mt-4 waves-effect" onclick="removeFields(this)">
                        <i class="ti ti-x ti-xs"></i>
                        <span class="align-middle"></span>
                    </button>
                @endif
                </div>
              </div>
              @endforeach
              <div class="addmoreother"></div>
                            
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('admin/Quotes/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
            </div> 
          </form>
        </div>
      </div>
    </div>
    <!-- /Sticky Actions -->
  </div>
<!-- / Content -->
<!--Modal start-->
<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog">
      <form class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="backDropModalTitle">Product Detail</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
          <div class="col mb-3">
    <label for="product_services" class="form-label">Category <span class="text-danger">*</span></label>
    <select name="category_id" class="form-control select2" id="category_id" required>
        <option value="">Select Category</option>
        @foreach($Category as $Prod)
        <option value="{{$Prod->id}}" data-name="{{$Prod->product_name}}">{{$Prod->product_name}}</option>
        @endforeach
    </select>
</div>
</div>

          <div class="row">
            <div class="col mb-3">
              <label for="product_services" class="form-label">Product <span class="text-danger">*</span></label>
              <select name="Products_id" class="form-control select2 productservices" id="productservices" onchange="get_product_addon(this.value)" required>
                <option value="">Select Products</option>
               
              </select>
            </div>
          </div>
        <div class="row addones" style="display:none">
                  <div class="col mb-3">
                    <label for="addones" class="form-label">Addons <span class="text-danger">*</span></label>
                    <select name="addones" class="form-control select2 addones" id="addones" onchange="get_addon_price(this.value)"  required>
                      <option value="">Select Addons</option>
                     
                    </select>
                  </div>
                </div>

            <div class="row g-2">
            <div class="col mb-3">
              <label for="mod_billing_cycle" class="form-label">Billing Cycle <span class="text-danger">*</span></label>
              <select name="billing_cycle" id="mod_billing_cycle" onchange="mod_billing_cycles(this.value)" class="form-control select2" required>
                <option value="">Select Cycle</option>
                <option value="onetime">One Time</option>
                <option value="hourly">Hourly</option>
                <option value="monthly">Monthly</option>
                <option value="quartely">Quartely</option>
                <option value="semiannually">Semiannually</option>
                <option value="annually">Annually</option>
                <option value="biennially">Biennially</option>
                <option value="triennially">Triennially</option>
              </select>
            </div>
          </div>
          <div class="row g-2">
            <div class="col mb-3">
              <label for="mod_price_unit" class="form-label">Price Unit <span class="text-danger">*</span></label>
              <input type="number" id="mod_price_unit" class="form-control mod_price_unit" name="mod_price_unit" readonly placeholder="Price Unit">
            </div>
          </div>
          <div class="row g-2">
            <div class="col mb-3">
              <label for="mod_description"  class="form-label">Description <span class="text-danger">*</span></label>
              <textarea class="form-control mod_description" id="mod_description" name="mod_description"></textarea>
            </div>
          </div>
            <div class="row g-2">
            <div class="col mb-3">
              <label for="mod_description"  class="form-label">Tax %<span class="text-danger">*</span></label>
               <select  name="taxes[]" id="mod_tax" multiple class="form-control select2">
               @foreach($Tax as $Taxs)
              <option data-rate="{{ $Taxs->rate }}" data-tax-text="{{ $Taxs->tax_name . ':' . $Taxs->rate }}" value="{{$Taxs->id}}">{{ $Taxs->tax_name . ':' . $Taxs->rate }}</option>
              @endforeach
              </select>
            </div>
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">
            Close
          </button>
          <button type="button" id="buttonsubmit" class="btn btn-primary waves-effect waves-light">Save</button>
        </div>
      </form>
    </div>
</div>
<script>
   $(document).ready(function() {
      $('.select2').select2();
$("#category_id").on("change", function(event) {
    var selectedCategoryId = $(this).val();

    if (!selectedCategoryId) {
        alert("Please select a category.");
        return; // Exit the function if no category is selected
    }

    $.ajax({
        url: "{{ url('admin/Quotes/get_categoryProduct') }}",
        method: 'GET',
        data: { selectedCategoryId: selectedCategoryId },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                // Clear existing options in the second dropdown
                $('#productservices').empty();

                // Check if data is not empty
                if (response.data.length > 0) {
                    // Populate options in the second dropdown based on the retrieved data
                  $.each(response.data, function(index, product) {
                    $('#productservices').append($('<option>', {
                        value: product.id,
                        text: product.product_name
                    }));
                });

                    // Trigger select2 refresh after updating options
                    $('#productservices').trigger('change');
                } else {
                    // If data is empty, display a message or take appropriate action
                    console.log("No products found for the selected category.");
                }
            } else {
                // If the response indicates failure, handle it accordingly
                console.log("Failed to retrieve products. Status: " + response.status);
            }
        },
        error: function (xhr, status, error) {
            // Handle error if necessary
            console.error("Error:", error);
        }
    });
});

   });

var modalCounter = 2;
var appendedRows = []; // Initialize an array to store appended row states

function mod_billing_cycles(value) {
    var productid = $('#productservices').val(); // Get the selected product ID
    var addones = $('#addones').val() || 0; // Get the selected addon ID, default to 0 if not selected
    var cycleid = value;
// alert(cycleid);
    $.ajax({
        url: "{{ url('admin/Quotes/get_productdata') }}",
        method: 'GET',
        data: { product_id: productid, addones: addones, billing_cycle: cycleid },
        dataType: 'json',
        success: function (data) {
          console.log(data);
            $('.mod_price_unit').val(data.data.price);
            $('.mod_description').val(data.data.product_description);

            // Iterate through each tax option
            $('#mod_tax option').each(function() {
                var taxRate = $(this).data('rate');
                if (taxRate == data.data.tax) {
                    $(this).prop('selected', true); // Select the option if the tax rate matches
                } else {
                    $(this).prop('selected', false); // Deselect the option if the tax rate doesn't match
                }
            });

            // Trigger select2 refresh after updating selections
            $('#mod_tax').trigger('change');
        },
        error: function (xhr, status, error) {
            // Handle error if necessary
            console.error("Error:", error);
        }
    });
}

function get_addon_price(value) {
    var productid = $('#productservices').val(); // Get the selected product ID
    var addones = $('#addones').val() || 0; // Get the selected addon ID, default to 0 if not selected
    var cycleid = $('#mod_billing_cycle').val() || 1; // Get the selected addon ID, default to 0 if not selected
    // alert(cycleid);
    $.ajax({
        url: "{{ url('admin/Quotes/get_productdata') }}",
        method: 'GET',
        data: { product_id: productid, addones: addones, billing_cycle: cycleid },
        dataType: 'json',
        success: function (data) {
          console.log(data);
            $('.mod_price_unit').val(data.data.price);
            $('.mod_description').val(data.data.product_description);

            // Iterate through each tax option
            $('#mod_tax option').each(function() {
                var taxRate = $(this).data('rate');
                if (taxRate == data.data.tax) {
                    $(this).prop('selected', true); // Select the option if the tax rate matches
                } else {
                    $(this).prop('selected', false); // Deselect the option if the tax rate doesn't match
                }
            });

            // Trigger select2 refresh after updating selections
            $('#mod_tax').trigger('change');
        },
        error: function (xhr, status, error) {
            // Handle error if necessary
            console.error("Error:", error);
        }
    });
}
function get_product_addon(value) {
    var productid = $('#productservices').val(); // Get the selected product ID
    $.ajax({
        url: "{{ url('admin/Quotes/get_product_addon') }}",
        method: 'GET',
        data: { product_id: productid },
        dataType: 'json',
        success: function (data) {
            
            $('#addones').empty();
            
            // Append new options based on received data
            $.each(data.data, function(index, item) {
                $('#addones').append('<option value="">Select Addons</option>');
                $('#addones').append('<option value="' + item.id + '">' + item.product_name + '</option>');
            });
            
            // Show the select element
            $('.addones').css('display', 'block');
        },
        error: function (xhr, status, error) {
            // Handle error if necessary
            console.error("Error:", error);
        }
    });
}


function calculateTotal(row) {
    var qty = parseFloat(row.find('.qty').val()) || 0;
    var unitPrice = parseFloat(row.find('.unit_price').val()) || 0;
    var discount = parseFloat(row.find('.discount').val()) || 0;
    var taxRate = parseFloat(row.find('.taxs').val()) || 0; // Get the tax rate from the input field

    // Calculate total amount without tax
    var totalWithoutTax = qty * unitPrice * (1 - discount / 100);

    // Calculate total tax amount
    var totalTax = totalWithoutTax * taxRate / 100;

    // Calculate total amount including tax
    var totalWithTax = totalWithoutTax + totalTax;

    // Set the calculated total amount with tax in the corresponding input field
    row.find('.total').val(totalWithTax.toFixed(2));

    // Set the calculated total tax amount in the tax input field
    row.find('.tax').val(totalTax.toFixed(2));
}



$("#buttonsubmit").click(function () {
    var mod_price_unit = $("#mod_price_unit").val();
    var mod_description = $('#mod_description').val();
    var modTaxVal = $("#mod_tax").val();
  var productid = $('#productservices').val(); // Get the selected product ID
    var addones = $('#addones').val() || 0; // Get the selected addon ID, default to 0 if not selected
    var cycleid = $('#mod_billing_cycle').val() || 1; // Get the selected addon ID, default to 0 if not selected]
    var Products_id1 = $('#Products_id1').val(); // Get the selected addon ID, default to 0 if not selected]
    var BillingCycle1 = $('#BillingCycle1').val(); // Get the selected addon ID, default to 0 if not selected]
 if(addones != 0 && Products_id1 == 0){
      $('#Products_id1').val(addones);
    }else{
            $('#Products_id1').val(productid);

    }
    if(BillingCycle1 == 0 || BillingCycle1 == 1 || BillingCycle1 == ''){
            $('#BillingCycle1').val(cycleid);
          }
    var modTaxrate = 0;
    $("#mod_tax option:selected").each(function() {
        var rate = parseFloat($(this).attr('data-rate'));
        modTaxrate += rate;
    });
    // alert(modTaxrate);
    var unitVal = $("#unit_price").val();
    var lastAppendedRowClass = '.newa' + (modalCounter - 1);

    var lastAppendedRowUnitPrice = $(lastAppendedRowClass + ' input[name="unit_price[]"]').val();

    if (lastAppendedRowUnitPrice == '' || unitVal == '') {
        $('#description').val(mod_description);
        $('#unit_price').val(mod_price_unit);
        $('#unit_tax').val(modTaxrate);
        $('#unit_tax_id').val(modTaxVal);
    } else {
        addNewRow(mod_price_unit, mod_description, productid,cycleid, modTaxVal, modTaxrate);
    }

    // Close the current modal
    this.form.reset();
    $('#backDropModal').modal('hide');
});

function addMoreFields() {
    $('#backDropModal').modal('show');
}

function addNewRow(mod_price_unit, mod_description, productservices, mod_billing_cycle, mod_tax, modTaxrate) {
    var newRow = '<div class="row newa' + (modalCounter++) + ' mb-4">' +
        '<div class="col-md-2">' +
        '<label for="qty" class="form-label">Qty <span class="text-danger">*</span></label>' +
        '<input type="number" class="form-control qty"  name="qty[]" placeholder="01" required/>' +
        '</div>' +
        '<div class="col-md-3">' +
        '<label for="description" class="form-label">Description <span class="text-danger">*</span></label>' +
        '<textarea class="form-control" readonly name="description[]" placeholder="...." rows="1" required>'+mod_description+'</textarea>' +
        '</div>' +
        '<input type="hidden" id="Products_id" value="'+productservices+'" name="Products_id[]">' +
        '<input type="hidden" id="BillingCycle" value="'+mod_billing_cycle+'" name="BillingCycle[]">' +
        '<input type="hidden" id="Caltax" value="'+mod_tax+'" name="Caltax[]">' +
        '<div class="col-md-2">' +
        '<label for="unit_price" class="form-label">Unit Price <span class="text-danger">*</span></label>' +
        '<input type="number" readonly class="form-control unit_price" value="'+mod_price_unit+'" name="unit_price[]" placeholder="01" required/>' +
        '</div>' +
        '<div class="col-md-2">' +
        '<label for="discount" class="form-label">Discount% <span class="text-danger">*</span></label>' +
        '<input type="number" class="form-control discount" name="discount[]" placeholder="01" required/>' +
        '</div>' +
        '<div class="col-md-2">' +
        '<label for="total" class="form-label">Tax% <span class="text-danger">*</span></label>' +
        '<input type="number" class="form-control taxs" name="tax_rate[]" id="unit_tax" placeholder="0" readonly required value="' + modTaxrate + '">' +
        '<input type="hidden" id="unit_tax_id" class="form-control tax" name="tax[]" readonly value="' + mod_tax + '">' +
        '</div>' +
        '<div class="col-md-2">' +
        '<label for="total" class="form-label">Total <span class="text-danger">*</span></label>' +
        '<input type="number" class="form-control total" name="total[]" placeholder="01" readonly required/>' +
        '</div>' +
        '<div class="col-md-1">' +
        '<button type="button" class="btn btn-label-danger mt-4 waves-effect" onclick="removeFields(this)">' +
        '<i class="ti ti-x ti-xs"></i>' +
        '<span class="align-middle"></span>' +
        '</button>' +
        '</div>' +
        '</div>';

      // Append the new row to the container
    $('.addmoreother').append(newRow);

    // Save the reference to the appended row
    appendedRows.push($('.addmoreother .row').last());

    // Calculate and set the total for the newly added row
    calculateTotal($('.addmoreother .row').last());
    
    // Attach event listeners for calculation when quantity or discount changes
    attachEventListeners();
}
function removeFields(button) {
    $(button).closest('.row').remove();

    // Remove the reference to the removed row from the array
    appendedRows.pop();
}
function getUserDetails(id) {
    $.ajax({
        type: 'GET',
        url: "{{url('admin/getUserDetails')}}",
        data: {
            id: id,
        },
        success: function (res) {
            var responseObject = JSON.parse(res);
                          console.log(responseObject);

            if (responseObject.status === true) {
                $('#customer_name').val(id);
                $('#first_name').val(responseObject.first_name);
                $('#last_name').val(responseObject.last_name);
                $('#email').val(responseObject.email);
                $('#phone_number').val(responseObject.phone_number);
                $('#company_id').val(responseObject.company_name);
                
                // Update the button text with the selected customer's name
                $('#selected_customer_btn').text(responseObject.first_name + ' ' + responseObject.last_name);
            } else {
                $('.showinvoice_err').text(responseObject.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ' + error);
        },
    });
}

function attachEventListeners() {
    // Iterate through the appended rows and attach event listeners
    appendedRows.forEach(function (row) {
        var qtyInput = row.find('.qty');
        var unitPriceInput = row.find('.unit_price');
        var discountInput = row.find('.discount');
        var totalInput = row.find('.total');

        // Attach event listener for quantity change
        qtyInput.on('input', function () {
            calculateTotal(row);
        });

        // Attach event listener for unit price change
        unitPriceInput.on('input', function () {
            calculateTotal(row);
        });

        // Attach event listener for discount change
        discountInput.on('input', function () {
            calculateTotal(row);
        });
    });
}
$(".qty, .discount, .tax").on('input', function () {
    var qty = parseFloat($('.qty').val()) || 0;
    var price_unit = parseFloat($('.unit_price').val()) || 0;
    var discount = parseFloat($('.discount').val()) || 0;
    var unit_tax = parseFloat($('.tax').val()) || 0;
    
    // Calculate total without tax
    var totalWithoutTax = qty * price_unit * (1 - discount / 100);
    
    // Calculate total tax amount
    var totalTax = totalWithoutTax * unit_tax / 100;
    
    // Calculate total including tax
    var totalWithTax = totalWithoutTax + totalTax;
    
    $('.total').val(totalWithTax.toFixed(2));
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
            console.log(res);

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
$('#newCustomer').click(function(){
$('#first_name').val('');
$('#last_name').val('');
$('#email').val('');
$('#phone_number').val('');
$('#company_id').val('');
 $('.customer_name').hide('10000');
});
$('#oldCustomer').click(function(){
$('.customer_name').show('10000');
});


</script>



@endsection