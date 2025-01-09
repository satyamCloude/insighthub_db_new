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
            @php
                $matchingPrice = null;
                $pricing = DB::table('product_pricing')
                ->where('currency_id',$currencys->id)
                ->where('product_plan',2)
                ->where('product_id',$p_id)
                ->where('deleted_at',null)
                ->first();
            @endphp
            @if(isset($price))
                @foreach($price as $priceItem)
                @if($currencys->id == $priceItem['currency_id'])
                    @php
                        $matchingPrice = $priceItem['price'];
                        break; 
                    @endphp
                @endif
                @endforeach
            @endif
            
            
            @if($pricing)
                <div class="row mt-3">
                    <div class="col-md-2">
                        <label for="INR "class="form-label mt-3">{{$currencys->name}}</label>
                    </div>
                    <div class="col-md-2">
                        <!-- <input type="hidden" class="form-control" name="product_plan[]"  value="{{$payment_type}}" required/> -->
                        <input type="hidden" class="form-control" name="plan_type[]"  value="{{$plan_type}}" required/>
                        <input type="hidden" class="form-control" name="currency_id[]"  value="{{$currencys->id}}" required/>
                        <input type="number" class="form-control" name="price[]" value="{{$pricing->price}}" placeholder="{{$currencys->prefix}}" />
                    </div>
                </div>
            @else
                <div class="row mt-3">
                    <div class="col-md-2">
                        <label for="INR "class="form-label mt-3">{{$currencys->name}}</label>
                    </div>
                    <div class="col-md-2">
        
                        <!-- <input type="hidden" class="form-control" name="product_plan[]"  value="{{$payment_type}}" required/> -->
                        <input type="hidden" class="form-control" name="plan_type[]"  value="{{$plan_type}}" required/>
                        <input type="hidden" class="form-control" name="currency_id[]"  value="{{$currencys->id}}" required/>
                        <input type="number" class="form-control" name="price[]" value="{{ $matchingPrice ? $matchingPrice : '' }}"  placeholder="{{$currencys->prefix}}"/>

                    </div>
                </div>
            @endif
        @endforeach
