<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\jsonResponse
     */
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'status' => 'success',
            'products' => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\jsonResponse
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $product = Product::create($request->all() + ['user_id' => $user->id]);

        return response()->json([
            'status' => true,
            'message' => 'Product added successfully!',
            'product' => $product,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\jsonResponse
     */
    public function show($id)
    {
        $product = Product::find($id);
        if(!$product){
            return response()->json(['message' => 'Sorry, this product doesn\'t exist!',]);
        }
        return response()->json($product, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\jsonResponse
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $product = Product::find($id);

        if(!$user->can('edit every product') && $user->id != $product->user_id){
            return response()->json(['message' => 'Sorry, this is not your product!']);
        }

        $product->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Product updated successfully!',
            'product' => $product,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\jsonResponse
     */
    function destroy($id)
    {
        $user = Auth::user();
        $product = Product::find($id);

        if(!$user->can('delete every product') && $user->id != $product->user_id){
            return response()->json(['message' => 'Sorry, this is not your product!']);
        }

        $product->delete();
        return response()->json([
            'status' => true,
            'message' => 'Product delete successfully!',
        ], 200);
    }

    public function search($category)
    {
//        $products = Product::whereHas("category", function (Builder $query){
//            $query->where("name", 'like', "$category%");
//        })->get();
//
//        //->where('category', 'like', "$category%")->get();
//        return response()->json([
//            'product' => $products,
//        ]);
    }
    public function test(){
        return 'test';
    }
}
