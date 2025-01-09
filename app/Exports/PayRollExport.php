<?php
   
namespace App\Exports;
   
use App\Models\User;
use App\Models\PayRoll;
use Illuminate\Support\Collection;
 
use Maatwebsite\Excel\Concerns\FromCollection;
   
class PayRollExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

public function collection()
{

    $currentYear = date('Y');
    $currentMonth = date('m');
    $data = PayRoll::select('users.first_name',
                'pay_rolls.net_salary',
                'pay_rolls.basic', 
                'pay_rolls.hra', 
                'pay_rolls.conveyance', 
                'pay_rolls.medical_allowance', 
                'pay_rolls.leaves', 
                'pay_rolls.workingdays', 
                'pay_rolls.deduction', 
                'pay_rolls.allowance', 
                'pay_rolls.tds', 
                'pay_rolls.net_paid', 
                'pay_rolls.date'
            )
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->where('users.type', 4)
            ->whereYear('pay_rolls.date', $currentYear)
            ->whereMonth('pay_rolls.date', $currentMonth)
            ->groupBy('users.id')
            ->orderBy('pay_rolls.created_at', 'desc')
            ->get();

    // Add a title row
    $titleRow = ['Sr. No', 'Employee Name', 'Gross Salary', 'Basic (%) on GrossSalary', 'HRA (%) on Basic', 'Conveyance(Fixed Amount)', 'Medical(Fixed Amount)', 'Leaves', 'Working Days', 'Deduction','Other Allowance','TDS','Net Paid','Date'];

    // Add serial numbers to each row
    $dataArray = $data->toArray();
    foreach ($dataArray as $key => &$row) {
        array_unshift($row, $key + 1);
    }

    // Convert back to a collection
    $data = collect($dataArray);

    // Prepend the title row
    $data->prepend($titleRow);

    return $data;
}





}