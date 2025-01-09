<div class="col-12 mt-4">
    <div class="card">
       
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

                            <td class="d-flex"> 
                              <a class="dropdown-item sharing-file" href="#" data-id="{{ $Inventor->id }}" data-name="{{ $Inventor->document_name }}" data-bs-target="#share-file-modal" data-bs-toggle="modal"> <i class="fa fa-share font-size-20 text-muted me-2"></i></a>
                                 <a class="delete-file" href="#" data-id="{{ $Inventor->id }}"><i class="fa fa-trash"></i> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 
                         <a class="dropdown-item view_medias" href="#" data-bs-target="#view-media"  data-url="{{ $Inventor->documents }}"  data-id="{{ $Inventor->id }}"  data-type="{{ $Inventor->type }}" data-bs-toggle="modal"> <i class="fa fa-eye font-size-20 text-muted me-2"></i></a>

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
<!--for edit folder-->
<!-- Modal Structure -->
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
                <input type="hidden" name="file_id" id="share_file_id">
                <div class="modal-body">
                    <label>Employee</label>
                    <select class="form-control" name="share_ids[]" multiple id="share_file_emp_id"></select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery Script -->

<div class="modal fade" id="edit-sub-folder" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ url('Employee/FileManagement/update-sub-folder') }}" method="POST">
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
<div class="modal fade" id="share-sub-folder" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ url('Employee/FileManagement/e-share-sub-folder') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4>Share Folder</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <hr>
                <div class="modal-body">
                    <label>Folder</label>
                    <input type="text" class="form-control" name="folder_name" id="share_folder_name_sub" placeholder="Folder Name" required readonly />
                    <input type="hidden" class="form-control" name="folder_id" id="share_folder_id_sub" />
                </div>
                <div class="modal-body">
                    <label>Employee</label>
                    <select class="form-control select2" name="share_sub_employee_id[]" multiple required></select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
 $(document).ready(function () {
    
    $(document).on('change', '#folder_id1', function (e) {
        e.preventDefault();
        var folderId = $(this).val();
        var url = '/Employee/FileManagement/get-folder-files/' + folderId;
        var url1 = '/Employee/FileManagement/get-department-emp/' + folderId;

     $.ajax({
    url: url,
    type: 'GET',
    data: {
        "_token": "{{ csrf_token() }}",
    },
    success: function (response) {
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
  $(document).on('click', '.view_medias', function () {
    var type = $(this).data('type');
    var id = $(this).data('id');
    var url = $(this).data('url'); // Assuming this already contains the path from the database column
    // // Add 'public/' before the path from the database column if not present
    // if (!url.startsWith('public/')) {
    //     url = 'public/' + url;
    // }

    var correctedUrl = url;

    if (type == 'image') {
        $('.show_media_box').html('<img src="' + correctedUrl + '" style="width:100%">');
    } else if (type == 'video') {
        $('.show_media_box').html('<video controls src="' + correctedUrl + '" style="width:100%"></video>');
    } else if (type == 'audio') {
        $('.show_media_box').html('<audio controls src="' + correctedUrl + '" style="width:100%"></audio>');
    } else if (type == 'document') {
        $('.show_media_box').html('<iframe src="' + correctedUrl + '" style="width:100%; height:500px;"></iframe>');
    }
});


     $(document).on('click', '.open-department-folder', function () {
        $("#folders-container").show();
        $("#files-container").hide();
        $("#div_name").html('Department Folders');

    });
    
$(document).on('click', '.sharing-file', function () {
    var id = $(this).data('id');
    var folderid = $(this).data('folderid');
    var name = $(this).data('name');
    $("#share_file_id").val(id);
    
    $.ajax({
        url: '{{ url('Employee/FileManagement/e-get-employees') }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            folder_id: folderid
        },
        success: function (data) {
            var employeeSelect = $('select[id="share_file_emp_id"]');
            employeeSelect.empty(); // Clear the existing options

            $.each(data, function (key, employee) {
                employeeSelect.append('<option value="' + employee.id + '">' + employee.first_name + ' ' + employee.last_name + '</option>');
            });

            // Reinitialize select2
            employeeSelect.select2({
                dropdownParent: $('#share-file-modal') // Ensure the dropdown is displayed within the modal
            });
        },
        error: function (xhr) {
            console.error('An error occurred:', xhr.responseText);
        }
    });
});

</script>
