@extends('layouts.admin')
@section('title', 'Currency Settings')
@section('content')
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Currency Settings /</span> Add</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="{{url('admin/CurrencySettings/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('admin/CurrencySettings/update/'.$id)}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <div class="row mb-4"> 
                <div class="col-md-6 mb-2">
              <label for="rate" class="form-label"><h5>Currency Name <span class="text-danger">*</span></h5></label>
              <input type="text" id="name" class="form-control" name="name" value="{{$tax->name}}" >
            </div>
                <div class="col-md-6 mb-2">
              <label for="rate" class="form-label"><h5>Currency Symbol<span class="text-danger">*</span></h5></label>
              <input type="text" id="prefix" class="form-control" name="prefix" value="{{$tax->prefix}}" >
            </div> 
                <div class="col-md-6 mb-2">
              <label for="rate" class="form-label"><h5>Currency Code<span class="text-danger">*</span></h5></label>
              <input type="text" id="code" class="form-control" name="code" value="{{$tax->code}}" >
            </div>
                <div class="col-md-6 mb-2">
                    <label for="rate" class="form-label"><h5>Is Cryptocurrency <span class="text-danger">*</span></h5></label><br>

                  <div class="form-check form-check-inline">
                      <input type="radio" id="is_cryptocurrency_yes" class="form-check-input" name="is_cryptocurrency" value="1">
                      <label class="form-check-label" for="is_cryptocurrency_yes">Yes</label>
                  </div>
                  <div class="form-check form-check-inline">
                      <input type="radio" id="is_cryptocurrency_no" class="form-check-input" name="is_cryptocurrency" value="0">
                      <label class="form-check-label " for="is_cryptocurrency_no">No</label>
                  </div>
              </div>

                <div class="col-md-6 mb-4">
                      <label for="rate" class="form-label"><h5>Exchange Rate <span class="text-danger">*</span></h5></label>
                      <input type="text" class="form-control" name="exchange_rate" required value="{{$tax->exchange_rate}}" /><br>
                      <span class="text-dark">( USD To USD )</span>
                </div> 

                <hr/>
                <h4>Currency Format Settings</h4>
                <div class="col-md-6 mb-2">
                      <label for="rate" class="form-label"><h5>Currency Position <span class="text-danger">*</span></h5></label>
                      <select class="form-control" name="currency_position" value="{{$tax->currency_position}}" required>
                        <option name="left">Left</option>
                        <option name="right">Right</option>
                        <option name="left_with_space">Left With Space</option>
                        <option name="right_with_space">Right With Space</option>
                      </select>
                </div>
                <div class="col-md-6 mb-4">
                      <label for="rate" class="form-label"><h5>Thousand Separator <span class="text-danger">*</span></h5></label>
                      <input type="text" class="form-control" name="thousand_separator" value="{{$tax->thousand_separator}}" required />
                </div> 
                <div class="col-md-6 mb-4">
                      <label for="rate" class="form-label"><h5>Decimal Separator <span class="text-danger">*</span></h5></label>
                      <input type="text" class="form-control" name="decimal_separator" value="{{$tax->decimal_separator}}" required />
                </div>
                <div class="col-md-6 mb-4">
                      <label for="rate" class="form-label"><h5>Number of Decimals <span class="text-danger">*</span></h5></label>
                      <input type="number" class="form-control" name="no_of_decimals" value="{{$tax->no_of_decimals}}" required />
                </div>
                <hr/>
                <span class="text-dark">Example - 1,234,568</span>
            </div>
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('admin/CurrencySettings/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
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
  <!-- JavaScript to handle checkbox selection -->
@endsection