<?php

namespace App\Imports;

use Illuminate\Support\Str;
use App\Models\Subcategorypost;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SubcategorypostImport implements ToModel, WithStartRow
{

    protected $categorypost;

    public function __construct($categorypost) {
        $this->categorypost = $categorypost;
    }

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
        return new Subcategorypost([
            'categorypost_id'=> $this->categorypost,
            'title' => $row[1],
            'slug' => Str::slug($row[1]),
            'author_id' => Auth::id(),
        ]);
    }
}
