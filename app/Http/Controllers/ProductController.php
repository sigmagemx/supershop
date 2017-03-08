<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('shop.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('shop.product', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.product-info', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required',
            'badge' => 'required|integer',
            'images.*' => 'image',
            'parameters.*' => 'min:2|max:255'
        ]);

        $product = Product::find($id);
        $product->update($request->all());

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $filename = time() . $image->getClientOriginalName();
                $image->move('img/products', $filename);
                
                if ($product->images()->find($key)) {
                    unlink('img/products/' . $product->images()->find($key)->name);
                }

                $product->images()->updateOrCreate(
                    ['id' => $key],
                    ['name' => $filename]
                );
            }
        }

        foreach ($product->images as $image) {
            if (in_array($image->id, $request->delete_images)) {
                unlink('img/products/' . $image->name);
                $image->delete();
            }
        }
        
        $product->parameters()->delete();

        foreach ($request->parameters as $parameter) {
            if (!empty($parameter)) {
                $product->parameters()->create([
                    'name' => $parameter
                ]);
            }
        }
        
        return redirect()->route('products.edit', ['id' => $product->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $catId = $product->category->id;

        foreach ($product->images as $image) {
            unlink('img/products/' . $image->name);
        }

        $product->images()->delete();
        $product->parameters()->delete();
        $product->delete();

        return redirect()->route('categories.edit', ['id' => $catId]);
    }
}
