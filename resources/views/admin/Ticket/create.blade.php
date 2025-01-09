@extends('layouts.admin')
@section('title', 'Ticket')
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
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Ticket /</span> Add</h4>
  <div class="col-xl">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Basic with Icons</h5>
        <small class="text-muted float-end"><a href="{{url('admin/Ticket/home')}}" class="btn btn-sm btn-primary">Back</a></small>
      </div>
      <div class="card-body">
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
      
        <form id="ticketForm" method="post" action="{{url('admin/Ticket/store')}}" enctype="multipart/form-data">
          @csrf
        <div class="mb-3">
            <label class="form-label" for="basic-icon-default-company">Client</label>
            <div class="input-group">
              <span id="basic-icon-default-company2" class="input-group-text"><i class="ti ti-user"></i></span>
              <!-- <select class="form-control select2" name="client_id" id="clientid" onchange="Client(value)" >
                @foreach($Client as $Clie)
                <option value="{{$Clie->id}}">{{$Clie->first_name}}</option>
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
                <input type="hidden" name="client_id" id="clientid" onchange="Client(value)">
              <span id="basic-icon-default-company2" class="input-group-text"><i class="ti ti-mail"></i></span>
              <input type="text" aria-label="E-mail"  id="email" placeholder="client_email"  readonly class="form-control">
              <span id="basic-icon-default-company2" class="input-group-text"><i class="ti ti-phone"></i></span>
              <input type="text" aria-label="Phone Number" id="phone"  placeholder="client phone number" readonly  class="form-control">
            </div>
          </div> 
      



          <div class="row mb-3">
              <!--   <div class="col-sm-3 mb-3">
                <label for="client_id" class="form-label">Client <span class="text-danger">*</span></label>
                <div class="dropdown">
                      <button class="dropbtn" style="justify-content:space-between;margin-right:3%" type="button">
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
                <input type="hidden" name="client_id" id="clientid" onchange="Client(value)" >
            </div> -->
            <div class="col-sm-3">
              <label class="form-label" for="basic-icon-default-company">CC ID</label>
              <div class="dropdown" style="width:100%;">
                  <button class="dropbtn" type="button">
                    <div>
                            <img src="" style="width:30px;border-radius:50%;height:30px;display: none;" id="selected_client_img">
                              <span id="selected_client_btn2">AssignedTo</span>
                    </div>  
                    <i class="fa fa-angle-down" style="font-size:24px"></i>
                  </button>

                  <div class="dropdown-content">
                    @foreach($CCID as $CCID)
                    <div class="outer" id="clients_{{ $CCID->id }}" style="display:flex;margin:6px;padding:4px;color:black;" onclick="selectClient2({{ $CCID->id }})">
                      @if($CCID->profile_img)<img src="{{ $CCID->profile_img }}" style="width:45px;border-radius:50%;height:45px;">
                      @else
                      <img src="{{ url('public/images/emp_proa4NN.jpg') }}" style="width:45px;border-radius:50%;height:45px;">
                      @endif
                      <div class="sie_cont" style="display:flex;flex-direction:column;margin:5px;">
                        <span>{{ $CCID->first_name }} {{$CCID->last_name}} (#{{ $CCID->id }}) <br/>{{$CCID->jobrole}}</span>
                       
                      </div>
                    </div>
                    @endforeach
                  </div>
                  <input type="hidden" id="set_client_id2" name="ccid">
              </div>
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="basic-icon-default-company">Department</label>
            <!--   <div class="input-group input-group-merge">
                <span id="basic-icon-default-company2" class="input-group-text"><i class="fa-solid fa-address-card"></i></span> -->
                <select class="form-control select2" name="department_id">
                  <option disabled="" selected="selected">Please Select</option>
                  @foreach($Department as $Dept)
                  @if($Dept->allow_for_ticket)
                  <option value="{{$Dept->id}}">{{$Dept->name}}</option>
                  @endif
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
                    <option value="1">Normal</option>
                    <option value="2">Medium</option>
                    <option value="3">Urgent</option>
                </select>
              <!-- </div> -->
            </div>
            <div class="col-sm-3">
              <label class="form-label" for="basic-icon-default-company">Product/Services</label>
            <!--   <div class="input-group input-group-merge">
                <span id="basic-icon-default-company2" class="input-group-text"><i class="fa-brands fa-servicestack"></i></span> -->
                <select class="form-control select2" name="product_service_id">
                  <option disabled="" selected="selected">Please Select</option>
                  @foreach($Product as $Product)
                  <option value="{{$Product->id}}">{{$Product->product_name}}</option>
                  @endforeach
                </select>
              <!-- </div> -->
            </div>
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
                <span id="basic-icon-default-message2" class="input-group-text"><i class="ti ti-message-dots"></i></span>
                <textarea id="basic-icon-default-message" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?" aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2" name="subject"></textarea>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="basic-icon-default-message">Task</label>
            <textarea class="form-control" id="slide3P" name="task"></textarea>
            <!-- <div class="editor-container">
                <div class="full-editor geteditor" contenteditable="true"></div>
                <input type="hidden" name="task" class="hidden-field">
            </div> -->
        </div>
          <button type="submit" id="submitForm" class="btn btn-primary waves-effect waves-light">Send</button>
        </form>
      </div>
    </div>
  </div>
</div>



<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.js"></script>
<script>
$('#slide3P').summernote();
$('#slide3P2').summernote();
$('#slide3P1').summernote();
</script>
<!-- Include CKEditor -->
<script type="text/javascript">

// document.getElementById('inputAttachment1').addEventListener('change', function() {
//     var file = this.files[0];
//     if (file && file.size < 150 * 1024 * 1024) { // size in bytes
//         alert('File must be at least 150 MB.');
//         this.value = ''; // Clear the file input
//     }
// });


  numberCount = 1;



  function selectClient(id) {
   var clientName = $('#client_' + id + ' .sie_cont span:first-child').text(); 
   $('#selected_client_img').show();
    var imgSrc = $('#client_' + id + ' img').attr('src'); 
    $('#selected_client_img').attr('src', imgSrc); 
    $('#selected_client_btn').text(clientName); // Set the button text to the selected client name
    $('#set_client_id').val(id); // Set the hidden input value to the selected client ID
    $('#clientid').val(id); // Set the hidden input value to the selected client ID

    $('.dropdown-content .outer').removeClass('selected');

    // Add the 'selected' class to the clicked option
    $('#client_' + id).addClass('selected');
        var id = id;

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
        //alert("Please Select Any Client");
      }
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
        //alert("Please Select Any Client");
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