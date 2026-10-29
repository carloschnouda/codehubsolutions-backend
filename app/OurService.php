<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class OurService extends Model 
{
	

    protected $table = 'our_services';

    protected $guarded = ['id'];

    public $with =['services_category'];
    

	public function services_category() { return $this->belongsTo('App\ServicesCategory'); } 

    /* Start custom functions */



    /* End custom functions */
}