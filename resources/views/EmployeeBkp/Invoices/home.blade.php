@extends('layouts.admin')
@section('title', 'Invoices')
@section('content')
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Invoices /</span> Home</h4>
    @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
  <!-- Users List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Invoices's List</h5>
      </div>
      <div class="col-md-6 text-end">
         <a href="{{url('admin/Invoices/EXPORTCSV')}}" class="btn btn-info mt-3 m-3"><i class="fa-solid fa-file-csv"></i></a>
          <a href="{{url('admin/Invoices/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
          <a href="{{url('admin/Invoices/add')}}" class="btn btn-primary mt-3 m-3">Add</a>
      </div>
    </div>
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_length" id="DataTables_Table_3_length"><label>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
              <div id="DataTables_Table_3_filter" class="dataTables_filter">
                  <form method="GET" action="">
                  <label>Search: <input value="{{$searchTerm}}" type="search" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                </form>
              </div>
            </div>
          </div>
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>Invoices</th>
                <th>Project</th>
                <th>Client</th>
                <th>Total</th>
                <th>Invoice Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if(count($Invoice) > 0)
              @foreach($Invoice as $key=> $Inventor)
              <tr class="odd">
                  <td>{{ $key+1 }} </td>
                  <td>@if($Inventor && $Inventor->invoice_number) {{ $Inventor->invoice_number }} @endif</td>
                  <td>@if($Inventor && $Inventor->product_name) {{ $Inventor->product_name }} @endif</td>
                  <td>@if($Inventor && $Inventor->first_name) {{ $Inventor->first_name }} @endif</td>
                  <td>@if($Inventor && $Inventor->total_amount) {{ $Inventor->total_amount }} @endif</td>
                  <td>@if($Inventor && $Inventor->created_at) {{ $Inventor->created_at }} @endif</td>
                    <td>
                        @if($Inventor && $Inventor->is_payment_recieved)
                            Paid
                        @else
                            Unpaid
                        @endif
                    </td>
                        <td>
                    <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end" style="">
                            <!-- <li><a class="dropdown-item" href="{{url('admin/Invoices/edit/'.$Inventor->id)}}">View</a></li> -->
                            <li><a class="dropdown-item" href="{{url('admin/Invoices/view/'.$Inventor->id)}}">View</a></li>
                            <li><a class="dropdown-item" href="{{url('admin/Invoices/view/'.$Inventor->id)}}">Download</a></li>
                            <li><a class="dropdown-item" href="{{url('admin/Invoices/view/'.$Inventor->id)}}">View PDF</a></li>
                            <!-- <li><button class="dropdown-item delete_debtcase" url="{{url('admin/Invoices/delete/'.$Inventor->id)}}" id="{{$Inventor->id}}">Delete</button></li> -->
                          </ul>
                      </div>
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
          <div class="p-1" style="float: right;">
              {{ $Invoice->links() }}
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
@endsection