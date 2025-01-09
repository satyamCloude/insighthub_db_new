<?php
   
namespace App\Exports;
   
use App\Models\User;
use App\Models\Other;
use Illuminate\Support\Collection;
 
use Maatwebsite\Excel\Concerns\FromCollection;
   
class OtherExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

public function collection()
{
    $data = Other::selectRaw('
        customer.first_name as customer_name,
        vender.first_name as vender_name,
        users.first_name,
        products.product_name,
        others.host_domain_name,
        CASE
            WHEN others.service_type = 1 THEN "Managed"
            WHEN others.service_type = 2 THEN "Unmanaged"
            ELSE "Unknown"
        END as service_type,
        others.first_payment,
        others.billing_cycle,
        currencies.code,
        payment_methods.name,
        others.signup_date,
        others.next_due_date,
        others.terminate_date,
        statuses.status
    ')
    ->join('statuses', 'statuses.id', 'others.status')
    ->join('users as vender', 'vender.id', 'others.vender_id')
    ->join('users as customer', 'customer.id', 'others.customer_id')
    ->join('products', 'products.id', 'others.product_id')
    ->join('currencies', 'currencies.id', 'others.currency_id')
    ->join('users', 'users.id', 'others.employee_id')
    ->join('payment_methods', 'payment_methods.id', 'others.payment_method_id')
    ->whereNull('others.deleted_at')
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