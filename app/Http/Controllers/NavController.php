<?php

namespace App\Http\Controllers;

use App\Models\Mall;
use App\Models\Product;
use Illuminate\Http\Request;

class NavController extends Controller
{

    public function setMall(Request $request)
{
    $request->validate([
        'mall_id' => 'required|exists:malls,id'
    ]);

    $mall = Mall::find($request->mall_id);

    session([
        'selected_mall_id' => $mall->id,
        'selected_mall_name' => $mall->mall_name,
    ]);

    return redirect()->back()->with('status', 'Mall selected: ' . $mall->mall_name);
}



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
