<style>
.hover1:hover{
  z-index:3 !important;
}
</style>
<ul class="list-unstyled m-0">
   @if(count($StarMails) > 0)
   @foreach($StarMails as $key=> $Send)
<!-- email-marked-read d-block -->
   <li class="email-list-item " ondblclick="ViewEmail({{$Send->id}})">
     <div class="d-flex align-items-center">
       <div class="form-check mb-0">
         <input class="email-list-item-input form-check-input" type="checkbox" id="email-{{$key+1}}">
         <label class="form-check-label" for="email-{{$key+1}}"></label>
       </div>
       <i class="email-list-item-bookmark ti ti-star text-warning ti-sm d-sm-inline-block d-none cursor-pointer ms-2 me-3" onclick="StarUpdate({{$Send->id}})"></i>
       <ul class="list-unstyled m-0 d-flex align-items-center avatar-group my-3">
          @php $senduser =  \App\Models\User::whereIn('id', explode(',',$Send->to_id))->where('type',2)->get() @endphp
            @foreach($senduser as $senduser)
          <li data-bs-toggle="tooltip" data-bs-placement="top" class="avatar pull-up hover1" title="{{$senduser->first_name}}" style="padding:0px;">
              <img class="rounded-circle" src="{{$senduser->profile_img}}" alt="Avatar">
          </li>
          @endforeach()
        </ul>
        &nbsp;&nbsp;&nbsp;&nbsp;
       <div class="email-list-item-content ms-2 ms-sm-0 me-2">
         <!-- <span class="h6 email-list-item-username me-2">{{$Send->first_name}}</span> -->
         <span class="email-list-item-subject d-xl-inline-block d-block me-2">{{$Send->subject}}</span>
       </div>
       <div class="email-list-item-meta ms-auto d-flex align-items-center">
         <span class="email-list-item-label badge badge-dot @if($Send->status == '1') bg-success @elseif ($Send->status == '4') bg-danger  @elseif($Send->status == '3') bg-info @elseif($Send->status == '2') bg-primary @endif d-md-inline-block me-2" data-label="important"></span>
         <small class="email-list-item-time text-muted">{{$Send->created_at->format('g:i A')}}</small>
         <ul class="list-inline email-list-item-actions text-nowrap">
           <li class="list-inline-item email-unread"><i class="ti ti-mail ti-sm"></i></li>
           <li class="list-inline-item email-delete" onclick="Delete({{$Send->id}})"><i class="ti ti-trash ti-sm"></i></li>
         </ul>
       </div>
     </div>
   </li>
   @endforeach
   @else
   <li class="email-list-empty text-center">No items found.</li>
   @endif
</ul>
<script>
  $(document).ready(function () {
    $('[data-bs-toggle="tooltip"]').tooltip();
  });
</script>  
