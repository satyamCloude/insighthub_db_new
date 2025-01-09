<?php
   
namespace App\Exports;
   
use App\Models\User;
use App\Models\MonthelySetup;
use Illuminate\Support\Collection;
 
use Maatwebsite\Excel\Concerns\FromCollection;
   
class MonthelySetupExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

public function collection()
{
    $data = MonthelySetup::selectRaw('
        customer.first_name as customer_name,
        vender.first_name as vender_name,
        users.first_name,
        products.product_name,
        monthely_setups.host_domain_name,
        CASE
            WHEN monthely_setups.service_type = 1 THEN "Managed"
            WHEN monthely_setups.service_type = 2 THEN "Unmanaged"
            ELSE "Unknown"
        END as service_type,
        monthely_setups.first_payment,
        monthely_setups.billing_cycle,
        currencies.code,
        payment_methods.name,
        monthely_setups.signup_date,
        monthely_setups.next_due_date,
        monthely_setups.terminate_date,
        statuses.status
    ')
    ->join('statuses', 'statuses.id', 'monthely_setups.status')
    ->join('users as vender', 'vender.id', 'monthely_setups.vender_id')
    ->join('users as customer', 'customer.id', 'monthely_setups.customer_id')
    ->join('products', 'products.id', 'monthely_setups.product_id')
    ->join('currencies', 'currencies.id', 'monthely_setups.currency_id')
    ->join('users', 'users.id', 'monthely_setups.employee_id')
    ->join('payment_methods', 'payment_methods.id', 'monthely_setups.payment_method_id')
    ->whereNull('monthely_setups.deleted_at')
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