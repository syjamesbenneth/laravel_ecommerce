<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Item;
use \App\Order;
use Auth; // allows the controller to use the auth::user
use Session;

class ItemController extends Controller
{
    public function __construct() {//double underscore
        $this->middleware('auth'); //it checkes if the user is currently logged in
    }

    public function showItems() {
    	$items = Item::all();
    	return view("items.catalog", compact('items'));
    }
    public function itemDetails($id){
    	$items = Item::find($id);
    	return view("items.item_details", compact('items'));
    }
    public function showAddItemForm(){
    	return view("items.add_items");
    }
    public function saveItems(Request $request){
    	// dd($request);
    	$rules = array(
    			"name"=>"required",
    			"description"=>"required",
    			"price"=>"required|numeric",
    			'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    		);

    	//to validate
    	$this->validate($request, $rules);

    	//if validation fails, it would not proceed to the next lines of code.

    	$item = new Item;
    	$item->name = $request->name;
    	$item->description = $request->description;
    	$item->price = $request->price;
    	$item->category_id = $request->category;

    	//file handling
    	$image = $request->file('image');
    	$image_name = time(). "." . $image->getClientOriginalExtension();
    	$destination = "images/";
    	$image->move($destination, $image_name);

    	$item->img_path = $destination.$image_name;
    	$item->save();

    	Session::flash("success_message", "Item added successfully");
    	return redirect("/catalog");
    }

    public function deleteItem($id){
    	$item = Item::find($id);
    	$item->delete();
    	Session::flash("success_message", "Item successfully deleted.");
    	return redirect("/catalog");
    }

    public function showEditForm($id) {
    	$item = Item::find($id);
    	return view("items.edit_item", compact('item'));
    }

    public function editItem($id, Request $request) {
    	$item = Item::find($id);
    	//validations:
    	$rules = array(
    		'name'=>'required',
    		'description'=>'required',
    		'price'=>'required|numeric',
    		'image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    		);
    	$this->validate($request, $rules);
    	$item->name = $request->name; //$request->name, name comes frmo the name in the input type
    	$item->description = $request->description;
    	$item->price = $request->price;

    	if($request->file('image') != null) {
    		$image = $request->file('image');
    		$image_name = time() . "." .$image->getClientOriginalExtension();
    		$destination = "images/";
    		$image->move($destination, $image_name);
    		$item->img_path = $destination.$image_name;
    	}
    	$item->save();
    	Session::flash("edit_message", "Item edited successfully");
    	return redirect("/menu/{$id}");
    }

    public function addToCart($id, Request $request) {
    	//if there is an existing cart, get it, if none, initialize it
    	if(Session::has('cart')) {
    		$cart = Session::get('cart');
    	} else {
    		$cart = [];
    	}
    	//if item in cart already has quantity, add to it. if non, assign quantity
    	if(isset($cart[$id])) {
    		$cart[$id] += $request->quantity;
    	} else {
    		$cart[$id] = $request->quantity;
    	}
    	Session::put('cart', $cart); // this is our traditional session

    	$item = Item::find($id);
    	Session::flash("success_cart", "$request->quantity of $item->name successfully added to cart.");

    	// return redirect("/catalog");
        return array_sum(Session::get('cart'));
    }
    public function showCart() {
    	$item_cart = [];
    	if(Session::has('cart')){
    		$cart = Session::get('cart');
    		$total = 0;
    		foreach($cart as $id => $quantity) {
    			$item = Item::find($id);
    			$item->quantity = $quantity;
    			$item->subtotal = $item->price * $quantity;
    			$total += $item->subtotal;
    			$item_cart[] = $item;
    			//at this point, each element of the $item has name,description,price, img_path, category_id, subtotal - quantity and subtotal do not exist in the database but it exists for $item

    			// $total += $item->subtotal;
    			// $item_cart[] = $item;
    			//we push to the empty array the $item
    		}
    	}
    	// dd($item_cart);	
    
        return view("items.cart_content", compact("item_cart","total"));
    }    
    	//TODO: throw both total and item_cart to the view and work on the view.

        public function deleteCart($id){
            //we want to remove the specific id in the Session::'cart' variable
            //in php it is UNSET
            Session::forget("cart.$id"); //this is the same as cart[$id]
            return redirect("/menu/mycart");
            }

            public function clearCart() {
                Session::forget("cart");
                return redirect("/menu/mycart");
        }

            public function updateCart($id, Request $request){
                $cart = Session::get("cart");
                $cart[$id] = $request->quantity;
                Session::put("cart", $cart);
                return redirect("/menu/mycart");
            }

            public function checkout(){
                $order = new Order;
                $order->user_id = Auth::user()->id;
                

                //we need to make sure we have a user accoutn and that user is logged in. Or else we would encounter an error with Auth
                $order->total=0;
                $order->status_id =1;//all orders should start as pending
                $order->save();

                //creates a new order
                $total = 0;
                foreach(Session::get('cart') as $item_id=>$quantity){
                $order->items()->attach($item_id,['quantity'=>$quantity]);
            //items()->attach is a function that allows us to insert the item to the item_order table for that specific order_id, along with any other columns we want to include, in this case; quantity

            //attach means insert into the pivot table. 
            //syntax: attach(other fk, [other columns in an assoc array])
            //equivalent in capstone 2 
            //insert into item_order (item_id,quantity) values ($item_id,$quantity)
            $item = Item::find($item_id);
            $total += $item->price * $quantity;
        }

                //attach means insert into the pivot table

            

            //save the total to the current order
            $order->total=$total;
            $order->save();

            //remove session cart and return to catalog
            Session::forget("cart");
            return redirect("/catalog");
    }
    public function showOrders(){
        $orders = Order::where('user_id',Auth::user()->id)->get();
        //select * from orders where user_id = id of current user
        //->get(); is run the query
        //dd($orders);
        return view('items/order_details',compact("orders"));
    }
    public function restoreItem($id){
        $item = Item::withTrashed()->find($id);
        //we need to use withTrashed as the item has been deleted
        $item->restore();
        return redirect("/catalog");
    }

}