                  @if(!empty($ProductNews))
                  <select class="form-control select2" name="services_id" onChange="getProductDetailWithFullData(this.value)" required id="services">
                    <option value="0">Select Product</option>
                    @foreach($ProductNews as $Employee)
                    <option value="{{ $Employee->id }}">{{ $Employee->product_name }}</option>
                    @endforeach
                  </select>
                  @endif