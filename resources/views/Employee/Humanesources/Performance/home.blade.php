@extends('layouts.admin')
@section('title', 'Performance')
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
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Performance /</span> Home</h4>
    @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
  <!-- Performance List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Performance List</h5>
      </div>
      <div class="col-md-6 text-end">
         <a href="{{url('Employee/Performance/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
          @if($RoleAccess[array_search('Performance', array_column($RoleAccess, 'per_name'))]['add'] == 1)
          <button type="button" onclick="addCategory()"  class="btn btn-secondary ms-2 waves-effect waves-float waves-light m-3">Category</button>
          <button type="button" onclick="addRating()"  class="btn btn-info ms-2 waves-effect waves-float waves-light m-3">Rating</button>
          <!--<a href="{{url('Employee/Performance/add')}}" class="btn btn-primary mt-3 m-3">Add</a>-->
          @endif
      </div>
    </div>
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_length" id="DataTables_Table_3_length"></div>
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
                <th>Employee Name</th>
                <th>Department</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="result">
              @if(count($Performance) > 0)
             @foreach($Performance as $key=> $user)
              @php          
                $Employee =  \App\Models\User::select('users.first_name','employee_details.department_id')->leftjoin('employee_details','employee_details.user_id','users.id')->where('employee_details.user_id',$user->employee_id)->first();           
                $department =  \App\Models\Department ::select('name')->where('id',$Employee->department_id)->first();           
              @endphp
              <tr class="odd">
                  <td>{{ $key+1 }} </td>
                  <td>@if($Employee && $Employee->first_name) {{ $Employee->first_name }} @endif</td>
                  <td>@if($department && $department->name) {{ $department->name }} @endif</td>
                  <td><a href="{{url('Employee/Performance/view/'.$user->employee_id)}}"><i class="fa-solid fa-eye"></i></a></td>
              </tr>
              @endforeach
              @else
              <tr>
                <td class="text-center" colspan="4">No Data Found</td>
              </tr>
              @endif             

            </tbody>
        </table>
          <div class="p-1" style="float: right;">
              {{ $Performance->links() }}
          </div>
      </div>
      </div>
    </div>
</div>
<!--Modal start-->
<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="backDropModalTitle">Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>CATEGORY NAME</th>
                <th>DESCRIPTION</th>
                <th>ACTION</th>
              </tr>
            </thead>
            <tbody id="PerformanceCategorydata">
              @if(count($PerformanceCategory) > 0)
              @foreach($PerformanceCategory as $key=> $Perfo)
              <tr>
                  <td>{{$key+1}} </td>
                  <td>{{$Perfo->category_name}} </td>
                  <td>{{$Perfo->description}} </td>
                  <td><a onclick="editdatat({{$Perfo->id}})"><i class="cursor-pointer text-dark fas fa-edit"></i></a>&nbsp;&nbsp; <a onclick="deletedatat({{$Perfo->id}})" ><i class="cursor-pointer text-dark fa-solid fa-trash"></i></a></td>
              </tr>
              @endforeach
               @else
              <tr>
                <td class="text-center" colspan="4">No Data Found</td>
              </tr>
              @endif
            </tbody>
        </table>
          <div id="editdataa">
            
          </div>
          <div class="row">
            <div class="col-md-5 mb-3">
              <input type="text" id="category_name" class="form-control" name="category_name" placeholder="Enter Category Name">
            </div>
            <div class="col-md-5 mb-3">
              <input type="text" id="description" class="form-control" name="description" placeholder="Enter description">
            </div>
            <div class="col-md-2 mb-3">
              <button type="button" onclick="Submitdata()" class="btn btn-success">Submit</button>
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
<!--Modal start-->
<div class="modal fade" id="ModalRatingopen" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="backDropModalTitle">Rating</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>RATING NAME</th>
                <th>RATING</th>
                <th>ACTION</th>
              </tr>
            </thead>
            <tbody id="PerformanceRating">
              @if(count($PerformanceRating) > 0)
              @foreach($PerformanceRating as $key=> $Perfo)
              <tr>
                  <td>{{$key+1}} </td>
                  <td>{{$Perfo->rating_name}} </td>
                  <td>{{$Perfo->rating}} </td>
                  <td><a onclick="editrating({{$Perfo->id}})"><i class="text-dark fas fa-edit"></i></a>&nbsp;&nbsp; <a onclick="deleterating({{$Perfo->id}})" ><i class="text-dark fa-solid fa-trash"></i></a></td>
              </tr>
              @endforeach
               @else
              <tr>
                <td class="text-center" colspan="4">No Data Found</td>
              </tr>
              @endif
            </tbody>
        </table>
          <div id="ratingdata">
            
          </div>
          <div class="row">
            <div class="col-md-5 mb-3">
              <input type="text" id="rating_name" class="form-control" name="rating_name" placeholder="Enter rating Name">
            </div>
            <div class="col-md-5 mb-3">
              <input type="number" step="any" id="rating" class="form-control" name="rating" placeholder="Enter rating">
            </div>
            <div class="col-md-2 mb-3">
              <button type="button" onclick="Submitrating()" class="btn btn-success">Submit</button>
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
function addCategory(){
  $('#backDropModal').modal('show');
}



