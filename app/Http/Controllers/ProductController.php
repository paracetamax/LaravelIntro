<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index(){
        $products = Product::all();
        return view('products.index', compact('products'));
    }
    public function store(){

        $data = request()->validate(['name'=>'required|max:255','price' => 'required|numeric|gte:0']);
        $product =Product::create($data);
        error_log($product);
        return $product;
    }

    public function destroy($id){
        $product = Product::findOrFail($id);
        $product->delete();
    }
}
