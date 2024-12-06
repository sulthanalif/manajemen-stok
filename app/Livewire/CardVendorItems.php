<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\Vendor;
use Livewire\Component;
use App\Models\VendorItems;
use RealRashid\SweetAlert\Facades\Alert;

class CardVendorItems extends Component
{
    public $vendor;

    public function mount(Vendor $vendor)
    {
        $this->vendor = $vendor;
    }


    public function delete($id)
    {
        $item = VendorItems::find($id);
        $item->delete();

        Alert::success('Berhasil', 'Data Berhasil Dihapus');
        $this->redirectRoute('vendor-items');
    }

    public function render()
    {
        $items = Item::all();
        return view('livewire.card-vendor-items', compact('items'));
    }
}
