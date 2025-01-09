

<!-- Include Spectrum CSS and JS files from an alternative CDN -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.js"></script>
 
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Lead Status's List</h5>
      </div>
      <div class="col-md-6 text-end">
          <button type="button" class="btn btn-primary mt-3 m-3" id="openModalBtn">Add</button>

      </div>
    </div>
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_length" id="DataTables_Table_3_length"><label>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
              
            </div>
          </div>
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>Name</th>
                <th>Default Lead Status</th>
                <th>Label Color</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if(count($LeadStatus) > 0)
              @foreach($LeadStatus as $key=> $Inventor)
              <tr class="odd">
                  <td>{{ $key+1 }} </td>
                  <td>@if($Inventor && $Inventor->lead_status) {{ $Inventor->lead_status }} @endif</td>
                  <td>
                    <div class="form-check-inline custom-control custom-radio mt-2 mr-3 set_default_status" data-status-id="1">
                        <input type="radio" value="{{ $Inventor->id }}" class="custom-control-input set-default-radio" id="status_id_{{ $Inventor->id }}" @if($Inventor && $Inventor->is_default) checked @endif name="project_admin" autocomplete="off">
                        <label class="custom-control-label pt-1 cursor-pointer" for="status_id_{{ $Inventor->id }}">Default</label>
                    </div>
                </td>
                <td><span style="width: 20px; background-color:@if($Inventor && $Inventor->label_color) {{ $Inventor->label_color }} @endif" > &nbsp;&nbsp;&nbsp;</span>@if($Inventor && $Inventor->label_color) {{ $Inventor->label_color }} @endif</td>
                  <td>
                    <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end" style="">
                            <li><a class="dropdown-item" href="#" id="{{$Inventor->id}}" onclick="editCategory(this)">Edit</a></li>
                            <li><button class="dropdown-item delete_debtcase" url="{{url('admin/LeadSettings/LeadStatus/delete/'.$Inventor->id)}}" id="{{$Inventor->id}}">Delete</button></li>
                          </ul>
                      </div>
                  </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td class="text-center" colspan="8">No Data Found</td>
              </tr>
              @endif 
            </tbody>
        </table>
          <div class="p-1" style="float: right;">
          </div>
        </div>
      </div>

<!--Modal start-->
<div class="modal fade" id="myModal" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog">
      <form class="modal-content" action="{{url('admin/LeadSettings/LeadStatus/store')}}" method="post">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="backDropModalTitle">Add Lead Status</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label for="category_name" class="form-label">Lead Status <span class="text-danger">*</span></label>
              <input type="text" id="lead_status" class="form-control" name="lead_status" placeholder="e.g. In Progress">
            </div> 
            <div class="col mb-3">
              <label for="category_name" class="form-label">Label Color <span class="text-danger">*</span></label>
                          <div class="input-group d-flex">
                              <input type="color" class="form-control"  id="colorpicker" name="label_color"  style="min-height: 38PX;" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#bada55"> 
                              <input type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" style="min-height: 38PX;" class="form-control"  value="#bada55" id="hexcolor"></input>
                          </div>
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
<div class="modal fade" id="showedit" data-bs-backdrop="statics" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog">
      <form class="modal-content" action="{{url('admin/LeadSettings/LeadStatus/update')}}" method="post">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="backDropModalTitle">Edit Lead Status</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
         <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label for="category_name" class="form-label">Lead Status <span class="text-danger">*</span></label>
              <input type="text" id="editlead_status" class="form-control" name="lead_status" placeholder="e.g. In Progress">
                            <input type="hidden" id="showeditid" class="form-control" name="id">

            </div> 
            <div class="col mb-3">
              <label for="category_name" class="form-label">Label Color <span class="text-danger">*</span></label>
                          <div class="input-group d-flex">
                              <input type="color" class="form-control"  id="edit1colorpicker" name="label_color"  style="min-height: 38PX;" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#bada55"> 
                              <input type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" style="min-height: 38PX;" class="form-control"  value="#bada55" id="edithexcolor"></input>
                          </div>
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
<script>
    $(document).ready(function() {
        // Set the CSRF token in the headers for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.set-default-radio').change(function() {
            // Get the selected radio button value
            var selectedValue = $(this).val();

            // Send AJAX request to update is_default in the backend
            $.ajax({
                type: 'POST',
                url: '{{ url("admin/LeadSettings/LeadStatus/updateIsDefault") }}',
                data: {
                    inventorId: selectedValue
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    });
</script>


<script>
     $('#colorpicker').on('input', function() {
      $('#hexcolor').val(this.value);
    });
    $('#hexcolor').on('input', function() {
      $('#colorpicker').val(this.value);
    });

     $('#edit1colorpicker').on('input', function() {
      $('#edithexcolor').val(this.value);
    });
    $('#edithexcolor').on('input', function() {
      $('#edit1colorpicker').val(this.value);
    });

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
  // Wait for the document to be ready
  $(document).ready(function () {
    $('#openModalBtn').click(function () {
      $('#myModal').modal('show');
    });
  });
  function editCategory(element) {
    var cate_id = $(element).attr('id');

    $.ajax({
        url: "{{ url('admin/LeadSettings/LeadStatus/edit') }}",
        method: 'GET',
        data: { id: cate_id },
        success: function (data) {
          $('#showedit').modal('show');
          var lead_status = data.LeadStatus.lead_status;
          var label_color = data.LeadStatus.label_color;
          var id = data.LeadStatus.id;
          $('#showedit #editlead_status').val(lead_status);
          $('#showedit #editcolorpicker').val(label_color);
          $('#showedit #showeditid').val(id);
        },
        error: function () {
            $('#showedit .modal-content').html('<div>Error fetching data.</div>');
            $('#showedit').modal('show');
        }
    });
}
</script>
