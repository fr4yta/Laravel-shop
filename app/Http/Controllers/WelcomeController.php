<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class WelcomeController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index() //:View|Factory|Application [PHP >= 8.0]
    {
        return view('welcome', [
            'products' => Product::paginate(10),
            'categories' => ProductCategory::orderBy('name', 'ASC')->get(),
        ]);
    }
}
