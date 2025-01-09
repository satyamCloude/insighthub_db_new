<?php
   
namespace App\Exports;
   
use App\Models\User;
use App\Models\TsPlus;
use Illuminate\Support\Collection;
 
use Maatwebsite\Excel\Concerns\FromCollection;
   
class TsPlusExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

public function collection()
{
    $data = TsPlus::selectRaw('
        customer.first_name as customer_name,
        vender.first_name as vender_name,
        users.first_name,
        products.product_name,
        ts_pluses.host_domain_name,
        CASE
            WHEN ts_pluses.service_type = 1 THEN "Managed"
            WHEN ts_pluses.service_type = 2 THEN "Unmanaged"
            ELSE "Unknown"
        END as service_type,
        ts_pluses.first_payment,
        ts_pluses.billing_cycle,
        currencies.code,
        payment_methods.name,
        ts_pluses.signup_date,
        ts_pluses.next_due_date,
        ts_pluses.terminate_date,
        statuses.status
    ')
    ->join('statuses', 'statuses.id', 'ts_pluses.status')
    ->join('users as vender', 'vender.id', 'ts_pluses.vender_id')
    ->join('users as customer', 'customer.id', 'ts_pluses.customer_id')
    ->join('products', 'products.id', 'ts_pluses.product_id')
    ->join('currencies', 'currencies.id', 'ts_pluses.currency_id')
    ->join('users', 'users.id', 'ts_pluses.employee_id')
    ->join('payment_methods', 'payment_methods.id', 'ts_pluses.payment_method_id')
    ->whereNull('ts_pluses.deleted_at')
    ->get();

    // Add a title row
    $titleRow = ['Sr. No', 'Customer Name', 'Vender Name', 'Employee Name','Product Name','Host/Domain Name', 'Service Type', 'First Payment', 'Billing Cycle', 'Currency', 'Payment Method', 'Signup Date', 'Next Due Date', 'Terminate Date', 'Status'];

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