<style>
  .hover1:hover{
    z-index:3 !important;
  }
</style>

<ul class="list-unstyled m-0">
  @if(count($Schedule) > 0)
  @foreach($Schedule as $key => $Send)
  <li class="email-list-item" ondblclick="ViewEmail({{$Send->id}})">
    <div class="d-flex align-items-center">
      <div class="form-check mb-0">
         <input class="email-list-item-input form-check-input Clicked" type="checkbox" data-id="{{$Send->id}}">
         <label class="form-check-label" for=""></label>
      </div>
      <i class="email-list-item-bookmark ti ti-star ti-sm d-sm-inline-block d-none cursor-pointer ms-2 me-3 @if($Send && $Send->star == 1) text-warning @endif" onclick="StarUpdate({{$Send->id}})"></i>
      <ul class="list-unstyled m-0 d-flex align-items-center avatar-group my-3">
        @php $senduser =  \App\Models\User::whereIn('id', explode(',',$Send->to_id))->where('type',2)->get() @endphp
            @foreach($senduser as $senduser)
           @php
                                              if(isset($senduser->profile_img))
                                                  $url = $senduser->profile_img;
                                              else
                                                  $url = url('public/images/emp_proa4NN.jpg');
                                          @endphp
                    <li data-bs-toggle="tooltip" data-bs-placement="top" class="avatar pull-up hover1" title="{{$senduser->first_name}}" style="padding:0px;">
                        <img class="rounded-circle" src="{{$url}}" alt="Avatar">
                    </li>
          @endforeach()
      </ul>
      &nbsp;&nbsp;&nbsp;&nbsp;
      <div class="email-list-item-content ms-2 ms-sm-0 me-2">
        <!-- <span class="h6 email-list-item-username me-2">{{$Send->first_name}}</span> -->
        <span class="email-list-item-subject d-xl-inline-block d-block me-2">{{$Send->subject}}</span>
      </div>
      <div class="email-list-item-meta ms-auto d-flex align-items-center">
        <small class="email-list-item-time text-muted" id="timelive-{{$key}}" style="width: 130px; text-align: center;"></small>
        <span class="email-list-item-label badge badge-dot bg-info d-none d-md-inline-block me-2" data-label="important"></span>
        <ul class="list-inline email-list-item-actions text-nowrap">
          <li class="list-inline-item email-unread"><i class="ti ti-mail ti-sm"></i></li>
          <li class="list-inline-item email-delete" onclick="Delete({{$Send->id}})"><i class="ti ti-trash ti-sm"></i></li>
        </ul>
      </div>
    </div>
  </li>

  <script>
    $(document).ready(function () {
      function updateLiveTime{{$key}}() {
        var scheduledDate{{$key}} = new Date("{{$Send->schedule_date}}");
        var currentDate{{$key}} = new Date();
        var timeDifference{{$key}} = scheduledDate{{$key}}.getTime() - currentDate{{$key}}.getTime();

        if (timeDifference{{$key}} <= 0) {
          $('#timelive-{{$key}}').html('Email Sent');
          return;
        }


        // Calculate years, months, days, hours, minutes, and seconds
        var years{{$key}} = Math.floor(timeDifference{{$key}} / (365.25 * 24 * 60 * 60 * 1000));
        var months{{$key}} = Math.floor((timeDifference{{$key}} % (365.25 * 24 * 60 * 60 * 1000)) / (30.44 * 24 * 60 * 60 * 1000));
        var days{{$key}} = Math.floor((timeDifference{{$key}} % (30.44 * 24 * 60 * 60 * 1000)) / (24 * 60 * 60 * 1000));
        var hours{{$key}} = Math.floor((timeDifference{{$key}} % (24 * 60 * 60 * 1000)) / (60 * 60 * 1000));
        var minutes{{$key}} = Math.floor((timeDifference{{$key}} % (60 * 60 * 1000)) / (60 * 1000));
        var seconds{{$key}} = Math.floor((timeDifference{{$key}} % (60 * 1000)) / 1000);

        // Display the time left
        var timeLeftString{{$key}} = '';

        if (years{{$key}} > 0) timeLeftString{{$key}} += years{{$key}} + " Y, ";
        if (months{{$key}} > 0) timeLeftString{{$key}} += months{{$key}} + " M, ";
        if (days{{$key}} > 0) timeLeftString{{$key}} += days{{$key}} + " D, ";
        if (hours{{$key}} > 0) timeLeftString{{$key}} += hours{{$key}} + " H, ";
        if (minutes{{$key}} > 0) timeLeftString{{$key}} += minutes{{$key}} + " Min, ";
        timeLeftString{{$key}} += seconds{{$key}} + " Sec";

        $('#timelive-{{$key}}').html(timeLeftString{{$key}});
      }

      // Update every second (1000 milliseconds)
      setInterval(updateLiveTime{{$key}}, 1000);

      // Initial update
      updateLiveTime{{$key}}();
    });
  </script>
  @endforeach
  @else
   <li class="email-list-empty text-center">No items found.</li>
   @endif
</ul>
