<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Item</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                {{-- <th>Satuan</th> --}}
              @role('Owner|Purchase|Kepala Toko')
              <th>Vendor</th>
              <th>Sub Total</th>
              @endrole
            </tr>
        </thead>
        <tbody>
            @foreach ($modelsRequest->requestItems as $key => $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->item->nama }}</td>
                    <td>{{ $item->item->kategori->nama }}</td>
                    <td>{{ $item->jumlah }}{{ $item->item->satuan->simbol }}</td>
                    @role('Owner|Purchase|Kepala Toko')
                    <td>
                        @if (Auth::user()->roles[0]->name == 'Purchase' && $modelsRequest->status == 'Accepted')
                            <select name="vendor_id" class="form-control" wire:change='selectVendor({{ $item->id }}, $event.target.value)'>
                                <option value="" selected>Pilih Vendor</option>
                                @php
                                    $vendorsWithPrices = $vendors->filter(function ($vendor) use ($item) {
                                        return $vendor->vendorItems->contains('item_id', $item->item_id);
                                    })->sortBy(function ($vendor) use ($item) {
                                        return $vendor->vendorItems->where('item_id', $item->item_id)->first()->harga;
                                    });
                                @endphp

                                @foreach ($vendorsWithPrices as $vendor)
                                    <option value="{{ $vendor->id }}">
                                        {{ $vendor->nama }} (Rp.
                                        {{ number_format($vendor->vendorItems->where('item_id', $item->item_id)->first()->harga, 0, ',', '.') }})
                                    </option>
                                @endforeach
                            </select>
                        @else
                            {{ $item->vendor->nama ?? 'Belum Ditentukan' }}
                        @endif
                    </td>
                    <td>Rp. {{ number_format($datas[$item->item_id]['subtotal'] ?? $item->sub_total, 0, ',', '.') }}</td>
                    @endrole
                </tr>
            @endforeach
        </tbody>
       @role('Owner|Purchase|Kepala Toko')
       <tfoot>
        <tr>
            <th colspan="5" style="text-align: right">Total Harga</th>
            <td>Rp. {{ number_format($modelsRequest->total_harga ?? $totalharga , 0, ',', '.') }}</td>
        </tr>
    </tfoot>
       @endrole
    </table>
    <div class="d-flex justify-content-end mt-2">
       @if (Auth::user()->roles[0]->name == 'Purchase' && $modelsRequest->status == 'Accepted')
       <button class="btn btn-primary" wire:click='save'>Simpan Vendor</button>
       @endif
    </div>
</div>
