<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsentrateCategory;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class ConsentrateCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Hapus Kategori!';
        $text = "Apakah kamu ingin menghapus data kategori ini?";
        confirmDelete($title, $text);

        $consentrateCategory = ConsentrateCategory::get();
        return view('concentrate_category.index', compact('consentrateCategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('concentrate_category.input');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi data gagal. Periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $death = ConsentrateCategory::create([
            'category_name' => $request->category_name,
        ]);

        Alert::success('Success', 'Data kategori baru berhasil ditambahkan');
        return redirect()->route('consentrate_category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        ConsentrateCategory::destroy($id);

        Alert::success('Success', 'Data berhasil dihapus');
        return redirect()->route('consentrate_category.index');
    }
}
