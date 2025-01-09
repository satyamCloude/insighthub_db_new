<?php

namespace App\Exports;

use App\Models\Quotes;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class QuotesExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = Quotes::selectRaw('
            quotes.id as "Sr. No",
            quotes.subject as "Subject",
            quotes.date_created as "Date Created",
            quotes.status as "Status",
            quotes.valid_until as "Valid Until",
            quotes.customer_name as "Customer Name",
            quotes.first_name as "First Name",
            quotes.last_name as "Last Name",
            quotes.email as "Email",
            quotes.phone_number as "Phone Number",
            quotes.created_at as "Created At"
        ')
            ->leftJoin('company_logins', 'company_logins.id', '=', 'quotes.company_id')
            ->whereNull('quotes.deleted_at')
            ->get();

        // Add a title row
        $titleRow = [
            'Sr. No',
            'Subject',
            'Date Created',
            'Status',
            'Valid Until',
            'Customer Name',
            'First Name',
            'Last Name',
            'Email',
            'Phone Number',
            'Created At'
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
