<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\Request;
use Livewire\Component;
use App\Models\Kategori;
use App\Models\RequestItem;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class FormRequest extends Component
{
    public $code;
    public $tanggal;
    public $kategori_id;

    public $showItems = false;


    public $id;
    public $datas = [];
    // public $totalJumlah = 0;

    public function mount()
    {
        $this->tanggal = date('Y-m-d');
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

    public function addItems()
    {
        $item = Item::find($this->id);
        $key = array_search($item->id, array_column($this->datas, 'id'));
        if ($key !== false) {
            $this->datas[$key]['jumlah'] += 1;
        } else {
            $this->datas[] = [
                'id' => $item->id,
                'nama' => $item->nama,
                'kategori' => $item->kategori->nama,
                'jumlah' => 1,
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

    public function storeRequest()
    {
        $request_new = Request::create([
            'code' => 'REQ-' . Auth::user()->id . '-' . date('ymdhis') . '-' . rand(100, 999),
            'tanggal' => $this->tanggal,
            'user_id' => Auth::user()->id,
            'status' => 'Pending',
            'waiting' => 'Approve Kepala Toko....'
        ]);


        foreach ($this->datas as $data) {
            $requestItem = new RequestItem();
            $requestItem->request_id = $request_new->id;
            $requestItem->item_id = $data['id'];
            $requestItem->jumlah = $data['jumlah'];
            $requestItem->status = 'Pending';
            $requestItem->save();
        }

        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
        $this->redirectRoute('request.index');
        $this->reset();
    }

    public function render()
    {
        $kategoris = Kategori::all();
        $items = Item::with('kategori')->where('kategori_id', $this->kategori_id)->get();
        return view('livewire.form-request', compact('items', 'kategoris'));
    }
}
