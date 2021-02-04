<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    //  use SoftDeletes;

    // agar published_at diterjemahkan sebagai object Carbon maka buat
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $createdAt = ['created_at'];
    protected $updatedAt = ['updated_at'];

    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function categorypost()
    {
        return $this->belongsTo(Categorypost::class);
    }
    
    public function subcategorypost()
    {
        return $this->belongsTo(Subcategorypost::class, 'subcategorypost_id');
    }
    public function setarticle()
    {
        return $this->belongsTo(Setarticle::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function getTagsHtmlAttribute()
    {
        $anchors = [];
        foreach($this->tags as $tag) {
            // $anchors[] = '<a href="#">' . $tag->title . '</a>';
            $anchors[] = '<span class="badge bg-' .$tag->iclass. '"><a href="' .route('tag.show', $tag->slug) . '" > ' . $tag->title . '</a></span>';
        }
        // return implode(", ", $anchors); // dengan tanda koma
        return implode(" ", $anchors); // tanpa tanda koma
    }

    public function getImageUrlAttribute($value)
    {
        $imageUrl = "";
        
        if (!is_null($this->image)) {
            $directory = config('cms.image.directoryPosts');
            $imagePath = public_path() ."/{$directory}" . $this->image;
            if(file_exists($imagePath)) $imageUrl = asset("/{$directory}" . $this->image);
        }
        
        return $imageUrl;
    }
    public function getImageThumbUrlAttribute($value)
    {
        $imageThumbUrl = "";
        
        if (!is_null($this->image)) {
            $directory = config('cms.image.directoryPosts');
            $ext       = substr(strrchr($this->image, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->image);
            $imagePath = public_path() ."/{$directory}" . $thumbnail;
            if(file_exists($imagePath)) $imageThumbUrl = asset("/$directory" . $thumbnail);
        }
        
        return $imageThumbUrl;
    }
    
    public function getImageThumbAttribute($value)
    {
        $imageThumb = "";
        
        if (!is_null($this->image)) {
            $directory = config('cms.image.directoryPosts');
            $imagePath = public_path() ."/{$directory}/thumb/" . $this->image;
            if(file_exists($imagePath)) $imageThumb = asset("/{$directory}/thumb/" . $this->image);
        }
        
        return $imageThumb;
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
    // fungsi scope untuk manampilkan yang status pilihan
    public function scopeFeatured($query)
    {
        return $query->where("selection", "=", 0);
    }

    // fungsi scope untuk mengurutkan tulisan popular
    public function scopePopular($query)
    {
        return $query->orderBy('view_count', 'desc');
    }

    // fungsi scope untuk mengurutkan tulisan archive
    public static function scopeArchives()
    {
        if (env('DB_CONNECTION') == 'pgsql')
        {
            return static::selectRaw('count(id) as post_count, extract(year from created_at) as year, extract(month from created_at) as month')
            ->published()
            ->groupBy('year', 'month')
            ->orderByRaw('min(created_at) desc')
            ->get();
        }
        else
        {
            return static::selectRaw('count(id) as post_count, year(created_at) year, month(created_at) month')
            ->published()
            ->groupBy('year', 'month')
            ->orderByRaw('min(created_at) desc')
            ->get();
        }
    }

    public function scopeFilter($query, $filter)
    {
        if (isset($filter['month']) && $month = $filter['month'])
        {
            if (env('DB_CONNECTION') == 'pgsql') {
                $query->whereRaw('extract(month from created_at) = ?', [$month]);
            }
            else {
                $query->whereRaw('month(created_at) = ?', [$month]);
            }
        }
        
        if (isset($filter['year']) && $year = $filter['year'])
        {
            if (env('DB_CONNECTION') == 'pgsql') {
                $query->whereRaw('extract(year from created_at) = ?', [$year]);
            }
            else {
                $query->whereRaw('year(created_at) = ?', [$year]);
            }
        }
        
        // check if any term entered
        if (isset($filter['term']) && $term = strtolower($filter['term']))
        {
            $query->where(function($q) use ($term) {
                $q->whereHas('author', function($qr) use ($term) {
                        $qr->where('name', 'LIKE', "%{$term}%");
                    });
                    $q->orWhereHas('categorypost', function($qr) use ($term) {
                            $qr->where('title', 'LIKE', "%{$term}%");
                        });
                        $q->orWhereHas('tags', function($qr) use ($term) {
                            $qr->where('title', 'LIKE', "%{$term}%");
                        });
                        $q->orWhereRaw('LOWER(title) LIKE ?', ["%{$term}%"]);
                        $q->orWhereRaw('LOWER(content) LIKE ?', ["%{$term}%"]);
             });
        }
    }

    //change default date view
    public function getCreatedAtAttribute($createdAt)
    {   
        // return Carbon::parse($date)->format('d-M-Y');
        return \Carbon\Carbon::parse($this->attributes['created_at'])
        ->diffForHumans();
    }
    //change default date view
    public function getUpdatedAtAttribute($updatedAt)
    {   
        // return Carbon::parse($date)->format('d-M-Y');
        return \Carbon\Carbon::parse($this->attributes['updated_at'])
        ->diffForHumans();
    }

    public function getLink()
    {
        return 'post/'.$this->slug;
    }
}
