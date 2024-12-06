<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Satuan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::latest()->get();
        $kategoris = Kategori::all();
        $satuans = Satuan::all();

        return view('master.item', compact('items', 'kategoris', 'satuans'));
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
        $store = Item::create($request->all());

        if (!$store) {
            Alert::error('Gagal', 'Data Gagal Ditambahkan');
            return redirect()->route('item.index');
        }

        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
        return redirect()->route('item.index');
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
    public function update(Request $request, Item $item)
    {
        $update = $item->update([
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'stok' => $request->stok,
            'satuan_id' => $request->satuan_id
        ]);

        if (!$update) {
            Alert::error('Gagal', 'Data Gagal Diubah');
            return redirect()->route('item.index');
        }

        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('item.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::find($id);

        if (!$item) {
            Alert::error('Gagal', 'Data Gagal Dihapus');
            return redirect()->route('item.index');
        }

        $item->delete();
        Alert::success('Berhasil', 'Data Berhasil Dihapus');
        return redirect()->route('item.index');
    }
}