@elseif($payment_type == 3)
    <div class="mb-4 paymenttype">
        <!-- Header Row -->
        <div class="row">
            <div class="col-md-1 bg-success">
                <label for="Currency" class="form-label">Currency</label>
            </div>
            <div class="col-md-1 bg-success">
                <label for="Hourly" class="form-label">Hourly</label>
            </div>
            <div class="col-md-1 bg-success">
                <label for="Monthly" class="form-label">Monthly</label>
            </div>
            <div class="col-md-1 bg-success">
                <label for="Quarterly" class="form-label">Quarterly</label>
            </div>
            <div class="col-md-2 bg-success">
                <label for="Semi-Annually" class="form-label">Semi-Annually</label>
            </div>
            <div class="col-md-2 bg-success">
                <label for="Annually" class="form-label">Annually</label>
            </div>
            <div class="col-md-2 bg-success">
                <label for="Biennially" class="form-label">Biennially</label>
            </div>
            <div class="col-md-2 bg-success">
                <label for="Triennially" class="form-label">Triennially</label>
            </div>
        </div>

        @foreach($currency as $currencys)
        @php
            // Fetch all pricings for the current currency and product
            $pricings = DB::table('product_pricing')
                ->where('currency_id', $currencys->id)
                ->where('product_plan', 3)
                ->where('product_id', $p_id)
                ->where('deleted_at', null)
                ->get();

            // Create an associative array for easy lookup
            $pricingMap = $pricings->keyBy('plan_type');
        @endphp
        @if(count($pricings) > 0)
        <div class="row mt-3">
            <div class="col-md-1" style="padding-left: 0rem;">
                <label for="Currency" class="form-label mt-3">{{ $currencys->name }}</label>
            </div>
            @foreach(['hourly', 'monthly', 'quartely', 'semiannually', 'annually', 'biennially', 'triennially'] as $planType)
                @php
                    $pricing = $pricingMap->get($planType);
                                        $isChecked = $pricing && $pricing->price > 0 ? 'checked' : '';

                @endphp
            <div class="col-md-1" style="padding-left: 0rem;">
                <input type="hidden" class="form-control" name="currency_id[]" value="{{ $currencys->id }}" required />
                <input type="hidden" class="form-control" name="plan_type[]" value="{{ $planType }}" required />
                <input type="number" class="form-control" name="price[]" value="{{ $pricing->price ?? '' }}" style="padding-right: 0px; padding-left: 0px;" placeholder="{{ $currencys->prefix }}" />
                <input type="checkbox" name="selected_plans[{{ $currencys->id }}][]" value="{{ $planType }}" {{ $isChecked }} />

            </div>
            @endforeach


    </div>


        @else
    <div class="row mt-3">
        <div class="col-md-1" style="padding-left: 0rem;">
            <label for="INR" class="form-label mt-3">{{$currencys->name}}</label>
        </div>
        <div class="col-md-1" style="padding-left: 0rem;">
            <input type="hidden" class="form-control" name="currency_id[]" value="{{$currencys->id}}" required/>
            <input type="hidden" class="form-control" name="plan_type[]" value="hourly" required/>
            <input type="number" class="form-control" style="padding-right: 0px; padding-left: 0px;" name="price[]" placeholder="{{$currencys->prefix}}" />
            <input type="checkbox" name="selected_plans[{{$currencys->id}}][]" value="hourly" />
        </div>
        <div class="col-md-1 px-0">
            <input type="hidden" class="form-control" name="currency_id[]" value="{{$currencys->id}}" required/>
            <input type="hidden" class="form-control" name="plan_type[]" value="monthly" required/>
            <input type="number" class="form-control" style="padding-right: 0px; padding-left: 0px;" name="price[]"  value="0" placeholder="{{$currencys->prefix}}" />
            <input type="checkbox" name="selected_plans[{{$currencys->id}}][]" value="monthly" checked />
        </div>
        <div class="col-md-1" style="padding-right: 0rem;">
            <input type="hidden" class="form-control" name="currency_id[]" value="{{$currencys->id}}" required/>
            <input type="hidden" class="form-control" name="plan_type[]" value="quartely" required/>
            <input type="number" class="form-control" style="padding-right: 0px; padding-left: 0px;" name="price[]" placeholder="{{$currencys->prefix}}" />
            <input type="checkbox" name="selected_plans[{{$currencys->id}}][]" value="quartely" />
        </div>
        <div class="col-md-2">
            <input type="hidden" class="form-control" name="currency_id[]" value="{{$currencys->id}}" required/>
            <input type="hidden" class="form-control" name="plan_type[]" value="semiannually" required/>
            <input type="number" class="form-control" name="price[]"  style="padding-right: 0px; padding-left: 0px;" placeholder="{{$currencys->prefix}}" />
            <input type="checkbox" name="selected_plans[{{$currencys->id}}][]" value="semiannually" />
        </div>
        <div class="col-md-2">
            <input type="hidden" class="form-control" name="currency_id[]" value="{{$currencys->id}}" required/>
            <input type="hidden" class="form-control" name="plan_type[]" value="annually" required/>
            <input type="number" class="form-control" name="price[]" style="padding-right: 0px; padding-left: 0px;" placeholder="{{$currencys->prefix}}" />
            <input type="checkbox" name="selected_plans[{{$currencys->id}}][]" value="annually" />
        </div>
        <div class="col-md-2">
            <input type="hidden" class="form-control" name="currency_id[]" value="{{$currencys->id}}" required/>
            <input type="hidden" class="form-control" name="plan_type[]" value="biennially" required/>
            <input type="number" class="form-control" name="price[]"  style="padding-right: 0px; padding-left: 0px;" placeholder="{{$currencys->prefix}}" />
            <input type="checkbox" name="selected_plans[{{$currencys->id}}][]" value="biennially" />
        </div>
        <div class="col-md-2">
            <input type="hidden" class="form-control" name="currency_id[]" value="{{$currencys->id}}" required/>
            <input type="hidden" class="form-control" name="plan_type[]" value="triennially" required/>
            <input type="number" class="form-control" name="price[]"  style="padding-right: 0px; padding-left: 0px;" placeholder="{{$currencys->prefix}}" />
            <input type="checkbox" name="selected_plans[{{$currencys->id}}][]" value="triennially" />
        </div>
    </div>
@endif

    @endforeach
@else
    <div class="row"></div>
@endif