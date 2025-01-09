@extends('layouts.admin')
@section('title', 'Leads')
@section('content')
<style type="text/css">
  /*Copied from bootstrap to handle input file multiple*/
  .btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: normal;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
  }
/*Also */
.btn-success {
  border: 1px solid #c5dbec;
  background: #d0e5f5;
  font-weight: bold;
  color: #2e6e9e;
}
/* This is copied from https://github.com/blueimp/jQuery-File-Upload/blob/master/css/jquery.fileupload.css */
/*.fileinput-button {
  position: relative;
  overflow: hidden;
}

.fileinput-button input {
  position: absolute;
  top: 0;
  right: 0;
  margin: 0;
  opacity: 0;
  -ms-filter: "alpha(opacity=0)";
  font-size: 200px;
  direction: ltr;
  cursor: pointer;
}*/

.thumb {
  height: 80px;
  width: 100px;
/*  border: 1px solid #000;*/
}

ul.thumb-Images li {
  width: 120px;
  float: left;
  display: inline-block;
  vertical-align: top;
  height: 120px;
}

.img-wrap {
  position: relative;
  display: inline-block;
  font-size: 0;
}

.img-wrap .close {
  position: absolute;
  top: 2px;
  right: 2px;
  z-index: 100;
  background-color: #d0e5f5;
  padding: 5px 2px 2px;
  color: #000;
  font-weight: bolder;
  cursor: pointer;
  opacity: 0.5;
  font-size: 23px;
  line-height: 10px;
  border-radius: 50%;
}

.img-wrap:hover .close {
  opacity: 1;
  background-color: #ff0000;
}

.FileNameCaptionStyle {
  font-size: 12px;
}

.modal-body {
    word-wrap: break-word;
}
.no-select {
    user-select: none; /* Standard syntax */
    -webkit-user-select: none; /* Safari */
    -moz-user-select: none; /* Firefox */
    -ms-user-select: none; /* Internet Explorer/Edge */
}

</style>
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">

 @if(Session::has('success'))
 <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
 @endif

 <ul class="nav nav-pills flex-column flex-md-row mb-4">
  <li class="nav-item">
    <button class="nav-link active" id="ProfileButton">
      <i class="ti ti-lock ti-xs me-1"></i>Lead Data
    </button>
  </li>
  <li class="nav-item">
    <button class="nav-link" id="FileButton">
      <i class="ti ti-file ti-xs me-1"></i>Files
    </button>
  </li>
  <li class="nav-item">
    <button class="nav-link" id="FollowUpButton">
      <i class="ti ti-link ti-xs me-1"></i>Follow Up
    </button>
  </li>
  <li class="nav-item">
    <button class="nav-link" id="NotesButton">
      <i class="ti ti-link ti-xs me-1"></i>Lead Note
    </button>
  </li>
</ul>

