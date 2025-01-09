<div class="modal-dialog">
      <form action="{{url('admin/LeadsFollowup/update/'.$LeadsFollowup->id)}}"   class="modal-content" method="post" enctype="multipart/form-data"> 
        @csrf
        <div class="modal-header">
          <h4>Follow UP</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-6 mb-3">
              <label for="Follow Up Next" class="form-label">Follow Up Next</label>
              <input type="date" class="form-control" value="{{$LeadsFollowup->follow_up_next}}" name="follow_up_next" id="Follow Up Next" required/>
            </div>
            <div class="col-sm-6 mb-3">
              <label for="StartTime" class="form-label">Start Time</label>
              <input type="time" class="form-control" value="{{$LeadsFollowup->start_time}}" name="start_time" id="StartTime" required/>
            </div>
            <!--<div class="col-sm-12 mb-3">-->
            <!--  <div class="form-check form-check-primary mt-3">-->
            <!--    <input class="form-check-input" type="checkbox" value="" id="customCheckPrimary"  name="custom_check_primary" onclick="Sendreminder()">-->
            <!--    <label class="form-check-label" for="customCheckPrimary">Send Reminder</label>-->
            <!--  </div>-->
            <!--</div>-->
            <!--<div class="row" id="Sendreminder">-->
            <!--  @if($LeadsFollowup->remind_before || $LeadsFollowup->remind_type)-->
            <!--  <div class="col-sm-6 mb-3">-->
            <!--    <label for="Remindbefore" class="form-label">Remind before </label>-->
            <!--    <input type="number" class="form-control" value="{{$LeadsFollowup->remind_before}}" name="remind_before" id="Remind before"/>-->
            <!--  </div>-->
            <!--  <div class="col-sm-6 mt-4">-->
            <!--    <select name="remind_type" data-live-search="true" class="form-control select2" tabindex="null">-->
            <!--      <option value="null">Select Time</option>-->
            <!--      <option @if($LeadsFollowup && $LeadsFollowup->remind_type == "day") selected @endif value="day">Day(s)</option>-->
            <!--      <option @if($LeadsFollowup && $LeadsFollowup->remind_type == "hour") selected @endif value="hour">Hour(s)</option>-->
            <!--      <option @if($LeadsFollowup && $LeadsFollowup->remind_type == "minute") selected @endif value="minute">Minute(s)</option>-->
            <!--    </select>-->
            <!--  </div>-->
            <!--  @endif-->
            <!--</div>-->
            <div class="col-sm-12 mb-3">
              <label for="Remark" class="form-label">Remark</label>
              <textarea class="form-control" name="remark">{{$LeadsFollowup->remark}}</textarea>
            </div>
              <div class="col-sm-12 mb-3">
            <label for="Remark" class="form-label">Status</label>
                <select class="form-control" name="status" id="status">
                    <option @if($LeadsFollowup->status == 0) selected @endif value="0">Pending</option>
                    <option  @if($LeadsFollowup->status == 1) selected @endif value="1">Completed</option>
                    <option   @if($LeadsFollowup->status == 2) selected @endif value="2">Due</option>
                    </select>
          </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
        </div>
      </form>
    </div>