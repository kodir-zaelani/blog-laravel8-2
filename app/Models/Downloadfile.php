<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Downloadfile extends Model
{
    use HasFactory;

    protected $guarded = [];

    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function categorydownload()
    {
        return $this->belongsTo(Categorydownload::class);
    }
}
