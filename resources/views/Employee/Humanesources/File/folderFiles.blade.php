<div class="col-12 mt-4">
    <div class="card">
        <div class="card-body">
<div class="d-flex" style="
    justify-content: space-between;
">
               <div class="overflow-hidden d-flex  ">
                <div class="me-3">
                    <div class="avatar-sm align-self-center">
                        <div class="avatar-title rounded-circle bg-success-subtle text-success font-size-24" style="background-color:#f5cca69c">
                            <i class="mdi mdi-folder font-size-30 text-warning mr-2"></i>
                        </div>
                    </div>
                </div>
                <h5>{{ substr(str_replace('_', ' ', $folder->folder_name), 0, 22) }} </h5>
            </div> 
       <div class="mid_img">
                                               @if($folder && $folder->share_ids)
            <div class="overflow-hidden d-flex">
                 @php
                                                             $ids = explode(',', $folder->share_ids); // Convert comma-separated string to an array
                                                             $users = App\Models\User::whereIn('id', $ids)
                                                                            ->select('id', 'first_name', 'last_name', 'profile_img')
                                                                            ->get();
                                                            @endphp
                  <div class="avatar-group d-flex">
                                                                    
                                                                     <ul class="list-unstyled m-0 d-flex align-items-center avatar-group my-3">
                                                                      @foreach($users as $teaml)
                                                                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" data-bs-original-title="{{$teaml->first_name}}">
                                                                         <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{isset($teaml->profile_img) ? $teaml->profile_img : url('public/images/21104.png')}}" height="30" width="30" alt="User avatar" />
                                                                      </li>
                                                                        @endforeach()
                                                                    </ul>
                                                                
                                                                </div>
                     

                                                                  
            </div>
            @endif
            </div>
              </div>
            @if(count($sub_folder)>0)  <h5 class="font-size-16 me-3 mb-0 mt-4" id="div_name"></h5>
                                    <div class="row mt-4" id="folders-container">
                                        @if($sub_folder)
                                       @foreach($sub_folder as $department_folder)
                                                        @php
                                                            $count_files = App\Models\File::where('sub_folder_id', $department_folder->id)->count();
                                                    $LstFile = App\Models\File::where('sub_folder_id', $department_folder->id)->latest()->first(); // Get the latest file in the folder
                                                    $ids = explode(',', $department_folder->share_ids); // Convert comma-separated string to an array
                                                    $users = App\Models\User::whereIn('id', $ids)
                                                                            ->select('id', 'first_name', 'last_name', 'profile_img')
                                                                            ->get();
                                                @endphp
                                                <div class="col-xl-4 col-sm-6 mb-3 mt-2">
                                                    <div class="card ">
                                                        <div class="card-body p-3">
                                                            <div class="dropdown float-end">
                                                                <a class="text-muted dropdown-toggle font-size-16" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                    <i class="mdi mdi-dots-horizontal font-size-20"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a class="dropdown-item edit-sub-folder" href="#" data-id="{{ $department_folder->id }}" data-name="{{ $department_folder->sub_folder_name }}" data-bs-target="#edit-sub-folder" data-bs-toggle="modal">Edit</a>
                                                                    <a class="dropdown-item share-sub-folders" href="#" data-id="{{ $department_folder->id }}" data-name="{{ $department_folder->sub_folder_name }}" data-bs-target="#share-folder" data-bs-toggle="modal">Share</a>
                                                                    @if($department_folder->id > 5)
                                                                        <a class="dropdown-item delete-folder" href="#" data-id="{{ $department_folder->id }}">Remove</a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="overflow-hidden">
                                                                <div class="me-3">
                                                                    <div class="avatar-sm align-self-center">
                                                                        <div class="avatar-title rounded-circle bg-success-subtle text-success font-size-24" style="background-color:#f5cca69c">
                                                                            <i class="mdi mdi-folder font-size-30 text-warning mr-2"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mt-3 pt-1 open-subfolders-files" data-id="{{$department_folder->id}}">
                                                                <h5 class="font-size-15 mb-1 text-truncate">{{ substr(str_replace('_', ' ', $department_folder->sub_folder_name), 0, 20) }}</h5>
                                                                <div class="d-flex justify-content-between">
                                                                    <!--<p class="text-muted font-size-13">15GB <span>/</span> 25GB used</p>-->
                                                                    <p class="text-muted font-size-13">{{ $count_files }} files</p>
                                                                </div>
                                                            </div>
                                                            <div class="">
                                                                <p class="text-muted mb-0 font-size-13"><i class="mdi mdi-clock-time-five-outline align-middle me-1"></i>Last changes: {{ $LstFile ? $LstFile->created_at : '--' }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                        @endforeach
                                        @else
                                         <h6 class="font-size-16 me-3 mb-0 mt-4">No Sub Folder</h6>
                                        @endif
                                    </div>
            @endif
            
            <h5 class="font-size-16 me-3 mb-0 mt-4"><span id="folder_name">File Lists</span></h5>
            <div class="overflow-hidden d-flex mt-4">   
                <table id="invoiceListTable" class="invoice-list-table table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>File Name</th>
                            <th class="cell-fit">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($files) > 0)
                        @foreach($files as $key => $Inventor)
                        <tr class="odd">
                            <td>{{$Inventor->id}}</td>
                            <td>
                                    @switch($Inventor->type)
                                        @case('image')
                                            <i class="mdi mdi-image"></i>
                                            @break
                                
                                        @case('audio')
                                            <i class="mdi mdi-music"></i>
                                            @break
                                
                                        @case('document')
                                            <i class="mdi mdi-file"></i>
                                            @break
                                            @case('video')
                                            <i class="mdi mdi-video"></i>
                                            @break
                                
                                        @case('other')
                                        @default
                                            <i class="mdi mdi-file-document-multiple-outline"></i>
                                            @break
                                    @endswitch
                                    {{$Inventor->document_name}}
                                </td>

                          
                                    <td>
    @php
        $permissions = explode(',', $Inventor->user_permissions);
        $isOwner = $Inventor->user_id == Auth::id(); // Check if the logged-in user is the owner of the file
    @endphp

    @if($Inventor->sub_folder_id == 0)
        @if($isOwner)
            <a class="dropdown-item view_media" href="#" data-bs-target="#view-media" data-url="{{ $Inventor->documents }}" data-id="{{ $Inventor->id }}" data-type="{{ $Inventor->type }}" data-bs-toggle="modal">
                <i class="fa fa-eye"></i>
            </a>
            <a class="dropdown-item" href="#" data-bs-target="#share-file-modal" data-bs-toggle="modal">
                <i class="fa fa-share"></i>
            </a>
            <a class="delete-file" href="#" data-id="{{ $Inventor->id }}">
                <i class="fa fa-trash"></i>
            </a>
        @else
            @if(in_array('view', $permissions) || in_array('all', $permissions))
                <a class="dropdown-item view_media" href="#" data-bs-target="#view-media" data-url="{{ $Inventor->documents }}" data-id="{{ $Inventor->id }}" data-type="{{ $Inventor->type }}" data-bs-toggle="modal">
                    <i class="fa fa-eye"></i>
                </a>
            @endif

            {{-- Check for 'share' or 'all' permissions --}}
            @if(in_array('share', $permissions) || in_array('all', $permissions))
                <a class="dropdown-item" href="#" data-bs-target="#share-file-modal" data-bs-toggle="modal">
                    <i class="fa fa-share"></i>
                </a>
            @endif

            {{-- Check for 'delete' or 'all' permissions --}}
            @if(in_array('delete', $permissions) || in_array('all', $permissions))
                <a class="delete-file" href="#" data-id="{{ $Inventor->id }}">
                    <i class="fa fa-trash"></i>
                </a>
            @endif
        @endif
    @else
         @if($isOwner)
                <a class="dropdown-item view_media" href="#" data-bs-target="#view-media" data-url="{{ $Inventor->documents }}" data-id="{{ $Inventor->id }}" data-type="{{ $Inventor->type }}" data-bs-toggle="modal">
                    <i class="fa fa-eye"></i>
                </a>
                <!--<a class="dropdown-item" href="#" data-bs-target="#share-file-modal" data-bs-toggle="modal">-->
                <!--    <i class="fa fa-share"></i>-->
                <!--</a>-->
                <a class="delete-file" href="#" data-id="{{ $Inventor->id }}">
                    <i class="fa fa-trash"></i>
                </a>
                @else
            <a class="dropdown-item view_media" href="#" data-bs-target="#view-media" data-url="{{ $Inventor->documents }}" data-id="{{ $Inventor->id }}" data-type="{{ $Inventor->type }}" data-bs-toggle="modal">
                <i class="fa fa-eye"></i>
            </a>
            <!--<a class="dropdown-item" href="#" data-bs-target="#share-file-modal" data-bs-toggle="modal">-->
            <!--    <i class="fa fa-share"></i>-->
            <!--</a>-->
            @endif
    @endif
