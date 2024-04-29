<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }
    public function show(Request $request)
    {
        $show = [
            'section' => $request->section,
            'item' => $request->item
        ];
        $products = Product::select('*')
            ->where('section', '=', $show['section'])
            ->where('item', '=', $show['item'])
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
