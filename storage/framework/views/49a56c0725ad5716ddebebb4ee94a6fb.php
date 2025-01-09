
<?php $__env->startSection('title', 'MassMail'); ?>
<?php $__env->startSection('content'); ?>
<style>
.page-link{
   padding: 1px 5px 2px 6px;
    font-size: 15px;
}
.py-lg-3 {
    padding-top: 1rem !important;
    padding-bottom: 0rem !important;
}
.hover1:hover{
  z-index:3 !important;
}
.app-email .app-emails-list .email-list {
    height: calc(100vh - 19.5rem);
    overflow: auto;
}


.email-list.pt-0::-webkit-scrollbar{

  display:none !important;
}
.app-email .app-email-compose .ql-editor {
    min-height: 20rem !important;
    max-height: 22rem !important;
}

.enlarge1{
    
max-width:100vw !important;
max-height:100vh !important;
left:0 !important;
top:0;
padding:7px;
    
}
</style>
<div class="container-xxl flex-grow-1 container-p-y">
      <div id="toast-container" class="toast-top-right">
            <div class="toast toast-success" aria-live="polite">
              <div class="toast-progress" style="width: 0%;"></div>
              <div class="toast-message">
                <i class="fas fa-hand-peace"></i>  Copied to clipboard !
              </div>
            </div>
          </div>


    <?php if(Session::has('success')): ?>
    <div class="alert alert-success" role="alert"><?php echo e(Session::get('success')); ?></div>
    <?php endif; ?>
    <?php if(Session::has('error')): ?>
    <div class="alert alert-danger" role="alert"><?php echo e(Session::get('error')); ?></div>
    <?php endif; ?>
              <div class="app-email card">
                <div class="row g-0">
                  <!-- Email Sidebar -->
                  <div class="col app-email-sidebar border-end flex-grow-0" id="app-email-sidebar">
                    <div class="btn-compost-wrapper d-grid">
                      <button
                        class="btn btn-primary btn-compose"
                        data-bs-toggle="modal"
                        data-bs-target="#emailComposeSidebar"
                        id="emailComposeSidebarLabel">
                        Compose
                      </button>
                    </div>
                    <!-- Email Filters -->
                    <div class="email-filters py-2">
                      <!-- Email Filters: Folder -->
                      <ul class="email-filter-folders list-unstyled mb-4">
                       <!--  <li class=" d-flex justify-content-between" data-target="inbox">
                          <a href="javascript:void(0);" class="d-flex flex-wrap align-items-center">
                            <i class="ti ti-mail ti-sm"></i>
                            <span class="align-middle ms-2">Inbox</span>
                          </a>
                        </li> -->
                        <?php use Illuminate\Support\Facades\Session; ?>
                        <li class="<?php if(session('tab') == 'sent'): ?> active <?php endif; ?> d-flex justify-content-between" onclick="Sent(<?php echo e(Auth::user()->id); ?>)" data-target="sent">
                          <a href="javascript:void(0);" class="d-flex flex-wrap align-items-center">
                            <i class="ti ti-send ti-sm"></i>
                            <span class="align-middle ms-2">Sent</span>
                          </a>
                          <div class="badge bg-label-success rounded-pill badge-center"><?php echo e($Sent); ?></div>
                        </li>
                        <li class="<?php if(session('tab') == 'draft'): ?> active <?php endif; ?> d-flex justify-content-between" data-target="draft" onclick="DraftMails(<?php echo e(Auth::user()->id); ?>)">
                          <a href="javascript:void(0);" class="d-flex flex-wrap align-items-center">
                            <i class="ti ti-file ti-sm"></i>
                            <span class="align-middle ms-2">Draft</span>
                          </a>
                          <div class="badge bg-label-primary rounded-pill badge-center"><?php echo e($Draft); ?></div>
                        </li>
                        <li class="<?php if(session('tab') == 'star'): ?> active <?php endif; ?> d-flex justify-content-between" data-target="starred" onclick="StarMails(<?php echo e(Auth::user()->id); ?>)">
                          <a href="javascript:void(0);" class="d-flex flex-wrap align-items-center">
                            <i class="ti ti-star ti-sm"></i>
                            <span class="align-middle ms-2">Starred</span>
                          </a>
                          <div class="badge bg-label-warning rounded-pill badge-center"><?php echo e($Star); ?></div>
                        </li>
                       <!--  <li class="d-flex align-items-center" data-target="spam">
                          <a href="javascript:void(0);" class="d-flex flex-wrap align-items-center">
                            <i class="ti ti-info-circle ti-sm"></i>
                            <span class="align-middle ms-2">Spam</span>
                          </a>
                        </li> -->
                        <li class="<?php if(session('tab') == 'trash'): ?> active <?php endif; ?> d-flex justify-content-between" data-target="trash"  onclick="Trash(<?php echo e(Auth::user()->id); ?>)">
                          <a href="javascript:void(0);" class="d-flex flex-wrap align-items-center">
                            <i class="ti ti-trash ti-sm"></i>
                            <span class="align-middle ms-2">Trash</span>
                          </a>
                          <div class="badge bg-label-danger rounded-pill badge-center"><?php echo e($Trash); ?></div>
                        </li>
                        <li class="<?php if(session('tab') == 'schedule'): ?> active <?php endif; ?> d-flex justify-content-between" data-target="schedule"  onclick="Schedule(<?php echo e(Auth::user()->id); ?>)">
                          <a href="javascript:void(0);" class="d-flex flex-wrap align-items-center">
                            <i class="ti ti-clock ti-sm"></i>
                            <span class="align-middle ms-2">Schedule</span>
                          </a>
                          <div class="badge bg-label-info rounded-pill badge-center"><?php echo e($schedule); ?></div>
                        </li>
                      </ul>
                      <!-- Email Filters: Labels -->
                      <div class="email-filter-labels">
                        <small class="fw-normal text-uppercase text-muted m-4">Labels</small>
                        <ul class="list-unstyled mb-0 mt-2">
                          <li data-target="work">
                            <a href="javascript:void(0);">
                              <span class="badge badge-dot bg-success"></span>
                              <span class="align-middle ms-2">Pass</span>
                            </a>
                          </li>
                          <li data-target="company">
                            <a href="javascript:void(0);">
                              <span class="badge badge-dot bg-danger"></span>
                              <span class="align-middle ms-2">Fail</span>
                            </a>
                          </li>
                          <li data-target="important">
                            <a href="javascript:void(0);">
                              <span class="badge badge-dot bg-info"></span>
                              <span class="align-middle ms-2">Pending</span>
                            </a>
                          </li>
                          <li data-target="private">
                            <a href="javascript:void(0);">
                              <span class="badge badge-dot bg-primary"></span>
                              <span class="align-middle ms-2">Draft</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                      <!--/ Email Filters -->
                    </div>
                  </div>
                  <!--/ Email Sidebar -->

                  <!-- Emails List -->
                  <div class="col app-emails-list applist">
                    <div class="shadow-none border-0">
                      <div class="emails-list-header p-3 py-3 py-2">
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
                                  value="<?php echo e($query); ?>"
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
                          <?php if(count($MassMail)  > 0): ?> 
                        <hr class="mx-n3 emails-list-header-hr" />
                        <!-- Email List: Actions -->

                        <div class="d-flex justify-content-between align-items-center">
                        
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
                              <?php echo e($MassMail->links()); ?>

                           <!--  <span class="d-sm-block d-none mx-3 text-muted">1-10 of 653</span>
                            <i
                              class="email-prev ti ti-chevron-left ti-sm scaleX-n1-rtl cursor-pointer text-muted me-2"></i>
                            <i class="email-next ti ti-chevron-right ti-sm scaleX-n1-rtl cursor-pointer"></i> -->
                          </div>
                        </div>
                        <?php endif; ?>
                      </div>
                      <hr class="container-m-nx m-0" />
                      <!-- Email List: Items -->
                      <div class="email-list pt-0">
                        <ul class="list-unstyled m-0">
                          <?php if(count($MassMail)  > 0): ?>
                             <?php $__currentLoopData = $MassMail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $Mass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <li class="email-list-item " ondblclick="ViewEmail(<?php echo e($Mass->id); ?>)">
                               <div class="d-flex align-items-center">
                                 <div class="form-check mb-0">
                                   <input class="email-list-item-input form-check-input" type="checkbox" id="email-<?php echo e($key+1); ?>">
                                   <label class="form-check-label" for="email-<?php echo e($key+1); ?>"></label>
                                 </div>
                                 <i class="email-list-item-bookmark ti ti-star ti-sm d-sm-inline-block d-none cursor-pointer ms-2 me-3 <?php if($Mass && $Mass->star == 1): ?> text-warning <?php endif; ?>" onclick="StarUpdate(<?php echo e($Mass->id); ?>)"></i>
                                 <ul class="list-unstyled m-0 d-flex align-items-center avatar-group my-3">
                                        <?php
                                            $senduser = \App\Models\User::whereIn('id', explode(',', $Mass->to_id))->where('type', 2)->get();
                                        ?>
                                        <?php $__currentLoopData = $senduser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $url = $user->profile_img ? $user->profile_img : url('public/images/emp_proa4NN.jpg');
                                            ?>
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" class="avatar pull-up hover1" title="<?php echo e($user->first_name); ?>" style="padding:0px;">
                                                <img class="rounded-circle" src="<?php echo e($url); ?>" alt="Avatar">
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                  &nbsp;&nbsp;&nbsp;&nbsp;
                                 <div class="email-list-item-content ms-2 ms-sm-0 me-2">
                                   <!-- <span class="h6 email-list-item-username me-2"><?php echo e($Mass->first_name); ?></span> -->
                                   <span class="email-list-item-subject d-xl-inline-block d-block me-2"><?php echo e($Mass->subject); ?></span>
                                 </div>
                                 <div class="email-list-item-meta ms-auto d-flex align-items-center">
                                   <span class="email-list-item-label badge badge-dot <?php if($Mass && $Mass->status == '4'): ?> bg-danger <?php else: ?> bg-success <?php endif; ?> d-none d-md-inline-block me-2" data-label="important"></span>
                                   <small class="email-list-item-time text-muted"><?php echo e($Mass->created_at->format('g:i A')); ?></small>
                                   <ul class="list-inline email-list-item-actions text-nowrap">
                                     <li class="list-inline-item email-unread"><i class="ti ti-mail ti-sm"></i></li>
                                     <li class="list-inline-item email-delete" onclick="Delete(<?php echo e($Mass->id); ?>)"><i class="ti ti-trash ti-sm"></i></li>
                                   </ul>
                                 </div>
                               </div>
                             </li>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             <?php else: ?>
                             <ul class="list-unstyled m-0"><li class="email-list-empty text-center">No items found.</li></ul>
                             <?php endif; ?>
                          </ul>
                      </div>
                    </div>
                    <div class="app-overlay"></div>
                  </div>
                  <!-- /Emails List -->

                  <!-- Email View -->
                  <div class="col app-email-view flex-grow-0 bg-body" id="app-email-view">
                    
                  </div>
                  <!-- Email View -->
                </div>

                <!-- Compose Email -->
                <div
                  class="app-email-compose modal"
                  id="emailComposeSidebar"
                  tabindex="-1"
                  aria-labelledby="emailComposeSidebarLabel"
                  aria-hidden="true">
                  <div class="modal-dialog m-0 me-md-4 mb-4 modal-lg">
                    <div class="modal-content p-0">
                      <div class="modal-header py-3 bg-body">
                        <h5 class="modal-title fs-5">Compose Mail</h5>
                        <button type="button" class="enlarge" id="btnbig" style="background-color: red; color: white;border: none;border-radius: 5px;}">Enlarge</button>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body flex-grow-1 pb-sm-0 p-4 py-2">
                        <form class="email-compose-form" action="<?php echo e(url('admin/MassMail/store')); ?>" method="POST">
                          <?php echo csrf_field(); ?>
                          <input type="hidden" name="id" id="idget">
                          <div class="email-compose-to d-flex justify-content-between align-items-center">
                                <label class="form-label mb-0" for="emailContacts">To:</label>
                                <div class="select2-primary border-0 shadow-none flex-grow-1 mx-2">
                                   <select class="select2 select-email-contacts form-select CallImage" id="emailContacts" name="to_id[]" multiple required>
                                      <option data-avatar="<?php echo e(url('public/logo/check.png')); ?>" value="0">Select All</option>
                                      <?php $__currentLoopData = $Client; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <?php
                                              if(isset($client->profile_img))
                                                  $url = $client->profile_img;
                                              else
                                                  $url = url('public/images/emp_proa4NN.jpg');
                                          ?>
                                          <option data-avatar="<?php echo e($url); ?>" value="<?php echo e($client->id); ?>"><?php echo e($client->first_name); ?>-(<?php echo e($client->id); ?>)</option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </select>

                                </div>
                            </div>

                             <!--  <div class="email-compose-toggle-wrapper">
                                  <a class="email-compose-toggle-cc" href="javascript:void(0);">Cc |</a>
                                  <a class="email-compose-toggle-bcc" href="javascript:void(0);">Bcc</a>
                              </div> -->

                          <!-- <div class="email-compose-cc d-none">
                            <hr class="container-m-nx my-2" />
                            <div class="d-flex align-items-center">
                              <label for="email-cc" class="form-label mb-0">Cc: </label>
                              <input
                                type="text"
                                class="form-control border-0 shadow-none flex-grow-1 mx-2"
                                id="email-cc"
                                placeholder="someone@email.com" />
                            </div>
                          </div>
                          <div class="email-compose-bcc d-none">
                            <hr class="container-m-nx my-2" />
                            <div class="d-flex align-items-center">
                              <label for="email-bcc" class="form-label mb-0">Bcc: </label>
                              <input
                                type="text"
                                class="form-control border-0 shadow-none flex-grow-1 mx-2"
                                id="email-bcc"
                                placeholder="someone@email.com" />
                            </div>
                          </div> -->
                          <hr class="container-m-nx my-2" />
                          <div class="email-compose-subject d-flex align-items-center mb-2">
                            <label for="email-subject" class="form-label mb-0">Subject:</label>
                            <input
                              type="text"
                              class="form-control border-0 shadow-none flex-grow-1 mx-2"
                              id="email-subject"
                              name="subject"
                              required
                              placeholder="Project Details" />
                          </div>
                          <hr class="container-m-nx my-2" />
                          <div class="email-compose-to d-flex justify-content-between align-items-center">
                              <label class="form-label mb-0" for="emailContacts">Header / Footer :</label>
                              <div class="select2-primary border-0 shadow-none flex-grow-1 mx-2">
                                  <select class="select2 select-email-contacts form-select" name="headfoot_id"  id="HeadFoot"   required>
                                      <?php $__currentLoopData = $Template; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Temp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                        <option value="<?php echo e($Temp->id); ?>" ><?php echo e($Temp->name); ?></option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </select>
                              </div> 
                          </div>
                          <div class="email-compose-message container-m-nx">
                            <div class="d-flex justify-content-end">
                              <div class="email-editor-toolbar border-bottom-0 w-100">
                                <span class="ql-formats me-0">
                                  <button class="ql-bold"></button>
                                  <button class="ql-italic"></button>
                                  <button class="ql-underline"></button>
                                  <button class="ql-list" value="ordered"></button>
                                  <button class="ql-list" value="bullet"></button>
                                  <button class="ql-link"></button>
                                  <button class="ql-image"></button>
                                </span>
                              </div>
                            </div>
                            <div class="email-editor" id="description" contenteditable="true"></div>
                            <input type="hidden" name="description" class="hidden-field">
                          </div>
                          <hr class="container-m-nx mt-0 mb-2" />
                          <div
                            class="email-compose-actions d-flex justify-content-between align-items-center mt-3 mb-3">
                             <div class="d-flex align-items-center">
                                <div class="btn-group">
                                  <button type="button" class="btn btn-primary" id="previewBtn">
                                      Preview
                                    </button>
                                    <button type="submit" id="send" name="send" value="public" class="btn btn-primary" style="display: none!important;">
                                        <i class="ti ti-send ti-xs me-1"></i>Send
                                    </button>
                                    
                                    <button
                                        type="button"
                                        class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                        data-bs-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                        <span class="visually-hidden">Send Options</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><button type="button" class="dropdown-item"><input class="form-control" name="schedule_date" type="datetime-local" id="html5-datetime-local-input"></button></li>
                                        <li><button class="dropdown-item" id="scheduledate" type="submit" name="Schedule" value="date" disabled>Send As Schedule</button></li>
                                        <li><button class="dropdown-item" id="savedraft" type="submit" name="save_draft" value="draft">Save draft</button></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                              <div class="dropdown">
                                <button
                                  class="btn p-0"
                                  type="button"
                                  id="dropdownMoreActions"
                                  data-bs-toggle="dropdown"
                                  aria-haspopup="true"
                                  aria-expanded="false">
                                  <i class="ti ti-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMoreActions">
                                  <li><button type="button" class="dropdown-item" onclick="copy(value)" value="<?php echo e($Name); ?>"><?php echo e($Name); ?> <i class="fa-solid fa-copy"></i></button></li>
                                  <li><button type="button" class="dropdown-item" onclick="copy(value)" value="<?php echo e($Email); ?>"><?php echo e($Email); ?> <i class="fa-solid fa-copy"></i></button></li>
                                </ul>
                              </div>
                              <button type="reset" class="btn" data-bs-dismiss="modal" aria-label="Close">
                                <i class="ti ti-trash"></i>
                              </button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /Compose Email -->
              </div>
            </div>


                <div
                  class="modal"
                  id="previewModal"
                  tabindex="-1"
                  aria-labelledby="previewModalLabel"
                  aria-hidden="true" style="padding-left: 0px;justify-content: center;margin-top: 25px;position: absolute;width: 100%;right: 150px;">
                  <div class="modal-dialog m-0 me-md-4 mb-4 modal-lg" style="
    position: relative;
    left: 22%;
    top: 0px;
    margin-top:15px !important;
