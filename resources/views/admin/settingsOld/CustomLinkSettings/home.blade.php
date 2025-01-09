
  <!-- Users List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Custom Link Settings</h5>
      </div>
      <div class="col-md-6 text-end">
          <button type="button" onclick="Tab(value)" value="AddCustomLink" class="btn btn-primary mt-3 m-3">Add New Custom Link</button>
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
                <th>Link Title</th>
                <th>URL</th>
                <!-- <th>Can Be Viewed By</th> -->
                <th>Status</th>
                <th>Action</th>
              </tr>
             </thead>
            <tbody id="result">
              @if(count($CustomLinkSetting) > 0)
             @foreach($CustomLinkSetting as $key=> $user)
              <tr class="odd">
                  <td>{{ $key+1 }} </td>
                  <td>@if($user && $user->link_title) {{ $user->link_title }} @endif</td>
                  <td>@if($user && $user->url) <a target="__blank" href="{{ $user->url }}">{{ $user->url }} </a> @endif</td>
                  <td>{{ $user && $user->status ? 'Active' : 'Inactive' }}</td>
                  <td>
                    <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end" style="">   
                            <li><a class="dropdown-item" onclick="CustomLinkSettingsEdit({{$user->id}})">Edit</a></li>
                            <li><button class="dropdown-item delete_debtcase" url="{{url('admin/CustomLinkSettings/delete/'.$user->id)}}" id="{{$user->id}}">Delete</button></li>
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
 function CustomLinkSettingsEdit(id) {
    $.ajax({
        url: `{{ url('admin/CustomLinkSettings/edit/') }}/${id}`,
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
</script>