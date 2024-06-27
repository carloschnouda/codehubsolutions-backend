<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SocialMediaLink extends Model
{


    protected $table = 'social_media_links';

    protected $guarded = ['id'];





    /* Start custom functions */

    public $appends = ['full_path'];

    function getFullPathAttribute()
    {
        $icon = Storage::url($this->icon);

        return compact('icon');
    }

    /* End custom functions */
}
