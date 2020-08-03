<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();

        if(!$category){
            return response()->json([
                'status' => 'failed',
                'message' => 'No cateogry was founded'  
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'category' => $category 
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        $category = new Category();
        $category->fill($inputs);
        $category->save();

        if(!$category){
            return response()->json([
                'status' => 'failed',
                'message' => 'No category was added'  
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'category was added',
            'category' => $category 
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::where('id', $id)->first();

        if(!$category){
            return response()->json([
                'status' => 'failed',
                'message' => 'No category was founded with $id'  
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'category' => $category 
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inputs = $request->all();
        $category = Category::where('id', $id)->first();

        $category->update($inputs);
        $category->save();
        
        if(!$category){
            return response()->json([
                'status' => 'failed',
                'message' => 'could not update category with id $id'  
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'category' => $category 
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::where('id', $id)->delete();

        if(!$category){
            return response()->json([
                'status' => 'failed',
                'message' => 'could not delete category with id $id'  
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'category is id: $id is deleted'
        ], 200);
    }
}

