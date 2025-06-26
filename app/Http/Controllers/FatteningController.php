<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fattening;
use App\Models\FatteningFeed;
use App\Models\Cage;
use App\Models\Sheep;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class FatteningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fattening = Fattening::with(['cage', 'sheep'])->get();
        return view('fattening.index', compact('fattening'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kandang = Cage::all();
        $sheep = Sheep::all();
        return view('fattening.input', compact(['kandang', 'sheep']));
    }

    public function createFeed($id)
    {
        $fattening = Fattening::with(['cage', 'sheep'])->findOrFail($id);
        return view('fattening.input-feed', compact(['fattening']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sheep_id' => 'required|exists:sheep,sheep_id',
            'cage_id' => 'required|exists:cage,cage_id',
            'date_started' => 'required|date',
            'date_ended' => 'required|date',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi data gagal. Periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $breeding = Fattening::create([
            'sheep_id' => $request->sheep_id,
            'cage_id' => $request->cage_id,
            'date_started' => $request->date_started,
            'date_ended' => $request->date_ended,
        ]);

        Alert::success('Success', 'Breeding baru berhasil ditambahkan');
        return redirect()->route('fattening.index');
    }

    public function storeFeed(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fattening_id' => 'required|exists:fattening,fattening_id',
            'forage_feed' => 'required|numeric',
            'concentrate_feed' => 'required|numeric',
            'date' => 'required|date'
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi data gagal. Periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $fattening = FatteningFeed::create([
            'fattening_id' => $request->fattening_id,
            'forage_feed' => $request->forage_feed,
            'concentrate_feed' => $request->concentrate_feed,
            'date' => $request->date
        ]);

        Alert::success('Success', 'Data pakan berhasil ditambahkan ke fase breeding');
        return redirect()->route('fattening.show', $request->fattening_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fattening = Fattening::with(['cage', 'sheep', 'fatteningFeeds'])->findOrFail($id);
        return view('fattening.show', compact('fattening'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fattening = Fattening::findOrFail($id);

        $kandang = Cage::all();
        $sheep = Sheep::all();

        return view('fattening.edit', compact(['fattening', 'kandang', 'sheep']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'sheep_id' => 'required|exists:sheep,sheep_id',
            'cage_id' => 'required|exists:cage,cage_id',
            'date_started' => 'required|date',
            'date_ended' => 'required|date',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi data gagal. Periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $breeding = Fattening::where('fattening_id', $id)->update([
            'sheep_id' => $request->sheep_id,
            'cage_id' => $request->cage_id,
            'date_started' => $request->date_started,
            'date_ended' => $request->date_ended,
        ]);

        Alert::success('Success', 'Breeding baru berhasil diubah');
        return redirect()->route('fattening.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
