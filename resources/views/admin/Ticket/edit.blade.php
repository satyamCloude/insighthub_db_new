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
#gst-error {
  color: red;
  font-size: 14px;
}

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
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Ticket /</span> Edit</h4>
  <div class="col-xl">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Basic with Icons</h5>
        <small class="text-muted float-end"><a href="{{url('admin/Ticket/home')}}" class="btn btn-sm btn-primary">Back</a></small>
      </div>
      <div class="card-body">
        <form method="post" action="{{url('admin/Ticket/update/'.$Ticket->id)}}" >
          @csrf
          <div class="mb-3">
            <label class="form-label" for="basic-icon-default-company">Client</label>
            <div class="input-group">
              <span id="basic-icon-default-company2" class="input-group-text"><i class="ti ti-user"></i></span>
             <!--  <select class="form-control select2" name="client_id" id="clientid" onchange="Client(value)" >
                @foreach($Client as $Clie)
                <option @if($Ticket->client_id == $Clie->id) selected @endif value="{{$Clie->id}}">{{$Clie->first_name}}</option>
                @endforeach
              </select> -->
                <div class="dropdown">
                      <button class="dropbtn" type="button" style="justify-content:space-between;margin-right:3%">
                          <div >
                         <img src="{{url('/')}}/public/images/profile_Ri1o.jpeg" alt="" id="selected_client_img" class="rounded-circle avatar-xs" style="display:none;">
                          <span id="selected_client_btn">Select Client</span></div> <div >
                          <i class="fa fa-angle-down" style="font-size:24px"></i></div> </button>
                    <div class="dropdown-content">
                        @foreach($Client as $client)
                        <div class="outer" id="client_{{ $client->id }}" style="display:flex;margin:6px;padding:4px;color:black;" onclick="selectClient('{{ $client->id }}', '{{ $client->profile_img }}')">
                            
                                                                      @if($client->profile_img)
                                       <img src="{{ $client->profile_img }}"  class="rounded-circle avatar-xs">
                                                                                @else
                                                                             <img src="{{url('/')}}/public/images/profile_Ri1o.jpeg" alt="" class="rounded-circle avatar-xs">
                                                                                @endif
                           
                            <div class="sie_cont" style="display:flex;flex-direction:column;margin:5px;">
                                <span>{{ $client->first_name }} {{ $client->last_name }} (#{{ $client->id }}) <br>{{$client->company_name}}</span>
                                <span>{{ $client->status }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <input type="hidden" name="client_id" id="clientid" onchange="Client(value)" @if($Ticket->client_id) value="{{$Ticket->client_id}}"" @endif>
              <span id="basic-icon-default-company2" class="input-group-text"><i class="ti ti-mail"></i></span>
              <input type="text" aria-label="E-mail"  id="email" placeholder="client_email"  readonly class="form-control">
              <span id="basic-icon-default-company2" class="input-group-text"><i class="ti ti-phone"></i></span>
              <input type="text" aria-label="Phone Number" id="phone"  placeholder="client_pnumber" readonly  class="form-control">
           
          </div>
          <div class="row mb-3">
          
             <div class="col-sm-6">
              <label class="form-label" for="basic-icon-default-company">Assign To</label>
              <div class="dropdown" style="width:100%;">
                  <button class="dropbtn" type="button" >
                 <div>
                     @php
                        // Use the `firstWhere` collection method to find the first client matching the Ticket's ccid
                        $client = collect($CCIDs)->firstWhere('id', $Ticket->ccid);
                
                        // Use null coalescence operator to handle the case when $client is null
                        $src = $client->profile_img ?? 'https://i.pinimg.com/564x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg';
                        $first_name = $client->first_name ?? '';
                        $last_name = $client->last_name ?? '';
                        $id = $client->id ?? '';
                        $jobrole = $client->jobrole ?? '';
                    @endphp
                
                    <!-- Use the variables initialized above -->
                    <img src="{{ $src }}" style="width:30px; border-radius:50%; height:30px;" id="selected_client_img" alt="Client Image">
                    <span id="selected_client_btn2">{{ $first_name }} {{ $last_name }} ({{ $jobrole }})</span>
                </div>
                    <i class="fa fa-angle-down" style="font-size:24px"></i>
                  </button>

                  <div class="dropdown-content">
                    @if($CCIDs && count($CCIDs) > 0)
                @foreach($CCIDs as $client)
                    @if($client) {{-- Check if $client is not null --}}
                        <div class="outer" id="clients_{{ $client->id }}" style="display:flex;margin:6px;padding:4px;color:black;" onclick="selectClient2({{ $client->id }}, '{{ $client->first_name }} {{ $client->last_name }}', '{{ $client->profile_img }}')">
                            <img src="{{ $client->profile_img }}" style="width:45px;border-radius:50%;height:45px;">
                            <div class="sie_cont" style="display:flex;flex-direction:column;margin:5px;">
                                <span>{{ $client->first_name }} {{ $client->last_name }} (#{{ $client->id }}) <br/>{{ $client->jobrole }}</span>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div>No clients available</div>
            @endif
                  </div>
                  <input type="hidden" id="set_client_id2" name="ccid" value="{{$id}}">
              </div>
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="basic-icon-default-company">Department</label>
             <!--  <div class="input-group input-group-merge">
                <span id="basic-icon-default-company2" class="input-group-text"><i class="fa-solid fa-address-card"></i></span> -->
                <select class="form-control select2" name="department_id">
                  <option disabled="" selected="selected">Please Select</option>
                  @foreach($Department as $Dept)
                  <option @if($Ticket->department_id == $Dept->id) selected @endif value="{{$Dept->id}}">{{$Dept->name}}</option>
                  @endforeach
                </select>
              <!-- </div> -->
            </div>
          </div>
         <div class="row mb-3">
            <div class="col-sm-3">
              <label class="form-label" for="basic-icon-default-company">Priority</label>
             <!--  <div class="input-group input-group-merge">
                <span id="basic-icon-default-company2" class="input-group-text"><i class="fas fa-level-down-alt"></i></span> -->
                <select class="form-control select2" name="priority_id">
                    <option disabled="" selected="selected">Please Select</option>
                    <option @if($Ticket->priority_id == '1') selected @endif value="1">Normal</option>
                    <option @if($Ticket->priority_id == '2') selected @endif value="2">Medium</option>
                    <option @if($Ticket->priority_id == '3') selected @endif value="3">Urgent</option>
                </select>
              <!-- </div> -->
            </div>
            <div class="col-sm-3">
              <label class="form-label" for="basic-icon-default-company">Product/Services</label>
             <!--  <div class="input-group input-group-merge">
                <span id="basic-icon-default-company2" class="input-group-text"><i class="fa-brands fa-servicestack"></i></span> -->
                <select class="form-control select2" name="product_service_id">
                  <option disabled="" selected="selected">Please Select</option>
                  @foreach($Product as $Product)
                  <option @if($Ticket->product_service_id == $Product->id) selected @endif value="{{$Product->id}}">{{$Product->product_name}}</option>
                  @endforeach
                </select>
              </div>
            <!-- </div> -->
         
           <div class="col-sm-3">
                        <label class="form-label" for="basic-icon-default-company">Attachment</label>
                        <div class="input-group mb-1 attachment-group">
                            <div class="custom-file">
                                <label class="custom-file-label text-truncate" for="inputAttachment1" data-default="Choose file"></label>
                                <input type="file" class="custom-file-input" name="fileinput" id="inputAttachment1">
                            </div>
                        </div>
                        <div id="fileUploadsContainer"></div>

                     <!--<div class="text-muted">-->
                     <!--   <small>Allowed File Extensions: .zip, .jpg, .gif, .jpeg, .png, .txt, .pdf, .pem, .csr, .crt,-->
                     <!--      .xls, .xlsx, .docx, .ldf, .mdf, .msg, .ppk, .rar, .key (Max file size: 512MB)</small>-->
                     <!--</div>-->
            </div>

          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-icon-default-message">Subject</label>
            <div class="input-group input-group-merge">
              <!-- <span id="basic-icon-default-message2" class="input-group-text"></span> -->
              <textarea disabled id="basic-icon-default-message" class="form-control" aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2" name="subject">@if($Ticket->subject) {{$Ticket->subject}} @endif</textarea>
            </div>
          </div>
          <!-- <div class="mb-3">
            <label class="form-label" for="basic-icon-default-message">Message</label>
            <div class="editor-container">
              <textarea class="form-control" id="yourTextareaId" name="message">@if($Ticket->message) {!!$Ticket->message!!} @endif</textarea>
            </div>
          </div> -->
          <button type="submit" class="btn btn-primary waves-effect waves-light">Send</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<!-- Include CKEditor -->
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
document.getElementById('inputAttachment1').addEventListener('change', function() {
    var file = this.files[0];
    if (file && file.size < 150 * 1024 * 1024) { // size in bytes
        alert('File must be at least 150 MB.');
        this.value = ''; // Clear the file input
    }
});
    $(document).ready(function() {
        CKEDITOR.replace('yourTextareaId', {
            extraPlugins: 'scayt',
            scayt_autoStartup: true,
        });
    });
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
          url: "{{url('admin/Invoices/getClientDetails')}}/"+id,
          
          success: function(res) {
            console.log(res);// Make sure to adjust this based on your actual Select2 initialization method
            // alert(res.data.address_1 );
            $('#shipping_address').val(res.data.address_1 +', '+ res.data.address_2);
          },
        });
  }

    $(document).ready(function() {
      var defaultClientId = $('#clientid').val();
      Client(defaultClientId);
    });

    function Client(value) {
      var id = value;

      if (id) {
        $.ajax({
          url: "{{ url('admin/Ticket/ClientData') }}",
          type: 'GET',
          data: {
            'id': id,
            '_token': "{{ csrf_token() }}",
          },
          success: function (response) {
            if (response.success) {
              var data = response.data;

              if (data) {
                $('#email').val(data.email);
                $('#phone').val(data.phone_number);
              } else {
                alert("NO DATA FOUND");
              }
            } else {
              alert("Server returned an error: " + response.status);
            }
          },
          error: function () {
            alert("Technical Issue Found!");
          }
        });
      } else {
       // alert("Please Select Any Client");
      }
    }


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
@endsection