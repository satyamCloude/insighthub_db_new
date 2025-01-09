<div class="mt-3">
    @if(count($addOnProducts) > 0)
        <h5>Addons:</h5>
        <div class="row">
        @foreach($addOnProducts as $key => $addon)
        <div class="mt-2 col-6">
            {{$key+1}}. <input type="checkbox" class="addon-checkbox" data-price="{{$addon->price}}" data-name="{{$addon->product_name}}"  data-tax-rate="{{$addon->rate}}" data-tax-name="{{$addon->tax_name}}" data-tax-id="{{$addon->tax_id}}" name="addon_id[]" value="{{$addon->id}}"> {{$addon->product_name}}
            <div class="px-5 mt-2">
                {!! $addon->description !!}
            </div>
            <input type="hidden" value="{{$addon->tax_id}}" name="tax_ids[]">
        </div>
        @endforeach
        </div>
    @endif
</div>