</td>


                                    </tr>
                                @endforeach
                        @else
                        <tr>
                            <td class="text-center" colspan="3">No Data Found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="view-media" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content show_media_box">
          
        </div>
    </div>
</div>
<div class="modal fade" id="share-file-modal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ url('Employee/FileManagement/e-share-file') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4>Share File</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <hr>
                <div class="modal-body">
                    <label>Folder</label>
                    <select class="form-control" name="folder_id" id="folder_id1" required>
                        <option value="">Select Folder</option>
                        @foreach($folders as $folder)
                            <option value="{{ $folder->id }}">{{ $folder->folder_name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="modal-body">
                    <label>File</label>
                    <select class="form-control" name="file_id" id="file_id1" required>
                       
                    </select>
                </div>
                <div class="modal-body">
                    <label>Employee</label>
                   <select class="form-control" name="share_ids[]"  id="share_ids12">
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}">{{ $emp->first_name }} {{ $emp->last_name }}</option>
                        @endforeach
                      </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-sub-folder" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ url('Employee/FileManagement/e-update-sub-folder') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h4>Edit Folder</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <hr>
                <div class="modal-body">
                    <label>Folder Name</label>
                    <input type="text" class="form-control" name="folder_name" id="folder_name_edit_sub" placeholder="Folder Name" required />
                    <input type="hidden" class="form-control" name="folder_id" id="folder_id_edit_sub" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  $(document).ready(function() {
            $('.select3').select2();
        });
 $(document).ready(function () {
    $(document).on('change', '#folder_id1', function (e) {
        e.preventDefault();
        var folderId = $(this).val();
        var url = '/Employee/FileManagement/e-get-folder-files/' + folderId;
        var url1 = '/Employee/FileManagement/e-get-department-emp/' + folderId;

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function (response) {
                // Assuming response is an array of files
                var fileSelect = $('#file_id1');
                fileSelect.empty(); // Clear previous options

                if(response.length > 0) {
                    $.each(response, function (index, file) {
                        fileSelect.append('<option value="' + file.id + '">' + file.document_name + '</option>');
                    });
                } else {
                    fileSelect.append('<option value="">No files available</option>');
                }
            },
            error: function () {
                bootbox.alert('An error occurred while retrieving the folder files.');
            }
        });
        
        $.ajax({
            url: url1,
            type: 'GET',
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function (response) {
                // Assuming response is an array of files
              
            },
            error: function () {
                bootbox.alert('An error occurred while retrieving the folder files.');
            }
        });
    });
});

