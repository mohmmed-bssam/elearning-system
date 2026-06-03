<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
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
    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('lesson_order');
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

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function casts(): array
    {
        return [
            'title' => 'array',
            'description' => 'array',
        ];
    }

}