">
                    <div class="modal-content p-0">
                      <div class="modal-header py-3 bg-body">
                        <h5 class="modal-title fs-5">Preview</h5>
                        <button type="button" class="enlarge" id="btnbig" style="background-color: red; color: white;border: none;border-radius: 5px;}">Enlarge</button>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body flex-grow-1 pb-sm-0 p-4 py-2" id="previewContent">
                      </div>
                      <div class="modal-footer">
                        <!-- Send button in the modal -->
                        <button type="button" class="btn btn-primary" id="sendFromPreview">
                          <i class="ti ti-send ti-xs me-1"></i>Send
                        </button>
                      </div>
                    </div>
                  </div>
                </div>


<script>

  // Handle form submission and send action
    $("#sendFromPreview").click(function () {
      // Trigger click on the hidden "Send" button
      $("#send").click();
    });


  $(document).ready(function () {
    var header = ""; // Store header template
    var footer = ""; // Store footer template

    // Fetch header and footer templates
    function fetchTemplates(templateId) {
      $.get("<?php echo e(url('admin/get-template')); ?>/" + templateId, function (data) {
        header = data.template;
        footer = data.template2;
        updatePreview();
      });
    }

    // Handle form input changes
    $(".email-compose-form").on("input", function () {
      updatePreview();
    });

    // Function to update the preview content
    function updatePreview() {
      // Get form values
      var to = $("#emailContacts option:selected").text();
      var subject = $("#email-subject").val();
      var headFoot = $("#HeadFoot option:selected").text();
      var description = $("#description").html();

      // Build preview HTML
      var previewHTML = "<p><strong>To:</strong> " + to + "</p>";
      previewHTML += "<p><strong>Subject:</strong> " + subject + "</p>";
      previewHTML += "<div>" + header + "</div>";
      previewHTML += "<div>" + description + "</div>";
      previewHTML += "<div>" + footer + "</div>";

      // Update preview content
      $("#previewContent").html(previewHTML);
    }

    // Show preview modal
    $("#previewBtn").click(function () {
      var templateId = $("#HeadFoot").val();
      fetchTemplates(templateId);
      $("#previewModal").modal('show');
    });
  });
