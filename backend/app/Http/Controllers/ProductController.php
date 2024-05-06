<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'message' => 'ok',
            'data' => $products
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
    public function restore(Request $request)
    {
        $products = Product::query()->delete();
        DB::statement('ALTER TABLE products AUTO_INCREMENT = 1');
        $product = Product::insert($request->all());
        return response()->json([
            'message' => 'Product restore successfully',
            'data' => $product
        ], 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $product = Product::insert($request->all());
        return response()->json([
            'message' => 'Product created successfully',
            'data' => $product
        ], 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        if ($product) {
            return response()->json([
                'message' => 'ok',
                'data' => $product
            ], 200, [], JSON_UNESCAPED_UNICODE);
        }
        return response()->json([
            'message' => 'Product not found',
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $update = [
            'name' => $request->name,
            'category' => $request->category
        ];
        $product = Product::where('id', $id)->update($update);
        if ($product) {
            return response()->json([
                'message' => 'Product updated successfully',
            ], 200);
        }
        return response()->json([
            'message' => 'Product not found',
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        /*
        $destroy = [
            'mode' => $request->id,
            'id' => $request->id
        ];
        */
        $product = Product::where('id', $id)->delete();
        if ($product) {
            return response()->json([
                'message' => 'Product deleted successfully',
            ], 200);
        }
        return response()->json([
            'message' => 'Product not found',
        ], 404);
    }
}
