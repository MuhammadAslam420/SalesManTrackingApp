<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ProductExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Product::all();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function headings(): array
    {
        return [
            'ID',
            'Product',
            'Slug',
            'Description',
            'Stock In',
            'Quantity',
            'Sale Quantity',
            'Image',
            'SKU',
            'Status',
            'Purchase Cost',
            'Sale Cost',
            'Discount Percentage',
            'Discount Quantity',
            'Discount Start Date',
            'Discount End Date',
            'Created Date',
            'Updated Date',
            'Sub Category ID'
        ];
    }
}