</script>

   <?php if(session('tab')): ?>
    <script>
        window.onload = function() {
            if("<?php echo e(session('tab')); ?>" == 'draft') {
                DraftMails(<?php echo e(Auth::user()->id); ?>);
            }

            if("<?php echo e(session('tab')); ?>" == 'star') {
                StarMails(<?php echo e(Auth::user()->id); ?>);
            }

            if("<?php echo e(session('tab')); ?>" == 'trash') {
                Trash(<?php echo e(Auth::user()->id); ?>);
            }

            if("<?php echo e(session('tab')); ?>" == 'schedule') {
                Schedule(<?php echo e(Auth::user()->id); ?>);
            }

            if("<?php echo e(session('tab')); ?>" == 'sent') {
                Sent(<?php echo e(Auth::user()->id); ?>);
            }
        }
    </script>
<?php endif; ?>

<script>
    $(document).ready(function () {

        // initSelect2();

        $('#emailContacts').select2();

        // Handle the "Select All" option
        $('#emailContacts').on('change', function () {
            if ($(this).val() != null && $(this).val().includes('0')) {
                // If "Select All" is selected, set all other options as selected
                $(this).val($.map($(this).find('option:not(:first)'), function (option) {
                    return option.value;
                }));
            }
        });
    });
</script>