<div class="row ProfileScreen" >
  <!-- User Sidebar -->
  <div class="col-xl-12 col-lg-12 col-md-5 order-1 order-md-0">
    <!-- User Card -->
    <div class="card mb-4">
       <div class="card-header d-flex justify-content-between">
          
        <h3 class="text-uppercase text-dark">Lead Info</h3>
        <div class="parent">
        <a href="{{url('admin/Leads/edit/'.$user->id)}}"class="btn btn-primary me-3" style="width: 0px;height:fit-content;"><i class="fas fa-edit"></i></a>
        <a href="{{url('admin/Leads/home')}}"class="btn btn-success me-3" style="width: 0px;height:fit-content;"><i class="fas fa-arrow-left"></i></a>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-3 mb-4">
            <span class="fs-6 text-muted me-1" style="font-weight:600;">Full name :</span>
          </div>
          <div class="col-sm-3 mb-4">
           <span>@if($user && $user->gender) {{$user->gender}} @endif . @if($user && $user->first_name){{$user->first_name}} @endif  @if($user && $user->last_name){{$user->last_name}} @endif</span>
         </div>
         <div class="col-sm-3 mb-4">
          <span class="fs-6 text-muted me-1"  style="font-weight:600;">Email</span>
        </div>
        <div class="col-sm-3 mb-4">
         <span>@if($user && $user->email){{$user->email}} @else -- @endif</span>
       </div>
       <div class="col-sm-3 mb-4">
        <span class="fs-6 text-muted me-1" style="font-weight:600;">Action Schedule</span>
      </div>
      <div class="col-sm-3 mb-4">
       <span>@if($user && $user->action_schedule){{$user->action_schedule}} @else -- @endif</span>
     </div>
     <div class="col-sm-3 mb-4">
      <span class="fs-6 text-muted me-1" style="font-weight:600;">Date</span>
    </div>
    <div class="col-sm-3 mb-4">
      <span>
        @if($user && $user->date)
        {{ \Carbon\Carbon::parse($user->date)->format('d-m-y') }}
        @else
        --
        @endif
      </span>
    </div>
    @php
    $assignedto =  \App\Models\User::leftjoin('employee_details','employee_details.user_id','users.id')
    ->leftjoin('roles','roles.id','employee_details.job_role_id')->select('users.id','users.first_name','users.last_name','users.profile_img','roles.name as role')
    ->where('users.id',$user->assignedto)->first();           
    $generated_by =  \App\Models\User::leftjoin('employee_details','employee_details.user_id','users.id')
    ->leftjoin('roles','roles.id','employee_details.job_role_id')->select('users.id','users.first_name','users.last_name','users.profile_img','roles.name as role')
    ->where('users.id',$user->generated_by)->first();      

    @endphp
    <div class="col-sm-3 mb-4">
      <span class="fs-6 text-muted me-1" style="font-weight:600;">Generated By</span>
    </div>
    <div class="col-sm-3 mb-4">
     <!-- <span>@if($generated_by && $generated_by->first_name) {{$generated_by->first_name}} @else -- @endif</span> -->
     <div class="outer_box1" style="
     display: flex;
     "><div class="inner_img" style="
     display: flex;
     align-items: center;
     "><img src="{{$generated_by->profile_img}}" style="
     width: 41px;border-radius: 50%;
     "></div><div class="inner_txt" style="
     display: flex;
     flex-direction: column;border-radius: 50%;
     justify-content: space-between;
     "> <span class="mt-2">{{$generated_by->first_name}} {{$generated_by->last_name}} | emp_{{ $generated_by->id }} <br>( {{$generated_by->role}})</span></div></div>
   </div>
   <div class="col-sm-3 mb-4">
    <span class="fs-6 text-muted me-1" style="font-weight:600;">Assigned To</span>
  </div>
  <div class="col-sm-3 mb-4">

    <div class="outer_box1" style=" display: flex;"><div class="inner_img" style="display: flex;align-items: center;border-radius: 50%;">
       
       
        @if($assignedto && $assignedto->profile_img && $assignedto->first_name)
      <img src="{{$assignedto->profile_img}}" style="width: 41px;border-radius: 50%;"></div><div class="inner_txt" style="display: flex;flex-direction: column;justify-content: space-between;"><span class="mt-2">
            {{$assignedto->first_name}} {{$assignedto->last_name}} | emp_{{ $assignedto->id }} <br>( {{$assignedto->role}})</span></div></div>
    @else
          <img  src="{{url('public/images/21104.png')}}" style="width: 41px;border-radius: 50%;"></div><div class="inner_txt" style="display: flex;flex-direction: column;justify-content: space-between;"><span> -- | -- </span></div></div>

    @endif
  </div>
  <div class="col-sm-3 mb-4">
    <span class="fs-6 text-muted me-1" style="font-weight:600;">Status</span>
  </div>
  <div class="col-sm-3 mb-4">
                            @php
                                          $lead_status =  \App\Models\LeadStatus::select('lead_status','id','label_color')->where('id',$user->status)->first();           

                            @endphp
                                                                                                  <span style="padding: 5px;border-radius: 4px;">{{ucfirst($lead_status->lead_status)}}</span>

                            
   
  </div>
  <div class="col-sm-3 mb-4">
    <span class="fs-6 text-muted me-1" style="font-weight:600;">Contact</span>
  </div>
  <div class="col-sm-3 mb-4">
    <span>@if($user && $user->phone_number){{$user->phone_number}} @else -- @endif </span>
  </div>
  <div class="col-sm-3 mb-4">
    <span class="fs-6 text-muted me-1" style="font-weight:600;">Requirement</span>
  </div>
