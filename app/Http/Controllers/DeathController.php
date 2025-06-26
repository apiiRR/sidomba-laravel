<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Death;
use App\Models\Sheep;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class DeathController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $death = Death::with('sheep')->get();
        return view('death.index', compact('death'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sheep = Sheep::all();
        return view('death.input', compact(['sheep']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sheep_id' => 'required|exists:sheep,sheep_id',
            'cause' => 'required',
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi data gagal. Periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $death = Death::create([
            'sheep_id' => $request->sheep_id,
            'cause' => $request->cause,
            'date' => $request->date,
        ]);

        Alert::success('Success', 'Data kematian baru berhasil ditambahkan');
        return redirect()->route('death.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $death = Death::with('sheep')->findOrFail($id);
        return view('death.show', compact('death'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
