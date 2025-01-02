<div>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    {{-- <form> --}}
        <div class="form-group">
            <label for="vendor" class="col-form-label">Vendor</label>
            <h5 class="">{{ $vendor_data->nama }}</h5>
        </div>
        <div class="form-group">
            <label for="item_id" class="col-form-label">Pilih Barang</label>
            <select name="item_id" id="item_id" class="custom-select" wire:model.live='id' wire:change='addItems'>
                <option value="" selected>-- Pilih Barang --</option>
                @foreach ($items as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }} ({{ $item->kategori->nama }})</option>
                @endforeach
            </select>
        </div>
        <div class="mt-3">
            <table id="tableRequest" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th style="width: 200px;">Harga(Rp)</th>
                        <th>Satuan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $key => $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data['nama'] }}</td>
                            <td>{{ $data['kategori'] }}</td>
                            <td>
                                <input type="number" class="form-control"
                                    wire:model.live="datas.{{ $key }}.harga">
                            </td>
                            <td>{{ $data['satuan'] }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-danger" type="button"
                                    wire:click="delete({{ $data['id'] }})">X</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <button class="btn btn-primary" button="button" wire:click='store({{ $vendor_data->id }})' wire:loading.attr="disabled">Save</button>
        <a href="{{ route('vendor-items', $vendor_data) }}" class="btn btn-danger">Back</a>
    {{-- </form> --}}
</div>

{{-- @script
<script>
    window.livewire.on('storeRequestSuccess', () => {
        window.location.href = '/dashboard';
    });
</script>
@endscript --}}
