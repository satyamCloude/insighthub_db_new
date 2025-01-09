<?php

namespace App\Exports;

use App\Models\User;
use App\Models\AwsService;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class AwsServicerExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = AwsService::selectRaw('
            customer.first_name as customer_name,
            vender.first_name as vender_name,
            users.first_name,
            products.product_name,
            aws_services.host_domain_name,
            aws_services.hosting_control_panel,
            aws_services.control_panel_user_name,
            aws_services.aws_account_Id,
            aws_services.aws_username,
            CASE
                WHEN aws_services.service_type = 1 THEN "Managed"
                WHEN aws_services.service_type = 2 THEN "Unmanaged"
                ELSE "Unknown"
            END as service_type,
            aws_services.first_payment,
            aws_services.billing_cycle,
            payment_methods.name,
            aws_services.signup_date,
            aws_services.next_due_date,
            aws_services.terminate_date,
            statuses.status
        ')
            ->join('statuses', 'statuses.id', 'aws_services.status')
            ->join('users as vender', 'vender.id', 'aws_services.vender_id')
            ->join('users as customer', 'customer.id', 'aws_services.customer_id')
            ->join('products', 'products.id', 'aws_services.product_id')
            ->join('users', 'users.id', 'aws_services.employee_id')
            ->join('payment_methods', 'payment_methods.id', 'aws_services.payment_method_id')
            ->whereNull('aws_services.deleted_at')
            ->get();

        // Check if data is empty
        if ($data->isEmpty()) {
            // Handle the case where no data is retrieved
            return collect(); // or any other action you want to take
        }

        // Add a title row
        $titleRow = ['Sr. No', 'Customer Name', 'Vender Name', 'Employee Name', 'Product Name', 'Host/Domain Name', 'Host Control Panel', 'Control Panel UserName', 'AWS ACCOUNT ID', 'AWS User name', 'Service Type', 'First Payment', 'Billing Cycle', 'Payment Method', 'Signup Date', 'Next Due Date', 'Terminate Date', 'Status'];

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
