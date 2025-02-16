@extends('layouts.admin')
@section('title', 'Payroll View')
@section('content')
<!-- Content -->

 <div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Payroll /</span> View</h4>
      <!-- Users List Table -->
  <div class="card">
    <div class="row card-header">
      <div class="col-md-7">
          <h5 >Payroll's List</h5>
      </div>
      <div class="col-md-5 d-flex">
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
        &nbsp;
        <select name="year" class="form-select" id="year"> </select>
      </div>
    </div>
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <div class="row">
            <!--<div class="col-sm-12 col-md-6">-->
            <!--  <div class="dataTables_length" id="DataTables_Table_3_length"><label>-->
            <!--  </label></div>-->
            <!--</div>-->
            <!--<div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">-->
            <!--  <div id="DataTables_Table_3_filter" class="dataTables_filter">-->
            <!--      <form method="GET" action="">    -->
            <!--      <label>Search: <input value="" type="search" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>-->
            <!--    </form>-->
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
                    <th>DEDUCATION</th>
                    <th>TDS</th>
                    <th>NET PAID</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="result">
                    @foreach($payrolls as $payroll)
                        <tr>
                            <td>{{$payroll->id}}</td>
                            <td>{{$payroll->first_name}}</td>
                            <td>{{number_format($payroll->net_salary,2)}}</td>
                            <td>{{number_format($payroll->deduction,2)}}</td>
                            <td>{{number_format($payroll->tds,2)}}</td>
                            <td>{{number_format($payroll->net_paid,2)}}</td>
                            <td>
                                <a class="btn-link" href="{{url('Employee/PayRoll/SallarySlip/'.$payroll->id)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          <div class="p-1" style="float: right;">
              
          </div>
      </div>
      </div>
    </div>
</div>
<!-- / Content -->
<script>
     $(document).ready(function() {
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

            // Function to apply color based on the value
		    function applyColor(value) {
		        var color = parseFloat(value) >= 0 ? 'green' : 'red';
		        return '<span style="color: ' + color + ';">' + parseFloat(value) + '%</span>';
		    }

            function fetchData() {
                var selectedYear = $selectYear.val();
                var selectedMonth = $selectMonth.val();

                // Make an AJAX request to fetch data based on the selected year and month
                $.ajax({
                    url: "{{ url('Employee/PayRoll/getEmpPayroll') }}",
                    method: 'GET',
                    data: {
                        year: selectedYear,
                        month: selectedMonth,
                        id : "{{$user_id}}"
                    },
                    success: function(data) {
                        
                        // Handle the successful response
                        $('#result').empty(); // Clear previous content
                        if(data.length > 0){
                            $('#result').html(data);
                        }else{
                            $('#result').html('<tr><td colspan="8" class="text-center"><span>No Data Found</span></td></tr>');
                        }
                        
                    },
                    error: function() {
                        $('#result').html('<tr><td colspan="8" class="text-center"><span>Error fetching data.</span></td></tr>');
                    }
                });
            }
        });

</script>
@endsection

 				  