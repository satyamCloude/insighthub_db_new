@extends('layouts.admin')
@section('title', 'PayRoll')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">PayRoll /</span> Home</h4>
    @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
    @if(Session::has('error'))
   <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
    @endif
    <div class="row">
      <div class="col-md-12 text-center text-white">
        <button onclick="Salary()" class="btn btn-success mt-3 m-3">Salary</button>
        <button onclick="Deduction()" class="btn btn-danger mt-3 m-3">Deduction</button>
        <button  onclick="TDS()" class="btn btn-warning mt-3 m-3">TDS</button>
      </div>
    </div>
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">PayRoll's List</h5>
      </div>
      <div class="col-md-6 text-white text-end p-3">
        <a class="btn btn-primary" onclick="openrulemodal()">Rules</a>
        <a href="{{url('admin/PayRoll/EXPORTCSV')}}" class="btn btn-info mt-3 m-3"><i class="fa-solid fa-file-csv"></i></a>
        <a href="{{url('admin/PayRoll/GenerateSellary')}}" class="btn btn-secondary"><i class="fas fa-sync-alt"></i></a>
      </div>
    </div>
      <div class="card-datatable table-responsive" id="newpayroll">
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
            <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
              <div id="DataTables_Table_3_filter" class="dataTables_filter">
                  <form method="GET" action="">    
                  <label>Search: <input type="search" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                </form>
              </div>
            </div>
          </div>
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>EMPLOYEE</th>
                <th>GROSS SALARY</th>
                <th>NET PAID</th>
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
                    <td>
                     <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{isset($user->profile_img) ? $user->profile_img : url('public/images/21104.png')}}" height="30" width="30" alt="User avatar" />{{ $user->first_name }}<div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$user->email}}</div></td>
                    <td>@if($user && $user->net_salary) {{ $user->net_salary }} @endif</td>
                    <td>@if($user && $user->net_paid) {{ $user->net_paid }} @endif</td>
                    <td>
                        <a onclick="editrol(this)" id="{{ $user->id }}"><i class="fas fa-edit pointer-cursor"></i></a>&nbsp;&nbsp;
                        <a class="btn-link"  href="{{url('admin/PayRoll/SallarySlip/'.$user->id)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                    </td>
                </tr>
            @endforeach
              <tr style="background: aliceblue;">
                  <td></td>
                  <td><strong>Total</strong></td>
                  <td><strong>{{ $totalNetSalary }}</strong></td>
                  <td><strong>{{ $totalNetPaid }}</strong></td>
                  <td></td>
              </tr>
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
    </div>
</div>

<!--Modal start-->
<div class="modal fade" id="rulesmodal" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="backDropModalTitle">Rating</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{url('admin/PayRoll/Rules/update/'.$Rules->id)}}">
                @csrf
          <div class="row">
            <div class="col-md-6 mb-3">
                <label for="basic" class="form-label">Basic(%)on NetSalary <span class="text-danger">*</span></label>
              <input type="number" step="any" class="form-control" @if($Rules && $Rules->basic) value="{{$Rules->basic}}" @endif name="basic">
            </div>
            <div class="col-md-6 mb-3">
                <label for="hra" class="form-label">HRA (%) On Basic <span class="text-danger">*</span></label>
              <input type="number" step="any" class="form-control" @if($Rules && $Rules->hra) value="{{$Rules->hra}}" @endif name="hra">
            </div>
          </div>
           <div class="row">
            <div class="col-md-6 mb-3">
                <label for="conveyance" class="form-label">Conveyance(Fixed Amount) <span class="text-danger">*</span></label>
              <input type="number" step="any" class="form-control" @if($Rules && $Rules->conveyance) value="{{$Rules->conveyance}}" @endif name="conveyance">
            </div>
            <div class="col-md-6 mb-3">
                <label for="medical" class="form-label">Medical(Fixed Amount) <span class="text-danger">*</span></label>
              <input type="number" step="any" class="form-control" @if($Rules && $Rules->medical) value="{{$Rules->medical}}" @endif name="medical">
            </div>
          </div>
           <div class="row">
            <div class="col-md-12 text-center">
              <button type="submit"  class="btn btn-success">Submit</button>
            </div>
            </div>
        </form>
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
<!--Modal Start-->
<div class="modal fade" id="editpayrol" data-bs-backdrop="static" tabindex="-1" aria-modal="true" role="dialog"></div>
<!--Modal End-->

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
                url: "{{ url('admin/PayRoll/get_SallaryData') }}",
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

function openrulemodal(){
    $('#rulesmodal').modal('show');
}
function Salary(){
    $.ajax({
        url: "{{ url('admin/PayRoll/Salary') }}",
        method: 'GET',
        success: function (data) {
            // Handle the successful response
            $('#newpayroll').empty(); // Clear previous content

            if (data.length > 0) {
                $('#newpayroll').html(data);
            } else {
                $('#newpayroll').html('<tr><td colspan="8" class="text-center"><span>No Data Found</span></td></tr>');
            }
        },
        error: function () {
            $('#newpayroll').html('<tr><td colspan="8" class="text-center"><span>Error fetching data.</span></td></tr>');
        }
    });
}
function Deduction(){
    $.ajax({
        url: "{{ url('admin/PayRoll/Deduction') }}",
        method: 'GET',
        success: function (data) {
            // Handle the successful response
            $('#newpayroll').empty(); // Clear previous content

            if (data.length > 0) {
                $('#newpayroll').html(data);
            } else {
                $('#newpayroll').html('<tr><td colspan="8" class="text-center"><span>No Data Found</span></td></tr>');
            }
        },
        error: function () {
            $('#newpayroll').html('<tr><td colspan="8" class="text-center"><span>Error fetching data.</span></td></tr>');
        }
    });
}
function TDS(){
    $.ajax({
        url: "{{ url('admin/PayRoll/TDS') }}",
        method: 'GET',
        success: function (data) {
            // Handle the successful response
            $('#newpayroll').empty(); // Clear previous content

            if (data.length > 0) {
                $('#newpayroll').html(data);
            } else {
                $('#newpayroll').html('<tr><td colspan="8" class="text-center"><span>No Data Found</span></td></tr>');
            }
        },
        error: function () {
            $('#newpayroll').html('<tr><td colspan="8" class="text-center"><span>Error fetching data.</span></td></tr>');
        }
    });
}

function editrol(element) {
    var id = element.id;
    
    $.ajax({
        url: "{{ url('admin/PayRoll/edit') }}",
        method: 'GET',
        data: { id: id },
        success: function (data) {
            if (data && typeof data == 'string') {
                $('#editpayrol').html(data);
                $('#editpayrol').modal('show');
            } else {
                $('#editpayrol').html('<div>No Data Found</div>');
                $('#editpayrol').modal('show');
            }
        },
        error: function () {
            $('#editpayrol .modal-content').html('<div>Error fetching data.</div>');
            $('#editpayrol').modal('show');
        }
    });

}
</script>
@endsection