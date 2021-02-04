<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    // use HasFactory;
    protected $guarded = [];

    public function getImageUrlAttribute($value)
    {
        $imageUrl = "";
        
        if (!is_null($this->image)) {
            $directory = config('cms.image.directoryLogo');
            $imagePath = public_path() ."/{$directory}" . $this->image;
            if(file_exists($imagePath)) $imageUrl = asset("/{$directory}" . $this->image);
        }
        
        return $imageUrl;
    }

    public function getLogoUrlAttribute($value)
    {
        $logoUrl = "";
        
        if (!is_null($this->logo)) {
            $directory = config('cms.image.directoryLogo');
            $imagePath = public_path() ."/{$directory}" . $this->logo;
            if(file_exists($imagePath)) $logoUrl = asset("/{$directory}" . $this->logo);
        }
        
        return $logoUrl;
    }
    
   
    public function getImageThumbUrlAttribute($value)
    {
        $imageThumbUrl = "";
        
        if (!is_null($this->image)) {
            $directory = config('cms.image.directoryLogo');
            $ext       = substr(strrchr($this->image, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->image);
            $imagePath = public_path() ."/{$directory}" . $thumbnail;
            if(file_exists($imagePath)) $imageThumbUrl = asset("/$directory" . $thumbnail);
        }
        
        return $imageThumbUrl;
    }

    public function getLogoThumbUrlAttribute($value)
    {
        $logoThumbUrl = "";
        
        if (!is_null($this->logo)) {
            $directory = config('cms.image.directoryLogo');
            $ext       = substr(strrchr($this->logo, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->logo);
            $imagePath = public_path() ."/{$directory}" . $thumbnail;
            if(file_exists($imagePath)) $logoThumbUrl = asset("/$directory" . $thumbnail);
        }
        
        return $logoThumbUrl;
    }

    public function getFavicon()
    {
        if (($this->favicon) != null) {
            return asset('uploads/logo/' . $this->favicon);
        }
        return asset('assets/admin/dist/img/no_image.png');
    }
}
