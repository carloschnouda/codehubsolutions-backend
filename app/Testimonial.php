<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Testimonial extends Model
{


    protected $table = 'testimonials';

    protected $guarded = ['id'];





    /* Start custom functions */

    public $appends = ['full_path'];

    function getFullPathAttribute()
    {
        if($this->image){

            $image = Storage::url($this->image);
            return compact('image');
        }
        return null;
    }

    /* End custom functions */
}
