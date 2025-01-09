<div class="row mb-4">
  <div class="col-12">
    <div class="card">
      <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
        <h5 class="card-title mb-sm-0 me-2">Payroll Settings</h5>
        <div>
          <button type="button" class="btn btn-label-info text-dark" onclick="SettingsModal()"><i class="fa-solid fa-gear"></i></button>
          <button type="button" class="btn btn-label-primary" onclick="AddModal()">Add</button>
        </div>
      </div>
      <div class="card-body">
        <div class="card-datatable table-responsive mt-4">
          <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
            <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
              <!-- ... Table Header ... -->
              <thead>
                <tr>
                  <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                  <th>ID</th>
                  <th>Employee</th>
                  <th>Increment Salary</th>
                  <th>Total Salary</th>
                  <th>Increment Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="result">
                <!-- ... Table Body ... -->
                @if(count($PayRollSetting) > 0)
                  @foreach($PayRollSetting as $key=> $PayRol)
                    <tr class="odd">
                      <td>{{ $key+1 }}</td>
                      <td>
                        <img class="rounded-circle"
                          style="margin-right: 15px;margin-top: 10px;" 
                          src="{{$PayRol->profile_img}}"
                          height="30"
                          width="30"
                          alt="User avatar" />{{$PayRol->first_name }}<div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$PayRol->email}}</div>
                      </td>
                      <td>{{$PayRol->increment_sallery}}</td>
                      <td>{{$PayRol->Total_salary}}</td>
                      <td>{{$PayRol->increment_date}}</td>
                      <td>
                        <a type="button" onclick="EditPayRolls({{$PayRol->user_id}})"><i class="fas fa-eye"></i></a>
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="PayRollModal" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
      <form action="{{url('admin/PayRollSetting/store')}}"   class="modal-content" method="post" enctype="multipart/form-data"> 
        @csrf
        <div class="modal-header">
          <h4>PayRoll</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-12 mb-3">
                <label class="form-label">Increment Sallery</label>
                <div class="input-group">
                    <select class="form-control select2" onchange="EmployeeData(this.value)" name="user_id">
                        @foreach($Employee as $Empl)
                        <option value="{{$Empl->id}}">{{$Empl->first_name}}</option>   
                        @endforeach
                    </select>
                    <input type="text" id="oldsalary" placeholder="Old Salary" readonly class="form-control oldsalary">
                    <input type="text" id="increment_salary" name="increment_sallery" placeholder="Increment Salary" class="form-control" required>
                    <input type="text" id="Total_salary" name="Total_salary" readonly placeholder="Total Salary" class="form-control">
                </div>
            </div>
            <div class="col-sm-12">
                <label class="form-label">Increment Date</label>
                <input type="date" name="increment_date" class="form-control" required>
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
<div class="modal fade" id="SettingsModal" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
      <form action="{{url('admin/PayRollSetting/SettingApply/1')}}"   class="modal-content" method="post" enctype="multipart/form-data"> 
        @csrf
        <div class="modal-header">
          <h4>PayRoll Settings</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-6 mb-3">
                <label class="form-label">Cron Url</label>
                <input type="text" name="cron_url" @if($PayCron && $PayCron->cron_url) value="{{$PayCron->cron_url}}" @endif class="form-control">
            </div>
            <div class="col-sm-6 mb-3">
                <label class="form-label">Cron schedule Date</label>
                <input type="date" name="cron_date" @if($PayCron && $PayCron->cron_date) value="{{$PayCron->cron_date}}" @endif class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" @if($PayCron && $PayCron->auto_generate == '1') checked @endif name="auto_generate" id="defaultCheck3" >
                  <label class="form-check-label" for="defaultCheck3"> Auto Generate </label>
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

<script>

     function EditPayRolls(id) {
    $.ajax({
        url: `{{ url('admin/PayRollSetting/view/') }}/${id}`,
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

 function EmployeeData(selectedValue) {
    $('#Total_salary').val('');
    $('#increment_salary').val('');

    $.ajax({
        url: "{{ url('admin/PayRollSetting/EmployeeData') }}",
        method: 'GET',
        data: { id: selectedValue },
        success: function (response) {
            if (response.success && response.data && response.data.net_salary !== undefined) {
                $('.oldsalary').val(response.data.net_salary);
            } else {
                console.error('Invalid response format or missing net_salary property.');
            }
        },
        error: function () {
            // Handle error
        }
    });
}




    $('#increment_salary').keyup(function() {
        // Get the value of increment_salary on keyup
        var incrementSalaryValue = parseFloat($(this).val()) || 0;
        
        // You can perform any calculations here and update Total_salary accordingly
        var oldSalaryValue = parseFloat($('#oldsalary').val()) || 0;
        var totalSalary = incrementSalaryValue + oldSalaryValue;

        // Set the calculated value to Total_salary input
        $('#Total_salary').val(totalSalary.toFixed(2));
    });

    function AddModal() {
        $('#PayRollModal').modal('show');
    }

    function SettingsModal() {
        $('#SettingsModal').modal('show');
    }



    function Tabor(value) {
        if(value == 'Support')
        {
          $('#Supportsmtp').show(500);
          $('#Salessmtp').hide(500);
          $('#Accountsmtp').hide(500);
      }
      if(value == 'Sales')
      {
          $('#Salessmtp').show(500);
          $('#Supportsmtp').hide(500);
          $('#Accountsmtp').hide(500);
      }
      if(value == 'Account')
      {
          $('#Accountsmtp').show(500);
          $('#Supportsmtp').hide(500);
          $('#Salessmtp').hide(500);
      }
  }
  function TabAuth(value) {
    if(value == 'Support')
    {
      $('#SupportAuth').show(500);
      $('#SalesAuth').hide(500);
      $('#AccountAuth').hide(500);
  }
  if(value == 'Sales')
  {
      $('#SalesAuth').show(500);
      $('#SupportAuth').hide(500);
      $('#AccountAuth').hide(500);
  }
  if(value == 'Account')
  {
      $('#AccountAuth').show(500);
      $('#SupportAuth').hide(500);
      $('#SalesAuth').hide(500);
  }
}
</script>