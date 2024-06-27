<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TheHubSection extends Model
{


    protected $table = 'the_hub_sections';

    protected $guarded = ['id'];





    /* Start custom functions */

    public $appends = ['full_path'];

    function getFullPathAttribute()
    {
        $image = Storage::url($this->image);
        return compact('image');
    }


    /* End custom functions */
}
