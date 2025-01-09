@extends('layouts.admin')
@section('title', 'Ticket')
@section('content')
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
              <select class="form-control select2" name="client_id" id="clientid" onchange="Client(value)" >
                @foreach($Client as $Clie)
                <option @if($Ticket->client_id == $Clie->id) selected @endif value="{{$Clie->id}}">{{$Clie->first_name}}</option>
                @endforeach
              </select>
              <span id="basic-icon-default-company2" class="input-group-text"><i class="ti ti-mail"></i></span>
              <input type="text" aria-label="E-mail"  id="email" placeholder="client_email"  readonly class="form-control">
              <span id="basic-icon-default-company2" class="input-group-text"><i class="ti ti-phone"></i></span>
              <input type="text" aria-label="Phone Number" id="phone"  placeholder="client_pnumber" readonly  class="form-control">
           
          </div>
          <div class="row mb-3">
            <div class="col-sm-6">
              <label class="form-label" for="basic-icon-default-company">Assign To</label>
            <!--   <div class="input-group input-group-merge">
                <span id="basic-icon-default-company2" class="input-group-text"><i class="ti ti-building"></i></span> -->
                <select class="form-control select2" name="ccid">
                  <option disabled="" selected="selected">Please Select</option>
                  @foreach($CCID as $CCID)
                  <option @if($Ticket->ccid == $CCID->id) selected @endif value="{{$CCID->id}}">{{$CCID->first_name}}</option>
                  @endforeach
                </select>
              <!-- </div> -->
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
            <div class="col-sm-6">
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
            <div class="col-sm-6">
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
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-icon-default-message">Subject</label>
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-message2" class="input-group-text"><i class="ti ti-message-dots"></i></span>
              <textarea id="basic-icon-default-message" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?" aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2" name="subject">@if($Ticket->subject) {{$Ticket->subject}} @endif</textarea>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-icon-default-message">Task</label>
            <div class="editor-container">
              <textarea class="form-control" id="yourTextareaId" name="task">@if($Ticket->task) {!!$Ticket->task!!} @endif</textarea>
            </div>
          </div>
          <button type="submit" class="btn btn-primary waves-effect waves-light">Send</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        CKEDITOR.replace('yourTextareaId', {
            extraPlugins: 'scayt',
            scayt_autoStartup: true,
        });
    });
</script>
<script type="text/javascript">
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
      alert("Please Select Any Client");
    }
  }  
</script>
@endsection