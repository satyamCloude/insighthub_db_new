@extends('layouts.admin')
@section('title', 'Inventory')
@section('content')

<style>

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
              <a href="{{url('Employee/Inventory/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('Employee/Inventory/update/'.$Inventory->id)}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. Company Details</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="product_name" class="form-label">Product Name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" @if($Inventory && $Inventory->product_name) value="{{$Inventory->product_name}}" @endif name="product_name" required/>
                </div>
                <div class="col-md-6">
                      <label for="product_code" class="form-label">Product Code <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" @if($Inventory && $Inventory->product_code) value="{{$Inventory->product_code}}" @endif name="product_code" required/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="brand_name" class="form-label">Brand Name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" @if($Inventory && $Inventory->brand_name) value="{{$Inventory->brand_name}}" @endif name="brand_name" required/>
                </div>
                <div class="col-md-6">
                      <label for="phone_number" class="form-label">Contact No <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" @if($Inventory && $Inventory->phone_number) value="{{$Inventory->phone_number}}" @endif name="phone_number"  required/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="purchase_date" class="form-label">Purchase Date <span class="text-danger">*</span></label>
                      <input type="date" class="form-control" @if($Inventory && $Inventory->purchase_date) value="{{$Inventory->purchase_date}}" @endif name="purchase_date" required/>
                </div>
                <div class="col-md-6">
                      <label for="warranty_expiry" class="form-label">Warranty Expiry <span class="text-danger">*</span></label>
                      <input type="date" class="form-control" @if($Inventory && $Inventory->warranty_expiry) value="{{$Inventory->warranty_expiry}}" @endif name="warranty_expiry"  required/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="base_amount" class="form-label">Base Amount <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" id="base_amount" @if($Inventory && $Inventory->base_amount) value="{{$Inventory->base_amount}}" @endif name="base_amount" required/>
                </div>
                <div class="col-md-3">
                      <label for="gst_vat" class="form-label">GST/VAT(%) <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" id="gst_vat" @if($Inventory && $Inventory->gst_vat) value="{{$Inventory->gst_vat}}" @endif name="gst_vat"  required/>
                </div>
                <div class="col-md-3">
                      <label for="tax_amount" class="form-label">Tax Amount <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" id="tax_amount" @if($Inventory && $Inventory->tax_amount) value="{{$Inventory->tax_amount}}" @endif name="tax_amount" readonly  required/>
                </div>
                <div class="col-md-3">
                      <label for="total_amount" class="form-label">Total Amount <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" id="total_amount" @if($Inventory && $Inventory->total_amount) value="{{$Inventory->total_amount}}" @endif name="total_amount" readonly/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="assigned_to_id"  class="form-label">Assigned To</label>
                      <select class="form-select" name="assigned_to_id" required>
                          @foreach($Employee as $emp)
                          <option  @if($Inventory && $Inventory->assigned_to_id == $emp->id) selected @endif value="{{$emp->id}}">{{$emp->first_name}}</option>
                          @endforeach
                      </select>
                </div> 
                <div class="col-md-6">
                      <label for="Vendor_id"  class="form-label">Vendor</label>
                      <select class="form-select" name="Vendor_id" required>
                          @foreach($Vendor as $Vendor)
                          <option @if($Inventory && $Inventory->Vendor_id == $Vendor->id) selected @endif value="{{$Vendor->id}}">{{$Vendor->first_name}}</option>
                          @endforeach
                      </select>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-12">
                      <label for="bill_attachment"  class="form-label">Bill Attachment</label>  <a type="button" href="{{$Inventory->bill_attachment}}"><i class="fa-solid fa-download"></i></a>
                      <input type="file" class="form-control" @if($Inventory && $Inventory->bill_attachment) value="{{$Inventory->bill_attachment}}" @endif name="bill_attachment"/>
                </div> 
              </div>
              <div class="row mb-4"> 
                <div class="col-md-12">
                      <label for="product_description"  class="form-label">Product Description</label>
                      <div class="editor-container">
                        <div class="full-editor geteditor">@if($Inventory && $Inventory->product_description) {!! $Inventory->product_description !!} @endif</div>
                        <input type="hidden" @if($Inventory && $Inventory->product_description) value="{{$Inventory->product_description}}" @endif name="product_description" class="hidden-field">
                      </div>
                </div> 
              </div>
               
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('Employee/Inventory/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
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
          url: "{{url('Employee/Invoices/getClientDetails')}}/"+id,
          
          success: function(res) {
            console.log(res);// Make sure to adjust this based on your actual Select2 initialization method
            // alert(res.data.address_1 );
            $('#shipping_address').val(res.data.address_1 +', '+ res.data.address_2);
          },
        });
  }
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