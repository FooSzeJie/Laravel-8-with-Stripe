<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //import Database Library
use App\Models\Product;
use Session;

class ProductController extends Controller
{
    public function add(){
        $r = request();   //received the data by GET or POST method $_POST['name']
        $image=$r->file('image');
        $image->move('images',$image->getClientOriginalName());  //image is the location
        $imageName=$image->getClientOriginalName();
        $addProduct = Product :: create([
            'name'=>$r->productName,
            'description'=>$r->productDescription,
            'quantity'=>$r->productQuantity,
            'price'=>$r->productPrice,
            'CategoryID'=>$r->CategoryID,
            'image'=>$imageName,
        ]);

        //Return view('addProduct');
        Session:: flash('Success',"Product Create Successfully!");
        Return redirect()->route('showProduct');
    }

    public function view(){
       //$viewProduct = Product::all();
       $viewProduct = DB::table('products')
       ->leftjoin('categories', 'categories.id', '=', 'products.CategoryID')
       ->select('products.*', 'categories.name as catName')
       ->get();

        Return view('showProduct')->with('products',$viewProduct);
    }
}
