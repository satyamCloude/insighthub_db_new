

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
</style>
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
            <!--<select name="category_id" class="form-control select2" required>-->
            <!--  <option value="">Select Category</option>-->
            <!--  @foreach($Category as $Cate)-->
            <!--  <option value="{{$Cate->id}}">{{$Cate->category_name}}</option>-->
            <!--  @endforeach-->
            <!--</select>-->
            <div class="dropdown">
                      <button class="dropbtn" style="justify-content:space-between;margin-right:3%">
                          <div >
                          <!--<img src="" style="width:30px;border-radius:50%;height:30px;" id="selected_client_img">-->
                          <span id="selected_client_btn">Select Category</span>
                        </div> 
                        <div >
                          <i class="fa fa-angle-down" style="font-size:24px"></i>
                        </div> 
                      </button>
                          <div class="dropdown-content">
                            @foreach($Category as $client)
                            <div class="outer" id="client_{{ $client->id }}" style="display:flex;margin:6px;padding:4px;color:black;"
                            onclick="selectClient('{{ $client->id }}', '{{ $client->profile_img }}')">
                                <span>{!! $client->faIcon !!}</span> 
                                <div class="sie_cont" style="display:flex;flex-direction:column;margin:5px;">
                                    <span>{{ $client->category_name }}</span>
                                   
                                </div>
                            </div>
                            @endforeach
                          </div>
                </div>
                <input type="hidden" name="category_id" id="set_client_id">
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
                 <!--  <div class="col-md-6">
                    <label for="payment_method" class="form-label">Payment Method </label>
                    <select name="payment_method[]" class="form-control select2"  multiple>
                        <option value="">Select Method</option>
                        @foreach($PaymentMethod as $Method)
                            <option value="{{ $Method->id }}">{{ $Method->name }}</option>
                        @endforeach
                    </select>
                </div> -->

                  <div class="col-md-3">
                    <label for="display_on_frontend"  class="form-label">Display on frontend </label><br>
                    <input type="checkbox" name="display_on_frontend"/>
                  </div> 
                  
                <!--   <div class="col-md-3">
                    <label for="product_image"  class="form-label">Product Image <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="product_image"/>
                  </div> -->
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
                  <select name="addon_id[]" class="form-control select2"  multiple>
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



  function selectClient(id) {
       var clientName = $('#client_' + id + ' .sie_cont span:first-child').text(); 
        var imgSrc = $('#client_' + id + ' img').attr('src'); 
        $('#selected_client_img').attr('src', imgSrc); 
        $('#selected_client_btn').text(clientName); // Set the button text to the selected client name
        $('#set_client_id').val(id); // Set the hidden input value to the selected client ID
    
        $('.dropdown-content .outer').removeClass('selected');
    
        // Add the 'selected' class to the clicked option
        $('#client_' + id).addClass('selected');
  }

</script>