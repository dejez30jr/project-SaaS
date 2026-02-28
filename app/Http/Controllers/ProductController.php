<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {
    public function index() {
        return Inertia::render( 'Products', [
            'products' => auth()->user()->products
        ] );
    }

    public function store( Request $request ) {
        $validated = $request->validate( [
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'nullable'
        ] );

        auth()->user()->products()->create( $validated );

        return redirect()->route( 'products.index' );
    }

    public function update( Request $request, Product $product ) {
        $product->update( $request->only( [ 'name', 'price', 'category' ] ) );
        return back();
    }

    public function destroy( Product $product ) {
        $product->delete();
        return back();
    }
}