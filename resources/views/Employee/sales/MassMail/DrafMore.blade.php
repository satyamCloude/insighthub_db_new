<style>
.hover1:hover{
  z-index:3 !important;
}
</style>
        <ul class="list-unstyled m-0">
          @if(count($DraftMails) > 0)
           @foreach($DraftMails as $key=> $Send)
           <li class="email-list-item " ondblclick="ViewEmail({{$Send->id}})">
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
                 <span class="email-list-item-label badge badge-dot bg-primary d-md-inline-block me-2" data-label="important"></span>
                 <small class="email-list-item-time text-muted">{{$Send->created_at->format('g:i A')}}</small>
                 <ul class="list-inline email-list-item-actions text-nowrap">
                   <li class="list-inline-item email-edit" onclick="edit({{$Send->id}})"><i class="fa-regular fa-pen-to-square"></i></li>
                   <li class="list-inline-item email-delete" onclick="Delete({{$Send->id}})"><i class="ti ti-trash ti-sm"></i></li>
                   <li class="list-inline-item" onclick="SendM({{$Send->id}})"><i class="ti ti-send ti-sm"></i></li>
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
