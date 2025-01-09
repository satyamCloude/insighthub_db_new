<?php

namespace App\Exports;

use App\Models\User;
use App\Models\CloudHosting;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class CloudHostingExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = CloudHosting::selectRaw('
            customer.first_name as customer_name,
            vender.first_name as vender_name,
            users.first_name,
            products.product_name,
            cloud_hostings.host_domain_name,
            server.product_name as server_name,
            CASE
                WHEN cloud_hostings.service_type = 1 THEN "Managed"
                WHEN cloud_hostings.service_type = 2 THEN "Unmanaged"
                ELSE "Unknown"
            END as service_type,
            cloud_hostings.first_payment,
            cloud_hostings.billing_cycle,
            cloud_hostings.username,
            currencies.code,
            payment_methods.name,
            cloud_hostings.signup_date,
            cloud_hostings.next_due_date,
            cloud_hostings.terminate_date,
            countrys.country_name,
            cloud_hostings.dc_username,
            cloud_hostings.dc_login_url,
            firewalls.firewall_serial_no,
            statuses.status
        ')
            ->join('statuses', 'statuses.id', 'cloud_hostings.status')
            ->join('users as vender', 'vender.id', 'cloud_hostings.vender_id')
            ->join('users as customer', 'customer.id', 'cloud_hostings.customer_id')
            ->join('products', 'products.id', 'cloud_hostings.product_id')
            ->join('currencies', 'currencies.id', 'cloud_hostings.currency_id')
            ->join('firewalls', 'firewalls.id', 'cloud_hostings.firewall_id')
            ->join('users', 'users.id', 'cloud_hostings.employee_id')
            ->join('products as server', 'server.id', 'cloud_hostings.server_name_id')
            ->join('countrys', 'countrys.country_id', 'cloud_hostings.dc_location')
            ->join('payment_methods', 'payment_methods.id', 'cloud_hostings.payment_method_id')
            ->whereNull('cloud_hostings.deleted_at')
            ->get();

        // Check if data is empty
        if ($data->isEmpty()) {
            // Handle the case where no data is retrieved
            return collect(); // or any other action you want to take
        }

        // Add a title row
        $titleRow = ['Sr. No', 'Customer Name', 'Vender Name', 'Employee Name', 'Product Name', 'Host/Domain Name', 'Server Name', 'Service Type', 'First Payment', 'Billing Cycle', 'Username', 'Currency', 'Payment Method', 'Signup Date', 'Next Due Date', 'Terminate Date', 'DC Location', 'DC Username', 'DC login Url', 'Firewall', 'Status'];

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
