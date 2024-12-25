<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class VendorItemsController extends Controller
{
    use WithPagination;
    public function index(Request $request)
    {
        $search = $request->query('search');
        $vendors = Vendor::where('nama', 'LIKE', "%{$search}%")
            ->orWhereHas('vendorItems', function($query) use ($search) {
                $query->whereHas('item', function($query) use ($search) {
                    $query->where('nama', 'LIKE', "%{$search}%");
                });
            })
            ->paginate(6);

        return view('master.vendor-items', compact('vendors'));
    }

    public function create(Vendor $vendor)
    {
        return view('master.create-vendor-item', compact('vendor'));
    }
}
