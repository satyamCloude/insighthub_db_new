<div class="modal-dialog">
    <form class="modal-content" action="{{ url('admin/os_category/updates/'.$id) }}" method="post">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="backDropModalTitle">Update Category Operating System</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col mb-3">
                    <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                    <select id="category_id" class="form-control" name="category_id" required>
                        <option value="">-Select Category-</option>
                        @foreach($categories as $category)
                            <option @if($OSCategory && $OSCategory->category_id == $category->id) selected @endif value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row g-2">
                <div class="col mb-3">
                    <label for="os_id" class="form-label">Operating System <span class="text-danger">*</span></label>
                    <select id="os_id" class="form-control" name="os_id" required>
                        <option value="">-Select Operating System-</option>
                        @foreach($OperatingSystem as $os)
                            <option @if($OSCategory && $OSCategory->os_id == $os->id) selected @endif value="{{ $os->id }}">{{ $os->ostype }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
          <div class="row g-2">
            <div class="col mb-3">
              <label for="category_name" class="form-label">Currency<span class="text-danger">*</span></label>
              <!-- <input type="text" id="category_name" class="form-control" name="category_name" placeholder="Enter Category Name"> -->
              <select id="currency_id" class="form-control" name="currency_id" required>
                  <option value="">-Select Currency-</option>
                  @foreach($Currency as $Categorys)
                  <option @if($OSCategory && $OSCategory->currency_id == $Categorys->id) selected @endif value="{{$Categorys->id}}">{{$Categorys->name}}</option>
                  @endforeach
            </select>
            </div>
          </div>
             <div class="row g-2">
            <div class="col mb-3">
              <label for="price" class="form-label">Price</label>
              <input type="number"  id="price" class="form-control" name="price" @if($OSCategory && $OSCategory->price) value="{{$OSCategory->price}}" @endif required>
            </div>
          </div> 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
        </div>
    </form>
</div>
