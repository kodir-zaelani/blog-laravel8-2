<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;

    // use SoftDeletes;

     // agar published_at diterjemahkan sebagai object Carbon maka buat
     protected $dateFormat = 'Y-m-d H:i:s';
     protected $createdAt = ['created_at'];
     protected $updatedAt = ['updated_at'];
      
     protected $guarded = [];
 
     public function author()
     {
         return $this->belongsTo(User::class, 'author_id');
     }
     public function categorypage()
     {
         return $this->belongsTo(Categorypage::class);
     }
 
     public function getImageUrlAttribute($value)
     {
         $imageUrl = "";
         
         if (!is_null($this->image)) {
             $directory = config('cms.image.directoryPages');
             $imagePath = public_path() ."/{$directory}" . $this->image;
             if(file_exists($imagePath)) $imageUrl = asset("/{$directory}" . $this->image);
         }
         
         return $imageUrl;
     }
     
     public function getImage()
     {
         if (!is_null($this->image)) {
             return asset('uploads/pages/' . $this->image);
         }
         return asset('assets/admin/dist/img/no_image.png');
     }
 
     public function getImageThumbUrlAttribute($value)
     {
         $imageThumbUrl = "";
         
         if (!is_null($this->image)) {
             $directory = config('cms.image.directoryPages');
             $ext       = substr(strrchr($this->image, '.'), 1);
             $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->image);
             $imagePath = public_path() ."/{$directory}" . $thumbnail;
             if(file_exists($imagePath)) $imageThumbUrl = asset("/$directory" . $thumbnail);
         }
         
         return $imageThumbUrl;
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
     //change default date view
     public function getUpdatedAtAttribute($createdAt)
     {   
         // return Carbon::parse($date)->format('d-M-Y');
         return \Carbon\Carbon::parse($this->attributes['updated_at'])
         ->diffForHumans();
     }
     //change default date view
     // public function getUpdatedAtAttribute($updatedAt)
     // {   
     //     // return Carbon::parse($date)->format('d-M-Y');
     //     return \Carbon\Carbon::parse($this->attributes['updated_at'])
     //     ->diffForHumans();
     // }
 
     public function getLinkAttribute()
     {
         return '/page/'.$this->slug;
     }
}
