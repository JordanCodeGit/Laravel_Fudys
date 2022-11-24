<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $food = Food::all();
        return $food;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = Food::create([
            "name" => $request->name,
            "description" => $request->description,
            "price" => $request->price,
            "picture" => $request->picture
        ]);

        return response()->json([
            'success' => 201,
            'message' => 'Food saved successfully',
            'data' => $table
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
        $food = Food::find($id);
        if ($food) {
            return response()->json([
                'status' => 200,
                'data' => $food
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'ID ' . $id . ' not found'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $food = Food::find($id);
        if($food){
            $food->name = $request->name ? $request->name : $food->name;
            $food->description = $request->description ? $request->description : $food->description;
            $food->price = $request->price ? $request->price : $food->price;
            $food->picture = $request->picture ? $request->picture : $food->picture;
            $food->save();
            return response()->json([
                'status' => 200,
                'data' => $food
            ],200);
        } else {
            return response()->json([
                'status'=>404,
                'message'=> $id . ' tidak ditemukan'
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $food = food::where('id',$id)->first();
        if($food){
            $food->delete();
            return response()->json([
                'status' =>200,
                'data'=> $food
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'id' . $id . ' tidak ditemukan'
            ],404);
        }
    }
}
