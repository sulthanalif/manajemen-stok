<div>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    {{-- <form> --}}
        <div class="form-group">
            <label for="tanggal" class="col-form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" wire:model.live='tanggal'>
        </div>
        <div class="form-group">
            <label for="kategori_id" class="col-form-label">Pilih Kategori</label>
            <select name="kategori_id" id="kategori_id" class="custom-select select" wire:change='selectItems($event.target.value)'>
                <option value="" selected>-- Pilih Kategori --</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                @endforeach
            </select>
        </div>
        @if ($showItems)
        <div class="form-group">
            <label for="item_id" class="col-form-label">Pilih Barang</label>
            <select name="item_id" id="item_id" class="custom-select select" wire:model.live='id' wire:change='addItems'>

                @if ($items->isNotEmpty())
                <option value="" selected>-- Pilih Item --</option>
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }} ({{ $item->kategori->nama }})</option>
                    @endforeach
                @else
                    <option value="" selected>-- Tidak Ada Item --</option>
                @endif
            </select>
        </div>
        @endif
        <div class="mt-3">
            <table id="tableRequest" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th style="width: 100px;">Jumlah</th>
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
                                    wire:model.live="datas.{{ $key }}.jumlah">
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
        <button class="btn btn-primary" button="button" wire:click='storeRequest' wire:loading.attr="disabled">Save</button>
    {{-- </form> --}}
</div>

{{-- @script
<script>
    window.livewire.on('storeRequestSuccess', () => {
        window.location.href = '/dashboard';
    });
</script>
@endscript --}}
