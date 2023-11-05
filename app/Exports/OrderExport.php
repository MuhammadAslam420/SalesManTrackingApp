<?php

namespace App\Exports;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Salesman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $orders = Order::all();

        // Loop through the orders and replace customer and salesman IDs with their names
        foreach ($orders as $order) {
            $customerId = $order->customer_id;
            $salesmanId = $order->salesman_id;

            // Retrieve customer and salesman names
            $customerName = Customer::find($customerId)->username;
            $salesmanName = Salesman::find($salesmanId)->name;

            // Assign the names to the order object
            $order->customer_id = $customerName;
            $order->salesman_id = $salesmanName;
        }

        return $orders;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Customer',
            'Delivery Date',
            'Status',
            'Total',
            'Tax',
            'SubTotal',
            'Discount',
            'Salesman',
            'Salesman Commission',
            'Order Date',
            'Order Update Date',
        ];
    }
}
