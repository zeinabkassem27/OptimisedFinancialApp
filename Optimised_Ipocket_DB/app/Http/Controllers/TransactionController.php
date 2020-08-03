<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::all();

        if(!$transaction){
            return response()->json([
                'status' => 'failed',
                'message' => 'No transaction was founded'  
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'transaction' => $transaction 
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
        $transaction = new Transaction();
        $transaction->fill($inputs);
        $transaction->save();

        if(!$transaction){
            return response()->json([
                'status' => 'failed',
                'message' => 'No transaction was added'  
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'transaction was added',
            'transaction' => $transaction 
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($users_id)
    {
        $transaction = Transaction::where('users_id', $users_id)->get();

        if(!$transaction){
            return response()->json([
                'status' => 'failed',
                'message' => 'No transaction was founded with $id'  
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'transaction' => $transaction 
        ], 200);
    }

    public function show2($id)
    {
        $transaction = Transaction::where('id', $id)->first();

        if(!$transaction){
            return response()->json([
                'status' => 'failed',
                'message' => 'No transaction was founded with $id'  
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'transaction' => $transaction 
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
        $transaction = Transaction::where('id', $id)->first();

        $transaction->update($inputs);
        $transaction->save();
        
        if(!$transaction){
            return response()->json([
                'status' => 'failed',
                'message' => 'could not update transaction with id $id'  
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'transaction' => $transaction 
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
        $transaction = Transaction::where('id', $id)->delete();

        if(!$transaction){
            return response()->json([
                'status' => 'failed',
                'message' => 'could not delete transaction with id $id'  
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'transaction is id: $id is deleted'
        ], 200);
    }
}
