@extends('layouts.admin')

@section('title', 'Ticket')

@section('content')

<script src="https://kit.fontawesome.com/601f457ea1.js" crossorigin="anonymous"></script>

<style>

  .upper_row {



    background-color: white;

    box-shadow: 0 0.25rem 1.125rem rgba(75, 70, 92, 0.1);

    border-radius: 6px;

  }

  .btmtable th {
    background-color: #eae8fd  !important;
}



  .inner_content {

    height: 100%;

    /*border-right:1px solid #9d95f5;*/

    display: flex;

    align-items: center;

    padding: 2px 6px;

    justify-content: center;

  }

</style>



<div class="container-xxl flex-grow-1 container-p-y">

  <div class="d-flex justify-content-between">

    <h4 class="py-3"><span class="text-muted fw-light"></span>Ticket Overview</h4>



  </div>

  <div class="row" style="justify-content: space-between;">

    <div class="col-sm-2 col-lg-2 mb-4 filter-ticket" status="1">

      <div class="card card-border-shadow-success">

        <div class="card-body">

          <div class="d-flex align-items-center mb-2 pb-1">

            <div class="avatar me-2">

              <span class="avatar-initial rounded bg-label-success"><i class="fa-solid fa-ticket"></i></span>

            </div>

            <h4 class="ms-1 mb-0">{{$Open}}</h4>

          </div>

          <p class="mb-1">Open</p>

          <p class="mb-0">

            <!-- <span class="fw-medium me-1">-8.7%</span> -->

            <!-- <small class="text-muted">than last week</small> -->

          </p>

        </div>

      </div>

    </div>

    <div class="col-sm-2 col-lg-2 mb-4 filter-ticket" status="2">

      <div class="card card-border-shadow-primary">

        <div class="card-body">

          <div class="d-flex align-items-center mb-2 pb-1">

            <div class="avatar me-2">

              <span class="avatar-initial rounded bg-label-primary"><i class="fa-solid fa-ticket"></i></span>

            </div>

            <h4 class="ms-1 mb-0">{{$InProgress}}</h4>

          </div>

          <p class="mb-1">In Progress</p>

          <p class="mb-0">

            <!-- <span class="fw-medium me-1">+18.2%</span> -->

            <!-- <small class="text-muted">than last week</small> -->

          </p>

        </div>

      </div>

    </div>

    <div class="col-sm-2 col-lg-2 mb-4 filter-ticket" status="3">

      <div class="card card-border-shadow-warning">

        <div class="card-body">

          <div class="d-flex align-items-center mb-2 pb-1">

            <div class="avatar me-2">

              <span class="avatar-initial rounded bg-label-warning"><i class="fa-solid fa-ticket"></i></span>

            </div>

            <h4 class="ms-1 mb-0">{{$OnHold}}</h4>

          </div>

          <p class="mb-1">On Hold</p>

          <p class="mb-0">

            <!-- <span class="fw-medium me-1">+4.3%</span> -->

            <!-- <small class="text-muted">than last week</small> -->

          </p>

        </div>

      </div>

    </div>

    <div class="col-sm-2 col-lg-2 mb-4 filter-ticket" status="4">

      <div class="card card-border-shadow-secondary">

        <div class="card-body">

          <div class="d-flex align-items-center mb-2 pb-1">

            <div class="avatar me-2">

              <span class="avatar-initial rounded bg-label-secondary"><i class="fa-solid fa-ticket"></i></span>

            </div>

            <h4 class="ms-1 mb-0">{{$Resolved}}</h4>

          </div>

          <p class="mb-1">Resolved</p>

          <p class="mb-0">

            <!-- <span class="fw-medium me-1">+4.3%</span> -->

            <!-- <small class="text-muted">than last week</small> -->

          </p>

        </div>

      </div>

    </div>

    <div class="col-sm-2 col-lg-2 mb-4 filter-ticket" status="5">

      <div class="card card-border-shadow-danger">

        <div class="card-body">

          <div class="d-flex align-items-center mb-2 pb-1">

            <div class="avatar me-2">

              <span class="avatar-initial rounded bg-label-danger"><i class="fa-solid fa-ticket"></i></span>

            </div>

            <h4 class="ms-1 mb-0">{{$Closed}}</h4>

          </div>

          <p class="mb-1">Unanswered</p>

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



      <div class="card px-3">

        <div class="card-datatable table-responsive pt-0">

          <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

            <div class="card-header flex-column flex-md-row">

              <div class="head-label text-center">

                <h5 class="card-title mb-0">Ticket List</h5>

              </div>

              

              <div class="dt-action-buttons text-end pt-3 pt-md-0">

                

                <div class="dt-buttons btn-group flex-wrap">

                  <div class="btn-group">

                    <div class="btn-group">

                      <select id="dateFilter" class="form-control waves-effect waves-light">

                          <option value="">All</option>

                          <option value="today" {{ request()->get('date') == 'today' ? 'selected' : '' }}>Today</option>

                          <option value="month" {{ request()->get('date') == 'month' ? 'selected' : '' }}>This Month</option>

                          <option value="last" {{ request()->get('date') == 'last' ? 'selected' : '' }}>Last Month</option>

                          <option value="custom" {{ request()->get('date') == 'custom' ? 'selected' : '' }}>Custom Range</option>

                      </select>

                      

                    </div>

                    <form id="filter-form" style="@if(request()->get('date') != 'custom') display:none; @endif">

                        <div class="d-flex ms-1">

                            <input type="date" name="from" class="form-control" value="{{ request('from') }}">&nbsp;

                            <input type="date" name="to" class="form-control" value="{{ request('to') }}">

                            <input type="hidden" name="date" id="date">

                            <button type="button" class="btn btn-sm btn-primary text-white" id="submitFilter">

                                <i class="fa-solid fa-search"></i>

                            </button>

                        </div>

                    </form>

                    <!-- <button

                      class="btn btn-secondary buttons-collection dropdown-toggle btn-label-primary me-2 waves-effect waves-light"

                      tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog"

                      aria-expanded="false">

                      <span>

                        <i class="ti ti-file-export me-sm-1"></i>

                        <span class="d-none d-sm-inline-block">Export</span>

                      </span>

                    </button> -->

                  </div>

                  

                </div>

                <a href="{{url('user/ticket/create')}}" class="btn btn-secondary create-new btn-primary waves-effect waves-light" tabindex="0"

                    aria-controls="DataTables_Table_0" type="button">

                    <span>

                      <i class="ti ti-plus me-sm-1"></i>

                      <span class="d-none d-sm-inline-block">Create Ticket</span>

                    </span>

                  </a>



                  <a href="{{url('user/userTicket')}}" class="btn btn-secondary create-new btn-primary waves-effect waves-light" tabindex="0" aria-controls="DataTables_Table_0">

                    <span>

                    <i class="fa-solid fa-refresh"></i>

                  </span>

                </a>

              </div>

            </div>

            <!-- <div class="row">

              <div class="col-sm-12 col-md-6">

                <div class="dataTables_length" id="DataTables_Table_0_length">

                  <label>Show <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"

                      class="form-select">

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

                  <label>Search: <input type="search" class="form-control" placeholder=""

                      aria-controls="DataTables_Table_0">

                  </label>

                </div>

              </div>

            </div> -->

            <table class="dt-responsive table dataTable btmtable" id="DataTables_Table_0" >

              <thead>

                <tr>

                  <th >Ticket Id</th>

                  <!-- <th>

                    <input type="checkbox" class="form-check-input">

                  </th> -->

                  <th >Name</th>

                  <th >Subject</th>

                  <th >Department</th>

                  <th >Last Reply</th>

                  <th >Status</th>

                  <th >Actions

                  </th>

                </tr>

              </thead>

              <tbody>

                @foreach($Tickets as $Ticket)

                <tr>

                  <td >#{{$Ticket->id}}</td>

                  <!-- <td >

                    <input type="checkbox" class="dt-checkboxes form-check-input">

                  </td> -->

                  <td>

                    <div class="d-flex justify-content-start align-items-center user-name">

                      <!-- <div class="avatar-wrapper">

                        <div class="avatar me-2">

                          <span class="avatar-initial rounded-circle bg-label-secondary">GG</span>

                        </div>

                      </div> -->

                      <div class="d-flex flex-column">

                        <span class="emp_name text-truncate">{{$Ticket->client_name}}</span>

                        <!-- <small class="emp_post text-truncate text-muted">Software Test Engineer</small> -->

                      </div>

                    </div>

                  </td>

                  <td>{{$Ticket->subject}}</td>

                  <td>{{$Ticket->department_name}}</td>

                  <td>{{$Ticket->last_reply_date}}</td>

                  <td>

                    <button class="btn btn-{{ 

                          $Ticket->status == 1 ? 'success' : 

                          ($Ticket->status == 2 ? 'primary' : 

                          ($Ticket->status == 3 ? 'warning' :

                          ($Ticket->status == 4 ? 'secondary' :

                          ($Ticket->status == 5 ? 'danger' : '')))) 

                      }} btn-sm">

                                {{

                            $Ticket->status == 1 ? 'Open' : 

                            ($Ticket->status == 2 ? 'In Progress' : 

                            ($Ticket->status == 3 ? 'On Hold' :

                            ($Ticket->status == 4 ? 'Resolved' :

                            ($Ticket->status == 5 ? 'Unanswered' : ''))))

                        }}

                    </button>

                  </td>

                  <td>

                    <div class="d-inline-block">

                      <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow"

                        data-bs-toggle="dropdown">

                        <i class="text-primary ti ti-dots-vertical"></i>

                      </a>

                      <ul class="dropdown-menu dropdown-menu-end m-0">

                        <li>

                          <a href="{{url('user/ticket/view?ticketId='.$Ticket->id)}}" class="dropdown-item">View</a>

                        </li>

                        <!-- <li>

                          <a href="javascript:;" class="dropdown-item">Archive</a>

                        </li> -->

                        <!--<div class="dropdown-divider"></div>-->

                        <!--<li>-->

                        <!--  <a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a>-->

                        <!--</li>-->

                      </ul>

                    </div>

                    <!-- <a href="javascript:;" class="btn btn-sm btn-icon item-edit">

                      <i class="text-primary ti ti-pencil"></i>

                    </a> -->

                  </td>

                </tr>

                @endforeach

                

              </tbody>

            </table>

            <div class="p-1" style="float: right;">

              {{ $Tickets->links() }}

            </div>

            <!-- <div class="row">

              <div class="col-sm-12 col-md-6">

                <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to

                  7 of 100 entries</div>

              </div>

              <div class="col-sm-12 col-md-6">

                <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">

                  <ul class="pagination">

                    <li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous">

                      <a aria-controls="DataTables_Table_0" aria-disabled="true" role="link" data-dt-idx="previous"

                        tabindex="-1" class="page-link">Previous</a>

                    </li>

                    <li class="paginate_button page-item active">

                      <a href="#" aria-controls="DataTables_Table_0" role="link" aria-current="page" data-dt-idx="0"

                        tabindex="0" class="page-link">1</a>

                    </li>

                    <li class="paginate_button page-item ">

                      <a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="1" tabindex="0"

                        class="page-link">2</a>

                    </li>

                    <li class="paginate_button page-item ">

                      <a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="2" tabindex="0"

                        class="page-link">3</a>

                    </li>

                    <li class="paginate_button page-item ">

                      <a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="3" tabindex="0"

                        class="page-link">4</a>

                    </li>

                    <li class="paginate_button page-item ">

                      <a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="4" tabindex="0"

                        class="page-link">5</a>

                    </li>

                    <li class="paginate_button page-item disabled" id="DataTables_Table_0_ellipsis">

                      <a aria-controls="DataTables_Table_0" aria-disabled="true" role="link" data-dt-idx="ellipsis"

                        tabindex="-1" class="page-link">…</a>

                    </li>

                    <li class="paginate_button page-item ">

                      <a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="14" tabindex="0"

                        class="page-link">15</a>

                    </li>

                    <li class="paginate_button page-item next" id="DataTables_Table_0_next">

                      <a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="next" tabindex="0"

                        class="page-link">Next</a>

                    </li>

                  </ul>

                </div>

              </div>

            </div> -->

            <div style="width: 1%;"></div>

          </div>

        </div>

      </div>

    </div>



  </div>

</div>

@if(Auth::user()->status == 4)

<div class="modal fade show" id="showedit" data-bs-backdrop="static" tabindex="-1" aria-modal="true" role="dialog"

  style="display: block;">

</div>

@endif



<script>

  $('.filter-ticket').click(function() {

    var status = $(this).attr('status');

    // Redirect to the current page with the status query string

    window.location.href = window.location.pathname + '?status=' + status;

  });





      $(document).ready(function () {



          $('#dateFilter').change(function () {

              var selectedValue = $(this).val();

              switch (selectedValue) {

                  case 'today':

                      window.location.href = window.location.pathname + '?date=today';

                      break;

                  case 'month':

                      window.location.href = window.location.pathname + '?date=month';

                      break;

                  case 'last':

                      window.location.href = window.location.pathname + '?date=last';

                      break;

                  case 'custom':

                      $('#filter-form').show();

                      break;

                  default:

                      window.location.href = window.location.pathname; // Redirect without any query string

              }

                

              $('#date').val(selectedValue);



          });



          $('#submitFilter').click(function () {

              $('#filter-form').submit();

          });

      });



</script>

@endsection