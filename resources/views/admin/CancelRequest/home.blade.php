@extends('layouts.admin')
@section('title', 'Order')
@section('content')
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
 <h4 class="py-3 mb-4"><span class="text-muted fw-light">Cancellation </span> Request</h4>
@if(Session::has('success'))
<div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
@endif


  <!-- Users List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
        <h5 class="card-header">Cancellation's List</h5>
      </div>
      <div class="col-md-6 text-end">
        <!-- <a href="{{url('admin/Invoices/home')}}" class="btn btn-outline-primary mt-3 m-3">Make Invoice</a> -->

        <!-- <a href="{{url('admin/Orders/EXPORTCSV')}}" class="btn btn-info mt-3 m-3"><i class="fa-solid fa-file-csv"></i></a> -->
        <!-- <a href="{{url('admin/Orders/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a> -->
        <a href="{{url('admin/Orders/create')}}" class="btn btn-primary mt-3 m-3">Add</a>
      </div>
    </div>
    <div class="card-datatable table-responsive">
      <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <div class="dataTables_length" id="DataTables_Table_3_length"><label>
            </div>
          </div>
        </div>
      

         <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info" id="example">

            <thead>

              <tr>

                <th>#ID</th>

                <th>Client</th>

                <th>Service</th>

                <th>Action</th>

              </tr>

            </thead>

            <tbody>

              @foreach($cancelRequests as $key=> $value)

              @if(isset($value))

              @foreach($value as $lst)

              <tr>

                <td>#{{$lst->id}}</td>

                <td>{{$lst->first_name}}</td>

                <td>{{$lst->product_name}} </td>

                <td class="text-danger">

                 

                      <a href="{{url('admin/subscription/appUnapp/'.$lst->id.'/'.$lst->category_id.'/2')}}" >

                          <button class="btn btn-success btn-sm">Approve</button>

                      </a><br/>

                      <a href="{{url('admin/subscription/appUnapp/'.$lst->id.'/'.$lst->category_id.'/5')}}" >

                          <button class="btn btn-danger btn-sm mt-1" >Unapprove</button>

                      </a>

                </td>

              </tr> 

              @endforeach

              @endif

              @endforeach

            </tbody>

          </table>

        <div class="p-1" style="float: right;">
        
        </div>
      </div>
    </div>
  </div>
</div>
<script>
 
</script>
@endsection