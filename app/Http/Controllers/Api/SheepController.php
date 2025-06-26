<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SheepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Sheep::with(['mother', 'father'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'tag_number' => 'required|unique:sheep',
            'name' => 'required',
            'gender' => 'required|in:male,female',
            'birth_date' => 'required|date',
            'breed' => 'nullable|string',
            'mother_id' => 'nullable|exists:sheep,id',
            'father_id' => 'nullable|exists:sheep,id'
        ]);

        $sheep = Sheep::create($data);
        return response()->json($sheep, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Sheep::with(['mother', 'father'])->findOrFail($id));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sheep = Sheep::findOrFail($id);
        $data = $request->validate([
            'tag_number' => 'required|unique:sheep,tag_number,' . $id,
            'name' => 'required',
            'gender' => 'required|in:male,female',
            'birth_date' => 'required|date',
            'breed' => 'nullable|string',
            'mother_id' => 'nullable|exists:sheep,id',
            'father_id' => 'nullable|exists:sheep,id'
        ]);

        $sheep->update($data);
        return response()->json($sheep);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Sheep::destroy($id);
        return response()->json(null, 204);
    }
}
