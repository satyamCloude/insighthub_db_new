@extends('layouts.admin')
@section('title', 'Ticket')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Ticket /</span> Add</h4>
  <div class="col-xl">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Basic with Icons</h5>
        <small class="text-muted float-end"><a href="{{url('user/userTicket')}}" class="btn btn-sm btn-primary">Back</a></small>
      </div>
      <div class="card-body">

        <form method="post" action="{{url('user/ticket/store')}}" >
          @csrf
          <div class="mb-3">
            <label class="form-label" for="basic-icon-default-company">Client</label>
            <div class="input-group">
              <span id="basic-icon-default-company2" class="input-group-text"><i class="ti ti-user"></i></span>
             <input type="text" class="form-control" readonly value="{{ucfirst(Auth::user()->first_name)}}">
              <span id="basic-icon-default-company2" class="input-group-text"><i class="ti ti-mail"></i></span>
              <input type="text" aria-label="E-mail"  id="email" placeholder="client_email" value="{{Auth::user()->email}}" readonly class="form-control">
              <span id="basic-icon-default-company2" class="input-group-text"><i class="ti ti-phone"></i></span>
              <input type="text" aria-label="Phone Number" id="phone" value="{{Auth::user()->phone_number}}" placeholder="client_pnumber" readonly  class="form-control">
            </div>
          </div>
          <div class="row mb-3">
            <!-- <div class="col-sm-6"> -->
            <!--   <label class="form-label" for="basic-icon-default-company">CC ID</label>
              <div class="input-group input-group-merge">
                <span id="basic-icon-default-company2" class="input-group-text"><i class="ti ti-building"></i></span>
                <select class="form-control select2" name="ccid">
                  <option disabled="" selected="selected">Please Select</option>
                  @foreach($CCID as $CCID)
                  <option value="{{$CCID->id}}">{{$CCID->first_name}}</option>
                  @endforeach
                </select>
              </div> -->
            <!-- </div> -->
            <div class="col-sm-12">
              <label class="form-label" for="basic-icon-default-company">Department</label>
                <select class="form-control select2" name="department_id" required>
                  <option value="">Please Select</option>
                  @foreach($Department as $Dept)
                  @if($Dept->allow_for_ticket)
                  <option value="{{$Dept->id}}">{{$Dept->name}}</option>
                  @endif
                  @endforeach
                </select>
            </div>
          </div>
         <div class="row mb-3">
            <div class="col-sm-6">
              <label class="form-label" for="basic-icon-default-company">Priority</label>           
                <select class="form-control select2" name="priority_id">
                    <option disabled="" selected="selected">Please Select</option>
                    <option value="1">Normal</option>
                    <option value="2">Medium</option>
                    <option value="3">Urgent</option>
                </select>
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="basic-icon-default-company">Product/Services</label>
              
                
                <select class="form-control select2" name="product_service_id" required>
                  <option disabled="" selected="selected">Please Select</option>
                  @foreach($activeServices as $Product)

                  <option value="{{$Product['product']['id']}}">{{$Product['product']['product_name']}}</option>
                  @endforeach
                </select>
              
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label" for="basic-icon-default-message">Subject</label>
            <div class="input-group input-group-merge">
                <!-- <span id="basic-icon-default-message2" class="input-group-text"></span> -->
                <textarea id="basic-icon-default-message" class="form-control" aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2" name="subject" required></textarea>
            </div>
        </div>


        <div class="mb-3">
            <label class="form-label" for="basic-icon-default-message">Message</label>
            <textarea class="form-control" id="slide3P" name="message" required></textarea>
           
        </div>
          <button type="submit" class="btn btn-primary waves-effect waves-light">Send</button>
        </form>
      </div>
    </div>
  </div>
</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.js"></script>
<script>
$('#slide3P').summernote();
</script>





<script type="text/javascript">
  $(document).ready(function() {
  var defaultClientId = $('#clientid').val();
  Client(defaultClientId);
});

  // function Client(value) {
  //   var id = value;

  //   if (id) {
  //     $.ajax({
  //       url: "{{ url('admin/Ticket/ClientData') }}",
  //       type: 'GET',
  //       data: {
  //         'id': id,
  //         '_token': "{{ csrf_token() }}",
  //       },
  //       success: function (response) {
  //         if (response.success) {
  //           var data = response.data;

  //           if (data) {
  //             $('#email').val(data.email);
  //             $('#phone').val(data.phone_number);
  //           } else {
  //             alert("NO DATA FOUND");
  //           }
  //         } else {
  //           alert("Server returned an error: " + response.status);
  //         }
  //       },
  //       error: function () {
  //         alert("Technical Issue Found!");
  //       }
  //     });
  //   } else {
  //     alert("Please Select Any Client");
  //   }
  // }
</script>
@endsection