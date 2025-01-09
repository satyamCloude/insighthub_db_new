<style>
.hover1:hover{
  z-index:3 !important;
}
.ql-tooltip ,.ql-hidden{
  display: none;
}
</style>
<div class="app-email-view-content">
    <div class="email-card-last mx-sm-4 mx-3 mt-4">
      <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
        <div class="d-flex align-items-center mb-sm-0 mb-3">
          <ul class="list-unstyled m-0 d-flex align-items-center avatar-group my-3">
          @php $senduser =  \App\Models\User::whereIn('id', explode(',',$Show->to_id))->where('type',2)->get() @endphp
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
          <!-- <div class="flex-grow-1 ms-1">
            <h6 class="m-0">Chandler Bing</h6>
            <small class="text-muted">iAmAhoot@email.com</small>
          </div> -->
        </div>
        <div class="d-flex align-items-center">
          <p class="mb-0 me-3 text-muted">{{ \Carbon\Carbon::parse($Show->created_at)->format('F jS Y, h:i A') }}</p>
          <i class="email-list-item-bookmark ti ti-star ti-sm cursor-pointer me-2 @if($Show && $Show->star == 1) text-warning @endif" onclick="StarUpdate({{$Show->id}})"></i>
        </div>
      </div>
      <div class="card-body">
        <p>{!!$Header!!}</p>
        <p>{!!$Show->description!!}</p>
        <p>{!!$Footer!!}</p>
      </div>
    </div>
</div>
<script>
  $(document).ready(function () {
    $('[data-bs-toggle="tooltip"]').tooltip();
  });
</script>  
