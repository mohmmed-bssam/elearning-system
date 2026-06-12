<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use Trans;
    //
    protected $guarded = [];
    public function course(){
        return $this->belongsTo(Course::class)->withDefault();
    }
    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }


}
