@extends('layouts.admin')
@section('title', 'Task Category')
@section('content')
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Task Category /</span> Home</h4>
    @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
  
  <!-- Users List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Task's List</h5>
      </div>
      <div class="col-md-6 text-end">
         <a href="{{url('Employee/TaskCategory/EXPORTCSV')}}" class="btn btn-info mt-3 m-3"><i class="fa-solid fa-file-csv"></i></a>
          <a href="{{url('Employee/TaskCategory/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
          <a href="{{url('Employee/TaskCategory/add')}}" class="btn btn-primary mt-3 m-3">Add</a>
      </div>
    </div>
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_length" id="DataTables_Table_3_length"><label>
              </div>
            </div>
           <!--  <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
              <div id="DataTables_Table_3_filter" class="dataTables_filter">
                  <form method="GET" action="">
                  <label>Search: <input type="search" value="" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                </form>
              </div>
            </div> -->
          </div>
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>Category Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if(count($TaskCategory) > 0)
              @foreach($TaskCategory as $key=> $Inventor)
              <tr class="odd">
                  <td>{{ $key+1 }} </td>
                  <td>@if($Inventor && $Inventor->category_name) {{ $Inventor->category_name }} @endif</td>
               
                          <td>
                    <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end" style="">
                            <li><a class="dropdown-item" href="{{url('Employee/TaskCategory/edit/'.$Inventor->id)}}">Edit</a></li>
                            <li><button class="dropdown-item delete_debtcase" url="{{url('Employee/TaskCategory/delete/'.$Inventor->id)}}" id="{{$Inventor->id}}">Delete</button></li>
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

function changepro(id) {
  var id = id.id;
  var status = "progress";
$('.progchange'+id).html('<select onchange="updatepro(\''+status+'\', value, '+id+')" class="form-select" name="status_pro">'+
                     '<option value="10">Select %</option>'+
                     '<option value="10">10 %</option>'+
                     '<option value="20">20 %</option>'+
                     '<option value="30">30 %</option>'+
                     '<option value="40">40 %</option>'+
                     '<option value="50">50 %</option>'+
                     '<option value="60">60 %</option>'+
                     '<option value="70">70 %</option>'+
                     '<option value="80">80 %</option>'+
                     '<option value="90">90 %</option>'+
                     '<option value="100">100 %</option>'+
                 '</select>');
  $('.hide'+id).html('');
}

function changestatus(id) {
  var id = id.id;
  var status = "stu";
  $('.statuschange'+id).html('<select onchange="updatepro(\''+status+'\', value, '+id+')" class="form-select" name="status_id">'+
                         '<option value="1">Select satuts</option>'+
                         '<option value="1">In Progress</option>'+
                         '<option value="2">Completed</option>'+
                         '<option value="3">Over Due</option>'+
                         '<option value="4">Cancel</option>'+
                      '</select>');
  $('.statushide'+id).html('');
}

function updatepro(status,value,id){
  $.ajax({
        url: "{{ url('Employee/TaskCategory/UpdateStatus') }}",
        method: 'GET',
        data: { id: id,
                status_pro: value, 
                status : status
              },
        success: function () {
           location.reload();
        },
        error: function () {
           
        }
    });



}

</script>
@endsection