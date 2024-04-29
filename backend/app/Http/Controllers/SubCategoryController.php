<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Product::select('subcategory')->distinct()->get();
        $count = 0;
        $products = [];
        foreach ($category as $cate) {
            $subcategory = Product::select('subsubcategory')
                ->where('subcategory', '=', $cate['subcategory'])
                ->distinct()->get();
            $adarray = [];
            foreach ($subcategory as $sub) {
                array_push(
                    $adarray,
                    $sub['subsubcategory']
                );
            }
            array_push(
                $products,
                array('title' => $cate['subcategory'], 'subtitle' => $adarray)
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
        $subcategory = Product::select('subsubcategory')
        ->where('subcategory', '=', $category)
        ->distinct()->get();
        foreach ($subcategory as $sub) {
            $subsubcategory = Product::select('option1')
            ->where('subsubcategory', '=', $sub['subsubcategory'])
            ->distinct()->get();
            $adarray = [];
            foreach ($subsubcategory as $subsub) {
                array_push(
                    $adarray,
                    $subsub['option1']
                );
            }
            array_push(
                $products,
                array('title' => $sub['subsubcategory'], 'subtitle' => $adarray)
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