$(document).on('click', '.delete-file', function (e) {
    e.preventDefault();
    var fileId = $(this).data('id');
    var url = '/Employee/FileManagement/e-delete-folder-files/' + fileId;

    bootbox.confirm({
        message: "Are you sure you want to delete this file?",
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
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            bootbox.alert(response.message);
                        }
                    },
                    error: function () {
                        bootbox.alert('An error occurred while deleting the file.');
                    }
                });
            }
        }
    });
});

  
$(document).on('click', '.view_media', function () {
    var type = $(this).data('type');
    var id = $(this).data('id');

  var url = $(this).data('url'); // Assuming this already contains the path from the database column

  
    // Construct the full URL
    var correctedUrl = url;


    if (type == 'image') {
        $('.show_media_box').html('<img src="' + correctedUrl + '" style="width:100%">');
    } else if (type == 'video') {
        $('.show_media_box').html('<video controls src="' + correctedUrl + '" style="width:100%"></video>');
    } else if (type == 'audio') {
        $('.show_media_box').html('<audio controls src="' + correctedUrl + '" style="width:100%"></audio>');
    } else if (type == 'document') {
        $('.show_media_box').html('<iframe src="' + correctedUrl + '" style="width:130%; height:600px;"></iframe>');
    }
});
     $(document).on('click', '.open-department-folder', function () {
        $("#folders-container").show();
        $("#files-container").hide();
                            $("#div_name").html('Department Folders');

    });

</script>
