<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorypage extends Model
{
    use HasFactory;
    // use SoftDeletes;
    
    protected $guarded = [];

    public function page()
    {
      return  $this->belongsToMany(Page::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
