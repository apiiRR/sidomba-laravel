<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BreedingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Breeding::with('cage')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'cage_id' => 'required|exists:cage,id',
            'date_started' => 'required|date',
            'date_ended' => 'nullable|date',
        ]);

        $breeding = Breeding::create($data);
        return response()->json($breeding, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Breeding::with('cage')->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $breeding = Breeding::findOrFail($id);
        $data = $request->validate([
            'cage_id' => 'required|exists:cage,id',
            'date_started' => 'required|date',
            'date_ended' => 'nullable|date',
        ]);

        $breeding->update($data);
        return response()->json($breeding);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Breeding::destroy($id);
        return response()->json(null, 204);
    }
}
