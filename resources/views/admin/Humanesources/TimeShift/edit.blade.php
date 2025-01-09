@extends('layouts.admin')
@section('title', 'TimeShift')
@section('content')
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">TimeShift /</span> Edit</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Edit Detail's</h5>
            <div class="action-btns">
              <a href="{{url('admin/TimeShift/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('admin/TimeShift/update/'.$TimeShift->id)}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row"> 
                <div class="col-sm-6 mb-4">
                      <label class="form-label">Shift Name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="shift_name" @if($TimeShift && $TimeShift->shift_name) value="{{$TimeShift->shift_name}}" @endif placeholder="Enter Shift Name" required/>
                </div>

                <div class="col-sm-6 mb-4">
                      <label class="form-label">Color Code <span class="text-danger">*</span></label>
                      <div>
                        <div class="input-group">
                          <input type="text" class="form-control" name="Colorname" @if($TimeShift && $TimeShift->Colorname) value="{{$TimeShift->Colorname}}" @endif id="Colorchane"  placeholder="Color Code" aria-label="ColorCode" aria-describedby="basic-addon11" style="width: 94%;">
                          <input class="form-control" type="color" @if($TimeShift && $TimeShift->Colorname) value="{{$TimeShift->Colorname}}" @endif onchange="getClor(value)" style="width: 5%;padding: 7px;height:auto;">
                        </div>
                      </div>
                </div>
                <div class="col-sm-4 mb-4">
                    <label class="form-label">Shift Start Time <span class="text-danger">*</span></label>
                    <input type="time" class="form-control" id="StartTime" @if($TimeShift && $TimeShift->StartTime) value="{{$TimeShift->StartTime}}" @endif name="StartTime" placeholder="Shift Start Time" required/>
                </div>

                <div class="col-sm-4 mb-4">
                    <label class="form-label">Shift End Time <span class="text-danger">*</span></label>
                    <input type="time" class="form-control" id="EndTime" @if($TimeShift && $TimeShift->EndTime) value="{{$TimeShift->EndTime}}" @endif name="EndTime" placeholder="Shift End Time" required/>
                </div>

                <div class="col-sm-4 mb-4">
                  <label class="form-label">Break Time (minutes)<span class="text-danger">*</span></label>
                  <input type="number" class="form-control" id="break_time" @if($TimeShift && $TimeShift->break_time) value="{{$TimeShift->break_time}}" @endif name="break_time" placeholder="Shift break time (mins)" required/>
                </div>

                <input type="hidden" id="workinghours" name="working_hours" @if($TimeShift && $TimeShift->working_hours) value="{{$TimeShift->working_hours}}" @endif readonly>
                <div class="col-sm-4 mb-4">
                      <label class="form-label">Half-day Mark Time <span class="text-danger">*</span></label>
                      <input type="time" class="form-control" name="HalfdayMarkTime" @if($TimeShift && $TimeShift->HalfdayMarkTime) value="{{$TimeShift->HalfdayMarkTime}}" @endif  placeholder="Half-day Mark Time" required/>
                </div>
                <div class="col-sm-4 mb-4">
                      <label class="form-label">Early Clock In (minutes) </label>
                      <input type="number" class="form-control" name="EarlyClockIn" @if($TimeShift && $TimeShift->EarlyClockIn) value="{{$TimeShift->EarlyClockIn}}" @endif  placeholder="Early Clock In (minutes)" required/>
                </div>
                
                <div class="col-sm-4  mb-4">
                      <label class="form-label">Late mark after (minutes) <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" name="Latemarkafter" @if($TimeShift && $TimeShift->Latemarkafter) value="{{$TimeShift->Latemarkafter}}" @endif  placeholder="Late mark after (minutes)" required/>
                </div> 
                <div class="col-sm-4  mb-4">
                      <label class="form-label">Maximum check-in allowed in a day <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" name="Maximumcheckinallowedinaday" @if($TimeShift && $TimeShift->Maximumcheckinallowedinaday) value="{{$TimeShift->Maximumcheckinallowedinaday}}" @endif placeholder="Maximum check-in allowed in a day" required/>
                </div>
                <!--<div class="col-sm-12 mb-4">-->
                <!--      <label class="form-label">Office opens on <span class="text-danger">*</span></label>-->
                <!--    <div class="d-flex justify-content-between mt-4">-->
                <!--      <div class="form-check mt-1">-->
                <!--        <input type="checkbox" class="form-check-input"  @if($TimeShift && $TimeShift->monday == 'on' ) checked @endif  name="monday"/>-->
                <!--        <label class="form-label">Monday</label>-->
                <!--      </div><div class="form-check mt-1">-->
                <!--        <input type="checkbox" class="form-check-input"  @if($TimeShift && $TimeShift->tuesday == 'on' ) checked @endif  name="tuesday"/>-->
                <!--        <label class="form-label">Tuesday</label>-->
                <!--      </div><div class="form-check mt-1">-->
                <!--        <input type="checkbox" class="form-check-input"  @if($TimeShift && $TimeShift->wednesday == 'on' ) checked @endif  name="wednesday"/>-->
                <!--        <label class="form-label">Wednesday</label>-->
                <!--      </div><div class="form-check mt-1">-->
                <!--        <input type="checkbox" class="form-check-input"  @if($TimeShift && $TimeShift->thursday == 'on' ) checked @endif  name="thursday"/>-->
                <!--        <label class="form-label">Thursday</label>-->
                <!--      </div><div class="form-check mt-1">-->
                <!--        <input type="checkbox" class="form-check-input"  @if($TimeShift && $TimeShift->friday == 'on' ) checked @endif  name="friday"/>-->
                <!--        <label class="form-label">Friday</label>-->
                <!--      </div><div class="form-check mt-1">-->
                <!--        <input type="checkbox" class="form-check-input"  @if($TimeShift && $TimeShift->saturday == 'on' ) checked @endif  name="saturday"/>-->
                <!--        <label class="form-label">Saturday</label>-->
                <!--      </div><div class="form-check mt-1">-->
                <!--        <input type="checkbox" class="form-check-input"  @if($TimeShift && $TimeShift->sunday == 'on' ) checked @endif  name="sunday"/>-->
                <!--        <label class="form-label">Sunday</label>-->
                <!--      </div>-->
                <!--    </div>-->
                <!--</div>-->
                
              </div>
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-sm-6 mb-4 text-end" >
                  <a href="{{url('admin/TimeShift/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
                </div>
                <div class="col-sm-6 mb-4">
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
<!-- / Content -->
<script type="text/javascript">
 function getClor(value) {
    $('#Colorchane').val(value);
  }
    // Wait for the document to be ready
    $(document).ready(function () {
        // Attach change event handlers to the time inputs
        $('#StartTime, #EndTime').change(function () {
            // Get the values of the start and end times
            var startTime = $('#StartTime').val();
            var endTime = $('#EndTime').val();

            // Check if both start and end times are selected
            if (startTime !== '' && endTime !== '') {
                // Calculate the time difference
                var start = new Date('1970-01-01 ' + startTime);
                var end = new Date('1970-01-01 ' + endTime);
                var diff = end - start;

                // Convert the time difference to HH:mm:ss format
                var hours = Math.floor(diff / 3600000);
                var minutes = Math.floor((diff % 3600000) / 60000);
                var seconds = Math.floor((diff % 60000) / 1000);

                // Format hours, minutes, and seconds to ensure two digits
                hours = ('0' + hours).slice(-2);
                minutes = ('0' + minutes).slice(-2);
                seconds = ('0' + seconds).slice(-2);

                // Update the value of the working_hours input
                $('#workinghours').val(hours + ':' + minutes + ':' + seconds);
            } else {
                // Clear the value if either start or end time is not selected
                $('#workinghours').val('');
            }
        });
    });
</script>

@endsection








