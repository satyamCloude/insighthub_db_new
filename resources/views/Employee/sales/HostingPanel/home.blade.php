@extends('layouts.admin')
@section('title', 'Hosting')
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
</style>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Hosting Panel's /</span> Home</h4>
    @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
 <!--  -->
  <!-- Users List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Hosting List</h5>
      </div>
      <div class="col-md-6 text-end">
          <a href="{{url('admin/HostingPanel/create')}}" class="btn btn-primary mt-3 m-3">Add Hosting</a>
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
                  <label>Search: <input type="search" value="" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                </form>
              </div>
            </div>
          </div>
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>Hosting Name</th>
                <th>Price</th>
                <th>STATUS</th>               
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @if(count($host) > 0)
             @foreach($host as $key=> $user)
             
              <tr class="odd">
                  <td>{{ $key+1 }} </td>
                  <td>{{ $user->hosting_name }}</td>
                  <td>{{ $user->price }}</td>
                  <td>
                   @switch($user->status)
                          @case('1')
                            <span class="badge bg-label-success">Active</span>
                              @break
                          @case('0')
                            <span class="badge bg-label-danger">InActive</span>
                              @break
                          @default
                                <span></span>
                          @endswitch
                  </td>
                  <td>
                    <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end" style="">
                            <!-- @if($user->status == '5') -->
                            <!-- <li><a class="dropdown-item" href="{{url('admin/Quotes/downloadPDF/'.$user->id)}}">Download PDF</a></li>
                            <li><a class="dropdown-item" href="{{url('admin/Quotes/printView/'.$user->id)}}">View PDF</a></li> -->
                            <!-- @elseif($user->status == '3')   -->
                            <!-- <li><a class="dropdown-item" href="{{url('admin/Quotes/GenerateQuotes/'.$user->id)}}">Generate Quotes</a></li> -->
                            <!-- @else   -->
                            <!-- <li><a class="dropdown-item" href="{{url('admin/Categories/view/'.$user->id)}}">View</a></li> -->
                            <li><a class="dropdown-item" href="{{url('admin/HostingPanel/edit/'.$user->id)}}">Edit</a></li>
                            <li><button class="dropdown-item delete_debtcase" url="{{url('admin/HostingPanel/delete/'.$user->id)}}" id="{{$user->id}}">Delete</button></li>
                            <!-- @endif -->
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