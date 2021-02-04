<?php

namespace App\Exports;

use App\Models\Categorypost;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class CategorypostExport implements FromCollection,  WithMapping, WithHeadings
{    
    /**
     * Withheadings
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'User',
            'Title',
            'SEO',
            'Created',
        ];
    }
    
    /**
     * WithstartCell
     *
     * @return string
     */
    // public function startCell(): string
    // {
    //     return 'B2';
    // }

    public function map($categorypost): array
    {
        return [
            $categorypost->author->name,
            $categorypost->title,
            $categorypost->slug,
            $categorypost->created_at,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Categorypost::all();
    }

    

}
