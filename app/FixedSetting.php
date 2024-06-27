<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FixedSetting extends Model
{


    protected $table = 'fixed_settings';

    protected $guarded = ['id'];





    /* Start custom functions */

    public $appends = ['full_path'];

    function getFullPathAttribute()
    {
        $logo = Storage::url($this->logo);
        $about_section_image = Storage::url($this->about_section_image);
        if ($this->statistics_bg_image) {
            $statistics_bg_image = Storage::url($this->statistics_bg_image);
        } else {

            $statistics_bg_image = null;
        }
        //Get Gallery Image Full Path As An Array
        $array = json_decode($this->banner_images);
        $banner_images = [];
        foreach ($array as $key => $singleImage) {
            $banner_images[] = Storage::url($singleImage);
        }

        return compact('logo', 'banner_images', 'about_section_image', 'statistics_bg_image');
    }

    /* End custom functions */
}
