<?php

namespace App\Exports;

use App\Models\User;
use App\Models\DedicatedServer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class DedicatedServerExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = DedicatedServer::selectRaw('
            customer.first_name as customer_name,
            vender.first_name as vender_name,
            users.first_name,
            products.product_name,
            dedicated_servers.host_domain_name,
            CASE
                WHEN dedicated_servers.service_type = 1 THEN "Managed"
                WHEN dedicated_servers.service_type = 2 THEN "Unmanaged"
                ELSE "Unknown"
            END as service_type,
            dedicated_servers.first_payment,
            dedicated_servers.billing_cycle,
            currencies.code,
            payment_methods.name,
            dedicated_servers.signup_date,
            dedicated_servers.next_due_date,
            dedicated_servers.terminate_date,
            countrys.country_name,
            firewalls.firewall_serial_no,
            statuses.status
        ')
            ->join('statuses', 'statuses.id', 'dedicated_servers.status')
            ->join('users as vender', 'vender.id', 'dedicated_servers.vender_id')
            ->join('users as customer', 'customer.id', 'dedicated_servers.customer_id')
            ->join('products', 'products.id', 'dedicated_servers.product_id')
            ->join('currencies', 'currencies.id', 'dedicated_servers.currency_id')
            ->join('firewalls', 'firewalls.id', 'dedicated_servers.firewall_serial_id')
            ->join('users', 'users.id', 'dedicated_servers.employee_id')
            ->join('countrys', 'countrys.country_id', 'dedicated_servers.dc_location')
            ->join('payment_methods', 'payment_methods.id', 'dedicated_servers.payment_method_id')
            ->whereNull('dedicated_servers.deleted_at')
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
