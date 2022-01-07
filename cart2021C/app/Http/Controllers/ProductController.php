<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //import Database Library
use App\Models\Product;
use Session;
use App\Models\Category;

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


    public function delete($id)
    {
        $deleteProduct = Product::find($id);
        $deleteProduct -> delete();
        Session:: flash('Success',"Product was Delete Successfully!");
        Return redirect()->route('showProduct');
    }

    public function edit($id)
    {
        $products = Product::all()->where('id', $id);
        Return view('editProduct') -> with('products', $products)
        -> with('Categories',Category::all());
    }

    public function update()
    {
        $r=request();
        $products = Product::find($r->productID);

        if($r->file('productImage')!=''){
            $image=$r->file('productImage');        
            $image->move('images',$image->getClientOriginalName());                   
            $imageName=$image->getClientOriginalName(); 
            $products->image=$imageName;
        }

        $products->name=$r->productName;
        $products->description=$r->productDescription;
        $products->price=$r->productPrice;
        $products->quantity=$r->productQuantity;
        $products->CategoryID = $r->CategoryID;
        $products->save();

        Return redirect()->route('showProduct');
    }

    public function show(){
        //$viewProduct = Product::all();
        $showProduct = DB::table('products')
        ->select('products.*')
        ->get();
 
         Return view('viewProduct')->with('showproducts',$showProduct);
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
