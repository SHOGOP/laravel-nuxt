<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Product::select('category')->distinct()->get();
        $count = 0;
        $products = [];
        foreach ($category as $cate) {
            $subcategory = Product::select('subcategory')
                ->where('category', '=', $cate['category'])
                ->distinct()->get();
            $adarray = [];
            foreach ($subcategory as $sub) {
                array_push(
                    $adarray,
                    $sub['subcategory']
                );
            }
            array_push(
                $products,
                array('title' => $cate['category'], 'subtitle' => $adarray)
            );
        }
        //$products = Product::select('category as title', 'subcategory as subtitle')->get();
        return response()->json([
            'message' => 'ok',
            'data' => $products
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
    public function show(string $category)
    {
        $count = 0;
        $products = [];
        $subcategory = Product::select('subcategory')
        ->where('category', '=', $category)
        ->distinct()->get();
        foreach ($subcategory as $sub) {
            $subsubcategory = Product::select('subsubcategory')
            ->where('subcategory', '=', $sub['subcategory'])
            ->distinct()->get();
            $adarray = [];
            foreach ($subsubcategory as $subsub) {
                array_push(
                    $adarray,
                    $subsub['subsubcategory']
                );
            }
            array_push(
                $products,
                array('title' => $sub['subcategory'], 'subtitle' => $adarray)
            );
        }
        //$product = Product::find($subcategory);
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
