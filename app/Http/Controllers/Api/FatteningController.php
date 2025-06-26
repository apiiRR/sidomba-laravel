<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FatteningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Fattening::with(['sheep', 'cage'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'sheep_id' => 'required|exists:sheep,id',
            'cage_id' => 'required|exists:cage,id',
            'date_started' => 'required|date',
            'date_ended' => 'nullable|date',
        ]);

        $fattening = Fattening::create($data);
        return response()->json($fattening, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Fattening::with(['sheep', 'cage'])->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fattening = Fattening::findOrFail($id);
        $data = $request->validate([
            'sheep_id' => 'required|exists:sheep,id',
            'cage_id' => 'required|exists:cage,id',
            'date_started' => 'required|date',
            'date_ended' => 'nullable|date',
        ]);

        $fattening->update($data);
        return response()->json($fattening);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Fattening::destroy($id);
        return response()->json(null, 204);
    }
}
