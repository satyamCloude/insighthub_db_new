@extends('layouts.admin')
@section('title', 'Performance')
@section('content')
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Performance</span></h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Performance Detail's</h5>
            <div class="action-btns">
              <a href="{{url('Employee/Performance/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <div class="card-body">
            <div class="row mt-4 bg-label-primary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
                <div class="col-md-6 p-3"> 
                  <h4>Employee Name :{{$empname->first_name}}</h4>
                  <h5>Department :{{$Departname->name}}</h5>
                  <h6>Reviewer Name : {{$Reviewer->first_name}}</h6>
                </div>
                <div class="col-md-6 p-3">
                  <h4>Employee Id: {{$empname->id}}</h4>
                  <h5>Designation :{{$empname->desg}}</h5>
                  <h6>Email :{{$empname->login_email}}</h6>
                </div>
            </div>
            <div class="row mb-5 mt-4"> 
                <div class="col-md-6">
                      <label for="evaluation_period" class="form-label">Evaluation Period <span class="text-danger">*</span></label>
                     <select name="evaluation_period Period" id="months" class="form-select" required>
                            <option value="quarter 1">Quarter 1</option>
                            <option value="quarter 2">Quarter 2</option>
                            <option value="quarter 3">Quarter 3</option>
                            <option value="quarter 4">Quarter 4</option>
                          </select>
                </div>
                <div class="col-md-6">
                    <label for="year" class="form-label">Year <span class="text-danger">*</span></label>
                          <select name="year"  class="form-control" id="year" required> </select>
                </div>
              </div>
              <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>Evaluation Period</th>
                <th>Rating</th>
                <th>Evaluation Date</th>
                <th>Acton</th>
              </tr>
            </thead>
            <tbody id="newgetdatat">
            @if($Performance && count($Performance) > 0)
                @foreach($Performance as $key => $Perfo)
                    <tr>  
                        <td>{{ $key + 1 }}</td> 
                        <td>{{ $Perfo->evaluation_period }}</td> 
                        <td>{{ $Perfo->totalrating }}</td> 
                        <td>{{ $Perfo->date }}</td> 
                        <td><a class="cursor-pointer" onclick="openper({{$Perfo->id}})"><i class="fa-solid fa-eye"></i></a></td>
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
    </div>
    <!-- /Sticky Actions -->
  </div>
<!-- / Content -->
<!--Modal start-->
<div class="modal fade" id="Modalperopen" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="backDropModalTitle">Detailed View</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <div class="row mt-4 bg-label-primary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
                <div class="col-md-6 p-3"> 
                  <h4>Employee Name :{{$empname->first_name}}</h4>
                  <h5>Department :{{$Departname->name}}</h5>
                  <h6>Reviewer Name : {{$Reviewer->first_name}} </h6>
                </div>
                <div class="col-md-6 p-3">
                  <h4>Employee Id:</h4>
                  <h5>Designation :</h5>
                  <h6>HR Representative :</h6>
                </div>
            </div>
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>PERFORMANCE CATEGORY</th>
                <th>RATING</th>
                <th>COMMENTS & EXAMPLES(IF ANY)</th>
              </tr>
            </thead>
            <tbody></tbody>
        </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">
            Close
          </button>
        </div>
    </div>
    </div>
</div>
<!--Modal End-->

<script>
function openper(id)
{
  $('#Modalperopen').modal('show');
}
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
            $.ajax({
                url: "{{ url('Employee/Performance/get_Performance_yeardata') }}",
                method: 'GET',
                data: { year: selectedYear, month: selectedMonth },
                success: function (data) {
                    // Handle the successful response
                    $('#newgetdatat').empty(); // Clear previous content

                    if (data.length > 0) {
                        $('#newgetdatat').html(data);
                    } else {
                        $('#newgetdatat').html('<tr><td colspan="5" class="text-center"><span>No Data Found</span></td></tr>');
                    }
                },
                error: function () {
                    $('#newgetdatat').html('<tr><td colspan="5" class="text-center"><span>Error fetching data.</span></td></tr>');
                }
            });
        }
    });
</script>
@endsection