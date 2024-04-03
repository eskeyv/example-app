<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function welcome()
    {
        $products = Product::simplePaginate(5);
        return view('welcome', compact('products'));
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'address'=>'required|string'
        ]);

        $product = new Product();
        $product->name = $request->input('name');
        $product->email = $request->input('email');
        $product->address = $request->input('address');
        $product->save();
        return redirect()->route('welcome');
    }

    public function editProduct(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'address'=>'required|string'
        ]);

        $product = Product::findOrFail($request->input('id'));
        $product->name = $request->input('name');
        $product->email = $request->input('email');
        $product->address = $request->input('address');
        $product->save();
        return redirect()->route('welcome');
    }

    public function deleteProduct(Request $request)
    {
        $productId = $request->input('productId');
        Product::destroy($productId);
        return redirect()->route('welcome');
    }
}