function updateddataa(id){
  // Get values from input fields
  var category_name = $('#category_name2').val();
  var description = $('#description2').val();

  if (category_name.trim() === '' || description.trim() === '') {
    alert('Please fill out both category name and description fields.');
  } else {
    $.ajax({
      url: "{{ url('Employee/PerformanceCategory/update') }}",
      type: 'post',
      data: {
        'category_name': category_name,
        'description': description,
        'id': id,
        '_token': "{{ csrf_token() }}",
      },
      success: function (data) {
        $('#PerformanceCategorydata').empty();
        if (data.length > 0) {

          $('#editdataa').html('');
          $('#PerformanceCategorydata').html(data);
        } else {
          $('#PerformanceCategorydata').html('<tr><td colspan="4" class="text-center"><span>No Data Found</span></td></tr>');
        }
      },
      error: function () {
        $('#PerformanceCategorydata').html('<tr><td colspan="4" class="text-center"><span>Error fetching data.</span></td></tr>');
      }
    });
  }
}

function editdatat(id){

  $.ajax({
      url: "{{ url('Employee/PerformanceCategory/edit') }}",
      type: 'post',
      data: {
        'id': id,
        '_token': "{{ csrf_token() }}",
      },
      success: function (data) {
        $('#editdataa').empty(); 
        if (data.length > 0) {
          $('#editdataa').html(data);
        } else {
          $('#editdataa').html('<div class="text-center"><span>No Data Found</span></div>');
        }
      },
      error: function () {
        $('#editdataa').html('<div colspan="4" class="text-center"><span>Error fetching data.</span></div>');
      }
    });
}

function deletedatat(id){
 $.ajax({
      url: "{{ url('Employee/PerformanceCategory/delete') }}",
      type: 'post',
      data: {
        'id': id,
        '_token': "{{ csrf_token() }}",
      },
      success: function (data) {
        $('#PerformanceCategorydata').empty(); 
        if (data.length > 0) {
          $('#PerformanceCategorydata').html(data);
        } else {
          $('#PerformanceCategorydata').html('<tr><td colspan="4" class="text-center"><span>No Data Found</span></td></tr>');
        }
      },
      error: function () {
        $('#PerformanceCategorydata').html('<tr><td colspan="4" class="text-center"><span>Error fetching data.</span></td></tr>');
      }
    });
}



