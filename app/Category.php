<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function items() {
    	return $this->hasMany("\App\Item");
    	//if we called the items function we cwould be able to pull all the items for that category and we can pull the properties of the items
    }
}
