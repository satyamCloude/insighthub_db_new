<?php

namespace App\Exports;

use App\Models\SSLCertificate;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class SSLCertificateExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Query to retrieve SSL certificate data and join related tables
        $data = SSLCertificate::selectRaw('
            customer.first_name as customer_name,
            vender.first_name as vender_name,
            users.first_name,
            products.product_name,
            s_s_l_certificates.host_domain_name,
            CASE
                WHEN s_s_l_certificates.service_type = 1 THEN "Managed"
                WHEN s_s_l_certificates.service_type = 2 THEN "Unmanaged"
                ELSE "Unknown"
            END as service_type,
            s_s_l_certificates.first_payment,
            s_s_l_certificates.billing_cycle,
            currencies.code,
            payment_methods.name,
            s_s_l_certificates.signup_date,
            s_s_l_certificates.next_due_date,
            s_s_l_certificates.terminate_date,
            statuses.status
        ')
        ->join('statuses', 'statuses.id', 's_s_l_certificates.status')
        ->join('users as vender', 'vender.id', 's_s_l_certificates.vender_id')
        ->join('users as customer', 'customer.id', 's_s_l_certificates.customer_id')
        ->join('products', 'products.id', 's_s_l_certificates.product_id')
        ->join('currencies', 'currencies.id', 's_s_l_certificates.currency_id')
        ->join('users', 'users.id', 's_s_l_certificates.employee_id')
        ->join('payment_methods', 'payment_methods.id', 's_s_l_certificates.payment_method_id')
        ->whereNull('s_s_l_certificates.deleted_at')
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
