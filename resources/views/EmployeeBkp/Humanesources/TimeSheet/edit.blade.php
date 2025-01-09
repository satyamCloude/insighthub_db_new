@extends('layouts.admin')
@section('title', 'TimeSheet')
@section('content')
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">TimeSheet /</span> Edit</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Edit Detail's</h5>
            <div class="action-btns">
              <a href="{{url('Employee/TimeSheet/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('Employee/TimeSheet/update/'.$TimeSheet->id)}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row"> 
                <div class="col-sm-4 mb-4">
                      <label for="project_id" class="form-label">Project <span class="text-danger">*</span></label>
                      <select  name="project_id" id="project_id2" data-live-search="true" class="form-control select-picker" data-size="8" tabindex="null">
                      
                       @foreach($Project as $lst)
                        <option @if($TimeSheet && $TimeSheet->project_id == $lst->id) selected  @endif value="{{$lst->id}}">{{$lst->project_name}}</option>
                        @endforeach

                      </select>
                </div>

                 <div class="col-sm-4 mb-4">
                      <label for="task_id" class="form-label">Task <span class="text-danger">*</span></label>
                      <select   name="task_id" id="task_id2" data-live-search="true" class="form-control select-picker" data-size="8" tabindex="null">
                        @foreach($Task as $task)
                        <option @if($TimeSheet && $TimeSheet->task_id == $task->id) selected  @endif value="{{$task->id}}">{{$task->project_name}}</option>
                        @endforeach
                      </select>
                </div>

                <div class="col-sm-4 mb-4">
                      <label  class="form-label" for="user_id2">Employee <span class="text-danger">*</span></label>
                      <select  class="form-control select select2" name="emp_id[]" id="emp_id" multiple>
                        @foreach($Employee as $emp)
                        <option @if(in_array($emp->id,explode(',',$TimeSheet->emp_id))) selected @endif value="{{$emp->id}}">{{$emp->first_name}}</option>
                        @endforeach
                      </select>
                </div>
                <div class="col-sm-3 mb-4">
                 <label class="form-labe" data-label="true" for="start_date">Start Date</label>
                  <input type="date" class="form-control" @if($TimeSheet && $TimeSheet->start_date) value="{{$TimeSheet->start_date}}" @endif  name="start_date">
                </div>
                <div class="col-sm-3 mb-4">
                 <label class="form-labe" data-label="true" for="start_time">Start Time</label>
                  <input type="time" class="form-control" @if($TimeSheet && $TimeSheet->start_time) value="{{$TimeSheet->start_time}}" @endif  name="start_time">
                </div>
                <div class="col-sm-3 mb-4">
                 <label class="form-labe" data-label="true" for="end_date">End Date</label>
                  <input type="date" class="form-control" @if($TimeSheet && $TimeSheet->end_date) value="{{$TimeSheet->end_date}}" @endif  name="end_date">
                </div>
                <div class="col-sm-3 mb-4">
                 <label class="form-labe" data-label="true" for="end_time">End Time</label>
                  <input type="time" class="form-control" @if($TimeSheet && $TimeSheet->end_time) value="{{$TimeSheet->end_time}}" @endif  name="end_time">
                </div>

                <div class="col-sm-6 mb-4">
                 <label class="form-label" data-label="true" for="memo">Memo</label>
                <input type="text" class="form-control" placeholder="e.g. Working on new logo" @if($TimeSheet && $TimeSheet->memo) value="{{$TimeSheet->memo}}" @endif name="memo" id="memo" autocomplete="off">
                </div>

                <div class="col-sm-6 mb-4">

                 <label class="form-label" data-label="" for="total_time">Total Hours</label>
                 <p id="total_time" class="text-danger" style="font-weight: 500;font-size: 21px;">0 hrs</p>
                 <input type="hidden" name="total_hours" @if($TimeSheet && $TimeSheet->total_hours) value="{{$TimeSheet->total_hours}}" @endif  id="total_hours">
                </div>


            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('Employee/TimeSheet/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
                </div>
                <div class="col-md-6">
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

@endsection