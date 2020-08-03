<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currency = Currency::all();
        if(!$currency){
            return response()->json([
                'status' => 'failed',
                'message' => 'No currency was founded'  
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'currencies' => $currency 
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
        $currency = new Currency();
        $currency->fill($inputs);
        $currency->save();

        
        return response()->json([
            'status' => 'success',
            'message' => 'currency was added',
            '$currency' => $currency 
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
        $currency = Currency::where('id', $id)->first();

        if(!$currency){
            return response()->json([
                'status' => 'failed',
                'message' => 'No currency was founded with $id'  
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'currencies' => $currency 
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
        $currency = Currency::where('id', $id)->first();

        $currency->update($inputs);
        $currency->save();

        if(!$currency){
            return response()->json([
                'status' => 'failed',
                'message' => 'could not update curency with id $id'  
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'currencies' => $currency 
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
        $currency = Currency::where('id', $id)->delete();

        if(!$currency){
            return response()->json([
                'status' => 'failed',
                'message' => 'could not delete currency with id $id'  
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'currency is id: $id is deleted'
        ], 200);
    }
}
