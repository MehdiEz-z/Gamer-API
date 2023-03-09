<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\jsonResponse
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'status' => true,
            'categories' => $categories,
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
        $category = Category::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'New category added successfully!',
            'category' => $category->name,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\jsonResponse
     */
    public function show($id)
    {
        $category = Category::find($id);
        if(!$category){
            return response()->json(['message' => 'This category doesn\'t exist!']);
        }
        return response()->json([
            'Category' => $category->name,
        ]);
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
        $category = Category::find($id);
        $category->update($request->all());
        if(!$category){
            return response()->json(['message' => 'Sorry this cateogyr doesn\'t exist!']);
        }
        return response()->json([
            'status' => true,
            'message' => 'Category updated successfully!',
            'category' => $category->name,

        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\jsonResponse
     */
    public function destroy($id)
    {
        $category  = Category::find($id);
        if(!$category){
            return response()->json(['message' => 'Sorry this category doesn\'t exist!']);
        }
        $category->delete();
        return response()->json([
            'message' => 'Category deleted successfully!',
            'category' => $category->name
        ], 200);
    }
}
