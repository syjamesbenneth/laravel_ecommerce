<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Item;

class ItemController extends Controller
{
    public function showItems() {
    	$items = Item::all();
    	return view("items.catalog", compact('items'));
    }
}
