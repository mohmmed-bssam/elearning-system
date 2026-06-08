<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //
    protected $guarded = [];

    public function image()
    {
        return $this->morphone(Image::class, 'imageable');
    }
    public function casts()
    {
        return [

           'content' => 'array',

        ];
    }

}
