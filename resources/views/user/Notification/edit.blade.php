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
                      <input type="text" class="form-control" @if($Quotes && $Quotes->first_name) value="{{$Quotes->first_name}}" @endif name="first_name" placeholder="ABC"/>
                </div>
                <div class="col-md-6">
                      <label for="last_name" class="form-label">Last name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" @if($Quotes && $Quotes->last_name) value="{{$Quotes->last_name}}" @endif name="last_name" placeholder="+ABC"/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="email" class="form-label">Email address <span class="text-danger">*</span></label>
                      <input type="email" class="form-control" @if($Quotes && $Quotes->email) value="{{$Quotes->email}}" @endif name="email" placeholder="name@example.com"/>
                </div>
                <div class="col-md-6">
                      <label for="phone_number" class="form-label">Contact No <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" @if($Quotes && $Quotes->phone_number) value="{{$Quotes->phone_number}}" @endif name="phone_number" placeholder="+1234156789"/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="customer_name" class="form-label">Customer Name <span class="text-danger">*</span></label>
                      <select name="customer_name" class="form-select">
                            <option value="">Select Customer</option>
                            @foreach($vendor as $vendors)
                            <option @if($Quotes && $Quotes->customer_name == $vendors->id) selected @endif value="{{$vendors->id}}">{{$vendors->first_name}}</option>
                            @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                      <label for="company_id" class="form-label">Company Name <span class="text-danger">*</span></label>
                      <select name="company_id" class="form-select" required>
                            @foreach($Company as $Company)
                            <option  @if($Quotes && $Quotes->company_id ==  $Company->id) selected @endif value="{{$Company->id}}">{{$Company->company_name}}</option>
                            @endforeach
                    </select>
                </div>
              </div>
              <hr>
              <h5 class="mb-4">2. Schedule</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" @if($Quotes && $Quotes->subject) value="{{$Quotes->subject}}" @endif name="subject" placeholder="Demo "/>
                </div>
                <div class="col-md-6">
                      <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                      <select name="status" class="form-select">
                            <option value="">Select Status</option>
                            <option @if($Quotes && $Quotes->status == "1") selected @endif value="1">Delivered</option>
                            <option @if($Quotes && $Quotes->status == "2") selected @endif value="2">Onhold</option>
                            <option @if($Quotes && $Quotes->status == "3") selected @endif value="3">Accepted</option>
                            <option @if($Quotes && $Quotes->status == "4") selected @endif value="4">Lost</option>
                            <option @if($Quotes && $Quotes->status == "5") selected @endif value="5">Win</option>
                    </select>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="date_created" class="form-label">Date Created <span class="text-danger">*</span></label>
                      <input type="date" class="form-control" @if($Quotes && $Quotes->date_created) value="{{$Quotes->date_created}}" @endif name="date_created" placeholder="Demo "/>
                </div>
                <div class="col-md-6">
                      <label for="date_created" class="form-label">Valid Until <span class="text-danger">*</span></label>
                      <input type="date" class="form-control" @if($Quotes && $Quotes->valid_until) value="{{$Quotes->valid_until}}" @endif name="valid_until" placeholder="Demo "/>
                </div>
                 <div class="col-md-6 mt-4">
                <label for="product_name" class="form-label">Invoice Number<span class="text-danger">*</span></label>

                <div class="input-group">
                  <div class="input-group-prepend">
                  <input type="text" name="invoice_number1" id="invoice_number1" value="INV#" class="form-control height-35 f-15" readonly>
                  </div>
                    <input type="text" name="invoice_number2" id="invoice_number2" @if($Quotes && $Quotes->invoice_number2) value="{{$Quotes->invoice_number2}}" @endif class="form-control height-35 f-15" readonly autocomplete="off">
                </div>
                <span class="text-danger showinvoice_err"></span>
              </div>
              </div>
              <hr>
              <h5 class="mb-4">3. Other</h5>
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
                <div class="col-md-2">
                      <label for="total" class="form-label">Total <span class="text-danger">*</span></label>
                      <input type="number"  class="form-control total" @if($Quot && $Quot->total) value="{{$Quot->total}}" @endif readonly name="total[]" placeholder="01"/>
                </div>
                <input type="hidden" id="Products_id" @if($Quot && $Quot->Products_id) value="{{$Quot->Products_id}}" @endif name="Products_id[]">
                <input type="hidden" id="BillingCycle" @if($Quot && $Quot->BillingCycle) value="{{$Quot->BillingCycle}}" @endif name="BillingCycle[]">
                <input type="hidden" id="Caltax" @if($Quot && $Quot->BillingCycle) value="{{$Quot->Caltax}}" @endif name="Caltax[]">
                <!-- <div class="col-md-1">
                      <label for="total" class="form-label">Tax <span class="text-danger">*</span></label>
                      <input type="number"  class="form-control" name="total[]" placeholder="01"/>
                </div> -->
                <div class="col-md-1">
                @if($key < 1)
                    <button type="button" onclick="addMoreFields()" class="btn btn-primary waves-effect waves-light mt-4">
                    <i class="ti ti-plus me-1"></i>
                    <span class="align-middle"></span>
                    </button>
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
              <label for="product_services" class="form-label">Products <span class="text-danger">*</span></label>
              <select name="mod_product_services" class="form-select" id="productservices">
                <option value="">Select Products</option>
                @foreach($Products as $Prod)
                <option value="{{$Prod->id}}">{{$Prod->product_name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row g-2">
            <div class="col mb-3">
              <label for="mod_billing_cycle" class="form-label">Billing Cycle <span class="text-danger">*</span></label>
              <select name="mod_billing_cycle" id="mod_billing_cycle" class="form-select">
                <option value="">Select Cycle</option>
                <option value="one_time">One Time</option>
                <option value="hourly">Hourly</option>
                <option value="monthly">Monthly</option>
                <option value="quartely">Quartely</option>
                <option value="semi_annually">Semi-Annually</option>
                <option value="yearly">Annually</option>
                <option value="annually">Biennially</option>
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
              <textarea class="form-control" id="mod_description" name="mod_description"></textarea>
            </div>
          </div>
          <div class="row g-2">
            <div class="col mb-3">
              <label for="mod_description"  class="form-label">Tax <span class="text-danger">*</span></label>
               <select  name="taxes[]" id="mod_tax" multiple class="form-select select2">
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
<!--Modal End-->
<script>
var modalCounter = 2;
var appendedRows = []; // Initialize an array to store appended row states

$("#mod_billing_cycle").change(function () {
    var productid = $("#productservices").val();
    var cycleid = $('#mod_billing_cycle').val();
    $.ajax({
        url: "{{ url('admin/Quotes/get_productdata') }}",
        method: 'GET',
        data: { product_id: productid, billing_cycle: cycleid },
        dataType: 'json',
        success: function (data) {
            $('.mod_price_unit').val(data.data.unit);
        },
        error: function () {
        }
    });
});


function calculateTotal(row) {
    var qty = parseFloat(row.find('.qty').val()) || 0;
    var unitPrice = parseFloat(row.find('.unit_price').val()) || 0;
    var discount = parseFloat(row.find('.discount').val()) || 0;

    var total = qty * unitPrice * (1 - discount / 100);

    row.find('.total').val(total.toFixed(2));
}

$("#buttonsubmit").click(function () {
    var mod_price_unit = $("#mod_price_unit").val();
    var mod_description = $('#mod_description').val();
    var productservices = $('#productservices').val();
    var mod_billing_cycle = $('#mod_billing_cycle').val();
    var mod_tax = $('#mod_tax').val();

    var unitVal = $("#unit_price").val();

    // Construct the class name of the last appended row
    var lastAppendedRowClass = '.newa' + (modalCounter - 1);

    // Get the value of the unit_price input in the last appended row
    var lastAppendedRowUnitPrice = $(lastAppendedRowClass + ' input[name="unit_price[]"]').val();

    if (lastAppendedRowUnitPrice == '' || unitVal == '') {
        // If either the last appended row or the current input is empty, open the modal
        // $('#backDropModal').modal('show');
        $('#description').val(mod_description);
        $('#unit_price').val(mod_price_unit);
        $('#Products_id').val(productservices);
        $('#BillingCycle').val(mod_billing_cycle);
        $('#Caltax').val(mod_tax);
    } else {
        addNewRow(mod_price_unit, mod_description ,productservices,mod_billing_cycle,mod_tax);
    }

    // Close the current modal
    $('#backDropModal').modal('hide');

    this.form.reset();
});

function addMoreFields() {
    $('#backDropModal').modal('show');
}

function addNewRow(mod_price_unit, mod_description,productservices,mod_billing_cycle,mod_tax) {
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

// Additional calculation for beginner inputs
$(".qty, .discount").on('input', function () {
    var qty = $('.qty').val();
    var price_unit = $('.unit_price').val();
    var discount = $('.discount').val();
    var total = qty * price_unit * (1 - discount / 100);
    $('.total').val(total.toFixed(2));
});


</script>

@endsection