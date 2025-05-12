<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\MainProduct;
use App\Models\Mall;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get the mall_id from the session, default to 1 if not set
        $mall_id = session('mall_id', 0); // Default to 1 if no mall_id in session

        // Find the mall by ID (or the default mall)
        $mall = Mall::find($mall_id);

        // Start the query for products using Eloquent and raw expressions
        $query = DB::table('main_products as mp')
    ->select(
        DB::raw('MIN(p.id) as id'),
        'mp.product_name',
        DB::raw('MIN(p.price) as price'),
        DB::raw('MIN(p.amount) as amount'),
        DB::raw('MIN(p.date_added) as date_added'),
        'mp.image_1',
        'mp.id as mp_id',
        'mp.description',
        'm.id as mall_id',
        'c.id as category_id'
    )
    ->join('products as p', 'mp.id', '=', 'p.main_product_id')
    ->join('positions as pos', 'p.position_id', '=', 'pos.id')
    ->join('shelves as sh', 'pos.shelf_id', '=', 'sh.id')
    ->join('shops as s', 'sh.shop_id', '=', 's.id')
    ->join('floors as f', 's.floor_id', '=', 'f.id')
    ->join('malls as m', 'f.mall_id', '=', 'm.id')
    ->join('categories as c', 'mp.category_id', '=', 'c.id')
    ->groupBy('mp.id', 'mp.product_name', 'mp.image_1', 'm.id', 'c.id', 'mp.description')
    ->orderByDesc('date_added'); // note: order by alias, not table.column if it's an aggregate

if ($mall_id != 0) {
    $query->where('m.id', $mall_id);
}

$products = $query->get();



        // Return the view with products and mall data
        return view('products', compact('products', 'mall'));
    }








    /**
     * Display the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {

        session(['mp_id' => $id]);

    //     $variations = Product::select('
    //     MIN(products.id) AS id,
    //     mp.product_name AS product_name,
    //     MIN(products.price) AS price,
    //     MIN(products.amount) AS amount,
    //     MIN(products.date_added) AS date_added,
    //     mp.image_1 AS image_1,
    //     c.id AS category_id,
    //     mp.description AS description,
    //     m.mall_name AS mall_name
    // ')
    // ->join('main_products AS mp', 'mp.id', '=', 'products.main_product_id')
    // ->join('positions AS pos', 'products.position_id', '=', 'pos.id')
    // ->join('shelves AS sh', 'pos.shelf_id', '=', 'sh.id')
    // ->join('shops AS s', 'sh.shop_id', '=', 's.id')
    // ->join('floors AS f', 's.floor_id', '=', 'f.id')
    // ->join('malls AS m', 'f.mall_id', '=', 'm.id')
    // ->join('categories AS c', 'mp.category_id', '=', 'c.id')
    // ->where('mp.id', $id)  // where clause to filter by mall id
    // ->groupBy('mp.id', 'mp.product_name', 'mp.image_1', 'c.id', 'mp.description', 'm.mall_name')
    // ->orderByDesc('date_added')
    // ->get();




    $products = DB::table('main_products as mp')
            ->select(
                'p.id as id',
                'mp.product_name',
                'p.price as price',
                'p.amount as amount',
                'p.date_added as date_added',
                'mp.image_1',
                'mp.id as mp_id',
                'mp.description',
                'm.id as mall_id',
                'm.mall_name',
                'c.id as category_id'
            )
            ->join('products as p', 'mp.id', '=', 'p.main_product_id')
            ->join('positions as pos', 'p.position_id', '=', 'pos.id')
            ->join('shelves as sh', 'pos.shelf_id', '=', 'sh.id')
            ->join('shops as s', 'sh.shop_id', '=', 's.id')
            ->join('floors as f', 's.floor_id', '=', 'f.id')
            ->join('malls as m', 'f.mall_id', '=', 'm.id')
            ->join('categories as c', 'mp.category_id', '=', 'c.id')
            ->where('mp.id', $id) // Filter by mall_id

            ->orderByDesc('p.date_added') // Order by date_added descending
            ->first(); // Execute the query and get results





            $variation_values = DB::table('main_products as mp')
            ->select([
                'vo.variation_value',
                'v.variation_name',
                'vo.id as vo_id'
            ])
            ->join('products as p', 'mp.id', '=', 'p.main_product_id')
            ->join('categories as c', 'mp.category_id', '=', 'c.id')
            ->leftJoin('product_config as pc', 'p.id', '=', 'pc.product_id')
            ->leftJoin('variation_option as vo', 'vo.id', '=', 'pc.variation_option_id')
            ->leftJoin('variation as v', 'v.id', '=', 'vo.variation_id')
            ->where('mp.id', $id)
            ->distinct()
            ->orderBy('v.variation_name', 'ASC')
            ->get();






$variations = Product::join('main_products as mp', 'mp.id', '=', 'products.main_product_id')
    ->join('categories as c', 'mp.category_id', '=', 'c.id')
    ->leftJoin('product_config as pc', 'products.id', '=', 'pc.product_id')
    ->leftJoin('variation_option as vo', 'vo.id', '=', 'pc.variation_option_id')
    ->leftJoin('variation as v', 'v.id', '=', 'vo.variation_id')
    ->where('mp.id', $id)
    ->orderBy('v.variation_name', 'asc')
    ->select('v.variation_name')
    ->distinct()
    ->get();

        // Return the view with the product and malls
        return view('product', compact('products', 'variations','variation_values'));
    }


    public function getProductOptions(Request $request)
    {
        // Retrieve the variation option IDs from the request, defaulting to an empty array if not provided
        $vo_ids = $request->input('vo_ids', []);

        if (empty($vo_ids)) {
            // Return a response with an error if no variation option IDs are provided
            return response()->json(['error' => 'Variation option IDs are required'], 400);
        }

        $mainProductId = session('mp_id') ?? 1;

        $results = DB::table('main_products as mp')
            ->join('products as p', 'mp.id', '=', 'p.main_product_id')
            ->join('categories as c', 'mp.category_id', '=', 'c.id')
            ->join('product_config as pc', 'p.id', '=', 'pc.product_id')
            ->join('variation_option as vo', 'vo.id', '=', 'pc.variation_option_id')
            ->join('variation as v', 'v.id', '=', 'vo.variation_id')
            ->select('p.amount', 'p.price', 'p.id as id')
            ->where('mp.id', $mainProductId)
            ->whereIn('pc.variation_option_id', $vo_ids)
            ->groupBy('p.amount', 'p.price', 'p.id')
            ->havingRaw('COUNT(DISTINCT pc.variation_option_id) = ?', [count($vo_ids)])
            ->get();

        return response()->json($results);
    }




    public function cartAdd(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'amount' => 'required|integer|min:1',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        Cart::create($validated);

        return redirect('/products')->with('success', 'Product added to cart!');
    }






}
