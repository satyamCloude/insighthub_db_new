<?php

namespace App\Exports;

use App\Models\User;
use App\Models\CompanyLogin;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class CompanyLoginExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = CompanyLogin::selectRaw('
            company_logins.company_name,
            company_logins.portal_login_url,
            company_logins.username,
            company_logins.password2,
            company_logins.authorised_person_name,
            company_logins.contact_no,
            company_logins.email_address,
            users.first_name,
            statuses.status,
            company_logins.created_at')
            ->join('users', 'users.id', 'company_logins.employee_id')
            ->join('statuses', 'statuses.id', 'company_logins.status')
            ->whereNull('company_logins.deleted_at')
            ->get();

        // Check if data is empty
        if ($data->isEmpty()) {
            // Handle the case where no data is retrieved
            return collect(); // or any other action you want to take
        }

        // Add a title row
        $titleRow = ['Sr. No', 'Company Name', 'Portal Login URL', 'User Name', 'Password', 'Authorised Person Name', 'Contact No.', 'Email Address', 'Employee Name', 'Status', 'Created At'];

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
