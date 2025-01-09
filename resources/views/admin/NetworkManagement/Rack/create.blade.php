@extends('layouts.admin')
@section('title', 'Create')
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
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Rack /</span> Add</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="{{url('admin/Rack/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>

          </div>
          
          @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif
          <form action="{{url('admin/Rack/store')}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row mb-4"> 
                  <div class="col-md-6">
                      <label for="customer_id" class="form-label">Customer Name <span class="text-danger">*</span></label>
                     
                    <div class="dropdown" style="width:100%;">
                    <button class="dropbtn" >
                    <div>
                            <img src="" style="width:30px;border-radius:50%;height:30px;display: none;" id="selected_client_img">
                              <span id="selected_client_btn2">AssignedTo</span>
                    </div>  
                    <i class="fa fa-angle-down" style="font-size:24px"></i>
                    </button>

                    <div class="dropdown-content">
                    @foreach($client as $clients)
                    <div class="outer" id="clients_{{ $clients->id }}" style="display:flex;margin:6px;padding:4px;color:black;" onclick="selectClient2({{ $clients->id }})">
                      @if($clients->profile_img)<img src="{{ $clients->profile_img }}" style="width:45px;border-radius:50%;height:45px;">
                      @else
                      <img src="{{ url('public/images/emp_proa4NN.jpg') }}" style="width:45px;border-radius:50%;height:45px;">
                      @endif
                      <div class="sie_cont" style="display:flex;flex-direction:column;margin:5px">
                    <span>{{ $clients->first_name }} {{ $clients->last_name }} | {{ $clients->id }} <br> {{ $clients->company_name }}</span>

                       
                      </div>
                    </div>
                    @endforeach
                  </div>
                  <input type="hidden" name="customer_id" id="set_client_id2">
                    </div>
                  </div>
                  <div class="col-md-6">
                      <label for="vendor_id" class="form-label">Vendor Name <span class="text-danger">*</span></label>
                      <select class="form-control" name="vendor_id" required>                      
                          @foreach($Vendor as $Vend)
                              <option value="{{$Vend->id}}">{{$Vend->first_name}}</option>   
                          @endforeach   
                      </select>
                  </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="rack_id" class="form-label">Rack ID <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" name="rack_id" placeholder="Enter RacK No." required/>
                </div>
                <div class="col-md-6">
                      <label for="rack_power_unit" class="form-label">Rack Power Unit <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" name="rack_power_unit" placeholder="Enter Rack Power Unit" required/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="rack_bandwidth" class="form-label">Rack Bandwidth <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="rack_bandwidth" placeholder="Enter Rack Bandwidth" required/>
                </div>
               <!--  <div class="col-md-6">
                      <label for="rack_capacity" class="form-label">Rack Capacity U <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" name="rack_capacity" placeholder="Enter Rack Capacity U" required/>
                </div> -->
                <div class="col-md-6">
    <label for="rack_capacity" class="form-label">Rack Capacity U <span class="text-danger">*</span></label>
    <div class="input-group">
        <button type="button" class="btn btn-outline-secondary" id="decrement">-</button>
        <input type="number" class="form-control" name="rack_capacity" id="rack_capacity" placeholder="Enter Rack Capacity U" required/>
        <button type="button" class="btn btn-outline-secondary" id="increment">+</button>
    </div>
</div>

              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="dc_floor" class="form-label">DC Floor <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="dc_floor" placeholder="Enter DC Floor" required/>
                </div>
                <div class="col-md-6">
                      <label for="dc_area_zone" class="form-label">DC Area Zone <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="dc_area_zone" placeholder="Enter DC Area Zone" required/>
                </div>
              </div>
               <hr>
              <h5 class="mb-4">2. Admin Notes</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="dc_area_zone" class="form-label">status <span class="text-danger">*</span></label>
                      <select class="form-control" name="status">
                        <option value="1">Active</option>
                        <option value="2">Suspended</option>
                        <option value="3">Terminated</option>
                      </select>
                </div>
              </div>    
                <div class="col-md-12">
                      <label for="rack_note" class="form-label">Rack Notes <span class="text-danger">*</span></label>
                       <div class="editor-container">
                            <div class="full-editor geteditor"></div>
                            <input type="hidden" name="rack_note" class="hidden-field">
                        </div>
                </div>
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('admin/Rack/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
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
  
  
  
      function selectClient2(id) {
    var clientName = $('#clients_' + id + ' .sie_cont span:first-child').text(); // Extract client name from selected item
     var imgSrc = $('#clients_' + id + ' img').attr('src');
    // alert(imgSrc);
      $('#selected_client_img').attr('src', imgSrc);
      $('#selected_client_img').show();
    $('#selected_client_btn2').text(clientName); // Set the button text to the selected client name
    $('#set_client_id2').val(id); // Set the button text to the selected client name

    $('.dropdown-content .outer').removeClass('selected');

    // Add the 'selected' class to the clicked option
    $('#clients_' + id).addClass('selected');

   
  }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#increment').click(function() {
        var value = parseInt($('#rack_capacity').val(), 10);
        value = isNaN(value) ? 0 : value;
        value++;
        $('#rack_capacity').val(value);
    });

    $('#decrement').click(function() {
        var value = parseInt($('#rack_capacity').val(), 10);
        value = isNaN(value) ? 0 : value;
        if(value > 0) {
            value--;
        }
        $('#rack_capacity').val(value);
    });
});
</script>

@endsection
