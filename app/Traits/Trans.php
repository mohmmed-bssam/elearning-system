<?php

namespace App\Traits;

trait Trans
{
    public function getTransAttribute($key)
    {
        return $this->{$key}[app()->getLocale()] ?? null;
    }
    // public function getTitleTransAttribute()
    // {
    //     return $this->title[app()->getLocale()];
    // }
    // public function getContentTransAttribute()
    // {
    //     return $this->content[app()->getLocale()];
    // }
}
