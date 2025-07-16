<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Breeding;
use App\Models\Fattening;


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
}
