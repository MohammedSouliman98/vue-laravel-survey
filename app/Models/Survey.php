<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'status',
        'description',
        'expire_at',
    ];

    // Define any relationships, accessors, or mutators here if needed
}
