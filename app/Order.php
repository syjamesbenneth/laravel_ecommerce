<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function items(){
        return $this->belongsToMany("\App\Item")->withPivot("quantity")->withTimestamps()->withTrashed();
        //withTrashed-> get all the items for that order including all the trashed items
    }
    //$this->order
    //belongstoMany links it(the order) to the items table via the item_order table
    //this is also the reasno why naming is VERY important, if you didn't follow laravel's naming convention here you will change the table name as needed
    //withPivot contains all the columns that are not foreign keys in the pivot table
    //if you have more than 1 column for the pivot comma sepaarate them ->withPivot("column1," col2), 
    //withTimestamps->auto populates the timestamps as soon as an entry for item_order is created

    //link items to the order
    
    	//items()->attach() is a function that allows us to insert the items to the order along with any other columns we want to include, in this case; quantity
    

}
