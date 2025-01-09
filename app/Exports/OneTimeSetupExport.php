<?php
   
namespace App\Exports;
   
use App\Models\User;
use App\Models\OneTimeSetup;
use Illuminate\Support\Collection;
 
use Maatwebsite\Excel\Concerns\FromCollection;
   
class OneTimeSetupExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

public function collection()
{
    $data = OneTimeSetup::selectRaw('
        customer.first_name as customer_name,
        vender.first_name as vender_name,
        users.first_name,
        products.product_name,
        one_time_setups.host_domain_name,
        CASE
            WHEN one_time_setups.service_type = 1 THEN "Managed"
            WHEN one_time_setups.service_type = 2 THEN "Unmanaged"
            ELSE "Unknown"
        END as service_type,
        one_time_setups.first_payment,
        one_time_setups.billing_cycle,
        currencies.code,
        payment_methods.name,
        one_time_setups.signup_date,
        one_time_setups.next_due_date,
        one_time_setups.terminate_date,
        statuses.status
    ')
    ->join('statuses', 'statuses.id', 'one_time_setups.status')
    ->join('users as vender', 'vender.id', 'one_time_setups.vender_id')
    ->join('users as customer', 'customer.id', 'one_time_setups.customer_id')
    ->join('products', 'products.id', 'one_time_setups.product_id')
    ->join('currencies', 'currencies.id', 'one_time_setups.currency_id')
    ->join('users', 'users.id', 'one_time_setups.employee_id')
    ->join('payment_methods', 'payment_methods.id', 'one_time_setups.payment_method_id')
    ->whereNull('one_time_setups.deleted_at')
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