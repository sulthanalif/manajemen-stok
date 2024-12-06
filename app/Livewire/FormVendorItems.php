<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\Vendor;
use Livewire\Component;
use App\Models\VendorItems;
use RealRashid\SweetAlert\Facades\Alert;

class FormVendorItems extends Component
{
    public $id;
    public $datas = [];
    public $vendor_data = [];

    public function mount(Vendor $vendor)
    {
        $this->vendor_data = $vendor;

        if($vendor->vendorItems->count() > 0) {
            $this->datas = $vendor->vendorItems->map(function($item) {
                return [
                    'id' => $item->item_id,
                    'nama' => $item->item->nama,
                    'kategori' => $item->item->kategori->nama,
                    'harga' => number_format($item->harga, 0, ',', ''),
                    'satuan' => $item->item->satuan->simbol
                ];
            })->toArray();
        }
    }

    public function addItems()
    {
        $item = Item::find($this->id);
        $key = array_search($item->id, array_column($this->datas, 'id'));
        if ($key !== false) {
            $this->datas[$key]['harga'] += 1;
        } else {
            $this->datas[] = [
                'id' => $item->id,
                'nama' => $item->nama,
                'kategori' => $item->kategori->nama,
                'harga' => 0,
                'satuan' => $item->satuan->simbol
            ];
        }
    }

    public function delete($id)
    {
        $key = array_search($id, array_column($this->datas, 'id'));

        if ($key !== false) {
            unset($this->datas[$key]);
            $this->datas = array_values($this->datas);
        }
    }

    public function store($id)
    {
        $vendor = Vendor::find($id);
        foreach ($this->datas as $data) {
            $vendorItem = VendorItems::where('item_id', $data['id'])
                                     ->where('vendor_id', $vendor->id)
                                     ->first();

            if ($vendorItem) {
                if ($vendorItem->harga !== $data['harga']) {
                    $vendorItem->update(['harga' => $data['harga']]);
                }
            } else {
                VendorItems::create([
                    'item_id' => $data['id'],
                    'vendor_id' => $vendor->id,
                    'harga' => $data['harga']
                ]);
            }
        }

        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
        $this->redirectRoute('vendor-items');
    }

    public function render()
    {
        $items = Item::all();
        return view('livewire.form-vendor-items', compact('items'));
    }
}
