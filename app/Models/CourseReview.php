<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseReview extends Model
{
    //
    protected $guarded = [];

    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function casts(): array
    {
        return [
            'comment' => 'array',
        ];
    }
}
