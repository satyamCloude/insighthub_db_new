   
    <div class="row">
      <div class="col-md-6">
      </div>
      <div class="col-md-6 text-end">
      </div>
    </div>
    <div class="card-datatable table-responsive">
              <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">


                <div class="col-lg-12 ">
                  <div class="border-grey mt-3 p-4 rounded-top">
                    <div class="row justify-content-center">
                  <form action="{{url('admin/LeaveSettings/store')}}" id="leaveSettingsForm" method="post" enctype="multipart/form-data"> 
                          @csrf
                    <div class="col-md-11">
                        <div class="form-group">
                            <div class="d-block d-lg-flex d-md-flex">
                                <div class="form-check-inline custom-control custom-radio mt-2 mr-3">
                                    <input type="radio" value="1" @if($LeaveSettings->count_leave_from == 1) checked @endif class="custom-control-input" id="login-yes" name="count_leave_from" autocomplete="off">
                                    <label class="custom-control-label pt-1 cursor-pointer" for="login-yes">Count leaves from the date of joining</label>
                                </div>
                                <div class="form-check-inline custom-control custom-radio mt-2 mr-3">
                                    <input type="radio" value="0" @if($LeaveSettings->count_leave_from == 0) checked @endif class="custom-control-input" id="login-no" name="count_leave_from" autocomplete="off">
                                    <label class="custom-control-label pt-1 cursor-pointer" for="login-no">Count leaves from the start of the year</label>
                                </div>
                            </div>
                        </div>
                    </div>

                  <div class="d-block d-lg-flex d-md-flex ml-3 mt-2 mr-3" id="yearStartsContainer">
            <div class="col-lg-3" id="year_starts" @if($LeaveSettings->leaves_start_from != 'year_start') style="display: none;" @endif>
                <label class="f-14 text-dark-grey mb-12 mt-3" data-label="" for="start_year_from">Year Starts from</label>
                <select name="start_year_from" id="start_year_from" class="form-control">
                    @for ($month = 1; $month <= 12; $month++)
                        <option value="{{ $month }}" @if($LeaveSettings->start_year_from == $month) selected @endif>
                            {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                        </option>
                    @endfor
                </select>
            </div>
        </div>



                      <div class="d-block d-lg-flex d-md-flex  ml-3  mt-2 mr-3">
                        <div class="alert alert-info" type="info">
                          Note: Approve means direct approval, Pre-Approval means another approval by admin/hr is required.
                        </div>
                      </div>

                      <div class="d-block d-lg-flex d-md-flex  ml-3  mt-2 mr-3">
                        <p>Reporting Manager can </p> &nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="col-lg-4">
                          <select name="leave_approval_permission" class="form-control" onchange="changeStatus(this.value)">
                            <option value="pre-approve">Pre-Approve</option>
                            <option value="approved">Approve</option>
                            <option value="cannot-approve">Not Approve</option>
                          </select>
                        </div>
                        <p> the Leave </p>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>

              </div>
    </div>
  

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

<script>
    $('input[name="count_leave_from"]').change(function() {
      if ($(this).val() == '0') {
        $('#year_starts').show();
      } else {
        $('#year_starts').hide();
      $('#leaveSettingsForm').submit();
      }

    });  
     $('#start_year_from').change(function() {
    
      $('#leaveSettingsForm').submit();
    });
     function changeStatus(value) {

      $('#leaveSettingsForm').submit();
     }
    // $('input[name="count_leave_from"]:checked').trigger('change');

</script>
