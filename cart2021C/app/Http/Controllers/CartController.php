<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use App\Models\myCart;
use App\Models\Product;

class CartController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function add(){
        $r = request();
        $addCart = myCart::Create([
            'productID' => $r->productID,
            'quantity' => $r->quantity,
            'userID' => Auth::id(),
            'orderID' => '',
        ]);

        Session:: flash('Success',"Add Cart Successfully!");
        Return redirect()->route('show.my.cart');
    }
    
    public function showMyCart(){
        $carts = DB::table('my_carts')
        ->leftjoin('products','products.id','=','my_carts.productID')
        ->select('my_carts.quantity as cartQTY', 'my_carts.id as cid', 'products.*')
        ->where('my_carts.orderID', '=', '')//if '' means haven't make payment
        ->where('my_carts.userID', '=', Auth::id())//item match with current login user
        //->get();    //All
        ->paginate(5);  //5 = five item in one page

        $this->cartItem();

        return view('myCart')->with('carts',$carts);
        //->with('noItem',$noItem);
    }

    public function delete($id){
        $deleteItem = myCart::find($id);  //binding record
        $deleteItem->delete();   //delete record
        Session::flash('Success','Item was remove Successfully !');
        Return redirect()->route('show.my.cart');
    }

    public function cartItem(){
        $cartItem = 0;
        $carts = DB::table('my_carts')
        ->leftjoin('products','products.id','=','my_carts.productID')
        ->select(DB::raw('COUNT(*) as count_item'))
        ->where('my_carts.orderID', '=', '')//if '' means haven't make payment
        ->where('my_carts.userID', '=', Auth::id())
        ->groupBy('my_carts.userID')
        ->first();  

        if($cartItem){
            $cartItem = $carts->count_item;
        }

        Session()->put('cartItem', $cartItem);  //Assign value to session variable cartItem
    }
}
