<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="form-group">
                        <label for="tanggal" class="col-form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" wire:model.live='tanggal'
                            readonly>
                    </div>
                </div>
                <div class="card-body">
                    {{-- <form> --}}
                    <h3 class="m-0 text-primary">Item Harian</h3>
                    <div class="mt-3">
                        <table id="tableRequest" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th style="width: 100px;">Stok</th>
                                    <th style="width: 100px;">Jumlah</th>
                                    <th>Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas_harian as $key => $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data['nama'] }}</td>
                                        <td>{{ $data['kategori']}}</td>
                                        <td>{{ $data['stok'] }}</td>
                                        <td>
                                            <input type="number" class="form-control"
                                                wire:model.live="datas_harian.{{ $key }}.jumlah">
                                        </td>
                                        <td>{{ $data['satuan']}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                {{-- <div class="card-header py-3">

                </div> --}}
                <div class="card-body">
                    <h3 class="m-0 text-primary">Item Lainnya</h3>
                    <div class="form-group">
                        <label for="kategori_id" class="col-form-label">Pilih Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="custom-select select"
                            wire:change='selectItems($event.target.value)'>
                            <option value="" selected>-- Pilih Kategori --</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($showItems)
                        <div class="form-group">
                            <label for="item_id" class="col-form-label">Pilih Barang</label>
                            <select name="item_id" id="item_id" class="custom-select select" wire:model.live='id'
                                wire:change='addItems'>

                                @if ($items->isNotEmpty())
                                    <option value="" selected>-- Pilih Item --</option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}
                                            ({{ $item->kategori->nama }})
                                        </option>
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
                                    <th style="width: 100px;">Stok</th>
                                    <th style="width: 100px;">Jumlah</th>
                                    <th>Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas_lainnya as $key => $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data['nama'] }}</td>
                                        <td>{{ $data['kategori'] }}</td>
                                        <td>{{ $data['stok'] }}</td>
                                        <td>
                                            <input type="number" class="form-control"
                                                wire:model.live="datas_lainnya.{{ $key }}.jumlah">
                                        </td>
                                        <td>{{ $data['satuan'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-12">
            <button class="btn btn-primary" button="button" wire:click='storeClosing'
            wire:loading.attr="disabled">Save</button>
        </div>
    </div>

    {{-- </form> --}}
</div>
