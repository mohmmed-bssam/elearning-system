<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use Trans;
    protected $guarded = [];
    public function image()
    {
        return $this->morphone(Image::class, 'imageable');
    }
        public function casts()
        {
            return [
            'title'=>'array',
            'content' => 'array',

            ];
        }

}
