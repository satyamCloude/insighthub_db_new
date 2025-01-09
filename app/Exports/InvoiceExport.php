<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Inventory;
use App\Models\Invoice;   
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class InvoiceExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
                   $data = Invoice::selectRaw('
                CONCAT(invoices.invoice_number1,invoices.invoice_number2) as invoice_number,
                users.first_name,
                orders.item_name,
                orders.cost_per_item,
                products.product_name,
                invoices.issue_date,
                invoices.due_date,
                invoices.shipping_address,
                orders.recipient_notes,
                invoices.amount,
                invoices.created_at')
                ->join('users', 'users.id', 'invoices.client_id')
                ->leftjoin('orders', 'orders.invoice_id', 'invoices.id')
                ->leftjoin('products', 'products.id', 'orders.product_id')
                ->whereNull('invoices.deleted_at')
                ->get();


        // Check if data is empty
        if ($data->isEmpty()) {
            // Handle the case where no data is retrieved
            return collect(); // or any other action you want to take
        }

        // Add a title row
        $titleRow = ['Sr. No','Invoice Number','User Name','Item Name','Cost Per Item','Serivice','Invoice Date','Due Date','Shipping Address','Product Description','Total Amount','Created At'];

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
