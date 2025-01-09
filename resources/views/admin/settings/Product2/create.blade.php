
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
             
                  </div>  
                  <div class="row mb-4"> 
            <div class="col-md-6">
                      <label for="url"  class="form-label">Url <span class="text-danger">*</span></label>
                      <input type="text" readonly id="url" class="form-control" value="{{ url('/') }}" name="url" placeholder="https://www.google.com/">
                    </div>
                <div class="col-md-6">
                      <label for="tax"  class="form-label">Tax </label>
                      <select class="form-control select2" name="tax_id"  placeholder="ABC" >
                        <option value="">Select Tax</option>
                        @foreach($TaxSettings as $TaxSetting)
                        <option value="{{$TaxSetting->id}}">{{ucfirst($TaxSetting->tax_name)}} - {{$TaxSetting->rate}}</option>
                        @endforeach
                      </select>
                    </div> 
                  </div>
                  <div class="row mb-4"> 
                  <div class="col-md-6">
                    <label for="payment_method" class="form-label">Payment Method </label>
                    <select name="payment_method[]" class="form-control select2"  multiple>
                        <option value="">Select Method</option>
                        @foreach($PaymentMethod as $Method)
                            <option value="{{ $Method->id }}">{{ $Method->name }}</option>
                        @endforeach
                    </select>
                </div>

                  <div class="col-md-3">
                    <label for="display_on_frontend"  class="form-label">Display on frontend </label><br>
                    <input type="checkbox" name="display_on_frontend"/>
                  </div> 
                  
                  <div class="col-md-3">
                    <label for="product_image"  class="form-label">Product Image <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="product_image"/>
                  </div>
                </div>
                <div class="row mb-4"> 
                 <div class="col-md-12">
                  <label for="description"  class="form-label">Product Description <span class="text-danger">*</span></label>
                  <textarea name="description" id="description" class="form-control" required="true"></textarea>
                </div>
              </div>
              <hr>
              <h5 class="mb-4">2. Pricing</h5>
              <div class="row mb-4"> 
                <div class="col-md-2">
                  <label for="payment_type"  class="form-label">Payment Type <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-3">
                  <label for="free"class="form-label"><input type="radio" checked  required onclick="free()" name="payment_type" value="1" />&nbsp;&nbsp;Free</label>
                </div>
                <div class="col-md-3">
                  <label for="one_time"class="form-label"><input type="radio" onclick="onetime()" name="payment_type" value="2" />&nbsp;&nbsp;One Time</label>
                </div>
                <div class="col-md-3">
                  <label for="recurring"class="form-label"><input type="radio" onclick="recurring()" name="payment_type" value="3" />&nbsp;&nbsp;Recurring</label>
                </div>
              </div>
              <div class="mb-4 paymenttype"></div>
              <hr>
               <h5 class="mb-4">3. Addons</h5>
              <div class="row mb-4"> 
                    <!--  <div class="col-md-6">
                      <label for="payment_method"  class="form-label">Product<span class="text-danger">*</span></label>
                      <select name="product_id" class="form-control select2" required>
                        <option value="">Select Product</option>
                        @foreach($createdProducts as $Method)
                        <option value="{{$Method->id}}">{{$Method->product_name}}</option>
                        @endforeach
                      </select>
                  </div> -->
                 <div class="col-md-6">
                  <label for="payment_method" class="form-label">Addons<span class="text-danger">*</span></label>
                  <select name="addon_id[]" class="form-control select2" required multiple>
                      <option value="">Select Addons</option>
                      @foreach($createdProducts as $Method)
                      <option value="{{ $Method->id }}">{{ $Method->product_name }}</option>
                      @endforeach
                  </select>
              </div>

              </div>
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <button type="button" onclick="Tab(value)" value="ServiceAutomation"class="btn btn-outline-danger">Discard</button>
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-success product_sub">Submit</button>
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
            <form action="{{url('admin/Product/storeAddOnProduct')}}" method="post" class="row g-3">
               @csrf
              <div class="col-12">
                <label class="form-label">Add On Product Name</label>
                <select id="product_id" class="form-control" name="product_id" required/>
                @foreach($createdProducts as $createdProduct)
                <option value="{{$createdProduct->id}}">{{ucfirst($createdProduct->product_name)}}</option>
                @endforeach
              </select>
              </div>
              <div class="col-12">
                <label class="form-label">Product Name</label>
                <input type="text" id="product_name" class="form-control" name="product_name[]" placeholder="ABC" required/>
              </div>
              
         <div class="col-12">
    <label class="form-label" for="modalEditUserName">Pricing</label>
    <div class="row mb-3"> 
        <div class="col-md-2">
            <label for="payment_type" class="form-label">Payment Type</label>
        </div>
        <div class="col-md-3">
            <label for="free" class="form-label"><input type="radio" required onclick="free()" checked="checked"  name="payment_type[0]" value="1" />&nbsp;&nbsp;Free</label>
        </div>
        <div class="col-md-3">
            <label for="one_time" class="form-label"><input type="radio" required onclick="onetimeAddOnOne()" name="payment_type[0]" value="2" />&nbsp;&nbsp;One Time</label>
        </div>
        <div class="col-md-3">
            <label for="recurring" class="form-label"><input type="radio" required onclick="recurringAddOnOne()" name="payment_type[0]" value="3" />&nbsp;&nbsp;Recurring</label>
        </div>
    </div>
</div>

    <div class="recurringAddOnOne"></div>
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
 var paymenttype = 1;
     var plan_type = 'free';
            $.ajax({
                type: 'GET',
                data: {
                 plan_type:plan_type,
                  paymenttype:paymenttype
                },
                url: "{{url('admin/Product/currency')}}", // Laravel route for fetching states
                 success: function(data) {
                        console.log(data);
              $('.paymenttype').html('');

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
            });
      
}

function onetime() {
   var paymenttype = 2;
   var plan_type = 'onetime';
            $.ajax({
                type: 'GET',
                data: {
                 plan_type:plan_type,
                  paymenttype:paymenttype
                },
                url: "{{url('admin/Product/currency')}}", // Laravel route for fetching states
                 success: function(data) {
                        console.log(data);
                   $('.paymenttype').html(data);

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
            });
      
}

function recurring() {
  var paymenttype = 3;
     var plan_type = 'recurring';

            $.ajax({
                type: 'GET',
                data: {
                  plan_type:plan_type,
                  paymenttype:paymenttype
                },
                url: "{{url('admin/Product/currency')}}", // Laravel route for fetching states
                 success: function(data) {
                        console.log(data);
                         $('.paymenttype').html(data);

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
            });
}

 $('form').submit(function(e) {
    // e.preventDefault();

    // Get CKEditor instance
    var editor1 = CKEDITOR.instances['description'].getData();

    if (editor1.trim() === '') {
        // Show error message or handle validation as needed
        alert('Product description is required.');
        // Prevent form submission
        return false;
    } else {
        return true;
    }
});

</script>