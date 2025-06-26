<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiseaseRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(DiseaseRecord::with(['sheep'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'sheep_id' => 'required|exists:sheep,id',
            'disease' => 'required|string',
            'diagnosis_date' => 'required|date',
            'treatment' => 'nullable|string'
        ]);

        $record = DiseaseRecord::create($data);
        return response()->json($record, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(DiseaseRecord::with(['sheep'])->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $record = DiseaseRecord::findOrFail($id);
        $data = $request->validate([
            'sheep_id' => 'required|exists:sheep,id',
            'disease' => 'required|string',
            'diagnosis_date' => 'required|date',
            'treatment' => 'nullable|string'
        ]);

        $record->update($data);
        return response()->json($record);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DiseaseRecord::destroy($id);
        return response()->json(null, 204);
    }
}
