<?php

namespace App\Exports;

use App\Models\User;
use App\Models\GoogleWorkSpace;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class GoogleWorkSpaceExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = GoogleWorkSpace::selectRaw('
            customer.first_name as customer_name,
            vender.first_name as vender_name,
            users.first_name,
            products.product_name,
            google_work_spaces.domain_name_tenant_id,
            CASE
                WHEN google_work_spaces.service_type = 1 THEN "Managed"
                WHEN google_work_spaces.service_type = 2 THEN "Unmanaged"
                ELSE "Unknown"
            END as service_type,
            google_work_spaces.first_payment,
            google_work_spaces.billing_cycle,
            payment_methods.name,
            google_work_spaces.signup_date,
            google_work_spaces.next_due_date,
            google_work_spaces.terminate_date,
            statuses.status
        ')
            ->join('statuses', 'statuses.id', 'google_work_spaces.status')
            ->join('users as vender', 'vender.id', 'google_work_spaces.vender_id')
            ->join('users as customer', 'customer.id', 'google_work_spaces.customer_id')
            ->join('products', 'products.id', 'google_work_spaces.product_id')
            ->join('users', 'users.id', 'google_work_spaces.employee_id')
            ->join('payment_methods', 'payment_methods.id', 'google_work_spaces.payment_method_id')
            ->whereNull('google_work_spaces.deleted_at')
            ->get();

        // Check if data is empty
        if ($data->isEmpty()) {
            // Handle the case where no data is retrieved
            return collect(); // or any other action you want to take
        }

        // Add a title row
        $titleRow = [
            'Sr. No',
            'Customer Name',
            'Vender Name',
            'Employee Name',
            'Product Name',
            'Domain Name / Tenant ID',
            'Service Type',
            'First Payment',
            'Billing Cycle',
            'Payment Method',
            'Signup Date',
            'Next Due Date',
            'Terminate Date',
            'Status'
        ];

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
