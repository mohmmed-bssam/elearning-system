<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $guarded = [];
    public function student()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}