function Submitdata() {
  // Get values from input fields
  var category_name = $('#category_name').val();
  var description = $('#description').val();

  if (category_name.trim() === '' || description.trim() === '') {
    alert('Please fill out both category name and description fields.');
  } else {
    $.ajax({
      url: "{{ url('Employee/PerformanceCategory/store') }}",
      type: 'post',
      data: {
        'category_name': category_name,
        'description': description,
        '_token': "{{ csrf_token() }}",
      },
      success: function (data) {
        $('#PerformanceCategorydata').empty();
        if (data.length > 0) {
          $('#PerformanceCategorydata').html(data);
        } else {
          $('#PerformanceCategorydata').html('<tr><td colspan="4" class="text-center"><span>No Data Found</span></td></tr>');
        }
      },
      error: function () {
        $('#PerformanceCategorydata').html('<tr><td colspan="4" class="text-center"><span>Error fetching data.</span></td></tr>');
      }
    });
  }
}

function addRating(){
  $('#ModalRatingopen').modal('show');
}


function Submitrating() {
  // Get values from input fields
  var rating_name = $('#rating_name').val();
  var rating = $('#rating').val();  // Fixed variable name here

  if (rating_name === '' || rating === '') {
    alert('Please fill out both rating name and rating fields.');
  } else {
    $.ajax({
      url: "{{ url('Employee/PerformanceRating/store') }}",
      type: 'post',
      data: {
        'rating_name': rating_name,
        'rating': rating,
        '_token': "{{ csrf_token() }}",
      },
      success: function (data) {
        $('#PerformanceRating').empty();
        if (data.length > 0) {
          $('#PerformanceRating').html(data);
        } else {
          $('#PerformanceRating').html('<tr><td colspan="4" class="text-center"><span>No Data Found</span></td></tr>');
        }
      },
      error: function () {
        $('#PerformanceRating').html('<tr><td colspan="4" class="text-center"><span>Error fetching data.</span></td></tr>');
      }
    });
  }
}

function editrating(id){

  $.ajax({
      url: "{{ url('Employee/PerformanceRating/edit') }}",
      type: 'post',
      data: {
        'id': id,
        '_token': "{{ csrf_token() }}",
      },
      success: function (data) {
        $('#ratingdata').empty(); 
        if (data.length > 0) {
          $('#ratingdata').html(data);
        } else {
          $('#ratingdata').html('<div class="text-center"><span>No Data Found</span></div>');
        }
      },
      error: function () {
        $('#ratingdata').html('<div colspan="4" class="text-center"><span>Error fetching data.</span></div>');
      }
    });
}

function updaterating(id){
  // Get values from input fields
  var rating_name = $('#rating_name2').val();
  var rating = $('#rating2').val();

   if (rating_name === '' || rating === '') {
    alert('Please fill out both rating name and rating fields.');
  } else {
    $.ajax({
      url: "{{ url('Employee/PerformanceRating/update') }}",
      type: 'post',
      data: {
        'rating_name': rating_name,
        'rating': rating,
        'id': id,
        '_token': "{{ csrf_token() }}",
      },
      success: function (data) {
        $('#PerformanceRating').empty();
        if (data.length > 0) {

          $('#ratingdata').html('');
          $('#PerformanceRating').html(data);
        } else {
          $('#PerformanceRating').html('<tr><td colspan="4" class="text-center"><span>No Data Found</span></td></tr>');
        }
      },
      error: function () {
        $('#PerformanceRating').html('<tr><td colspan="4" class="text-center"><span>Error fetching data.</span></td></tr>');
      }
    });
  }
}

function deleterating(id){
 $.ajax({
      url: "{{ url('Employee/PerformanceRating/delete') }}",
      type: 'post',
      data: {
        'id': id,
        '_token': "{{ csrf_token() }}",
      },
      success: function (data) {
        $('#PerformanceRating').empty(); 
        if (data.length > 0) {
          $('#PerformanceRating').html(data);
        } else {
          $('#PerformanceRating').html('<tr><td colspan="4" class="text-center"><span>No Data Found</span></td></tr>');
        }
      },
      error: function () {
        $('#PerformanceRating').html('<tr><td colspan="4" class="text-center"><span>Error fetching data.</span></td></tr>');
      }
    });
}


</script>
@endsection