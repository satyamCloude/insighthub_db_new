<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Inventory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class InventoryExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = Inventory::selectRaw('
            inventories.product_name,
            inventories.product_code,
            inventories.brand_name,
            inventories.purchase_date,
            inventories.warranty_expiry,
            inventories.base_amount,
            inventories.gst_vat,
            inventories.tax_amount,
            inventories.total_amount,
            users.first_name,
            inventories.created_at')
            ->join('users', 'users.id', 'inventories.assigned_to_id')
            ->whereNull('inventories.deleted_at')
            ->get();

        // Check if data is empty
        if ($data->isEmpty()) {
            // Handle the case where no data is retrieved
            return collect(); // or any other action you want to take
        }

        // Add a title row
        $titleRow = [
            'Sr. No',
            'Product Name',
            'Product Code',
            'Brand Name',
            'Purchase Date',
            'Warranty Expiry',
            'Base Amount',
            'GST/VAT(%)',
            'Tax Amount',
            'Total Amount',
            'Assigned To',
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
