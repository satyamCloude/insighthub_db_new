@extends('layouts.admin')
@section('title', 'Special Offers')
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
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Special Offers /</span> Add</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="{{url('Employee/SpecialOffers/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('Employee/SpecialOffers/store')}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="company_name" class="form-label">Name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="name" placeholder="ABC PVT LTD" required/>
                </div>
               <!--  <div class="col-md-6">
                      <label for="url" class="form-label">URL <span class="text-danger">*</span></label>
                      <input type="url" class="form-control" name="url" placeholder="ABC Back" required/>
                </div> -->
              </div>
               <div class="row mb-4"> 
                         <div class="col-md-6">
                            <label for="exampleFormControlInput1" class="form-label">Attachment <span class="text-danger">*</span></label>
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <!-- Update the input type to 'file' -->
                                        <input type="file" id="imageUpload"  name="attachment" accept=".png, .jpg, .jpeg" required />
                                        <label for="imageUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <!-- Add an 'img' tag for image preview -->
                                        <img id="imagePreview" width="100%" name="attachment" src="http://i.pravatar.cc/500?img=7" alt="Preview" />
                                    </div>
                                </div>
                        </div>
                </div>
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('Employee/SpecialOffers/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
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
    // Function to read and display the selected image
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                // Set the 'src' attribute of the 'img' tag
                $('#imagePreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    // Bind the 'change' event to the file input
    $("#imageUpload").change(function() {
        readURL(this);
    });
</script>
@endsection