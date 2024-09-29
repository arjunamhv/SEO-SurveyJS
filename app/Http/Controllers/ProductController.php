<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'productData' => 'required',
        ]);
        $productData = json_decode($validatedData['productData'], true);
        Product::create([
            'name' => $productData['name'],
            'description' => $productData['description'],
            'price' => $productData['price'],
            'stock' => $productData['stock'],
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $productData = json_decode($request->input('productData'), true);

        $product = Product::findOrFail($id);
        $product->name = $productData['name'];
        $product->description = $productData['description'];
        $product->price = $productData['price'];
        $product->stock = $productData['stock'];
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
