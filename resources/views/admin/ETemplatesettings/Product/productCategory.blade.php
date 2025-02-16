
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Product Category</h5>
      </div>
      <div class="col-md-6 text-end">
         <button type="button" onclick="Tab(value)" value="ServiceAutomation" class="btn btn-warning"><i class="fas fa-sync-alt"></i></button>
          <a href="#" class="btn btn-info waves-effect waves-light mt-3 m-3" data-bs-toggle="modal" data-bs-target="#backDropModal">Add Category</a>
         
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
              <div id="DataTables_Table_3_filter" class="dataTables_filter">
                 <form method="GET" action="">    
                  <label>Search: <input type="search" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                </form>
            </div>
          </div>
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>Category Name</th>
                <th>Tag Line</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="result">
            @if(count($Category) > 0)

              @foreach($Category as $key=> $Cat)
              <tr class="bg-secondary5">
                  <td>{{$key+1}}</td>
                  <td>@if($Cat && $Cat->category_name) {{ $Cat->category_name }} @endif</td>
                  <td>@if($Cat && $Cat->tag_line) {{ $Cat->tag_line }} @endif</td>
                  <td>
                    <div class="btn-group">
                          <button type="button" class="btn btn-info btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end" style="">
                            <li><a class="dropdown-item" href="#" id="{{$Cat->id}}" onclick="editCategory(this)">Edit</a></li>
                            <li><button class="dropdown-item delete_debtcase1" url="{{url('admin/Category/delete/'.$Cat->id)}}" id="{{$Cat->id}}">Delete</button></li>
                          </ul>
                      </div>
                  </td>
              </tr>
               
              @endforeach
              @else
              <tr>
                <td class="text-center" colspan="5">No Data Found</td>
              </tr>
              @endif
            </tbody>
        </table>
          <div class="p-1" style="float: right;">
              {{ $Category->links() }}
          </div>
      </div>
      </div>
    </div>
  </div>
<!--Modal start-->
<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog">
      <form class="modal-content" action="{{url('admin/Category/store')}}" method="post">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="backDropModalTitle">Add Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label for="category_name" class="form-label">Category Name <span class="text-danger">*</span></label>
              <input type="text" id="category_name" class="form-control" name="category_name" placeholder="Enter Category Name">
            </div>
          </div>
         <!--  <div class="row g-2">
            <div class="col mb-3">
              <label for="url" class="form-label">Url</label>
              <input type="text" readonly id="url" class="form-control" value="{{ url('/') }}" name="url" placeholder="https://www.google.com/">
            </div>
          </div> -->
          <div class="row g-2">
            <div class="col mb-3">
              <label for="tag_line" class="form-label">Category Tag Line <span class="text-danger">*</span></label>
              <input type="text" id="tag_line" class="form-control" name="tag_line" placeholder="Tag Line">
            </div>
          </div>
         <!--  <div class="row g-2">
            <div class="col mb-3">
              <label for="status"class="form-label"><input type="checkbox" name="status" />&nbsp;&nbsp;Check if this is a hidden group</label>
            </div>
          </div> -->
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
<div class="modal fade" id="showedit" data-bs-backdrop="statics" tabindex="-1" aria-modal="true" role="dialog"></div>
<script>
   function EditProductSettings(id) {
    $.ajax({
        url: `{{ url('admin/Product/edit/') }}/${id}`,
        method: 'GET',
        data: { id: id },
        success: function (response) {
            $('.bs-stepper-content').html(response);
        },
        error: function () {
            // Handle error if needed
        }
    });
}
  $(document).ready(function () {
      $('#category_name').on('input', function () {
          // Get the value of the category_name input
          var categoryNameValue = $(this).val();

          // Update the value of the url input with the base URL and the category name
          $('#url').val("{{ url('/') }}" + '/' + categoryNameValue);
      });
  });


function editCategory(element) {
    var cate_id = $(element).attr('id');

    $.ajax({
        url: "{{ url('admin/Category/edits') }}/"+cate_id,
        method: 'GET',
        data: { id: cate_id },
        success: function (data) {
        // alert(data); 
            if (data && typeof data == 'string') {
                $('#showedit').html(data);
                $('#showedit').modal('show');
            } else {
                $('#showedit').html('<div>No Data Found</div>');
                $('#showedit').modal('show');
            }
        },
        error: function () {
            $('#showedit .modal-content').html('<div>Error fetching data.</div>');
            $('#showedit').modal('show');
        }
    });
}

    $(document).ready(function () {

        $(".delete_debtcase1").click(function (e) {
            var id = $(this).attr('id');
            var url = $(this).attr('url');
            e.preventDefault();
            bootbox.confirm({
                message: "Are you sure Your Category and all its product will Delete ?",
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
   

        $(".delete_1").click(function (e) {
            var id = $(this).attr('id');
            var url = $(this).attr('url');
            e.preventDefault();
            bootbox.confirm({
                message: "Are you sure ?",
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

      window.onload = function() {
          var tabs = "product";
          if (tabs) {
              productCategory(tabs);
          }
    }
    </script>
<script>
   function productCategory(value) {
    $.ajax({
        url: "{{ url('admin/product/categoryWise') }}",
        method: 'GET',
        data: { type: value },
        success: function (response) {
            $('#TBView').html(response);
        },
        error: function () {
        }
    });
}
</script>