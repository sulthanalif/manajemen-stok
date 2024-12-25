<div style="width: 350px;">
    <div class="card shadow mb-2">
        <div class="card-header d-flex justify-content-between align-items-center">
            {{-- <button class="btn btn-primary" @click="create = ! create">Tambah Data</button> --}}
            <div class="px-3">
                <h5 class="m-0 font-weight-bold text-primary">{{ $vendor->nama }}</h5>
            </div>
            <a href="{{ route('vendor-items.create', $vendor) }}" class="btn btn-sm btn-primary" >
                Tambah/Edit
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" style="font-size: 11px;" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($vendor->vendorItems->count() > 0)
                            @foreach ($vendor->vendorItems as $vendorItem)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $vendorItem->item->nama }}</td>
                                    <td>{{ $vendorItem->item->kategori->nama }}</td>
                                    <td>Rp.{{ number_format($vendorItem->harga, 0, ',', '.') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger"
                                        wire:click='delete({{ $vendorItem->id }})'
                                        ><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



