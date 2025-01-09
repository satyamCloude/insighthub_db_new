@extends('layouts.admin')
@section('title', 'Task Category')
@section('content')
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Task Category /</span> Add</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="{{url('Employee/TaskCategory/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
         <form action="{{ url('Employee/TaskCategory/store') }}" method="post" enctype="multipart/form-data">
             @csrf
            <div class="card-body">
              <h5 class="mb-4">1. Task Category</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="Task_name" class="form-label">Task Category Name  <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="category_name" required/>
                </div>
             
            </div>
          </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('Employee/TaskCategory/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>Submit</button>
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

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
      $("#without_deadline").change(function() {
    var deadlineInput = $("input[name='deadline']");
    if ($(this).is(":checked")) {
        $("#deadline_date").hide();
        deadlineInput.prop('required', false); // Remove the 'required' attribute
    } else {
        $("#deadline_date").show();
        deadlineInput.prop('required', true); // Add the 'required' attribute
    }
});

      $("#other_details").click(function () {
        $("#add_file_div").toggle();

        // Toggle caret icon based on visibility
        var icon = $("#add_file_div").is(":visible") ? "fa-caret-up" : "fa-caret-down";
        $("#caret_icon").removeClass("fa-caret-down fa-caret-up").addClass(icon);
    });

        $("#is_public").change(function() {
            if ($(this).is(":checked")) {
                $("#add_Task_mem").hide(); // Hide the div with id "deadline_date"
            } else {
                $("#add_Task_mem").show(); // Show the div with id "deadline_date"
            }
        });
</script>
@endsection