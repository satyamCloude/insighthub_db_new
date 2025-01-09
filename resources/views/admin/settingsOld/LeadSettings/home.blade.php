<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
          <div class="card-header sticky-element bg-label-secondary mb-4 p-2">
                   <div class="row">
                        <div class="col-md-4 d-flex justify-content-center align-self-baseline">
                            <input type="radio" name="leadsetting" onclick="TVINETab(value)" id="radio1" checked value="source">&nbsp;&nbsp;
                            <label for="radio1">Lead Source</label>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center align-self-baseline">
                            <input type="radio" name="leadsetting" id="radio2" onclick="TVINETab(value)" value="status">&nbsp;&nbsp;
                            <label for="radio2">Lead Status</label>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center align-self-baseline">
                            <input type="radio" name="leadsetting" id="radio3" onclick="TVINETab(value)" value="category">&nbsp;&nbsp;
                            <label for="radio3">Lead Category</label>
                        </div>
                    </div>
            </div>
            <div class="card-body">
                    <div id="TBView">
                           <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Lead Source's List</h5>
      </div>
      <div class="col-md-6 text-end">
          <button type="button" class="btn btn-primary mt-3 m-3" onclick="openModalBtn()">Add</button>

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
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if(count($LeadSource) > 0)
              @foreach($LeadSource as $key=> $Inventor)
              <tr class="odd">
                  <td>{{ $key+1 }} </td>
                  <td>@if($Inventor && $Inventor->name) {{ $Inventor->name }} @endif</td>
                  <td>
                    <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end" style="">
                            <li><a class="dropdown-item" href="#" id="{{$Inventor->id}}" onclick="editCategory(this)">Edit</a></li>
                            <li><button class="dropdown-item delete_debtcase" url="{{url('admin/LeadSettings/LeadSource/delete/'.$Inventor->id)}}" id="{{$Inventor->id}}">Delete</button></li>
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
                    </div>

          </div>      
      </div>
    </div>
    <!-- /Sticky Actions -->
  </div>
<!--Modal start-->
<div class="modal fade" id="myModal" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog">
      <form class="modal-content" action="{{url('admin/LeadSettings/LeadSource/store')}}" method="post">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="backDropModalTitle">Add Lead Source</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label for="category_name" class="form-label">Lead Source <span class="text-danger">*</span></label>
              <input type="text" id="name" class="form-control" name="name" placeholder="Enter Category Name">
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
      <form class="modal-content" action="{{url('admin/LeadSettings/LeadSource/update')}}" method="post">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="backDropModalTitle">Edit Lead Source</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label for="category_name" class="form-label">Lead Source <span class="text-danger">*</span></label>
              <input type="text" id="showeditname" class="form-control" name="name" placeholder="Enter Category Name">
              <input type="hidden" id="showeditid" class="form-control" name="id">
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
      window.onload = function() {
          var tabs = "source";
          if (tabs) {
              TVINETab(tabs);
          }
    }
    </script>
<script>
   function TVINETab(value) {
    $.ajax({
        url: "{{ url('admin/LeadSettings/VINETab') }}",
        method: 'GET',
        data: { type: value },
        success: function (response) {
            $('#TBView').html(response);
        },
        error: function () {
        }
    });
}
  function openModalBtn() {
      $('#myModal').modal('show');

    }
  function editCategory(element) {
    var cate_id = $(element).attr('id');

    $.ajax({
        url: "{{ url('admin/LeadSettings/LeadSource/edit/') }}",
        method: 'GET',
        data: { id: cate_id },
        success: function (data) {
          $('#showedit').modal('show');
          var name = data.LeadSource.name;
          var id = data.LeadSource.id;
          $('#showedit #showeditname').val(name);
          $('#showedit #showeditid').val(id);
        },
        error: function () {
            $('#showedit .modal-content').html('<div>Error fetching data.</div>');
            $('#showedit').modal('show');
        }
    });
}

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