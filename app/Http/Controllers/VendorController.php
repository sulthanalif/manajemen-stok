<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $vendors = Vendor::latest()->get();

        if ($request->get('export')) {
            $title = 'Daftar Vendor';
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML(view('master.pdf.vendor', ['datas' => $vendors, 'title' => $title]));
            $mpdf->Output();
        }

        return view('master.vendor', compact('vendors'));
    }

    public function store(Request $request)
    {
        $vendor = Vendor::create($request->all());

        if (!$vendor) {
            Alert::error('Gagal', 'Data Gagal Ditambahkan');
            return back();
        }

        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
        return redirect()->route('vendors.index');
    }

    public function update(Request $request, Vendor $vendor)
    {
        $update = $vendor->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'nomor' => $request->nomor,
        ]);

        if (!$update) {
            Alert::error('Gagal', 'Data Gagal Diubah');
            return back();
        }

        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('vendors.index');
    }

    public function destroy(Vendor $vendor)
    {
        $delete = $vendor->delete();

        if (!$delete) {
            Alert::error('Gagal', 'Data Gagal Dihapus');
            return back();
        }

        Alert::success('Berhasil', 'Data Berhasil Dihapus');
        return redirect()->route('vendors.index');
    }

}
