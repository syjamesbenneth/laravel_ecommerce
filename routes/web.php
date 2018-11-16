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

Route::get("/catalog", "ItemController@showItems");

Route::get("/menu/add", "ItemController@showAddItemForm");
Route::post("/menu/add", "ItemController@saveItems");
Route::get("/menu/mycart", "ItemController@showCart");

Route::get("/menu/{id}", "ItemController@itemDetails");

//{id is the wildcard selector}
//add is treated as an ID

Route::delete('/menu/{id}/delete', "ItemController@deleteItem");
Route::get('/menu/{id}/edit', "ItemController@showEditForm");

Route::patch("/menu/{id}/edit", "ItemController@editItem");

Route::post("addToCart/{id}","ItemController@addToCart");