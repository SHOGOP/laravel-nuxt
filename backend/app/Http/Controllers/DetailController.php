<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }
    public function show(string $category)
    {
        $count = 0;
        $products = [];
        $products = Product::select('*')
            ->where('subsubcategory', '=', $category)
            ->distinct()->get();

        if ($products) {
            return response()->json([
                'message' => 'ok',
                'data' => $products
            ], 200, [], JSON_UNESCAPED_UNICODE);
        }
        return response()->json([
            'message' => 'Product not found',
        ], 404);
    }
}
