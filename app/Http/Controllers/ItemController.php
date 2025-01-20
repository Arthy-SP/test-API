<?php

namespace App\Http\Controllers;

use App\Models\Item;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Item::all());
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
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $item = Item::create($request->all());
        if ($item) {
            return response()->json($item, 201);
        } else {
            return response()->json('Not able to add data', 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::where('id', $id)->get();

        if ($item) {
            return response()->json($item, 201);
        } else {
            return response()->json(['message' => 'Not able to add data '], 404);
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
    public function update(Request $request,  $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
        ]);
        $item = Item::find($id);
        if ($item) {
            $item->update($request->all());
            return response()->json($item,201);
        } else {
            return response()->json(['message' => 'No data found'], 404);
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

        $item = Item::find($id);
        if ($item) {
            $item->delete();
            return response()->json(['message' => 'Item deleted'],201);
        } else {
            return response()->json(['message' => 'No data found'], 404);
        }
    }
}
