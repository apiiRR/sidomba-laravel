<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cage;
use App\Models\CagePan;
use App\Models\PanCategory;
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
        $pan = PanCategory::get();
        return view('kandang.input', compact('pan'));
    }

    public function createPan($id)
    {
        $cage = Cage::with(['breeding', 'fattening', 'pan'])->findOrFail($id);
        $cagePan = CagePan::where('cage_id', $id)->get();
        $pan = PanCategory::get();

        return view('kandang.input-pan', compact(['cage','pan', 'cagePan']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mitra_name' => 'required',
            'pan_category_id.*' => 'exists:pan_category,pan_category_id', // Validasi tiap elemen array
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi data gagal. Periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kandang = Cage::create([
            'mitra_name' => $request->mitra_name,
        ]);


        foreach ($request->pan_category_id as $panCategoryId) {
            $pan = CagePan::create([
                'cage_id' => $kandang->cage_id,
                'pan_category_id' => $panCategoryId,
            ]);
        }

        Alert::success('Success', 'Kandang baru berhasil ditambahkan');
        return redirect()->route('kandang.index');
    }

    public function storePan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pan_category_id.*' => 'exists:pan_category,pan_category_id', // Validasi tiap elemen array
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi data gagal. Periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }


        foreach ($request->pan_category_id as $panCategoryId) {
            $pan = CagePan::create([
                'cage_id' => $request->cage_id,
                'pan_category_id' => $panCategoryId,
            ]);
        }

        Alert::success('Success', 'Kandang baru berhasil ditambahkan');
        return redirect()->route('kandang.show', $request->cage_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $cage = Cage::with(['breeding.breedingSheep.sheep', 'fattening.sheep'])->findOrFail($id);

        // // Ambil semua domba tergantung tipe kandang
        // $sheeps = $cage->allSheeps();
        $cage = Cage::with(['breeding', 'fattening', 'pan'])->findOrFail($id);

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
        Cage::destroy($id);

        Alert::success('Success', 'Data berhasil dihapus');
        return redirect()->route('kandang.index');
    }
}
