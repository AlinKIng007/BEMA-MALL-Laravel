<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Termwind\Components\Raw;

class Cart_WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function indexCart()
{
    $u_id = Auth::user()->id;
    $results = DB::table('cart as c')
        ->join('products as p', 'c.product_id', '=', 'p.id')
        ->join('main_products as mp', 'mp.id', '=', 'p.main_product_id')
        ->join('product_config as pc', 'p.id', '=', 'pc.product_id')
        ->join('variation_option as vo', 'vo.id', '=', 'pc.variation_option_id')
        ->join('variation as v', 'v.id', '=', 'vo.variation_id')
        ->select(
            'c.id',
            'c.user_id',
            'mp.product_name',
            'mp.image_1',
            'mp.description',
            'p.price',
            'c.amount',
            'p.amount as p_amount',
            DB::raw('GROUP_CONCAT(DISTINCT vo.variation_value ORDER BY vo.variation_value) as variation_values')
        )
        ->where('c.user_id', '=', $u_id)
        ->groupBy('c.id', 'c.user_id', 'mp.product_name', 'mp.image_1', 'mp.description', 'p.price', 'c.amount', 'p.amount')
        ->get();

    return view('cart', ['results' => $results]);
}






public function deleteCart(Request $request)
{
    $validated = $request->validate([
        'id' => 'required|integer|exists:cart,id',
    ]);

    DB::table('cart')->where('id', $validated)->delete();


    return redirect('/cart');

}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

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
