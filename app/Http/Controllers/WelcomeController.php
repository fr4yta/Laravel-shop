<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request) //:View|Factory|Application [PHP >= 8.0]
    {
        $filters = $request->query('filter');

        //$paginate = $request->query('paginate') ?? 5;
        if($request->query('paginate') == null) {
            $paginate = 5;
        } else {
            $paginate = $request->query('paginate');
        }

        $query = Product::query();

        if(!is_null($filters)) {
            if(array_key_exists('categories', $filters)) {
                $query = $query->whereIn('category_id', $filters['categories']);
            }
            if(!is_null($filters['price_min'])) {
                $query = $query->where('price', '>=', $filters['price_min']);
            }
            if(!is_null($filters['price_max'])) {
                $query = $query->where('price', '<=', $filters['price_max']);
            }

            return response()->json($query->paginate($paginate));
        }

        return view('welcome', [
            'products' => $query->paginate($paginate),
            'categories' => ProductCategory::orderBy('name', 'ASC')->get(),
            'default_img' => config('shop.defaultImg'),
            'isGuest' => Auth::guest()
        ]);
    }
}
