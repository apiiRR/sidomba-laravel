<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sheep;
use App\Models\Pregnant;
use App\Models\WeightRecord;
use App\Models\DiseaseRecord;
use App\Models\ChildCategory;
use App\Models\ChildCategorySheep;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;


class DombaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sheep = Sheep::with('death')->get();
        
        $title = 'Hapus Domba!';
        $text = "Apakah kamu ingin menghapus data domba?";
        confirmDelete($title, $text);

        return view('domba.index', compact('sheep'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sheep = Sheep::all(); // untuk pilihan indukan
        $pregnant = Pregnant::all(); // untuk pilihan indukan

        return view('domba.input', compact(['sheep', 'pregnant']));
    }

    public function createWeight($id)
    {
        $sheep = Sheep::findOrFail($id);
        return view('domba.input-weight', compact('sheep'));
    }

    public function createDisease($id)
    {
        $sheep = Sheep::findOrFail($id);
        return view('domba.input-disease', compact('sheep'));
    }

    public function createPhase($id)
    {
        $sheep = Sheep::findOrFail($id);
        $phase = ChildCategory::get();
        return view('domba.input-phase', compact(['sheep', 'phase']));
    }

    public function createPregnant($id)
    {
        $sheep = Sheep::findOrFail($id);
        return view('domba.input-pregnant', compact('sheep'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'tag_number' => 'required|unique:sheep,tag_number',
            'nama' => 'required',
            'gender' => 'required|in:Male,Female',
            'birth_date' => 'required|date',
            'mother_id' => 'nullable|exists:sheep,sheep_id',
            'father_id' => 'nullable|exists:sheep,sheep_id',
            'pregnant_id' => 'nullable|exists:pregnant,pregnant_id',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi data gagal. Periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $sheep = Sheep::create([
            'tag_number' => $request->tag_number,
            'name' => $request->nama,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'mother_id' => $request->mother_id,
            'father_id' => $request->father_id,
            'pregnant_id' => $request->pregnant_id,
        ]);

        Alert::success('Success', 'Domba baru berhasil ditambahkan');
        return redirect()->route('domba.index');
    }

    public function storeWeight(Request $request)
    {        $validator = Validator::make($request->all(), [
            'sheep_id' => 'required|exists:sheep,sheep_id',
            'date' => 'required|date',
            'weight' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi data gagal. Periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $weight = WeightRecord::create([
            'sheep_id' => $request->sheep_id,
            'date' => $request->date,
            'weight' => $request->weight,
        ]);

        Alert::success('Success', 'Data berat domba baru berhasil ditambahkan');
        return redirect()->route('domba.show', $request->sheep_id);
    }

    public function storeDisease(Request $request)
    {        $validator = Validator::make($request->all(), [
            'sheep_id' => 'required|exists:sheep,sheep_id',
            'disease_name' => 'required',
            'description' => 'required',
            'treatment' => 'required',
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi data gagal. Periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $weight = DiseaseRecord::create([
            'sheep_id' => $request->sheep_id,
            'disease_name' => $request->disease_name,
            'description' => $request->description,
            'treatment' => $request->treatment,
            'date' => $request->date,
        ]);

        Alert::success('Success', 'Data penyakit domba baru berhasil ditambahkan');
        return redirect()->route('domba.show', $request->sheep_id);
    }

    public function storePhase(Request $request)
    {        $validator = Validator::make($request->all(), [
            'sheep_id' => 'required|exists:sheep,sheep_id',
            'child_category_id' => 'required|exists:child_category,child_category_id',
            'date_started' => 'required|date',
            'date_ended' => 'required|date',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi data gagal. Periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $weight = ChildCategorySheep::create([
            'sheep_id' => $request->sheep_id,
            'child_category_id' => $request->child_category_id,
            'date_started' => $request->date_started,
            'date_ended' => $request->date_ended,
        ]);

        Alert::success('Success', 'Data fase domba baru berhasil ditambahkan');
        return redirect()->route('domba.show', $request->sheep_id);
    }


    public function storePregnant(Request $request)
    {        $validator = Validator::make($request->all(), [
            'sheep_id' => 'required|exists:sheep,sheep_id',
            'date_started' => 'required|date',
            'date_ended' => 'required|date',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi data gagal. Periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $weight = Pregnant::create([
            'sheep_id' => $request->sheep_id,
            'date_started' => $request->date_started,
            'date_ended' => $request->date_ended,
        ]);

        Alert::success('Success', 'Data kehamilan baru berhasil ditambahkan');
        return redirect()->route('domba.show', $request->sheep_id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sheep = Sheep::with([
            'mother',
            'father',
            'childCategories',
            'pregnancy',
            'pregnancies',
            'weightRecords' => fn($q) => $q->orderByDesc('date'),
            'diseaseRecords' => fn($q) => $q->orderByDesc('date'),
        ])->findOrFail($id);

        return view('domba.show', compact('sheep'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sheep = Sheep::with(['father', 'mother'])->findOrFail($id);
        $allSheep = Sheep::all(); // untuk pilihan indukan

        return view('domba.edit', compact(['sheep', 'allSheep']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
        'tag_number' => 'required|unique:sheep,tag_number,'. $id . ',sheep_id',
        'nama' => 'required',
        'gender' => 'required|in:Male,Female',
        'birth_date' => 'required|date',
        'breed' => 'nullable',
        'mother_id' => 'nullable|exists:sheep,sheep_id',
        'father_id' => 'nullable|exists:sheep,sheep_id',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi data gagal. Periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $sheep = Sheep::where('sheep_id', $id)->update([
            'tag_number' => $request->tag_number,
            'name' => $request->nama,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'breed' => $request->breed,
            'mother_id' => $request->mother_id,
            'father_id' => $request->father_id,
        ]);

        Alert::success('Success', 'Data domba berhasil diperbaharui');
        return redirect()->route('domba.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Sheep::destroy($id);

        Alert::success('Success', 'Domba berhasil dihapus');
        return redirect()->route('domba.index');
    }
}
