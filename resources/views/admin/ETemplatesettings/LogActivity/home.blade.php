@extends('layouts.admin')
@section('title', 'Log Activity')
@section('content')

  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Logs Activity's List</h5>
      </div>
      <div class="col-md-6 text-end">
           <button type="button" onclick="Tab(value)" value="Logs" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></button>
      </div>
    </div>
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_length" id="DataTables_Table_3_length"><label></div>
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
                <th>IP</th>
                <th>Activity</th>
                <th>URL</th>
                <th>Method</th>
                <th>Browser</th>
                <th>Created At</th>
              </tr>
            </thead>
            <tbody id="result">
              @if(count($LogActivity) > 0)
             @foreach($LogActivity as $key=> $user)
              <tr class="odd">
                  <td>{{ $key+1 }} </td>
                  <td>@if($user && $user->ip) {{ $user->ip }} @endif</td>
                  <td>@if($user && $user->subject) {{ $user->subject }} @endif</td>
                  <td>@if($user && $user->url) {{ $user->url }} @endif</td>
                  <td>@if($user && $user->method) {{ $user->method }} @endif</td>
                  <td>@if($user && $user->browser) {{ $user->browser }} @endif</td>
                  <td>@if($user && $user->created_at) {{ $user->created_at }} @endif</td>
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