<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    protected $fillable = [
        'title',
        'description',
        'category',
        'thumbnail',
        'video_url',
        'slug',
        'level',
        'is_published',
    ];


    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
