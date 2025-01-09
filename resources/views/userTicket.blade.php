@extends('layouts.admin')
@section('title', 'Ticket')
@section('content')
<script src="https://kit.fontawesome.com/601f457ea1.js" crossorigin="anonymous"></script>
<style>

  .upper_row{

    background-color: white;
    box-shadow:0 0.25rem 1.125rem rgba(75, 70, 92, 0.1);
    border-radius: 6px;
  }


  .inner_content{

    height: 100%;
    /*border-right:1px solid #9d95f5;*/
    display: flex;
    align-items: center;
    padding:2px 6px;
    justify-content: center;
  }

</style>

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between">
      <h4 class="py-3"><span class="text-muted fw-light"></span>Ticket Overview</h4>
      
   </div>
 <div class="row mt-1" style="justify-content: center">
  <div class="col-sm-2 col-lg-2 mb-4">
    <div class="card card-border-shadow-info">
      <div class="card-body">
        <div class="d-flex align-items-center mb-2 pb-1">
          <div class="avatar me-2">
            <span class="avatar-initial rounded bg-label-info"><i class="fa-solid fa-ticket"></i></span>
          </div>
          <h4 class="ms-1 mb-0">3</h4>
        </div>
        <p class="mb-1">Open Ticket</p>
        <p class="mb-0">
          <!-- <span class="fw-medium me-1">-2.5%</span> -->
          <!-- <small class="text-muted">than last week</small> -->
        </p>
      </div>
    </div>
  </div>
 
  <div class="col-sm-2 col-lg-2 mb-4">
    <div class="card card-border-shadow-primary">
      <div class="card-body">
        <div class="d-flex align-items-center mb-2 pb-1">
          <div class="avatar me-2">
            <span class="avatar-initial rounded bg-label-primary"><i class="fa-solid fa-ticket"></i></span>
          </div>
          <h4 class="ms-1 mb-0">2</h4>
        </div>
        <p class="mb-1">In Progress Ticket</p>
        <p class="mb-0">
          <!-- <span class="fw-medium me-1">+18.2%</span> -->
          <!-- <small class="text-muted">than last week</small> -->
        </p>
      </div>
    </div>
  </div>
   <div class="col-sm-2 col-lg-2 mb-4">
    <div class="card card-border-shadow-success">
      <div class="card-body">
        <div class="d-flex align-items-center mb-2 pb-1">
          <div class="avatar me-2">
            <span class="avatar-initial rounded bg-label-success"><i class="fa-solid fa-ticket"></i></span>
          </div>
          <h4 class="ms-1 mb-0">1143</h4>
        </div>
        <p class="mb-1">Resolved Ticket</p>
        <p class="mb-0">
          <!-- <span class="fw-medium me-1">-8.7%</span> -->
          <!-- <small class="text-muted">than last week</small> -->
        </p>
      </div>
    </div>
  </div>
  <div class="col-sm-2 col-lg-2 mb-4">
    <div class="card card-border-shadow-warning">
      <div class="card-body">
        <div class="d-flex align-items-center mb-2 pb-1">
          <div class="avatar me-2">
            <span class="avatar-initial rounded bg-label-warning"><i class="fa-solid fa-ticket"></i></span>
          </div>
          <h4 class="ms-1 mb-0">2</h4>
        </div>
        <p class="mb-1">On Hold Ticket</p>
        <p class="mb-0">
          <!-- <span class="fw-medium me-1">+4.3%</span> -->
          <!-- <small class="text-muted">than last week</small> -->
        </p>
      </div>
    </div>
  </div>
  <div class="col-sm-2 col-lg-2 mb-4">
    <div class="card card-border-shadow-danger">
      <div class="card-body">
        <div class="d-flex align-items-center mb-2 pb-1">
          <div class="avatar me-2">
            <span class="avatar-initial rounded bg-label-danger"><i class="fa-solid fa-ticket"></i></span>
          </div>
          <h4 class="ms-1 mb-0">0</h4>
        </div>
        <p class="mb-1">Unanswered Ticket</p>
        <p class="mb-0">
          <!-- <span class="fw-medium me-1">+4.3%</span> -->
          <!-- <small class="text-muted">than last week</small> -->
        </p>
      </div>
    </div>
  </div>
