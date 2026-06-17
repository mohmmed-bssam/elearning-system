<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use Trans;
    //
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function teacher()
    {
        return $this->belongsTo(User::class);
    }

    public function students()
    {
        return $this->belongsToMany(
            User::class,
            'enrollments'
        )->withPivot('status', 'enrolled_at')
            ->withTimestamps();
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class)->orderBy('lesson_order');
    }
    public function reviews()
    {
        return $this->hasMany(CourseReview::class);
    }
 
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function casts(): array
    {
        return [
            'title' => 'array',
            'description' => 'array',
        ];
    }

}