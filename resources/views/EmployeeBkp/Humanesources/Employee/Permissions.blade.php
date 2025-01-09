<div class="card">
    

 <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_length" id="DataTables_Table_3_length"><label>
              </div>
            </div>
          </div>
         <table class="table table-bordered mt-3 permisison-table table-hover" id="example">
                                  <thead class="thead-light">
                                    <tr>
                                      <th width="20%">Module</th>
                                       <th width="16%">View</th>
                                       <th width="16%">Add</th>
                                       <th width="16%">Update</th>
                                       <th width="16%">Delete</th>
                                       <!-- <th width="2%">#</th> -->
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
                                       <!--  <td class="text-center bg-light border-left">
                                          <input type="checkbox" class="ShowSelect" data-permission-id="{{$Per->id}}" {{$Per->isChecked ? 'checked' : ''}}>
                                        </td>  -->                            
                                      </tr>
                                      @endforeach
                                  </tbody>
                                </table>
          <div class="p-1" style="float: right;">
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