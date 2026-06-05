<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use Trans;
    //
    protected $guarded = [];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function casts(): array
    {
        return [
            'title' => 'array',
            'description' => 'array',
        ];
    }

}