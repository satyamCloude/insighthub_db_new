<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js" ></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.css"  />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.js" ></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css"/>
<style>
.modal-dialog {
    max-width: 90%;
}

#image {
    max-width: 100%;
    height: auto;
}

</style>
<div class="modal-dialog modal-lg" style="width:50%">
  <form class="modal-content" action="{{url('Employee/MyProfile/update/')}}" method="post" enctype="multipart/form-data">
    @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="backDropModalTitle">Edit Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
            <div class="modal-body">
                <div class="input-group mt-5 mb-3">
                          <select name="gender" class="form-select">
                            <option value="" >Select Gender</option>
                            <option @if($user && $user->gender == "Mr") selected @endif  value="Mr"> Mr.</option>
                            <option @if($user && $user->gender == "Miss") selected @endif  value="Miss"> Miss.</option>
                          </select>
                          <input type="text" name="first_name" placeholder="First name"@if($user && $user->first_name) value="{{$user->first_name}}" @endif class="form-control"/>
                          <input type="text" name="last_name" placeholder="Last name"@if($user && $user->last_name) value="{{$user->last_name}}" @endif class="form-control"/>
                </div>
                <div class="row mb-4"> 
                  <div class="col-md-12">
                        <label for="phone_number" class="form-label">Phone number</label>
                    <input type="number" name="phone_number" placeholder="+9414177140" @if($user && $user->phone_number) value="{{$user->phone_number}}" @endif class="form-control"/>
                  </div>
                </div>
                <div class="row mb-4"> 
                  <div class="col-md-6">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" placeholder="name@example.com" @if($user && $user->email) value="{{$user->email}}" @endif class="form-control"/>
                  </div>
                  <div class="col-md-6">
                    <div class="form-password-toggle">
                      <label class="form-label" for="basic-default-password32">Password</label>
                      <div class="input-group input-group-merge">
                        <input type="password" class="form-control" name="password" id="basic-default-password32" value="{{ old('password') }}" placeholder="············" aria-describedby="basic-default-password">
                        <span class="input-group-text cursor-pointer" id="basic-default-password"><i class="ti ti-eye-off"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mb-4"> 
                  <div class="col-md-6">
                        <div class="avatar-preview">
                           <img id="uploadedProfile" width="100" height="100"  name="profile_img" @if($user && $user->profile_img) src="{{$user->profile_img}}" @endif alt="Preview" />
                        </div>
                  </div>
                  <div class="col-md-6">
                    <label for="" class="form-label">Profile Picture <span class="text-danger">*</span></label>
                      <div class="avatar-upload">
                        <div class="avatar-edit">
                           <input type="file" id="profilePictureInput"  name="profile_img"   class="image" accept=".png, .jpg, .jpeg" />
                           <label for="imageUpload"></label>
                        </div>
                      </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                  <button type="submit" class="btn btn-success">Submit</button>
            </div> 
  </form>
</div>   
<!-- Cropping Modal -->
<div id="modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <img id="image" src="" alt="Picture">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" id="crop" class="btn btn-primary">Crop</button>
            </div>
        </div>
    </div>
</div>

<script>
  document.querySelectorAll('.toggle-password').forEach(item => {
    item.addEventListener('click', function() {
        var targetId = this.getAttribute('data-target');
        var passwordInput = document.getElementById(targetId);
        var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
    });
});


var $modal = $('#modal');
var image = document.getElementById('image');
var cropper;
$("body").on("change", ".image", function(e) {
  var files = e.target.files;
  var done = function(url) {
    // Check if the modal is open to avoid setting the image source when changing
    // without confirming the crop
    if (!$modal.hasClass('show')) {
       // alert();
      image.src = url;
      $modal.modal('show');
    }
  };

  var reader;
  var file;

  if (files && files.length > 0) {
    file = files[0];
    if (URL) {
      done(URL.createObjectURL(file));
    } else if (FileReader) {
      reader = new FileReader();
      reader.onload = function(e) {
        done(reader.result);
      };
      // reader.readAsDataURL(file);
    }
  }
});

$modal.on('shown.bs.modal', function() {
  cropper = new Cropper(image, {
    aspectRatio: 16 / 16,
    crop: function(e) {
      console.log(e.detail.x);
      console.log(e.detail.y);
    }
  });
}).on('hidden.bs.modal', function() {
  cropper.destroy();
  
  cropper = null;

});


$("#crop").click(function() {
  canvas = cropper.getCroppedCanvas({
    width: 200,
    height: 300,
  });

    // Set canvas rendering quality
  var cropperCanvas = cropper.getCroppedCanvas({
    imageSmoothingQuality: 'high',
  });
  
  cropperCanvas.toBlob(function(blob) {
    url = URL.createObjectURL(blob);
    var reader = new FileReader();
    reader.readAsDataURL(blob);
    reader.onloadend = function() {
      var base64data = reader.result;
      $('#uploadedProfile').attr('src', base64data);

      // Create a new File object with the cropped blob
      var croppedFile = new File([blob], 'cropped_image.jpg', { type: 'image/jpeg' });

      // Create a new FileList containing the cropped file
      var filesList = new DataTransfer();
      filesList.items.add(new File([croppedFile], 'cropped_image.jpg'));

      // Set the new FileList as the value of the input type file
      $('#profilePictureInput')[0].files = filesList.files;

      $modal.modal('hide');
    };
  });
});


$(".close1").click(function(){
    // alert();
    $('#profilePictureInput').val(null);
});
    function displayFileName(inputId, displayId) {
        var input = document.getElementById(inputId);
        var display = document.getElementById(displayId);

        if (input.files.length > 0) {
            var fileName = input.files[0].name;
            display.innerText = fileName;
        } else {
            display.innerText = 'Choose File';
        }
    }

</script>
