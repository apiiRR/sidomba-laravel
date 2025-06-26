<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Cage::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|unique:cage',
            'name' => 'required',
            'type' => 'required|in:breeding,fattening',
        ]);

        $cage = Cage::create($data);
        return response()->json($cage, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Cage::findOrFail($id));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cage = Cage::findOrFail($id);
        $data = $request->validate([
            'code' => 'required|unique:cage,code,' . $id,
            'name' => 'required',
            'type' => 'required|in:breeding,fattening',
        ]);

        $cage->update($data);
        return response()->json($cage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Cage::destroy($id);
        return response()->json(null, 204);
    }
}
