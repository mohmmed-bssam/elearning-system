<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role','phone'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    public function courses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }
    public function enrolledCourses()
    {
        return $this->belongsToMany(
            Course::class,
            'enrollments',
            'user_id',
            'course_id'
        )->withPivot('status', 'enrolled_at');
    }
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
    public function reviews()
    {
        return $this->hasMany(CourseReview::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
