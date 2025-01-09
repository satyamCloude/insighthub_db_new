<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<style>
.status_color{
  background-color: red;
  width:15px;
  height: 15px;
  border-radius: 50%;
  display: block;
  margin-right: 8px;

}


th {
  border-color: 1px solid transparent;
  background-color: #eae8fd!important;
}

</style>
<div class="container-xxl flex-grow-1 container-p-y">
 
  
    <div class="row" style="margin-top:40px;">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-datatable table-responsive pt-0">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
              <div class="card-header flex-column flex-md-row" style="padding-bottom: 16px;">
                <div class="head-label text-center">
                  <h5 class="card-title mb-0">Working History</h5>
                </div>
              </div>
              <!--<div class="row">-->
              <!--  <div class="col-sm-12 col-md-6 mb-4">-->
              <!--    <div class="Status_length" style="display: flex;justify-content: space-between;margin-left:6px;">-->
              <!--      <div class="status" style="display: flex;align-items: center;"><span class="status_color" style="background-color: #3178EE;">&nbsp;</span><span>Meeting Criteria</span></div>-->
              <!--      <div class="status" style="display: flex;align-items: center;"><span class="status_color" style="background-color: #efc51a;">&nbsp;</span><span>Criteria Unmet</span></div>-->
              <!--      <div class="status" style="display: flex;align-items: center;"><span class="status_color">&nbsp;</span><span>Action needed</span></div>-->
              <!--      <div class="status" style="display: flex;align-items: center;"><span class="status_color" style="background-color: lightgrey;">&nbsp;</span><span>Overtime</span></div>-->
              <!--    </div>-->
              <!--  </div>-->
              <!--</div>-->
             <div class="inner_table" style="padding:0px 23px;">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                      <div class="dataTables_length" id="DataTables_Table_3_length"><label>
                        <select name="months" class="form-select" id="months">
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        <select name="year" class="form-select" id="year">  </select>
                      </div>
                    </div>
                </div>
              <table class="datatables-basic table dataTable no-footer dtr-column ttable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" >
                <thead>
                  <tr>
                    
                    <th >Emp ID</th>
                    <th >Date</th>
                    <th >Check In</th>
                    <th >Check Out</th>
                    <th >Working Hrs</th>
                    <th >Overtime</th>
                  </tr>
                </thead>
                <tbody id="tbody">
                    @if(count($attendances) > 0)
                    @foreach($attendances as $attendance)
                        <tr>
                            <td>#{{$attendance->emp_Id}}</td>
                            <td>{{$attendance->punch_date}}</td>
                            <td>{{$attendance->punch_in}}</td>
                            <td>{{$attendance->punch_out}}</td>
                            <td>{{$attendance->working_hours}}</td>
                            <td>
                                @php 
                                // Extract hours and minutes from ts_working_hrs
                                list($hours, $minutes) = explode(':', $attendance->ts_working_hrs);
                                
                                // Calculate total hours
                                $total_hours = intval($hours) + intval($minutes) / 60;
                                
                                // Calculate overtime
                                $overtime = $attendance->working_hours - $total_hours;
                                @endphp
                                {{$overtime > 0 ? $overtime : 0 }}
                            </td>
                        </tr>
                    @endforeach

                    @else
                    <tr><td colspan="8">No Record Found</td></tr>
                    @endif
                </tbody>
              </table>
            </div>
              <div class="row">
               
                <div class="col-sm-12 col-md-6">
                  {!! $attendances->links() !!}
                </div>
              </div>
              <div style="width: 1%;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    // Radial Bar Chart

    /**
 * Charts Apex
 */

$(document).ready(function(){

  var currentYear = new Date().getFullYear();
        var startYear = 2015;
        var $selectYear = $('#year');
        var $selectMonth = $('#months');

        // Populate the select elements with options
        for (var year = currentYear; year >= startYear; year--) {
            $selectYear.append($('<option>', {
                value: year,
                text: year
            }));
        }

        // Handle the change event of the select elements
        $selectYear.on('change', fetchData);
        $selectMonth.on('change', fetchData);

        function fetchData() {
            var selectedYear = $selectYear.val();
            var selectedMonth = $selectMonth.val();

            // Make an AJAX request to fetch data based on the selected year and month
            $.ajax({
                url: "{{ url('Employee/Attendence/filterAttendance/'.$id) }}",
                method: 'GET',
                data: { year: selectedYear, month: selectedMonth },
                success: function (data) {
                    // Handle the successful response
                    $('#tbody').empty(); // Clear previous content

                    if (data.length > 0) {
                        $('#tbody').html(data);
                    } else {
                        $('#tbody').html('<tr><td colspan="8" class="text-center"><span>No Data Found</span></td></tr>');
                    }
                },
                error: function () {
                    $('#result').html('<tr><td colspan="8" class="text-center"><span>Error fetching data.</span></td></tr>');
                }
            });
        }

    const currentMonth = new Date().getMonth() + 1; 
    document.getElementById('months').value = currentMonth.toString().padStart(2, '0');
    
});
  </script>