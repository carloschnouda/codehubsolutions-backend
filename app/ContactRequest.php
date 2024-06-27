<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ContactRequest extends Model 
{
	

    protected $table = 'contact_requests';

    protected $guarded = ['id'];

    

	public function service() { return $this->belongsTo('App\OurService'); } 

    /* Start custom functions */



    /* End custom functions */
}