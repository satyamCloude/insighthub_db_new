<div class="card">
    

 <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
   
    <div class="row">
      <div class="col-12">

         
            <div class="card-body">
                          <div class="table-sm-responsive role-permissions" id="role-permission-2" style="position: static; zoom: 1;">
                                <table class="table table-bordered mt-3 permisison-table table-hover" id="example">
                                  <thead class="thead-light">
                                    <tr>
                                      <th width="20%">Module</th>
                                       <th width="16%">View</th>
                                       <th width="16%">Add</th>
                                       <th width="16%">Update</th>
                                       <th width="16%">Delete</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                       @foreach($Permission as $key=> $Per)
                                      <tr>
                                        <!-- <td></td> -->
                                        <td>{{$Per->name}}
                                            <input type="hidden" name="permission_id[]" value="{{$Per->id}}" >
                                        </td>
                                        <td>
                                            <select class="select-picker role-permission-select border-0" name="view[]" data-permission-id="{{$Per->id}}" data-role-id="2">
                                              <option @if(isset($RoleAccess[$key]) && $RoleAccess[$key]->view == 0)  selected  @endif   value="" >None</option>
                                              <option @if(isset($RoleAccess[$key]) && $RoleAccess[$key]->view == 1) selected @endif  value="1" >All</option>
                                              <option @if(isset($RoleAccess[$key]) && $RoleAccess[$key]->view == 2) selected @endif  value="2" >Owned by</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="select-picker role-permission-select border-0" name="add[]" data-permission-id="{{$Per->id}}" data-role-id="2">
                                              <option @if(isset($RoleAccess[$key]) && $RoleAccess[$key]->add == 0)  selected  @endif  value="" >None</option>
                                              <option @if(isset($RoleAccess[$key]) && $RoleAccess[$key]->add == 1) selected @endif value="1" >All</option>
                                            </select>
                                        </td>
                                        <td>
                                          <select class="select-picker role-permission-select border-0" name="update[]" data-permission-id="{{$Per->id}}" data-role-id="2">
                                            <option @if(isset($RoleAccess[$key]) && $RoleAccess[$key]->update == 0)  selected  @endif   value="" >None</option>
                                            <option @if(isset($RoleAccess[$key]) && $RoleAccess[$key]->update == 1) selected @endif  value="1" >All</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select class="select-picker role-permission-select border-0" name="delete[]" data-permission-id="{{$Per->id}}" data-role-id="2">
                                            <option @if(isset($RoleAccess[$key]) && $RoleAccess[$key]->delete == 0)  selected  @endif   value="" >None</option>
                                            <option @if(isset($RoleAccess[$key]) && $RoleAccess[$key]->delete == 1) selected @endif  value="1" >All</option>
                                          </select>
                                        </td>
                                      </tr>
                                      @endforeach
                                  </tbody>
                                </table>
                              </div>
            </div>
            
        </div>
      </div>
    </div>

    </div>
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
    // Handle checkbox change event
    $('.ShowSelect').change(function () {
        var permissionId = $(this).data('permission-id');
        var isChecked = $(this).prop('checked');

        // Update the corresponding select elements based on checkbox state
        var $selects = $('.role-permission-select[data-permission-id="' + permissionId + '"]');

        if (isChecked) {
            // If checkbox is checked, set all select elements to 1
            $selects.val('1');
        } else {
            // If checkbox is unchecked, set values to an empty string
            $selects.val('');
        }
    });
});

</script>