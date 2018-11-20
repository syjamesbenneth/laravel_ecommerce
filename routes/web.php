<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



// Route::middleware('auth')->group(function(){
Route::get("/menu/add", "ItemController@showAddItemForm");
Route::post("/menu/add", "ItemController@saveItems");
Route::get("/menu/categories/{id}", "CategoryController@findItems");

//add is treated as an ID
Route::get("/checkout", "ItemController@checkout");
Route::get("/catalog", "ItemController@showItems");
Route::get("/menu/mycart", "ItemController@showCart");
Route::delete("/menu/mycart/{id}/delete", "ItemController@deleteCart");
Route::get("/menu/clearcart", "ItemController@clearCart");
Route::patch("/menu/mycart/{id}/changeQty", "ItemController@updateCart");
Route::post("/addToCart/{id}","ItemController@addToCart");
Route::get("/menu/{id}", "ItemController@itemDetails");//{id is the wildcard selector}

Route::delete('/menu/{id}/delete', "ItemController@deleteItem");
Route::get('/menu/{id}/edit', "ItemController@showEditForm");
Route::patch("/menu/{id}/edit", "ItemController@editItem");
Route::get("/checkout", "ItemController@checkout");
Route::get("/orders", "ItemController@showOrders");
Route::get("/restoreItem/{id}", "ItemController@restoreItem");
// });
// end of middleware

//routes that don't need authorization



Route::get("/sampleview", function (){
	return view("sampleview");
});

Route::get("/sampleview2", function(){
	return view("sampleview2");
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


