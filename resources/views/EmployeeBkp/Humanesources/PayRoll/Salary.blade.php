<div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
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
            <!--<div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">-->
            <!--  <div id="DataTables_Table_3_filter" class="dataTables_filter">-->
            <!--      <label>Search:<input type="search" class="form-control" placeholder=""aria-controls="DataTables_Table_3"></label>-->
            <!--  </div>-->
            <!--</div>-->
          </div>
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>EMPLOYEE</th>
                <th>GROSS SALARY</th>
                <th>NET PAIND</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="result">
              @php
               $totalNetSalary = 0;
               $totalNetPaid = 0;
              @endphp
              @if(count($PayRoll) > 0)
                @foreach($PayRoll as $key => $user)
                 @php 
                if ($user && $user->net_salary) {
                    $totalNetSalary += $user->net_salary;
                }
                if ($user && $user->net_paid) {
                    $totalNetPaid += $user->net_paid;
                }
                @endphp

                <tr class="odd">
                    <td>{{ $key+1 }} </td>
                    <td>@if($user && $user->first_name) {{ $user->first_name }} @endif</td>
                    <td>@if($user && $user->net_salary) {{ $user->net_salary }} @endif</td>
                    <td>@if($user && $user->net_paid) {{ $user->net_paid }} @endif</td>
                    <td>
                         <!--<a onclick="editrol(this)" id="{{ $user->id }}"><i class="fas fa-edit pointer-cursor"></i></a>&nbsp;&nbsp;-->
                        <a class="btn-link"  href="{{url('Employee/PayRoll/SallarySlip/'.$user->id)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                    </td>
                </tr>
                @endforeach
              <!--<tr style="background: aliceblue;">-->
              <!--    <td></td>-->
              <!--    <td><strong>Total</strong></td>-->
              <!--    <td><strong>{{ $totalNetSalary }}</strong></td>-->
              <!--    <td><strong>{{ $totalNetPaid }}</strong></td>-->
              <!--    <td></td>-->
              <!--</tr>-->
              @else
              <tr>
                <td class="text-center" colspan="5">No Data Found</td>
              </tr>
              @endif  
            </tbody>
        </table>
          <div class="p-1" style="float: right;">
              {{ $PayRoll->links() }}
          </div>
        </div>
      </div>
<script>
    $(document).ready(function () {
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
                url: "{{ url('Employee/PayRoll/get_SallaryData') }}",
                method: 'GET',
                data: { year: selectedYear, month: selectedMonth },
                success: function (data) {
                    // Handle the successful response
                    $('#result').empty(); // Clear previous content

                    if (data.length > 0) {
                        $('#result').html(data);
                    } else {
                        $('#result').html('<tr><td colspan="8" class="text-center"><span>No Data Found</span></td></tr>');
                    }
                },
                error: function () {
                    $('#result').html('<tr><td colspan="8" class="text-center"><span>Error fetching data.</span></td></tr>');
                }
            });
        }
    });
</script>