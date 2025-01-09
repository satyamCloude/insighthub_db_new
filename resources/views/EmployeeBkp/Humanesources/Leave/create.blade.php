@extends('layouts.admin')
@section('title', 'Leave')
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

</style>
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Leave /</span> Add</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="{{url('Employee/Leave/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('Employee/Leave/store')}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <!--<div class="row"> -->
              <!--    <div class="col-sm-6 mb-4">-->
              <!--          <label for="emp_id"  class="form-label">Employees</label>-->
              <!--          <select class="form-select" name="emp_Id" required>-->
              <!--              @foreach($Employee as $emp)-->
              <!--              <option value="{{$emp->id}}">{{$emp->first_name}}</option>-->
              <!--              @endforeach-->
              <!--          </select>-->
              <!--    </div>-->
                  <!--<div class="col-sm-6 mb-4">-->
                  <!--       <label for="emp_id"  class="form-label">Status</label>-->
                  <!--      <select class="form-select" name="status" required>-->
                  <!--          <option value="">Select Leave</option>-->
                  <!--          <option value="1">Privilege Leave</option>-->
                  <!--          <option value="2">Casual leave</option>-->
                  <!--          <option value="3" selected>Sick Leave</option>-->
                  <!--          <option value="4" selected>Maternity Leave</option>-->
                  <!--          <option value="5" selected>Other</option>-->
                  <!--      </select> -->
                  <!--</div>-->
                  <div class="col-sm-6 mb-4">
                        <label for="emp_id"  class="form-label">Leave Type</label>
                        <select class="form-select" name="leavetype_id" required>
                            @foreach($LeaveType as $Leave)
                            <option value="{{$Leave->id}}">{{$Leave->leave_type}}</option>
                            @endforeach
                        </select>
                  </div>
                  <div class="col-sm-6 mb-4">
                        <label for="apply_for"  class="form-label">Apply For</label>
                        <select class="form-select" name="apply_for" required>                              
                          <option value="1">Leave</option>                                  
                          <option value="2">Work From Home</option>                                  
                        </select>
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label class="mt-1 mb-3" for="usr">Select Duration</label>
                    <div class="d-flex justify-content-sm-between">
                      <div class="form-check">
                          <input onclick="fullday()" class="form-check-input" name="duration" type="radio" value="1" id="defaultRadio2" checked>
                          <label class="form-check-label"  for="defaultRadio2"> Full Day </label>
                      </div>
                      <div class="form-check">
                          <input onclick="Multiple()"  class="form-check-input" name="duration" type="radio" value="2" id="defaultRadio2">
                          <label class="form-check-label"   for="defaultRadio2"> Multiple </label>
                      </div>
                      <div class="form-check">
                          <input onclick="FirstHalf()" class="form-check-input"  name="duration" type="radio" value="3" id="defaultRadio2">
                          <label class="form-check-label"   for="defaultRadio2"> First Half </label>
                      </div>
                      <div class="form-check">
                          <input onclick="SecondHalf()" class="form-check-input" name="duration"  type="radio" value="4" id="defaultRadio2">
                          <label class="form-check-label"   for="defaultRadio2"> Second Half</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 mb-4" id="Fieldshow">
                    <label class="mt-1 mb-3" for="usr">Date</label>
                    <input  type="date" class="form-control" name="date" required>
                  </div>
                  <div class="col-sm-12">
                    <label class="form-label" for="description">Description</label>
                    <div class="editor-container">
                          <div class="full-editor geteditor"></div>
                          <input type="hidden" name="description" class="hidden-field">
                      </div>
                  </div>
              </div>     
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('Employee/Leave/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
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
    function fullday() {
      $('#Fieldshow').html('<label class="mt-1 mb-3" for="usr">Date</label><input  type="date" class="form-control" name="date">');
    }
    function Multiple() {
      $('#Fieldshow').html('<div class="row"><div class="col-sm-6 mb-4"><label for="apply_for"  class="form-label">Start Date</label><input type="date" class="form-control" name="start_date"></div><div class="col-sm-6 mb-4"><label for="duration"  class="form-label">End Date</label><input  type="date" class="form-control" name="end_date"></div></div>');
    }
    function FirstHalf() {
      $('#Fieldshow').html('<label class="mt-1 mb-3" for="usr">Date</label><input  type="date" class="form-control" name="date">');
    }
    function SecondHalf() {
      $('#Fieldshow').html('<label class="mt-1 mb-3" for="usr">Date</label><input  type="date" class="form-control" name="date">');
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
</script>
@endsection