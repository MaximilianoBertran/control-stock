<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class StockController extends Controller
{
    public function index (Request $request){

        $data = $request->input();

        $name = null;
        $code = null;
        
        $products = Product::orderByDesc('name');

        if (isset($data['name'])) {
            $name = $data['name'];
            $products->where('name', $data['name']);
        }

        if (isset($data['code'])) {
            $code = $data['code'];
            $products->where('code', $data['code']);
        }

        \Session::put('productsList', $products->get());

        return view('backend.stock.index') ->with('products', $products->paginate(25))
                                                    ->with('name', $name)
                                                    ->with('code', $code);
    }
}
