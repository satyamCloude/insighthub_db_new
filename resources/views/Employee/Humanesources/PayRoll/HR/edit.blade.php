<div class="modal-dialog modal-lg">
    <form class="modal-content" action="{{url('admin/PayRoll/update/'.$PayRoll->id)}}" method="post">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="backDropModalTitle">PayRoll</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4 class="text-center">@if($User && $User->first_name){{$User->first_name}}@endif</h4>
        <hr>
        <div class="row g-2 mb-4">
          <div class="col mb-0">
            <label for="net_salary" class="form-label">Gross Salary</label>
            <input type="text" id="net_salary"  @if($PayRoll && $PayRoll->net_salary) value="{{$PayRoll->net_salary}}" @endif name="net_salary" readonly class="form-control">
          </div>
          <div class="col mb-0">
            <label for="basic" class="form-label">Basic (%) on GrossSalary</label>
            <input type="number" @if($PayRoll && $PayRoll->basic) value="{{$PayRoll->basic}}" @endif  name="basic" readonly class="form-control">
          </div>
        </div>
        <div class="row g-2 mb-4">
          <div class="col mb-0">
            <label for="hra" class="form-label">HRA (%) on Basic</label>
            <input type="text"  @if($PayRoll && $PayRoll->hra) value="{{$PayRoll->hra}}" @endif name="hra" readonly class="form-control">
          </div>
          <div class="col mb-0">
            <label for="conveyance" class="form-label">Conveyance(Fixed Amount)</label>
            <input type="number" @if($PayRoll && $PayRoll->conveyance) value="{{$PayRoll->conveyance}}" @endif  name="conveyance" readonly class="form-control">
          </div>
          <div class="col mb-0">
            <label for="medical_allowance" class="form-label">Medical(Fixed Amount)</label>
            <input type="text"  @if($PayRoll && $PayRoll->medical_allowance) value="{{$PayRoll->medical_allowance}}" @endif name="medical_allowance" readonly class="form-control">
          </div>
        </div>
        <div class="row g-2 mb-4">
          <div class="col mb-0">
            <label for="leaves" class="form-label">Leaves</label>
            <input type="text"  @if($PayRoll && $PayRoll->leaves) value="{{$PayRoll->leaves}}" @endif name="leaves" class="form-control">
          </div>
          <div class="col mb-0">
            <label for="workingdays" class="form-label">Working Days</label>
            <input type="number" @if($PayRoll && $PayRoll->workingdays) value="{{$PayRoll->workingdays}}" @endif  name="workingdays" class="form-control">
          </div>
        </div>
        <div class="row g-2 mb-4">
          <div class="col mb-0">
            <label for="deduction" class="form-label">Deduction</label>
            <input type="number" id="deduction" @if($PayRoll && $PayRoll->deduction) value="{{$PayRoll->deduction}}" @endif name="deduction" class="form-control">
          </div>
          <div class="col mb-0">
            <label for="allowance" class="form-label">Other Allowance</label>
            <input type="number" id="allowance" @if($PayRoll && $PayRoll->allowance) value="{{$PayRoll->allowance}}" @endif  name="allowance" class="form-control">
          </div>
        </div>
        <div class="row g-2 mb-4">
          <div class="col mb-0">
            <label for="tds" class="form-label">TDS</label>
            <input type="text" id="tds"  @if($PayRoll && $PayRoll->tds) value="{{$PayRoll->tds}}" @endif name="tds" class="form-control">
          </div>
          <div class="col mb-0">
            <label for="net_paid" class="form-label">Net Paid</label>
            <input type="number" readonly id="net_paid" @if($PayRoll && $PayRoll->net_paid) value="{{$PayRoll->net_paid}}" @endif  name="net_paid" class="form-control">
          </div>
        </div>
        
      <h4>Total Net Paid For This Month: @if($PayRoll && $PayRoll->net_paid) {{$PayRoll->net_paid}} @endif </h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-label-danger waves-effect" data-bs-dismiss="modal">
          Close
        </button>
        <button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
      </div>
    </form>
</div>
<script type="text/javascript">
$(document).ready(function() {
       // Function to parse value as a float or default to 0 if not a valid number
        function parseAsFloat(value) {
            var parsedValue = parseFloat(value);
            return isNaN(parsedValue) ? 0 : parsedValue;
        }
    $('#tds').keyup(function(){
        var netSalary = parseAsFloat($('#net_salary').val());
        var net_paid = parseAsFloat($('#net_paid').val());
        var tds = parseAsFloat($('#tds').val());
        var allowance = parseAsFloat($('#allowance').val());
        var deduction = parseAsFloat($('#deduction').val());
       netpad  = (tds + deduction) - allowance; 
       netSalary  = netSalary - netpad; 
       $('#net_paid').val(netSalary);
    });

    $('#allowance').keyup(function(){
        var netSalary = parseAsFloat($('#net_salary').val());
        var net_paid = parseAsFloat($('#net_paid').val());
        var tds = parseAsFloat($('#tds').val());
        var allowance = parseAsFloat($('#allowance').val());
        var deduction = parseAsFloat($('#deduction').val());
       netpad  = (tds + deduction) - allowance; 
       netSalary  = netSalary - netpad; 
       $('#net_paid').val(netSalary);
    });

     $('#deduction').keyup(function(){
        var netSalary = parseAsFloat($('#net_salary').val());
        var net_paid = parseAsFloat($('#net_paid').val());
        var tds = parseAsFloat($('#tds').val());
        var allowance = parseAsFloat($('#allowance').val());
        var deduction = parseAsFloat($('#deduction').val());
       netpad  = (tds + deduction) - allowance; 
       netSalary  = netSalary - netpad; 
       $('#net_paid').val(netSalary);
    });
});
</script>