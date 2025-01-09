@extends('layouts.admin')
@section('title', 'Create')
@section('content')
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Performance /</span> Add</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="{{url('Employee/Performance/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
           <form action="{{ url('Employee/Performance/store') }}" method="post" enctype="multipart/form-data">  
            @csrf
            <div class="card-body">
              <div class="row mb-4"> 
                <div class="col-md-4">
                      <label for="employee_id" class="form-label">Employee <span class="text-danger">*</span></label>
                      <select name="employee_id" class="form-select" required>
                            @foreach($Employee as $Emp)
                            <option value="{{$Emp->id}}">{{$Emp->first_name}}</option>
                            @endforeach
                          </select>
                </div>
                <div class="col-md-4">
                      <label for="evaluation_period" class="form-label">Evaluation Period <span class="text-danger">*</span></label>
                     <select name="evaluation_period" class="form-select" required>
                            <option value="quarter 1">Quarter 1</option>
                            <option value="quarter 2">Quarter 2</option>
                            <option value="quarter 3">Quarter 3</option>
                            <option value="quarter 4">Quarter 4</option>
                          </select>
                </div>
                <div class="col-md-4">
                    <label for="year" class="form-label">Year <span class="text-danger">*</span></label>
                          <select name="year" class="form-select" id="year" required> </select>
                </div>
              </div>
              <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>PERFORMANCE CATEGORY</th>
                <th>RATING</th>
                <th>COMMENTS & EXAMPLES(IF ANY)</th>
              </tr>
            </thead>
            <tbody>
              @if(count($PerformanceCategory) > 0)
              <input name="categorytotal" type="hidden" value="{{count($PerformanceCategory)}}" />
              <input name="ratingtotal" type="hidden" value="{{count($PerformanceRating)}}" />
              @foreach($PerformanceCategory as $key=> $Perfo)
              <tr>
                 <td><b>{{$Perfo->category_name}} :</b><br/>{{$Perfo->description}}</td> 
                  <td> @foreach($PerformanceRating as $Perrating)
                  <input type="radio" class="form-check-input" name="rating{{$key+1}}" value="{{$Perrating->id}}">&nbsp;&nbsp; {{$Perrating->rating_name}}</br>
                 @endforeach</td>
                 <td><textarea name="comments[]" class="form-control"></textarea></td> 
              </tr>
              @endforeach
              @else
              <tr>
                <td class="text-center" colspan="8">No Data Found</td>
              </tr>
              @endif             

            </tbody>
        </table>

            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('Employee/Performance/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
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
    <script>
        $(document).ready(function() {
            // Get the current year
            var currentYear = new Date().getFullYear();

            // Start from the current year and go back to 2015, populating the select box in reverse order
            for (var year = currentYear; year >= 2015; year--) {
                $('#year').append('<option value="' + year + '">' + year + '</option>');
            }
        });
    </script>
@endsection