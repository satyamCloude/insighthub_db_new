@extends('layouts.admin')
@section('title', 'Log Activity')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row mt-4 m-4">
        <div class="col-md-4">
          
        </div>
        <div class="col-md-8 text-end ">
           <a href="{{url('admin/LogActivity/home')}}"class="btn btn-light">System</a>
           <a href="{{url('admin/LogActivity/ticket')}}"class="btn btn-light">Ticket</a>
           <a href="{{url('admin/LogActivity/invoice')}}"class="btn btn-light">Invoice</a>
           <a href="{{url('admin/LogActivity/lead')}}"class="btn btn-primary">Lead</a>
        </div>
    </div>
    <div class="card  m-4">
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <div class="row bg-label-dark text-dark">
            <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-start">
              <h5 class="card-header">Lead Log</h5>
            </div>
            <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
              <div id="DataTables_Table_3_filter" class="dataTables_filter">
                  <form method="GET" action="">    
                  <label>Search: <input value="{{$searchTerm}}" type="search" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                  <a href="{{url('admin/LogActivity/home')}}"class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
                </form>
              </div>
            </div>
          </div>
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th></th>
                <th>Date</th>
                <th>Subject</th>
                <th>User</th>
                <th>IP Address</th>
              </tr>
            </thead>
            <tbody id="result">
              @if(count($LogActivity) > 0)
                 @foreach($LogActivity as $key=> $user)
                  <tr class="odd">
                      <td></td>
                      <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                      <td>{{ $user->subject }}</td>
                      <td> {{$user->user_id == 1 ? 'Admin ID' : 'Employee ID' }} {{ $user->user_id }}<br><small style="color:#b5b2b2;">{{ $user->email }}</small></td>
                      <td> {{$user->ip}}</td>
                  </tr>
                  @endforeach
              @else
              <tr>
                <td class="text-center" colspan="8">No Data Found</td>
              </tr>
              @endif             

            </tbody>
          </table>
          {{$LogActivity->links()}}
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