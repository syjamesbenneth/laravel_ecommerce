<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    public function category() {
    	return $this->belongsTo("\App\Category");
    	//this allows you to pull the category of the item as well as the properties
    	
    }
}
