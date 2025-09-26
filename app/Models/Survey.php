<?php

namespace App\Models;

use App\Models\SurveyAnswer;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{

    use HasSlug;

    protected $fillable = [
        'user_id',
        'title',
        'image',
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
    public function questions(){
        return $this->hasMany(SurveyQuestion::class);
    }
    public function answers(){
        return $this->hasMany(SurveyAnswer::class);
    }
}
