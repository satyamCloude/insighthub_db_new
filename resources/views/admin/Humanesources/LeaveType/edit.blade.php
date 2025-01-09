<div class="modal-dialog">
    <form class="modal-content" action="{{url('admin/LeaveType/update/'.$LeaveType->id)}}" method="post">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="backDropModalTitle">Leave Type</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row g-2">
          <div class="col mb-0">
            <label for="leave_type" class="form-label">Type <span class="text-danger">*</span></label>
            <input type="text"  value="{{$LeaveType->leave_type}}" name="leave_type" class="form-control" placeholder="Enter Leave type"required>
          </div>
          <div class="col mb-0">
            <label for="no_of_leave" class="form-label">Number of Leave <span class="text-danger">*</span></label>
            <input type="number" value="{{$LeaveType->no_of_leave}}"  name="no_of_leave" class="form-control"required>
          </div>
        </div>
        <div class="row mt-3">
            <label for="leave_type" class="form-label">Theme <span class="text-danger">*</span></label>
          <div class="col-md-6">
            <div class="form-check form-check-primary">
              <input class="form-check-input" required type="radio"  name="theme" @if($LeaveType && $LeaveType->theme == "primary") checked @endif value="primary" id="customCheckPrimary">
              <label class="form-check-label" for="customCheckPrimary"><span class="text-primary">Primary</span></label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-check form-check-secondary">
              <input class="form-check-input" required type="radio"  name="theme" @if($LeaveType && $LeaveType->theme == "secondary") checked @endif value="secondary" id="customCheckSecondary">
              <label class="form-check-label" for="customCheckSecondary"><span class="text-secondary">Secondary</span></label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-check form-check-success">
              <input class="form-check-input" required type="radio"  name="theme" @if($LeaveType && $LeaveType->theme == "success") checked @endif value="success" id="customCheckSuccess">
              <label class="form-check-label" for="customCheckSuccess"><span class="text-success">Success</span></label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-check form-check-danger">
              <input class="form-check-input" required type="radio"  name="theme" @if($LeaveType && $LeaveType->theme == "danger") checked @endif value="danger" id="customCheckDanger">
              <label class="form-check-label" for="customCheckDanger"><span class="text-danger">Danger</span></label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-check form-check-warning">
              <input class="form-check-input" required type="radio"  name="theme" @if($LeaveType && $LeaveType->theme == "warning") checked @endif value="warning" id="customCheckWarning">
              <label class="form-check-label" for="customCheckWarning"><span class="text-warning"> Warning</span> </label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-check form-check-info">
              <input class="form-check-input" required type="radio"  name="theme" @if($LeaveType && $LeaveType->theme == "info") selected @endif value=checked" id="customCheckInfo">
              <label class="form-check-label" for="customCheckInfo"><span class="text-info"> Info</span> </label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-check form-check-dark">
              <input class="form-check-input" required type="radio"  name="theme" @if($LeaveType && $LeaveType->theme == "dark") selected @endif value=checked" id="customCheckDark">
              <label class="form-check-label" for="customCheckDark"><span class="text-dark"> Dark</span> </label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-label-danger waves-effect" data-bs-dismiss="modal">
          Close
        </button>
        <button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
      </div>
    </form>
</div>