<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class VendorItemsController extends Controller
{
    use WithPagination;
    public function index()
    {
        $vendors = Vendor::paginate(6);

        return view('master.vendor-items', compact('vendors'));
    }

    public function create(Vendor $vendor)
    {
        return view('master.create-vendor-item', compact('vendor'));
    }
}
