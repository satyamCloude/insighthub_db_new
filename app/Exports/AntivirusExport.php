<?php
   
namespace App\Exports;
   
use App\Models\User;
use App\Models\Antivirus;
use Illuminate\Support\Collection;
 
use Maatwebsite\Excel\Concerns\FromCollection;
   
class AntivirusExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

public function collection()
{
    $data = Antivirus::selectRaw('
        customer.first_name as customer_name,
        vender.first_name as vender_name,
        users.first_name,
        products.product_name,
        antiviri.host_domain_name,
        CASE
            WHEN antiviri.service_type = 1 THEN "Managed"
            WHEN antiviri.service_type = 2 THEN "Unmanaged"
            ELSE "Unknown"
        END as service_type,
        antiviri.first_payment,
        antiviri.billing_cycle,
        currencies.code,
        payment_methods.name,
        antiviri.signup_date,
        antiviri.next_due_date,
        antiviri.terminate_date,
        statuses.status
    ')
    ->join('statuses', 'statuses.id', 'antiviri.status')
    ->join('users as vender', 'vender.id', 'antiviri.vender_id')
    ->join('users as customer', 'customer.id', 'antiviri.customer_id')
    ->join('products', 'products.id', 'antiviri.product_id')
    ->join('currencies', 'currencies.id', 'antiviri.currency_id')
    ->join('users', 'users.id', 'antiviri.employee_id')
    ->join('payment_methods', 'payment_methods.id', 'antiviri.payment_method_id')
    ->whereNull('antiviri.deleted_at')
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