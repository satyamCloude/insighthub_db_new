@extends('layouts.admin')
@section('title', 'Department')
@section('content')
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Department /</span> Home</h4>
    @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
                 <!-- Role cards -->
                    <div class="row g-4">
                      @if(count($departmentData) > 0)
    @foreach($departmentData as $department)
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-normal mb-2">Total {{ $department['userCount'] }} users</h6>
                            </div>
                            <div class="d-flex justify-content-between align-items-end mt-1">
                                <div class="role-heading">
                                    <h4 class="mb-1">{{ $department['department'] }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" style="">
                                    <li><a class="dropdown-item" href="{{ url('admin/Department/edit/'.$department['department_id']) }}">Edit</a></li>
                                    @if($department['department_id'] > 5)
                                        <li><button class="dropdown-item delete_debtcase" url="{{ url('admin/Department/delete/'.$department['department_id']) }}" id="{{ $department['department_id'] }}">Delete</button></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

                              <!--if there is no record in department table show dummy boxes with 0 count-->
                              @else
                               <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="card">
                                  <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                      <h6 class="fw-normal mb-2">Total 0 users</h6>
                                     
                                    </div>
                                    <div class="d-flex justify-content-between align-items-end mt-1">
                                      <div class="role-heading">
                                        <h4 class="mb-1">Administrator</h4>
                                        
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                              <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="card">
                                  <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                      <h6 class="fw-normal mb-2">Total 0 users</h6>
                                     
                                    </div>
                                    <div class="d-flex justify-content-between align-items-end mt-1">
                                      <div class="role-heading">
                                        <h4 class="mb-1">Administrator</h4>
                                        
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                               <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="card">
                                  <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                      <h6 class="fw-normal mb-2">Total 0 users</h6>
                                     
                                    </div>
                                    <div class="d-flex justify-content-between align-items-end mt-1">
                                      <div class="role-heading">
                                        <h4 class="mb-1">HR</h4>
                                        
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                               <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="card">
                                  <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                      <h6 class="fw-normal mb-2">Total 0 users</h6>
                                     
                                    </div>
                                    <div class="d-flex justify-content-between align-items-end mt-1">
                                      <div class="role-heading">
                                        <h4 class="mb-1">Manager</h4>
                                        
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                                 <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="card">
                                  <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                      <h6 class="fw-normal mb-2">Total 0 users</h6>
                                     
                                    </div>
                                    <div class="d-flex justify-content-between align-items-end mt-1">
                                      <div class="role-heading">
                                        <h4 class="mb-1">HR</h4>
                                        
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>
                              </div>
                              @endif
                              
                             
                             
                            
                              <!--<div class="col-xl-4 col-lg-6 col-md-6">-->
                              <!--  <div class="card h-100">-->
                              <!--    <div class="row h-100">-->
                              <!--      <div class="col-sm-5">-->
                              <!--        <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">-->
                              <!--          <img src="https://demos.pixinvent.com/vuexy-html-admin-template/assets/img/illustrations/add-new-roles.png" class="img-fluid mt-sm-4 mt-md-0" alt="add-new-roles" width="83">-->
                              <!--        </div>-->
                              <!--      </div>-->
                              <!--      <div class="col-sm-7">-->
                              <!--        <div class="card-body text-sm-end text-center ps-sm-0">-->
                              <!--          <a href="{{url('admin/Department/add')}}" class="btn btn-primary mt-3 m-3">Add Department</a>-->
                                       
                              <!--        </div>-->
                              <!--      </div>-->
                              <!--    </div>-->
                              <!--  </div>-->
                              <!--</div>-->
                    </div>
              <!--/ Role Table -->
                    <div class="card mt-4">
                          <div class="card-datatable table-responsive">
                            
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">   <a href="{{url('admin/Department/add')}}" class="btn btn-primary mt-3 m-3">Add Department</a>
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
                <th>Department Name</th>
                <th>Department EMAIL</th>
                <th>Employee Name</th>
                <th>Employee EMAIL</th>
              </tr>
            </thead>
            <tbody>
              @if(count($Department) > 0)
             @foreach($Department as $key=> $user)
              <tr class="odd">
                  <td>{{ $key+1 }} </td>
                  <td>{{ $user->department_name }}</td>
                  <td>{{ $user->department_email }}</td>
                    <td>

                                                    @if($user->profile_img)

                                                    <img class="rounded-circle"

                                                    style="margin-right: 15px;margin-top: 10px;" 

                                                    src="{{$user->profile_img}}"

                                                    height="30"

                                                    width="30"

                                                    alt="User avatar" />

                                                    @else

                                                    <img class="rounded-circle"

                                                    style="margin-right: 15px;margin-top: 10px;" 

                                                    src="{{url('public/images/21104.png')}}"

                                                    height="30"

                                                    width="30"

                                                    alt="User avatar" />

                                                    @endif



                                                    {{$user->first_name }}</td>
                                                                      <td>{{ $user->email }}</td>

                 
              </tr>
              @endforeach
              @else
              <tr>
                <td class="text-center" colspan="5">No Data Found</td>
              </tr>
              @endif
            </tbody>
        </table>
          <div class="p-1" style="float: right;">
              {{ $Department->links() }}
          </div>
        </div>
                    </div>
  </div>
</div>
<!--/ Role cards -->

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