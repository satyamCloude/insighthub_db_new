@extends('layouts.admin')
@section('title', 'Leads Follow UP')
@section('content')
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

<style type="text/css">
  .actives{
    border: 0px solid #1ff11f;
    padding: 0px 1px 0px 17px;
    border-radius: 146px;
    background: #1ff11f;
  }

  .inactives{
    border: 0px solid red;
    padding: 0px 1px 0px 17px;
    border-radius: 146px;
    background: red;
  }
  .orangecose{
    border: 0px solid orange;
    padding: 0px 1px 0px 17px;
    border-radius: 146px;
    background: orange;
  }

  .btmtable th{

background-color:#eae8fd !important;

  }

  .btmtable{

    border-radius:4px;
  }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Leads Follow UP/</span> Home</h4>
  @if(Session::has('success'))
  <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
  @endif
  <div  id="assignednewuser" style="display:none;" class="alert alert-success">This Lead is assigned to new user.</div>

  <!-- Users List Table -->
<!-- Users List Table -->
<div class="card">
    <div class="row">
        <div class="col-md-6">
            <h5 class="card-header">Leads Follow UP's List</h5>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ url('Employee/recent_follow_ups') }}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
        </div>
    </div>
 <form method="GET">
    <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
            <div class="row">
                <div class="col-sm-12 col-md-3">
                   
                </div>
                <div class="col-sm-12 col-md-5 d-flex " style="align-self:center;">
                    <div class="input-group input-daterange" id="bs-datepicker-daterange">
                        <input type="date" id="dateRangePicker" placeholder="MM/DD/YYYY" class="form-control fromDate" name="from" value="{{request()->get('from')}}">
                        <span class="input-group-text">to</span>
                        <input type="date" placeholder="MM/DD/YYYY" class="form-control toDate" name="to" value="{{request()->get('to')}}">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 d-flex justify-content-center justify-content-md-end">
                    <div id="DataTables_Table_3_filter" class="dataTables_filter">
                        <label>Search:
                            <input type="search" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3">
                        </label>
                    </div>
                </div>
            </div>
     
</form>
</div>

<div class="table_div" style="margin-top:20px;padding: 0 12px;">
    <table class="table table-hover bg-white rounded">
        <thead class="">
          <tr>
            <th>Created</th>
            <th>Next Follow Up111</th>
            <th>Client Name</th>
            <th>Phone Number</th>
            <th>Requirement</th>
            <th>Remark</th>
            <th>Status</th>
            <th class="text-right">Action</th>
          </tr>
        </thead>
        <tbody>
          @if(count($LeadsFollowup) > 0)
          @foreach($LeadsFollowup as $Followup)
          <tr>
            <td>{{$Followup->created_at}}</td>         
            <td>{{$Followup->follow_up_next}}</td>
            <td>{{$Followup->fist_name}} {{$Followup->last_name}}</td>
            <td>{{$Followup->phone_number}}</td>
            <td>{{$Followup->requirement}}</td>
            <td>{{$Followup->remark}}</td>
            <td>{{$Followup->status}}</td>
            <td>
              <a href="#" onclick="EditFollowUp({{$Followup->id}})"><i class="fa-solid fa-edit"></i></a>
              &nbsp;&nbsp;
              <a class="delete_debtcase" url="{{url('Employee/LeadsFollowup/delete/'.$Followup->id)}}" id="{{$Followup->id}}"><i class="fa-solid fa-trash"></i></a>
            </td>
          </tr>
          @endforeach
          @else
          <tr>
            <td></td>
            <td>No data found</td>
            <td></td>
          </tr>
          @endif
        </tbody>
    </table>
</div>
    <div class="p-1" style="float: right;">
      {{ $LeadsFollowup->links() }}
    </div>
  </div>
</div>
</div>
</div>
<!--Modal start-->
<div class="modal fade" id="FollowUpEditModal" data-bs-backdrop="static" tabindex="-1" aria-modal="true" role="dialog"></div>
<div class="modal fade" id="FollowUpModal" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
  <div class="modal-dialog">
    <form action="{{url('Employee/LeadsFollowup/store')}}"   class="modal-content" method="post" enctype="multipart/form-data"> 
      @csrf
      <div class="modal-header">
        <h4>Follow UP</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-6 mb-3 text-muted">Lead Name</div>
          <div class="col-sm-6 mb-3"></div>
          <div class="col-sm-6 mb-3">
            <label for="Follow Up Next" class="form-label">Follow Up Next</label>
            <input type="date" class="form-control" name="follow_up_next" id="Follow Up Next" required/>
            <input type="hidden" class="form-control" name="leads_id">
          </div>
          <div class="col-sm-6 mb-3">
            <label for="StartTime" class="form-label">Start Time</label>
            <input type="time" class="form-control" name="start_time" id="StartTime" required/>
          </div>
          <div class="col-sm-12 mb-3">
            <div class="form-check form-check-primary mt-3">
              <input class="form-check-input" type="checkbox" value="" id="customCheckPrimary"  name="custom_check_primary" onclick="Sendreminder()">
              <label class="form-check-label" for="customCheckPrimary">Send Reminder</label>
            </div>
          </div>
          <div class="row" id="Sendreminder"></div>
          <div class="col-sm-12 mb-3">
            <label for="Remark" class="form-label">Remark</label>
            <textarea class="form-control" name="remark"></textarea>
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
<!--Modal End-->
<!-- / Content -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get month and year select elements
        var monthSelect = document.getElementById('months');
        var yearSelect = document.getElementById('year');

        // Add onchange event listener to month and year select elements
        monthSelect.addEventListener('change', function() {
            submitForm();
        });

        yearSelect.addEventListener('change', function() {
            submitForm();
        });

        // Function to submit the form
        function submitForm() {
            // Get the form element
            var form = document.querySelector('form');

            // Submit the form
            form.submit();
        }
    });
</script>

<script>
 $(document).ready(function () {
    $(".delete_debtcase").click(function (e) {
        var url = $(this).attr('href');
        e.preventDefault();
        bootbox.confirm({
            message: "Are you sure you want to delete this lead?",
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


  function LeadAssigned(id,value){
   $.ajax({
    url: "{{ url('Employee/Leads/LeadAssignUpdate') }}",
    method: 'GET',
    data: { id: id, value: value },
    success: function (response) {
      if (response && response.status === 200 && response.success) {
        $('#assignednewuser').show();
        setTimeout(function () {
          $('#assignednewuser').hide(500);
        }, 2000);
      } else {
        alert("Opps. Please try again.");
      }
    },
    error: function () {
    }
  });
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

            // Make an AJAX request to fetch data based on the selected year and month
    $.ajax({
      url: "{{ url('Employee/Leads/get_followups_yeardata') }}",
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
  function EditFollowUp(id)
  {
    $.ajax({
      url: "{{ url('Employee/LeadsFollowup/edit') }}",
      method: 'GET',
      data: { id: id },
      success: function (response) {
        $('#FollowUpEditModal').html(response).modal('show');
      },
      error: function () {
      }
    });
  }

</script>




@endsection