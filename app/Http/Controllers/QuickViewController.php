<?php

namespace App\Http\Controllers;

use App\Models\Mall;
use App\Models\Product;
use Illuminate\Http\Request;
class QuickViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the mall_id from the session
        $mall_id = session('mall_id') ?? 0;
    
        // If mall_id is not 'Select a Mall', find the mall by id, else default to mall 1
        $mall = Mall::query()->find($mall_id == 0 ? 1 : $mall_id);
    
        // Start the query for products
        $query = Product::select(
            'main_products.id',
            'main_products.product_name',
            'products.price',
            'products.amount',
            'products.date_added',
            'main_products.description',
            'main_products.image_1',
            'variation_option.value',
            'variation.name'
        )
        ->join('main_products', 'products.main_product_id', '=', 'main_products.id')
        ->join('positions', 'products.position_id', '=', 'positions.id')
        ->join('shelves', 'positions.shelf_id', '=', 'shelves.id')
        ->join('shops', 'shelves.shop_id', '=', 'shops.id')
        ->join('floors', 'shops.floor_id', '=', 'floors.id')
        ->join('malls', 'floors.mall_id', '=', 'malls.id')
        ->join('categories', 'main_products.category_id', '=', 'categories.id')
        ->leftJoin('product_config', 'products.id', '=', 'product_config.product_id')
        ->leftJoin('variation_option', 'variation_option.id', '=', 'product_config.variation_option_id')
        ->leftJoin('variation', 'variation.id', '=', 'variation_option.variation_id')
        ->orderByDesc('products.date_added');
    
        // Filter by selected mall if set
        if ($mall_id != 0) {
            $query->where('malls.id', $mall_id);
        }
    
        // Execute the query
        $products = $query->get();
    
        // Return view with products and mall data
        return view('products', compact('products', 'mall'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
