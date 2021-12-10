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
    public function __contruct(){
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

        Session:: flash('Success',"add Cart Successfully!");
        Return redirect()->route('showProduct');
    }
    
}
