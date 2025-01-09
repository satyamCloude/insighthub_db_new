<?php
   
namespace App\Exports;
   
use App\Models\User;
use App\Models\IPAddress;
use Illuminate\Support\Collection;
 
use Maatwebsite\Excel\Concerns\FromCollection;
   
class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

      public function collection()
        {
            $data = IPAddress::select('users.first_name', 'i_p_addresses.ip_type', 'i_p_addresses.ip_address', 'i_p_addresses.status', 'i_p_addresses.hostname_id')
                ->join('users', 'users.id', 'i_p_addresses.customer_id')
                ->selectRaw('CASE WHEN i_p_addresses.status = 1 THEN "Free" WHEN i_p_addresses.status = 2 THEN "Assigned" ELSE "Unknown" END AS status')
                ->selectRaw('CASE WHEN i_p_addresses.ip_type = 1 THEN "Public" WHEN i_p_addresses.ip_type = 2 THEN "Private" ELSE "Unknown" END AS ip_type')
                ->get();

            // Add a title row
            $titleRow = [
                'Sr. No', 'Customer Name', 'IP Type', 'IP Address', 'Status', 'Hostname'
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