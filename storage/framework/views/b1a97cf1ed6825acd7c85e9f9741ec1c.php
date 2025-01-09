<style>
.hover1:hover{
  z-index:3 !important;
}
</style>
 <div class="shadow-none border-0">
      <div class="emails-list-header p-3 py-lg-3 py-2">
        <!-- Email List: Search -->
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center w-100">
            <i
              class="ti ti-menu-2 ti-sm cursor-pointer d-block d-lg-none me-3"
              data-bs-toggle="sidebar"
              data-target="#app-email-sidebar"
              data-overlay></i>
            <div class="mb-0 mb-lg-2 w-100">
              <div class="input-group input-group-merge shadow-none">
                <span class="input-group-text border-0 ps-0" id="email-search">
                  <i class="ti ti-search"></i>
                </span>
                <form method="GET" action="">
                <input
                  type="text"
                  name="search"
                  class="form-control email-search-input border-0"
                  placeholder="Search mail"
                  aria-label="Search mail"
                  value=""
                  aria-describedby="email-search" />
                </form>
              </div>
            </div>
          </div>
          <div class="d-flex align-items-center mb-0 mb-md-2">
            <a href="<?php echo e(url('admin/MassMail/home')); ?>" class="ti ti-rotate-clockwise ti-sm rotate-180 scaleX-n1-rtl cursor-pointer email-refresh me-2"></a>
            <div class="dropdown d-flex align-self-center">
              <!-- <button
                class="btn p-0"
                type="button"
                id="emailsActions"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                <i class="ti ti-dots-vertical ti-sm"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="emailsActions">
                <a class="dropdown-item" href="javascript:void(0)">Mark as read</a>
                <a class="dropdown-item" href="javascript:void(0)">Mark as unread</a>
                <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                <a class="dropdown-item" href="javascript:void(0)">Archive</a>
              </div> -->
            </div>
          </div>
        </div>
        <hr class="mx-n3 emails-list-header-hr" />
        <!-- Email List: Actions -->
        <div class="d-flex justify-content-between align-items-center mb-2">
          <div class="d-flex align-items-center">
            <div class="form-check mb-0 me-2">
              <input class="form-check-input" type="checkbox" id="email-select-all" />
              <label class="form-check-label" for="email-select-all"></label>
            </div>
            <i class="ti ti-trash ti-sm email-list-delete cursor-pointer me-2"></i>
            <!-- <i class="ti ti-mail-opened ti-sm email-list-read cursor-pointer me-2"></i> -->
           <!--  <div class="dropdown me-2">
              <button
                class="btn p-0"
                type="button"
                id="dropdownMenuFolderOne"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                <i class="ti ti-folder ti-sm"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuFolderOne">
                <a class="dropdown-item" href="javascript:void(0)">
                  <i class="ti ti-info-circle ti-xs me-1"></i>
                  <span class="align-middle">Spam</span>
                </a>
                <a class="dropdown-item" href="javascript:void(0)">
                  <i class="ti ti-file ti-xs me-1"></i>
                  <span class="align-middle">Draft</span>
                </a>
                <a class="dropdown-item" href="javascript:void(0)">
                  <i class="ti ti-trash ti-xs me-1"></i>
                  <span class="align-middle">Trash</span>
                </a>
              </div>
            </div>
            <div class="dropdown">
              <button
                class="btn p-0"
                type="button"
                id="dropdownLabelOne"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                <i class="ti ti-tag ti-sm"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownLabelOne">
                <a class="dropdown-item" href="javascript:void(0)">
                  <i class="badge badge-dot bg-success me-1"></i>
                  <span class="align-middle">Workshop</span>
                </a>
                <a class="dropdown-item" href="javascript:void(0)">
                  <i class="badge badge-dot bg-primary me-1"></i>
                  <span class="align-middle">Company</span>
                </a>
                <a class="dropdown-item" href="javascript:void(0)">
                  <i class="badge badge-dot bg-info me-1"></i>
                  <span class="align-middle">Important</span>
                </a>
                <a class="dropdown-item" href="javascript:void(0)">
                  <i class="badge badge-dot bg-danger me-1"></i>
                  <span class="align-middle">Private</span>
                </a>
              </div>
            </div> -->
          </div>
          <div
            class="email-pagination d-sm-flex d-none align-items-center flex-wrap justify-content-between justify-sm-content-end">
            <i class="email-prev ti ti-chevron-left ti-sm scaleX-n1-rtl cursor-pointer text-muted me-2" onclick="LoadBack(this)" data-type="sent"></i>
            <span class="d-sm-block d-none mx-3 text-muted" id="sentCount">1</span>
            <i class="email-next ti ti-chevron-right ti-sm scaleX-n1-rtl cursor-pointer" onclick="LoadMore(this)" data-type="sent"></i>
          </div>
        </div>
      </div>
      <hr class="container-m-nx m-0" />
      <!-- Email List: Items -->
      <div class="email-list pt-0">
        <ul class="list-unstyled m-0">
          <?php if(count($SentMails) > 0): ?>
           <?php $__currentLoopData = $SentMails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $Send): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <li class="email-list-item " ondblclick="ViewEmail(<?php echo e($Send->id); ?>)">
             <div class="d-flex align-items-center">
               <div class="form-check mb-0">
                 <input class="email-list-item-input form-check-input Clicked" type="checkbox" data-id="<?php echo e($Send->id); ?>">
                 <label class="form-check-label" for=""></label>
               </div>
               <i class="email-list-item-bookmark ti ti-star ti-sm d-sm-inline-block d-none cursor-pointer ms-2 me-3 <?php if($Send && $Send->star == 1): ?> text-warning <?php endif; ?>" onclick="StarUpdate(<?php echo e($Send->id); ?>)"></i>
             <ul class="list-unstyled m-0 d-flex align-items-center avatar-group my-3">
          <?php $senduser =  \App\Models\User::whereIn('id', explode(',',$Send->to_id))->where('type',2)->get() ?>
            <?php $__currentLoopData = $senduser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $senduser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <?php
                                              if(isset($senduser->profile_img))
                                                  $url = $senduser->profile_img;
                                              else
                                                  $url = url('public/images/emp_proa4NN.jpg');
                                          ?>
                    <li data-bs-toggle="tooltip" data-bs-placement="top" class="avatar pull-up hover1" title="<?php echo e($senduser->first_name); ?>" style="padding:0px;">
                        <img class="rounded-circle" src="<?php echo e($url); ?>" alt="Avatar">
                    </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
                &nbsp;&nbsp;&nbsp;&nbsp;
               <div class="email-list-item-content ms-2 ms-sm-0 me-2">
                 <!-- <span class="h6 email-list-item-username me-2"><?php echo e($Send->first_name); ?></span> -->
                 <span class="email-list-item-subject d-xl-inline-block d-block me-2"><?php echo e($Send->subject); ?></span>
               </div>
               <div class="email-list-item-meta ms-auto d-flex align-items-center">
                 <span class="email-list-item-label badge badge-dot  <?php if($Send && $Send->status == '4'): ?> bg-danger <?php else: ?> bg-success <?php endif; ?>  d-md-inline-block me-2" data-label="important"></span>
                 <small class="email-list-item-time text-muted"><?php echo e($Send->created_at->format('g:i A')); ?></small>
                 <ul class="list-inline email-list-item-actions text-nowrap">
                   <li class="list-inline-item email-unread"><i class="ti ti-mail ti-sm"></i></li>
                   <li class="list-inline-item email-delete" onclick="Delete(<?php echo e($Send->id); ?>)"><i class="ti ti-trash ti-sm"></i></li>
                 </ul>
               </div>
             </div>
           </li>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           <?php else: ?>
           <li class="email-list-empty text-center">No items found.</li>
           <?php endif; ?>
        </ul>
      </div>
    </div>
    <div class="app-overlay"></div>
