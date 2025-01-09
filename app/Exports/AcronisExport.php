<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Acronis;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class AcronisExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = Acronis::selectRaw('
            customer.first_name as customer_name,
            vender.first_name as vender_name,
            users.first_name,
            products.product_name,
            acronis.host_domain_name,
            CASE
                WHEN acronis.service_type = 1 THEN "Managed"
                WHEN acronis.service_type = 2 THEN "Unmanaged"
                ELSE "Unknown"
            END as service_type,
            acronis.first_payment,
            acronis.billing_cycle,
            currencies.code,
            payment_methods.name,
            acronis.signup_date,
            acronis.next_due_date,
            acronis.terminate_date,
            statuses.status
        ')
            ->join('statuses', 'statuses.id', 'acronis.status')
            ->join('users as vender', 'vender.id', 'acronis.vender_id')
            ->join('users as customer', 'customer.id', 'acronis.customer_id')
            ->join('products', 'products.id', 'acronis.product_id')
            ->join('currencies', 'currencies.id', 'acronis.currency_id')
            ->join('users', 'users.id', 'acronis.employee_id')
            ->join('payment_methods', 'payment_methods.id', 'acronis.payment_method_id')
            ->whereNull('acronis.deleted_at')
            ->get();

        // Add a title row
        $titleRow = ['Sr. No', 'Customer Name', 'Vender Name', 'Employee Name', 'Product Name', 'Host/Domain Name', 'Service Type', 'First Payment', 'Billing Cycle', 'Currency', 'Payment Method', 'Signup Date', 'Next Due Date', 'Terminate Date', 'Status'];

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
