<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PanCategory;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class PanCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Hapus Kategori!';
        $text = "Apakah kamu ingin menghapus data kategori ini?";
        confirmDelete($title, $text);

        $panCategory = PanCategory::get();
        return view('pan_category.index', compact('panCategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pan_category.input');
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

        $death = PanCategory::create([
            'category_name' => $request->category_name,
        ]);

        Alert::success('Success', 'Data kategori baru berhasil ditambahkan');
        return redirect()->route('pan_category.index');
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
        PanCategory::destroy($id);

        Alert::success('Success', 'Data berhasil dihapus');
        return redirect()->route('pan_category.index');
    }
}
