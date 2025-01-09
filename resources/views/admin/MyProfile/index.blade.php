@extends('layouts.admin')
@section('title', 'My Profile')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
   <!-- Content -->
   <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-3 mb-4"><span class="text-muted fw-light">User Profile /</span> Profile</h4>
      <!-- Header -->
      <div class="row">
         <div class="col-12">
            <div class="card mb-4">
               <div class="user-profile-header-banner">
                  <img height="248" @if($user->banner) src="{{ $user->banner }}" @else src="https://demos.pixinvent.com/vuexy-html-admin-template/assets/img/pages/profile-banner.png" @endif alt="Banner image" class="rounded-top" style="    width: 100%;" />
               </div>
               <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                  <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                     <img
                     @if($user->profile_img)
                     src="{{$user->profile_img}}"
                     @else
                     src="https://demos.pixinvent.com/vuexy-html-admin-template/assets/img/avatars/14.png"
                     alt="user image"
                     @endif
                     class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" style="width:100px; " />
                  </div>
                  <div class="flex-grow-1 mt-3 mt-sm-5">
                     <div
                        class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                        <div class="user-profile-info">
                           <h4>{{$user->first_name}}</h4>
                           <!-- <ul
                              class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                              <li class="list-inline-item d-flex gap-1">
                                <i class="ti ti-color-swatch"></i> UX Designer
                              </li>
                              <li class="list-inline-item d-flex gap-1"><i class="ti ti-map-pin"></i> Vatican City</li>
                              <li class="list-inline-item d-flex gap-1">
                                <i class="ti ti-calendar"></i> Joined April 2021
                              </li>
                              </ul> -->
                        </div>
                        <a href="javascript:void(0)" class="btn btn-primary edit-profile me-3 waves-effect waves-light">
                        <i class="ti ti-pencil me-1"></i>Edit
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--/ Header -->
      <!-- Navbar pills -->
      <!-- <div class="row">
         <div class="col-md-12">
           <ul class="nav nav-pills flex-column flex-sm-row mb-4">
             <li class="nav-item">
               <a class="nav-link active" href="javascript:void(0);"
                 ><i class="ti-xs ti ti-user-check me-1"></i> Profile</a
               >
             </li>
             <li class="nav-item">
               <a class="nav-link" href="pages-profile-teams.html"
                 ><i class="ti-xs ti ti-users me-1"></i> Teams</a
               >
             </li>
             <li class="nav-item">
               <a class="nav-link" href="pages-profile-projects.html"
                 ><i class="ti-xs ti ti-layout-grid me-1"></i> Projects</a
               >
             </li>
             <li class="nav-item">
               <a class="nav-link" href="pages-profile-connections.html"
                 ><i class="ti-xs ti ti-link me-1"></i> Connections</a
               >
             </li>
           </ul>
         </div>
         </div> -->
      <!--/ Navbar pills -->
      <!-- User Profile Content -->
      <div class="row">
         <div class="col-xl-12 col-lg-5 col-md-5">
            <!-- About User -->
            <div class="card mb-4">
               <div class="card-body row">
                  <div class="col-xl-6">
                     <small class="card-text text-uppercase">About</small>
                     <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3">
                           <i class="ti ti-user text-heading"></i
                              ><span class="fw-medium mx-2 text-heading">Full Name:</span> <span>{{$user->first_name}}</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                           <i class="ti ti-check text-heading"></i
                              ><span class="fw-medium mx-2 text-heading">Status:</span> <span>Active</span>
                        </li>
                        <!-- <li class="d-flex align-items-center mb-3">
                           <i class="ti ti-crown text-heading"></i
                           ><span class="fw-medium mx-2 text-heading">Role:</span> <span>Developer</span>
                           </li> -->
                        <li class="d-flex align-items-center mb-3">
                           <i class="ti ti-flag text-heading"></i
                              ><span class="fw-medium mx-2 text-heading">Country:</span> <span>India</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                           <i class="ti ti-file-description text-heading"></i
                              ><span class="fw-medium mx-2 text-heading">Languages:</span> <span>English</span>
                        </li>
                     </ul>
                  </div>
                  <div class="col-xl-6">
                     <small class="card-text text-uppercase">Contacts</small>
                     <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3">
                           <i class="ti ti-phone-call"></i><span class="fw-medium mx-2 text-heading">Contact:</span>
                           <span>{{$user->phone_number}}</span>
                        </li>
                        <!-- <li class="d-flex align-items-center mb-3">
                           <i class="ti ti-brand-skype"></i><span class="fw-medium mx-2 text-heading">Skype:</span>
                           <span>john.doe</span>
                           </li> -->
                        <li class="d-flex align-items-center mb-3">
                           <i class="ti ti-mail"></i><span class="fw-medium mx-2 text-heading">Email:</span>
                           <span>{{$user->email}}</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                           <i class="ti ti-home"></i><span class="fw-medium mx-2 text-heading">Address:</span>
                           <span>{{$user->address}}</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                           <i class="ti ti-file-description"></i><span class="fw-medium mx-2 text-heading">About:</span>
                           <span>{{$user->about}}</span>
                        </li>
                     </ul>
                  </div>
                  <!-- <small class="card-text text-uppercase">Teams</small>
                     <ul class="list-unstyled mb-0 mt-3">
                       <li class="d-flex align-items-center mb-3">
                         <i class="ti ti-brand-angular text-danger me-2"></i>
                         <div class="d-flex flex-wrap">
                           <span class="fw-medium me-2 text-heading">Backend Developer</span><span>(126 Members)</span>
                         </div>
                       </li>
                       <li class="d-flex align-items-center">
                         <i class="ti ti-brand-react-native text-info me-2"></i>
                         <div class="d-flex flex-wrap">
                           <span class="fw-medium me-2 text-heading">React Developer</span><span>(98 Members)</span>
                         </div>
                       </li>
                     </ul> -->
               </div>
            </div>
            <!--/ About User -->
            <!-- Profile Overview -->
            <!-- <div class="card mb-4">
               <div class="card-body">
                 <p class="card-text text-uppercase">Overview</p>
                 <ul class="list-unstyled mb-0">
                   <li class="d-flex align-items-center mb-3">
                     <i class="ti ti-check"></i><span class="fw-medium mx-2">Task Compiled:</span>
                     <span>13.5k</span>
                   </li>
                   <li class="d-flex align-items-center mb-3">
                     <i class="ti ti-layout-grid"></i><span class="fw-medium mx-2">Projects Compiled:</span>
                     <span>146</span>
                   </li>
                   <li class="d-flex align-items-center">
                     <i class="ti ti-users"></i><span class="fw-medium mx-2">Connections:</span> <span>897</span>
                   </li>
                 </ul>
               </div>
               </div> -->
            <!--/ Profile Overview -->
         </div>
         <!--change pass-->
         <div class="col-12 mt-4">
            <!-- Change Password -->
            <div class="card mb-4">
                <h5 class="card-header">Change Password</h5>
                <div class="card-body">
                    <form class="formChangePassword2" id="formChangePassword2" method="POST" action="{{ url('admin/changePasswords/' . Auth::user()->id) }}">
                        @csrf
                        <div class="alert alert-warning" role="alert">
                            <h5 class="alert-heading mb-2">Ensure that these requirements are met</h5>
                            <span>Minimum 8 characters long, uppercase & symbol</span>
                            <span class="show_error text-danger d-block mt-2"></span>
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <span class="alert alert-success show_succ" style="display: none;" role="alert"></span>
                        <span class="alert alert-warning show_err" style="display: none;" role="alert"></span>

                        <div class="row mt-3">
                            <!-- Old Password -->
                            <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                                <label class="form-label" for="oldPassword">Old Password</label>
                                <div class="input-group input-group-merge">
                                    <input
                                        class="form-control"
                                        type="password"
                                        id="oldPassword"
                                        name="oldPassword"
                                        required
                                        placeholder="Enter old password"
                                    />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>

                            <!-- New Password -->
                            <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                                <label class="form-label" for="newPassword">New Password</label>
                                <div class="input-group input-group-merge">
                                    <input
                                        class="form-control"
                                        type="password"
                                        id="newPassword"
                                        name="newPassword"
                                        required
                                        placeholder="Enter new password"
                                    />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>

                            <!-- Confirm New Password -->
                            <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                                <label class="form-label" for="confirmPassword">Confirm New Password</label>
                                <div class="input-group input-group-merge">
                                    <input
                                        class="form-control"
                                        type="password"
                                        name="confirmPassword"
                                        id="confirmPassword"
                                        required
                                        placeholder="Re-enter new password"
                                    />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12">
                                <button type="button" id="pass_btn" class="btn btn-primary">Change Password</button>
                            </div>
                        </div>
                    </form>

                    <script>
                        $(document).ready(function () {
                            // Check password match
                            $("#newPassword, #confirmPassword").keyup(checkPasswordMatch);

                            $("#pass_btn").click(function () {
                                if (validatePassword()) {
                                    $("#formChangePassword2").submit();
                                }
                            });
                        });

                        function checkPasswordMatch() {
                            var password = $("#newPassword").val();
                            var confirmPassword = $("#confirmPassword").val();

                            if (password !== confirmPassword) {
                                $(".show_error").text("Passwords do not match.");
                            } else {
                                $(".show_error").text("");
                            }
                        }

                        function validatePassword() {
                            var password = $("#newPassword").val();
                            var confirmPassword = $("#confirmPassword").val();
                            var oldPassword = $("#oldPassword").val();

                            // Check if passwords match
                            if (password !== confirmPassword) {
                                $(".show_error").text("Passwords do not match.");
                                return false;
                            }

                            // Check password criteria
                            var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+]).{8,}$/;
                            if (!regex.test(password)) {
                                $(".show_error").text(
                                    "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character."
                                );
                                return false;
                            }

                            // Password valid
                            $(".show_error").text(""); // Clear any previous error messages
                            return true;
                        }
                    </script>
                </div>
            </div>

            <!--/ Change Password -->
         </div>
         <div class="col-xl-8 col-lg-7 col-md-7">
            <!-- Activity Timeline -->
            <!-- <div class="card card-action mb-4">
               <div class="card-header align-items-center">
                 <h5 class="card-action-title mb-0">Activity Timeline</h5>
                 <div class="card-action-element">
                   <div class="dropdown">
                     <button
                       type="button"
                       class="btn dropdown-toggle hide-arrow p-0"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">
                       <i class="ti ti-dots-vertical text-muted"></i>
                     </button>
                     <ul class="dropdown-menu dropdown-menu-end">
                       <li><a class="dropdown-item" href="javascript:void(0);">Share timeline</a></li>
                       <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
                       <li>
                         <hr class="dropdown-divider" />
                       </li>
                       <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
                     </ul>
                   </div>
                 </div>
               </div>
               <div class="card-body pb-0">
                 <ul class="timeline ms-1 mb-0">
                   <li class="timeline-item timeline-item-transparent">
                     <span class="timeline-point timeline-point-primary"></span>
                     <div class="timeline-event">
                       <div class="timeline-header">
                         <h6 class="mb-0">Client Meeting</h6>
                         <small class="text-muted">Today</small>
                       </div>
                       <p class="mb-2">Project meeting with john @10:15am</p>
                       <div class="d-flex flex-wrap">
                         <div class="avatar me-2">
                           <img src="../../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle" />
                         </div>
                         <div class="ms-1">
                           <h6 class="mb-0">Lester McCarthy (Client)</h6>
                           <span>CEO of Infibeam</span>
                         </div>
                       </div>
                     </div>
                   </li>
                   <li class="timeline-item timeline-item-transparent">
                     <span class="timeline-point timeline-point-success"></span>
                     <div class="timeline-event">
                       <div class="timeline-header">
                         <h6 class="mb-0">Create a new project for client</h6>
                         <small class="text-muted">2 Day Ago</small>
                       </div>
                       <p class="mb-0">Add files to new design folder</p>
                     </div>
                   </li>
                   <li class="timeline-item timeline-item-transparent">
                     <span class="timeline-point timeline-point-danger"></span>
                     <div class="timeline-event">
                       <div class="timeline-header">
                         <h6 class="mb-0">Shared 2 New Project Files</h6>
                         <small class="text-muted">6 Day Ago</small>
                       </div>
                       <p class="mb-2">
                         Sent by Mollie Dixon
                         <img
                           src="../../assets/img/avatars/4.png"
                           class="rounded-circle me-3"
                           alt="avatar"
                           height="24"
                           width="24" />
                       </p>
                       <div class="d-flex flex-wrap gap-2 pt-1">
                         <a href="javascript:void(0)" class="me-3">
                           <img
                             src="../../assets/img/icons/misc/doc.png"
                             alt="Document image"
                             width="15"
                             class="me-2" />
                           <span class="fw-medium text-heading">App Guidelines</span>
                         </a>
                         <a href="javascript:void(0)">
                           <img
                             src="../../assets/img/icons/misc/xls.png"
                             alt="Excel image"
                             width="15"
                             class="me-2" />
                           <span class="fw-medium text-heading">Testing Results</span>
                         </a>
                       </div>
                     </div>
                   </li>
                   <li class="timeline-item timeline-item-transparent border-transparent">
                     <span class="timeline-point timeline-point-info"></span>
                     <div class="timeline-event">
                       <div class="timeline-header">
                         <h6 class="mb-0">Project status updated</h6>
                         <small class="text-muted">10 Day Ago</small>
                       </div>
                       <p class="mb-0">Woocommerce iOS App Completed</p>
                     </div>
                   </li>
                 </ul>
               </div>
               </div> -->
            <!--/ Activity Timeline -->
            <div class="row">
               <!-- Connections -->
               <!-- <div class="col-lg-12 col-xl-6">
                  <div class="card card-action mb-4">
                    <div class="card-header align-items-center">
                      <h5 class="card-action-title mb-0">Connections</h5>
                      <div class="card-action-element">
                        <div class="dropdown">
                          <button
                            type="button"
                            class="btn dropdown-toggle hide-arrow p-0"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="ti ti-dots-vertical text-muted"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="javascript:void(0);">Share connections</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
                            <li>
                              <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <ul class="list-unstyled mb-0">
                        <li class="mb-3">
                          <div class="d-flex align-items-start">
                            <div class="d-flex align-items-start">
                              <div class="avatar me-2">
                                <img src="../../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" />
                              </div>
                              <div class="me-2 ms-1">
                                <h6 class="mb-0">Cecilia Payne</h6>
                                <small class="text-muted">45 Connections</small>
                              </div>
                            </div>
                            <div class="ms-auto">
                              <button class="btn btn-label-primary btn-icon btn-sm">
                                <i class="ti ti-user-check ti-xs"></i>
                              </button>
                            </div>
                          </div>
                        </li>
                        <li class="mb-3">
                          <div class="d-flex align-items-start">
                            <div class="d-flex align-items-start">
                              <div class="avatar me-2">
                                <img src="../../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle" />
                              </div>
                              <div class="me-2 ms-1">
                                <h6 class="mb-0">Curtis Fletcher</h6>
                                <small class="text-muted">1.32k Connections</small>
                              </div>
                            </div>
                            <div class="ms-auto">
                              <button class="btn btn-primary btn-icon btn-sm">
                                <i class="ti ti-user-x ti-xs"></i>
                              </button>
                            </div>
                          </div>
                        </li>
                        <li class="mb-3">
                          <div class="d-flex align-items-start">
                            <div class="d-flex align-items-start">
                              <div class="avatar me-2">
                                <img src="../../assets/img/avatars/10.png" alt="Avatar" class="rounded-circle" />
                              </div>
                              <div class="me-2 ms-1">
                                <h6 class="mb-0">Alice Stone</h6>
                                <small class="text-muted">125 Connections</small>
                              </div>
                            </div>
                            <div class="ms-auto">
                              <button class="btn btn-primary btn-icon btn-sm">
                                <i class="ti ti-user-x ti-xs"></i>
                              </button>
                            </div>
                          </div>
                        </li>
                        <li class="mb-3">
                          <div class="d-flex align-items-start">
                            <div class="d-flex align-items-start">
                              <div class="avatar me-2">
                                <img src="../../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
                              </div>
                              <div class="me-2 ms-1">
                                <h6 class="mb-0">Darrell Barnes</h6>
                                <small class="text-muted">456 Connections</small>
                              </div>
                            </div>
                            <div class="ms-auto">
                              <button class="btn btn-label-primary btn-icon btn-sm">
                                <i class="ti ti-user-check ti-xs"></i>
                              </button>
                            </div>
                          </div>
                        </li>
                  
                        <li class="mb-3">
                          <div class="d-flex align-items-start">
                            <div class="d-flex align-items-start">
                              <div class="avatar me-2">
                                <img src="../../assets/img/avatars/12.png" alt="Avatar" class="rounded-circle" />
                              </div>
                              <div class="me-2 ms-1">
                                <h6 class="mb-0">Eugenia Moore</h6>
                                <small class="text-muted">1.2k Connections</small>
                              </div>
                            </div>
                            <div class="ms-auto">
                              <button class="btn btn-label-primary btn-icon btn-sm">
                                <i class="ti ti-user-check ti-xs"></i>
                              </button>
                            </div>
                          </div>
                        </li>
                        <li class="text-center">
                          <a href="javascript:;">View all connections</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  </div> -->
               <!--/ Connections -->
               <!-- Teams -->
               <!--  <div class="col-lg-12 col-xl-6">
                  <div class="card card-action mb-4">
                    <div class="card-header align-items-center">
                      <h5 class="card-action-title mb-0">Teams</h5>
                      <div class="card-action-element">
                        <div class="dropdown">
                          <button
                            type="button"
                            class="btn dropdown-toggle hide-arrow p-0"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="ti ti-dots-vertical text-muted"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="javascript:void(0);">Share teams</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
                            <li>
                              <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <ul class="list-unstyled mb-0">
                        <li class="mb-3">
                          <div class="d-flex align-items-center">
                            <div class="d-flex align-items-start">
                              <div class="avatar me-2">
                                <img
                                  src="../../assets/img/icons/brands/react-label.png"
                                  alt="Avatar"
                                  class="rounded-circle" />
                              </div>
                              <div class="me-2 ms-1">
                                <h6 class="mb-0">React Developers</h6>
                                <small class="text-muted">72 Members</small>
                              </div>
                            </div>
                            <div class="ms-auto">
                              <a href="javascript:;"><span class="badge bg-label-danger">Developer</span></a>
                            </div>
                          </div>
                        </li>
                        <li class="mb-3">
                          <div class="d-flex align-items-center">
                            <div class="d-flex align-items-start">
                              <div class="avatar me-2">
                                <img
                                  src="../../assets/img/icons/brands/support-label.png"
                                  alt="Avatar"
                                  class="rounded-circle" />
                              </div>
                              <div class="me-2 ms-1">
                                <h6 class="mb-0">Support Team</h6>
                                <small class="text-muted">122 Members</small>
                              </div>
                            </div>
                            <div class="ms-auto">
                              <a href="javascript:;"><span class="badge bg-label-primary">Support</span></a>
                            </div>
                          </div>
                        </li>
                        <li class="mb-3">
                          <div class="d-flex align-items-center">
                            <div class="d-flex align-items-start">
                              <div class="avatar me-2">
                                <img
                                  src="../../assets/img/icons/brands/figma-label.png"
                                  alt="Avatar"
                                  class="rounded-circle" />
                              </div>
                              <div class="me-2 ms-1">
                                <h6 class="mb-0">UI Designers</h6>
                                <small class="text-muted">7 Members</small>
                              </div>
                            </div>
                            <div class="ms-auto">
                              <a href="javascript:;"><span class="badge bg-label-info">Designer</span></a>
                            </div>
                          </div>
                        </li>
                        <li class="mb-3">
                          <div class="d-flex align-items-center">
                            <div class="d-flex align-items-start">
                              <div class="avatar me-2">
                                <img
                                  src="../../assets/img/icons/brands/vue-label.png"
                                  alt="Avatar"
                                  class="rounded-circle" />
                              </div>
                              <div class="me-2 ms-1">
                                <h6 class="mb-0">Vue.js Developers</h6>
                                <small class="text-muted">289 Members</small>
                              </div>
                            </div>
                            <div class="ms-auto">
                              <a href="javascript:;"><span class="badge bg-label-danger">Developer</span></a>
                            </div>
                          </div>
                        </li>
                        <li class="mb-3">
                          <div class="d-flex align-items-center">
                            <div class="d-flex align-items-start">
                              <div class="avatar me-2">
                                <img
                                  src="../../assets/img/icons/brands/twitter-label.png"
                                  alt="Avatar"
                                  class="rounded-circle" />
                              </div>
                              <div class="me-2 ms-1">
                                <h6 class="mb-0">Digital Marketing</h6>
                                <small class="text-muted">24 Members</small>
                              </div>
                            </div>
                            <div class="ms-auto">
                              <a href="javascript:;"><span class="badge bg-label-secondary">Marketing</span></a>
                            </div>
                          </div>
                        </li>
                        <li class="text-center">
                          <a href="javascript:;">View all teams</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  </div> -->
               <!--/ Teams -->
            </div>
            <!-- Projects table -->
            <!-- <div class="card mb-4">
               <div class="card-datatable table-responsive">
                 <table class="datatables-projects table border-top">
                   <thead>
                     <tr>
                       <th></th>
                       <th></th>
                       <th>Name</th>
                       <th>Leader</th>
                       <th>Team</th>
                       <th class="w-px-200">Status</th>
                       <th>Action</th>
                     </tr>
                   </thead>
                 </table>
               </div>
               </div> -->
            <!--/ Projects table -->
         </div>
      </div>
      <!--/ User Profile Content -->
   </div>
   <!-- / Content -->
   <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
<div class="modal fade" id="edit-profile" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content ">
         <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body" id="editForm">
         </div>
      </div>
   </div>
</div>
<script>
   $(document).ready(function() {
   	$('.edit-profile').click(function() {
   
           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
   
           $.ajax({
               url: "{{ url('admin/ProfileSettings/home') }}", // Controller routes
               type: 'GET',
               success: function(response) {
               	$('#editForm').html(response);
                   $('#edit-profile').modal('show'); 
               }
           });
   
       });
   });
   
   function Tab(){
   	$('#edit-profile').modal('hide'); 
   }
</script>
@endsection


