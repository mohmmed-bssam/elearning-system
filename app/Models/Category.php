<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Trans;
    //
    protected $guarded = [];
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function casts(): array
    {
        return [
            'title' => 'array',
        ];
    }
}
