<?php

namespace App\Http\Controllers;

use App\Models\StoreProduct;

class StoreController extends Controller
{
    //

    public function index()
    {
        $products = StoreProduct::all();

        return view('store.index', ['products' => $products]);
    }

    public function showProduct($id)
    {
    }

    public function cart()
    {
    }
}