<div class="col-sm-8 mb-4">
    <span>
        @if($user && $user->requirement)
            <div id="requirementDiv" style="border:1px solid black">
                {!! $user->requirement !!}
            </div>
        @else 
            -- 
        @endif
    </span>
</div>


</div>
</div>
</div>
<!-- /User Card -->
</div>
</div>
<div class="row FileScreen" style="display: none;">
  <div class="col-xl-12 col-lg-12 col-md-5 order-1 order-md-0">
    <!-- User Card -->
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between">
        <h3 class="text-uppercase text-dark">Files</h3>
        <button class="btn btn-primary me-3" style="height:fit-content;" onclick="Addfile({{$user->id}})">Add File</button>
      </div>
      <div class="card-body">
        <table class="table table-hover bg-white rounded">
          <thead class="">
            <tr>
              <th>File name</th>
              <th>Date</th>
              <th class="text-right">Action</th>
            </tr>
          </thead>
          <tbody>
            @if(count($LeadFile) > 0)
            @foreach($LeadFile as $File)
            <tr>
              <td>{{$File->file_name}}</td>
              <td>{{$File->created_at}}</td>
              <td>
                  
                  <a target="_blank" href="{{$File->file}}"><i class="fa-solid fa-eye"></i></a>
              
              &nbsp;&nbsp; <a class="delete_debtcase" url="{{url('admin/Leads/File/delete/'.$File->id.'/'.$user->id)}}" id="{{$File->id}}"><i class="fa-solid fa-trash"></i></a></td>
            </tr>
            @endforeach
            @else
            <tr>
              <td></td>
              <td>No data found</td>
              <td></td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
    <!-- /User Card -->
  </div>
</div>
<div class="row FollowUpScreen" style="display: none;">
  <div class="col-xl-12 col-lg-12 col-md-5 order-1 order-md-0">
    <!-- User Card -->
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between">
        <h3 class="text-uppercase text-dark">Follow Up</h3>
        <button class="btn btn-primary me-3" style="height:fit-content;" onclick="AddFollowUp()">Add</button>
      </div>
      <div class="card-body">
       <table class="table table-hover bg-white rounded">
        <thead class="">
          <tr>
            <th>Created</th>
            <th>Next Follow Up</th>
            <th>Remark</th>
            <th class="text-right">Action</th>
          </tr>
        </thead>
        <tbody>
          @if(count($LeadsFollowup) > 0)
          @foreach($LeadsFollowup as $Followup)
          <tr>
            <td>{{$Followup->created_at}}</td>
            <td>{{$Followup->follow_up_next}}</td>
            <td>{{$Followup->remark}}</td>
            <td>
          
              <a href="#" onclick="EditFollowUp({{$Followup->id}})"><i class="fa-solid fa-edit"></i></a>
              &nbsp;&nbsp;
              <a class="delete_debtcase" url="{{url('admin/LeadsFollowup/delete/'.$Followup->id)}}" id="{{$Followup->id}}"><i class="fa-solid fa-trash"></i></a>
            </td>
          </tr>
          @endforeach
          @else
          <tr>
            <td></td>
            <td>No data found</td>
            <td></td>
          </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
  <!-- /User Card -->
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="requirementModal" tabindex="-1" role="dialog" aria-labelledby="requirementModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requirementModalLabel">Requirement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! $user->requirement !!}
            </div>
        </div>
    </div>
</div>
<div class="row NotesScreen" style="display: none;">
  <div class="col-xl-12 col-lg-12 col-md-5 order-1 order-md-0">
    <!-- User Card -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            <h3 class="text-uppercase text-dark">Note</h3>
            <a href="#" onclick="EditNotesUp({{$user->id}})">Add Note</a>
            &nbsp;&nbsp;
        </div>
        <div class="card-body">
<div id="noteDisplay" style="pointer-events: none;">
    @if($user && $user->note)
        {!! $user->note !!}
    @else
        --
    @endif
</div>

<style>
    #noteDisplay {
        pointer-events: none; /* Prevents any mouse events */
        user-select: none; /* Prevents text selection */
    }
</style>

