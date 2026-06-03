<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    //
    protected $guarded = [];
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function casts(): array
    {
        return [
            'title' => 'array',
            'content' => 'array',
            
        ];
    }

}