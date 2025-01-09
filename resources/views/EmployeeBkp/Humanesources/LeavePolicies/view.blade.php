<div class="modal-dialog">
  <form class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="backDropModalTitle">Leave Policies</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
      <div class="modal-body">
      <div class="row mb-4"> 
                <div class="col-md-6">
                      <h4>{{$LeavePolicies->title}}</h4>
                </div>
                <div class="col-md-6">
                </div>
              </div>
              <hr>
                      <p class="mt-3">{!!$LeavePolicies->policies!!}</p>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">
        Close
      </button>
      <!-- <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button> -->
    </div>
  </form>
</div>

