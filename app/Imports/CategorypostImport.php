<?php

namespace App\Imports;

use Illuminate\Support\Str;
use App\Models\Categorypost;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CategorypostImport implements ToModel, WithStartRow
{
    
    /**
     * startRow
     *
     * @return int
     */
    public function startRow(): int
    {
        return 3;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Categorypost([
            'title' => $row[1],
            'slug' => Str::slug($row[1]),
            'author_id' => Auth::id(),
        ]);
    }
}
