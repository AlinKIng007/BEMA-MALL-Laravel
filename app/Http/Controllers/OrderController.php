<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
public function index()
{
    $orders = DB::table('main_products as mp')
    ->join('products as p', 'mp.id', '=', 'p.main_product_id')
    ->join('positions as pos', 'p.position_id', '=', 'pos.id')
    ->join('shelves as sh', 'pos.shelf_id', '=', 'sh.id')
    ->join('shops as s', 'sh.shop_id', '=', 's.id')
    ->join('floors as f', 's.floor_id', '=', 'f.id')
    ->join('malls as m', 'f.mall_id', '=', 'm.id')
    ->join('categories as c', 'mp.category_id', '=', 'c.id')
    ->join('orders as o', 'o.product_id', '=', 'p.id')
    ->join('users as u', 'o.user_id', '=', 'u.id')
    ->join('status as st', 'o.status_id', '=', 'st.id')
    ->join('payment_method as pm', 'o.payment_method_id', '=', 'pm.id')
    ->where('u.id', Auth::user()->id)
    ->select(
        'o.id',
        'mp.product_name',
        'p.price',
        'o.amount',
        'o.time_of_purchase',
        'u.username',
        'st.level',
        'st.type',
        'pm.method_name'
    )
    ->orderBy('p.date_added', 'desc')
    ->get();



    return view('orders.index', compact('orders'));
}



    public function show(Order $order)
    {
        $order->load(['user', 'product', 'status', 'payment_method', 'coupon']);
        return view('orders.show', compact('order'));
    }
    public function create()
{

        // Execute the stored procedure with the current user ID
        DB::select("CALL checkout_user_cart(?)", [Auth::user()->id]);

        // Redirect to the homepage
        return redirect('/');

}



}
