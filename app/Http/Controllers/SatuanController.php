<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SatuanController extends Controller
{
    public function index()
    {
        $satuans = Satuan::latest()->get();

        return view('master.satuan', compact('satuans'));
    }

    public function store(Request $request)
    {
        $satuan = Satuan::create($request->all());

        if (!$satuan) {
            Alert::error('Gagal', 'Data Gagal Ditambahkan');
            return back();
        }

        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
        return redirect()->route('satuan.index');
    }

    public function update(Request $request, Satuan $satuan)
    {
        $update = $satuan->update([
            'nama' => $request->nama,
            'simbol' => $request->simbol
        ]);

        if (!$update) {
            Alert::error('Gagal', 'Data Gagal Diubah');
            return back();
        }

        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('satuan.index');
    }

    public function destroy(Satuan $satuan)
    {
        $delete = $satuan->delete();

        if (!$delete) {
            Alert::error('Gagal', 'Data Gagal Dihapus');
            return back();
        }

        Alert::success('Berhasil', 'Data Berhasil Dihapus');
        return redirect()->route('satuan.index');
    }
}
