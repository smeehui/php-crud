<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix("products")->group(function () {
    Route::get('/{id}', function ($id) {
        return Product::findOrFail($id);
    });
    Route::put('/{id}', function ($id,Request $request) {
        $product = Product::findOrFail($id);
        if ($request->name != null && trim($request->name) != "") {
            $product->name = trim($request->name);
        }
        if ($request->price != null) {
            $product->price = (float)$request->price;
        }
        if ($request->quantity != null) {
            $product->quantity = (float)$request->quantity;
        }
        if ($request->category != null) {
            $product->category_id = $request->category;
        }
        if ($request->description != null && trim($request->description) != "") {
            $product->description = trim($request->description);
        }
        if ($product->save()) return $product;
    });
    Route::delete('/{id}', function ($id) {
        $product = Product::findOrFail($id);
        if ($product->delete()) return true;
    });
});
