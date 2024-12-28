<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kategoris = Kategori::all();

        if ($request->get('export')) {
            $title = 'Daftar Kategori';
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML(view('master.pdf.kategori', ['datas' => $kategoris, 'title' => $title]));
            $mpdf->Output();

        }

        return view('master.kategori', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kategori = Kategori::create($request->all());

        if (!$kategori) {
            Alert::error('Gagal', 'Data Gagal Ditambahkan');
        }

        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
        return redirect()->route('kategori.index');
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
    public function update(Request $request, Kategori $kategori)
    {
        $update = $kategori->update([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan
        ]);

        if (!$update) {
            Alert::error('Gagal', 'Data Gagal Diubah');
            return redirect()->route('kategori.index');
        }

        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            Alert::error('Gagal', 'Data Gagal Dihapus');
            return redirect()->route('kategori.index');
        }

        $kategori->delete();

        Alert::success('Berhasil', 'Data Berhasil Dihapus');
        return redirect()->route('kategori.index');
    }
}
