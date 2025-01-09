<!--<option value="" >Select</option>-->
@foreach ($BillingCycles as $key => $BillingCycle)
    <option value="{{ $BillingCycle->id }}" >
        {{ $BillingCycle->prefix }}
        {{ number_format($BillingCycle->price, 2) }}
        {{ $BillingCycle->code }}
        @if ($BillingCycle->product_plan == 1 || $BillingCycle->payment_type == 1)
            {{ ucfirst($BillingCycle->plan_type) }}
            <!-- Capitalize the first letter of plan_type -->
        @elseif($BillingCycle->product_plan == 2 && $BillingCycle->payment_type == 2)
            {{ ucfirst($BillingCycle->plan_type) }}
            <!-- Capitalize the first letter of plan_type -->
        @elseif($BillingCycle->product_plan == 3 && $BillingCycle->payment_type == 3)
            {{ ucfirst($BillingCycle->plan_type) }}
            <!-- Capitalize the first letter of plan_type -->
        @endif
    </option>
@endforeach