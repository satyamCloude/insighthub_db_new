@extends('layouts.admin')
@section('title', 'File Management')
@section('content')
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

<style type="text/css">
  .actives{
    border: 0px solid #1ff11f;
    padding: 0px 1px 0px 17px;
    border-radius: 146px;
    background: #1ff11f;
    }

  .inactives{
    border: 0px solid red;
    padding: 0px 1px 0px 17px;
    border-radius: 146px;
    background: red;
    }
    .orangecose{
    border: 0px solid orange;
    padding: 0px 1px 0px 17px;
    border-radius: 146px;
    background: orange;
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">File Management /</span> {{ $section }}</h4>
   @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
  <div class="row g-4 mb-4">
  </div>
  <!-- Users List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">File Management's List</h5>
      </div>
      <div class="col-md-6 text-end">
        <a href="{{url('admin/FileManagement/home')}}" class="btn btn-warning mt-3 m-3">Back</a>
          <!-- <a href="{{url('admin/Client/add')}}" class="btn btn-primary mt-3 m-3">Add</a> -->
      </div>
    </div>
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_length" id="DataTables_Table_3_length"><label>
              </div>
            </div>
            
          </div>
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>File Name</th>
                <th>Created</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @if(count($data) > 0)
             @foreach($data as $key=> $user)
              <tr class="odd">
                  <td>{{ $key+1 }} </td>
                  <td>{{ $user->Document }}</td>
                  <!-- <td>@if($user && $user->company_name) {{ $user->company_name }} @endif</td> -->
                  <td>{{ $user->created_at->format('Y-m-d') }}</td>
                  
                  <td>
                    <div class="btn-group">
                           <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </button> 
                          <ul class="dropdown-menu dropdown-menu-end" style="">
                        <li><a class="dropdown-item view-file" data-file="{{ $user->Document }}" href="#">View</a></li>
                            <!-- <li><a class="dropdown-item" href="{{url('admin/FileManagement/ShowUserFileList/'.$user->id.'/'.$section)}}">Download</a></li> -->
                            <!-- <li><a class="dropdown-item" href="{{url('admin/Client/edit/'.$user->id)}}">Edit</a></li> -->
                            <!-- <li><button class="dropdown-item delete_debtcase" url="{{url('admin/Client/delete/'.$user->id)}}" id="{{$user->id}}">Delete</button></li> -->
                          </ul>
                      </div>
                  </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td class="text-center" colspan="7">No Data Found</td>
              </tr>
              @endif
            </tbody>
        </table>
          <div class="p-1" style="float: right;">
              {{ $data->links() }}
          </div>
      </div>
      </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="fileModal">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">File Viewer</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div id="fileContent"></div>
         </div>
         <div class="modal-footer">
            <a id="downloadButton" class="btn btn-primary" download>Download</a>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<script>
    $(document).ready(function () {

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
<script>
   $(document).ready(function () {
      $('.view-file').on('click', function (e) {
         e.preventDefault();
         var file = $(this).data('file');
         var fileExtension = getFileExtension(file);
         $('#fileContent').empty();

         if (fileExtension === 'jpg' || fileExtension === 'webp'|| fileExtension === 'png') {
            $('#fileContent').html('<img src="' + encodeURI(file) + '" class="img-fluid" alt="File Preview">');
         } else if (fileExtension === 'pdf') {
            var pdfViewerUrl = '{{ url("admin/FileManagement/ShowUserFileList/pdf-viewer", ["file" => ":file"]) }}';
            pdfViewerUrl = pdfViewerUrl.replace(':file', encodeURIComponent(file));
            $('#fileContent').html('<iframe src="' + pdfViewerUrl + '" class="pdf-viewer" frameborder="0"></iframe>');
         } else {
            $('#fileContent').html('<p>Unsupported file type</p>');
         }

         $('#downloadButton').attr('href', '{{ url("admin/FileManagement/ShowUserFileList/download", ["file" => ":file"]) }}'.replace(':file', encodeURIComponent(file)));
         $('#downloadButton').attr('download', file);

         $('#fileModal').modal('show');
      });

      function getFileExtension(file) {
         return file.split('.').pop().toLowerCase();
      }
   });
</script>


@endsection