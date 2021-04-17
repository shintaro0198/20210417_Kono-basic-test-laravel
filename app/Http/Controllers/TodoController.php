<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Todo::all();
        return response()->json([
            'data' => $item
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Todo;
        $now = Carbon::now('Asia/Tokyo');
        $item->content = $request->content;
        $item->created_at = $now;
        $item->updated_at = $now;
        $item->save();
        return response()->json([
            'data' => $item,
            'message' => 'created sucessfully'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        $item = Todo::where('id',$todo->id)->first();
        return response()->json([
            'data'=> $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $item = Todo::where('id',$todo->id)->first();
        $now = Carbon::now('Asia/Tokyo');
        $item->content = $request->content;
        $item->updated_at = $request->$now;
        $item->save();
        if($item){
            return response()->json([
                'data' => $item,
                'message' => 'updated successfully'
            ], 200);
        }   else{
            return response()->json([
                'message' => 'Not Found'
            ],404);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $item = Todo::where('id',$todo->id)->delete();
        if ($item) {
            return response()->json([
                'data' => $item,
                'message' => 'updated successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not Found'
            ], 404);
        }
    }
}
