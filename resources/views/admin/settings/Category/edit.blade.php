<div class="modal-dialog">
  <form class="modal-content" action="{{url('admin/Category/update/'.$Category->id)}}" method="post">
    @csrf
    <div class="modal-header">
      <h5 class="modal-title" id="backDropModalTitle">Edit Category</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col mb-3">
          <label for="category_name" class="form-label">Category Name <span class="text-danger">*</span></label>
          <input type="text" id="category_name1" class="form-control" @if($Category && $Category->category_name) value="{{ $Category->category_name }}" @endif name="category_name" placeholder="Enter Category Name">
        </div>
      </div>
      <div class="row g-2">
        <div class="col mb-3">
          <label for="url" class="form-label">Url</label>
          <input type="text" readonly id="url1" class="form-control" @if($Category && $Category->url) value="{{ $Category->url }}" @endif name="url" placeholder="https://www.google.com/">
        </div>
      </div>
      <div class="row g-2">
        <div class="col mb-3">
          <label for="tag_line" class="form-label">Category Tag Line <span class="text-danger">*</span></label>
          <input type="text" id="tag_line" class="form-control" @if($Category && $Category->tag_line) value="{{$Category->tag_line }}" @endif name="tag_line" placeholder="Tag Line">
        </div>
      </div>
      <div class="row g-2">
        <div class="col mb-3">
          <label for="status"class="form-label"><input type="checkbox" @if($Category && $Category->status == '1') checked @endif name="status" />&nbsp;&nbsp;Check if this is a hidden group</label>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">
        Close
      </button>
      <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
    </div>
  </form>
</div>
<script>
  $(document).ready(function () {
      $('#category_name1').on('keyup', function () {
        // alert();
          // Get the value of the category_name input
          var categoryNameValue = $(this).val();

          // Update the value of the url input with the base URL and the category name
          $('#url1').val("{{ url('/') }}" + '/' + categoryNameValue);
      });
  });
  </script>