<!-- <option data-avatar="<?php echo e(url('public/logo/remove.png')); ?> "value="removeall">Remove All</option> -->
<script>


 var datetimeInput = $('#html5-datetime-local-input');
    var scheduleButton = $('#scheduledate');
    var sendButton = $('#send');
    var saveDraftButton = $('#savedraft');

    datetimeInput.on('input', function () {
      var selectedDate = new Date(datetimeInput.val());
      var minDate = new Date('2023-01-01T00:00');

      if (selectedDate > minDate) {
        scheduleButton.prop('disabled', false);
        sendButton.prop('disabled', true);
        saveDraftButton.prop('disabled', true);
      } else {
        scheduleButton.prop('disabled', true);
        sendButton.prop('disabled', false);
        saveDraftButton.prop('disabled', false);
      }
    });


    function updateHiddenField(index) {
      var editorContentText = $(".email-editor").eq(index).html();
      $('.hidden-field').eq(index).val(editorContentText);
    }
    $(document).on('keyup blur', '.email-editor', function () {
      var index = $(".email-editor").index(this);
      updateHiddenField(index); // Call the function to update the hidden field
    });


  function Sent(user_id){
     $.ajax({
                url: "<?php echo e(url('admin/MassMail/SentMails')); ?>",
                method: 'GET',
                data: { user_id: user_id },
                success: function (data) {
                    $('.applist').empty(); // Clear previous content

                    if (data.length > 0) {
                        $('.applist').html(data);
                    } else {
                        $('.applist').html('<ul class="list-unstyled m-0"><li class="email-list-empty text-center">No items found.</li></ul>');
                    }
                },
                error: function () {
                    $('.applist').html('<ul class="list-unstyled m-0"><li class="email-list-empty text-center">Tech. Error</li></ul>');
                }
            });
  }

   function edit(id){
     $.ajax({
                url: "<?php echo e(url('admin/MassMail/Edit')); ?>",
                method: 'GET',
                data: { id: id },
                success: function (data) {
                    if (data.success) {
                      $('#html5-datetime-local-input').val(data.data.schedule_date);
                      $('#email-subject').val(data.data.subject);
                      var toIdArray = data.data.to_id.split(',').map(function(item) {
                          return parseInt(item, 10);
                      });
                      $('#emailContacts').select2().val(toIdArray).trigger('change');
                      $('#HeadFoot').val(data.data.headfoot_id).trigger('change');
                      $('#description').html(data.data.description);
                      $('input[name="description"]').val(data.data.description);
                      $('#idget').val(data.data.id);
                      $('#send').text("Send");
                      $('#scheduledate').text("Update As Schedule");
                      $('#savedraft').text("Update Draft");
                      $('#emailComposeSidebar').modal('show');
                    } 
                },
                error: function () {
                   alert("Error");
                }
            });
  }
   function ViewEmail(id) {
 $.ajax({
                url: "<?php echo e(url('admin/MassMail/Show')); ?>",
                method: 'GET',
                data: { id: id },
                success: function (data) {
                    if (data.length > 0) {
                        $('.email-list').html(data);
                    } else {
                        $('.email-list').html('<ul class="list-unstyled m-0"><li class="email-list-empty text-center">No items found.</li></ul>');
                    }
                },
                error: function () {
                    $('.email-list').html('<ul class="list-unstyled m-0"><li class="email-list-empty text-center">Tech. Error</li></ul>');
                }
            });
    }

      function DraftMails(id) {
 $.ajax({
                url: "<?php echo e(url('admin/MassMail/DraftMails')); ?>",
                method: 'GET',
                data: { id: id },
                success: function (data) {
                    if (data.length > 0) {
                        $('.applist').html(data);
                    } else {
                        $('.applist').html('<ul class="list-unstyled m-0"><li class="email-list-empty text-center ">No items found.</li></ul>');
                    }
                },
                error: function () {
                    $('.applist').html('<ul class="list-unstyled m-0"><li class="email-list-empty text-center ">Tech. Error</li></ul>');
                }
            });
    }

    function Schedule(id) {
              $.ajax({
                url: "<?php echo e(url('admin/MassMail/Schedule')); ?>",
                method: 'GET',
                data: { id: id },
                success: function (data) {
                    if (data.length > 0) {
                        $('.applist').html(data);
                    } else {
                        $('.applist').html('<ul class="list-unstyled m-0"><li class="email-list-empty text-center ">No items found.</li></ul>');
                    }
                },
                error: function () {
                    $('.applist').html('<ul class="list-unstyled m-0"><li class="email-list-empty text-center ">Tech. Error</li></ul>');
                }
            });
    }

    function StarMails(id) {
 $.ajax({
                url: "<?php echo e(url('admin/MassMail/StarMails')); ?>",
                method: 'GET',
                data: { id: id },
                success: function (data) {
                    if (data.length > 0) {
                        $('.applist').html(data);
                    } else {
                        $('.applist').html('<ul class="list-unstyled m-0"><li class="email-list-empty text-center ">No items found.</li></ul>');
                    }
                },
                error: function () {
                    $('.applist').html('<ul class="list-unstyled m-0"><li class="email-list-empty text-center ">Tech. Error</li></ul>');
                }
            });
    }

    function StarUpdate(id) {
        $.ajax({
          url: "<?php echo e(url('admin/MassMail/StarUpdate')); ?>",
          method: 'GET',
          data: { id: id },
          success: function () {
               location.reload();
          },
          error: function () {
              $('.app-email').html('<ul class="list-unstyled m-0"><li class="email-list-empty text-center ">Tech. Error</li></ul>');
          }
      });
    }

     function SendM(id) {
        bootbox.confirm({
          message: "Are you sure?",
          buttons: {
              cancel: {
                  label: '<i class="fa fa-times"></i> Cancel'
              },
              confirm: {
                  label: '<i class="fa fa-check"></i> Send'
              },
          },
          callback: function (result) {
              if (result) {
                   $.ajax({
                    url: "<?php echo e(url('admin/MassMail/SendM')); ?>",
                    method: 'GET',
                    data: { id: id },
                    success: function () {
                         location.reload();
                    },
                    error: function () {
                        $('.email-list').html('<ul class="list-unstyled m-0"><li class="email-list-empty text-center">Tech. Error</li></ul>');
                    }
                });         
              }
          }
        });
    }

     function Delete(id) {
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
                    data: { id: id },
                    success: function () {
                         location.reload();
                    },
                    error: function () {
                        $('.applist').html('<ul class="list-unstyled m-0"><li class="email-list-empty text-center">Tech. Error</li></ul>');
                    }
                });         
              }
          }
        });
    }

    function Restore(id) {

      bootbox.confirm({
        message: "Are you sure?",
        buttons: {
            cancel: {
                label: '<i class="fa fa-times"></i> Cancel'
            },
            confirm: {
                label: '<i class="fa fa-check"></i> Restore'
            },
        },
        callback: function (result) {
            if (result) {
               $.ajax({
                  url: "<?php echo e(url('admin/MassMail/Restore')); ?>",
                  method: 'GET',
                  data: { id: id },
                  success: function () {
                       location.reload();
                  },
                  error: function () {
                      $('.email-list').html('<ul class="list-unstyled m-0"><li class="email-list-empty text-center">Tech. Error</li></ul>');
                  }
              });
            }
        }
      });
    }
    function ForceDelete(id) {
      bootbox.confirm({
        message: "Are you sure?",
        buttons: {
            cancel: {
                label: '<i class="fa fa-times"></i> Cancel'
            },
            confirm: {
                label: '<i class="fa fa-check"></i> Delete'
            },
        },
        callback: function (result) {
            if (result) {
              $.ajax({
                url: "<?php echo e(url('admin/MassMail/ForceDelete')); ?>",
                method: 'GET',
                data: { id: id },
                success: function () {
                     location.reload();
                },
                error: function () {
                    $('.email-list').html('<ul class="list-unstyled m-0"><li class="email-list-empty text-center">Tech. Error</li></ul>');
                }
            });
         }
        }
      });
    }

   function Trash(id) {
          $.ajax({
                url: "<?php echo e(url('admin/MassMail/Trash')); ?>",
                method: 'GET',
                data: { id: id },
                success: function (data) {
                    if (data.length > 0) {
                        $('.applist').html(data);
                    } else {
                        $('.applist').html('<ul class="list-unstyled m-0"><li class="email-list-empty text-center">No items found.</li></ul>');
                    }
                },
                error: function () {
                    $('.applist').html('<ul class="list-unstyled m-0"><li class="email-list-empty text-center">Tech. Error</li></ul>');
                }
            });
    }
