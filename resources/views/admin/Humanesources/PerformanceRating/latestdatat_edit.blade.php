<div class="row">
  <div class="col-md-5 mb-3">
    <input type="text" id="rating_name2" class="form-control" @if($PerformanceRating && $PerformanceRating->rating_name) value="{{$PerformanceRating->rating_name}}" @endif name="rating_name" placeholder="Enter rating Name">
  </div>
  <div class="col-md-5 mb-3">
    <input type="text" id="rating2" class="form-control" @if($PerformanceRating && $PerformanceRating->rating) value="{{$PerformanceRating->rating}}" @endif name="rating" placeholder="Enter rating">
  </div>
  <div class="col-md-2 mb-3">
    <button type="button" onclick="updaterating({{$PerformanceRating->id}})"  id="update" class="btn btn-primary">Update</button>
  </div>
</div>