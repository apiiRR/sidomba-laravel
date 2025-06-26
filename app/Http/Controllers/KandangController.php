<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class KandangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kandang = Cage::get();
        return view('kandang.index', compact('kandang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kandang.input');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:cage,code',
            'nama' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi data gagal. Periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kandang = Cage::create([
            'code' => $request->code,
            'name' => $request->nama,
            'gender' => "",
        ]);

        Alert::success('Success', 'Kandang baru berhasil ditambahkan');
        return redirect()->route('kandang.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $cage = Cage::with(['breeding.breedingSheep.sheep', 'fattening.sheep'])->findOrFail($id);

        // // Ambil semua domba tergantung tipe kandang
        // $sheeps = $cage->allSheeps();
        $cage = Cage::with(['breeding', 'fattening'])->findOrFail($id);
        return view('kandang.show', compact('cage'));
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
