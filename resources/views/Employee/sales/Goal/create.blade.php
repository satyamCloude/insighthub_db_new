  @extends('layouts.admin')
@section('title', 'Create')
@section('content')
<style>
    .dropbtn {
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    background-color: #fff;
    border: 1px solid #dbdade;
    border-radius: 0.375rem;
    border-color: #C9C8CE !important;
    height: 40px;
    width: 100%;
    text-align: left;
    color: #6f6b7d;
    font-weight: 500;
    font-size: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .dropdown {
    position: relative;
    display: inline-block;
  }

  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 100%;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
    max-height: 350px;
    overflow-x: scroll;
  }

  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }

  .dropdown-content a:hover {
    background-color: #f1f1f1
  }

  .dropdown:hover .dropdown-content {
    display: block;
  }

  .dropdown:hover .dropbtn {
    background-color: white;
  }
</style>
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Goal /</span> Add</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="{{url('Employee/Goal/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('Employee/Goal/store')}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                    <label for="date" class="form-label">Employee <span class="text-danger">*</span></label>
                    <!--<select name="employee_id" class="form-control select2" required id="employee_id">-->
                    <!--    @foreach($Employee as $Emp)-->
                    <!--    <option value="{{$Emp->id}}">{{$Emp->first_name}}</option>-->
                    <!--    @endforeach-->
                    <!--</select>-->
                    
                    <div class="dropdown">
                  <button type="button" class="dropbtn" id="selected_client_btn2">Select Employee <i class="fa fa-angle-down" style="font-size:24px"></i></button>
                  <div class="dropdown-content">
                      @foreach($Employee as $CCID)
                    <div class="outer" id="clients_{{ $CCID->id }}" style="display:flex;margin:6px;padding:4px;color:black;" onclick="selectClient2({{ $CCID->id }})">
                      @if($CCID->profile_img)<img src="{{ $CCID->profile_img }}" style="width:45px;border-radius:50%;height:45px;">
                      @else
                      <img src="{{ url('public/images/emp_proa4NN.jpg') }}" style="width:45px;border-radius:50%;height:45px;">
                      @endif
                      <div class="sie_cont" style="display:flex;flex-direction:column;margin:5px;">
                        <span>{{ $CCID->first_name }} {{$CCID->last_name}} (#{{ $CCID->id }}) <br/>{{$CCID->desname}}</span>
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
                <input type="hidden" name="employee_id" id="set_client_id2">
                </div>
                <div class="col-md-6">
                    <label for="job_role_id" class="form-label">Job Role <span class="text-danger">*</span></label>
                    <select name="job_role_id" id="job_role_id" class="form-control select2" required>
                        @foreach($Jobroles as $Job)
                        <option value="{{$Job->id}}">{{$Job->name}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                    <label for="goal_value" class="form-label">Goal Value <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="goal_value" placeholder="12" required/>
                </div>
                <div class="col-md-6">
                    <label for="phone_number" class="form-label">Currency <span class="text-danger">*</span></label>
                    <select name="currency_id" class="form-control select2" required>
                        @foreach($Currency as $Curr)
                        <option value="{{$Curr->id}}">{{$Curr->prefix}} {{$Curr->code}}</option>
                        @endforeach
                    </select>
                </div>
              </div> 
               <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="goal_value" class="form-label">Months <span class="text-danger">*</span></label>
                      <select name="months_id" class="form-control select2" id="months">
                        @foreach($Months as $Month)
                          <option value="{{$Month->id}}" @if($Month->id == date('m')) selected @endif >{{$Month->name}}</option>
                        @endforeach
                </select>
                </div>
                <div class="col-md-6">
                </div>
              </div>    
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('Employee/Goal/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
            </div> 
          </form>
        </div>
      </div>
    </div>
    <!-- /Sticky Actions -->
  </div>
  
    <script>
        $(document).ready(function(){
            $('#employee_id').change(function(){
                var emp_id = $(this).val();
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
                $.ajax({
                  type: 'GET',
                  url: "{{url('Employee/Employee/getEmployeeRole')}}/"+emp_id,
                  success: function(res) {
                    $('[name="job_role_id"]').val(res.jobrole_id).change();
                  },
                });
            });
        });
        
        function selectClient2(id) {
            var clientName = $('#clients_' + id + ' .sie_cont span:first-child').text(); // Extract client name from selected item
            $('#selected_client_btn2').text(clientName); // Set the button text to the selected client name
            $('#set_client_id2').val(id); // Set the button text to the selected client name
        
            $('.dropdown-content .outer').removeClass('selected');
        
            // Add the 'selected' class to the clicked option
            $('#clients_' + id).addClass('selected');
        
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'GET',
                url: "{{url('Employee/Invoices/getEmployeeDetails')}}/"+id,
                success: function(res) {
                    var jobRoleId = res.data.jobrole_id;
                    // Update Select2 option selection
                    $('#job_role_id').val(jobRoleId).trigger('change');
                },
            });
        }
         
    </script>
<!-- / Content -->
@endsection