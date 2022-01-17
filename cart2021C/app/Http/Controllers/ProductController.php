<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //import Database Library
use App\Models\Product;
use Session;
use App\Models\Category;

class ProductController extends Controller
{

    public function view(){
        //$viewProduct = Product::all();
        $viewProduct = DB::table('products')
        ->select('products.*')
        ->get();
 
         Return view('viewProduct')->with('viewProduct',$viewProduct);
     }

    public function productdetail($id){
        $products = Product::all() -> where('id',$id);

        Return view('productDetail') -> with('products', $products);
    }

    public function viewProduct(){
        
        $product=Product::all();

        (new CartController)->cartItem();
        
        return view('viewProducts')->with('products',$products);
    }

    public function searchProduct(){
        $r = request();
        $keyword = $r->keyword;
        $products = DB::table('products') -> where('name', 'like', '%'.$keyword.'%')->get();
        
        return view('viewProduct') -> with('showproducts', $products);
    }

    public function viewPhone(){
        $products = DB::table('products')
        ->where('products.categoryID', '=', '1')//if '' means haven't make payment
        ->get();
        
        return view('viewProduct') -> with('showproducts', $products);
    }

    public function viewComputer(){
        $products = DB::table('products')
        ->where('products.categoryID', '=', '2')//if '' means haven't make payment
        ->orWhere('products.categoryID', '=', '3')
        ->get();
        
        return view('viewProduct') -> with('showproducts', $products);
    }

    public function viewDesktop(){
        $products = DB::table('products')
        ->where('products.categoryID', '=', '2')//if '' means haven't make payment
        ->get();
        
        return view('viewProduct') -> with('showproducts', $products);
    }

    public function viewLaptop(){
        $products = DB::table('products')
        ->Where('products.categoryID', '=', '3')
        ->get();
        
        return view('viewProduct') -> with('showproducts', $products);
    }
}
