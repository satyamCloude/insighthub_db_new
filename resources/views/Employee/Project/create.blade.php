@extends('layouts.admin')
@section('title', 'Project')
@section('content')
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Project /</span> Add</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="{{url('Employee/Project/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
         <form action="{{ url('Employee/Project/store') }}" method="post" enctype="multipart/form-data">
             @csrf
            <div class="card-body">
              <h5 class="mb-4">1. Project Details</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="project_name" class="form-label">Project Name  <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="project_name" required/>
                </div>
               <div class="col-md-6">
                      <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
                      <input type="date" class="form-control" name="start_date"  required/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6 " id="deadline_date">
                      <label for="deadline" class="form-label">Deadline Date<span class="text-danger">*</span></label>
                      <input type="date" class="form-control" name="deadline"  required/>
                </div>
                <div class="col-md-6">
                            <div class="d-flex mt-4">
                                <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="without_deadline" id="without_deadline" autocomplete="off">
                                                <label class="form-check-label form_custom_label text-dark-grey pl-2 mr-3 justify-content-start cursor-pointer checkmark-20 pt-1 text-wrap" for="without_deadline">
                                                There is no project deadline
                                                        </label>
                                  </div>
                    </div>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-4">
                      <label for="project_manager_id" class="form-label">Project Category <span class="text-danger">*</span></label>
                      <div class="input-group">   
                     <select class="form-control select-picker" name="category_id" id="project_category_id" data-live-search="true">
                          <option value="">--</option>
                      @foreach($ProjectCategory as $lst)
                    <option value="{{$lst->id}}">{{$lst->category_name}}</option>
                           
                            @endforeach
                        </select>
                       
                    </div>

                </div>
                <div class="col-md-4">
                      <label for="team_id" class="form-label">Department <span class="text-danger">*</span></label>
                      <div class="input-group">
                                      <select class="form-control select-picker" name="department_id" id="employee_department" data-live-search="true">
                                          <option value="">--</option>
                                           @foreach($Department as $lst)
                                        <option value="{{$lst->id}}">{{$lst->name}}</option>
                                               
                                                @endforeach
                                      </select>
                                     
                                  </div>

                </div>
                <div class="col-md-4">
                      <label for="team_id" class="form-label">Client <span class="text-danger">*</span></label>
                     <div class="input-group">
                        <select class="form-control select-picker" name="client_id" id="project_client_id" data-live-search="true">
                            <option value="">--</option>
                             @foreach($Client as $lst)
                                  <option value="{{$lst->id}}">{{$lst->first_name}}</option>
                               @endforeach
                        </select>

                        
                    </div>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="priority_id" class="form-label">Project Summary <span class="text-danger">*</span></label>
                      <div class="editor-container" style="height:100px">
                        <div class="full-editor geteditor"></div>
                        <input type="hidden" name="project_summary" class="hidden-field">
                      </div>
                </div>
                <div class="col-md-6">
                      <label for="Type_id" class="form-label">Notes <span class="text-danger">*</span></label>
                       <div class="editor-container">
                        <div class="full-editor geteditor"></div>
                        <input type="hidden" name="notes" class="hidden-field">
                      </div>
                </div>
                
              </div>
              <div class="row mb-4"> 
               <div class="col-sm-12">
                            <div class="form-group">
                                <div class="d-flex mt-2">
                                    <div class="form-check">
                                  <input class="form-check-input" type="checkbox" name="is_public" id="is_public" autocomplete="off">
                                          <label class="form-check-label form_custom_label text-dark-grey pl-2 mr-3 justify-content-start cursor-pointer checkmark-20 pt-1 text-wrap" for="is_public">
                                          Create Public Project
                                                  </label>
                                  </div>
                                </div>
                            </div>
                        </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-12" id="add_project_mem">
                      <label for="Member"class="form-label">Add Project Members</label>
                      <div class="input-group">
                        <select class="form-control form-select select2" name="team_id[]" multiple="multiple" required>
                      @foreach($Employee as $emp)
                          <option value="{{ $emp->id }}">{{ $emp->first_name }}</option>
                      @endforeach
                  </select>


                    </div>
                </div> 
              </div>
              <div class="row mb-4"> 
                      <h4 class="py-3 mb-4 text-dark" id="other_details">
                     <i class="fa fa-caret-down" id="caret_icon"></i> Other Details
                      </h4>

                <div class="col-md-12" id="add_file_div">
                      <label for="Task"  class="form-label">Add File</label>
                          <input type="file" name="Document" class="form-control">
                         

                </div> 
              </div>
                <div class="row mb-4"> 
                      <hr>
                
              </div>
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('Employee/Task/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
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
                $("#add_project_mem").hide(); // Hide the div with id "deadline_date"
            } else {
                $("#add_project_mem").show(); // Show the div with id "deadline_date"
            }
        });
</script>
@endsection