<script>
  $(document).ready(function () {
    $('[data-bs-toggle="tooltip"]').tooltip();
  });

var checkedValues = [];

$('#email-select-all').click(function () {
    $('.Clicked').prop('checked', $(this).prop('checked'));
    updateCheckedValues();
});


$('.email-list-delete').click(function () {

    var types = 'all';

    updateCheckedValues();
    if(checkedValues != ''){
     bootbox.confirm({
        message: "Are you sure?",
        buttons: {
            cancel: {
                label: '<i class="fa fa-times"></i> Cancel'
            },
            confirm: {
                label: '<i class="fa fa-check"></i> Trash'
            },
        },
        callback: function (result) {
            if (result) {
               $.ajax({
                url: "<?php echo e(url('admin/MassMail/Delete')); ?>",
                method: 'GET',
                data: { 
                  id: checkedValues,
                  types: types,
                 },
                success: function (data) {
                    location.reload();
                },
                error: function () {
                    $('.applist').html('<ul class="list-unstyled m-0"><li class="email-list-empty text-center">Tech. Error</li></ul>');
                }
            });    
            }
        }
      });
  }else{
    alert("Please Select the Mail");
  }

 
});
      

function updateCheckedValues() {
    // Clear the array before populating it with new values
    checkedValues = [];

    // Loop through checked checkboxes with class 'Clicked' and get their values
    $('.Clicked:checked').each(function () {
        var id = $(this).data('id');
        checkedValues.push(id);
    });
}



</script>  


<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/insighthub_db/resources/views/admin/sales/MassMail/SentMails.blade.php ENDPATH**/ ?>