 <div class="row mb-4">
  <div class="col-12">
    <div class="card">
      <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
        <h5 class="card-title mb-sm-0 me-2">PayRoll Setting's</h5>
       <button type="button" class="btn btn-label-primary" onclick="location.reload()">Back</button>

        </div>
        <div class="card-body">
            <div class="card-datatable table-responsive mt-4">
              <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
                  <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
                    <thead>
                      <tr>
                        <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                        <th>ID</th>
                        <th>Employee</th>
                        <th>Increment Sellery</th>
                        <th>Total Sellery</th>
                        <th>Increment Date</th>
                    </tr>
                </thead>
                <tbody id="result">
                  @if(count($PayRollSetting) > 0)
                  @foreach($PayRollSetting as $key=> $PayRol)
                  <tr class="odd">
                      <td>{{ $key+1 }} </td>
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