var pageCount = {
    draft: 1,
    star: 1,
    trash: 1,
    schedule: 1,
    sent: 1
};

function LoadMore(button) {
    var type = $(button).data('type');
    pageCount[type]++;
    var page = pageCount[type];

    $.ajax({
        type: "get",
        data: { type: type },
        url: "<?php echo e(url('admin/MassMail/LoadMore')); ?>?page=" + page,
        success: function (data) {
            if (data != '') {
                $('.email-list').html(data);
                updateCountDisplay(type);
            } else {
                var data1 = "Data not found";
                $('.list-unstyled').html(data1);
            }
        }
    });
}

function LoadBack(button) {
    var type = $(button).data('type');

    // If the page is greater than 1, decrement it and load the previous page
    if (pageCount[type] > 1) {
        pageCount[type]--; // Decrement the page count before making the AJAX call
        var page = pageCount[type];

        $.ajax({
            type: "get",
            data: { type: type },
            url: "<?php echo e(url('admin/MassMail/LoadMore')); ?>?page=" + page,
            success: function (data) {
                if (data != '') {
                    $('.email-list').html(data);
                    updateCountDisplay(type);
                } else {
                    var data1 = "Data not found";
                    $('.list-unstyled').html(data1);
                }
            }
        });
    }
}

function updateCountDisplay(type) {
    // Update the count display for the corresponding type
    if (type === 'draft') {
        $('#draftCount').text(pageCount[type]);
    } else if (type === 'star') {
        $('#starCount').text(pageCount[type]);
    } else if (type === 'trash') {
        $('#trashCount').text(pageCount[type]);
    } else if (type === 'schedule') {
        $('#scheduleCount').text(pageCount[type]);
    } else if (type === 'sent') {
        $('#sentCount').text(pageCount[type]);
    }
}

