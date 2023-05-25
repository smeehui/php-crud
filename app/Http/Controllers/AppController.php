<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public $data = [];
    public function __construct()
    {
        $this->data['products'] = Product::all()->where('deleted_at', '=', null);
        $this->data['categories'] = Category::all()->where('deleted_at', '=', null);
    }

    public function products()
    {
        // dd($this->data['products']);
        return  view("products", $this->data);
    }

    public function productDetails($id)
    {
        $this->data['product'] =  Product::findOrFail($id);
        return  view("productsDetails",$this->data);
    }
    public function addProduct(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->price = (float)$request->price;
        $product->quantity = (int)$request->quantity;
        $product->description = $request->description;
        $product->category_id = $request->category;
        if ($product->save()) {
            return redirect()->route('products');
        }
    }
}
