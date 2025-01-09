@if($payment_type == 2)
        <div class="row">
            <div class="col-md-2 bg-success">
                <label for="Currency" class="form-label">Currency</label>
            </div>
            <div class="col-md-2 bg-success">
                <label for="One Time" class="form-label">One Time</label>
            </div>
        </div>
    @foreach($currency as $currencys)
       <div class="row mt-3">
            <div class="col-md-2">
                <label for="INR "class="form-label mt-3">{{$currencys->name}}</label>
            </div>
            <div class="col-md-2">

                <!-- <input type="hidden" class="form-control" name="product_plan[]"  value="{{$payment_type}}" required/> -->
                <input type="hidden" class="form-control" name="plan_type[]"  value="{{$plan_type}}" required/>
                <input type="hidden" class="form-control" name="currency_id[]"  value="{{$currencys->id}}" required/>
                <input type="number" class="form-control" name="price[]"  placeholder="{{$currencys->prefix}}" required/>
            </div>
        </div>

    @endforeach
@elseif($payment_type == 3)
    <div class="row">
    <div class="col-md-1 bg-success">
     <label for="Currency"class="form-label">Currency</label>
    </div>
     <div class="col-md-1 bg-success">
     <label for="Hourly"class="form-label">Hourly</label>
    </div>
    <div class="col-md-1 bg-success">
     <label for="Monthly"class="form-label">Monthly</label>
    </div>
    <div class="col-md-1 bg-success">
    <label for="Quartely"class="form-label">Quartely</label>
    </div>
    <div class="col-md-2 bg-success">
    <label for="Semi-Annually"class="form-label">Semi-Annually</label>
    </div>
    <div class="col-md-2 bg-success">
    <label for="Annually"class="form-label">Annually</label>
    </div>
    <div class="col-md-2 bg-success">
    <label for="Biennially"class="form-label">Biennially</label>
    </div>
    <div class="col-md-2 bg-success">
    <label for="Triennially"class="form-label">Triennially</label>
    </div>
    </div>
         @foreach($currency as $currencys)
    <div class="row mt-3">
         <div class="col-md-1">
            <label for="INR "class="form-label mt-3">{{$currencys->name}}</label>
            </div>
            <div class="col-md-1">
                                <input type="hidden" class="form-control" name="currency_id[]"  value="{{$currencys->id}}" required/>

            <input type="hidden" class="form-control" name="plan_type[]"  value="hourly" required/>
            <input type="number" class="form-control" name="price[]"  placeholder="{{$currencys->prefix}}" required/>
            </div>
            <div class="col-md-1">
                                <input type="hidden" class="form-control" name="currency_id[]"  value="{{$currencys->id}}" required/>

             <input type="hidden" class="form-control" name="plan_type[]"  value="monthly" required/>
            <input type="number" class="form-control"  name="price[]"  placeholder="{{$currencys->prefix}}" required/>
            </div>
            <div class="col-md-1">
                                <input type="hidden" class="form-control" name="currency_id[]"  value="{{$currencys->id}}" required/>

        <input type="hidden" class="form-control" name="plan_type[]"  value="quartely" required/>
            <input type="number" class="form-control"  name="price[]"  placeholder="{{$currencys->prefix}}" required/>
            </div>
            <div class="col-md-2">
                                <input type="hidden" class="form-control" name="currency_id[]"  value="{{$currencys->id}}" required/>

                <input type="hidden" class="form-control" name="plan_type[]"  value="semiannually" required/>
            <input type="number" class="form-control"  name="price[]"  placeholder="{{$currencys->prefix}}" required/>
            </div>
            <div class="col-md-2">
                                <input type="hidden" class="form-control" name="currency_id[]"  value="{{$currencys->id}}" required/>

                <input type="hidden" class="form-control" name="plan_type[]"  value="annually" required/>
            <input type="number" class="form-control"  name="price[]" placeholder="{{$currencys->prefix}}" required/>
            </div>
            <div class="col-md-2">
                                <input type="hidden" class="form-control" name="currency_id[]"  value="{{$currencys->id}}" required/>

                                <input type="hidden" class="form-control" name="plan_type[]"  value="biennially" required/>
            <input type="number" class="form-control"  name="price[]" placeholder="{{$currencys->prefix}}" required/>
            </div>
            <div class="col-md-2">
                                <input type="hidden" class="form-control" name="currency_id[]"  value="{{$currencys->id}}" required/>

                <input type="hidden" class="form-control" name="plan_type[]"  value="triennially" required/>
            <input type="number" class="form-control"  name="price[]"  placeholder="{{$currencys->prefix}}" required/>
            </div>
            </div>
    @endforeach
   
   
    @else
    <div class="row">
    </div>
    @endif