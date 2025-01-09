<?php

namespace App\Exports;

use App\Models\User;
use App\Models\CloudServices;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class CloudServicesExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = CloudServices::selectRaw('
            customer.first_name as customer_name,
            vender.first_name as vender_name,
            users.first_name,
            products.product_name,
            cloud_services.host_domain_name,
            CASE
                WHEN cloud_services.service_type = 1 THEN "Managed"
                WHEN cloud_services.service_type = 2 THEN "Unmanaged"
                ELSE "Unknown"
            END as service_type,
            cloud_services.first_payment,
            cloud_services.billing_cycle,
            currencies.code,
            payment_methods.name,
            cloud_services.signup_date,
            cloud_services.next_due_date,
            cloud_services.terminate_date,
            countrys.country_name,
            firewalls.firewall_serial_no,
            statuses.status
        ')
            ->join('statuses', 'statuses.id', 'cloud_services.status')
            ->join('users as vender', 'vender.id', 'cloud_services.vender_id')
            ->join('users as customer', 'customer.id', 'cloud_services.customer_id')
            ->join('products', 'products.id', 'cloud_services.product_id')
            ->join('currencies', 'currencies.id', 'cloud_services.currency_id')
            ->join('firewalls', 'firewalls.id', 'cloud_services.firewall_serial_id')
            ->join('users', 'users.id', 'cloud_services.employee_id')
            ->join('countrys', 'countrys.country_id', 'cloud_services.dc_location')
            ->join('payment_methods', 'payment_methods.id', 'cloud_services.payment_method_id')
            ->whereNull('cloud_services.deleted_at')
            ->get();

        // Check if data is empty
        if ($data->isEmpty()) {
            // Handle the case where no data is retrieved
            return collect(); // or any other action you want to take
        }

        // Add a title row
        $titleRow = ['Sr. No', 'Customer Name', 'Vender Name', 'Employee Name', 'Product Name', 'Host/Domain Name', 'Service Type', 'First Payment', 'Billing Cycle', 'Currency', 'Payment Method', 'Signup Date', 'Next Due Date', 'Terminate Date', 'DC Location', 'Firewall', 'Status'];

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
