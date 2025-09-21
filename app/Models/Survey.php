<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{

    use HasSlug;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'status',
        'description',
        'expire_at',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
    // Define any relationships, accessors, or mutators here if needed

    public function user(){
        return $this->belongsTo(User::class);
    }
}
