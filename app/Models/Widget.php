<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    use HasFactory;


    protected $guarded = [];
 
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getStatusLabelAttribute()
    {
        //ADAPUN VALUENYA AKAN MENCETAK HTML BERDASARKAN VALUE DARI FIELD STATUS
        if ($this->status == 0) {
            return '<span class="badge badge-primary">Draft</span>';
        }
        return '<span class="badge badge-success">Published</span>';
        
    }

    // fungsi scope untuk manampilkan yang status publish
    public function scopePublished($query)
    {
        return $query->where("status", "=", 1);
    }
    
    //change default date view
    public function getCreatedAtAttribute($createdAt)
    {   
        // return Carbon::parse($date)->format('d-M-Y');
        return \Carbon\Carbon::parse($this->attributes['created_at'])
        ->diffForHumans();
    }
}