<script>
    document.getElementById('noteDisplay').setAttribute('tabindex', '-1');
</script>


            <div id="noteEdit" style="display:none">
                <form id="noteForm" action="{{url('admin/Leads/LeadNotesUpdate')}}" method="post">
                    @csrf
                    <div class="editor-container">
                        <div class="full-editor geteditor"></div>
                        <input type="hidden" name="note" class="hidden-field">
                        <input type="hidden" name="lead_id" class="hidden-field"value="{{$user->id}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /User Card -->
</div>

</div>
</div>
<!--Modal start-->
<div class="modal fade" id="FileModal" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
  <div class="modal-dialog">
    <form class="modal-content" action="{{url('admin/Leads/File/store')}}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="backDropModalTitle">
          Files
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <input type="hidden" name="leads_id" value="{{$user->id}}">
      <div class="modal-body">
        <input type="file" name="file[]" id="files" class="form-control" multiple accept="image/jpeg, image/png, image/gif," required><br />
        <output id="Filelist"></output>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">
          Close
        </button>
        <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
      </div>
    </form>
  </div>
</div>
<!--Modal End-->
<!--Modal start-->
<div class="modal fade" id="FollowUpEditModal" data-bs-backdrop="static" tabindex="-1" aria-modal="true" role="dialog"></div>
<div class="modal fade" id="FollowUpModal" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
  <div class="modal-dialog">
    <form action="{{url('admin/LeadsFollowup/store')}}"   class="modal-content" method="post" enctype="multipart/form-data"> 
      @csrf
      <div class="modal-header">
        <h4>Follow UP</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-6 mb-3 text-muted">Lead Name</div>
          <div class="col-sm-6 mb-3">{{$user->first_name}} {{$user->last_name}}</div>
          <div class="col-sm-6 mb-3">
            <label for="Follow Up Next" class="form-label">Follow Up Next</label>
            <input type="date" class="form-control" name="follow_up_next" id="Follow Up Next" required/>
            <input type="hidden" class="form-control" name="leads_id" value="{{$id}}">
          </div>
          <div class="col-sm-6 mb-3">
            <label for="StartTime" class="form-label">Start Time</label>
            <input type="time" class="form-control" name="start_time" id="StartTime" required/>
          </div>
          <!--<div class="col-sm-12 mb-3">-->
          <!--  <div class="form-check form-check-primary mt-3">-->
          <!--    <input class="form-check-input" type="checkbox" value="" id="customCheckPrimary"  name="custom_check_primary" onclick="Sendreminder()">-->
          <!--    <label class="form-check-label" for="customCheckPrimary">Send Reminder</label>-->
          <!--  </div>-->
          <!--</div>-->
          <div class="row" id="Sendreminder"></div>
          <div class="col-sm-12 mb-3">
            <label for="Remark" class="form-label">Remark</label>
            <textarea class="form-control" name="remark"></textarea>
          </div> 
          
          <div class="col-sm-12 mb-3">
            <label for="Remark" class="form-label">Status</label>
                <select class="form-control" name="status" id="status">
                    <option value="0">Pending</option>
                    <option value="1">Completed</option>
                    <option value="2">Due</option>
                    </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">
          Close
        </button>
        <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
      </div>
    </form>
  </div>
