<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
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

        return view('backend.product.index') ->with('products', $products->paginate(25))
                                                    ->with('name', $name)
                                                    ->with('code', $code);
    }

    public function create (){
        return view ('backend.product.create');
    }

    public function edit ($id){
        $product = Product::findOrFail($id);

        return view ('backend.product.edit')
            ->with('product', $product);
    }

    public function store (Request $request){
        $data = $request->input();
        $product = Product::create($data);

        return redirect()->action('Backend\ProductsController@index')
                ->with('message', 'Producto '.__('successfully created.'));
    }

    public function update (Request $request, $id){
        $data = $request->input();
        $product = Product::findOrFail($id);

        //Info validation
        $rule = Product::rules($product->id);
        $dataValidator = \Validator::make($data, $rule);
        if($dataValidator->fails()){
            return redirect()->back()->withInput($data)->withErrors($dataValidator->errors());
        }

        $product->update($data);
        
        return redirect()->action('Backend\ProductsController@index')
                ->with('message', 'Producto '.__('successfully modified.'));
    }

    public function destroy ($id){
        $product = Product::findOrFail($id);
        
        $product->delete();

        return redirect()->action('Backend\ProductsController@index')
                ->with('message', 'Producto '.__('successfully removed.'));
    }
}
