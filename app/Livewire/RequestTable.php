<?php

namespace App\Livewire;

use App\Models\Vendor;
use App\Models\Request;
use Livewire\Component;
use App\Models\RequestItem;
use RealRashid\SweetAlert\Facades\Alert;

class RequestTable extends Component
{
    public $modelsRequest;
    public $vendors;
    public $datas = [];
    public $subtotal = [];
    public $totalharga = 0;

    public function mount(Request $modelsRequest)
    {
        $this->modelsRequest = $modelsRequest;
        $this->vendors = Vendor::all();
    }

    public function calculateTotalHarga()
    {
        $this->totalharga = collect($this->datas)->sum('subtotal');
    }

    public function calculateSubtotal()
    {
        foreach ($this->datas as $key => $data) {
            $this->datas[$key]['subtotal'] = $data['harga'] * $data['jumlah'];
        }
    }

    public function selectVendor($itemId, $vendorId)
    {
        $item = RequestItem::find($itemId);
        $vendor = Vendor::find($vendorId);


        // Update the `datas` array to reflect the changes
        $this->datas[$item->item_id] = [
            'request_item_id' => $item->item_id,
            'vendor_id' => $vendor->id,
            'harga' => $vendor->vendorItems->where('item_id', $item->item_id)->first()->harga,
            'subtotal' => $item->jumlah * $vendor->vendorItems->where('item_id', $item->item_id)->first()->harga
        ];

        $this->calculateTotalHarga();
        // dd($this->datas);
    }

    public function save()
    {
        // dd($this->datas);

        $this->modelsRequest->update([
            'total_harga' => $this->totalharga,
            'status' => 'Vendor Sudah Dipilih',
            'waiting' => 'Approval oleh Owner...'
        ]);

        foreach ($this->datas as $key => $data) {
            RequestItem::find($key)->update([
                'vendor_id' => $data['vendor_id'],
                'harga' => $data['harga'],
                'sub_total' => $data['subtotal']
            ]);
        }

        Alert::success('Berhasil', 'Data Berhasil Disimpan');
        $this->redirectRoute('request.show', $this->modelsRequest->id);
    }

    public function render()
    {
        return view('livewire.request-table');
    }
}
