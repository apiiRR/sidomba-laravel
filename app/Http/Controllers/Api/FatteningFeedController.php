<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FatteningFeedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(FatteningFeed::with(['fattening'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'fattening_id' => 'required|exists:fattening,id',
            'forage_feed' => 'required|numeric',
            'concentrate_feed' => 'required|numeric',
            'date' => 'required|date'
        ]);

        $fatteningFeed = FatteningFeed::create($data);
        return response()->json($fatteningFeed, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(FatteningFeed::with(['fattening'])->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fatteningFeed = FatteningFeed::findOrFail($id);
        $data = $request->validate([
            'fattening_id' => 'required|exists:fattening,id',
            'forage_feed' => 'required|numeric',
            'concentrate_feed' => 'required|numeric',
            'date' => 'required|date'
        ]);

        $fatteningFeed->update($data);
        return response()->json($fatteningFeed);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        FatteningFeed::destroy($id);
        return response()->json(null, 204);
    }
}
