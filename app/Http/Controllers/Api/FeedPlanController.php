<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(FeedPlan::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'forage_amount' => 'required|numeric',
            'concentrate_amount' => 'required|numeric',
        ]);

        $feedPlan = FeedPlan::create($data);
        return response()->json($feedPlan, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(FeedPlan::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $feedPlan = FeedPlan::findOrFail($id);
        $data = $request->validate([
            'forage_amount' => 'required|numeric',
            'concentrate_amount' => 'required|numeric',
        ]);

        $feedPlan->update($data);
        return response()->json($feedPlan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        FeedPlan::destroy($id);
        return response()->json(null, 204);
    }
}
