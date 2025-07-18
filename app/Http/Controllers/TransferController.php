<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Breeding;
use App\Models\Fattening;
use App\Models\BreedingPan;
use App\Models\FatteningPan;


class TransferController extends Controller
{
    public function getPhaseOptions(Request $request)
    {
        $phase = $request->phase;

        if ($phase === 'breeding') {
            $data = Breeding::with('cage')->get();
        } elseif ($phase === 'fattening') {
            $data = Fattening::with('cage')->get();
        } else {
            $data = [];
        }

        return response()->json($data);
    }

    public function getPanOptions(Request $request)
    {
        $phaseId = $request->phaseId;
        $category = $request->category;

        $data = [];

        if ($category === 'breeding') {
            $data = BreedingPan::with('panCategory')->where('breeding_id', $phaseId)->get();
        } else {
            $data = FatteningPan::with('panCategory')->where('fattening_id', $phaseId)->get();
        }


        return response()->json($data);
    }
}

