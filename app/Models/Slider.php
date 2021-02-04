<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;

    // use SoftDeletes;

    protected $guarded = [];
    
     //belongsTo table atau Model User
     public function author()
     {
         return $this->belongsTo(User::class, 'author_id');
     }

     public function getRouteKeyName()
     {
         return 'slug';
     }

     public function getImageUrlAttribute($value)
    {
        $imageUrl = "";
        
        if (!is_null($this->image)) {
            $directory = config('cms.image.directorySliders');
            $imagePath = public_path() ."/{$directory}" . $this->image;
            // $imagePath = public_path() ."/uploads/images/posts/" . $this->image;
            // if(file_exists($imagePath)) $imageUrl = asset("public/uploads/images/posts/" . $this->image);
            if(file_exists($imagePath)) $imageUrl = asset("/{$directory}" . $this->image);
        }
        
        return $imageUrl;
    }
    
    public function getImage()
    {
        if (!is_null($this->image)) {
            return asset('uploads/sliders/' . $this->image);
        }
        return asset('assets/admin/dist/img/no_image.png');
    }

    public function getImageThumbUrlAttribute($value)
    {
        $imageThumbUrl = "";
        
        if (!is_null($this->image)) {
            $directory = config('cms.image.directorySliders');
            $ext       = substr(strrchr($this->image, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->image);
            $imagePath = public_path() ."/{$directory}" . $thumbnail;
            if(file_exists($imagePath)) $imageThumbUrl = asset("/$directory" . $thumbnail);
        }
        
        return $imageThumbUrl;
    }

    public function getStatusLabelAttribute()
    {
        
        //ADAPUN VALUENYA AKAN MENCETAK HTML BERDASARKAN VALUE DARI FIELD STATUS
        if ($this->status == 0) {
            return '<span class="badge badge-primary">Draft</span>';
        }
        return '<span class="badge badge-success">Publish</span>';
        
    }

     // fungsi scope untuk manampilkan yang status publish
     public function scopePublished($query)
     {
         return $query->where("status", "=", "1");
     }

     public function scopeDraft($query)
     {
        return $query->where("status", "=", "0");
     }
}
