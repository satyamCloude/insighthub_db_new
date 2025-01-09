
<!-- Sticky Actions -->
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
        <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
        <div>
         <button type="button" onclick="Tab(value)" value="ServiceAutomation" class="btn btn-primary">Back</button>
       </div>
     </div>
     <form action="{{url('admin/Product/store')}}" method="post" enctype="multipart/form-data"> 
      @csrf
      <div class="card-body">
        <h5 class="mb-4">1. General Details</h5>
        <div class="row mb-4"> 
          <div class="col-md-6">
            <label for="product_type_id" class="form-label">Product Type <span class="text-danger">*</span></label>
            <select name="product_type_id" class="form-control select2" required>
              <option value="">Select Type</option>
              @foreach($Productype as $Product)
              <option value="{{$Product->id}}">{{$Product->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
            <select name="category_id" class="form-control select2" required>
              <option value="">Select Category</option>
              @foreach($Category as $Cate)
              <option value="{{$Cate->id}}">{{$Cate->category_name}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row mb-4"> 
          <div class="col-md-6">
            <label for="product_name" class="form-label">Product Name <span class="text-danger">*</span></label>
            <input type="text" id="product_name" class="form-control" name="product_name" placeholder="ABC" required/>
          </div>
          <div class="col-md-6">
            <label for="product_tag_line" class="form-label">Product Tag Line <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="product_tag_line" placeholder="ABC" required/>
          </div>
              <!--   <div class="col-md-6">
                      <label for="url"  class="form-label">Url <span class="text-danger">*</span></label>
                      <input type="text" readonly id="url" class="form-control" value="{{ url('/') }}" name="url" placeholder="https://www.google.com/">
                    </div> -->
                  </div>  
                  <div class="row mb-4"> 

               <!--  <div class="col-md-6">
                      <label for="tax"  class="form-label">Tax <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" name="tax"  placeholder="ABC" required/>
                    </div> -->
                  </div>
                  <div class="row mb-4"> 
                   <div class="col-md-3">
                    <label for="payment_method"  class="form-label">Payment Method <span class="text-danger">*</span></label>
                    <select name="payment_method" class="form-control select2" required>
                      <option value="">Select Method</option>
                      @foreach($PaymentMethod as $Method)
                      <option value="{{$Method->id}}">{{$Method->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label for="display_on_frontend"  class="form-label">Display on frontend </label><br>
                    <input type="checkbox" name="display_on_frontend"/>
                  </div> 
                   <div class="col-md-3">
                    <label for="display_on_frontend"  class="form-label">Addons</label><br>
                    <input type="checkbox" name="Addons" data-bs-toggle="modal" data-bs-target="#AddOnProduct"/>
                   
                  </div>
                  <div class="col-md-3">
                    <label for="product_image"  class="form-label">Product Image <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="product_image"/>
                  </div>
                </div>
                <div class="row mb-4"> 
                 <div class="col-md-12">
                  <label for="description"  class="form-label">Product Description <span class="text-danger">*</span></label>
                  <textarea name="description" id="description" class="form-control"></textarea>
                </div>
              </div>
              <hr>
              <h5 class="mb-4">2. Pricing</h5>
              <div class="row mb-4"> 
                <div class="col-md-2">
                  <label for="payment_type"  class="form-label">Payment Type <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-3">
                  <label for="free"class="form-label"><input type="radio" onclick="free()" name="payment_type" value="1" />&nbsp;&nbsp;Free</label>
                </div>
                <div class="col-md-3">
                  <label for="one_time"class="form-label"><input type="radio" onclick="onetime()" name="payment_type" value="2" />&nbsp;&nbsp;One Time</label>
                </div>
                <div class="col-md-3">
                  <label for="recurring"class="form-label"><input type="radio" onclick="recurring()" name="payment_type" value="3" />&nbsp;&nbsp;Recurring</label>
                </div>
              </div>
              <div class="mb-4 paymenttype"></div>                
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <button type="button" onclick="Tab(value)" value="ServiceAutomation"class="btn btn-outline-danger">Discard</button>
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

    <!-- Add On Product Modal -->
    <div class="modal fade" id="AddOnProduct" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-simple modal-edit-user">
        <div class="modal-content p-3 p-md-5">
          <div class="modal-body">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="text-center mb-4">
              <h3 class="mb-2">Add On Product Info</h3>
            </div>
            <form action="{{url('admin/Product/storeAddOnProduct')}}" class="row g-3">

              <div class="col-12">
                <label class="form-label">Add On Product Name</label>
                <select id="product_name" class="form-control" name="product_name" placeholder="ABC" required/>
                @foreach($createdProducts as $createdProduct)
                <option value="{{$createdProduct->id}}">{{ucfist($createdProduct->name)}}</option>
                @endforeach
              </select>
              </div>
              <div class="col-12">
                <label class="form-label">Product Name</label>
                <input type="text" id="product_name" class="form-control" name="product_name[]" placeholder="ABC" required/>
              </div>
              
              <div class="col-12">
                <label class="form-label">Product Description</label>
                <textarea name="description[]" id="descriptions" class="form-control"></textarea>
              </div>
              <div class="col-12">
                <label class="form-label" for="modalEditUserName">Pricing</label>
              <div class="row mb-3"> 
                <div class="col-md-2">
                  <label for="payment_type"  class="form-label">Payment Type</label>
                </div>
                <div class="col-md-3">
                  <label for="free"class="form-label"><input type="radio" onclick="free()" checked name="payment_type[]" value="1" />&nbsp;&nbsp;Free</label>
                </div>
                <div class="col-md-3">
                  <label for="one_time"class="form-label"><input type="radio" onclick="onetime()" name="payment_type[]" value="2" />&nbsp;&nbsp;One Time</label>
                </div>
                <div class="col-md-3">
                  <label for="recurring"class="form-label"><input type="radio" onclick="recurring()" name="payment_type[]" value="3" />&nbsp;&nbsp;Recurring</label>
                </div>
              </div>
              </div>
            <div id="AppendProduct">
              
      
            </div>
            <div class="AppendProduct" style="text-align: end;">
          <button type="button"  class="btn btn-success me-sm-3 me-1 add">Add</button>
          <button type="button" class="btn btn-danger remove">Remove</button>
      </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
      </div>
    </form>
  </div>
</div>
</div>
</div>
<!--/ Add On Product Modal -->
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    CKEDITOR.replace('description', {
      extraPlugins: 'scayt',
      scayt_autoStartup: true,
    });
  });
  $(document).ready(function() {
    CKEDITOR.replace('descriptions', {
      extraPlugins: 'scayt',
      scayt_autoStartup: true,
    });
  });
</script>
<script>
  $(document).ready(function () {
    $('#product_name').on('input', function () {
                // Get the value of the category_name input
      var categoryNameValue = $(this).val();

                // Update the value of the url input with the base URL and the category name
      $('#url').val("{{ url('/') }}" + '/' + categoryNameValue);
    });
  });
</script>
<script>
 function free() {
  $('.paymenttype').html('');
}

function onetime() {
  $('.paymenttype').html('<div class="row">' +
    '<div class="col-md-2 bg-success">' +
    '<label for="Currency" class="form-label">Currency</label>' +
    '</div>' +
    '<div class="col-md-2 bg-success">' +
    '<label for="One Time" class="form-label">One Time</label>' +
    '</div>' +
    '</div>' +
    '<div class="row mt-3">' +
    '<div class="col-md-2">' +
    ' <label for="INR "class="form-label mt-3">INR</label>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="onetime_inr"  placeholder="₹" required/>' +
    '</div>' +
    '</div>' +
    ' <div class="row mt-3">' +
    '<div class="col-md-2">' +
    '<label for="USD" class="form-label mt-3">USD</label>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="onetime_usd"  placeholder="$" required/>' +
    '</div>' +
    '</div>');
}

function recurring() {
  $('.paymenttype').html(' <div class="row">' +
    '<div class="col-md-1 bg-success">' +
    ' <label for="Currency"class="form-label">Currency</label>' +
    '</div>' +
    ' <div class="col-md-1 bg-success">' +
    ' <label for="Hourly"class="form-label">Hourly</label>' +
    '</div>' +
    '<div class="col-md-1 bg-success">' +
    ' <label for="Monthly"class="form-label">Monthly</label>' +
    '</div>' +
    '<div class="col-md-1 bg-success">' +
    '<label for="Quartely"class="form-label">Quartely</label>' +
    '</div>' +
    '<div class="col-md-2 bg-success">' +
    '<label for="Semi-Annually"class="form-label">Semi-Annually</label>' +
    '</div>' +
    '<div class="col-md-2 bg-success">' +
    '<label for="Annually"class="form-label">Annually</label>' +
    '</div>' +
    '<div class="col-md-2 bg-success">' +
    '<label for="Biennially"class="form-label">Biennially</label>' +
    '</div>' +
    '<div class="col-md-2 bg-success">' +
    '<label for="Triennially"class="form-label">Triennially</label>' +
    '</div>' +
    '</div>' +
    '<div class="row mt-3">' +
    '<div class="col-md-1">' +
    '<label for="INR "class="form-label mt-3">INR</label>' +
    '</div>' +
    '<div class="col-md-1">' +
    '<input type="number" class="form-control" name="recurr_inr_hourly"  placeholder="₹" required/>' +
    '</div>' +
    '<div class="col-md-1">' +
    '<input type="number" class="form-control" name="recurr_inr_monthly"  placeholder="₹" required/>' +
    '</div>' +
    '<div class="col-md-1">' +
    '<input type="number" class="form-control" name="recurr_inr_quartely"  placeholder="₹" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="recurr_inr_semiannually"  placeholder="₹" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="recurr_inr_annually"  placeholder="₹" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="recurr_inr_biennially"  placeholder="₹" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="recurr_inr_triennially"  placeholder="₹" required/>' +
    '</div>' +
    '</div>' +
    '<div class="row mt-3">' +
    ' <div class="col-md-1">' +
    '  <label for="USD "class="form-label mt-3">USD</label>' +
    ' </div>' +
    ' <div class="col-md-1">' +
    '  <input type="number" class="form-control" name="recurr_usd_hourly"  placeholder="$" required/>' +
    ' </div>' +
    ' <div class="col-md-1">' +
    ' <input type="number" class="form-control" name="recurr_usd_monthly"  placeholder="$" required/>' +
    '</div>' +
    '<div class="col-md-1">' +
    '  <input type="number" class="form-control" name="recurr_usd_quartely"  placeholder="$" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    ' <input type="number" class="form-control" name="recurr_usd_semiannually"  placeholder="$" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="recurr_usd_annually"  placeholder="$" required/>' +
    '</div>' +
    ' <div class="col-md-2">' +
    '  <input type="number" class="form-control" name="recurr_usd_biennially"  placeholder="$" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    ' <input type="number" class="form-control" name="recurr_usd_triennially"  placeholder="$" required/>' +
    '</div>' +
    '</div>');
}
////Append on product detals
$('.add').click(function() {
   var counter = $('.appendChield').length;

$('#AppendProduct').append('<div class="appendChield">'+
    '<div class="col-12">'+
    '<label class="form-label">Product Name</label>'+
    '<input type="text" id="product_name" class="form-control" name="product_name[]" placeholder="ABC" required/>'+
    '</div>'+
    '<div class="col-12">'+
    '<label class="form-label">Product Description</label>'+
    '<textarea name="description[]" id="descriptions_' + counter + '" class="form-control"></textarea>'+
    '</div>'+
    '<div class="col-12">'+
    '<label class="form-label" for="modalEditUserName">Pricing</label>'+
    '<div class="row mb-3"> '+
    '<div class="col-md-2">'+
    '<label for="payment_type"  class="form-label">Payment Type</label>'+
    '</div>'+
    '<div class="col-md-3">'+
    '<label for="free"class="form-label">'+
    '<input type="radio" onclick="free()" checked name="payment_type[]"  value="1" />&nbsp;&nbsp;Free</label>'+
    '</div>'+
    '<div class="col-md-3">'+
    '<label for="one_time"class="form-label">'+
    '<input type="radio" onclick="onetimeAddOn()" name="payment_type[]" value="2" />&nbsp;&nbsp;One Time</label>'+
    '</div>'+
    '<div class="col-md-3">'+
    '<label for="recurring"class="form-label">'+
    '<input type="radio" onclick="recurringAddOn()" name="payment_type[]" value="3" />&nbsp;&nbsp;Recurring</label>'+
    '</div>'+
    '</div>'+
    '<div class="mb-4 paymenttypeAddOn"></div>'+ 
    '</div>'+
    '</div>');


 CKEDITOR.replace('descriptions_'+counter, {
      extraPlugins: 'scayt',
      scayt_autoStartup: true,
    });
counter++;
});

$('.remove').click(function() {
    // $("#AppendProduct table:last-child").remove()
    $('#AppendProduct').children().last().remove();
});

/////price add on  
function onetimeAddOn() {
  $('.paymenttypeAddOn').html('<div class="row">' +
    '<div class="col-md-2 bg-success">' +
    '<label for="Currency" class="form-label">Currency</label>' +
    '</div>' +
    '<div class="col-md-2 bg-success">' +
    '<label for="One Time" class="form-label">One Time</label>' +
    '</div>' +
    '</div>' +
    '<div class="row mt-3">' +
    '<div class="col-md-2">' +
    ' <label for="INR "class="form-label mt-3">INR</label>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="onetime_inr[]"  placeholder="₹" required/>' +
    '</div>' +
    '</div>' +
    ' <div class="row mt-3">' +
    '<div class="col-md-2">' +
    '<label for="USD" class="form-label mt-3">USD</label>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="onetime_usd[]"  placeholder="$" required/>' +
    '</div>' +
    '</div>');
}
///// recurring Add On Payment
function recurringAddOn() {
  $('.paymenttypeAddOn').html(' <div class="row">' +
    '<div class="col-md-1 bg-success">' +
    ' <label for="Currency"class="form-label">Currency</label>' +
    '</div>' +
    ' <div class="col-md-1 bg-success">' +
    ' <label for="Hourly"class="form-label">Hourly</label>' +
    '</div>' +
    '<div class="col-md-1 bg-success">' +
    ' <label for="Monthly"class="form-label">Monthly</label>' +
    '</div>' +
    '<div class="col-md-1 bg-success">' +
    '<label for="Quartely"class="form-label">Quartely</label>' +
    '</div>' +
    '<div class="col-md-2 bg-success">' +
    '<label for="Semi-Annually"class="form-label">Semi-Annually</label>' +
    '</div>' +
    '<div class="col-md-2 bg-success">' +
    '<label for="Annually"class="form-label">Annually</label>' +
    '</div>' +
    '<div class="col-md-2 bg-success">' +
    '<label for="Biennially"class="form-label">Biennially</label>' +
    '</div>' +
    '<div class="col-md-2 bg-success">' +
    '<label for="Triennially"class="form-label">Triennially</label>' +
    '</div>' +
    '</div>' +
    '<div class="row mt-3">' +
    '<div class="col-md-1">' +
    '<label for="INR "class="form-label mt-3">INR</label>' +
    '</div>' +
    '<div class="col-md-1">' +
    '<input type="number" class="form-control" name="recurr_inr_hourly[]"  placeholder="₹" required/>' +
    '</div>' +
    '<div class="col-md-1">' +
    '<input type="number" class="form-control" name="recurr_inr_monthly[]"  placeholder="₹" required/>' +
    '</div>' +
    '<div class="col-md-1">' +
    '<input type="number" class="form-control" name="recurr_inr_quartely[]"  placeholder="₹" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="recurr_inr_semiannually[]"  placeholder="₹" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="recurr_inr_annually[]"  placeholder="₹" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="recurr_inr_biennially[]"  placeholder="₹" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="recurr_inr_triennially[]"  placeholder="₹" required/>' +
    '</div>' +
    '</div>' +
    '<div class="row mt-3">' +
    ' <div class="col-md-1">' +
    '  <label for="USD "class="form-label mt-3">USD</label>' +
    ' </div>' +
    ' <div class="col-md-1">' +
    '  <input type="number" class="form-control" name="recurr_usd_hourly[]"  placeholder="$" required/>' +
    ' </div>' +
    ' <div class="col-md-1">' +
    ' <input type="number" class="form-control" name="recurr_usd_monthly[]"  placeholder="$" required/>' +
    '</div>' +
    '<div class="col-md-1">' +
    '  <input type="number" class="form-control" name="recurr_usd_quartely[]"  placeholder="$" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    ' <input type="number" class="form-control" name="recurr_usd_semiannually[]"  placeholder="$" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="recurr_usd_annually[]"  placeholder="$" required/>' +
    '</div>' +
    ' <div class="col-md-2">' +
    '  <input type="number" class="form-control" name="recurr_usd_biennially[]"  placeholder="$" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    ' <input type="number" class="form-control" name="recurr_usd_triennially[]"  placeholder="$" required/>' +
    '</div>' +
    '</div>');
}
</script>