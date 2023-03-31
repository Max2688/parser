<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected  $fillable = ['title','description','image'];

    protected $appends = [
        'short_desc'
    ];

    public function getShortDescAttribute()
    {
        return Str::limit($this->attributes['description'], 200);
    }

    public function getImageAttribute($value)
    {
        return asset('storage') . '/' . $value;
    }
}
