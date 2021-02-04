<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setarticle extends Model
{
    use HasFactory;
    //  use SoftDeletes;
     protected $guarded = [];

     public function post()
     {
       return  $this->hasMany(Post::class);
     }
 
     public function getRouteKeyName()
     {
         return 'slug';
     }
 
     public function getImageUrlAttribute($value)
     {
         $imageUrl = "";
         
         if (!is_null($this->image)) {
             $directory = config('cms.image.directorySetarticle');
             $imagePath = public_path() ."/{$directory}" . $this->image;
             if(file_exists($imagePath)) $imageUrl = asset("/{$directory}" . $this->image);
         }
         
         return $imageUrl;
     }
     
     public function getImageThumbUrlAttribute($value)
     {
         $imageThumbUrl = "";
         
         if (!is_null($this->image)) {
             $directory = config('cms.image.directorySetarticle');
             $ext       = substr(strrchr($this->image, '.'), 1);
             $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->image);
             $imagePath = public_path() ."/{$directory}" . $thumbnail;
             if(file_exists($imagePath)) $imageThumbUrl = asset("/$directory" . $thumbnail);
         }
         
         return $imageThumbUrl;
     }
}
