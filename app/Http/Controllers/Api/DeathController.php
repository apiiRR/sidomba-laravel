<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeathController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Death::with(['sheep'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'sheep_id' => 'required|exists:sheep,id',
            'death_date' => 'required|date',
            'cause' => 'nullable|string'
        ]);

        $death = Death::create($data);
        return response()->json($death, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Death::with(['sheep'])->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $death = Death::findOrFail($id);
        $data = $request->validate([
            'sheep_id' => 'required|exists:sheep,id',
            'death_date' => 'required|date',
            'cause' => 'nullable|string'
        ]);

        $death->update($data);
        return response()->json($death);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Death::destroy($id);
        return response()->json(null, 204);
    }
}
