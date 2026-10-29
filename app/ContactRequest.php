<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ContactRequest extends Model 
{
	

    protected $table = 'contact_requests';

    protected $guarded = ['id'];

    

	public function service() { return $this->belongsTo('App\OurService'); } public function subject() { return $this->belongsTo('App\TheHubSection'); } 

    /* Start custom functions */



    /* End custom functions */
}