<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Azure;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class AzureExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = Azure::selectRaw('
            customer.first_name as customer_name,
            vender.first_name as vender_name,
            users.first_name,
            products.product_name,
            azures.host_domain_name,
            azures.hosting_control_panel,
            azures.control_panel_user_name,
            azures.azure_account_Id,
            azures.azure_username,
            CASE
                WHEN azures.service_type = 1 THEN "Managed"
                WHEN azures.service_type = 2 THEN "Unmanaged"
                ELSE "Unknown"
            END as service_type,
            azures.first_payment,
            azures.billing_cycle,
            payment_methods.name,
            azures.signup_date,
            azures.next_due_date,
            azures.terminate_date,
            statuses.status
        ')
            ->join('statuses', 'statuses.id', 'azures.status')
            ->join('users as vender', 'vender.id', 'azures.vender_id')
            ->join('users as customer', 'customer.id', 'azures.customer_id')
            ->join('products', 'products.id', 'azures.product_id')
            ->join('users', 'users.id', 'azures.employee_id')
            ->join('payment_methods', 'payment_methods.id', 'azures.payment_method_id')
            ->whereNull('azures.deleted_at')
            ->get();

        // Check if data is empty
        if ($data->isEmpty()) {
            // Handle the case where no data is retrieved
            return collect(); // or any other action you want to take
        }

        // Add a title row
        $titleRow = ['Sr. No', 'Customer Name', 'Vender Name', 'Employee Name', 'Product Name', 'Host/Domain Name', 'Host Control Panel', 'Control Panel UserName', 'Azure ACCOUNT ID', 'Azure User name', 'Service Type', 'First Payment', 'Billing Cycle', 'Payment Method', 'Signup Date', 'Next Due Date', 'Terminate Date', 'Status'];

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