</div>
<!--Modal End-->
<!-- / Content -->
<script>
$(document).ready(function() {
    $('#requirementDiv').css('pointer-events', 'none');
});

  function EditFollowUp(id)
  {
    $.ajax({
      url: "{{ url('admin/LeadsFollowup/edit') }}",
      method: 'GET',
      data: { id: id },
      success: function (response) {
        $('#FollowUpEditModal').html(response).modal('show');
      },
      error: function () {
      }
    });
  }

  $(document).ready(function() {
    $("#ProfileButton").click(function() {
      $(this).addClass("active");
      $("#FileButton, #FollowUpButton, #NotesButton").removeClass("active");
      $('.ProfileScreen').show(500);
      $('.FollowUpScreen, .FileScreen, .NotesScreen').hide(500);
    });
    $("#FileButton").click(function() {
      $(this).addClass("active");
      $("#ProfileButton, #FollowUpButton, #NotesButton").removeClass("active");
      $('.FileScreen').show(500);
      $('.FollowUpScreen, .ProfileScreen, .NotesScreen').hide(500);
    });
    $("#FollowUpButton").click(function() {
      $(this).addClass("active");
      $("#ProfileButton, #FileButton, #NotesButton").removeClass("active");
      $('.FollowUpScreen').show(500);
      $('.ProfileScreen, .FileScreen, .NotesScreen').hide(500);
    });
    $("#NotesButton").click(function() {
      $(this).addClass("active");
      $("#ProfileButton, #FileButton, #FollowUpButton").removeClass("active");
      $('.NotesScreen').show(500);
      $('.FollowUpScreen, .FileScreen, .ProfileScreen').hide(500);
    });
  });

  function Addfile(id) {
    $('#FileModal').modal('show');

  }
  function AddFollowUp() {
    $('#FollowUpModal').modal('show');

  }
  function Sendreminder() {
    var reminderContainer = $('#reminderContainer');

    if ($('#customCheckPrimary').prop('checked')) 
    {
      $('#Sendreminder').html('<div class="col-sm-6 mb-3">'+
        '<label for="Remindbefore" class="form-label">Remind before </label>'+
        '<input type="number" class="form-control" name="remind_before" id="Remind before"/>'+
        '</div>'+
        '<div class="col-sm-6 mt-4">'+
        '<select name="remind_type" data-live-search="true" class="form-control select2" tabindex="null">'+
        '<option value="day">Day(s)</option>'+
        '<option value="hour">Hour(s)</option>'+
        '<option value="minute">Minute(s)</option>'+
        '</select>'+
        '</div>');
    }
    else{
      $('#Sendreminder').html('');
    }

  }
</script>
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
    $('#multiselect11').selectpicker();

    $(".delete_debtcase").click(function (e) {
      var id = $(this).attr('id');
      var url = $(this).attr('url');
      e.preventDefault();
      bootbox.confirm({
        message: "Are you sure?",
        buttons: {
          cancel: {
            label: '<i class="fa fa-times"></i> Cancel'
          },
          confirm: {
            label: '<i class="fa fa-check"></i> Delete'
          },
        },
        callback: function (result) {
          if (result) {
            window.location.href = url;
          }
        }
      });
    });
  });