function copy(value) {
    navigator.clipboard.writeText(value)
        .then(() => {
            showToast('Copied: ' + value);
        })
        .catch(err => {
            console.error('Unable to copy to clipboard', err);
        });
}

function showToast(message) {
    var toastElement = document.querySelector('.toast');
    var progressBar = toastElement.querySelector('.toast-progress');

    if (toastElement) {
        toastElement.classList.add('show');
        var duration = 1000; // 5000 milliseconds = 5 seconds
        var interval = 50;  // Update the progress every 50 milliseconds
        var increment = (interval / duration) * 100;
        var progress = 0;

        var progressBarAnimation = setInterval(function () {
            progress += increment;
            progressBar.style.width = progress + '%';

            if (progress >= 100) {
                clearInterval(progressBarAnimation);
                setTimeout(function () {
                    toastElement.classList.remove('show');
                }, interval);
            }
        }, interval);

        // Update the toast message content
        var toastMessage = toastElement.querySelector('.toast-message');
        if (toastMessage) {
            toastMessage.innerHTML = '<i class="fas fa-hand-peace"></i> ' + message;
        }
    }
}
</script>
<script>
    // Wait for the document to be ready
    $(document).ready(function() {
      // Attach a click event handler to the triggering element (replace "triggerElementId" with the actual ID)
      $("#btnbig").click(function() {
        // Select the target element by its ID (replace "targetElementId" with the actual ID)
        var targetElement = $(".modal-dialog");

        // Add the desired class to the target element (replace "yourClassName" with the actual class name)
        targetElement.toggleClass("enlarge1");
        var buttonText = targetElement.hasClass("enlarge1") ? "Shrink" : "Enlarge";
        $(this).text(buttonText);
        var buttonColor = targetElement.hasClass("enlarge1") ? "green" : "red";
        $(this).css("background-color", buttonColor);
      });
    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/sales/MassMail/home.blade.php ENDPATH**/ ?>