<?php
   
namespace App\Exports;
   
use App\Models\User;
use App\Models\Licenses;
use Illuminate\Support\Collection;
 
use Maatwebsite\Excel\Concerns\FromCollection;
   
class LicensesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

public function collection()
{
    $data = Licenses::selectRaw('
        customer.first_name as customer_name,
        vender.first_name as vender_name,
        users.first_name,
        products.product_name,
        licenses.host_domain_name,
        CASE
            WHEN licenses.service_type = 1 THEN "Managed"
            WHEN licenses.service_type = 2 THEN "Unmanaged"
            ELSE "Unknown"
        END as service_type,
        licenses.first_payment,
        licenses.billing_cycle,
        currencies.code,
        payment_methods.name,
        licenses.signup_date,
        licenses.next_due_date,
        licenses.terminate_date,
        statuses.status
    ')
    ->join('statuses', 'statuses.id', 'licenses.status')
    ->join('users as vender', 'vender.id', 'licenses.vender_id')
    ->join('users as customer', 'customer.id', 'licenses.customer_id')
    ->join('products', 'products.id', 'licenses.product_id')
    ->join('currencies', 'currencies.id', 'licenses.currency_id')
    ->join('users', 'users.id', 'licenses.employee_id')
    ->join('payment_methods', 'payment_methods.id', 'licenses.payment_method_id')
    ->whereNull('licenses.deleted_at')
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