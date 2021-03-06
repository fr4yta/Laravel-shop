<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use http\Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('products.index', [
            'products' => Product::paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create', [
            'categories' => ProductCategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(UpsertProductRequest $request) {
        $product = new Product($request->validated());
        if($request->hasFile('image')) {
            $product->image_path = $request->file('image')->store('products');
        }
        $product->save();

        return redirect(route('products.index'))->with('status', 'Dodano nowy produkt!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', [
            'product' => $product,
            'categories' => ProductCategory::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product,
            'categories' => ProductCategory::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpsertProductRequest $request, Product $product)
    {
        $oldImagePath = $product->image_path;

        $product->fill($request->validated());
        if($request->hasFile('image')) {
            if(Storage::disk('public')->exists($oldImagePath)) {
                Storage::delete($oldImagePath);
            }
            $product->image_path = $request->file('image')->store('products');
        }
        $product->save();
        return redirect(route('products.index'))->with('status', 'Pomyslnie edytowano produkt!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            Session::flash('status', 'Usunieto produkt!');
            return response()->json([
                'status' => 'success'
            ]);
        } catch(Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Wyst??pi?? b????d!'
            ])->setStatusCode(500);
        }
    }

    /**
     * Download image of the specified resource in storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Symfony\Component\HttpFoundation\StreamedResponse|\Illuminate\Http\RedirectResponse
     */
    public function downloadImage(Product $product)
    {
        if(Storage::disk('public')->exists($product->image_path)) {
            return Storage::download($product->image_path);
        } else {
            return Redirect::back();
        }
    }
}
