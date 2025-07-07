<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fattening;
use App\Models\FatteningSheep;
use App\Models\FatteningFeed;
use App\Models\FatteningPan;
use App\Models\Cage;
use App\Models\CagePan;
use App\Models\Sheep;
use App\Models\ConcentrateCategory;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class FatteningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fattening = Fattening::with(['cage'])->get();
        return view('fattening.index', compact('fattening'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kandang = Cage::all();
        return view('fattening.input', compact(['kandang']));
    }

    public function createSheep(string $id)
    {
        $fatteningPan = FatteningPan::with([
            'fattening','fatteningSheep', 'fatteningFeeds', 'panCategory'])->findOrFail($id);
        $sheep = Sheep::get();

        return view('fattening.input-sheep', compact(['breedingPan', 'sheep']));
    }

    public function createFeed($id)
    {
        $fatteningPan = FatteningPan::with([
            'fattening','fatteningSheep', 'fatteningFeeds', 'panCategory'])->findOrFail($id);
        $categoryConcentrate = ConcentrateCategory::get();

        return view('fattening.input-feed', compact(['fatteningPan', 'categoryConcentrate']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cage_id' => 'required|exists:cage,cage_id',
            'date_started' => 'required|date',
            'date_ended' => 'required|date',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi data gagal. Periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $fattening = Fattening::create([
            'cage_id' => $request->cage_id,
            'date_started' => $request->date_started,
            'date_ended' => $request->date_ended,
        ]);

        $cage = Cage::with(['pan'])->findOrFail($fattening->cage_id);

        foreach ($cage->pan as $pan) {
            FatteningPan::create([
                'fattening_id' => $fattening->fattening_id,
                'pan_category_id' => $pan->pan_category_id,
            ]);
        }

        Alert::success('Success', 'Fattening baru berhasil ditambahkan');
        return redirect()->route('fattening.index');
    }

    public function storeSheep(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fattening_pan_id' => 'required|exists:fattening_pan,fattening_pan_id',
            'sheep_id' => 'required|array',
            'sheep_id.*' => 'exists:sheep,sheep_id', // Validasi tiap elemen array
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi data gagal. Periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        foreach ($request->sheep_id as $sheepId) {
            FatteningSheep::create([
                'fattening_pan_id' => $request->fattening_pan_id,
                'sheep_id' => $sheepId,
            ]);
        }

        Alert::success('Success', 'Data domba berhasil ditambahkan ke fase fattening');
        return redirect()->route('fattening.showPan', $request->fattening_pan_id);
    }

    public function storeFeed(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fattening_pan_id' => 'required|exists:fattening_pan,fattening_pan_id',
            'forage_feed' => 'required|numeric',
            'concentrate_feed' => 'required|numeric',
            'concentrate_category_id' => 'required|exists:concentrate_category,concentrate_category_id',
            'date' => 'required|date'
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi data gagal. Periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $fattening = FatteningFeed::create([
            'fattening_pan_id' => $request->fattening_pan_id,
            'forage_feed' => $request->forage_feed,
            'concentrate_feed' => $request->concentrate_feed,
            'concentrate_category_id' => $request->concentrate_category_id,
            'date' => $request->date
        ]);

        Alert::success('Success', 'Data pakan berhasil ditambahkan ke fase fattening');
        return redirect()->route('fattening.showPan', $request->fattening_pan_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fattening = Fattening::with(['fatteningPans'])->findOrFail($id);

        return view('fattening.show', compact('fattening'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fattening = Fattening::findOrFail($id);
        $allKandang = Cage::all();

        return view('fattening.edit', compact(['fattening', 'allKandang']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'cage_id' => 'required|exists:cage,cage_id',
            'date_started' => 'required|date',
            'date_ended' => 'required|date',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi data gagal. Periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $breeding = Fattening::where('fattening_id', $id)->update([
            'cage_id' => $request->cage_id,
            'date_started' => $request->date_started,
            'date_ended' => $request->date_ended,
        ]);

        Alert::success('Success', 'Data fattening berhasil diperbaharui');
        return redirect()->route('fattening.show', $id);    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
