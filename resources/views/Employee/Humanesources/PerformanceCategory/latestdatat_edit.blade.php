<div class="row">
  <div class="col-md-5 mb-3">
    <input type="text" id="category_name2" class="form-control" @if($PerformanceCategory && $PerformanceCategory->category_name) value="{{$PerformanceCategory->category_name}}" @endif name="category_name" placeholder="Enter Category Name">
  </div>
  <div class="col-md-5 mb-3">
    <input type="text" id="description2" class="form-control" @if($PerformanceCategory && $PerformanceCategory->description) value="{{$PerformanceCategory->description}}" @endif name="description" placeholder="Enter description">
  </div>
  <div class="col-md-2 mb-3">
    <button type="button" onclick="updateddataa({{$PerformanceCategory->id}})"  id="update" class="btn btn-primary">Update</button>
  </div>
</div>