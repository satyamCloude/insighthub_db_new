<?php
   
namespace App\Exports;
   
use App\Models\User;
use App\Models\MicrosoftOffice365;
use Illuminate\Support\Collection;
 
use Maatwebsite\Excel\Concerns\FromCollection;
   
class MicrosoftOffice365Export implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

public function collection()
{
    $data = MicrosoftOffice365::selectRaw('
        customer.first_name as customer_name,
        vender.first_name as vender_name,
        users.first_name,
        products.product_name,
        microsoft_office365s.domain_name_tenant_id,
        CASE
            WHEN microsoft_office365s.service_type = 1 THEN "Managed"
            WHEN microsoft_office365s.service_type = 2 THEN "Unmanaged"
            ELSE "Unknown"
        END as service_type,
        microsoft_office365s.first_payment,
        microsoft_office365s.billing_cycle,
        payment_methods.name,
        microsoft_office365s.signup_date,
        microsoft_office365s.next_due_date,
        microsoft_office365s.terminate_date,
        statuses.status
    ')
    ->join('statuses', 'statuses.id', 'microsoft_office365s.status')
    ->join('users as vender', 'vender.id', 'microsoft_office365s.vender_id')
    ->join('users as customer', 'customer.id', 'microsoft_office365s.customer_id')
    ->join('products', 'products.id', 'microsoft_office365s.product_id')
    ->join('users', 'users.id', 'microsoft_office365s.employee_id')
    ->join('payment_methods', 'payment_methods.id', 'microsoft_office365s.payment_method_id')
    ->whereNull('microsoft_office365s.deleted_at')
    ->get();

    // Check if data is empty
    if ($data->isEmpty()) {
        // Handle the case where no data is retrieved
        return collect(); // or any other action you want to take
    }

    // Add a title row
    $titleRow = ['Sr. No', 'Customer Name', 'Vender Name', 'Employee Name', 'Product Name', 'Domain Name / Tenant ID','Service Type','First Payment', 'Billing Cycle', 'Payment Method', 'Signup Date', 'Next Due Date', 'Terminate Date', 'Status'];

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