</div>

<div class="row mt-3">
  <div class="col-md-12">

    <div class="card">
      <div class="card-datatable table-responsive pt-0">
        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
          <div class="card-header flex-column flex-md-row">
            <div class="head-label text-center">
              <h5 class="card-title mb-0">Invoice List</h5>
            </div>
            <div class="dt-action-buttons text-end pt-3 pt-md-0">
              <div class="dt-buttons btn-group flex-wrap">
                <div class="btn-group">
                  <div class="btn-group">
                    <button type="button" class="btn btn-secondary buttons-collection dropdown-toggle btn-label-primary me-2 waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="true"><i class="fa-solid fa-clock me-sm-2"></i>Duration</button>
                    <ul class="dropdown-menu show" data-popper-placement="top-start" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(0.8px, -40px, 0px);">
                      <li><a class="dropdown-item" href="javascript:void(0);">Today</a></li>
                      <li><a class="dropdown-item" href="javascript:void(0);">This Month</a></li>
                      <li><a class="dropdown-item" href="javascript:void(0);">Last Month</a></li>
                      <li>
                        <hr class="dropdown-divider">
                      </li>
                      <li><a class="dropdown-item" href="javascript:void(0);">Custom Range</a></li>
                    </ul>
                  </div>
                  <button class="btn btn-secondary buttons-collection dropdown-toggle btn-label-primary me-2 waves-effect waves-light" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">
                    <span>
                      <i class="ti ti-file-export me-sm-1"></i>
                      <span class="d-none d-sm-inline-block">Export</span>
                    </span>
                  </button>
                </div>
                <button class="btn btn-secondary create-new btn-primary waves-effect waves-light" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                  <span>
                    <i class="ti ti-plus me-sm-1"></i>
                    <span class="d-none d-sm-inline-block">Create Ticket</span>
                  </span>
                </button>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_length" id="DataTables_Table_0_length">
                <label>Show <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select">
                  <option value="7">7</option>
                  <option value="10">10</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="75">75</option>
                  <option value="100">100</option>
                </select> entries </label>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
              <div id="DataTables_Table_0_filter" class="dataTables_filter">
                <label>Search: <input type="search" class="form-control" placeholder="" aria-controls="DataTables_Table_0">
                </label>
              </div>
            </div>
          </div>
          <table class="datatables-basic table dataTable no-footer dtr-column" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1215px;">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1" style="width: 0px; display: none;" aria-label=""></th>
                <th class="sorting_disabled dt-checkboxes-cell dt-checkboxes-select-all" rowspan="1" colspan="1" style="width: 18px;" data-col="1" aria-label="">
                  <input type="checkbox" class="form-check-input">
                </th>
                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 274px;" aria-label="Name: activate to sort column ascending">Name</th>
                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 260px;" aria-label="Email: activate to sort column ascending">Email</th>
                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 89px;" aria-label="Date: activate to sort column ascending">Date</th>
                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 87px;" aria-label="Salary: activate to sort column ascending">Salary</th>
                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 105px;" aria-label="Status: activate to sort column ascending">Status</th>
                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 76px;" aria-label="Actions">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr class="odd">
                <td class="  control" tabindex="0" style="display: none;"></td>
                <td class="  dt-checkboxes-cell">
                  <input type="checkbox" class="dt-checkboxes form-check-input">
                </td>
                <td>
                  <div class="d-flex justify-content-start align-items-center user-name">
                    <div class="avatar-wrapper">
                      <div class="avatar me-2">
                        <span class="avatar-initial rounded-circle bg-label-secondary">GG</span>
                      </div>
                    </div>
                    <div class="d-flex flex-column">
                      <span class="emp_name text-truncate">Glyn Giacoppo</span>
                      <small class="emp_post text-truncate text-muted">Software Test Engineer</small>
                    </div>
                  </div>
                </td>
                <td>ggiacoppo2r@apache.org</td>
                <td>04/15/2021</td>
                <td>$24973.48</td>
                <td>
                  <span class="badge  bg-label-success">Open</span>
                </td>
                <td>
                  <div class="d-inline-block">
                    <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="text-primary ti ti-dots-vertical"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end m-0">
                      <li>
                        <a href="javascript:;" class="dropdown-item">Details</a>
                      </li>
                      <li>
                        <a href="javascript:;" class="dropdown-item">Archive</a>
                      </li>
                      <div class="dropdown-divider"></div>
                      <li>
                        <a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a>
                      </li>
                    </ul>
                  </div>
                  <a href="javascript:;" class="btn btn-sm btn-icon item-edit">
                    <i class="text-primary ti ti-pencil"></i>
                  </a>
                </td>
              </tr>
              <tr class="even">
                <td class="  control" tabindex="0" style="display: none;"></td>
                <td class="  dt-checkboxes-cell">
                  <input type="checkbox" class="dt-checkboxes form-check-input">
                </td>
                <td>
                  <div class="d-flex justify-content-start align-items-center user-name">
                    <div class="avatar-wrapper">
                      <div class="avatar me-2">
                        <img src="../../assets/img/avatars/10.png" alt="Avatar" class="rounded-circle">
                      </div>
                    </div>
                    <div class="d-flex flex-column">
                      <span class="emp_name text-truncate">Evangelina Carnock</span>
                      <small class="emp_post text-truncate text-muted">Cost Accountant</small>
                    </div>
                  </div>
                </td>
                <td>ecarnock2q@washington.edu</td>
                <td>01/26/2021</td>
                <td>$23704.82</td>
                <td>
                  <span class="badge  bg-label-warning">Resigned</span>
                </td>
                <td>
                  <div class="d-inline-block">
                    <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="text-primary ti ti-dots-vertical"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end m-0">
                      <li>
                        <a href="javascript:;" class="dropdown-item">Details</a>
                      </li>
                      <li>
                        <a href="javascript:;" class="dropdown-item">Archive</a>
                      </li>
                      <div class="dropdown-divider"></div>
                      <li>
                        <a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a>
                      </li>
                    </ul>
                  </div>
                  <a href="javascript:;" class="btn btn-sm btn-icon item-edit">
                    <i class="text-primary ti ti-pencil"></i>
                  </a>
                </td>
              </tr>
              <tr class="odd">
                <td class="  control" tabindex="0" style="display: none;"></td>
                <td class="  dt-checkboxes-cell">
                  <input type="checkbox" class="dt-checkboxes form-check-input">
                </td>
                <td>
                  <div class="d-flex justify-content-start align-items-center user-name">
                    <div class="avatar-wrapper">
                      <div class="avatar me-2">
                        <img src="../../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle">
                      </div>
                    </div>
                    <div class="d-flex flex-column">
                      <span class="emp_name text-truncate">Olivette Gudgin</span>
                      <small class="emp_post text-truncate text-muted">Paralegal</small>
                    </div>
                  </div>
                </td>
                <td>ogudgin2p@gizmodo.com</td>
                <td>04/09/2021</td>
                <td>$15211.60</td>
                <td>
                  <span class="badge  bg-label-success">Professional</span>
                </td>
                <td>
                  <div class="d-inline-block">
                    <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="text-primary ti ti-dots-vertical"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end m-0">
                      <li>
                        <a href="javascript:;" class="dropdown-item">Details</a>
                      </li>
                      <li>
                        <a href="javascript:;" class="dropdown-item">Archive</a>
                      </li>
                      <div class="dropdown-divider"></div>
                      <li>
                        <a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a>
                      </li>
                    </ul>
                  </div>
                  <a href="javascript:;" class="btn btn-sm btn-icon item-edit">
                    <i class="text-primary ti ti-pencil"></i>
                  </a>
                </td>
              </tr>
              <tr class="even">
                <td class="  control" tabindex="0" style="display: none;"></td>
                <td class="  dt-checkboxes-cell">
                  <input type="checkbox" class="dt-checkboxes form-check-input">
                </td>
                <td>
                  <div class="d-flex justify-content-start align-items-center user-name">
                    <div class="avatar-wrapper">
                      <div class="avatar me-2">
                        <span class="avatar-initial rounded-circle bg-label-warning">RP</span>
                      </div>
                    </div>
                    <div class="d-flex flex-column">
                      <span class="emp_name text-truncate">Reina Peckett</span>
                      <small class="emp_post text-truncate text-muted">Quality Control Specialist</small>
                    </div>
                  </div>
                </td>
                <td>rpeckett2o@timesonline.co.uk</td>
                <td>05/20/2021</td>
                <td>$16619.40</td>
                <td>
                  <span class="badge  bg-label-warning">Resigned</span>
                </td>
                <td>
                  <div class="d-inline-block">
                    <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="text-primary ti ti-dots-vertical"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end m-0">
                      <li>
                        <a href="javascript:;" class="dropdown-item">Details</a>
                      </li>
                      <li>
                        <a href="javascript:;" class="dropdown-item">Archive</a>
                      </li>
                      <div class="dropdown-divider"></div>
                      <li>
                        <a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a>
                      </li>
                    </ul>
                  </div>
                  <a href="javascript:;" class="btn btn-sm btn-icon item-edit">
                    <i class="text-primary ti ti-pencil"></i>
                  </a>
                </td>
              </tr>
              <tr class="odd">
                <td class="  control" tabindex="0" style="display: none;"></td>
                <td class="  dt-checkboxes-cell">
                  <input type="checkbox" class="dt-checkboxes form-check-input">
                </td>
                <td>
                  <div class="d-flex justify-content-start align-items-center user-name">
                    <div class="avatar-wrapper">
                      <div class="avatar me-2">
                        <span class="avatar-initial rounded-circle bg-label-success">AB</span>
                      </div>
                    </div>
                    <div class="d-flex flex-column">
                      <span class="emp_name text-truncate">Alaric Beslier</span>
                      <small class="emp_post text-truncate text-muted">Tax Accountant</small>
                    </div>
                  </div>
                </td>
                <td>abeslier2n@zimbio.com</td>
                <td>04/16/2021</td>
                <td>$19366.53</td>
                <td>
                  <span class="badge  bg-label-warning">Resigned</span>
                </td>
                <td>
                  <div class="d-inline-block">
                    <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="text-primary ti ti-dots-vertical"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end m-0">
                      <li>
                        <a href="javascript:;" class="dropdown-item">Details</a>
                      </li>
                      <li>
                        <a href="javascript:;" class="dropdown-item">Archive</a>
                      </li>
                      <div class="dropdown-divider"></div>
                      <li>
                        <a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a>
                      </li>
                    </ul>
                  </div>
                  <a href="javascript:;" class="btn btn-sm btn-icon item-edit">
                    <i class="text-primary ti ti-pencil"></i>
                  </a>
                </td>
              </tr>
              <tr class="even">
                <td class="  control" tabindex="0" style="display: none;"></td>
                <td class="  dt-checkboxes-cell">
                  <input type="checkbox" class="dt-checkboxes form-check-input">
                </td>
                <td>
                  <div class="d-flex justify-content-start align-items-center user-name">
                    <div class="avatar-wrapper">
                      <div class="avatar me-2">
                        <img src="../../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle">
                      </div>
                    </div>
                    <div class="d-flex flex-column">
                      <span class="emp_name text-truncate">Edwina Ebsworth</span>
                      <small class="emp_post text-truncate text-muted">Human Resources Assistant</small>
                    </div>
                  </div>
                </td>
                <td>eebsworth2m@sbwire.com</td>
                <td>09/27/2021</td>
                <td>$19586.23</td>
                <td>
                  <span class="badge bg-label-primary">Current</span>
                </td>
                <td>
                  <div class="d-inline-block">
                    <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="text-primary ti ti-dots-vertical"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end m-0">
                      <li>
                        <a href="javascript:;" class="dropdown-item">Details</a>
                      </li>
                      <li>
                        <a href="javascript:;" class="dropdown-item">Archive</a>
                      </li>
                      <div class="dropdown-divider"></div>
                      <li>
                        <a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a>
                      </li>
                    </ul>
                  </div>
                  <a href="javascript:;" class="btn btn-sm btn-icon item-edit">
                    <i class="text-primary ti ti-pencil"></i>
                  </a>
                </td>
              </tr>
              <tr class="odd">
                <td class="  control" tabindex="0" style="display: none;"></td>
                <td class="  dt-checkboxes-cell">
                  <input type="checkbox" class="dt-checkboxes form-check-input">
                </td>
                <td>
                  <div class="d-flex justify-content-start align-items-center user-name">
                    <div class="avatar-wrapper">
                      <div class="avatar me-2">
                        <span class="avatar-initial rounded-circle bg-label-warning">RH</span>
                      </div>
                    </div>
                    <div class="d-flex flex-column">
                      <span class="emp_name text-truncate">Ronica Hasted</span>
                      <small class="emp_post text-truncate text-muted">Software Consultant</small>
                    </div>
                  </div>
                </td>
                <td>rhasted2l@hexun.com</td>
                <td>07/04/2021</td>
                <td>$24866.66</td>
                <td>
                  <span class="badge  bg-label-warning">Resigned</span>
                </td>
                <td>
                  <div class="d-inline-block">
                    <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="text-primary ti ti-dots-vertical"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end m-0">
                      <li>
                        <a href="javascript:;" class="dropdown-item">Details</a>
                      </li>
                      <li>
                        <a href="javascript:;" class="dropdown-item">Archive</a>
                      </li>
                      <div class="dropdown-divider"></div>
                      <li>
                        <a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a>
                      </li>
                    </ul>
                  </div>
                  <a href="javascript:;" class="btn btn-sm btn-icon item-edit">
                    <i class="text-primary ti ti-pencil"></i>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 7 of 100 entries</div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                <ul class="pagination">
                  <li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous">
                    <a aria-controls="DataTables_Table_0" aria-disabled="true" role="link" data-dt-idx="previous" tabindex="-1" class="page-link">Previous</a>
                  </li>
                  <li class="paginate_button page-item active">
                    <a href="#" aria-controls="DataTables_Table_0" role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link">1</a>
                  </li>
                  <li class="paginate_button page-item ">
                    <a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="1" tabindex="0" class="page-link">2</a>
                  </li>
                  <li class="paginate_button page-item ">
                    <a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="2" tabindex="0" class="page-link">3</a>
                  </li>
                  <li class="paginate_button page-item ">
                    <a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="3" tabindex="0" class="page-link">4</a>
                  </li>
                  <li class="paginate_button page-item ">
                    <a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="4" tabindex="0" class="page-link">5</a>
                  </li>
                  <li class="paginate_button page-item disabled" id="DataTables_Table_0_ellipsis">
                    <a aria-controls="DataTables_Table_0" aria-disabled="true" role="link" data-dt-idx="ellipsis" tabindex="-1" class="page-link">…</a>
                  </li>
                  <li class="paginate_button page-item ">
                    <a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="14" tabindex="0" class="page-link">15</a>
                  </li>
                  <li class="paginate_button page-item next" id="DataTables_Table_0_next">
                    <a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="next" tabindex="0" class="page-link">Next</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div style="width: 1%;"></div>
        </div>
      </div>
    </div>  
  </div>

</div>
</div>
@if(Auth::user()->status == 4)
<div class="modal fade show" id="showedit" data-bs-backdrop="static" tabindex="-1" aria-modal="true" role="dialog" style="display: block;">
</div>
@endif
@endsection

