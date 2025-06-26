<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BreedingFeedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(BreedingFeed::with(['breeding'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'breeding_id' => 'required|exists:breeding,id',
            'forage_feed' => 'required|numeric',
            'concentrate_feed' => 'required|numeric',
            'date' => 'required|date'
        ]);

        $breedingFeed = BreedingFeed::create($data);
        return response()->json($breedingFeed, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(BreedingFeed::with(['breeding'])->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $breedingFeed = BreedingFeed::findOrFail($id);
        $data = $request->validate([
            'breeding_id' => 'required|exists:breeding,id',
            'forage_feed' => 'required|numeric',
            'concentrate_feed' => 'required|numeric',
            'date' => 'required|date'
        ]);

        $breedingFeed->update($data);
        return response()->json($breedingFeed);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        BreedingFeed::destroy($id);
        return response()->json(null, 204);
    }
}
