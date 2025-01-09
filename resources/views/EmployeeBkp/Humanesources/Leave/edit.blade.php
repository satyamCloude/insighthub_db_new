@extends('layouts.admin')
@section('title', 'Leave')
@section('content')
<style>


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
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Leave /</span> Edit</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Edit Detail's</h5>
            <div class="action-btns">
              <a href="{{url('Employee/Leave/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('Employee/Leave/update/'.$Leave->id)}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row"> 
                <!--<div class="col-sm-6 mb-4">-->
                <!--      <label for="emp_id"  class="form-label">Employees</label>-->
                <!--      <select class="form-select" name="emp_Id" required>-->
                <!--          @foreach($Employee as $emp)-->
                <!--          <option @if($Leave && $Leave->emp_Id == $emp->id) selected @endif value="{{$emp->id}}">{{$emp->first_name}} {{$emp->last_name}}</option>-->
                <!--          @endforeach-->
                <!--      </select>-->
                <!--</div>-->
                <div class="col-sm-6 mb-4">
                        <label for="emp_id"  class="form-label">Employees</label><br/>
                        <div class="dropdown" style="width:100%;">
                          <!--<button class="dropbtn" id="selected_emp_btn2">Select <i class="fa fa-angle-down" style="font-size:24px"></i></button>-->
                          <button type="button" class="dropbtn" style="justify-content:space-between;margin-right:3%">
                          <div >
                          <img src="" style="width:30px;border-radius:50%;height:30px;display:none;" id="selected_emp_img">
                          <span id="selected_emp_btn2">Select Employee</span></div> <div >
                          <i class="fa fa-angle-down" style="font-size:24px"></i></div> 
                          </button>
                          <div class="dropdown-content">
                            @foreach($Employee as $client)
                            <div class="outer" id="emp_{{ $client->id }}" style="display:flex;margin:6px;padding:4px;color:black;"
                            onclick="selectClient2({{ $client->id }})">
                              <img src="{{ $client->profile_img }}" style="width:45px;border-radius:50%;height:45px;">
                              <div class="sie_cont" style="display:flex;flex-direction:column;margin:5px;">
                                <span>{{ $client->first_name }} {{$client->last_name}} (#{{ $client->id }})</span>
                                <!--<span>{{ $client->status }}</span>-->
                              </div>
                                <input type="hidden" name="emp_Id" id="set_emp_id2">
                            </div>
                            @endforeach
                          </div>
                        </div>
                        <!--<select class="form-select" name="emp_Id" required>-->
                        <!--    @foreach($Employee as $emp)-->
                        <!--    <option value="{{$emp->id}}">{{$emp->first_name}} {{$emp->last_name}}</option>-->
                        <!--    @endforeach-->
                        <!
                <div class="col-sm-6 mb-4">
                      <label for="emp_id"  class="form-label">Status</label>
                      <select class="form-select" name="status" required>
                          <option @if($Leave && $Leave->status == '3') selected @endif value="3" selected>PENDING</option>
                          <option @if($Leave && $Leave->status == '1') selected @endif value="1">APPROVED</option>
                          <option @if($Leave && $Leave->status == '2') selected @endif value="2">UNAPPROVED</option>
                      </select>
                </div>
                 <div class="col-sm-6 mb-4">
                      <label for="emp_id"  class="form-label">Leave Type</label>
                      <select class="form-select" name="leavetype_id" required>
                          @foreach($LeaveType as $Lea)
                          <option @if($Leave && $Leave->leavetype_id == $Lea->id) selected @endif value="{{$Lea->id}}">{{$Lea->leave_type}}</option>
                          @endforeach
                      </select>
                </div>
                <div class="col-sm-6 mb-4">
                      <label for="apply_for"  class="form-label">Apply For</label>
                      <select class="form-select" name="apply_for" required>                            
                        <option @if($Leave && $Leave->apply_for == "1") selected @endif value="1">Leave</option>                                  
                        <option @if($Leave && $Leave->apply_for == "2") selected @endif value="2">Work From Home</option>                                  
                      </select>
                </div>
                
                <div class="col-sm-6 mb-4">
                    <label class="mt-1 mb-3" for="usr">Select Duration</label>
                    <div class="d-flex justify-content-sm-between">
                      <div class="form-check">
                          <input onclick="fullday()" class="form-check-input" @if($Leave && $Leave->duration == "1") checked @endif  name="duration" type="radio" value="1" id="defaultRadio2">
                          <label class="form-check-label"  for="defaultRadio2"> Full Day </label>
                      </div>
                      <div class="form-check">
                          <input onclick="Multiple()"  class="form-check-input" @if($Leave && $Leave->duration == "2") checked @endif  name="duration" type="radio" value="2" id="defaultRadio2">
                          <label class="form-check-label"   for="defaultRadio2"> Multiple </label>
                      </div>
                      <div class="form-check">
                          <input onclick="FirstHalf()" class="form-check-input" @if($Leave && $Leave->duration == "3") checked @endif   name="duration" type="radio" value="3" id="defaultRadio2">
                          <label class="form-check-label"   for="defaultRadio2"> First Half </label>
                      </div>
                      <div class="form-check">
                          <input onclick="SecondHalf()" class="form-check-input" @if($Leave && $Leave->duration == "4") checked @endif  name="duration"  type="radio" value="4" id="defaultRadio2">
                          <label class="form-check-label"   for="defaultRadio2"> Second Half</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 mb-4" id="Fieldshow">
                    <label class="mt-1 mb-3" for="usr">Date</label>
                    <input  type="date" class="form-control" @if($Leave && $Leave->date) value="{{$Leave->date}}" @endif name="date">
                  </div>
                  
                 <div class="col-sm-12">
                    <label class="form-label" for="description">Description</label>
                    <div class="editor-container">
                          <div class="full-editor geteditor">{!! $Leave->description !!}</div>
                          <input type="hidden" name="description" class="hidden-field">
                      </div>
                  </div>
                            <br/>
                  <br/>
                            <div class="col-sm-12" id="reply_box">
                              <label class="form-label" for="description">Reply</label>
                                                            <textarea name="reply"  class="form-select" class="hidden-field"> @if($Leave && $Leave->reply) {{$Leave->reply}} @endif </textarea>

                                
                            </div>   
              </div>
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-sm-6 mb-4 text-end" >
                  <a href="{{url('Employee/Leave/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
                </div>
                <div class="col-sm-6 mb-4">
                  <!--<button type="button" class="btn btn-info" id="reply_btn">Reply</button>-->
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
    
  function fullday() {
      $('#Fieldshow').html('<label class="mt-1 mb-3" for="usr">Date</label><input  type="date" class="form-control" @if($Leave && $Leave->date) value="{{$Leave->date}}" @endif name="date">');
    }
    function Multiple() {
      $('#Fieldshow').html('<div class="row"><div class="col-sm-6 mb-4"><label for="apply_for"  class="form-label">Start Date</label><input type="date" class="form-control" name="start_date" @if($Leave && $Leave->start_date) value="{{$Leave->start_date}}" @endif ></div><div class="col-sm-6 mb-4"><label for="duration"  class="form-label">End Date</label><input  type="date" class="form-control" name="end_date" @if($Leave && $Leave->end_date) value="{{$Leave->end_date}}" @endif></div></div>');
    }
    function FirstHalf() {
      $('#Fieldshow').html('<label class="mt-1 mb-3" for="usr">Date</label><input  type="date" class="form-control" @if($Leave && $Leave->date) value="{{$Leave->date}}" @endif name="date">');
    }
    function SecondHalf() {
      $('#Fieldshow').html('<label class="mt-1 mb-3" for="usr">Date</label><input  type="date" class="form-control" @if($Leave && $Leave->date) value="{{$Leave->date}}" @endif name="date">');
     
    }
    
    
    function selectClient2(id) {
    var clientName = $('#emp_' + id + ' .sie_cont span:first-child').text(); // Extract client name from selected item
    var imgSrc = $('#emp_' + id + ' img').attr('src'); 
    $('#selected_emp_btn2').text(clientName); // Set the button text to the selected client name
    $('#set_emp_id2').val(id); // Set the button text to the selected client name
    $('#selected_emp_img').show();
    $('#selected_emp_img').attr('src', imgSrc); 


    $('.dropdown-content .outer').removeClass('selected');

    // Add the 'selected' class to the clicked option
    $('#emp_' + id).addClass('selected');

   
  }
  $(document).ready(function () {
   var emp_id = "{{$Leave->user_id}}";
  // alert(emp_id);
   selectClient2(emp_id);
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
    
    document.getElementById("reply_btn").addEventListener("click", function() {
    var div = document.getElementById("reply_box");
    if (div.style.display === "none") {
        div.style.display = "block";
    } else {
        div.style.display = "none";
    }
});

  });
  

</script>
@endsection