<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Breeding;
use App\Models\BreedingSheep;
use App\Models\BreedingFeed;
use App\Models\Cage;
use App\Models\Sheep;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class BreedingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breeding = Breeding::with('cage')->get();
        return view('breeding.index', compact('breeding'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kandang = Cage::all();
        return view('breeding.input', compact('kandang'));
    }

    public function createSheep($id)
    {
        $breeding = Breeding::with(['cage'])->findOrFail($id);
        $sheep = Sheep::get();
        return view('breeding.input-sheep', compact(['breeding', 'sheep']));
    }

    public function createFeed($id)
    {
        $breeding = Breeding::with(['cage'])->findOrFail($id);
        return view('breeding.input-feed', compact(['breeding']));
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

        $breeding = Breeding::create([
            'cage_id' => $request->cage_id,
            'date_started' => $request->date_started,
            'date_ended' => $request->date_ended,
        ]);

        Alert::success('Success', 'Breeding baru berhasil ditambahkan');
        return redirect()->route('breeding.index');
    }

    public function storeSheep(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'breeding_id' => 'required|exists:breeding,breeding_id',
            'sheep_id' => 'required|array',
            'sheep_id.*' => 'exists:sheep,sheep_id', // Validasi tiap elemen array
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi data gagal. Periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        foreach ($request->sheep_id as $sheepId) {
            BreedingSheep::create([
                'breeding_id' => $request->breeding_id,
                'sheep_id' => $sheepId,
            ]);
        }

        Alert::success('Success', 'Data domba berhasil ditambahkan ke fase breeding');
        return redirect()->route('breeding.show', $request->breeding_id);
    }

    public function storeFeed(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'breeding_id' => 'required|exists:breeding,breeding_id',
            'forage_feed' => 'required|numeric',
            'concentrate_feed' => 'required|numeric',
            'date' => 'required|date'
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi data gagal. Periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $breeding = BreedingFeed::create([
            'breeding_id' => $request->breeding_id,
            'forage_feed' => $request->forage_feed,
            'concentrate_feed' => $request->concentrate_feed,
            'date' => $request->date
        ]);

        Alert::success('Success', 'Data pakan berhasil ditambahkan ke fase breeding');
        return redirect()->route('breeding.show', $request->breeding_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $breeding = Breeding::with(['cage', 'breedingFeeds', 'breedingSheep'])->findOrFail($id);
        return view('breeding.show', compact('breeding'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $breeding = Breeding::findOrFail($id);
        $allKandang = Cage::all(); // untuk pilihan indukan

        return view('breeding.edit', compact(['breeding', 'allKandang']));
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

        $breeding = Breeding::where('breeding_id', $id)->update([
            'cage_id' => $request->cage_id,
            'date_started' => $request->date_started,
            'date_ended' => $request->date_ended,
        ]);

        Alert::success('Success', 'Data breeding berhasil diperbaharui');
        return redirect()->route('breeding.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