</script>
<script type="text/javascript">
  //I added event handler for the file upload control to access the files properties.
  document.addEventListener("DOMContentLoaded", init, false);

  //To save an array of attachments
  var AttachmentArray = [];

  //counter for attachment array
  var arrCounter = 0;

  //to make sure the error message for number of files will be shown only one time.
  var filesCounterAlertStatus = false;

  //un ordered list to keep attachments thumbnails
  var ul = document.createElement("ul");
  ul.className = "thumb-Images";
  ul.id = "imgList";

  function init() {
    //add javascript handlers for the file upload event
    document
    .querySelector("#files")
    .addEventListener("change", handleFileSelect, false);
  }

  //the handler for file upload event
  function handleFileSelect(e) {
    //to make sure the user select file/files
    if (!e.target.files) return;

    //To obtaine a File reference
    var files = e.target.files;

    // Loop through the FileList and then to render image files as thumbnails.
    for (var i = 0, f; (f = files[i]); i++) {
      //instantiate a FileReader object to read its contents into memory
      var fileReader = new FileReader();

      // Closure to capture the file information and apply validation.
      fileReader.onload = (function(readerEvt) {
        return function(e) {
          //Apply the validation rules for attachments upload
          ApplyFileValidationRules(readerEvt);

          //Render attachments thumbnails.
          RenderThumbnail(e, readerEvt);

          //Fill the array of attachment
          FillAttachmentArray(e, readerEvt);
        };
      })(f);

      // Read in the image file as a data URL.
      // readAsDataURL: The result property will contain the file/blob's data encoded as a data URL.
      // More info about Data URI scheme https://en.wikipedia.org/wiki/Data_URI_scheme
      fileReader.readAsDataURL(f);
    }
    document
    .getElementById("files")
    .addEventListener("change", handleFileSelect, false);
  }

  //To remove attachment once user click on x button
  jQuery(function($) {
    $("div").on("click", ".img-wrap .close", function() {
      var id = $(this)
      .closest(".img-wrap")
      .find("img")
      .data("id");

      //to remove the deleted item from array
      var elementPos = AttachmentArray.map(function(x) {
        return x.FileName;
      }).indexOf(id);
      if (elementPos !== -1) {
        AttachmentArray.splice(elementPos, 1);
      }

      //to remove image tag
      $(this)
      .parent()
      .find("img")
      .not()
      .remove();

      //to remove div tag that contain the image
      $(this)
      .parent()
      .find("div")
      .not()
      .remove();

      //to remove div tag that contain caption name
      $(this)
      .parent()
      .parent()
      .find("div")
      .not()
      .remove();

      //to remove li tag
      var lis = document.querySelectorAll("#imgList li");
      for (var i = 0; (li = lis[i]); i++) {
        if (li.innerHTML == "") {
          li.parentNode.removeChild(li);
        }
      }
    });
  });

  //Apply the validation rules for attachments upload
  function ApplyFileValidationRules(readerEvt) {
    //To check file type according to upload conditions
    if (CheckFileType(readerEvt.type) == false) {
      alert(
        "The file (" +
        readerEvt.name +
        ") does not match the upload conditions, You can only upload jpg/png/gif files"
        );
      e.preventDefault();
      return;
    }

    //To check file Size according to upload conditions
    // if (CheckFileSize(readerEvt.size) == false) {
    //   alert(
    //     "The file (" +
    //     readerEvt.name +
    //     ") does not match the upload conditions, The maximum file size for uploads should not exceed 300 KB"
    //     );
    //   e.preventDefault();
    //   return;
    // }

    //To check files count according to upload conditions
    if (CheckFilesCount(AttachmentArray) == false) {
      if (!filesCounterAlertStatus) {
        filesCounterAlertStatus = true;
        alert(
          "You have added more than 10 files. According to upload conditions you can upload 10 files maximum"
          );
      }
      e.preventDefault();
      return;
    }
  }

  //To check file type according to upload conditions
  function CheckFileType(fileType) {
    if (fileType == "image/jpeg") {
      return true;
    } else if (fileType == "image/png") {
      return true;
    } else if (fileType == "image/gif") {
      return true;
    } else {
      return false;
    }
    return true;
  }

  //To check file Size according to upload conditions
  function CheckFileSize(fileSize) {
    if (fileSize < 1000000) {
      return true;
    } else {
      return false;
    }
    return true;
  }

  //To check files count according to upload conditions
  function CheckFilesCount(AttachmentArray) {
    //Since AttachmentArray.length return the next available index in the array,
    //I have used the loop to get the real length
    var len = 0;
    for (var i = 0; i < AttachmentArray.length; i++) {
      if (AttachmentArray[i] !== undefined) {
        len++;
      }
    }
    //To check the length does not exceed 10 files maximum
    if (len > 9) {
      return false;
    } else {
      return true;
    }
  }

  //Render attachments thumbnails.
  function RenderThumbnail(e, readerEvt) {
    var li = document.createElement("li");
    ul.appendChild(li);
    li.innerHTML = [
      '<div class="img-wrap"> <span class="close">&times;</span>' +
      '<img class="thumb" src="',
      e.target.result,
      '" title="',
      escape(readerEvt.name),
      '" data-id="',
      readerEvt.name,
      '"/>' + "</div>"
      ].join("");

    var div = document.createElement("div");
    div.className = "FileNameCaptionStyle";
    li.appendChild(div);
    div.innerHTML = [readerEvt.name].join("");
    document.getElementById("Filelist").insertBefore(ul, null);
  }

  //Fill the array of attachment
  function FillAttachmentArray(e, readerEvt) {
    AttachmentArray[arrCounter] = {
      AttachmentType: 1,
      ObjectType: 1,
      FileName: readerEvt.name,
      FileDescription: "Attachment",
      NoteText: "",
      MimeType: readerEvt.type,
      Content: e.target.result.split("base64,")[1],
      FileSizeInBytes: readerEvt.size
    };
    arrCounter = arrCounter + 1;
  }
  function EditNotesUp(id) {
    $('#noteDisplay').hide();
    $('#noteEdit').show();
    }

</script>
@endsection

