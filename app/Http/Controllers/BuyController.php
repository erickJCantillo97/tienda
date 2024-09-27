<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Http\Requests\StoreBuyRequest;
use App\Http\Requests\UpdateBuyRequest;
use App\Models\Product;

class BuyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('categories')->get();
        $buys = Buy::with('products')->get();
        return inertia('Buys', [
            'buys' => $buys,
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBuyRequest $request)
    {
        $validateData = $request->validated();

        $products = $validateData['products'];

        unset($validateData['products']);
        $buy = Buy::create([
            'supplier_name' => $validateData['supplier_name'],
            'supplier_email' => $validateData['supplier_email'] ?? null,
            'user_id' => auth()->user()->id,
        ]);
        foreach ($products as $product) {
            $product['total'] = $product['quantity'] * Product::find($product['product_id'])->price;
            $product['product_name'] = Product::find($product['product_id'])->name;
            $product['price'] = Product::find($product['product_id'])->price;
            $buy->products()->create($product);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Buy $buy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buy $buy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBuyRequest $request, Buy $buy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buy $buy)
    {
        //
    }
}
