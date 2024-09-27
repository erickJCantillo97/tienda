<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\Product;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('categories')->get();
        $sales = Sale::with('products')->get();

        return inertia('Sales', [
            'sales' => $sales,
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
    public function store(StoreSaleRequest $request)
    {
        $validateData = $request->validated();

        $products = $validateData['products'];

        unset($validateData['products']);
        $buy = Sale::create([
            'client_name' => $validateData['client_name'],
            'client_email' => $validateData['client_email'] ?? null,
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
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
