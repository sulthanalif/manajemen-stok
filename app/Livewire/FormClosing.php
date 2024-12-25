<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\Closing;
use Livewire\Component;
use App\Models\ClosingItems;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class FormClosing extends Component
{
    public $datas_harian = [];
    public $id;
    public $datas_lainnya = [];
    public $tanggal;
    public $showItems = false;
    public $kategori_id;

    public function mount()
    {
        $items_harian = Item::with('kategori', 'satuan')->Where('type', 'Harian')->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->nama,
                'kategori' => $item->kategori->nama,
                'stok' => $item->stok,
                'satuan' => $item->satuan->simbol,
                'jumlah' => 0,
            ];
        })->toArray();

        $this->datas_harian = $items_harian;
        $this->tanggal = date('Y-m-d');
        // dd($this->datas);
    }

    public function addItems()
    {
        $item = Item::find($this->id);
        $key = array_search($item->id, array_column($this->datas_lainnya, 'id'));
        if ($key !== false) {
            $this->datas_lainnya[$key]['jumlah'] += 1;
        } else {
            $this->datas_lainnya[] = [
                'id' => $item->id,
                'nama' => $item->nama,
                'kategori' => $item->kategori->nama,
                'stok' => $item->stok,
                'satuan' => $item->satuan->simbol
            ];
        }
    }

    public function selectItems($id)
    {
        if($id == '') {
            $this->showItems = false;
        } else {
            $this->showItems = true;
            $this->kategori_id = $id;
        }
    }

    public function delete($id)
    {
        $key = array_search($id, array_column($this->datas_lainnya, 'id'));

        if ($key !== false) {
            unset($this->datas_lainnya[$key]);
            $this->datas_lainnya = array_values($this->datas);
        }
    }

    public function render()
    {
        $items_lainnya = Item::with('kategori', 'satuan')->Where('type', 'Bukan Harian')->get();
        $kategoris = $items_lainnya->pluck('kategori')->unique();
        $items = Item::where('kategori_id', $this->kategori_id)->get();
        return view('livewire.form-closing', compact('items_lainnya', 'kategoris','items'));
    }

    public function storeClosing()
    {
        // dd([
        //     'data_harian' => $this->datas_harian,
        //     'data_lainnya' => $this->datas_lainnya
        // ]);
        $new_closing = Closing::create([
            'code' => 'CLS-' . Auth::user()->id . '-' . date('ymdhis') . '-' . rand(100, 999),
            'user_id' => Auth::user()->id,
            'tanggal' => $this->tanggal,
            'status' => 'Pending',
        ]);

        foreach ($this->datas_harian as $data) {
            $closingItem = new ClosingItems();
            $closingItem->closing_id = $new_closing->id;
            $closingItem->item_id = $data['id'];
            $closingItem->stok = $data['stok'];
            $closingItem->jumlah = $data['jumlah'];
            $closingItem->jumlah_berkurang = $data['stok'] - $data['jumlah'];
            $closingItem->save();
        }

        foreach ($this->datas_lainnya as $data) {
            $closingItem = new ClosingItems();
            $closingItem->closing_id = $new_closing->id;
            $closingItem->item_id = $data['id'];
            $closingItem->stok = $data['stok'];
            $closingItem->jumlah = $data['jumlah'];
            $closingItem->jumlah_berkurang = $data['stok'] - $data['jumlah'];
            $closingItem->save();
        }

        Alert::success('Berhasil', 'Closing Berhasil');
        $this->redirectRoute('dashboard');
        $this->reset();
    }
}
